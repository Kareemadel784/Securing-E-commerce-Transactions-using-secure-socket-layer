<!DOCTYPE HTML>
<?php
$dir="ltf";
if(Session::get('locale') == 1)
{
    $dir="rtl";
}
else
{
    $dir="ltr";
}
?>
<html lang="en-US" dir="{{$dir}}">
<!-- Mirrored from www.getmasum.com/html-preview/fancyshop/ by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 18 Mar 2018 14:12:05 GMT -->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> @yield('title')</title>
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,500,600,700,800" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Handlee" rel="stylesheet">
    <link rel="stylesheet" href="{{url('resources/assets/websit/css/animate.css')}}">
    <link rel="stylesheet" href="{{url('resources/assets/websit/css/owl.theme.default.min.css')}}">
    <link rel="stylesheet" href="{{url('resources/assets/websit/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{url('resources/assets/websit/css/meanmenu.min.css')}}">
    <link rel="stylesheet" href="{{url('resources/assets/websit/css/venobox.css')}}">
    <link rel="stylesheet" href="{{url('resources/assets/websit/css/font-awesome.css')}}">
    <link rel="stylesheet" href="{{url('resources/assets/websit/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{url('resources/assets/websit/css/style.css')}}">
    <link rel="stylesheet" href="{{url('resources/assets/websit/css/css.css')}}">
    <link rel="stylesheet" href="{{url('resources/assets/websit/css/responsive.css')}}">
    @if(Session::get('locale') == 1)<?php Session::get('locale') ?>
      <link rel="stylesheet" href="{{url('resources/assets/websit/css/bootstrap-rtl.min.css')}}">
    @endif
    @yield('header')
</head>
<body>

<!--  Preloader  -->
<!--  Start Header  -->
<header id="header_area">
    <div class="header_top_area">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-6">
                    <div class="hdr_tp_left">
                        <div class="call_area">
                            <span class="single_con_add"><i class="fa fa-phone"></i> {{$about[0]->telephone}}</span>
                            <span class="single_con_add"><i class="fa fa-envelope"></i> {{$about[0]->email}}</span>
                        </div>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-6">
                    <ul class="hdr_tp_right text-right">
                        <li class="account_area"><a href="{{url('registrationform')}}"><i class="fa fa-lock"></i> {{trans('app.myaccount')}}</a></li>
                        <li class="">
                            <select  class="csub-menu" onchange="myFunction(this.value)">
                                <option value="1" <?php
                                    if(Session::get('locale') == 1)
                                        echo "selected";
                                    ?> >عربي</option>
                                <option <?php
                                        if(Session::get('locale') == 2)
                                            echo "selected";
                                        ?> value="2">English</option>
                            </select>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div> <!--  HEADER START  -->

    <div class="header_btm_area">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-3">
                    <a class="logo" href="{{url('/')}}"> <img alt="" src="{{url('resources/assets/websit/img/logo1111.png')}}"></a>
                </div><!--  End Col -->

                <div class="col-xs-12 col-sm-12 col-md-9 text-right">
                    <div class="menu_wrap">
                        <div class="main-menu">
                            <nav>
                                <ul>
                                    <li><a href="{{url('/')}}"> {{trans('app.home')}}</a>
                                    </li>

                                    <li><a href="">{{trans('app.cat')}} <i class="fa fa-angle-down"></i></a>
                                        <!-- Sub Menu -->
                                        <ul class="sub-menu">
                                            @for($i=0;$i<count($category);$i++)
                                                <li><a href="{{url('shop',$category[$i]->ids)}}">{{$category[$i]->name}}</a></li>
                                            @endfor
                                        </ul>
                                    </li>
                                    @if(Session::get('locale'))
                                        <li><a href="{{url('fav')}}">{{trans('app.fav')}}</a>
                                    @endif
                                    </li>
                                    <li><a href="{{url('about')}}">{{trans('app.about')}}</a></li>
                                    <li><a href="{{url('contact')}}">{{trans('app.contact')}}</a></li>
                                </ul>
                            </nav>
                        </div> <!--  End Main Menu -->

                        <div class="mobile-menu text-right ">
                            <nav>
                                <ul>
                                    <li><a href="{{url('/')}}">home</a></li>
                                    <li><a href="">{{trans('app.cat')}}</a>
                                        <!-- Sub Menu -->
                                        <ul>
                                            @for($i=0;$i<count($category);$i++)
                                                <li><a href="{{url('shop',$category[$i]->ids)}}">{{$category[$i]->name}}</a></li>
                                            @endfor
                                        </ul>
                                    </li>
                                    <li><a href="{{url('blog')}}">{{trans('app.blog')}}</a>
                                    </li>
                                    <li><a href="{{url('about')}}">{{trans('app.about')}}</a></li>
                                    <li><a href="{{url('contact')}}">{{trans('app.contact')}}</a></li>
                                </ul>
                            </nav>
                        </div> <!--  End mobile-menu -->

                        <div class="right_menu">
                            <ul class="nav justify-content-end">
                                <li>
                                    <div class="search_icon">
                                        <i class="fa fa-search search_btn" aria-hidden="true"></i>
                                        <div class="search-box">
                                            <form action="#" method="get">
                                                <div class="input-group">
                                                    <input type="text" class="form-control"  placeholder="enter keyword"/>
                                                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </li>

                                <li>
                                    <div class="cart_menu_area">
                                        <div class="cart_icon">
                                            <a href="{{url('cart')}}"><i class="fa fa-shopping-bag " aria-hidden="true"></i></a>
                                            <span class="cart_number">
                                                <?php 
                                                if(Session::get('cart'))
                                                {
                                                    echo count(Session::get('cart'));
                                                }
                                                else
                                                {
                                                    echo 0;
                                                }
                                                ?>
                                            </span>
                                        </div>
                                    </div>

                                </li>
                            </ul>
                        </div>
                    </div>
                </div><!--  End Col -->
            </div>
        </div>
    </div>
