<?php

namespace App\Http\Controllers\admin;

use App\Captin;
use App\Client;
use App\Order;
use App\OrderProduct;
use App\Price;
use App\Product;
use App\ProductImage;
use App\ProductLanguage;
use App\Village;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;
use Carbon;
class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lang=Session::get('locale');
        $allsendorder=array();
      //  $order=Order::select('id','totalprice','stutas','created_at')->where('stutas',0)->get();
        $order = DB::table('orders')
            ->join('clients', 'clients.id', '=', 'orders.client_id')
            ->where('orders.stutas',0)
            ->select('orders.*','clients.name as client_name','clients.telephone as client_telephone')
            ->get();
        for ($i=0;$i<count($order);$i++)
        {
            $productinorder = DB::table('order_products')
                ->join('product_languages', 'product_languages.product_id', '=', 'order_products.product_id')
                ->join('products', 'products.id', '=', 'order_products.product_id')
                ->join('category_languages', 'category_languages.categore_id', '=', 'products.categore_id')
                ->where('order_products.order_id',$order[$i]->id)
                ->select('product_languages.name','order_products.quentety','category_languages.name as category_name')
                ->where('category_languages.language_id',$lang)
                ->where('product_languages.language_id',$lang)
                ->get();
            $allsendorder[$i]['id']=$order[$i]->id;
            $allsendorder[$i]['totalprice']=$order[$i]->totalprice;
            $allsendorder[$i]['client_name']=$order[$i]->client_name;
            $allsendorder[$i]['client_telephone']=$order[$i]->client_telephone;
            $allsendorder[$i]['stutas']=$order[$i]->stutas;
            $allsendorder[$i]['created_at']=$order[$i]->created_at;
            $allsendorder[$i]['product']=$productinorder;
        }
        return view('cpanel.order.index', compact('allsendorder'));
    }
    public function accepted()
    {
        $lang=Session::get('locale');
        $allsendorder=array();
        $order = DB::table('orders')
            ->join('clients', 'clients.id', '=', 'orders.client_id')
            ->where('orders.stutas',1)
            ->select('orders.*','clients.name as client_name','clients.telephone as client_telephone')
            ->get();
        for ($i=0;$i<count($order);$i++)
        {
            $productinorder = DB::table('order_products')
                ->join('product_languages', 'product_languages.product_id', '=', 'order_products.product_id')
                ->join('products', 'products.id', '=', 'order_products.product_id')
                ->join('category_languages', 'category_languages.categore_id', '=', 'products.categore_id')
                ->where('order_products.order_id',$order[$i]->id)
                ->select('product_languages.name','order_products.quentety','category_languages.name as category_name')
                ->where('category_languages.language_id',$lang)
                ->where('product_languages.language_id',$lang)
                ->get();
            $allsendorder[$i]['id']=$order[$i]->id;
            $allsendorder[$i]['totalprice']=$order[$i]->totalprice;
            $allsendorder[$i]['client_name']=$order[$i]->client_name;
            $allsendorder[$i]['client_telephone']=$order[$i]->client_telephone;
            $allsendorder[$i]['stutas']=$order[$i]->stutas;
            $allsendorder[$i]['created_at']=$order[$i]->created_at;
            $allsendorder[$i]['product']=$productinorder;
        }
        return view('cpanel.order.accepted', compact('allsendorder'));
    }
    public function inway()
    {
        $lang=Session::get('locale');
        $allsendorder=array();
        $order = DB::table('orders')
            ->join('clients', 'clients.id', '=', 'orders.client_id')
            ->where('orders.stutas',2)
            ->select('orders.*','clients.name as client_name','clients.telephone as client_telephone')
            ->get();
        for ($i=0;$i<count($order);$i++)
        {
            $productinorder = DB::table('order_products')
                ->join('product_languages', 'product_languages.product_id', '=', 'order_products.product_id')
                ->join('products', 'products.id', '=', 'order_products.product_id')
                ->join('category_languages', 'category_languages.categore_id', '=', 'products.categore_id')
                ->where('order_products.order_id',$order[$i]->id)
                ->select('product_languages.name','order_products.quentety','category_languages.name as category_name')
                ->where('category_languages.language_id',$lang)
                ->where('product_languages.language_id',$lang)
                ->get();
            $allsendorder[$i]['id']=$order[$i]->id;
            $allsendorder[$i]['totalprice']=$order[$i]->totalprice;
            $allsendorder[$i]['client_name']=$order[$i]->client_name;
            $allsendorder[$i]['client_telephone']=$order[$i]->client_telephone;
            $allsendorder[$i]['stutas']=$order[$i]->stutas;
            $allsendorder[$i]['created_at']=$order[$i]->created_at;
            $allsendorder[$i]['product']=$productinorder;
        }
        return view('cpanel.order.inway', compact('allsendorder'));
    }
    public function finish()
    {
        $lang=Session::get('locale');
        $allsendorder=array();
        $order = DB::table('orders')
            ->join('clients', 'clients.id', '=', 'orders.client_id')
            ->where('orders.stutas',3)
            ->select('orders.*','clients.name as client_name','clients.telephone as client_telephone')
            ->get();
        for ($i=0;$i<count($order);$i++)
        {
            $productinorder = DB::table('order_products')
                ->join('product_languages', 'product_languages.product_id', '=', 'order_products.product_id')
                ->join('products', 'products.id', '=', 'order_products.product_id')
                ->join('category_languages', 'category_languages.categore_id', '=', 'products.categore_id')
                ->where('order_products.order_id',$order[$i]->id)
                ->select('product_languages.name','order_products.quentety','category_languages.name as category_name')
                ->where('category_languages.language_id',$lang)
                ->where('product_languages.language_id',$lang)
                ->get();
            $allsendorder[$i]['id']=$order[$i]->id;
            $allsendorder[$i]['totalprice']=$order[$i]->totalprice;
            $allsendorder[$i]['client_name']=$order[$i]->client_name;
            $allsendorder[$i]['client_telephone']=$order[$i]->client_telephone;
            $allsendorder[$i]['stutas']=$order[$i]->stutas;
            $allsendorder[$i]['created_at']=$order[$i]->created_at;
            $allsendorder[$i]['product']=$productinorder;
        }
        return view('cpanel.order.finish', compact('allsendorder'));
    }
    public function filterorder(Request $request)
    {
        $lang=Session::get('locale');
        $mytime = Carbon\Carbon::now()->format("y-m-d");
        if ($request->start !='')
        {
            $start=$request->start;
        }
        else
        {
            $start=$mytime;
        }
        if ($request->end !='')
        {
            $end=$request->end;
        }
        else
        {
            $end=$mytime;
        }
        $allsendorder=array();
        if ($request->stutas !='')
        {
            $order = DB::table('orders')
                ->join('clients', 'clients.id', '=', 'orders.client_id')
                ->where('orders.stutas',$request->stutas)
                -> whereRaw('DATE(orders.created_at) >= ?', [$start])
                -> whereRaw('DATE(orders.created_at) <= ?', [$end])
                ->select('orders.*','clients.name as client_name','clients.telephone as client_telephone')
                ->get();
        }
        else
        {
            $order = DB::table('orders')
                ->join('clients', 'clients.id', '=', 'orders.client_id')
                -> whereRaw('DATE(orders.created_at) >= ?', [$start])
                -> whereRaw('DATE(orders.created_at) <= ?', [$end])
                ->select('orders.*','clients.name as client_name','clients.telephone as client_telephone')
                ->get();
        }
        $total=0;
        for ($i=0;$i<count($order);$i++)
        {

            $productinorder = DB::table('order_products')
                ->join('product_languages', 'product_languages.product_id', '=', 'order_products.product_id')
                ->join('products', 'products.id', '=', 'order_products.product_id')
                ->join('category_languages', 'category_languages.categore_id', '=', 'products.categore_id')
                ->where('order_products.order_id',$order[$i]->id)
                ->select('product_languages.name','order_products.quentety','category_languages.name as category_name')
                ->where('category_languages.language_id',$lang)
                ->where('product_languages.language_id',$lang)
                ->get();
            $total+=$order[$i]->totalprice;
            $allsendorder[$i]['id']=$order[$i]->id;
            $allsendorder[$i]['totalprice']=$order[$i]->totalprice;
            $allsendorder[$i]['client_name']=$order[$i]->client_name;
            $allsendorder[$i]['client_telephone']=$order[$i]->client_telephone;
            $allsendorder[$i]['stutas']=$order[$i]->stutas;
            $allsendorder[$i]['created_at']=$order[$i]->created_at;
            $allsendorder[$i]['product']=$productinorder;
        }
        return view('cpanel.order.filter', compact('allsendorder','total'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $lang=Session::get('locale');
        $client=Client::all();
        $captin=Captin::all();
        $product = DB::table('products')
            ->join('product_languages', 'product_languages.product_id', '=', 'products.id')
            ->select('products.*', 'product_languages.name','product_languages.product_id as product_id')
            ->where('product_languages.language_id',$lang)
            ->get();
        $price = DB::table('prices')
        ->join('village_languages', 'village_languages.village_id', '=', 'prices.village_id')
        ->select('prices.*', 'village_languages.village','village_languages.village_id as village_id')
        ->where('village_languages.language_id',$lang)
        ->get();
        return view('cpanel.order.add',compact('client','product','price','captin'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
   //     return $request->all();
      $message ="تم ارسال طلبك بنجاح " ;
      $content = array(
    			"en" => $message
    			);
          $hashes_array = array();
          array_push($hashes_array, array(
              "id" => "like-button-2",
              "text" => "Like2",
              "url" => "http://elkhodarymasr.com/admin/order"
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
        $product=$request->product;
        $order=new Order();
        $order->client_id=$request->client_id;
        $order->captin_id=$request->captin_id;
        $order->address=$request->address;
        $order->village_id=$request->village_id;
        $order->totalprice=0;
        $order->save();
        $cost=Price::select('price')->where('village_id',$order->village_id)->first();
        $totalprice=$cost['price'];
        $order_id=$order->id;
        for ($i=0;$i<count($product);$i++)
        {
            $offer=($request->price[$i]*$request->offer[$i])/100;
            $order_product=new OrderProduct();
            $order_product->order_id=$order_id;
            $order_product->product_id=$product[$i];
            $order_product->quentety=$request->que[$i];
            $order_product->save();
            $totalprice+=($request->price[$i]*$request->que[$i])-$offer;
        }
        $orders=Order::find($order_id);
        $orders->totalprice=$totalprice;
        $orders->save();
        return redirect('/admin/order')->with('add', 'Add client successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        $order = DB::table('orders')
            ->join('clients', 'clients.id', '=', 'orders.client_id')
            ->join('villages', 'villages.id', '=', 'orders.village_id')
            ->join('areas', 'areas.id', '=', 'villages.area_id')
            ->join('goves', 'goves.id', '=', 'areas.gove_id')
            ->where('orders.id',$id)
            ->select('orders.*','clients.name as client_name','villages.vaillage','areas.area','goves.gove','clients.telephone as client_telephone')
            ->get();
        $product = DB::table('order_products')
            ->join('products', 'products.id', '=', 'order_products.product_id')
            ->join('categories', 'categories.id', '=', 'products.categore_id')
            ->where('order_products.order_id',$order[0]->id)
            ->select('products.name','products.id','products.price','order_products.quentety','order_products.created_at','categories.name as category_name')
            ->get();
        for ($i=0;$i<count($product);$i++)
        {
            $images=ProductImage::select('image')->where('product_id',$product[$i]->id)->first();
            $products[$i]['id']=$product[$i]->id;
            $products[$i]['name']=$product[$i]->name;
            $products[$i]['quentety']=$product[$i]->quentety;
            $products[$i]['price']=$product[$i]->price;
            $products[$i]['category_name']=$product[$i]->category_name;
            $products[$i]['created_at']=$product[$i]->created_at;
            $products[$i]['image']=$images['image'];
        }
        return view('cpanel.order.show', compact('order','products'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

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

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = Order::find($id);
        $order->destroy($id);
        return redirect('/admin/order')->with('delete', 'product deleted successfully');
    }
    public function acceptorder(Request $request)
    {
        $id= $request->cheackbox;
        for ($i=0;$i<count($id);$i++)
        {
             $order=Order::find($id[$i]);
            $order->stutas=1;
            $order->save();
            ////////////   send notification for user  /////////////
            $message="تم قبول طلبك بنجاح طلبك الان في التجهيز ";
            $client=Client::find($order->client_id);
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
            // $product = DB::table('order_products')
            //     ->join('products', 'products.id', '=', 'order_products.product_id')
            //     ->where('order_products.order_id',$order->id)
            //     ->select('products.count','products.id','order_products.quentety')->get();
            // for ($i=0;$i<count($product);$i++)
            // {
            //     $prod=Product::find($product[$i]->id);
            //     $prod->count=$prod->count-$product[$i]->quentety;
            //     $prod->save();
            // }
        }
        return redirect('admin/order')->with('acceptedorder', 'accepted order successfully');
    }
    public function finishorder(Request $request)
    {
        $id= $request->cheackbox;
        for ($i=0;$i<count($id);$i++)
        {
             $order=Order::find($id[$i]);
            $order->stutas=3;
            $order->save();
            $message="تم تسليم طلبك بنجاح شكرا لاستخدامكم الخضري المصري";
            $client=Client::find($order->client_id);
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
        }
        return redirect()->back()->with('finish', 'accepted order successfully');
    }
    public function inwayorder(Request $request)
    {
        $id= $request->cheackbox;
        for ($i=0;$i<count($id);$i++)
        {
             $order=Order::find($id[$i]);
            $order->stutas=2;
            $order->save();
            $message="تم تجهيز طلبك بنجاح";
            $client=Client::find($order->client_id);
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
        }
        return redirect()->back()->with('inway', 'accepted order successfully');
    }
    public function collectorder()
    {
      $collectorder=array();
      $productinorder = DB::table('order_products')
                        ->join('orders', 'orders.id', '=', 'order_products.order_id')
                        ->join('products', 'products.id', '=', 'order_products.product_id')
                        ->selectRaw('sum(quentety) as total,product_id')
                          ->where('orders.stutas',1)
                        ->groupBy('order_products.product_id')
                        ->get();
                    //    dd($productinorder[0]->product_id);
      for ($i=0; $i <count($productinorder) ; $i++)
      {
        $pro=Product::select('name')->where('id',$productinorder[$i]->product_id)->first();
        $collectorder[$i]['product_name']=$pro['name'];
        $collectorder[$i]['que']=$productinorder[$i]->total;
      }
    //  return $collectorder;
      return view('cpanel.order.collectorder', compact('collectorder'));
    }
    public function prinorder($id)
    {
      $order = DB::table('orders')
          ->join('clients', 'clients.id', '=', 'orders.client_id')
          ->join('villages', 'villages.id', '=', 'orders.village_id')
          ->join('areas', 'areas.id', '=', 'villages.area_id')
          ->join('goves', 'goves.id', '=', 'areas.gove_id')
          ->where('orders.id',$id)
          ->select('orders.*','clients.name as client_name','villages.vaillage','areas.area','goves.gove','clients.telephone as client_telephone')
          ->get();
      $product = DB::table('order_products')
          ->join('products', 'products.id', '=', 'order_products.product_id')
          ->join('categories', 'categories.id', '=', 'products.categore_id')
          ->where('order_products.order_id',$order[0]->id)
          ->select('products.name','products.id','products.price','order_products.quentety','order_products.created_at','categories.name as category_name')
          ->get();
      for ($i=0;$i<count($product);$i++)
      {
          $images=ProductImage::select('image')->where('product_id',$product[$i]->id)->first();
          $products[$i]['id']=$product[$i]->id;
          $products[$i]['name']=$product[$i]->name;
          $products[$i]['quentety']=$product[$i]->quentety;
          $products[$i]['price']=$product[$i]->price;
          $products[$i]['category_name']=$product[$i]->category_name;
          $products[$i]['created_at']=$product[$i]->created_at;
          $products[$i]['image']=$images['image'];
      }
      return view('cpanel.order.prinorder', compact('order','products'));
    }

}
