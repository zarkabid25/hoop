<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $products = Product::with('category')->get();
        $categories = Category::all();
        return view('portal.admin.product.all-products', compact('products', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $postData = $request->except('_token');

        try{
            $imgName = storeImage($request, 'product_image');
            $postData['product_image'] = $imgName;

            $product = Product::create($postData);

            if($product){
                return redirect()->route('product.index')->with('success', 'Successfully created.');
            }
            else{
                return redirect()->back()->with('error', 'Something went wrong.');
            }
        } catch (\Exception $ex){
            return redirect()->back()->with('error', $ex->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit($id)
    {
        $product = Product::where('id', $id)->first();
        $categories = Category::all();
        return response()->json(['status' => 'ture', 'product' => $product, 'categories' => $categories]);
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
        $postData = $request->except(['_method', '_token']);

        try{
            $product = Product::where('id', $id)->update($postData);

            if($product){
                return redirect()->route('product.index')->with('success', 'Successfully updated.');
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
        $product = Product::where('id', $id)->delete();

        if($product){
            return redirect()->back()->with('success', 'Successfully deleted');
        }
        else{
            return redirect()->back()->with('error', 'Something went wrong.');
        }
    }
}
