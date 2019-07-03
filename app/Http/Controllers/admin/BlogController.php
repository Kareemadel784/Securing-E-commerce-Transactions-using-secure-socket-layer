<?php

namespace App\Http\Controllers\admin;

use App\Blog;
use App\BlogLanguage;
use App\Category;
use App\ImageBlog;
use App\Keyword;
use App\SubCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use File;
use Auth;
use Session;
use Illuminate\Support\Facades\Validator;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lang=Session::get('locale');
       $blog = DB::table('blogs')
        ->join('blog_languages', 'blog_languages.blog_id', '=', 'blogs.id')
        ->select('blogs.id as ids','blogs.image','blog_languages.*')
        ->where('blog_languages.language_id',$lang)
        ->get();
        return view('cpanel.blog.index',compact('blog'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cpanel.blog.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $request->all();
        Validator::make($request->all(), [
            'title'=>'required',
            'englishtitle'=>'required',
            'descreption'=>'required',
            'englishdescreption'=>'required',
            'image'=>'required',
        ])->validate();
        $blog=new Blog();
        $file = $request->image;
        if ($request->hasFile('image')) {
            $extension = $file->getClientOriginalExtension();
            $name = sha1($file->getClientOriginalName());
            $imgname = date('y-m-d') . $name . "." . $extension;
            $path = storage_path('app/blog/');
            $file->move($path, $imgname);
            $blog->image = 'blog'.'/'.$imgname;
        }
        $blog->save();
        $id=$blog->id;
        $bloglang=new BlogLanguage();
        $bloglang->title=$request->title;
        $bloglang->descreption=$request->descreption;
        $bloglang->language_id=1;
        $bloglang->blog_id=$id;
        $bloglang->save();
        $bloglang=new BlogLanguage();
        $bloglang->title=$request->englishtitle;
        $bloglang->descreption=$request->englishdescreption;
        $bloglang->language_id=2;
        $bloglang->blog_id=$id;
        $bloglang->save();
        return redirect('/admin/blog')->with('success', 'Add blog successfully');
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
      //  $blog=Blog::find($id);
        $blog = DB::table('blogs')
            ->join('blog_languages', 'blog_languages.blog_id', '=', 'blogs.id')
            ->select('blogs.id as ids','blog_languages.*')
            ->where('blog_languages.blog_id',$id)
            ->get();
        return view('cpanel.blog.edit',compact('blog'));
    }

    /**
     * Update the specified resource in storagereturn
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Validator::make($request->all(), [
            'title'=>'required',
            'englishtitle'=>'required',
            'descreption'=>'required',
            'englishdescreption'=>'required',
        ])->validate();
        $blog=Blog::find($id);
        $file = $request->image;
        if ($request->hasFile('image'))
        {
            $image_path = "storage/app/" . $blog['image'];  // Value is not URL but directory file path
            if (File::exists($image_path)) {
                File::delete($image_path);
            }
            $extension = $file->getClientOriginalExtension();
            $name = sha1($file->getClientOriginalName());
            $imgname = date('y-m-d') . $name . "." . $extension;
            $path = storage_path('app/blog/');
            $file->move($path, $imgname);
            $blog->image = 'blog'.'/'.$imgname;
        }
        $blog_id=$blog->id;
        $blog_lang=BlogLanguage::where('blog_id',$blog_id)->get();
        $blog_arabic=BlogLanguage::find($blog_lang[0]['id']);
        $blog_arabic->title=$request->title;
        $blog_arabic->descreption=$request->descreption;
        $blog_arabic->save();
        $blog_english=BlogLanguage::find($blog_lang[1]['id']);
        $blog_english->title=$request->englishtitle;
        $blog_english->descreption=$request->englishdescreption;
        $blog_english->save();
        return redirect('/admin/blog')->with('update', 'blog Update successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $blog=Blog::find($id);
        $image_path = "storage/app/" . $blog['image'];  // Value is not URL but directory file path
        if (File::exists($image_path)) {
            File::delete($image_path);
        }
        $blog->destroy($id);
        return redirect('/admin/blog')->with('delete', 'Blog deleted successfully');
    }

}
