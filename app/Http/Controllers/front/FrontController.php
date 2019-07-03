<?php

namespace App\Http\Controllers\front;

use App\Adv;
use App\Blog;
use App\Cart;
use App\Client;
use App\Favirate;
use App\Message;
use App\Order;
use App\OrderProduct;
use App\Price;
use App\Product;
use App\ProductImage;
use App\Seetting;
use App\Testimonial;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use Cookie;
use DB;
use Illuminate\Support\Facades\Validator;

class FrontController extends Controller
{
    public function front()
    {
        $fav=0;
        $allproducts=array();
        $products=array();
        $adv=Adv::where('place',2)->get();
     //   $dogs = Dogs::orderBy('id', 'desc')->take(5)->get();
        $lang=Session::get('locale');
        $product = DB::table('products')
            ->join('product_languages', 'product_languages.product_id', '=', 'products.id')
            ->join('category_languages', 'category_languages.categore_id', '=', 'products.categore_id')
            ->select('products.*','product_languages.name','product_languages.descreption','category_languages.name as category_name')
            ->where('category_languages.language_id',$lang)
            ->where('product_languages.language_id',$lang)
            ->orderBy('products.offer', 'desc')
            ->take(3)->get();
        for ($i=0;$i<count($product);$i++)
        {
            $images=ProductImage::select('image')->where('product_id',$product[$i]->id)->first();
            $client_id=Session::get('login');
            $favi=Favirate::select('product_id')
                ->where('product_id',$product[$i]->id)
                ->where('client_id',$client_id['id'])
                ->first();
            if ($favi)
            {
                $fav=1;
            }
            else
            {
                $fav=0;
            }
            $products[$i]['id']=$product[$i]->id;
            $products[$i]['name']=$product[$i]->name;
            $products[$i]['descreption']=$product[$i]->descreption;
            $products[$i]['category_name']=$product[$i]->category_name;
            $products[$i]['created_at']=$product[$i]->created_at;
            $products[$i]['offer']=$product[$i]->offer;
            $products[$i]['favi']=$fav;
            $products[$i]['image']=$images['image'];
        }

        $category = DB::table('categories')
            ->join('category_languages', 'category_languages.categore_id', '=', 'categories.id')
            ->select('categories.id as ids','category_languages.*')
            ->where('category_languages.language_id',$lang)
            ->get();
        $product1 = DB::table('products')
            ->join('product_languages', 'product_languages.product_id', '=', 'products.id')
            ->join('category_languages', 'category_languages.categore_id', '=', 'products.categore_id')
            ->select('products.*','product_languages.name','product_languages.descreption','category_languages.name as category_name')
            ->where('category_languages.language_id',$lang)
            ->where('product_languages.language_id',$lang)
            ->orderBy('products.id', 'desc')
            ->get();
        for ($i=0;$i<count($product1);$i++)
        {
            $images=ProductImage::select('image')->where('product_id',$product1[$i]->id)->first();
            $client_id=Session::get('login');
            $favi=Favirate::select('product_id')
                ->where('product_id',$product1[$i]->id)
                ->where('client_id',$client_id['id'])
                ->first();
            if ($favi)
            {
                $fav=1;
            }
            else
            {
                $fav=0;
            }
            $allproducts[$i]['id']=$product1[$i]->id;
            $allproducts[$i]['name']=$product1[$i]->name;
            $allproducts[$i]['category_name']=$product1[$i]->category_name;
            $allproducts[$i]['created_at']=$product1[$i]->created_at;
            $allproducts[$i]['offer']=$product1[$i]->offer;
            $allproducts[$i]['pinding']=$product1[$i]->pinding;
            $allproducts[$i]['price']=$product1[$i]->price;
            $allproducts[$i]['image']=$images['image'];
            $allproducts[$i]['favi']=$fav;
        }
        $blog = DB::table('blogs')
            ->join('blog_languages', 'blog_languages.blog_id', '=', 'blogs.id')
            ->select('blogs.id as ids','blogs.image','blog_languages.*')
            ->where('blog_languages.language_id',$lang)
            ->take(3)->get();
        $testomanial=Testimonial::all();
        return view('front.index',compact('adv','products','allproducts','category','blog','testomanial'));
    }
    public function shop($id)
    {
        $fav=0;
        $lang=Session::get('locale');
        $allproducts=array();
        $product1 = DB::table('products')
            ->join('product_languages', 'product_languages.product_id', '=', 'products.id')
            ->join('category_languages', 'category_languages.categore_id', '=', 'products.categore_id')
            ->select('products.*','product_languages.name','product_languages.descreption','category_languages.name as category_name')
            ->where('category_languages.language_id',$lang)
            ->where('product_languages.language_id',$lang)
            ->where('products.categore_id',$id)
            ->orderBy('products.id', 'desc')
            ->get();
        for ($i=0;$i<count($product1);$i++)
        {
            $images=ProductImage::select('image')->where('product_id',$product1[$i]->id)->first();
            $client_id=Session::get('login');
            $favi=Favirate::select('product_id')
                ->where('product_id',$product1[$i]->id)
                ->where('client_id',$client_id['id'])
                ->first();
            if ($favi)
            {
                $fav=1;
            }
            else
            {
                $fav=0;
            }
            $allproducts[$i]['id']=$product1[$i]->id;
            $allproducts[$i]['name']=$product1[$i]->name;
            $allproducts[$i]['category_name']=$product1[$i]->category_name;
            $allproducts[$i]['created_at']=$product1[$i]->created_at;
            $allproducts[$i]['offer']=$product1[$i]->offer;
            $allproducts[$i]['pinding']=$product1[$i]->pinding;
            $allproducts[$i]['price']=$product1[$i]->price;
            $allproducts[$i]['image']=$images['image'];
            $allproducts[$i]['favi']=$fav;
        }
      //  return $allproducts;
        return view('front.shop',compact('allproducts'));
    }
    public function productdetials($id)
    {
        $allproducts=array();
        $lang=Session::get('locale');
        $product = DB::table('products')
            ->join('product_languages', 'product_languages.product_id', '=', 'products.id')
            ->join('category_languages', 'category_languages.categore_id', '=', 'products.categore_id')
            ->select('products.*','product_languages.name','product_languages.descreption','category_languages.name as category_name')
            ->where('category_languages.language_id',$lang)
            ->where('product_languages.language_id',$lang)
            ->where('products.id',$id)
            ->get();
        $images1=ProductImage::select('image')->where('product_id',$id)->get();
     // return $images[0]['image'];
        $product1 = DB::table('products')
            ->join('product_languages', 'product_languages.product_id', '=', 'products.id')
            ->join('category_languages', 'category_languages.categore_id', '=', 'products.categore_id')
            ->select('products.*','product_languages.name','product_languages.descreption','category_languages.name as category_name')
            ->where('category_languages.language_id',$lang)
            ->where('product_languages.language_id',$lang)
            ->where('products.categore_id',$product[0]->categore_id)
            ->orderBy('products.id', 'desc')
            ->get();
        for ($i=0;$i<count($product1);$i++)
        {
            $images=ProductImage::select('image')->where('product_id',$product1[$i]->id)->first();
            $allproducts[$i]['id']=$product1[$i]->id;
            $allproducts[$i]['name']=$product1[$i]->name;
            $allproducts[$i]['category_name']=$product1[$i]->category_name;
            $allproducts[$i]['created_at']=$product1[$i]->created_at;
            $allproducts[$i]['offer']=$product1[$i]->offer;
            $allproducts[$i]['pinding']=$product1[$i]->pinding;
            $allproducts[$i]['price']=$product1[$i]->price;
            $allproducts[$i]['image']=$images['image'];
        }
        return view('front.productdetials',compact('product','images1','allproducts'));
    }
    public function registrationform()
    {
        return view('front.registrationform');
    }
    public function Registration(Request $request)
    {
        Validator::make($request->all(), [
            'name'=>'required',
            'email'=>'required|unique:clients',
            'password'=>'required',
            'telephone'=>'required|regex:/(01)[0-9]{9}/|unique:clients'
        ])->validate();
        $client = new Client();
        $client->name = $request->name;
        $client->email = $request->email;
        $client->password = sha1($request->password);
        $client->telephone = $request->telephone;
        $client->login =1;
        $client->save();
        if ($client) {
            return redirect()->back()->with('registration', 'registration success');
        } else {
            return redirect()->back()->with('faildregistration', 'failed registration');
        }
    }
    public function loginclient(Request $request)
    {
        Validator::make($request->all(), [
            'password'=>'required',
            'telephone'=>'required'
        ])->validate();        $telephone = $request->telephone;
        $password = sha1($request->password);
        if ($telephone == "" || $password == "" )
        {
            return redirect()->back()->with('faildlogin', 'failed login');
        }
        else
        {
            $login = Client::where('telephone','=',$telephone )->where('password','=',$password)->first();
            if ($login) {
                Session::put('login', $login);
                // Session::get('login');
                return redirect('/')->with('successlogin', 'failed registration');
            }
            else {
                return redirect()->back()->with('faildlogin', 'failed login');
            }
        }
    }
    public function addtofaivirate($id)
    {
        if (Session::get('login'))
        {
             $client_id=Session::get('login');
            $fav=new Favirate();
            $fav->client_id=$client_id['id'];
            $fav->product_id=$id;
            $fav->save();
            return redirect()->back()->with('addtofavirate', 'add favirate success');
        }
        else
        {
            return redirect('/registrationform')->with('loginplease', 'login pleass');
        }
    }
    public function deletefaivrate($id)
    {
        if (Session::get('login'))
        {
            $client_id=Session::get('login');
            $fav=Favirate::where('client_id',$client_id['id'])->where('product_id',$id)->first();
            $fav->destroy($fav['id']);
            return redirect()->back()->with('deletefromfavirate', 'delete favirate success');
        }
        else
        {
            return redirect('/registrationform')->with('loginplease', 'login pleass');
        }
    }
    public function addtocart($id)
    {
       // Session::flush();
    //     dd( session()->get('cart'));
        $lang=Session::get('locale');

        $product = DB::table('products')
            ->join('product_languages', 'product_languages.product_id', '=', 'products.id')
            ->join('category_languages', 'category_languages.categore_id', '=', 'products.categore_id')
            ->select('products.*','product_languages.name','product_languages.descreption','category_languages.name as category_name')
            ->where('category_languages.language_id',$lang)
            ->where('products.id',$id)
            ->where('product_languages.language_id',$lang)
            ->orderBy('products.offer', 'desc')
            ->get();
    //    dd($product);
     //   $product = Product::find($id);
        if(!$product) {
            abort(404);
        }
        $cart = session()->get('cart');
        // if cart is empty then this the first product
        if(!$cart) {
            $images=ProductImage::select('image')->where('product_id',$product[0]->id)->first();
            $cart = [
                $id => [
                    "id" => $product[0]->id,
                    "name" => $product[0]->name,
                    "category_name" => $product[0]->category_name,
                    "offer" => $product[0]->offer,
                    "image" => $images['image'],
                    "price" => $product[0]->price,
                    "quantity" => 1,
                ]
            ];
            session()->put('cart', $cart);
            return redirect()->back()->with('addtocart', 'Product added to cart successfully!');
        }
        // if cart not empty then check if this product exist then increment quantity

        foreach ($cart as $carts)
        {
            if($carts['id'] == $id) {
                $cart[$id]['quantity']++;
                $cart[$id]['price']++;
                session()->put('cart', $cart);
                return redirect()->back()->with('addtocart', 'Product added to cart successfully!');
            }
        }
        // if item not exist in cart then add to cart with quantity = 1
        $images=ProductImage::select('image')->where('product_id',$product[0]->id)->first();
        $cart[$id] = [
            "id" => $product[0]->id,
            "name" => $product[0]->name,
            "category_name" => $product[0]->category_name,
            "offer" => $product[0]->offer,
            "image" => $images['image'],
            "price" => $product[0]->price,
            "quantity" => 1,
        ];
        session()->put('cart', $cart);
        return redirect()->back()->with('addtocart', 'add cart success');
    }
    public function cart()
    {
        $allproducts=session()->get('cart');
        return view('front.cart',compact('allproducts'));
    }
    public function deletecart($id)
    {
        $cart= session()->get('cart');
        unset($cart[$id]);
        session()->put('cart', $cart);
        return redirect()->back()->with('deletetocart', 'delete cart success');
    }
    public function sendorderfromcart(Request $request)
    {
      //  dd( $request->all());
        if (Session::get('login'))
        {
            $product= session()->get('cart');
            $login= session()->get('login');
            $message ="تم ارسال طلبك بنجاح " ;
            $content = array(
                "en" => $message
            );
            $hashes_array = array();
            array_push($hashes_array, array(
                "id" => "like-button-2",
                "text" => "Like2",
                "url" => "http://localhost/admin/order"
            ));
            $fields = array(
                'app_id' => "840f2936-ab8a-4db7-9f06-1ee126ab7384",
                'filters' =>array( array("field" => "tag", "key" => "type", "relation" => "=", "value" => "admin")),
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
            $totalprice=0;
            $order=new Order();
            $order->client_id=$login['id'];
            $order->captin_id=$request->captin_id;
            $order->address=$request->address;
            $order->village_id=$request->village_id;
            $order->totalprice=0;
            $order->save();
            $cost=Price::select('price')->where('village_id',$order->village_id)->first();
            $totalprice=$cost['price'];
            $order_id=$order->id;
            foreach ($product as $products)
            {
                $offer=($products['price']*$products['offer'])/100;
                $order_product=new OrderProduct();
                $order_product->order_id=$order_id;
                $order_product->product_id=$products['id'];
                $order_product->quentety=$products['quantity'];
                $order_product->save();
                $totalprice+=$products['price']-$offer;
            }
            $orders=Order::find($order_id);
            $orders->totalprice=$totalprice;
            $orders->save();
            Session::forget('cart');

            return redirect('/')->with('sendorder', ' sendorder success');

        }
        else
        {
            return redirect('/registrationform')->with('loginplease', 'login pleass');
        }

    }
    public function cartforuser()
    {

    }
    public function about()
    {
        return view('front.about');
    }
    public function contact()
    {
        return view('front.contact');
    }
    public function contactus(Request $request)
    {
        Validator::make($request->all(), [
            'name'=>'required',
            'email'=>'required',
            'descreption'=>'required',
            'telephone'=>'required|regex:/(01)[0-9]{9}/'
        ])->validate();
        $message =new Message();
        $message->name=$request->name;
        $message->email=$request->email;
        $message->telephone=$request->telephone;
        $message->descreption=$request->descreption;
        $message->save();
        return redirect()->back()->with('succ','sende message success');
    }
    public function allblog()
    {
        $lang=Session::get('locale');
        $blog = DB::table('blogs')
            ->join('blog_languages', 'blog_languages.blog_id', '=', 'blogs.id')
            ->select('blogs.id as ids','blogs.image','blog_languages.*')
            ->where('blog_languages.language_id',$lang)
            ->get();
      //  dd($blog);
        return view('front.blog',compact('blog'));
    }
    public function blogdetials($id)
    {
        $lang=Session::get('locale');
        $blog = DB::table('blogs')
            ->join('blog_languages', 'blog_languages.blog_id', '=', 'blogs.id')
            ->select('blogs.id as ids','blogs.image','blog_languages.*')
            ->where('blog_languages.language_id',$lang)
            ->where('blogs.id',$id)
            ->get();
       // dd($blog);
        return view('front.blogdetials',compact('blog'));

    }
    public function fav()
    {
        $lang=Session::get('locale');
         $client=Session::get('login');
        $allproducts=array();
        $product1 = DB::table('products')
            ->join('product_languages', 'product_languages.product_id', '=', 'products.id')
            ->join('favirates', 'favirates.product_id', '=', 'products.id')
            ->join('category_languages', 'category_languages.categore_id', '=', 'products.categore_id')
            ->select('products.*','product_languages.name','product_languages.descreption','category_languages.name as category_name')
            ->where('category_languages.language_id',$lang)
            ->where('product_languages.language_id',$lang)
            ->where('favirates.client_id',$client['id'])
            ->orderBy('products.id', 'desc')
            ->get();
      //  dd($product1);
        for ($i=0;$i<count($product1);$i++)
        {
            $images=ProductImage::select('image')->where('product_id',$product1[$i]->id)->first();
            $client_id=Session::get('login');
            $allproducts[$i]['id']=$product1[$i]->id;
            $allproducts[$i]['name']=$product1[$i]->name;
            $allproducts[$i]['category_name']=$product1[$i]->category_name;
            $allproducts[$i]['created_at']=$product1[$i]->created_at;
            $allproducts[$i]['offer']=$product1[$i]->offer;
            $allproducts[$i]['pinding']=$product1[$i]->pinding;
            $allproducts[$i]['price']=$product1[$i]->price;
            $allproducts[$i]['image']=$images['image'];
            $allproducts[$i]['favi']=1;
        }
        return view('front.fav',compact('allproducts'));

    }
}
