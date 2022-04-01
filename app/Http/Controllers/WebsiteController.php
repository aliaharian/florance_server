<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Events;
use App\Models\Product;
use App\Models\TemplateSetting;
use Illuminate\Http\Request;
use Mail;

class WebsiteController extends Controller
{
    public function index()
    {
        return redirect('/orders');
    }

    public function getCities($id)
    {
        $cities = City::where('province_id', $id)->get();
        $tmp = '<option value="city0">شهر را انتخاب کنید</option>';
        foreach ($cities as $city) {
            $tmp .= '<option value="' . $city->id . '">' . $city->name . '</option>';
        }
        return $tmp;
    }
}
