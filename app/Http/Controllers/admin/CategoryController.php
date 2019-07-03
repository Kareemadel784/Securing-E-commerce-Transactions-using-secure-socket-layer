<?php

namespace App\Http\Controllers\admin;

use App\Category;
use App\CategoryLanguage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use File;
use DB;
use Session;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lang=Session::get('locale');
        $category = DB::table('categories')
            ->join('category_languages', 'category_languages.categore_id', '=', 'categories.id')
            ->select('categories.id as ids','category_languages.*')
            ->where('category_languages.language_id',$lang)
            ->get();
        return view('cpanel.category.index',compact('category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cpanel.category.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'name'=>'required',
            'englishname'=>'required',
        ])->validate();
        $category=new Category();
        $category->save();
        $id=$category->id;
        $category_language=new CategoryLanguage();
        $category_language->name=$request->name;
        $category_language->language_id=1;
        $category_language->categore_id=$id;
        $category_language->save();
        $category_language=new CategoryLanguage();
        $category_language->name=$request->englishname;
        $category_language->language_id=2;
        $category_language->categore_id=$id;
        $category_language->save();
        return redirect('/admin/category')->with('success', 'Add Category successfully');
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
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category=Category::find($id);
        $categorys = DB::table('categories')
            ->join('category_languages', 'category_languages.categore_id', '=', 'categories.id')
            ->select('categories.id as ids','category_languages.*')
            ->where('category_languages.categore_id',$id)
            ->get();
        return view('cpanel.category.edit',compact('category','categorys'));
    }

    /**
     * Update the specified resource in storagereturn
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Validator::make($request->all(), [
            'name'=>'required',
            'englishname'=>'required',
        ])->validate();
        $category=Category::find($id);
        $category_id=$category->id;
        $cat_lang=CategoryLanguage::where('categore_id',$category_id)->get();
        $cat_arabic=CategoryLanguage::find($cat_lang[0]['id']);
        $cat_arabic->name=$request->name;
        $cat_arabic->save();
        $cat_english=CategoryLanguage::find($cat_lang[1]['id']);
        $cat_english->name=$request->englishname;
        $cat_english->save();
        return redirect('/admin/category')->with('update', 'category Update successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category=Category::find($id);
        $category->destroy($id);
        return redirect('/admin/category')->with('delete', 'Categore deleted successfully');
    }

}
