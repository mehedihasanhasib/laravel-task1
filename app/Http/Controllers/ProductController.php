<?php

namespace App\Http\Controllers;

use App\Models\Detail;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use App\ImageResizer\ImageResizer;
use App\ImageResizer\ImageResizer\ImageResize;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Detail::with('product')->get();

        return view('dashboard', ['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create_product');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $product = $request->validate([
        //     'title' => "required|max:255",
        //     'brand' => "required|max:255",
        //     'color' => "required|max:255",
        //     'size' => "required|max:255",
        //     'price' => "required",
        //     'image' => "required|mimes:jpeg,png,jpg|max:2048"
        // ]);


        if ($request->hasFile('image')) {
            $image = $request->file('image');

            $file_name = time() . $image->getClientOriginalName();
            $path =  public_path() . '/product_images';
            $image->move($path,  $file_name);

            // Product::create($request->only(['title']));
            // $product_id = Product::get()->last()->id;
            // Detail::create([
            //     'color' => $request->color,
            //     'brand' => $request->brand,
            //     'size' => $request->size,
            //     'image' => $file_name,
            //     'price' => $request->price,
            //     'product_id' => $product_id,
            // ]);
        }

        // return back()->with('msg', 'Product Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(string $product_id)
    {
        $product = Product::with('details')->find($product_id);
        return view('details_product', ['product' => $product]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(string $product_id)
    {
        $product = Product::with('details')->find($product_id);
        return view('update_product', ['product' => $product]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $product_id)
    {
        Product::where('id', $product_id)
            ->update($request->only(['title']));

        Detail::where('product_id', $product_id)
            ->update($request->except(['title', 'product_id', '_token', '_method']));

        return redirect()->route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}