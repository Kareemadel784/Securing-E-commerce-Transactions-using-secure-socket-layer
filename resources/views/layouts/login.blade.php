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
    <title>تسجيل الدخول | @yield('title')</title>
    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="{{url('resources/assets/plugins/css/bootstrap.min.css')}}">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{url('resources/assets/css/style.css')}}">
    <link rel="stylesheet" href="{{url('resources/assets/css/colors/blue.css')}}">
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>

    @yield('header')
</head>

<body class="fix-header fix-sidebar card-no-border">
<div class="preloader">
    <svg class="circular" viewBox="25 25 50 50">
        <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
</div>
<section id="wrapper">
    <div class="login-register" style="background-image:url('resources/assets/images/background/login-register.jpg') ;">
        <div class="login-box card">
            <div class="card-body">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <h3 class="box-title m-b-20">Sign In</h3>
                    <div class="form-group ">
                        <div class="col-xs-12">
                            <input class="form-control" type="email" required  placeholder="Username"> </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <input class="form-control" type="password" required="" placeholder="Password"> </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <div class="checkbox checkbox-primary pull-left p-t-0">
                                <input id="checkbox-signup" type="checkbox">
                                <label for="checkbox-signup"> Remember me </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group text-center m-t-20">
                        <div class="col-xs-12">
                            <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Log In</button>
                        </div>
                    </div>
                </form>

        </div>
    </div>
</section>

    <script src="{{url('resources/assets/plugins/js/jquery.min.js') }}"></script>
    <script src="{{url('resources/assets/plugins/js/popper.min.js') }}"></script>
    <script src="{{url('resources/assets/plugins/js/bootstrap.min.js') }}"></script>

    <script src="{{url('resources/assets/js/jquery.slimscroll.js') }}"></script>
    <script src="{{url('resources/assets/js/waves.js') }}"></script>
    <script src="{{url('resources/assets/js/sidebarmenu.js') }}"></script>
    <script src="{{url('resources/assets/plugins/js/sticky-kit.min.js') }}"></script>
    <script src="{{url('resources/assets/plugins/js/jquery.sparkline.min.js') }}"></script>
    <!--Custom JavaScript -->
    <script src="{{url('resources/assets/js/custom.min.js') }}"></script>
    <script src="{{url('resources/assets/plugins/js/c3.min.js') }}"></script>
    <script src="{{url('resources/assets/plugins/js/d3.min.js') }}"></script>
    <script src="{{url('resources/assets/plugins/js/jQuery.style.switcher.js') }}"></script>


    @yield('footer')
</body>

</html>
