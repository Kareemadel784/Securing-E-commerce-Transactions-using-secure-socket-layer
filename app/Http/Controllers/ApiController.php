<?php

namespace App\Http\Controllers;

use App\Adv;
use App\Cart;
use App\Category;
use App\Client;
use App\Favirate;
use App\Order;
use App\OrderProduct;
use App\ProductImage;
use App\Village;
use App\Vistor;
use App\About;
use Illuminate\Http\Request;
use DB;

class ApiController extends Controller
{
    public function Registration(Request $request)
    {
        $client=Client::where('telephone',$request->telephone)
            ->first();
        if ($client)
        {
            return response()->json(['Status' => 'error', 'message' => 'user already exsist  tray agin failed to registration'], 200);
        }
        else {
            $client = new Client();
            $client->name = $request->name;
            $client->email = $request->email;
            $client->password = sha1($request->password);
            $client->telephone = $request->telephone;
            $client->device_id =$request->device_id;
            $client->login =1;
            $client->save();
            if ($client) {
                return response()->json(['Status' => 'success', 'message' => $client], 200);
            } else {
                return response()->json(['Status' => 'error', 'message' => 'failed to registration'], 200);
            }
        }
    }
    public function updateprofile(Request $request)
    {
        $oldpassword=sha1($request->oldpassword);
        $id=$request->user_id;
        $client=Client::find($id);
        if($oldpassword == $client->password)
        {
            $client->name = $request->name;
            $client->email = $request->email;
            $client->password = sha1($request->password);
            $client->telephone = $request->telephone;
            $client->save();
            if ($client) {
                return response()->json(['Status' => 'success', 'message' => $client], 200);
            } else {
                return response()->json(['Status' => 'error', 'message' => 'failed to registration'], 200);
            }
        }
        else
        {
            return response()->json(['Status' => 'error', 'message' => 'old password not right'], 200);
        }
    }
    public function login(Request $request)
    {
        $telephone = $request->telephone;
        $password = sha1($request->password);
        $device_id = $request->device_id;
        if ($telephone == "" || $password == "" )
        {
            return response()->json('enter telephone or password   pleass !');
        }
        else
        {
            $login = Client::where('telephone','=',$telephone )->where('password','=',$password)->first();
            if ($login) {
                $login->device_id=$device_id;
                $login->login=1;
                $login->save();
                return response()->json(['Status' => 'success','message'=>$login],200);
            }
            else {
                return response()->json(['Status' => 'error','message'=>'telephone or password error'],200);
            }
        }
    }
    public function category()
    {
        $category=Category::all();
        $vistor=Vistor::find(1);
        $vistor->vistor_number=$vistor->vistor_number+1;
        $vistor->save();
        return response()->json(['Status' => 'success','message'=>$category],200);
    }
    public function advhome()
    {
        $adv=Adv::select('image')->where('place',0)->get();
        return response()->json(['Status' => 'success','message'=>$adv],200);
    }
    public function advproduct()
    {
        $adv=Adv::select('image')->where('place',1)->get();
        return response()->json(['Status' => 'success','message'=>$adv],200);
    }
    public function productincategory(Request $request)
    {
        $offset = $request->offset;
        $ActualValue = $offset * 10;
        $category_id=$request->category_id;
        $products=array();
        $product = DB::table('products')
            ->join('categories', 'categories.id', '=', 'products.categore_id')
            ->where('products.categore_id',$category_id)
            ->select('products.*','categories.name as category_name')
            ->skip($ActualValue)->take(10)
            ->get();
        for ($i=0;$i<count($product);$i++)
        {
            $images=ProductImage::select('image')->where('product_id',$product[$i]->id)->get();
            $products[$i]['id']=$product[$i]->id;
            $products[$i]['name']=$product[$i]->name;
            $products[$i]['descreption']=$product[$i]->descreption;
            $products[$i]['count']=$product[$i]->count;
            $products[$i]['price']=$product[$i]->price;
            $products[$i]['category_name']=$product[$i]->category_name;
            $products[$i]['created_at']=$product[$i]->created_at;
            $products[$i]['image']=$images;
        }
        return response()->json(['Status' => 'success','message'=>$products],200);
    }
    public function allprices()
    {
        $price = DB::table('prices')
            ->join('villages', 'villages.id', '=', 'prices.village_id')
            ->select('prices.*', 'villages.vaillage','villages.id as village_id')
            ->get();
        return response()->json(['Status' => 'success','message'=>$price],200);
    }
    public function order(Request $request)
    {
       // return $request->product[0]['id'];
        $product=$request->product;
        $order=new Order();
        $order->client_id=$request->client_id;
        $order->address=$request->address;
        $order->village_id=$request->village_id;
        $order->totalprice=$request->totalprice;
        $order->save();
        $order_id=$order->id;
        for ($i=0;$i<count($product);$i++)
        {
            $order_product=new OrderProduct();
            $order_product->order_id=$order_id;
            $order_product->product_id=$product[$i]['id'];
            $order_product->quentety=$product[$i]['quentety'];
            $order_product->save();
        }
        if ($order && $order_product)
        {
          $message ="تم ارسال طلب جديد " ;
          $content = array(
        			"en" => $message
        			);
      		$fields = array(
            'app_id' => "d8ad848d-18d0-4085-a594-996af5deff96",
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
          ////////////   send notification for user  /////////////
          $message="تم ارسال طلب ك بنجاح طلبك تحت المراجعه";
          $client=Client::find($request->client_id);
          $login=$client->login;
         if($login == 1)
         {
           $player_id=$client->device_id;
           $content = array(
             "en" => $message
             );
             $heading = array(
                "en" => "خضري مصر"
             );
           $fields = array(
             'app_id' => "d8ad848d-18d0-4085-a594-996af5deff96",
             'include_player_ids' => [$player_id],
             'data' => array("foo" => $message),
             'contents' => $content,
             'headings' => $heading
           );
           $fields = json_encode($fields);
           $ch = curl_init();
           curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
           curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
                                  'Authorization: Basic MTg0YjNhYTUtMjVkZi00MWFkLTlkMWMtMDIzMzM1ZThiNGQw'));
           curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
           curl_setopt($ch, CURLOPT_HEADER, FALSE);
           curl_setopt($ch, CURLOPT_POST, TRUE);
           curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
           curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
           $response = curl_exec($ch);
           curl_close($ch);
         }
            return response()->json(['Status' => 'success','message'=>'order send success'],200);
        }
        else
        {
            return response()->json(['Status' => 'error','message'=>'faield to send order'],200);
        }
    }
    public function Addtofav(Request $request)
    {
        $fav=Favirate::where('client_id',$request->client_id)->where('product_id',$request->product_id)->first();
        if ($fav)
        {
            return response()->json(['Status' => 'error','message'=>'this product already exsist in favirate'],200);
        }
        else
        {
            $fav=new Favirate();
            $fav->client_id=$request->client_id;
            $fav->product_id=$request->product_id;
            $fav->save();
            return response()->json(['Status' => 'success','message'=>'product add to favirate success'],200);
        }
    }
    public function deletefavirate(Request $request)
    {
        $client_id=$request->client_id;
        $product_id=$request->id;
        $fav=Favirate::where('product_id',$product_id)->first();
        $fav->destroy($fav['id']);
        return response()->json(['Status' => 'success','message'=>'product in favirate deleted  success'],200);
    }
    public function allfavirateforuser(Request $request)
    {
       $products=array();
        $offset = $request->offset;
        $ActualValue = $offset * 10;
        $client_id=$request->client_id;
        $product = DB::table('favirates')
            ->join('products', 'products.id', '=', 'favirates.product_id')
            ->join('categories', 'categories.id', '=', 'products.categore_id')
            ->where('favirates.client_id',$client_id)
            ->select('products.*','categories.name as category_name')
            ->skip($ActualValue)->take(10)
            ->get();
        for ($i=0;$i<count($product);$i++)
        {
            $images=ProductImage::select('image')->where('product_id',$product[$i]->id)->get();
            $products[$i]['id']=$product[$i]->id;
            $products[$i]['name']=$product[$i]->name;
            $products[$i]['descreption']=$product[$i]->descreption;
            $products[$i]['count']=$product[$i]->count;
            $products[$i]['price']=$product[$i]->price;
            $products[$i]['category_name']=$product[$i]->category_name;
            $products[$i]['created_at']=$product[$i]->created_at;
            $products[$i]['image']=$images;
        }
        return response()->json(['Status' => 'success','message'=>$products],200);
    }
    public function allorderforuser(Request $request)
    {
        $offset = $request->offset;
        $ActualValue = $offset * 10;
        $allproduct=array();
        $client_id=$request->client_id;
        $order=Order::where('client_id',$request->client_id)
            ->skip($ActualValue)->take(10)
            ->get();
        for ($i=0;$i<count($order);$i++)
        {
            $productinorder=OrderProduct::select('quentety','product_id')->where('order_id',$order[$i]['id'])->get();
            $allproduct[$i]['id']=$order[$i]['id'];
            $allproduct[$i]['address']=$order[$i]['address'];
            $allproduct[$i]['totalprice']=$order[$i]['totalprice'];
            $allproduct[$i]['stutas']=$order[$i]['stutas'];
            $allproduct[$i]['created_at']=$order[$i]['created_at'];
            $allproduct[$i]['countproduct']=count($productinorder);
            $allproduct[$i]['quentety']=$productinorder[0]['quentety'];
        }
        return response()->json(['Status' => 'success','message'=>$allproduct],200);
    }
    public function allproductinorder(Request $request)
    {
        $order_id=$request->order_id;
        $products=array();
        $product = DB::table('products')
            ->join('order_products', 'order_products.product_id', '=', 'products.id')
            ->join('categories', 'categories.id', '=', 'products.categore_id')
            ->where('order_products.order_id',$order_id)
            ->select('products.*','order_products.quentety','categories.name as category_name')
            ->get();
        for ($i=0;$i<count($product);$i++)
        {
            $images=ProductImage::select('image')->where('product_id',$product[$i]->id)->get();
            $products[$i]['id']=$product[$i]->id;
            $products[$i]['name']=$product[$i]->name;
            $products[$i]['descreption']=$product[$i]->descreption;
            $products[$i]['quentety']=$product[$i]->quentety;
            $products[$i]['count']=$product[$i]->count;
            $products[$i]['price']=$product[$i]->price;
            $products[$i]['category_name']=$product[$i]->category_name;
            $products[$i]['created_at']=$product[$i]->created_at;
            $products[$i]['image']=$images;
        }
        return response()->json(['Status' => 'success','message'=>$products],200);
    }
    // $allsendorder = DB::table('order_products')
    //           ->selectRaw('quentety,count(*) as total')
    //           ->groupBy('quentety')
    //           ->get();
    public function search(Request $request)
    {
        $offset = $request->offset;
        $ActualValue = $offset * 10;
        $search=$request->search;
        $products=array();
        $product = DB::table('products')
            ->join('categories', 'categories.id', '=', 'products.categore_id')
            ->where('products.name', 'LIKE', "%$search%")
            ->orwhere('products.descreption', 'LIKE', "%$search%")
            ->select('products.*','categories.name as category_name')
            ->skip($ActualValue)->take(10)
            ->get();
        for ($i=0;$i<count($product);$i++)
        {
            $images=ProductImage::select('image')->where('product_id',$product[$i]->id)->get();
            $products[$i]['id']=$product[$i]->id;
            $products[$i]['name']=$product[$i]->name;
            $products[$i]['descreption']=$product[$i]->descreption;
            $products[$i]['count']=$product[$i]->count;
            $products[$i]['price']=$product[$i]->price;
            $products[$i]['category_name']=$product[$i]->category_name;
            $products[$i]['created_at']=$product[$i]->created_at;
            $products[$i]['image']=$images;
        }
        if ($products)
        {
            return response()->json(['Status' => 'success','message'=>$products],200);
        }
        else
        {
            return response()->json(['Status' => 'error','message'=>'ther is no search result'],200);
        }
    }
    public function logout(Request $request)
    {
      $client_id=$request->client_id;
      $client=Client::find($client_id);
      $client->login=0;
      $client->save();
      return response()->json(['Status' => 'success','message'=>'تم تسجيل الخروج بنجاح'],200);
    }
    public function About()
    {
      $about=About::select('website')->first();
      return response()->json(['Status' => 'success','message'=> $about]);
    }
    public function Contactus()
    {
      $contact=About::select('telephone','email','facebook','website')->first();
      return response()->json(['Status' => 'success','message'=> $contact]);
    }
}
