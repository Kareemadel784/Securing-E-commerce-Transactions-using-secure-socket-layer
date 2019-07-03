<?php

namespace App\Http\Controllers\admin;

use App\Testimonial;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $testomanial=Testimonial::all();
        return view('cpanel.testomanial.index',compact('testomanial'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cpanel.testomanial.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $testomanial=new Testimonial();
        $file = $request->image;
        if ($request->hasFile('image')) {
            $extension = $file->getClientOriginalExtension();
            $name = sha1($file->getClientOriginalName());
            $imgname = date('y-m-d') . $name . "." . $extension;
            $path = storage_path('app/testomanial/');
            $file->move($path, $imgname);
            $testomanial->image = 'testomanial'.'/'.$imgname;
        }
        $testomanial->name=$request->input('name');
        $testomanial->opinion=$request->input('opinion');
        $testomanial->save();
        return redirect('/admin/testomanial')->with('add', 'Add testomanial successfully');
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
        $testomanial=Testimonial::find($id);
        return view('cpanel.testomanial.edit',compact('testomanial'));
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
        $testomanial=Testimonial::find($id);
        $file = $request->image;
        if ($request->hasFile('image')) {
            $image_path = "storage/app/" . $testomanial['image'];  // Value is not URL but directory file path
            if (File::exists($image_path)) {
                File::delete($image_path);
            }
            $extension = $file->getClientOriginalExtension();
            $name = sha1($file->getClientOriginalName());
            $imgname = date('y-m-d') . $name . "." . $extension;
            $path = storage_path('app/testomanial/');
            $file->move($path, $imgname);
            $testomanial->image = 'testomanial'.'/'.$imgname;
        }
        $testomanial->name=$request->input('name');
        $testomanial->opinion=$request->input('opinion');
        $testomanial->save();
        return redirect('/admin/testomanial')->with('update', 'testomanial Update successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $testomanial=Testimonial::find($id);
        $image_path = "storage/app/" . $testomanial['image'];  // Value is not URL but directory file path
        if (File::exists($image_path)) {
            File::delete($image_path);
        }
        $testomanial->destroy($id);
        return redirect('/admin/testomanial')->with('delete', 'testomanial deleted successfully');
    }
}
