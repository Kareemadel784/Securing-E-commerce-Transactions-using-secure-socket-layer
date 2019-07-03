<?php

namespace App\Http\Controllers\admin;

use App\Price;
use App\Product;
use App\Village;
use App\VillageLanguage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use DB;
use Illuminate\Support\Facades\Validator;

class priceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lang=Session::get('locale');
       $price = DB::table('prices')
            ->join('village_languages', 'village_languages.village_id', '=', 'prices.village_id')
            ->select('prices.*', 'village_languages.village')
            ->where('village_languages.language_id',$lang)
            ->get();
        return view('cpanel.price.index', compact('price'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $lang=Session::get('locale');
        $vaillage = VillageLanguage::where('language_id',$lang)->get();
        return view('cpanel.price.add', compact('vaillage'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'price'=>'required',
            'village_id'=>'required|numeric',
        ])->validate();
        $price = new Price();
        $price->price = $request->input('price');
        $price->village_id = $request->input('village_id');
        $price->save();
        return redirect('/admin/price')->with('add', 'Add price successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $lang=Session::get('locale');
        $price = Price::find($id);
        $vaillage = VillageLanguage::where('language_id',$lang)->get();
        return view('cpanel.price.edit', compact('price','vaillage'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Validator::make($request->all(), [
            'price'=>'required',
            'village_id'=>'required|numeric',
        ])->validate();
        $price = Price::find($id);
        $price->price = $request->input('price');
        $price->village_id = $request->input('village_id');
        $price->save();
        return redirect('/admin/price')->with('update', 'price Update successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $price = Price::find($id);
        $price->destroy($id);
        return redirect('/admin/price')->with('delete', 'price deleted successfully');
    }
}