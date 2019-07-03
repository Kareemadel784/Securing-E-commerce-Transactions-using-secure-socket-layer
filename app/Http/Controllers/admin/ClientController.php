<?php

namespace App\Http\Controllers\admin;

use App\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;


class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $client=Client::all();
        return view('cpanel.client.index',compact('client'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cpanel.client.add');
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
            'email'=>'required|unique:clients',
            'password'=>'required',
            'telephone'=>'required|unique:clients|regex:/(01)[0-9]{9}/'
        ])->validate();
        $client = new Client();
        $client->name = $request->name;
        $client->email = $request->email;
        $client->password = sha1($request->password);
        $client->telephone = $request->telephone;
        $client->save();
        return redirect('/admin/client')->with('add', 'Add client successfully');
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
        $client=Client::find($id);
        return view('cpanel.client.edit',compact('client'));
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
        $client=Client::find($id);
        $client->name = $request->name;
        $client->email = $request->email;
        $client->password = sha1($request->password);
        $client->telephone = $request->telephone;
        $client->save();
        return redirect('/admin/client')->with('update', 'Client Update successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $client=Client::find($id);
        $client->destroy($id);
        return redirect('/admin/client')->with('delete', 'client deleted successfully');
    }

}
