@extends('layouts.websitlayout')
@section('title')
    {{trans('app.cart')}}
@endsection

@section('header')

@endsection
@section('content')

    <!-- Page item Area -->
    <div id="page_item_area">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 text-left">
                    <h3>Cart</h3>
                </div>

                <div class="col-sm-6 text-right">
                    <ul class="p_items">
                        <li><a href="{{url('/')}}">{{trans('app.home')}}</a></li>
                        <li><span>    {{trans('app.cart')}}</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Cart Page -->
    <div class="cart_page_area">
        <div class="container">
            @if (count($allproducts) >0)
            <div class="row">

                <div class="col-sm-12">
                    <div class="cart_table_area table-responsive">
                        <table class="table cart_prdct_table text-center">
                            <thead>
                            <tr>
                                <th class="cpt_no">{{trans('app.id')}}</th>
                                <th class="cpt_img">{{trans('app.image')}}</th>
                                <th class="cpt_pn">{{trans('app.productname')}}</th>
                                <th class="cpt_q">{{trans('app.quentiety')}}</th>
                                <th class="cpt_t">{{trans('app.totalprice')}}</th>
                                <th class="cpt_r">{{trans('app.delete')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $id=1; $totalprice=0; $price=0?>
                            @foreach($allproducts as $allproductss)
                                 <tr>
                                <td><span class="cp_no">{{$id}}</span></td>
                                <td><a href="{{url('productdetials',$allproductss['id'])}}" class="cp_img"><img src="{{url('storage/app/'.$allproductss['image'])}}" alt="" /></a></td>
                                <td><a href="{{url('productdetials',$allproductss['id'])}}" class="cp_title">{{$allproductss['name']}}</a></td>
                                <td>
                                    <div class="cp_quntty">
                                        <input name="quantity" value="{{$allproductss['quantity']}}" size="2" type="text" :type="number">
                                    </div>
                                </td>
                                <td><p class="cp_price">
                                        <?php $discount=($allproductss['price']*$allproductss['offer'])/100; ?>
                                        {{$price=$allproductss['price']-$discount}}
                                          جنيه</p></td>
                                <td><a class="btn btn-default cp_remove" href="{{url('deletecart',$allproductss['id'])}}"><i class="fa fa-trash"></i></a></td>
                            </tr>
                                <?php $id+=1;
                                $totalprice+=$price;
                                ?>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-md-8 col-xs-12 cart-actions cart-button-cuppon">

                        <form method="post" action="{{url('sendorderfromcart')}}" >

                            {{csrf_field()}}
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="cart-action">
                                        <button type="submit" class="btn border-btn" value="">{{trans('app.sendorder')}}</button>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="cart-action">
                                        <select name="village_id" required>
                                            @foreach($village as $village)
                                                <option value="{{$village->village_id}}">{{$village->village}}</option>
                                            @endforeach
                                        </select>
                                        <label>{{trans('app.village')}}</label>
                                    </div>

                                </div>
                                <div class="col-sm-3">
                                    <div class="cart-action">
                                        <input type="text" name="address" class="text-center" placeholder="{{trans('app.address')}}" required>
                                    </div>

                                </div>
                            </div>
                        </form>


                </div>

                <div class="col-md-4 col-xs-12 cart-checkout-process text-right">
                    <div class="wrap">
                        <h4><span>{{trans('app.totalprice')}}</span><span>{{ $totalprice }}</span></h4>
                    </div>
                </div>

            </div>
            @else
                <h1 class="text-center">لا توجد منتجات في السله </h1>
            @endif
        </div>
    </div>

@endsection