@extends('layouts.websitlayout')
@section('title')
    {{trans('app.home')}}
@endsection

@section('header')

@endsection
@section('content')
    <!-- Start Slider Area -->
    <section id="slider_area" class="text-center">
        <div class="slider_active owl-carousel" style="direction: ltr">
            @foreach($adv as $advs)
                <div class="single_slide" style="background-image: url(storage/app/{{$advs->image}}); background-size: cover; background-position: center;">
                </div>
            @endforeach
        </div>
    </section>
    <!-- End Slider Area -->

    <!--  Promo ITEM STRAT  -->
    <section id="promo_area" class="section_padding">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="section_title">
                        <h2>{{trans('app.imp')}}  <span>{{trans('app.offer')}}</span></h2>
                        <div class="divider"></div>
                    </div>
                </div>
            </div>
            <div class="row">
            @for($i=0;$i<count($products);$i++)
                  <div class="col-lg-4 col-md-6 col-sm-12">
                    <a href="{{url('/productdetials',$products[$i]['id'])}}">
                        <div class="single_promo">
                            <img src="{{url('storage/app/'.$products[$i]['image'])}}" alt="" style="height: 260px;">
                            <div class="box-content">
                                <h3 class="title">{{(int)$products[$i]['offer']}} %</h3>
                                <span class="post"> {{$products[$i]['name']}} </span>
                                <span class="post"> {{$products[$i]['category_name']}} </span>
                            </div>
                        </div>
                    </a>
                </div>
                @endfor
            </div>
        </div>
    </section>
    <!--  Promo ITEM END -->


    <!-- Start product Area -->
    <section id="product_area" class="section_padding">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="section_title">
                        <h2>{{trans('app.our')}} <span>{{trans('app.products')}}</span></h2>
                        <div class="divider"></div>
                    </div>
                </div>
            </div>

            <div class="text-center">
                <div class="product_filter">
                    <ul>
                        <li class=" active filter" data-filter="all">ALL</li>
                        @for($i=0;$i<count($category);$i++)
                            <li class="filter" data-filter=".{{$category[$i]->name}}">{{$category[$i]->name}}</li>
                        @endfor
                    </ul>
                </div>

                <div class="product_item">
                    <div class="row">
                        @for($i=0;$i<count($allproducts);$i++)
                            @if($i<8)
                           <div class="col-lg-3 col-md-4 col-sm-6 mix {{$allproducts[$i]['category_name']}}">
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
                                       <div class="p_rating">
                                           <i class="fa fa-star"></i>
                                           <i class="fa fa-star"></i>
                                           <i class="fa fa-star"></i>
                                           <i class="fa fa-star"></i>
                                           <i class="fa fa-star"></i>
                                       </div>
                                       <span class="price">{{$allproducts[$i]['offer']}} {{trans('app.pound')}}</span>
                                   </div>
                               </div>
                        </div>
                            @endif
                        @endfor
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End product Area -->

    <!-- Special Offer Area -->
    <div class="special_offer_area gray_section">
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <div class="special_img text-left">
                        <img src="{{url('storage/app/'.$products[0]['image'])}}" width="370" alt="" class="img-responsive">
                        <span class="off_baudge text-center">{{(int)$products[0]['offer']}} %<br /> on</span>
                    </div>
                </div>

                <div class="col-md-7 text-left">
                    <div class="special_info">
                        <h3>{{$products[0]['name']}}</h3>
                        <p>{{$products[0]['descreption']}}</p>
                        <a href="{{url('productdetials',$allproducts[0]['id'])}}" class="btn main_btn">Shop Now</a>
                    </div>
                </div>
            </div>

        </div>
    </div> <!-- End Special Offer Area -->

    <!-- Start Featured product Area -->
    <section id="featured_product" class="featured_product_area section_padding">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="section_title">
                        <h2>{{trans('app.product')}} <span> {{trans('app.imp')}}</span></h2>
                        <div class="divider"></div>
                    </div>
                </div>
            </div>

            <div class="row text-center">
                @for($i=0;$i<count($allproducts);$i++)
                    @if($i<8 && $allproducts[$i]['pinding']==1)
                         <div class="col-lg-3 col-md-4 col-sm-6">
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
                                         <a  href="{{url('addtocart',$allproducts[$i]['id'])}}"><i class="fa fa-cart-plus"></i></a>
                                     </div>
                                 </div>
                                 <div class="product_btm_text">
                                     <h4><a href="{{url('productdetials',$allproducts[$i]['id'])}}">{{$allproducts[$i]['name']}}</a></h4>
                                     <div class="p_rating">
                                         <i class="fa fa-star"></i>
                                         <i class="fa fa-star"></i>
                                         <i class="fa fa-star"></i>
                                         <i class="fa fa-star"></i>
                                         <i class="fa fa-star"></i>
                                     </div>
                                     <span class="price">{{$allproducts[$i]['offer']}} {{trans('app.pound')}}</span>
                                 </div>
                             </div>
                        </div>
                    @endif
                @endfor
            </div>
        </div>
    </section>
@endsection