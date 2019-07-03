<?php

namespace App\Http\Controllers\admin;

use App\Category;
use App\Product;
use App\ProductImage;
use App\ProductLanguage;
use App\SubCategory;
use App\SubCategoryLanguage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use File;
use Session;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products=array();
//        $product = DB::table('products')
//            ->join('categories', 'categories.id', '=', 'products.categore_id')
//            ->select('products.*','categories.name as category_name')
//            ->get();
        $lang=Session::get('locale');
        $product = DB::table('products')
            ->join('product_languages', 'product_languages.product_id', '=', 'products.id')
            ->join('category_languages', 'category_languages.categore_id', '=', 'products.categore_id')
            ->select('products.*','product_languages.name','product_languages.descreption','category_languages.name as category_name')
            ->where('category_languages.language_id',$lang)
            ->where('product_languages.language_id',$lang)
            ->get();
        for ($i=0;$i<count($product);$i++)
        {
            $images=ProductImage::select('image')->where('product_id',$product[$i]->id)->first();
            $products[$i]['id']=$product[$i]->id;
            $products[$i]['name']=$product[$i]->name;
            $products[$i]['descreption']=$product[$i]->descreption;
            $products[$i]['count']=$product[$i]->count;
            $products[$i]['pricebuy']=$product[$i]->pricebuy;
            $products[$i]['price']=$product[$i]->price;
            $products[$i]['category_name']=$product[$i]->category_name;
            $products[$i]['pinding']=$product[$i]->pinding;
            $products[$i]['created_at']=$product[$i]->created_at;
            $products[$i]['image']=$images['image'];
        }
      //  return $products;
        return view('cpanel.product.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $lang=Session::get('locale');
        $category = DB::table('categories')
            ->join('category_languages', 'category_languages.categore_id', '=', 'categories.id')
            ->select('categories.id as ids','category_languages.*')
            ->where('category_languages.language_id',$lang)
            ->get();
        return view('cpanel.product.add',compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product=new Product();
        $product->count=$request->input('count');
        $product->pricebuy=$request->input('pricebuy');
        $product->price=$request->input('price');
        $product->categore_id=$request->input('categore_id');
        $product->subcategory_id=$request->input('subcategory_id');
        $product->offer=$request->input('offer');
        $product->save();
        $product_id=$product->id;
        $productlang=new ProductLanguage();
        $productlang->product_id=$product_id;
        $productlang->name=$request->name;
        $productlang->language_id=1;
        $productlang->descreption=$request->descreption;
        $productlang->save();
        $productlang=new ProductLanguage();
        $productlang->product_id=$product_id;
        $productlang->name=$request->productnameenglish;
        $productlang->language_id=2;
        $productlang->descreption=$request->productdescreptionenglish;
        $productlang->save();
        $allimages = $request->image;
        if ($request->hasFile('image')) {
            foreach ($allimages as $file) {
                $img=new ProductImage();
                $extension = $file->getClientOriginalExtension();
                $name = sha1($file->getClientOriginalName());
                $imgname = date('y-m-d') . $name . "." . $extension;
                $path = storage_path('app/product/');
                $file->move($path, $imgname);
                $img->image = 'product'.'/'.$imgname;
                $img->product_id=$product_id;
                $img->save();
            }
        }
        $message =" تم اضافه منتجات جديده ادخل علي الابليكاشن لمعرفه الاصناف الجديده " ;
        $content = array(
            "en" => $message
            );
        $fields = array(
          'app_id' => "840f2936-ab8a-4db7-9f06-1ee126ab7384",
          'filters' =>array( array("field" => "tag", "key" => "type", "relation" => "!=", "value" => "admin")),
          'data' => array("foo" => "bar"),
          'contents' => $content
        );
        $fields = json_encode($fields);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
                               'Authorization: Basic ZDRlZjZhMjMtZTk5My00OGY2LWI4NzMtMmNhZDY0ODJlNjRm'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        $response = curl_exec($ch);
        curl_close($ch);
        return redirect('/admin/product')->with('add', 'Add Adv successfully');
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
        $product = DB::table('products')
            ->join('product_languages', 'product_languages.product_id', '=', 'products.id')
            ->select('products.*','product_languages.name','product_languages.descreption')
            ->where('products.id',$id)
            ->get();
        $category = DB::table('categories')
            ->join('category_languages', 'category_languages.categore_id', '=', 'categories.id')
            ->select('category_languages.*')
            ->where('category_languages.language_id',$lang)
            ->get();
        $subcategory = DB::table('sub_categories')
            ->join('sub_category_languages', 'sub_category_languages.subcategore_id', '=', 'sub_categories.id')
            ->select('sub_categories.id as ids','sub_categories.categore_id as categore_id','sub_category_languages.*')
            ->where('sub_categories.id',$product[0]->subcategory_id)
            ->where('sub_category_languages.language_id',$lang)
            ->get();
        return view('cpanel.product.edit',compact('product','category','subcategory'));
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
    //    return $request->all();
        $product=Product::find($id);
        $product->count=$request->input('count');
        $product->pricebuy=$request->input('pricebuy');
        $product->price=$request->input('price');
        $product->categore_id=$request->input('categore_id');
        $product->subcategory_id=$request->input('subcategory_id');
        $product->save();
        $product_id= $product->id;
        $pr_lang=ProductLanguage::where('product_id',$product_id)->get();
        $productlanguage=ProductLanguage::find($pr_lang[0]['id']);
        $productlanguage->name=$request->name;
        $productlanguage->descreption=$request->descreption;
        $productlanguage->save();
        $productlanguage1=ProductLanguage::find($pr_lang[1]['id']);
        $productlanguage1->name=$request->productnameenglish;
        $productlanguage1->descreption=$request->productdescreptionenglish;
        $productlanguage1->save();
        $allimages = $request->image;
        if ($request->hasFile('image')) {
            $image = ProductImage::where('product_id', $id)->get();
            for ($i = 0; $i < count($image); $i++) {
                $image_path = "storage/app/" . $image[$i]['image'];  // Value is not URL but directory file path
                if (File::exists($image_path)) {
                    File::delete($image_path);
                }
                $im=ProductImage::find($image[$i]['id']);
                $im->destroy($image[$i]['id']);
            }
            foreach ($allimages as $file) {
                $img=new ProductImage();
                $extension = $file->getClientOriginalExtension();
                $name = sha1($file->getClientOriginalName());
                $imgname = date('y-m-d') . $name . "." . $extension;
                $path = storage_path('app/product/');
                $file->move($path, $imgname);
                $img->image = 'product'.'/'.$imgname;
                $img->product_id=$product_id;
                $img->save();
            }
        }
        return redirect('/admin/product')->with('update', 'category Update successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $image = ProductImage::where('product_id', $id)->get();
        for ($i = 0; $i < count($image); $i++) {
            $image_path = "storage/app/" . $image[$i]['image'];  // Value is not URL but directory file path
            if (File::exists($image_path)) {
                File::delete($image_path);
            }
        }
        $product->destroy($id);
        return redirect('/admin/product')->with('delete', 'product deleted successfully');
    }
    public function pindingproduct($id)
    {
        $product = Product::find($id);
        $product->pinding=0;
        $product->save();
        return redirect('/admin/product')->with('pinding', 'product pinding successfully');
    }
    public function activeproduct($id)
    {
        $product = Product::find($id);
        $product->pinding=1;
        $product->save();
        return redirect('/admin/product')->with('active', 'product pinding successfully');
    }
    public function subcategoryincategory($id)
    {
        $lang=Session::get('locale');
        $allmodel = DB::table('sub_categories')
            ->join('sub_category_languages', 'sub_category_languages.subcategore_id', '=', 'sub_categories.id')
            ->select('sub_category_languages.*')
            ->where('sub_categories.categore_id',$id)
            ->where('sub_category_languages.language_id',$lang)
            ->get();
        return json_encode($allmodel);
    }

}
