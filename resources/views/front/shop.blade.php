@extends('layouts.websitlayout')
@section('title')
    {{trans('app.category')}}
@endsection

@section('header')

@endsection
@section('content')

    <!-- Page item Area -->
    <div id="page_item_area">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 text-left">
                    <h3>Shop</h3>
                </div>

                <div class="col-sm-6 text-right">
                    <ul class="p_items">
                        <li><a href="{{url('/')}}">home</a></li>
                        <li><span>Shop</span></li>
                    </ul>
                </div>



            </div>
        </div>
    </div>


    <!-- Shop Product Area -->
    <div class="shop_page_area">
        <div class="container">


            <div class="shop_details text-center">
                <div class="row">
                    @for($i=0;$i<count($allproducts);$i++)
                        <div class="col-md-3 col-sm-6">
                            <div class="single_product">
                                    <div class="product_image">
                                        <a href="{{url('productdetials',$allproducts[$i]['id'])}}">
                                            <img src="{{url('storage/app/'.$allproducts[$i]['image'])}}" alt="" style="height: 200px">
                                        </a>
                                        <div class="new_badge">{{$allproducts[$i]['offer']}} %</div>
                                        <div class="box-content">
                                            @if($allproducts[$i]['favi'] == 0)
                                            <a href="{{url('addtofaivirate',$allproducts[$i]['id'])}}"><i class="fa fa-heart-o"></i></a>
                                            @else
                                            <a href="{{url('deletefaivrate',$allproducts[$i]['id'])}}"><i class="fa fa-heart"></i></a>
                                            @endif
                                                <a href="{{url('addtocart',$allproducts[$i]['id'])}}"><i class="fa fa-cart-plus"></i></a>
                                        </div>
                                    </div>
                                <div class="product_btm_text">
                                    <h4><a href="{{url('productdetials',$allproducts[$i]['id'])}}">{{$allproducts[$i]['name']}}</a></h4>
                                    {{--<div class="p_rating">--}}
                                        {{--<i class="fa fa-star"></i>--}}
                                        {{--<i class="fa fa-star"></i>--}}
                                        {{--<i class="fa fa-star"></i>--}}
                                        {{--<i class="fa fa-star"></i>--}}
                                        {{--<i class="fa fa-star"></i>--}}
                                    {{--</div>--}}
                                    <span class="price">{{$allproducts[$i]['offer']}} جنيه</span>
                                </div>
                            </div>
                        </div>
                    @endfor
                </div>
            </div>

            <!-- Blog Pagination -->
            <div class="col-xs-12">
                <div class="blog_pagination pgntn_mrgntp fix">
                    <div class="pagination text-center">
                        <ul>

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection