<?php

namespace App\Http\Controllers;

use App\Models\Brands;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return view('admin.productList',['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $brands = Brands::all();
        return view('admin.productAdd',['brands'=>$brands]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $request->validate([
             'name'=>'required|min:3|max:50|string',
             'price'=>'required|numeric',
             'sale_price'=>'required|numeric',
             'color'=>'string|nullable',
             'function'=>'required|string',
             'brand_id'=>'integer|required',
             'stock'=>'numeric|required',
             'gender'=>'required|in:Male,Female,Children,Unisex',
             'description'=>'nullable|string|max:300',
             'product_code' => 'string|required',
             'image'=>'mimes:jpg,jpeg,gif,png',
         ]);

         $requestData = $request->except(['_token', 'image']);

        // Handle the image upload
        if ($request->hasFile('image')) {
        $imgName = 'products/' . rand() . '.' . $request->image->extension();
        $request->image->move(public_path('products/'), $imgName);
        $requestData['image'] = $imgName; 
    }

        // Create the product with the request data
        $product = Product::create($requestData);
    
        if (!empty($product)) {
            return redirect()->route('product.index', [], 301)->with('success','Product Created Successfully!');
        } else {
            return redirect()->route('product.index')->with('error','Something Went Wrong Please Try Again');
        }

       
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $brands = Brands::all();
        return view('admin.productEdit', ['product' => $product, 'brands' => $brands]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name'=>'required|min:3|max:50|string',
            'price'=>'required|numeric',
            'sale_price'=>'required|numeric',
            'color'=>'string|nullable',
            'function'=>'required|string',
            'brand_id'=>'integer|required',
            'stock'=>'numeric|required',
            'gender'=>'required|in:Male,Female,Children,Unisex',
            'description'=>'nullable|string|max:300',
            'product_code' => 'string|required',
            
        ]);

        $requestData = $request->except(['_token', 'image']);

       // Handle the image upload
       if ($request->hasFile('image')) {
       $imgName = 'products/' . rand() . '.' . $request->image->extension();
       $request->image->move(public_path('products/'), $imgName);
       if ($product->image) {
        $oldImagePath = public_path($product->image);
        if (file_exists($oldImagePath)) {
            unlink($oldImagePath);
        }
    }
       
   }
        $product->name = $request->name ?? $product->name;
        $product->price = $request->price ?? $product->price;
        $product->image = $imgName ?? $product->image;
        $product->sale_price = $request->sale_price ?? $product->sale_price;
        $product->color = $request->color ?? $product->color;
        $product->function = $request->function ?? $product->function;
        $product->brand_id = $request->brand_id ?? $product->brand_id;
        $product->stock = $request->stock ?? $product->stock;
        $product->gender = $request->gender ?? $product->gender;
        $product->description = $request->description ?? $product->description;
        $product->product_code = $request->product_code ?? $product->product_code;

       // Create the product with the request data
       $product->save();
   
       if (!empty($product)) {
           return redirect()->route('product.index')->with('success','Product Updated Successfully!');
       } else {
           return redirect()->route('product.index')->with('error','Something Went Wrong Please Try Again');
       }
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }

    public function changeProductStatus(Request $request,$id,$status = 1){
        $product = Product::find($id);
        if(!empty($product)){
            $product->is_active = $status;
            $product->save();
            return redirect()->route('product.index')->with('success','Product Status Updated Successfully');
        }else{
            return redirect()->route('product.index')->with('error','Something Went Wrong Please Try Agian');
        }
    }
}
