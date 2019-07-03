<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{url('resources/assets/images/favicon.png')}}">
    <title> {{trans('app.home')}} | @yield('title')</title>
    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="{{url('resources/assets/plugins/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{url('resources/assets/plugins/css/bootstrap-wysihtml5.css')}}">
    <link rel="stylesheet" href="{{url('resources/assets/plugins/css/select2.min.css')}}">

    <!--This page css - Morris CSS -->
    <link rel="stylesheet" href="{{url('resources/assets/plugins/css/c3.min.css')}}">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{url('resources/assets/css/style.css')}}">
    <link rel="stylesheet" href="{{url('resources/assets/css/colors/blue.css')}}">
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <style>
        .sidebar-nav ul li a
        {
            /*color: #52B657;*/
        }
    </style>
    <!-- Custom CSS -->

    <script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async=""></script>
    <script>
        var OneSignal = window.OneSignal || [];
        OneSignal.push(function() {
            OneSignal.init({
                appId: "840f2936-ab8a-4db7-9f06-1ee126ab7384",
            });
            OneSignal.sendTags({type : 'admin'});
        });
    </script>
    @yield('header')
</head>

<body class="fix-header fix-sidebar card-no-border">

    <div id="main-wrapper">
        <header class="topbar" style="background: #14212A;">
            <nav class="navbar top-navbar navbar-expand-md navbar-light">
                <div class="navbar-header">
                    <a class="navbar-brand" href="{{url('/admin')}}">

                        <!--End Logo icon -->
                        <!-- Logo text --><span>
                             <!-- dark Logo text -->
                            <h1 style="color: #ffffff"> {{trans('app.application')}} </h1>
                        </span>
                    </a>
                            <!-- Light Logo text -->
                </div>
                <div class="navbar-collapse">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav mr-auto mt-md-0">
                        <!-- This is  -->
                        <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="mdi mdi-menu"></i></a> </li>
                        <li class="nav-item"> <a class="nav-link sidebartoggler hidden-sm-down text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="ti-menu"></i></a> </li>
                    </ul>
                    <ul class="navbar-nav my-lg-0">
                        <!-- ============================================================== -->
                        <!-- Comment -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted text-muted waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="mdi mdi-message"></i>
                                <div class="notify"> <span class="heartbit"></span> <span class="point"></span> </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right mailbox scale-up">
                                <ul>
                                    <li>
                                        <div class="drop-title">{{trans('app.notification')}}</div>
                                    </li>
                                    <li>
                                        <div class="message-center">
                                            <!-- Message -->
                                            <a href="#">
                                                <div class="btn btn-danger btn-circle"><i class="fa fa-link"></i></div>
                                                <div class="mail-contnet">
                                                    <h5>Luanch Admin</h5> <span class="mail-desc">Just see the my new admin!</span> <span class="time">9:30 AM</span> </div>
                                            </a>
                                            <a href="#">
                                                <div class="btn btn-primary btn-circle"><i class="ti-user"></i></div>
                                                <div class="mail-contnet">
                                                    <h5>Pavan kumar</h5> <span class="mail-desc">Just see the my admin!</span> <span class="time">9:02 AM</span> </div>
                                            </a>
                                        </div>
                                    </li>
                                    <li>
                                        <a class="nav-link text-center" href="javascript:void(0);"> <strong>Check all notifications</strong> <i class="fa fa-angle-right"></i> </a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="flag-icon flag-icon-eg"></i></a>
                            <div class="dropdown-menu dropdown-menu-right scale-up">
                                <a class="dropdown-item" href="#"><i class="flag-icon flag-icon-eg"></i> Ar</a>
                                <a class="dropdown-item" href="#"><i class="flag-icon flag-icon-us"></i> En</a>
                            </div>
                        </li>
                        <li>
                            <select  class="selected-language-nav" onchange="myFunction(this.value)">
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
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="{{url('resources/assets/images/users/1.jpg')}}" alt="user" class="profile-pic" /></a>
                            <div class="dropdown-menu dropdown-menu-right scale-up">
                                <ul class="dropdown-user">


                                    <li><a href="{{route('logout')}}"><i class="fa fa-power-off"></i> {{trans('app.logout')}}</a></li>
                                </ul>
                            </div>
                        </li>
                       {{--<li class="nav-item dropdown">--}}
                            {{--<a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="flag-icon flag-icon-us"></i></a>--}}
                            {{--<div class="dropdown-menu dropdown-menu-right scale-up"> <a class="dropdown-item" href="#"><i class="flag-icon flag-icon-in"></i> India</a> <a class="dropdown-item" href="#"><i class="flag-icon flag-icon-fr"></i> French</a> <a class="dropdown-item" href="#"><i class="flag-icon flag-icon-cn"></i> China</a> <a class="dropdown-item" href="#"><i class="flag-icon flag-icon-de"></i> Dutch</a> </div>--}}
                        {{--</li>--}}
                    </ul>
                </div>
            </nav>
        </header>
        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <div class="user-profile" style="background: url('resources/assets/images/background/user-info.jpg') no-repeat;">
                    <div class="profile-img"> <img src="{{url('resources/assets/websit/img/logo.png')}}" alt="user" /> </div>

                    <div class="profile-text"> <a href="#" class="text-center" role="button" aria-haspopup="true" aria-expanded="true">{{Auth::user()->name}}</a>

                    </div>
                </div>
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-gauge"></i><span class="hide-menu">{{trans('app.home')}} </span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="{{url('admin')}}">{{trans('app.show')}}</a></li>
                            </ul>
                        </li>
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-laptop-windows"></i><span class="hide-menu">{{trans('app.account')}} </span></a>
                            <ul aria-expanded="false" class="collapse">
                                <!-- {{--<li><a href="{{url('admin/permission')}}">الصلاحيات </a></li>--}} -->
                                <!-- <li><a href="{{url('admin/role')}}">القواعد</a></li> -->
                                <li><a href="{{url('admin/account')}}">{{trans('app.account')}} </a></li>
                                <li><a href="{{url('admin/client')}}">{{trans('app.client')}} </a></li>
                                <li><a href="{{url('admin/captin')}}">{{trans('app.captin')}} </a></li>
                            </ul>
                        </li>
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-laptop-windows"></i><span class="hide-menu">{{trans('app.product')}} </span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="{{url('admin/category')}}"> {{trans('app.category')}}</a></li>
                                <li><a href="{{url('admin/subcategory')}}">{{trans('app.subcategory')}}</a></li>
                                <li><a href="{{url('admin/product')}}"> {{trans('app.product')}}</a></li>
                            </ul>
                        </li>
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-laptop-windows"></i><span class="hide-menu">{{trans('app.order')}}</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="{{url('admin/order')}}"> {{trans('app.ordersend')}}</a></li>
                                <li><a href="{{url('admin/accepted')}}">  {{trans('app.acceptedorder')}}</a></li>
                                <li><a href="{{url('admin/inway')}}">{{trans('app.orderway')}}</a></li>
                                <li><a href="{{url('admin/finish')}}"> {{trans('app.finishorder')}}</a></li>
                            </ul>
                        </li>
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-laptop-windows"></i><span class="hide-menu">{{trans('app.adv')}}</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="{{url('admin/adv')}}"> {{trans('app.show')}}</a></li>
                            </ul>
                        </li>
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-laptop-windows"></i><span class="hide-menu">{{trans('app.report')}} </span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="{{url('admin/filterorder')}}"> {{trans('app.show')}}</a></li>
                            </ul>
                        </li>
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-laptop-windows"></i><span class="hide-menu">{{trans('app.placework')}} </span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="{{url('admin/gove')}}"> {{trans('app.gove')}}</a></li>
                                <li><a href="{{url('admin/area')}}">{{trans('app.area')}}</a></li>
                                <li><a href="{{url('admin/village')}}"> {{trans('app.village')}}</a></li>
                            </ul>
                        </li>
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-laptop-windows"></i><span class="hide-menu">{{trans('app.price')}} </span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="{{url('admin/price')}}"> {{trans('app.show')}}</a></li>
                            </ul>
                        </li>
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-laptop-windows"></i><span class="hide-menu">{{trans('app.notification')}} </span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="{{url('admin/shownotification')}}"> {{trans('app.show')}}</a></li>
                            </ul>
                        </li>
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-laptop-windows"></i><span class="hide-menu">{{trans('app.problem')}}</span></a>
                              <ul aria-expanded="false" class="collapse">
                                  <li><a href="{{url('admin/message')}}"> {{trans('app.show')}}</a></li>
                              </ul>
                          </li>
                    </ul>
                </nav>
            </div>
            <div class="sidebar-footer">
                <a href="{{route('logout')}}" class="link" data-toggle="tooltip" title="Logout"><i class="mdi mdi-power"></i></a>
            </div>
        </aside>
        <div class="page-wrapper">
            @yield('content')

            <footer class="footer text-center"> </footer>
        </div>
    </div>
    <script src="{{url('resources/assets/plugins/js/jquery.min.js') }}"></script>

    <script src="{{url('resources/assets/plugins/js/popper.min.js') }}"></script>
    <script src="{{url('resources/assets/plugins/js/bootstrap.min.js') }}"></script>

    <script src="{{url('resources/assets/js/jquery.slimscroll.js') }}"></script>
    <script src="{{url('resources/assets/js/waves.js') }}"></script>
    <script src="{{url('resources/assets/js/sidebarmenu.js') }}"></script>
    <script src="{{url('resources/assets/plugins/js/sticky-kit.min.js') }}"></script>
    <script src="{{url('resources/assets/plugins/js/jquery.sparkline.min.js') }}"></script>
    <script src="{{url('resources/assets/plugins/js/jquery.sparkline.min.js') }}"></script>
    <!--Custom JavaScript -->
    <script src="{{url('resources/assets/js/custom.min.js') }}"></script>
    <script src="{{url('resources/assets/plugins/js/c3.min.js') }}"></script>
    <script src="{{url('resources/assets/plugins/js/d3.min.js') }}"></script>
    <script src="{{url('resources/assets/plugins/js/select2.full.min.js') }}"></script>
    <script src="{{url('resources/assets/plugins/js/jQuery.style.switcher.js') }}"></script>
    <script src="{{url('resources/assets/plugins/js/tinymce.min.js') }}"></script>
    <script>
        function myFunction(val)
        {
            var locale1 = val;
            $.ajax({
                url: 'http://localhost/doshop/language',
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

</html>
