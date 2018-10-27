<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//Models
use App\Models\Category;
use App\Models\Package;

class CategoryController extends Controller
{
    public function categoriesList(){
        $categories = Category::orderBy("id", 'Desc')->get();
        return view('admin.category.categoriesList',compact('categories'));
    }
    public function categoryAdd(){
        return view('admin.category.categoryAdd');
    }
    public function categorySave(Request $request){
        $request->validate([
            'name'    => 'required',
            'status'     => 'required'
        ]);
        $category = new Category();
        $category->name     =   $request->name;
        $category->status   =   $request->status;
        $category->save();
        return redirect()->route('categoriesList')->with('success','Program added Successfully');
    }
    public function categoriesEdit($id){
        $category = Category::with('packages')->find($id);
//        dd($category);
        return view('admin.category.categoryEdit',compact('category'));
    }
    public function categoryUpdate(Request $request, Category $category){
        $request->validate([
            'name'    => 'required',
            'status'    => 'required'
        ]);
        $category->name = $request->name;
        $category->status = $request->status;
        $category->save();

        //Save category package
        $package['hourly_rate'] = $request->hourly_rate;
        $package['extra_percentage_for_group_of_two'] = $request->extra_percentage_for_group_of_two;
        $package['extra_percentage_for_group_of_three'] = $request->extra_percentage_for_group_of_three;
        $package['extra_percentage_for_group_of_four'] = $request->extra_percentage_for_group_of_four;
        $package['is_active'] = 1;

        $category->packages()->update($package);

        return redirect()->route('categoriesList')->with('success','Category Updated successfully');
    }
    public function changeCategoryStatus(Request $request){
        request()->validate([
            'category_id' => 'required',
            'status' => 'required'
        ]);
        $category_id = $request->category_id;
        $status = $request->status;

        $category = Category::where('id',$category_id)->first();
        if ($status == 'true'){
            $category->status = 1;
            $category->save();
        }else
        {
            $category->status = 0;
            $category->save();
        }
    }
    public function categoryDelete(Category $category){
        $category->delete();
        return redirect()->route('categoriesList')->with('success','Category Deleted successfully');
    }
}
