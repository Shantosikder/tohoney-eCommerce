<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use Auth;
use Image;
use Carbon\Carbon;


class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    function addcategory()
    {
        $categories = category::where('deleted_at', null)->get();

        //echo Category::onlyTrashed()->get();
        return view('admin.category.index', compact('categories'));
    }

    function addcategorypost(Request $request)
    {
        $request->validate([
            'category_name' => 'required|unique:categories,category_name',
            'category_photo' => 'required|image'
        ], [
            'category_name.requied' => 'You Can not use this category Name!!'
        ]);

        //print_r($request->file('category_photo'));

        $category_id = category::insertGetId([
            'category_name' => $request->category_name,
            'user_id' => Auth::user()->id,
            'category_photo' => $request->category_name,
            'created_at' => Carbon::now()
        ]);

        //photo Upload start

        $uploaed_photo = $request->file('category_photo');
        $new_name = $category_id . "." . $uploaed_photo->getClientOriginalExtension();
        $new_upload_location = base_path('public/uploads/category_photos/' . $new_name);
        Image::make($uploaed_photo)->resize(600, 470)->save($new_upload_location, 40);

        //photo Upload End

        Category::find($category_id)->update([
            'category_photo' => $new_name
        ]);

        return back()->with('success_message', 'Your category add successfully!');
    }

    function updatecategory($category_id)
    {

        $category_name = Category::find($category_id)->category_name;
        $category_photo = Category::find($category_id)->category_photo;

        return view('admin.category.update', compact('category_name', 'category_id', 'category_photo'));
    }

    function updatecategorypost(Request $request)
    {

        if ($request->hasFile('new_category_photo')) {

            //old photo delete start
            $delete_photo_location = base_path('public/uploads/category_photos/' . Category::find($request->category_id)->category_photo);
            unlink($delete_photo_location);
            //old photo deleted end

            //new upload photo start
            $uploaed_photo = $request->file('new_category_photo');
            $new_name = $request->category_id . "." . $uploaed_photo->getClientOriginalExtension();
            $new_upload_location = base_path('public/uploads/category_photos/' . $new_name);
            Image::make($uploaed_photo)->resize(600, 470)->save($new_upload_location, 50);
            //new upload photo end

            //new photo info upadte at db start
            Category::find($request->category_id)->update([
                'category_photo' => $new_name
            ]);
            //new photo info update at db end
        }

        Category::find($request->category_id)->update([

            'category_name' => $request->category_name
        ]);

        return redirect('add/category')->with('update_status', 'Category Updated Successfully!');
    }

    function deletecategory($category_id)
    {
        Category::find($category_id)->update([
            'deleted_at' => Carbon::now()
        ]);
        return back()->with('delete_status', 'Category Deleted Successfully!');
    }
}
