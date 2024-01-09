<?php

namespace App\Http\Controllers\Reward;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;

class RewardController extends Controller
{
    public function index(){
        $orders = Notification::with('order')
            ->where('refered_by', auth()->user()->email)
            ->where('status', '0')
            ->get();

        return view('portal.sales.rewards', compact('orders'));
    }

    public function notificationOrder($id){
        $orders = Notification::with('order')
            ->where('order_id', $id)
            ->where('refered_by', auth()->user()->email)
            ->get();

            Notification::where('order_id', $id)->update(['status' => '1']);

        return view('portal.sales.rewards', compact('orders'));
    }
}
