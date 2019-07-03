<?php

namespace App\Http\Controllers;

use App\Order;
use App\Product;
use App\Vistor;
use Illuminate\Http\Request;
use App\Client;
use App\User;
use App\Message;
use Carbon;
use Illuminate\Support\Facades\Validator;
use Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mytime = Carbon\Carbon::now()->format("y-m-d");
        $account=count(User::all());
        $client=count(Client::all());
        $product=count(Product::all());
        $order=count(Order::all());
        $vistors=Vistor::select('vistor_number')->first();
        $vistor=$vistors['vistor_number'];
        $orderday=count(Order::whereRaw('DATE(orders.created_at) >= ?', [$mytime])->get());
        return view('cpanel.home.home',compact('client','account','product','order','vistor','orderday'));
    }
    public function front()
    {
      return view('front.home.home0');
    }

    public function notfound()
    {
      return view('cpanel.home.notfound');
    }
    public function Changelang(Request $request)
    {
        $language= $request->locale1;
        Session::put('locale', $language);
        return response()->json(['Status' => 'success','message'=>$language],200);
    }
}
