<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Attachment;
use App\Models\Color;
use App\Models\Material;
use App\Models\Order;
use App\Models\OrderPayment;
use App\Models\Province;
use App\Models\Transaction;
use Carbon\Carbon;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $role = Auth::user()->role;
        if ($role == 'admin') {
            $orders = Order::orderBy('id', 'DESC')->paginate(10);
        } else {
            $orders = Order::where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->paginate(10);
        }
        return view('admin.orders.index', compact('orders'));
    }

    public function create()
    {
        $order = null;

        $cabinMaterials = Material::where('type', 'cabin')->get();
        $surfaceMaterials = Material::where('type', 'surface')->get();
        $bowlMaterials = Material::where('type', 'bowl')->get();
        $mirrorMaterials = Material::where('type', 'mirror')->get();
        $drawerMaterials = Material::where('type', 'drawer')->get();
        $colors = Color::all();
        $provinces = Province::all();
        $addresses = Address::where('user_id', Auth::user()->id)->get();
        return view('admin.orders.create', compact('order', 'cabinMaterials', 'surfaceMaterials', 'bowlMaterials', 'mirrorMaterials', 'drawerMaterials', 'colors', 'provinces', 'addresses'));

    }

    public function changeState($id)
    {
        $user = Auth::user();
        $order = Order::findOrFail($id);
        if ($user->role != 'admin') {
            abort(403);
        }
        $changePrice = 0;
        $orderPayments = OrderPayment::where('order_id', $id)->where('payed', 1)->count();
        if ($orderPayments > 0) {
            $changePrice = $orderPayments;
        }
        return view('admin.orders.changeState', compact('order', 'changePrice'));
    }

    public function submitChangeState($id, Request $request)
    {

        $orderPaymentsCheck = OrderPayment::where('order_id', $id)->where('payed', 1)->count();
        if ($orderPaymentsCheck == 0) {
            $validatedData = $request->validate([
                'total_price' => 'required|integer',
                'expire_date' => 'required',
            ]);
        }
        $date = Carbon::createFromTimestamp($request->expire_date / 1000)->format('Y-m-d H:i:s');

        $order = Order::findOrFail($id);

        Order::updateOrCreate(['id' => $order->id], [
            'total_price' => $orderPaymentsCheck == 0 ? $request->total_price : $order->total_price,
            'state' => $request->order_state,
            'admin_comment' => $request->admin_comment
        ]);

        $orderPayments = OrderPayment::where('order_id', $id)->count();
        if ($orderPayments < 2) {
            OrderPayment::create([
                'order_id' => $id,
                'price' => ($request->total_price) * 0.7,
                'payed' => 0,
                'expired_at' => $date
            ]);
            OrderPayment::create([
                'order_id' => $id,
                'price' => ($request->total_price) * 0.3,
                'payed' => 0
            ]);
        } else {
            if ($orderPaymentsCheck == 0) {
                $firstPayment = OrderPayment::where('order_id', $id)->orderBy('id', 'asc')->first();
                OrderPayment::updateOrCreate(['id' => $firstPayment->id], [
                    'order_id' => $id,
                    'price' => ($request->total_price) * 0.7,
                    'payed' => 0,
                    'expired_at' => $date
                ]);
                $secondPayment = OrderPayment::where('order_id', $id)->orderBy('id', 'desc')->first();
                OrderPayment::updateOrCreate(['id' => $secondPayment->id], [
                    'order_id' => $id,
                    'price' => ($request->total_price) * 0.3,
                    'payed' => 0,
                ]);
            }
        }

        return redirect('/orders');

    }

    public function payList($id, Request $request)
    {
        $parameter = false;
        if ($request->Status == 'OK' && $request->Authority) {
            $transaction_id = Transaction::where('transaction_code', $request->pay_id)->orderBy('id', 'DESC')->first();
            $endpoint = "https://api.zarinpal.com/pg/v4/payment/verify.json";
            $merchant_id = "1344b5d4-0048-11e8-94db-005056a205be";
            $amount = $transaction_id->price;
            $authority = $request->Authority;
            $client = new Client();
            try {
                $response = $client->request('POST', $endpoint, ['form_params' => [
                    'merchant_id' => $merchant_id,
                    'amount' => $amount,
                    'authority' => $authority,
                ]]);
                $statusCode = $response->getStatusCode();
                $content = $response->getBody();
                $transaction = Transaction::updateOrCreate(['id' => $transaction_id->id], [
                    'meta' => $content
                ]);
                $payment = OrderPayment::updateOrCreate(['id' => $request->pay_id], [
                    'payed' => 1,
                    'payed_at' => Carbon::now(),
                    'transaction_id' => $transaction->id,
                    'meta' => $content
                ]);
                $orderPrice = Order::findOrFail($id)->price;
                $payPrice = OrderPayment::findOrFail($request->pay_id)->price;
                $order = Order::updateOrCreate(['id' => $id], [
                    'state' => $payPrice == $orderPrice * 0.7 ? 'pay1' : 'pay2'
                ]);
                $parameter = true;
//                return ($content);

            } catch (ClientException $e) {
                $response = $e->getResponse();
                $responseBodyAsString = $response->getBody()->getContents();
                $payment = OrderPayment::updateOrCreate(['id' => $request->pay_id], [
                    'meta' => $responseBodyAsString
                ]);
                $transaction = Transaction::updateOrCreate(['id' => $transaction_id->id], [
                    'meta' => $responseBodyAsString
                ]);
                $parameter = false;

//                return ($responseBodyAsString);
            }
            // or when your server returns json
            // $content = json_decode($response->getBody(), true);
        }
        $payments = OrderPayment::where('order_id', $id)->orderBy('id', 'asc')->get();
        return view('admin.orders.payList', compact('payments', 'id', 'request', 'parameter'));
    }

    public
    function view($id)
    {
        $user = Auth::user();
        $order = Order::findOrFail($id);
        if ($user->role != 'admin' && $order->user_id != $user->id) {
            abort(403);
        }
        $pay1 = OrderPayment::where('order_id', $id)->orderBy('id', 'asc')->first();
        $pay2 = OrderPayment::where('order_id', $id)->orderBy('id', 'desc')->first();

        return view('admin.orders.view', compact('order', 'pay1', 'pay2'));

    }

    public
    function store(Request $request)
    {
        $validatedData = $request->validate([
            'cabin_size' => 'required',
        ]);
//        $pendingOrders = Order::where('user_id', Auth::user()->id)->where('state', 'ordered')->orWhere('state', 'pricing')->orWhere('state', 'pending')->orWhere('state', 'waitForPay1')->get();
        $pendingOrders = Order::where(function ($query) {
            $query->where('user_id', Auth::user()->id);
        })->where(function ($query) {
            $query->where('state', 'ordered')
                ->orWhere('state', 'pricing')
                ->orWhere('state', 'pending')
                ->orWhere('state', 'waitForPay1');
        })->count();
        if ($pendingOrders > 0) {
            return back()->with('error', 'تا تعیین تکلیف سفارش قبلی خود نمیتوانید سفارش جدیدی ثبت کنید');
        }
        $imageInfo = null;

        if ($request->mainImage) {
            $imgObj = json_decode($request->featured_image_obj);
            $imageInfo = Attachment::create([
                'user_id' => Auth::user()->id,
                'org_name' => $imgObj->name,
                'path' => $imgObj->path,
                'type' => $imgObj->mime,
            ]);
        }
        if (!$request->address_id || $request->address_id == 'address0') {
            $validatedData = $request->validate([
                'name' => 'required',
                'last_name' => 'required',
                'province' => 'required|not_in:province0',
                'city' => 'required|not_in:city0',
                'phone' => 'required|min:8|max:11',
                'postalCode' => 'required|min:10|max:10',
                'address' => 'required',
            ]);
            $meta =
                '{"postalCode":"' . $request->postalCode .
                '"}';
            $addressInfo = Address::create([
                'user_id' => Auth::user()->id,
                'name' => $request->name,
                'last_name' => $request->last_name,
                'province_id' => $request->province,
                'city_id' => $request->city,
                'phone' => $request->phone,
                'meta' => $meta,
                'address' => $request->address
            ]);
            $addressId = $addressInfo->id;
        } else {
            $addressId = $request->address_id;
        }
        $rand = rand(pow(10, 6), pow(10, 7) - 1);
        Order::create([
            'user_id' => Auth::user()->id,
            'cabin_size' => $request->cabin_size,
            'mirror_size' => $request->mirror_size,
            'has_mirror' => !($request->mirror_material == 'mirror0'),
            'color_id' => $request->color,
            'cabin_material_id' => $request->cabin_material,
            'surface_material_id' => $request->surface_material,
            'bowl_material_id' => $request->bowl_material,
            'mirror_material_id' => $request->mirror_material == 'mirror0' ? null : $request->mirror_material,
            'drawer_material_id' => $request->drawer_material == 'drawer0' ? null : $request->drawer_material,
            'attachment_id' => $imageInfo ? $imageInfo->id : null,
            'description' => $request->description,
            'state' => 'ordered',
            'tracking_code' => 'FLR' . $rand,
            'address_id' => $addressId
        ]);


        $pm = 'سفارش با موفقیت ثبت شد';
        return redirect('/orders');
    }

    public
    function edit(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $user = Auth::user();
        if ($user->role != 'admin' && $order->user_id != $user->id) {
            abort(403);
        }
        $cabinMaterials = Material::where('type', 'cabin')->get();
        $surfaceMaterials = Material::where('type', 'surface')->get();
        $bowlMaterials = Material::where('type', 'bowl')->get();
        $mirrorMaterials = Material::where('type', 'mirror')->get();
        $drawerMaterials = Material::where('type', 'drawer')->get();
        $colors = Color::all();
        $provinces = Province::all();
        $addresses = Address::where('user_id', Auth::user()->id)->get();

        return view('admin.orders.create', compact('order', 'cabinMaterials', 'surfaceMaterials', 'bowlMaterials', 'mirrorMaterials', 'drawerMaterials', 'colors', 'provinces', 'addresses'));

    }

    public
    function update($id, Request $request)
    {
        $order = Order::findOrFail($id);
        $user = Auth::user();
        if ($user->role != 'admin' && $order->user_id != $user->id) {
            abort(403);
        }
        if ($order->state != 'ordered' && Auth::user()->role != 'admin') {
            return back()->with('error', 'این سفارش قابل ویرایش نیست');
        }

        if (!$request->address_id || $request->address_id == 'address0') {
            $validatedData = $request->validate([
                'name' => 'required',
                'last_name' => 'required',
                'province' => 'required|not_in:province0',
                'city' => 'required|not_in:city0',
                'phone' => 'required|min:8|max:11',
                'postalCode' => 'required|min:10|max:10',
                'address' => 'required',
            ]);
            $meta =
                '{"postalCode":"' . $request->postalCode .
                '"}';
            $addressInfo = Address::create([
                'user_id' => Auth::user()->id,
                'name' => $request->name,
                'last_name' => $request->last_name,
                'province_id' => $request->province,
                'city_id' => $request->city,
                'phone' => $request->phone,
                'meta' => $meta,
                'address' => $request->address
            ]);
            $addressId = $addressInfo->id;
        } else {
            $addressId = $request->address_id;
        }

        Order::updateOrCreate(['id' => $order->id], [
            'cabin_size' => $request->cabin_size,
            'mirror_size' => $request->mirror_size,
            'has_mirror' => !($request->mirror_material == 'mirror0'),
            'color_id' => $request->color,
            'cabin_material_id' => $request->cabin_material,
            'surface_material_id' => $request->surface_material,
            'bowl_material_id' => $request->bowl_material,
            'mirror_material_id' => $request->mirror_material == 'mirror0' ? null : $request->mirror_material,
            'drawer_material_id' => $request->drawer_material == 'drawer0' ? null : $request->drawer_material,
            'description' => $request->description,
            'state' => 'ordered',
            'address_id' => $addressId
        ]);


        $pm = 'سفارش با موفقیت ویرایش شد';
        return redirect('/orders');
    }

    public
    function destroy($id)
    {
        $order = Order::findOrFail($id);
        $user = Auth::user();
        if ($user->role != 'admin' && $order->user_id != $user->id) {
            abort(403);
        }
        $order->delete();
        return redirect('/orders');

    }
}
