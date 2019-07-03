<?php

namespace App\Http\Controllers\admin;

use App\Adv;
use App\Advertisment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use File;

class AdvertismentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $adv=Adv::all();
        return view('cpanel.adv.index',compact('adv'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cpanel.adv.add');
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
        $adv=new Adv();
        $file = $request->image;
        if ($request->hasFile('image')) {
            $extension = $file->getClientOriginalExtension();
            $name = sha1($file->getClientOriginalName());
            $imgname = date('y-m-d') . $name . "." . $extension;
            $path = storage_path('app/adv/');
            $file->move($path, $imgname);
            $adv->image = 'adv'.'/'.$imgname;
        }
        $adv->place=$request->input('place');
        $adv->save();
        return redirect('/admin/adv')->with('add', 'Add Adv successfully');
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
        $adv=Adv::find($id);
        return view('cpanel.adv.edit',compact('adv'));
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
        $adv=Adv::find($id);
        $file = $request->image;
        if ($request->hasFile('image')) {
            $image_path = "storage/app/" . $adv['image'];  // Value is not URL but directory file path
            if (File::exists($image_path)) {
                File::delete($image_path);
            }
            $extension = $file->getClientOriginalExtension();
            $name = sha1($file->getClientOriginalName());
            $imgname = date('y-m-d') . $name . "." . $extension;
            $path = storage_path('app/adv/');
            $file->move($path, $imgname);
            $adv->image = 'adv'.'/'.$imgname;
        }
        $adv->place=$request->input('place');
        $adv->save();
        return redirect('/admin/adv')->with('update', 'category Update successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $adv=Adv::find($id);
        $image_path = "storage/app/" . $adv['image'];  // Value is not URL but directory file path
        if (File::exists($image_path)) {
            File::delete($image_path);
        }
        $adv->destroy($id);
        return redirect('/admin/adv')->with('delete', 'adv deleted successfully');
    }

}
