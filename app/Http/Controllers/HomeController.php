<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $startDate = Carbon::now()->firstOfMonth();
        $endDate = Carbon::now()->lastOfMonth();
        $products = Product::whereBetween('created_at',[$startDate,$endDate])->inRandomOrder()->limit(8)->get();
        return view('userIndex',['products'=>$products]);
    }

    public function productInfo(Request $request, Product $product){
        $relatedProduct = Product::where('gender', $product->gender)->where('function', $product->function)->inRandomOrder()->limit(4)->get();
        return view('productView',['product'=>$product, 'Relatedproducts' => $relatedProduct]);
    }

    public function productList (Product $product){
        return view('productList',['products' => $product->paginate(8)]);
    }
}