</header>
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (\Session::has('faildregistration'))
            <div class="col-xs-12">
                <div class="alert alert-success">
                    <button type="button" class="close pull-left" data-dismiss="alert">x</button>
                    <strong>فشل !</strong> فشل في انشاء الحساب
                </div>
            </div>
        @endif
        @if (\Session::has('deletetocart'))
                    <div class="col-xs-12">
                        <div class="alert alert-success">
                            <button type="button" class="close pull-left" data-dismiss="alert">x</button>
                            <strong>نجاح !</strong>تم الحذف بنجاح من السله
                        </div>
                    </div>
                @endif
        @if (\Session::has('sendorder'))
            <div class="col-xs-12">
                <div class="alert alert-success">
                    <button type="button" class="close pull-left" data-dismiss="alert">x</button>
                    <strong>نجاح !</strong> تم ارسال الطلب بنجاح
                </div>
            </div>
        @endif
        @if (\Session::has('registration'))
            <div class="col-xs-12">
                <div class="alert alert-success">
                    <button type="button" class="close pull-left" data-dismiss="alert">x</button>
                    <strong>نجاح  !</strong>  تم تسجيل الحساب بنجاح
                </div>
            </div>
        @endif
        @if (\Session::has('successlogin'))
            <div class="col-xs-12">
                <div class="alert alert-success">
                    <button type="button" class="close pull-left" data-dismiss="alert">x</button>
                    <strong>نجاح  !</strong>  تم تسجيل الدخول بنجاح
                </div>
            </div>
        @endif
        @if (\Session::has('faildlogin'))
            <div class="col-xs-12">
                <div class="alert alert-danger">
                    <button type="button" class="close pull-left" data-dismiss="alert">x</button>
                    <strong>نجاح !</strong> فشل في تسجيل الدخول
                </div>
            </div>
        @endif
        @if (\Session::has('addtofavirate'))
            <div class="col-xs-12">
                <div class="alert alert-success">
                    <button type="button" class="close pull-left" data-dismiss="alert">x</button>
                    <strong>نجاح !</strong> تم الاضافه الي  المفضله بنجاح
                </div>
            </div>
        @endif
        @if (\Session::has('deletefromfavirate'))
            <div class="col-xs-12">
                <div class="alert alert-success">
                    <button type="button" class="close pull-left" data-dismiss="alert">x</button>
                    <strong>نجاح !</strong> تم الحذف من   المفضله بنجاح
                </div>
            </div>
        @endif
        @if (\Session::has('faildlogin'))
            <div class="col-xs-12">
                <div class="alert alert-danger">
                    <button type="button" class="close pull-left" data-dismiss="alert">x</button>
                    <strong>فشل !</strong> من فضل قم بتسجيل الدخول
                </div>
            </div>
        @endif
        @if (\Session::has('addtocart'))
            <div class="col-xs-12">
                <div class="alert alert-success">
                    <button type="button" class="close pull-left" data-dismiss="alert">x</button>
                    <strong>نجاح !</strong> تم الاضافه الي  العربه بنجاح
                </div>
            </div>
        @endif
        @if (\Session::has('addedbefor'))
            <div class="col-xs-12">
                <div class="alert alert-success">
                    <button type="button" class="close pull-left" data-dismiss="alert">x</button>
                    <strong>نجاح !</strong> تم الاضافه الي  العربه من قبل
                </div>
            </div>
        @endif
        @if (\Session::has('succ'))
            <div class="col-xs-12">
                <div class="alert alert-success">
                    <button type="button" class="close pull-left" data-dismiss="alert">x</button>
                    <strong>نجاح !</strong> تم ارسال الرساله بنجاح
                </div>
            </div>
        @endif
