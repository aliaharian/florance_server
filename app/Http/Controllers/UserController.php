<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Order;
use App\Models\OrderPayment;
use App\Models\Province;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function setTransaction(Request $request)
    {
        $t = Transaction::create([
            'user_id' => $request->user_id,
            'price' => $request->price,
            'pay_terminal' => $request->pay_terminal,
            'transaction_token' => $request->transaction_token,
            'transaction_code' => $request->transaction_code,
        ]);

        return response()->json(['success' => true, 'code' => $t->id]);
    }

    public function verifyPhone()
    {
        return view('auth.verifyPhone');
    }

    public function sendCode(Request $request)
    {
        $rand = rand(11111, 99999);
        $now = Carbon::now();
        $user = User::where('phone', $request->phone)->first();
        $json = json_decode($user->meta);
        if (@$json->timestamp) {
            $date = Carbon::parse($json->timestamp);
            $diff = $date->diffInSeconds($now);
            if ($diff < 120) {
                return response()->json(['success' => false, 'diff' => 120 - $diff], 401);
            }
        }

        User::updateOrCreate(['id' => $user->id], [
            'meta' => '{"code":"' . $rand . '","timestamp":"' . $now . '"}'
        ]);


        $endpoint = "https://api.kavenegar.com/v1/614B7A514F4D3067754C4668474E626358616C50356C47467343782B516C6A56/verify/lookup.json?receptor=" . $request->phone . "&token=" . $rand . "&template=devtest";
        $client = new Client();
        try {
            $response = $client->request('GET', $endpoint);
            $statusCode = $response->getStatusCode();
            $content = $response->getBody();
            return response()->json(['success' => true, 'phone' => $request->phone]);

        } catch (ClientException $e) {
            $response = $e->getResponse();
            $responseBodyAsString = $response->getBody()->getContents();
            return response()->json(['success' => false, 'text' => $responseBodyAsString]);
        }


    }

    public function verifyCode(Request $request)
    {
        $user = Auth::user();
        $json = json_decode($user->meta);
        if (@$json->code) {
            if ($request->code != $json->code) {
                return back()->with('error', 'کد صحیح نیست');
            } else {
                User::updateOrCreate(['id' => $user->id], [
                    'phone_verified_at' => Carbon::now(),
                    'active' => 1
                ]);
                return redirect('/');
            }
        } else {
            return back()->with('error', 'کد صحیح نیست');

        }

    }

    public function resetPassword(Request $request)
    {
        $validatedData = $request->validate([
            'phone' => ['required', 'iran_mobile', 'exists:users'],
            'code' => ['required'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ],
            [
                'phone.required' => 'شماره تماس خود را وارد کنید',
                'code.required' => 'کد را وارد کنید',
                'phone.exists' => 'این شماره تماس در سیستم موجود نیست',
                'phone.iran_mobile' => 'شماره موبایل صحیح نیست',
                'password.unique' => 'کلمه عبور خود را وارد کنید',
                'password.min' => 'کلمه عبور باید حداقل ۸ کاراکتر باشد',
                'password.confirmed' => 'کلمه عبور ها یکسان نیستند',
            ]);
        $user = User::where('phone', $request->phone)->first();
        $json = json_decode($user->meta);

        if (@$json->code) {
            if ($request->code != $json->code) {
                return back()->with('error', 'کد صحیح نیست');
            } else {
                User::updateOrCreate(['id' => $user->id], [
                    'phone_verified_at' => Carbon::now(),
                    'active' => 1,
                    'password' => Hash::make($request->password)
                ]);
                return redirect('/login');
            }
        } else {
            return back()->with('error', 'کد صحیح نیست');
        }


    }

    public function profile()
    {
        $user = Auth::user();
        $pass = true;

        return view('admin.users.profile', compact('user', 'pass'));
    }

    public function update($id, Request $request)
    {
        if (Auth::user()->role == 'admin') {
            $validatedData = $request->validate([
                'name' => 'required|string',
                'last_name' => 'required|string',
                'email' => 'required|email',
            ]);
        } else {
            $validatedData = $request->validate([
                'name' => 'required|string',
                'last_name' => 'required|string',
                'email' => 'required|email',
                'national_code' => 'required|melli_code',
                'card_number' => 'required|card_number',
                'sheba_number' => 'required|sheba',
            ]);
        }
        if (Auth::user()->role != 'admin' && Auth::user()->id != $id) {
            abort(403);
        }
        User::updateOrCreate(['id' => $id], [
            'name' => $request->name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'national_code' => $request->national_code,
            'card_number' => $request->card_number,
            'sheba_number' => $request->sheba_number,
        ]);
        return back();
    }

    public function list()
    {
        $users = User::paginate(10);
        return view('admin.users.list', compact('users'));

    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $pass = false;
        $admin = true;
        return view('admin.users.profile', compact('user', 'pass', 'admin'));
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return back();
    }

    public function addresses($id = null)
    {
        $admin = false;
        if ($id) {
            if (Auth::user()->role == 'admin') {
                $admin = true;
                $user = User::findOrFail($id);
            } else {
                $user = Auth::user();
            }
        } else {
            $user = Auth::user();
        }
        $addresses = Address::where('user_id', $user->id)->paginate();
        $name = $user->name . ' ' . $user->last_name;
        return view('admin.users.addresses', compact('user', 'addresses', 'name', 'admin'));

    }

    public function deleteAddress($id, $id2 = null)
    {
        $admin = false;
        if ($id2) {
            if (Auth::user()->role == 'admin') {
                $admin = true;
                $user = User::findOrFail($id);
                $address = Address::findOrFail($id2);
            } else {
                $user = Auth::user();
                $address = Address::findOrFail($id);
            }
        } else {
            $user = Auth::user();
            $address = Address::findOrFail($id);
        }
        $address->delete();

        if ($admin) {
            return redirect('/users/addresses/' . $user->id);
        } else {
            return redirect('/users/profile/addresses');
        }
    }

    public function editAddress($id, $id2 = null)
    {
        $admin = false;
        if ($id2) {
            if (Auth::user()->role == 'admin') {
                $admin = true;
                $user = User::findOrFail($id);
                $address = Address::findOrFail($id2);
            } else {
                $user = Auth::user();
                $address = Address::findOrFail($id);
            }
        } else {
            $user = Auth::user();
            $address = Address::findOrFail($id);
        }
        $provinces = Province::all();

        return view('admin.users.editAddress', compact('user', 'admin', 'provinces', 'address'));

    }

    public function updateAddress($id, $id2 = null, Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'last_name' => 'required',
            'province' => 'required|not_in:province0',
            'city' => 'required|not_in:city0',
            'phone' => 'required|min:8|max:11',
            'postalCode' => 'required|min:10|max:10',
            'address' => 'required',
        ]);

        $admin = false;
        if ($id2) {
            if (Auth::user()->role == 'admin') {
                $admin = true;
                $user = User::findOrFail($id);
                $address = Address::findOrFail($id2);
            } else {
                $user = Auth::user();
                $address = Address::findOrFail($id);
            }
        } else {
            $user = Auth::user();
            $address = Address::findOrFail($id);
        }


        $meta =
            '{"postalCode":"' . $request->postalCode .
            '"}';
        $addressInfo = Address::updateOrCreate(['id' => $address->id], [
            'user_id' => $user->id,
            'name' => $request->name,
            'last_name' => $request->last_name,
            'province_id' => $request->province,
            'city_id' => $request->city,
            'phone' => $request->phone,
            'meta' => $meta,
            'address' => $request->address
        ]);
        if ($admin) {
            return redirect('/users/addresses/' . $user->id);
        } else {
            return redirect('/users/profile/addresses');
        }
    }

    public function createAddress($id = null)
    {
        $admin = false;
        if ($id) {
            if (Auth::user()->role == 'admin') {
                $admin = true;
                $user = User::findOrFail($id);
            } else {
                $user = Auth::user();
            }
        } else {
            $user = Auth::user();
        }
        $provinces = Province::all();

        return view('admin.users.createAddress', compact('user', 'admin', 'provinces'));

    }

    public function storeAddress($id = null, Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'last_name' => 'required',
            'province' => 'required|not_in:province0',
            'city' => 'required|not_in:city0',
            'phone' => 'required|min:8|max:11',
            'postalCode' => 'required|min:10|max:10',
            'address' => 'required',
        ]);

        $admin = false;
        if ($id) {
            if (Auth::user()->role == 'admin') {
                $admin = true;
                $user = User::findOrFail($id);
            } else {
                $user = Auth::user();
            }
        } else {
            $user = Auth::user();
        }


        $meta =
            '{"postalCode":"' . $request->postalCode .
            '"}';
        $addressInfo = Address::create([
            'user_id' => $user->id,
            'name' => $request->name,
            'last_name' => $request->last_name,
            'province_id' => $request->province,
            'city_id' => $request->city,
            'phone' => $request->phone,
            'meta' => $meta,
            'address' => $request->address
        ]);
        if ($admin) {
            return redirect('/users/addresses/' . $user->id);

        } else {
            return redirect('/users/profile/addresses');
        }
    }
}
