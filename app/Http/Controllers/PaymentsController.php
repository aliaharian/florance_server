<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentsController extends Controller
{
    public function index()
    {
        $role = Auth::user()->role;
        if ($role == 'admin') {
            $payments = Transaction::orderBy('id', 'DESC')->paginate(10);
        } else {
            $payments = Transaction::where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->paginate(10);
        }
        foreach ($payments as $payment) {
            $pay = $payment->payment;
            $pay->order;
        }

        return view('admin.payments.index', compact('payments'));
    }
}
