<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

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
    public function categoriesEdit(Category $category){
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