@yield('content')

<footer class="footer_area">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-sm-6">
                <div class="single_ftr">
                    <h4 class="sf_title">{{trans('app.contact')}}</h4>
                    <ul>
                        <li>{{$about[0]->telephone}}</li>
                        <li>{{$about[0]->email}}</li>
                    </ul>
                </div>
            </div> <!--  End Col -->
            <div class="col-md-4 col-sm-6">
                <div class="single_ftr">
                    <h4 class="sf_title">{{trans('app.page')}}</h4>
                    <ul>
                        <li><a href="{{url('about')}}">{{trans('app.about')}}</a>
                        <li><a href="{{url('contact')}}">{{trans('app.contact')}}</a>
                    </ul>
                </div>
            </div> <!--  End Col -->
            <div class="col-md-4 col-sm-6">
                <div class="single_ftr">
                    <h4 class="sf_title">{{trans('app.about')}}</h4>
                    <div class="newsletter_form">
                        <p>{{$about[0]->aboutapplication}} </p>

                    </div>
                </div>
            </div> <!--  End Col -->

        </div>
    </div>


    <div class="ftr_btm_area">
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <div class="ftr_social_icon">
                        <ul>
                            <li><a href="{{$about[0]->facebook}}"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="{{$about[0]->twitter}}"><i class="fa fa-twitter"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-4">
                    <h1 class="copyright_text text-center"><a href="">&copy; Task</a></h1>
                </div>

                <div class="col-sm-4">

                </div>
            </div>
        </div>
    </div>
</footer>
<!--  FOOTER END  -->
<script src="{{url('resources/assets/websit/js/vendor/jquery-1.12.4.min.js') }}"></script>
<script src="{{url('resources/assets/websit/js/bootstrap.min.js') }}"></script>
<script src="{{url('resources/assets/websit/js/jquery.meanmenu.min.js') }}"></script>
<script src="{{url('resources/assets/websit/js/jquery.mixitup.js') }}"></script>
<script src="{{url('resources/assets/websit/js/jquery.counterup.min.js') }}"></script>
<script src="{{url('resources/assets/websit/js/waypoints.min.js') }}"></script>
<script src="{{url('resources/assets/websit/js/wow.min.js') }}"></script>
<script src="{{url('resources/assets/websit/js/venobox.min.js') }}"></script>
<script src="{{url('resources/assets/websit/js/owl.carousel.min.js') }}"></script>
<script src="{{url('resources/assets/websit/js/simplePlayer.js') }}"></script>
<script src="{{url('resources/assets/websit/js/main.js') }}"></script>
<script>
    function myFunction(val)
    {
        var locale1 = val;
        $.ajax({
            url: 'http://www.awshn.com/language',
            type: "GET",
            dataType: "json",
            data:{locale1:locale1},
            success: function (data)
            {

            },
            error: function (err) {
                console.log(err);
            },
            complete: function (data) {
                window.location.reload();
            }
        });
    }
</script>
@yield('footer')

</body>

<!-- Mirrored from www.getmasum.com/html-preview/fancyshop/ by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 18 Mar 2018 14:13:28 GMT -->
</html>