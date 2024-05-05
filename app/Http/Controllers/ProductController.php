<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Brand;
use App\Models\Color;
use App\Models\Detail;
use App\Models\Product;
use App\Models\Size;
use Illuminate\Http\Request;

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
        $colors = Color::get();
        $sizes = Size::get();
        $brands = Brand::get();
        return view('create_product', [
            'colors' => $colors,
            'sizes' => $sizes,
            'brands' => $brands
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {

        if ($request->hasFile('image')) {

            $image = $request->file('image');
            $file_name = time() . $image->getClientOriginalName();
            $path =  public_path() . '/product_images';
            $details = $request->safe()->except(['title']);
            $details['image'] = $file_name;
            list($original_width, $original_height) = getimagesize($image);

            if ($image->getClientOriginalExtension() == "PNG" || $image->getClientOriginalExtension() == "png") {
                $original_image = imagecreatefrompng($image);
                $resized_image = imagecreatetruecolor(300, 300);
                imagealphablending($resized_image, true);
                imagesavealpha($resized_image, true);
                imagecopyresampled($resized_image, $original_image, 0, 0, 0, 0, 300, 300, $original_width, $original_height);
                imagepng($resized_image, $path . '/' . $file_name);
            } else {
                $original_image = imagecreatefromjpeg($image);
                $resized_image = imagecreatetruecolor(300, 300);
                imagecopyresampled($resized_image, $original_image, 0, 0, 0, 0, 300, 300, $original_width, $original_height);
                imagejpeg($resized_image, $path . '/' . $file_name);
            }

            $product = Product::create($request->only(['title']));

            $product->details()->create($details);
        }

        return back()->with('msg', 'Product Added Successfully');
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
