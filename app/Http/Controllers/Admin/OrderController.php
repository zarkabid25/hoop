<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AssignOrder;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Notification;
use App\Models\Order;
use App\Models\OrderStatus;
use App\Models\User;
use Illuminate\Http\Request;
use Mockery\Matcher\Not;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $orders = Order::orderBy('id', 'DESC')->get();

        if(auth()->user() && auth()->user()->role == 'order'){
            $orders = Order::where('order_status', '1')->orderBy('id', 'DESC')->get();
        }

        if(auth()->user() && auth()->user()->role == 'customer'){
            $orders = Order::where('customer_id', auth()->user()->id)->orderBy('id', 'DESC')->get();
        }

        if(auth()->user() && auth()->user()->role == 'developer'){
            $orders = AssignOrder::with('order')->where('developer_id', auth()->user()->id)
                ->orderBy('id', 'DESC')->get();
        }

        return view('portal.admin.order.orders', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create()
    {
        $referredCheck = User::where('id', auth()->user()->id)->first()->referred;

        if(is_null($referredCheck)){
            return redirect()->route('profile')->with('error', 'Enter reference to place order.');
        }

        return view('portal.admin.order.create-order');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $postData = $request->except(['_token', 'order_img']);

        try{
            $postData['customer_id'] = auth()->user()->id;
            if($request->has('order_img') && !empty($request->order_img)){
                $postData['image'] = storeImage($request, 'order_img');
            }

            $order = Order::create($postData);

            Notification::create([
               'order_id' => $order->id,
               'refered_by' => auth()->user()->referred,
            ]);

            if($order){
                return redirect()->route('order.index')->with('success', 'Successfully created');
            }
            else{
                return redirect()->back()->with('error', 'Something went wrong.');
            }
        } catch(\Exception $ex){
            return redirect()->back()->with('error', $ex->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */

    public function show($id)
    {
        $order = Order::with(['customer', 'assignOrder.developer', 'comments', 'orderStatus'])->find($id);
        $assignedDeveloper = '';

        if (!empty($order->assignOrder) && !empty($order->assignOrder->developer)) {
            $assignedDeveloper = $order->assignOrder->developer;
        }

        $developers = User::with('orderAssign')->where('role', 'developer')->get();
        return view('portal.admin.order.order-details', compact('order', 'developers', 'assignedDeveloper'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $order = Order::where('id', $id)->first();

        return view('portal.admin.order.edit-order', compact('order'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        try{
            $postData = $request->except(['_token', '_method', '_token']);
            if($request->has('order_img') && !empty($request->order_img)){
                $postData['image'] = storeImage($request, 'order_img');
            }
            $order = Order::where('id', $id)->update($postData);

            if($order == '1'){
                return redirect()->route('order.index')->with('success', 'Successfully updated');
            }
            else{
                return redirect()->back()->with('error', 'Something went wrong.');
            }
        } catch (\Exception $ex){
            return redirect()->back()->with('error', $ex->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $order = Order::where('id', $id)->delete();

        if($order == '1'){
            return redirect()->route('order.index')->with('success', 'Successfully deleted');
        }
        else{
            return redirect()->back()->with('error', 'Something went wrong.');
        }
    }

    public function statusUpdate(Request $request){
        $status = Order::where('id', $request->id)->update(['order_status' => $request->status]);

        if($status){
            return response()->json(['status' => true]);
        }
    }

    public function assignOrder(Request $request, $devId, $orderId, $status){
//        dd($devId, $orderId, $status);
        $type = $request->type;

        if($type == 'order-assign'){
            $result = AssignOrder::where('order_id', $orderId)->first();

            if(!empty($result)){
                if($result->status == 'assign'){
                    $assignOrder = AssignOrder::where('order_id', $orderId)->delete();
                    Comment::where('order_id', $orderId)->delete();
                }else{
                    $assignOrder = AssignOrder::where('order_id', $orderId)->update([
                        'status' => $status
                    ]);
                }
            } else{
                $assignOrder = AssignOrder::create([
                    'developer_id' => $devId,
                    'order_id' => $orderId,
                    'status' => $status,
                    'development_status' => 'pending',
                    'order_status' => 'pending',
                ]);
            }
        }

        if($assignOrder){
            return redirect()->back()->with('success', 'Order status updated successfully.');
        }
        else{
            return redirect()->back()->with('error', 'Something went wrong.');
        }
    }

    public function orderStatus(Request $request){

//        $postData = $request->except(['_token', 'image']);
//        $postData['user_id'] = auth()->user()->id;

        if($request->hasFile('image')){
            $fileName = storeImage($request, 'image');
            $result = OrderStatus::updateOrCreate(
                [
                    'user_id' => auth()->user()->id,
                ],
                [
                    'order_id' => $request->order_id,
                    'image' => $fileName,
                ]
            );
        }
//        else{
//            $result = OrderStatus::updateOrCreate(
//                [
//                    'user_id' => auth()->user()->id,
//                ],
//                [
//                    'order_id' => $request->order_id,
//                ]
//            );
//        }

        if($result){
            return redirect()->back()->with('success', 'Order status updated successfully.');
        }
        else{
            return redirect()->back()->with('error', 'Something went wrong.');
        }
    }
}
