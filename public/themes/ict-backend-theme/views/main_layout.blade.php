<!DOCTYPE html>  
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
	<meta name="csrf_token" content="{!! csrf_token() !!}" />
    <link rel="icon" type="image/png" sizes="16x16" href="{!! asset('favicon.png') !!}">
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
	<link href="{!! Theme::asset('vendor/weather-icons/css/weather-icons.min.css') !!}" rel="stylesheet" />
    <!-- Menu CSS -->
    <link href="{!! Theme::asset('vendor/metis-menu/sidebar-nav.min.css') !!}" rel="stylesheet">
    <!-- morris CSS -->
    <link href="../plugins/bower_components/morrisjs/morris.css') !!}" rel="stylesheet">
    <!-- animation CSS -->
    <link href="{!! Theme::asset('vendor/animate.css/css/animate.css') !!}" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{!! Theme::asset('css/style.css') !!}" rel="stylesheet">
    <!-- color CSS -->
    <link href="{!! Theme::asset('css/colors/blue.css')!!}" id="theme" rel="stylesheet" />
	<link href="{!! Theme::asset('vendor/jquery-confirm/jquery-confirm.min.css')!!}" rel="stylesheet" />
	
	@stack('stylesheet')
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="{!! Theme::asset('assets/vendor/ie/html5shiv.js')!!}"></script>
    <script src="{!! Theme::asset('assets/vendor/ie/respond.min.js')!!}"></script>
<![endif]-->
    <!--<script src="http://www.w3schools.com/lib/w3data.js"></script>-->
</head>

