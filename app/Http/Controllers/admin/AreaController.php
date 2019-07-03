<?php

namespace App\Http\Controllers\admin;

use App\Area;
use App\AreaLanguage;
use App\Gove;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;
use Illuminate\Support\Facades\Validator;

class AreaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lang=Session::get('locale');
        $area = DB::table('areas')
            ->join('gove_languages', 'gove_languages.gove_id', '=', 'areas.gove_id')
            ->join('area_languages', 'area_languages.area_id', '=', 'areas.id')
            ->select('areas.id as ids','area_languages.*','gove_languages.gove')
            ->where('area_languages.language_id',$lang)
            ->where('gove_languages.language_id',$lang)
            ->get();
        return view('cpanel.area.index',compact('area'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $lang=Session::get('locale');
        $gove = DB::table('goves')
            ->join('gove_languages', 'gove_languages.gove_id', '=', 'goves.id')
            ->select('goves.id as ids','gove_languages.*')
            ->where('gove_languages.language_id',$lang)
            ->get();
        return view('cpanel.area.add',compact('gove'));
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
            'area'=>'required',
            'areaenglish'=>'required',
            'gove_id'=>'required|numeric',
        ])->validate();
        $area=new Area();
        $area->gove_id=$request->input('gove_id');
        $area->save();
        $area_id=$area->id;
        $area_language=new AreaLanguage();
        $area_language->area=$request->area;
        $area_language->language_id=1;
        $area_language->area_id=$area_id;
        $area_language->save();
        $area_language=new AreaLanguage();
        $area_language->area=$request->areaenglish;
        $area_language->language_id=2;
        $area_language->area_id=$area_id;
        $area_language->save();
        return redirect('/admin/area')->with('success', 'Add Area successfully');
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
        $area=Area::find($id);
        $area->destroy($id);
        return redirect('/admin/area')->with('delete', 'Area deleted successfully');
    }

}
