<?php

namespace App\Http\Controllers\admin;

use App\Area;
use App\Village;
use App\VillageLanguage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;
use Illuminate\Support\Facades\Validator;

class VillageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lang=Session::get('locale');
        $viallage = DB::table('villages')
            ->join('village_languages', 'village_languages.village_id', '=', 'villages.id')
            ->join('area_languages', 'area_languages.area_id', '=', 'villages.area_id')
            ->select('villages.id as ids','village_languages.*','area_languages.area')
            ->where('area_languages.language_id',$lang)
            ->where('village_languages.language_id',$lang)
            ->get();
        return view('cpanel.village.index',compact('viallage'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $lang=Session::get('locale');
        $area = DB::table('areas')
            ->join('area_languages', 'area_languages.area_id', '=', 'areas.id')
            ->select('areas.id as ids','area_languages.*')
            ->where('area_languages.language_id',$lang)
            ->get();
        return view('cpanel.village.add',compact('area'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
     //   return $request->all();
        Validator::make($request->all(), [
            'village'=>'required',
            'villageenglish'=>'required',
            'area_id'=>'required|numeric',
        ])->validate();
        $village=new Village();
        $village->area_id=$request->input('area_id');
        $village->save();
        $village_id=$village->id;
        $village_language=new VillageLanguage();
        $village_language->village=$request->village;
        $village_language->language_id=1;
        $village_language->village_id=$village_id;
        $village_language->save();
        $village_language=new VillageLanguage();
        $village_language->village=$request->villageenglish;
        $village_language->language_id=2;
        $village_language->village_id=$village_id;
        $village_language->save();

        return redirect('/admin/village')->with('success', 'Add village successfully');
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
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $village = Village::find($id);
        $village->destroy($id);
        return redirect('/admin/village')->with('delete', 'village deleted successfully');
    }
}