<?php

namespace App\Http\Controllers\admin;

use App\Gove;
use Session;
use App\GoveLanguage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Support\Facades\Validator;

class GoveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lang=Session::get('locale');
        //   $category=Category::all();
        $gove = DB::table('goves')
            ->join('gove_languages', 'gove_languages.gove_id', '=', 'goves.id')
            ->select('goves.id as ids','gove_languages.*')
            ->where('gove_languages.language_id',$lang)
            ->get();
        return view('cpanel.gove.index',compact('gove'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cpanel.gove.add');
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
            'gove'=>'required',
            'goveenglish'=>'required',
        ])->validate();
        $lang=Session::get('locale');
        $gove=new Gove();
        $gove->save();
        $gove_id=$gove->id;
        $govelang=new GoveLanguage();
        $govelang->gove=$request->input('gove');
        $govelang->language_id=1;
        $govelang->gove_id=$gove_id;
        $govelang->save();
        $govelang=new GoveLanguage();
        $govelang->gove=$request->input('goveenglish');
        $govelang->language_id=2;
        $govelang->gove_id=$gove_id;
        $govelang->save();
        return redirect('/admin/gove')->with('add', 'Add gove successfully');
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
       // $lang=Session::get('locale');
        $gove = DB::table('goves')
            ->join('gove_languages', 'gove_languages.gove_id', '=', 'goves.id')
            ->select('goves.id as ids','gove_languages.*')
            ->where('gove_languages.gove_id',$id)
            ->get();
        return view('cpanel.gove.edit',compact('gove'));
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
        Validator::make($request->all(), [
            'gove'=>'required',
            'goveenglish'=>'required',
        ])->validate();
        $gove=Gove::find($id);
        $gove_id=$gove->id;
        $gove_lang=GoveLanguage::where('gove_id',$gove_id)->get();
        $gove_arabic=GoveLanguage::find($gove_lang[0]['id']);
        $gove_arabic->gove=$request->gove;
        $gove_arabic->save();
        $gove_english=GoveLanguage::find($gove_lang[1]['id']);
        $gove_english->gove=$request->goveenglish;
        $gove_english->save();
        return redirect('/admin/gove')->with('update', 'Gove Update successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $gove=Gove::find($id);
        $gove->destroy($id);
        return redirect('/admin/gove')->with('delete', 'adv deleted successfully');
    }

}
