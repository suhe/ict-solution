<!DOCTYPE html>  
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="icon" type="image/png" sizes="16x16" href="../plugins/images/favicon.png">
	<title>ICT Solutions</title>
	<!-- Bootstrap Core CSS -->
	<link href="{!! Theme::asset('vendor/bootstrap/dist/css/bootstrap.min.css') !!}" rel="stylesheet">
	<!-- Fontawesome Core CSS -->
	<link href="{!! Theme::asset('vendor/font-awesome/css/font-awesome.min.css') !!}" rel="stylesheet" />
	<!-- themify-icons Core CSS -->
	<link href="{!! Theme::asset('vendor/themify-icons/themify-icons.css') !!}" rel="stylesheet" />
	<!-- simple-line-icons Core CSS -->
	<link href="{!! Theme::asset('vendor/simple-line-icons/css/simple-line-icons.css') !!}" rel="stylesheet" />
	<!-- simple-line-icons Core CSS -->
	<link href="{!! Theme::asset('/vendor/weather-icons/css/weather-icons.min.css') !!}" rel="stylesheet" />
	<!-- animation CSS -->
	<link href="{!! Theme::asset('vendor/animate.css/css/animate.css') !!}" rel="stylesheet">
	<!-- Custom CSS -->
	<link href="{!! Theme::asset('css/style.css') !!}" rel="stylesheet">
	<!-- color CSS -->
	<link href="{!! Theme::asset('css/colors/blue.css')!!}" id="theme" rel="stylesheet" />
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="{!! Theme::asset('vendor/ie/html5shiv.js') !!}"></script>
		<script src="{!! Theme::asset('vendor/ie/respond.min.js') !!}"></script>
	<![endif]-->
</head>
<body>
<!-- Preloader -->
<div class="preloader">
  <div class="cssload-speeding-wheel"></div>
</div>
<section id="wrapper" class="login-register">
	@yield('content')
</section>
<!-- jQuery -->
<script src="{!! Theme::asset('vendor/jquery/jquery.min.js') !!}"></script>
<!-- Bootstrap Core JavaScript -->
<script src="{!! Theme::asset('vendor/bootstrap/dist/js/bootstrap.min.js') !!}"></script>
<!-- Menu Plugin JavaScript -->
<script src="{!! Theme::asset('vendor/metis-menu/sidebar-nav.min.js') !!}"></script>

<!--slimscroll JavaScript -->
<script src="{!! Theme::asset('js/jquery.slimscroll.js') !!}"></script>
<!--Wave Effects -->
<script src="{!! Theme::asset('js/waves.js') !!}"></script>
<!-- Custom Theme JavaScript -->
<script src="{!! Theme::asset('js/custom.min.js') !!}"></script>
<!--Style Switcher -->
<script src="{!! Theme::asset('jQuery.style.switcher.js') !!}"></script>
@stack('scripts')
</body>
</html>
