@extends('layouts.websitlayout')
@section('title')
    {{trans('app.home')}}
@endsection

@section('header')

@endsection
@section('content')

    <!-- Page item Area -->
    <div id="page_item_area">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 text-left">
                    <h3>Shop Details</h3>
                </div>

                <div class="col-sm-6 text-right">
                    <ul class="p_items">
                        <li><a href="{{url('/')}}">{{trans('app.home')}}</a></li>
                        <li><a href="">{{trans('app.cat')}}</a></li>
                        <li><span>{{trans('app.product')}}</span></li>
                    </ul>
                </div>



            </div>
        </div>
    </div>

    <!-- Product Details Area  -->
    <div class="prdct_dtls_page_area">
        <div class="container">
            <div class="row">
                <!-- Product Details Image -->
                <div class="col-md-6 col-xs-12">
                    <div class="pd_img fix">
                        <a class="venobox" href="img/product/3.jpg"><img src="{{url('storage/app/'.$images1[0]['image'])}}" alt=""/></a>
                    </div>
                </div>
                <!-- Product Details Content -->
                <div class="col-md-6 col-xs-12">
                    <div class="prdct_dtls_content">
                        <a class="pd_title" href="#">{{$product[0]->name}}</a>
                        <div class="pd_price_dtls fix">
                            <!-- Product Price -->
                            <div class="pd_price"> <?php
                                $offer=$product[0]->offer;
                                $discount=($product[0]->price*$offer)/100;
                                ?>
                                <span class="new">$ {{$product[0]->price-$discount}}</span>

                                <span class="old">{{$product[0]->price}}</span>
                            </div>
                            <!-- Product Ratting -->
                            <div class="pd_ratng">
                                {{--<div class="rtngs">--}}
                                    {{--<i class="fa fa-star"></i>--}}
                                    {{--<i class="fa fa-star"></i>--}}
                                    {{--<i class="fa fa-star"></i>--}}
                                    {{--<i class="fa fa-star"></i>--}}
                                    {{--<i class="fa fa-star-half-o"></i>--}}
                                {{--</div>--}}
                            </div>
                        </div>
                        <div class="pd_text">
                            <p>{{$product[0]->descreption}}</p>
                        </div>
                        <!-- Product Action -->
                        <div class="pd_btn fix">
                            <a class="btn btn-default acc_btn" href="{{url('addtocart',$product[0]->id)}}">{{trans('app.addtocart')}}</a>
                            {{--<a class="btn btn-default acc_btn btn_icn"><i class="fa fa-heart"></i></a>--}}
                        </div>
                        {{--<div class="pd_share_area fix">--}}
                            {{--<h4>share this on:</h4>--}}
                            {{--<div class="pd_social_icon">--}}
                                {{--<a class="facebook" href="#"><i class="fa fa-facebook"></i></a>--}}
                                {{--<a class="twitter" href="#"><i class="fa fa-twitter"></i></a>--}}
                                {{--<a class="vimeo" href="#"><i class="fa fa-vimeo"></i></a>--}}
                                {{--<a class="google_plus" href="#"><i class="fa fa-google-plus"></i></a>--}}
                                {{--<a class="tumblr" href="#"><i class="fa fa-tumblr"></i></a>--}}
                                {{--<a class="pinterest" href="#"><i class="fa fa-pinterest"></i></a>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    </div>
                </div>
            </div>

        </div>
    </div>


    <!-- Related Product Area -->
    <div class="related_prdct_area text-center">
        <div class="container">
            <!-- Section Title -->
            <div class="rp_title text-center"><h3>Related products</h3></div>
            <div class="row">
                @for($i=0;$i<count($allproducts);$i++)
                  <div class="col-lg-3 col-md-4 col-sm-6">
                      <div class="single_product">
                          <div class="product_image">
                              <a href="{{url('/productdetials',$allproducts[$i]['id'])}}">
                                  <img  src="{{url('storage/app/'.$allproducts[$i]['image'])}}" style="height: 240px " alt=""/>
                              </a>
                              <div class="box-content">
                                  <a  href="{{url('addtocart',$allproducts[$i]['id'])}}"><i class="fa fa-cart-plus"></i></a>
                              </div>
                          </div>
                          <div class="product_btm_text">
                              <h4><a href="{{url('/productdetials',$allproducts[$i]['id'])}}">{{$allproducts[$i]['name']}}</a></h4>
                              <span class="price">{{$allproducts[$i]['price']}} جنيه</span>
                          </div>
                      </div>
                  </div>
                @endfor
            </div>
        </div>
    </div>

@endsection