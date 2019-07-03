<?php

namespace App\Http\Controllers\admin;

use App\Category;
use App\SubCategory;
use App\SubCategoryLanguage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;
use Illuminate\Support\Facades\Validator;

class SubcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lang=Session::get('locale');
        $subcategory = DB::table('sub_categories')
                            ->join('category_languages', 'category_languages.categore_id', '=', 'sub_categories.categore_id')
                            ->join('sub_category_languages', 'sub_category_languages.subcategore_id', '=', 'sub_categories.id')
                            ->select('sub_categories.id as subcat_id','sub_category_languages.subcategory_name','category_languages.name as category_name','category_languages.language_id as categorylanguage')
                            ->where('sub_category_languages.language_id',$lang)
                            ->where('category_languages.language_id',$lang)
                            ->get();
        return view('cpanel.subcategory.index',compact('subcategory'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $lang=Session::get('locale');
        $category = DB::table('categories')
            ->join('category_languages', 'category_languages.categore_id', '=', 'categories.id')
            ->select('categories.id as ids','category_languages.*')
            ->where('category_languages.language_id',$lang)
            ->get();
        return view('cpanel.subcategory.add',compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    //    return $request->all();
        Validator::make($request->all(), [
            'subcategory_name'=>'required',
            'subcategory_nameenglish'=>'required',
            'categore_id'=>'required|numeric',
        ])->validate();
        $subcategory=new SubCategory();
        $subcategory->categore_id=$request->input('categore_id');
        $subcategory->save();
        $subcategory_id=$subcategory->id;
        $subcategory_lang=new SubCategoryLanguage();
        $subcategory_lang->subcategory_name=$request->subcategory_name;
        $subcategory_lang->language_id=1;
        $subcategory_lang->subcategore_id=$subcategory_id;
        $subcategory_lang->save();
        $subcategory_lang=new SubCategoryLanguage();
        $subcategory_lang->subcategory_name=$request->subcategory_nameenglish;
        $subcategory_lang->language_id=2;
        $subcategory_lang->subcategore_id=$subcategory_id;
        $subcategory_lang->save();
        return redirect('/admin/subcategory')->with('success', 'Add subcategory successfully');
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
        $lang=Session::get('locale');
        $category = DB::table('categories')
                        ->join('category_languages', 'category_languages.categore_id', '=', 'categories.id')
                        ->select('category_languages.*')
                        ->where('category_languages.language_id',$lang)
                        ->get();
        $subcategory = DB::table('sub_categories')
                        ->join('sub_category_languages', 'sub_category_languages.subcategore_id', '=', 'sub_categories.id')
                        ->select('sub_categories.id as ids','sub_categories.categore_id as categore_id','sub_category_languages.*')
                        ->where('sub_categories.id',$id)
                        ->get();
        return view('cpanel.subcategory.edit',compact('category','subcategory'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
     //   return $request->all();
        $subcategory=SubCategory::find($id);
        $subcategory->categore_id=$request->input('categore_id');
        $subcategory->save();
        $subcategory_id=$subcategory->id;
         $subcat_lang=SubCategoryLanguage::where('subcategore_id',$subcategory_id)->get();
        $subcat_arabic=SubCategoryLanguage::find($subcat_lang[0]['id']);
        $subcat_arabic->subcategory_name=$request->subcategory_name;
        $subcat_arabic->save();
        $subcat_english=SubCategoryLanguage::find($subcat_lang[1]['id']);
        $subcat_english->subcategory_name=$request->subcategory_nameenglish;
        $subcat_english->save();
        return redirect('/admin/subcategory')->with('update', 'category Update successfully');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subcategory=SubCategory::find($id);
        $subcategory->destroy($id);
        return redirect('/admin/subcategory')->with('delete', 'Categore deleted successfully');
    }
}
