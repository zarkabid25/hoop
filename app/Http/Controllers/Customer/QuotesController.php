<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Quote;
use Illuminate\Http\Request;

class QuotesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
//        $quotes = Quote::orderBy('id', 'DESC')->get();
//
//        if(auth()->user() && auth()->user()->role == 'order'){
//            $orders = Order::where('order_status', '1')->orderBy('id', 'DESC')->get();
//        }
//
//        if(auth()->user() && auth()->user()->role == 'customer'){
//
//        }

        $quotes = Quote::where('customer_id', auth()->user()->id)->orderBy('id', 'DESC')->get();
        return view('portal.customer.quotes.quotes', compact('quotes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('portal.customer.quotes.create-quote');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $postData = $request->except(['_token', 'order_img', 'ord_type']);

        try{
            $postData['customer_id'] = auth()->user()->id;
            if($request->hasFile('order_img')){
                if(is_array($request->order_img)){
                    foreach ($request->order_img as $key=>$img){
                        $fileName[] = storeImage($request->order_img, $key);
                    }
                    $postData['image'] = json_encode($fileName);
                }else{
                    $postData['image'] = storeImage($request, 'order_img');
                }
            }

            $postData['order_type'] = $postData['quote_type'];
            $postData['format'] = json_encode($postData['format']);
            $order = Quote::create($postData);

            if($order){
                return redirect()->route('quote.index')->with('success', 'Successfully created');
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
        $order = Quote::with('customer', 'customer.placements')->find($id);

        return view('portal.customer.quotes.quote-details', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $order = Quote::where('id', $id)->first();
        $order['format'] = json_decode($order['format']);
        return view('portal.customer.quotes.edit-quote', compact('order'));
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
            $postData = $request->except(['_token', '_method', 'order_img']);
            if($request->hasFile('order_img')){
                if(is_array($request->order_img)){
                    foreach ($request->order_img as $key=>$img){
                        $fileName[] = storeImage($request->order_img, $key);
                    }
                    $postData['image'] = json_encode($fileName);
                }else{
                    $postData['image'] = storeImage($request, 'order_img');
                }
            }

            $postData['format'] = json_encode($postData['format']);
            $order = Quote::where('id', $id)->update($postData);

            if($order == '1'){
                return redirect()->route('quote.index')->with('success', 'Successfully updated');
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
        $quote = Quote::where('id', $id)->delete();

        if($quote == '1'){
            return redirect()->route('quote.index')->with('success', 'Successfully deleted');
        }
        else{
            return redirect()->back()->with('error', 'Something went wrong.');
        }
    }
}
