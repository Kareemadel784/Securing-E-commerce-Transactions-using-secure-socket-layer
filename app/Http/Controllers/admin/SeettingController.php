<?php

namespace App\Http\Controllers\admin;

use App\Seetting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SeettingRequest;

class SeettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $seetting = Seetting::all();
        return view('cpanel.seetting.index', compact('seetting'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

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
        $seetting=Seetting::find($id);
        return view('cpanel.seetting.edit',compact('seetting'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SeettingRequest $request, $id)
    {
        $seetting=Seetting::find($id);
        $seetting->telephone = $request->telephone ;
        $seetting->facebook= $request->facebook;
        $seetting->twitter= $request->twitter;
        $seetting->email= $request->email;
        $seetting->aboutapplication= $request->aboutapplication;
        $seetting->save();
        if ($seetting->save() == TRUE) {
            return redirect('admin/seetting')->with('update', 'Price Update successfully');
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