<body>
    <!-- Preloader -->
    <div class="preloader">
        <div class="cssload-speeding-wheel"></div>
    </div>
	<!-- Loading -->
	<div id="divLoading">
	</div>
	
    <div id="wrapper">
        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top m-b-0">
            <div class="navbar-header"> <a class="navbar-toggle hidden-sm hidden-md hidden-lg " href="javascript:void(0)" data-toggle="collapse" data-target=".navbar-collapse"><i class="ti-menu"></i></a>
                <div class="top-left-part"><a class="logo" href="dashboard.html"><b><img src="{!! Theme::asset('img/small2-logo.png') !!}" alt="home" /></b></a></div>
                <ul class="nav navbar-top-links navbar-left hidden-xs">
                    <li><a href="javascript:void(0)" class="open-close hidden-xs waves-effect waves-light"><i class="icon-arrow-left-circle ti-menu"></i></a></li>
                    <li>
                        <form role="search" class="app-search hidden-xs">
                            <input type="text" placeholder="Search..." class="form-control"> <a href=""><i class="fa fa-search"></i></a> </form>
                    </li>
                </ul>
                <ul class="nav navbar-top-links navbar-right pull-right">
                    <li class="dropdown"> 
						<a class="dropdown-toggle waves-effect waves-light" data-toggle="dropdown" href="#"><i class="icon-envelope"></i>
							<div class="notify"><span class="heartbit"></span><span class="point"></span></div>
						</a>
                        <ul class="dropdown-menu mailbox animated bounceInDown">
                            <li>
                                <div class="drop-title">You have 4 new messages</div>
                            </li>
                            <li>
                                <div class="message-center">
                                    <a href="#">
                                        <div class="user-img"> <img src="../plugins/images/users/pawandeep.jpg" alt="user" class="img-circle"> <span class="profile-status online pull-right"></span> </div>
                                        <div class="mail-contnet">
                                            <h5>Pavan kumar</h5> <span class="mail-desc">Just see the my admin!</span> <span class="time">9:30 AM</span> </div>
                                    </a>
                                    <a href="#">
                                        <div class="user-img"> <img src="../plugins/images/users/sonu.jpg" alt="user" class="img-circle"> <span class="profile-status busy pull-right"></span> </div>
                                        <div class="mail-contnet">
                                            <h5>Sonu Nigam</h5> <span class="mail-desc">I've sung a song! See you at</span> <span class="time">9:10 AM</span> </div>
                                    </a>
                                    <a href="#">
                                        <div class="user-img"> <img src="../plugins/images/users/arijit.jpg" alt="user" class="img-circle"> <span class="profile-status away pull-right"></span> </div>
                                        <div class="mail-contnet">
                                            <h5>Arijit Sinh</h5> <span class="mail-desc">I am a singer!</span> <span class="time">9:08 AM</span> </div>
                                    </a>
                                    <a href="#">
                                        <div class="user-img"> <img src="../plugins/images/users/pawandeep.jpg" alt="user" class="img-circle"> <span class="profile-status offline pull-right"></span> </div>
                                        <div class="mail-contnet">
                                            <h5>Pavan kumar</h5> <span class="mail-desc">Just see the my admin!</span> <span class="time">9:02 AM</span> </div>
                                    </a>
                                </div>
                            </li>
                            <li>
                                <a class="text-center" href="javascript:void(0);"> <strong>See all notifications</strong> <i class="fa fa-angle-right"></i> </a>
                            </li>
                        </ul>
                        <!-- /.dropdown-messages -->
                    </li>
                    <!-- /.dropdown -->
                    <li class="dropdown"> 
						<a class="dropdown-toggle waves-effect waves-light" data-toggle="dropdown" href="#"><i class="icon-note"></i>
							<div class="notify"><span class="heartbit"></span><span class="point"></span></div>
						</a>
                        <ul class="dropdown-menu dropdown-tasks animated slideInUp">
                            <li>
                                <a href="#">
                                    <div>
                                        <p> <strong>Task 1</strong> <span class="pull-right text-muted">40% Complete</span> </p>
                                        <div class="progress progress-striped active">
                                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%"> <span class="sr-only">40% Complete (success)</span> </div>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="#">
                                    <div>
                                        <p> <strong>Task 2</strong> <span class="pull-right text-muted">20% Complete</span> </p>
                                        <div class="progress progress-striped active">
                                            <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%"> <span class="sr-only">20% Complete</span> </div>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="#">
                                    <div>
                                        <p> <strong>Task 3</strong> <span class="pull-right text-muted">60% Complete</span> </p>
                                        <div class="progress progress-striped active">
                                            <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%"> <span class="sr-only">60% Complete (warning)</span> </div>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="#">
                                    <div>
                                        <p> <strong>Task 4</strong> <span class="pull-right text-muted">80% Complete</span> </p>
                                        <div class="progress progress-striped active">
                                            <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%"> <span class="sr-only">80% Complete (danger)</span> </div>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a class="text-center" href="#"> <strong>See All Tasks</strong> <i class="fa fa-angle-right"></i> </a>
                            </li>
                        </ul>
                        <!-- /.dropdown-tasks -->
                    </li>
                    <!-- /.dropdown -->
                    <li class="dropdown">
                        <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#"> <img src="{!! Theme::asset('img/avatar.png') !!}" alt="user-img" width="36" class="img-circle"><b class="hidden-xs">{!! Auth::user()->first_name !!}</b> </a>
                        <ul class="dropdown-menu dropdown-user animated flipInY">
                            <li><a href="{!! url('/profile') !!}"><i class="ti-user"></i> {!! Lang::get('app.my profile') !!}</a></li>
                            <!--<li><a href="#"><i class="ti-wallet"></i> My Balance</a></li>
                            <li><a href="#"><i class="ti-email"></i> Inbox</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="#"><i class="ti-settings"></i> Account Setting</a></li>
                            <li role="separator" class="divider"></li>-->
                            <li><a href="{!! url('/session/logout') !!}"><i class="fa fa-power-off"></i> {!! Lang::get('app.logout') !!}</a></li>
                        </ul>
                        <!-- /.dropdown-user -->
                    </li>
                    
                    <!--<li class="right-side-toggle"> <a class="waves-effect waves-light" href="javascript:void(0)"><i class="ti-settings"></i></a></li>
                    -->
					<!-- /.dropdown -->
                </ul>
            </div>
            <!-- /.navbar-header -->
            <!-- /.navbar-top-links -->
            <!-- /.navbar-static-side -->
        </nav>
        <!-- Left navbar-header -->
        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse slimscrollsidebar">
                <ul class="nav" id="side-menu">
                    <li class="sidebar-search hidden-sm hidden-md hidden-lg">
                        <!-- input-group -->
                        <div class="input-group custom-search-form">
                            <input type="text" class="form-control" placeholder="Search..."> 
							<span class="input-group-btn">
								<button class="btn btn-default" type="button"> <i class="fa fa-search"></i> </button>
							</span> 
						</div>
                        <!-- /input-group -->
                    </li>
                    <li> <a href="index.html" class="waves-effect active"><i class="linea-icon linea-basic fa-fw" data-icon="v"></i> <span class="hide-menu"> {!! Lang::get('app.dashboard')!!} <span class="fa arrow"></span> </span></a>
                        <ul class="nav nav-second-level">
                            <li> <a href="{!! Lang::get('app.dashboard')!!}">{!! Lang::get('app.dashboard')!!} </a> </li>
                        </ul>
                    </li>
                    
                    <li> <a href="#" class="waves-effect"><i data-icon="&#xe00b;" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">{!! Lang::get('app.crm')!!}<span class="fa arrow"></span></span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="{!! url('/customer') !!}">{!! Lang::get('app.customer')!!}</a></li>
                            <li><a href="{!! url('/customer-group') !!}">{!! Lang::get('app.group')!!}</a></li>
                        </ul>
                    </li>
                    
                    <li> <a href="#" class="waves-effect"><i data-icon="&#xe00b;" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">{!! Lang::get('app.sales')!!}<span class="fa arrow"></span></span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="{!! url('telephone-billing') !!}">{!! Lang::get('app.telephone billing')!!}</a></li>
                            <li> <a href="#" class="waves-effect">{!! Lang::get('app.report')!!} <span class="fa arrow"></span></a>
                                <ul class="nav nav-third-level">
                                    <li> <a href="{!! url('/telephone-billing/report') !!}">{!! Lang::get('app.telephone billing')!!}</a></li>
                                </ul>
                            </li>
                            
                        </ul>
                    </li>
					
					<li> <a href="#" class="waves-effect"><i data-icon="F" class="linea-icon linea-software fa-fw"></i> <span class="hide-menu">{!! Lang::get('app.accounting')!!}<span class="fa arrow"></span></span></a>
                        <ul class="nav nav-second-level">
                            <li> <a href="#" class="waves-effect">{!! Lang::get('app.account')!!} <span class="fa arrow"></span></a>
                                <ul class="nav nav-third-level">
                                    <li> <a href="{!! url('/account-bank') !!}">{!! Lang::get('app.account bank')!!}</a> </li>
                                    <li> <a href="{!! url('/bank') !!}">{!! Lang::get('app.bank')!!}</a> </li>
                                </ul>
                            </li>
							<li> <a href="#" class="waves-effect">{!! Lang::get('app.settings')!!} <span class="fa arrow"></span></a>
                                <ul class="nav nav-third-level">
                                    <li> <a href="{!! url('/payment-method') !!}">{!! Lang::get('app.payment method')!!}</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    
                    <li> <a href="javascript:void(0)" class="waves-effect"><i data-icon="F" class="linea-icon linea-software fa-fw"></i> <span class="hide-menu">{!! Lang::get('app.settings')!!}<span class="fa arrow"></span></span></a>
                        <ul class="nav nav-second-level">
                            <li> <a href="{!! url('/profile') !!}">{!! Lang::get('app.my profile')!!}</a> </li>
                            <li> <a href="{!! url('/setting') !!}">{!! Lang::get('app.general setting')!!}</a> </li>
                            <li> <a href="#" class="waves-effect">{!! Lang::get('app.user & group')!!} <span class="fa arrow"></span></a>
                                <ul class="nav nav-third-level">
                                    <li> <a href="{!! url('/user') !!}">{!! Lang::get('app.user')!!}</a> </li>
                                    <li> <a href="{!! url('/user-group') !!}">{!! Lang::get('app.group')!!}</a> </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    
                </ul>
            </div>
        </div>
        <!-- Left navbar-header end -->
        <!-- Page Content -->
        <div id="page-wrapper">
			<div class="container-fluid">
			@yield('content')
			</div>
       
            <footer class="footer text-center"> {!! date('Y') !!} &copy; {!! Lang::get('app.copyright') !!} </footer>
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->
    <!-- jQuery -->
    <script src="{!! Theme::asset('vendor/jquery/jquery.min.js') !!}"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="{!! Theme::asset('vendor/bootstrap/dist/js/bootstrap.min.js') !!}"></script>
    <!-- Menu Plugin JavaScript -->
    <script src="{!! Theme::asset('vendor/metis-menu/sidebar-nav.min.js') !!}"></script>
    <!--slimscroll JavaScript -->
    <script src="{!! Theme::asset('vendor/jquery/jquery.slimscroll.js') !!}"></script>
    <!--Wave Effects -->
    <script src="js/waves.js"></script>
    <!--weather icon -->
    <script src="../plugins/bower_components/skycons/skycons.js"></script>
    <!--Counter js -->
    <script src="../plugins/bower_components/waypoints/lib/jquery.waypoints.js"></script>
    <script src="../plugins/bower_components/counterup/jquery.counterup.min.js"></script>
    <!--Morris JavaScript -->
    <script src="../plugins/bower_components/raphael/raphael-min.js"></script>
    <script src="../plugins/bower_components/morrisjs/morris.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="{!! Theme::asset('js/custom.min.js')!!}"></script>
    <script src="js/dashboard4.js"></script>
    <!-- Sparkline chart JavaScript -->
    <script src="../plugins/bower_components/jquery-sparkline/jquery.sparkline.min.js"></script>
    <script src="../plugins/bower_components/jquery-sparkline/jquery.charts-sparkline.js"></script>
    <!--Style Switcher -->
	<script src="../plugins/bower_components/styleswitcher/jQuery.style.switcher.js"></script>
	<script src="{!! Theme::asset('vendor/jquery-confirm/jquery-confirm.min.js')!!}"></script>
	<script src="{!! Theme::asset('vendor/jquery-number/jquery.number.min.js')!!}"></script>
	@stack('scripts')
	@stack('script-extras')
</body>

</html>