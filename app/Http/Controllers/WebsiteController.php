<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Events;
use App\Models\Order;
use App\Models\OrderPayment;
use App\Models\Product;
use App\Models\TemplateSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mail;

class WebsiteController extends Controller
{
    public function index()
    {
        if (Auth::user()->role == 'admin') {
            $totalOrder = Order::all()->count();
            $pendingOrders = Order::where('state', 'ordered')->orWhere('state', 'pricing')->orWhere('state', 'pay1')->orWhere('state', 'pay2')->orWhere('state', 'building')->orWhere('state', 'shipping')->orWhere('state', 'pending')->count();
            $failedOrders = Order::where('state', 'failed')->orWhere('state', 'canceled')->orWhere('state', 'pay1')->count();
            $moneyOrders = Order::where('state', 'waitForPay1')->orWhere('state', 'waitForPay2')->count();
            $doneOrders = Order::where('state', 'done')->count();
            $incomeTotal = OrderPayment::where('payed',1)->sum('price');

            return view('admin.index',compact('totalOrder','pendingOrders','failedOrders','moneyOrders','incomeTotal','doneOrders'));

        } else {
            return redirect('/orders');
        }
    }

    public function getCities($id, $selected = null)
    {
        $cities = City::where('province_id', $id)->get();
        $tmp = '<option value="city0">شهر را انتخاب کنید</option>';

        foreach ($cities as $city) {
//            $selected==$city->id?" selected ":""
//            $tmp .= '<option value="' . $city->id . '">' . $city->name . '</option>';
            $tmp .= '<option';
            if ($selected == $city->id) {
                $tmp .= ' selected ';
            } else {
                $tmp .= ' ';

            }
            $tmp .= 'value="' . $city->id . '">' . $city->name . '</option>';
        }
        return $tmp;
    }
}
