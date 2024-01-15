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
        $categories = Category::all();

        return view('portal.admin.product.add-product', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $postData = $request->only(['category_id', 'product_title', 'product_description', 'product_image', 'price_chart']);

        try {
            if($request->hasFile('product_image')){
                $imgName = storeImage($request, 'product_image');
                $postData['product_image'] = $imgName;
            }

            if($request->hasFile('price_chart')){
                $imgName2 = storeImage($request, 'price_chart');
                $postData['price_chart'] = $imgName2;
            }

            $product = Product::create($postData);

            if($product){
                return redirect()->route('product.index')->with('success', 'Successfully created.');
            }
            else{
                return redirect()->back()->with('error', 'Something went wrong.');
            }
        } catch (\Exception $ex) {
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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $product = Product::where('id', $id)->first();
        $categories = Category::all();

        return view('portal.admin.product.edit-product', compact('product', 'categories'));
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
        $postData = $request->only(['category_id', 'product_title', 'product_description', 'product_image', 'price_chart']);

        try {
            if($request->hasFile('product_image')){
                $imgName = storeImage($request, 'product_image');
                $postData['product_image'] = $imgName;
            }

            if($request->hasFile('price_chart')){
                $imgName2 = storeImage($request, 'price_chart');
                $postData['price_chart'] = $imgName2;
            }

            $product = Product::where('id', $id)->update($postData);

            if ($product) {
                return redirect()->route('product.index')->with('success', 'Successfully updated.');
            } else {
                return redirect()->back()->with('error', 'Failed to update the product.');
            }
        } catch (\Exception $ex) {
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
