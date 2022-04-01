<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Attachment;
use App\Models\Color;
use App\Models\Material;
use App\Models\Order;
use App\Models\Province;
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
        $cabinMaterials = Material::where('type', 'cabin')->get();
        $surfaceMaterials = Material::where('type', 'surface')->get();
        $bowlMaterials = Material::where('type', 'bowl')->get();
        $mirrorMaterials = Material::where('type', 'mirror')->get();
        $drawerMaterials = Material::where('type', 'drawer')->get();
        $colors = Color::all();
        $provinces = Province::all();
        $addresses = Address::where('user_id', Auth::user()->id)->get();
        return view('admin.orders.create', compact('cabinMaterials', 'surfaceMaterials', 'bowlMaterials', 'mirrorMaterials', 'drawerMaterials', 'colors', 'provinces', 'addresses'));

    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'cabin_size' => 'required',
        ]);
        $pendingOrders = Order::where('user_id', Auth::user()->id)->where('state', 'ordered')->orWhere('state', 'pricing')->orWhere('state', 'pending')->orWhere('state', 'waitForPay1')->count();

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

    public function edit(Request $request , $id)
    {

    }

    public function delete($id)
    {

    }
}
