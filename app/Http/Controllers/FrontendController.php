<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Product;
use App\Product_multiple_photos;

class FrontendController extends Controller
{
    function index(){
        return view('index', [
            'categories'    =>Category::all(),
            'products'    =>Product::latest()->get()  //latest->limit(2), ->take(2)
        ]);
    }
    function contact(){
        return view('contact');
    }
    function about(){
        return view('about');
    }
    function productdetails($product_id){
        $category_id = Product::find($product_id)->category_id;
        return view('productdetails', [
            'product_info' => Product::find($product_id),
            'related_products'   => Product::where('category_id', $category_id)->where('id', '!=', $product_id)->limit(4)->get(),
            'multiple_photos'   => Product_multiple_photos::where('product_id', $product_id)->get(),
        ]);
    }
    function shop(){
        return view('shop', [
            'categories'    => Category::all(),
            'products'    => Product::all()
        ]);
    }
}
