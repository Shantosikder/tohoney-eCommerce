<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Ui\Presets\React;
use App\Category;
use App\Product;
use App\product_multiple_photos;
use Carbon\Carbon;
use Image;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    function addproduct(){
        return view('admin/product/index',[
            'categories' => Category::all(),
            'products'    =>Product::all()
        ]);
    }

    function addproductpost(Request $request)
    {

        $product_id = Product::insertGetId([
            'product_name' => $request->product_name,
            'category_id' => $request->category_id,
            'product_price' => $request->product_price,
            'product_quantity' => $request->product_quantity,
            'product_short_description' => $request->product_short_description,
            'product_long_description' => $request->product_long_description,
            'product_thumbnail_photo' => 'product thumbnail photo',
            'created_at' => Carbon::now()
        ]);

        //photo Upload start
        $uploaed_photo = $request->file('product_thumbnail_photo');
        $new_name = $product_id. "." .$uploaed_photo->getClientOriginalExtension();
        $new_upload_location = base_path('public/uploads/product_photos/'.$new_name);
        Image::make($uploaed_photo)->resize(600,622)->save($new_upload_location, 40);
        //photo Upload End

        Product::find($product_id)->update([
            'product_thumbnail_photo' => $new_name
        ]);

        //multiple photo uload start
        $flag = 1;
        foreach($request->file('product_multiple_photos') as $product_multiple_photo){

          $uploaed_photo = $product_multiple_photo;
          $new_name = $product_id."-".$flag.".".$uploaed_photo->getClientOriginalExtension();
          $new_upload_location = base_path('public/uploads/product_multiple_photos/'.$new_name);
          Image::make($uploaed_photo)->resize(600,550)->save($new_upload_location, 40);

          product_multiple_photos::insert([
             'product_id' => $product_id,
             'photo_name' => $new_name,
             'created_at' => Carbon::now()
          ]);

          $flag++;

        }
                  ////multiple photo uload End

        return back();

        //print_r($request->all());
        //return view('')
    }
}
