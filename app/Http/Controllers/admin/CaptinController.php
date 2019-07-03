<?php

namespace App\Http\Controllers\admin;

use App\Captin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CaptinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $captin=Captin::all();
        return view('cpanel.captin.index',compact('captin'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cpanel.captin.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //return $request->all();
        Validator::make($request->all(), [
            'name'=>'required',
            'email'=>'required|unique:captins',
            'password'=>'required',
            'telephone'=>'required|unique:captins|regex:/(01)[0-9]{9}/'
        ])->validate();
        $captin = new Captin();
        $captin->name = $request->name;
        $captin->email = $request->email;
        $captin->password = sha1($request->password);
        $captin->telephone = $request->telephone;
        $captin->save();
        return redirect('/admin/captin')->with('add', 'Add captin successfully');
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
        $captin=Captin::find($id);
        return view('cpanel.captin.edit',compact('captin'));
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
            'name'=>'required',
            'email'=>'required|unique:clients',
            'password'=>'required',
            'telephone'=>'required|unique:clients|regex:/(01)[0-9]{9}/'
        ])->validate();
        $captin=Captin::find($id);
        $captin->name = $request->name;
        $captin->email = $request->email;
        $captin->password = sha1($request->password);
        $captin->telephone = $request->telephone;
        $captin->save();
        return redirect('/admin/captin')->with('update', 'Client Update successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $captin=Captin::find($id);
        $captin->destroy($id);
        return redirect('/admin/captin')->with('delete', 'client deleted successfully');
    }

}