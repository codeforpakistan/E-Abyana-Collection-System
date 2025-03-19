<!DOCTYPE html>
<html lang="en">
	<head>

		<meta charset="UTF-8">
		<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
		<meta content="Splite - a responsive, flat and full featured admin template" name="description">
	    <meta content="Spruko Technologies Private Limited" name="author">
		<meta name="keywords" content="bootstrap admin template,bootstrap dashboard,dashboard template,bootstrap dashboard,admin dashboard,bootstrap admin,html admin template,html dashboard template,bootstrap admin dashboard,themeforest admin template,admin panel template,bootstrap 4 admin template,template admin bootstrap 4,bootstrap dashboard template,dashboard design template">
		<link rel="icon" href="{{asset('assets/img/brand/favicon.icon')}}" type="image/x-icon"/>
		<link rel="shortcut icon" type="image/x-icon" href="{{asset('assets/img/brand/favicon.icon')}}" />
		<title>Laravel Admin</title>


		<!--Bootstrap.min css-->
		<link rel="stylesheet" href="{{asset('assets/plugins/bootstrap/css/bootstrap.min.css')}}">

		<!--Style css-->
		<link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
		<link href="{{asset('assets/css/boxed')}}" rel="stylesheet" />

		<!--Icons css-->
		<link rel="stylesheet" href="{{asset('assets/css/icons.css')}}">

		<!--P-scrollbar css-->
		<link href="{{asset('assets/plugins/p-scroll/perfect-scrollbar.css')}}" rel="stylesheet"/>

		<!--Chartist css-->
		<link rel="stylesheet" href="{{asset('assets/plugins/chartist/chartist.css')}}">
		<link rel="stylesheet" href="{{asset('assets/plugins/chartist/chartist-plugin-tooltip.css')}}">

		<!--Full calendar css-->
		<link rel="stylesheet" href="{{asset('assets/plugins/fullcalendar/stylesheet1.css')}}">

		<!--morris css-->
		<link rel="stylesheet" href="{{asset('assets/plugins/morris/morris.css')}}">

	</head>

	<body class="app ">

		<!--Header Style -->
		<div class="wave -three"></div>

		<!--loader -->
		<!-- <div id="spinner"></div> -->

		<!--app open-->
		<div id="app" class="page">
			<div class="main-wrapper" >

			    <div class="header">
					<!--nav open-->
					<nav class="navbar navbar-expand-lg main-navbar">
						<div class="container">
							<a id="horizontal-navtoggle" class="animated-arrow hor-toggle"><span></span></a>
							<a class="header-brand" href="index.html">
								<img src="{{asset('assets/img/brand/logo-white.png')}}" class="header-brand-img" alt="Splite-Admin  logo">
							</a>
							<form class="form-inline mr-auto">
								<ul class="navbar-nav mr-2">
									<li><a href="#" data-toggle="search" class="nav-link  d-md-none navsearch"><i class="fa fa-search"></i></a></li>
								</ul>
								<div class="search-element mr-3">
									<input class="form-control" type="search" placeholder="Search" aria-label="Search">
									<span class="Search-icon"><i class="fa fa-search"></i></span>
								</div>
							</form>
							<ul class="navbar-nav navbar-right">
								<li class="dropdown dropdown-list-toggle d-none d-lg-block "><a href="#" data-toggle="dropdown" class="nav-link  nav-link-lg "><i class=" fa fa-flag-o "></i></a>
									<div class="dropdown-menu dropdown-menu-lg  dropdown-menu-right">
										<a href="#" class="dropdown-item d-flex align-items-center">
											<img src="{{asset('assets/img/flags/french_flag.jpg')}}" alt="flag-img" class=" flag-sm mr-3 align-self-center">
											<div>
												<strong>French</strong>
											</div>
										</a>
										<a href="#" class="dropdown-item d-flex align-items-center">
											<img src="{{asset('assets/img/flags/germany_flag.jpg')}}" alt="flag-img" class=" flag-sm mr-3 align-self-center">
											<div>
												<strong>Germany</strong>
											</div>
										</a>
										<a href="#" class="dropdown-item d-flex align-items-center">
											<img src="{{asset('assets/img/flags/italy_flag.jpg')}}" alt="flag-img" class=" flag-sm  mr-3 align-self-center">
											<div>
												<strong>Italy</strong>
											</div>
										</a>
										<a href="#" class="dropdown-item d-flex align-items-center">
											<img src="{{asset('assets/img/flags/russia_flag.jpg')}}" alt="flag-img" class=" flag-sm mr-3 align-self-center">
											<div>
												<strong>Russia</strong>
											</div>
										</a>
										<a href="#" class="dropdown-item d-flex align-items-center">
											<img src="{{asset('assets/img/flags/spain_flag.jpg')}}" alt="flag-img" class=" flag-sm mr-3 align-self-center">
											<div>
												<strong>Spain</strong>
											</div>
										</a>
									</div>
								</li>
								<li class="dropdown dropdown-list-toggle "><a href="#" data-toggle="dropdown" class="nav-link  nav-link-lg "><span class="badge badge-danger nav-link-badge">5</span><i class="hvr-buzz fa fa-envelope-o"></i></a>
									<div class="dropdown-menu dropdown-list dropdown-menu-right">
										<div class="dropdown-header">Messages
											<div class="float-right">
												<a href="#" class="text-white">View All</a>
											</div>
										</div>
										<div class="dropdown-list-content">
											<a href="#" class="dropdown-item dropdown-item-unread">
												<img alt="image" src="{{asset('assets/img/avatar/avatar-3.jpeg')}}" class="rounded-circle dropdown-item-img">
												<div class="dropdown-item-desc">
													<div class="dropdownmsg d-flex">
														<div class="">
															<b>Stewart Ball</b>
															<p>Your template awesome</p>
														</div>
														<div class="time">6 hours ago</div>
													</div>
												</div>
											</a>
											<a href="#" class="dropdown-item dropdown-item-unread">
												<img alt="image" src="{{asset('assets/img/avatar/avatar-2.jpeg')}}" class="rounded-circle dropdown-item-img">
												<div class="dropdown-item-desc">
													<div class="dropdownmsg d-flex">
														<div class="">
															<b>Jonathan North</b>
															<p>Your Order Shipped.....</p>
														</div>
														<div class="time">45 mins ago</div>
													</div>
												</div>
											</a>
											<a href="#" class="dropdown-item">
												<img alt="image" src="{{asset('assets/img/avatar/avatar-4.jpeg')}}" class="rounded-circle dropdown-item-img">
												<div class="dropdown-item-desc">
													<div class="dropdownmsg d-flex">
														<div class="">
															<b>Victor Taylor</b>
															<p>Hi!, I' am web developer</p>
														</div>
														<div class="time"> 8 hours ago</div>
													</div>
												</div>
											</a>
											<a href="#" class="dropdown-item">
												<img alt="image" src="{{asset('assets/img/avatar/avatar-3.jpeg')}}" class="rounded-circle dropdown-item-img">
												<div class="dropdown-item-desc">
													<div class="dropdownmsg d-flex">
														<div class="">
															<b>Ruth	Arnold</b>
															<p>Hi!, I' am web designer</p>
														</div>
														<div class="time"> 3 hours ago</div>
													</div>
												</div>
											</a>
											<a href="#" class="dropdown-item">
												<img alt="image" src="{{asset('assets/img/avatar/avatar-5.jpeg')}}" class="rounded-circle dropdown-item-img">
												<div class="dropdown-item-desc">
													<div class="dropdownmsg d-flex">
														<div class="">
															<b>Sam	Lyman</b>
															<p>Hi!, I' am java developer</p>
														</div>
														<div class="time"> 15 mintues ago</div>
													</div>
												</div>
											</a>
										</div>
									</div>
								</li>
								<li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown" class="nav-link  nav-link-lg "><span class="badge badge-secondary nav-link-badge">6</span><i class="fa fa-bell-o"></i></a>
									<div class="dropdown-menu dropdown-list dropdown-menu-right">
										<div class="dropdown-header">Notifications
											<div class="float-right">
												<a href="#" class="text-white">View All</a>
											</div>
										</div>
										<div class="dropdown-list-content">
											<a href="#" class="dropdown-item">
												<i class="fa fa-users text-primary"></i>
												<div class="dropdown-item-desc">
													<b>So many Users Visit your template</b>
												</div>
											</a>
											<a href="#" class="dropdown-item">
												<i class="fa fa-exclamation-triangle text-danger"></i>
												<div class="dropdown-item-desc">
													<b>Error message occurred....</b>
												</div>
											</a>
											<a href="#" class="dropdown-item">
												<i class="fa fa-users text-warning"></i>
												<div class="dropdown-item-desc">
													<b> Adding new people</b>
												</div>
											</a>
											<a href="#" class="dropdown-item">
												<i class="fa fa-shopping-cart text-success"></i>
												<div class="dropdown-item-desc">
													<b>Your items Arrived</b>
												</div>
											</a>
											<a href="#" class="dropdown-item">
												<i class="fa fa-comment text-primary"></i>
												<div class="dropdown-item-desc">
													<b>New Message received</b> <div class="float-right"><span class="badge badge-pill badge-danger badge-sm">67</span></div>
												</div>
											</a>
											<a href="#" class="dropdown-item">
												<i class="fa fa-users text-primary"></i>
												<div class="dropdown-item-desc">
													<b>So many Users Visit your template</b>
												</div>
											</a>
										</div>
									</div>
								</li>
								<li class="dropdown dropdown-list-toggle d-none d-lg-block">
									<a href="#" class="nav-link nav-link-lg full-screen-link">
										<i class="fa fa-expand " id="fullscreen-button"></i>
									</a>
								</li>
								<li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg d-flex">
										<span class="mr-3 mt-2 d-none d-lg-block ">
											<span class="text-white">Hello,<span class="ml-1"> Alica Nestle</span></span>
										</span>
									<span><img src="{{asset('assets/img/avatar/avatar-3.jpeg')}}" alt="profile-user" class="rounded-circle w-32 mr-2"></span>
									</a>
									<div class="dropdown-menu dropdown-menu-right">
										<div class=" dropdown-header noti-title text-center border-bottom pb-3">
											<h5 class="text-capitalize text-dark mb-1">Alica Nestle</h5>
											<small class="text-overflow m-0"> Web-Designer</small>
										</div>
										<a class="dropdown-item" href="user-profile.html"><i class="mdi mdi-account-outline mr-2"></i> <span>My profile</span></a>
										<a class="dropdown-item" href="#"><i class="mdi mdi-settings mr-2"></i> <span>Settings</span></a>
										<a class="dropdown-item" href="#"><i class=" mdi mdi-message-outline mr-2"></i> <span>Mails</span></a>
										<a class="dropdown-item" href="#"><i class=" mdi mdi-account-multiple-outline mr-2"></i> <span>Friends</span></a>
										<a class="dropdown-item" href="#"><i class="fe fe-calendar mr-2"></i> <span>Activity</span></a>
										<a class="dropdown-item" href="#"><i class="mdi mdi-compass-outline mr-2"></i> <span>Support</span></a>
										<div class="dropdown-divider"></div><a class="dropdown-item" href="login.html"><i class="mdi  mdi-logout-variant mr-2"></i> <span>Logout</span></a>
									</div>
								</li>
							</ul>
						</div>
					</nav>
					<!--nav closed-->
				</div>

				<!--Horizontal-menu-->
				<div class="sticky">
					<div class="horizontal-main hor-menu clearfix">
					<div class="horizontal-mainwrapper container clearfix">
						<nav class="horizontalMenu clearfix">
							<ul class="horizontalMenu-list">
								<li aria-haspopup="true"><a href="#" class="sub-icon active"><i class="fa fa-laptop"></i> Dashboard <span class="badge badge-orange nav-badge">5</span></a>
									<ul class="sub-menu">
										<li aria-haspopup="true"><a href="index.html">Sales Dashboard</a></li>
										<li aria-haspopup="true"><a href="index2.html">Social Dashboard</a></li>
										<li aria-haspopup="true"><a href="index3.html">Marketing Dashboard</a></li>
										<li aria-haspopup="true"><a href="index4.html">IT Dashboard</a></li>
										<li aria-haspopup="true"><a href="index5.html">Crypto Currency </a></li>
									</ul>
								</li>
								<li aria-haspopup="true"><a href="widgets.html" class=""><i class="fa fa-cube"></i> widgets</a></li>
								<li aria-haspopup="true"><a href="#" class="sub-icon"><i class="fa fa-edit"></i> Forms <span class="badge badge-pink nav-badge">6</span></a>
									<ul class="sub-menu">
										<li aria-haspopup="true"><a href="formelements.html">Form Elements</a></li>
										<li aria-haspopup="true"><a href="formadvanced.html">Advanced Form</a></li>
										<li aria-haspopup="true"><a href="formeditor.html">Form Editor</a></li>
										<li aria-haspopup="true"><a href="formvalidaton.html">Form Validation</a></li>
										<li aria-haspopup="true"><a href="formwizard.html">Form Wizard</a></li>
										<li aria-haspopup="true"><a href="formelementsadvanced.html">FormAdvanced Elements</a></li>
									</ul>
								</li>
								<li aria-haspopup="true"><a href="#" class="sub-icon"><i class="fa fa-cogs"></i> Components <i class="fa fa-angle-down horizontal-icon"></i></a>
									<ul class="sub-menu">
										<li aria-haspopup="true"><a href="cards.html">Cards</a></li>
										<li aria-haspopup="true"><a href="dragablecards.html">Dragable Cards</a></li>
										<li aria-haspopup="true" class="sub-menu-sub"><a href="#">Mail</a>
											<ul class="sub-menu">
												<li aria-haspopup="true"><a href="mailinbox.html">Mail-inbox</a></li>
												<li aria-haspopup="true"><a href="mail-compose.html">Mail-Compose</a></li>
												<li aria-haspopup="true"><a href="viewmail.html">View-Email</a></li>
											</ul>
										</li>
										<li aria-haspopup="true"><a href="chat.html">Chat</a></li>
										<li aria-haspopup="true"><a href="treeview.html">Tree View</a></li>
										<li aria-haspopup="true"><a href="imgcrop.html">Image Crop</a></li>
										<li aria-haspopup="true"><a href="order.html">Orders</a></li>
										<li aria-haspopup="true"><a href="search.html">Search  Page</a></li>
										<li aria-haspopup="true"><a href="chattypes.html">Chat Types</a></li>
										<li aria-haspopup="true"><a href="sortable&nestable.html">Sortable & Nestable</a></li>
										<li aria-haspopup="true"><a href="counters.html"> Counters</a></li>
										<li aria-haspopup="true"><a href="intro.html">Intro(tour)</a></li>
										<li aria-haspopup="true"><a href="clipboard.html">Clipboard</a></li>
										<li aria-haspopup="true"><a href="dropzone.html">Dropzone</a></li>
									</ul>
								</li>
								<li aria-haspopup="true"><a href="#" class="sub-icon"><i class="fa fa-tasks"></i> UI Elements  <i class="fa fa-angle-down horizontal-icon"></i></a>
									<div class="horizontal-megamenu clearfix">
										<div class="container">
											<div class="mega-menubg">
												<div class="row">
													<div class="col-lg-3 col-md-12 col-xs-12 link-list">
														<ul>
															<li><a href="elements.html">Elements</a></li>
															<li><a href="buttons.html">Buttons</a></li>
															<li><a href="colors.html">Colors</a></li>
															<li><a href="toastr.html"> Toastr</a></li>
															<li><a href="calender.html">Calendar</a></li>
															<li><a href="rangesliders.html">Rangeslider</a></li>
															<li><a href="modals.html">Modals</a></li>
														</ul>
													</div>
													<div class="col-lg-3 col-md-12 col-xs-12 link-list">
														<ul>
															<li><a href="timeline.html">Timeline</a></li>
															<li><a href="invoice.html">Invoice</a></li>
															<li><a href="users.html">Users List</a></li>
															<li><a href="mediaobject.html">Media Objects</a></li>
															<li><a href="grids.html">Grids</a></li>
															<li><a href="panel.html"> Panels</a></li>
															<li><a href="tags.html">Tags</a></li>
														</ul>
													</div>
													<div class="col-lg-3 col-md-12 col-xs-12 link-list">
														<ul>
															<li><a href="loaders.html"> Loaders</a></li>
															<li><a href="rating.html">Ratings</a></li>
															<li><a href="scrollbar.html">Scrollbar</a></li>
															<li><a href="headers.html">Headers</a></li>
															<li><a href="footer.html">Footers</a></li>
															<li><a href="pricing-tables.html">Pricing Tables</a></li>
															<li><a href="gallery.html"> Gallery</a></li>

														</ul>
													</div>
													<div class="col-lg-3 col-md-12 col-xs-12 link-list">
														<ul>
															<li><a href="portfolio.html">Portfolio</a></li>
															<li><a href="terms.html">Terms and Conditions</a></li>
															<li><a href="faq.html"> FAQs</a></li>
															<li><a href="landingpage.html">Landing Page</a></li>
															<li><a href="emptypage.html">Empty  Page</a></li>
															<li><a href="blog.html">Blog</a></li>
															<li><a href="blog-detail.html">Single Blog Post</a></li>
														</ul>
													</div>
												</div>
											</div>
										</div>
									</div>
								</li>
								<li aria-haspopup="true"><a href="#" class="sub-icon"><i class="fa fa-pie-chart"></i> Charts <i class="fa fa-angle-down horizontal-icon"></i></a>
									<ul class="sub-menu">
										<li aria-haspopup="true"><a href="chartjs.html">Chart Js</a></li>
										<li aria-haspopup="true"><a href="flotcharts.html">Flot Charts</a></li>
										<li aria-haspopup="true"><a href="barcharts.html"> Bar Charts</a></li>
										<li aria-haspopup="true"><a href="echart.html">ECharts</a></li>
										<li aria-haspopup="true"><a href="chartist.html">Chartist</a></li>
										<li aria-haspopup="true"><a href="morris.html">Morris Charts</a></li>
										<li aria-haspopup="true"><a href="othercharts.html">Other Charts</a></li>
										<li aria-haspopup="true"><a href="googlechart.html">Google Charts</a></li>
										<li aria-haspopup="true"><a href="chartgage.html">JustGage Charts</a></li>
									</ul>
								</li>
								<li aria-haspopup="true"><a href="#" class="sub-icon"><i class="fa fa-folder-open-o"></i> Pages <i class="fa fa-angle-down horizontal-icon"></i></a>
									<ul class="sub-menu">
										<li><a href="profile.html"> Profile</a></li>
										<li><a href="editprofile.html">Edit Profile</a></li>
										<li aria-haspopup="true" class="sub-menu-sub"><a href="#">Maps</a>
											<ul class="sub-menu">
												<li aria-haspopup="true"><a href="maps.html">Google Maps</a></li>
												<li aria-haspopup="true"><a href="vector-map.html">Vector Maps</a></li>
												<li aria-haspopup="true"><a href="mapel.html">Mapel Maps</a></li>
											</ul>
										</li>
										<li aria-haspopup="true" class="sub-menu-sub"><a href="#">Tables</a>
											<ul class="sub-menu">
												<li aria-haspopup="true"><a href="table.html">Basic Tables</a></li>
												<li aria-haspopup="true"><a href="datatables.html">Data Tables</a></li>
												<li aria-haspopup="true"><a href="editable.html">Edit Table</a></li>
											</ul>
										</li>
										<li aria-haspopup="true" class="sub-menu-sub"><a href="#">E-commerce</a>
											<ul class="sub-menu">
												<li aria-haspopup="true"><a href="shop.html">Shop</a></li>
												<li aria-haspopup="true"><a href="product-details.html">Product Details</a></li>
												<li aria-haspopup="true"><a href="product.html">Product Details-1</a></li>
												<li aria-haspopup="true"><a href="shop-cart.html">Shop Cart</a></li>
											</ul>
										</li>
										<li aria-haspopup="true" class="sub-menu-sub"><a href="#">Custom Pages</a>
											<ul class="sub-menu">
												<li aria-haspopup="true"><a href="register.html">Register</a></li>
												<li aria-haspopup="true"><a href="login.html">Login</a></li>
												<li aria-haspopup="true"><a href="forgot.html">Forgot Password</a></li>
												<li aria-haspopup="true"><a href="reset.html">Reset Password</a></li>
												<li aria-haspopup="true"><a href="lockscreen.html">Lock screen</a></li>
											</ul>
										</li>
										<li><a href="404.html">404</a></li>
										<li><a href="505.html">505</a></li>
										<li><a href="under-construction.html">Under Construction</a></li>
									</ul>
								</li>
								<li aria-haspopup="true"><a href="#" class="sub-icon"><i class="fa fa-smile-o"></i> Icons <i class="fa fa-angle-down horizontal-icon"></i></a>
									<ul class="sub-menu">
										<li aria-haspopup="true"><a href="icons-fontawesome.html">Font Awesome</a></li>
										<li aria-haspopup="true"><a href="icons-simpleline.html">Simple line</a></li>
										<li aria-haspopup="true"><a href="icons-themify.html">Themify</a></li>
										<li aria-haspopup="true"><a href="icons-flag.html">Flag Icons</a></li>
										<li aria-haspopup="true"><a href="icons-feather.html">Feather Awesome</a></li>
										<li aria-haspopup="true"><a href="icons-ion.html"> Ion Icons</a></li>
										<li aria-haspopup="true"><a href="icons-pe7.html">pe7</a></li>
										<li aria-haspopup="true"><a href="icons-typicons.html">Typicons</a></li>
										<li aria-haspopup="true"><a href="icons-materialdesign.html"> Material Design</a></li>
										<li aria-haspopup="true"><a href="icons-weather.html">Weather Icons</a></li>
									</ul>
								</li>
							</ul>
						</nav>
						<!--Menu HTML Code-->
					</div>
				</div>
				</div>
				<!--Horizontal-menu-->

                <!--app-content open-->
				<div class="container content-area">
					<section class="section">

					    <!--page-header open-->
						<div class="page-header">
							<h4 class="page-title">Dashboard 04</h4>
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="#" class="text-light-color">Home</a></li>
								<li class="breadcrumb-item active" aria-current="page">Dashboard 04</li>
							</ol>
						</div>
						<!--page-header closed-->

                        <!--row open-->
                        <div class="row row-deck">
							<div class="col-sm-12 col-lg-6 col-xl-3 col-md-6">
								<div class="card text-center">
									<div class="card-body  mb-0">
									    <h5 class="mb-3">Planning</h5>
										<input type="text" class="knob mb-0" value="80" data-thickness="0.2" data-width="90" data-height="90" data-fgColor="#4880FF"><br>
										<span class="text-muted mt-3"><i class="fa fa-check-circle text-success mr-2"></i>80% Completed</span>
									</div>
								</div>
							</div>
							<div class="col-sm-12 col-lg-6 col-xl-3 col-md-6">
								<div class="card text-center">
									<div class="card-body  mb-0">
									    <h5 class="mb-3">Design</h5>
										<input type="text" class="knob mb-0" value="74" data-thickness="0.2" data-width="90" data-height="90" data-fgColor="#ffb209"><br>
									    <span class="text-muted mt-3"><i class="fa fa-check-circle text-success mr-2"></i>74% Completed</span>
									</div>
								</div>
							</div>
							<div class="col-sm-12 col-lg-6 col-xl-3 col-md-6">
								<div class="card text-center">
									<div class="card-body  mb-0">
									    <h5 class="mb-3">Development</h5>
										<input type="text" class="knob mb-0" value="53" data-thickness="0.2" data-width="90" data-height="90" data-fgColor="#22e840"><br>
									    <span class="text-muted mt-3"><i class="fa fa-check-circle text-success mr-2"></i>53% On Going</span>
									</div>
								</div>
							</div>
							<div class="col-sm-12 col-lg-6 col-xl-3 col-md-6">
								<div class="card text-center ">
									<div class="card-body  mb-0">
									    <h5 class="mb-3">Testing</h5>
										<div class="widget-3 mb-1">
											<i class="icon icon-clock text-orange"></i><br>
										</div>
									    <span class="text-muted mt-5">Waiting</span>
									</div>
								</div>
							</div>
						</div>
						<!--row closed-->

						<!--row open-->
						<div class="row row-deck">
						    <div class="col-xl-4 col-lg-6">
								<div class="card">
									<div class="card-header">
										<h4>Total Risks</h4>
									</div>
									<div class="card-body">
										<div class="row">
											<div class="col mt-1 text-danger font-weight-bold">
												Over all current budget
											</div>
											<div class="col col-auto">
												<h5 class="text-danger mb-0 "><span class="badge badge-danger">9.2%</span></h5>
											</div>
										</div>
										<div class="row mt-4">
											<div class="col mt-1 text-warning font-weight-bold">
												High Risk Over Due tasks
											</div>
											<div class="col col-auto">
												<h5 class="text-warning mb-0"><span class="badge badge-warning">2</span></h5>
											</div>
										</div>
										<div class="row mt-4">
											<div class="col mt-1 text-primary font-weight-bold">
												low Risk Scanning Risks
											</div>
											<div class="col col-auto ">
												<h5 class="text-white mb-0"><span class="badge badge-primary">5</span></h5>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-xl-4 col-lg-6">
								<div class="card">
									<div class="card-header">
										<h4>Project Details</h4>
									</div>
									<div class="card-body">
										<div class="">
											<div class="row ">
												<div class="col">
													<h5 class="mb-0">Project:</h5>
												</div>
												<div class="col col-auto mt-1">
													 adipiscing elit
												</div>
											</div>
											<div class="row mt-3">
												<div class="col">
													<h6 class="mb-0">Start Date :</h6>
												</div>
												<div class="col col-auto text-lighter">
													12-12-2018
												</div>
											</div>
											<div class="row mt-3">
												<div class="col">
													<h6 class="mb-0">End Date :</h6>
												</div>
												<div class="col col-auto text-lighter">
													03-05-2019
												</div>
											</div>
											<div class="row mt-3">
												<div class="col">
													<h6 class="mb-0">Team Lead :</h6>
												</div>
												<div class="col col-auto text-lighter">
													John Wisely
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-xl-4 col-lg-12">
								<div class="card ">
									<div class="card-body">
										<div class="text-center widget-2">
											<h5 class="mb-3">Project Launch Date</h5>
											<i class="fa fa-flag-o text-success"  title=""></i>
											<h2 class="mt-3 mb-2">105 Days</h2>
											<p>Monday, Feb 11th 2019</p>
											<div class="progress progress-md mt-2 mb-0">
												<div class="progress-bar bg-primary w-70">70%</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!--row closed-->

                        <!--row open-->
						<div class="row">
						    <div class="col-xl-4">
								<div class="card">
									<div class="card-content">
										<div class="card-body">
											<div class="media mt-0 d-flex server">
												<div class=" ml-0  mt-0 media-body text-left">
													<h3 class="mb-2">Server1 </h3>
													<h4 class=" mb-0 text-muted"><span class="text-primary"><i class="fe fe-arrow-up-circle "></i></span> Last 52 days Ago <span class="badge badge-primary mt-1 mb-1">Online</span></h4>
												</div>
												<div class="align-self-center">
													<i class="fe fe-hard-drive icon text-primary float-right"></i>
												</div>
											</div>
										</div>
									</div>
								</div>

								<div class="card">
									<div class="card-content">
										<div class="card-body">
											<div class="media mt-0 d-flex server">
												<div class=" ml-0  mt-0 media-body text-left">
													<h3 class="mb-2">Server2 </h3>
													<h4 class=" mb-0 text-muted"><span class="text-secondary"><i class="fe fe-arrow-up-circle "></i></span> Last 43 days Ago <span class="badge badge-secondary mt-1 mb-1">Online</span></h4>
												</div>
												<div class="align-self-center">
													<i class="fe fe-hard-drive icon text-secondary float-right"></i>
												</div>
											</div>
										</div>
									</div>
								</div>

								<div class="card">
									<div class="card-content">
										<div class="card-body">
											<div class="media mt-0 d-flex server">
												<div class= "ml-0  mt-0 media-body text-left">
													<h3 class="">Server3</h3>
													<h4 class=" mb-0 text-muted"><span class="text-danger"><i class="fe fe-arrow-down-circle "></i></span> Last 10 days Ago <span class="badge badge-danger mt-1 mb-1">Offline</span></h4>
												</div>
												<div class="align-self-center">
													<i class="fe fe-hard-drive icon text-danger float-right"></i>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-12 col-xl-8 col-md-12 col-12 col-sm-12">
								<div class="card">
									<div class="card-header">
										<h4>Space Details</h4>
									</div>
									<div class="card-body">
										<canvas id="lineChart" class="chartjs-render-monitor chart-dropshadow h-335"></canvas>
									</div>
							    </div>
							</div>
						</div>
						<!--row closed-->

                        <!--row open-->
						<div class="row row-deck">
							<div class="col-lg-12 col-xl-6 col-md-12 col-12 col-sm-12">
								<div class="card">
									<div class="card-header">
										<h4>Avg Time For Project Task</h4>
									</div>
									<div class="card-body">
									    <div class="dash2 mb-3">
											<div class="">
												<canvas id="barChart" class="chartjs-render-monitor chart-dropshadow h-300"></canvas>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-12 col-sm-12 col-md-12 col-xl-6">
								<div class="card ">
								    <div class="card-header">
										<h4>Current Budget</h4>
									</div>
									<div class="card-body">
									  <canvas id="team-chart" class="chartjs-render-monitor chart-dropshadow h-300"></canvas>
									</div>
								</div>
							</div>
						</div>
						<!--row closed-->

						<!--row open-->
						<div class="row ">
							<div class="col-12">
								<div class="card">
									<div class="card-header ">
										<h4>Upcoming Deadlines</h4>
									</div>
									<div class="card-body">
										<div class="table-responsive">
											<table class="table table-hover card-table table-vcenter table-bordered text-nowrap">
												<thead>
												  <tr>
													<th scope="col">ID</th>
													<th scope="col">Employee</th>
													<th scope="col">Project Name</th>
													<th scope="col">Issues</th>
													<th scope="col">Deadline</th>
													<th scope="col">Team Members</th>
													<th scope="col">WorkLoad </th>
												  </tr>
												</thead>
												<tbody>
												  <tr>
													<th scope="row">1</th>
													<td>Juliette</td>
													<td>At vero eos et accusamus et iusto odio </td>
													<td>CMS Issue</td>
													<td>02/01/2019</td>
													<td>5 Members</td>
													<td>
														<div class="progress progress-md mt-1 h-6">
															<div class="progress-bar  progress-bar-animated bg-success w-70"></div>
														</div>
													</td>
												  </tr>
												  <tr>
													<th scope="row">2</th>
													<td>Brock Lee</td>
													<td>voluptatum deleniti atque corrupti quos</td>
													<td>DNS Issue</td>
													<td>13/01/2019</td>
													<td>4 Members</td>
													<td>
														<div class="progress progress-md mt-1 h-6">
															<div class="progress-bar  progress-bar-animated bg-primary w-30"></div>
														</div>
													</td>
												  </tr>
												  <tr>
													<th scope="row">3</th>
													<td>Harry</td>
													<td>dignissimos ducimus qui blanditiis praesentium</td>
													<td>Hardware Failure</td>
													<td>18/01/2019</td>
													<td>5 Members</td>
													<td>
														<div class="progress progress-md mt-1 h-6">
															<div class="progress-bar  progress-bar-animated bg-warning w-40"></div>
														</div>
													</td>
												  </tr>
												  <tr>
													<th scope="row">4</th>
													<td>Robin</td>
													<td>deleniti atque corrupti quos dolores </td>
													<td>Host Provider</td>
													<td>21/01/2019</td>
													<td>10 Members</td>
													<td>
														<div class="progress progress-md mt-1 h-6">
															<div class="progress-bar  progress-bar-animated bg-secondary w-30"></div>
														</div>
													</td>
												  </tr>
												  <tr>
													<th scope="row">5</th>
													<td>Anne Fibbiyon</td>
													<td>et quas molestias excepturi sint occaecati</td>
													<td>Hardware Failure</td>
													<td>28/01/2019</td>
													<td>3 Members</td>
													<td>
														<div class="progress progress-md mt-1 h-6">
															<div class="progress-bar  progress-bar-animated bg-orange w-60"></div>
														</div>
													</td>
												  </tr>
												  <tr>
													<th scope="row">6</th>
													<td>Anthony</td>
													<td>At vero eos et accusamus et iusto odio </td>
													<td>CMS Issue</td>
													<td>05/02/2019</td>
													<td>6 Members</td>
													<td>
														<div class="progress progress-md mt-1 h-6">
															<div class="progress-bar  progress-bar-animated bg-success w-40"></div>
														</div>
													</td>
												  </tr>
												  <tr>
													<th scope="row">7</th>
													<td>Jennifer</td>
													<td>At vero eos et accusamus et iusto odio </td>
													<td>DNS Issue</td>
													<td>12/02/2019</td>
													<td>4 Members</td>
													<td>
														<div class="progress progress-md mt-1 h-6">
															<div class="progress-bar  progress-bar-animated bg-primary w-60"></div>
														</div>
													</td>
												  </tr>
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!--row closed-->

					</section>
				</div>
				<!--app-content closed-->

				<!-- Popupchat open-->
				<div class="popup-box chat-popup" id="qnimate">
					<div class="popup-head">
						<div class="popup-head-left pull-left"><img src="{{asset('assets/img/avatar/avatar-3.jpeg')}}" alt="iamgurdeeposahan" class="mr-2"> Alica Nestle</div>
						<div class="popup-head-right pull-right">
							<div class="btn-group">
								<button class="chat-header-button" data-toggle="dropdown" type="button" aria-expanded="false">
								<i class="glyphicon glyphicon-cog"></i> </button>
								<ul role="menu" class="dropdown-menu dropdown-menu-right">
									<li><a href="#">Media</a></li>
									<li><a href="#">Block</a></li>
									<li><a href="#">Clear Chat</a></li>
									<li><a href="#">Email Chat</a></li>
								</ul>
							</div>
							<button data-widget="remove" id="removeClass" class="chat-header-button pull-right" type="button"><i class="glyphicon glyphicon-off"></i></button>
						</div>
					</div>
					<div class="popup-messages">
						<div class="direct-chat-messages">
							<div class="chat-box-single-line">
								<abbr class="timestamp">December 15th, 2018</abbr>
							</div>
							<div class="direct-chat-msg">
								<div class="direct-chat-info clearfix">
									<span class="direct-chat-name float-left">Alica Nestle</span>
									<span class="direct-chat-timestamp float-right">7:40 Am</span>
								</div>
								<img class="direct-chat-img" src="{{asset('assets/img/avatar/avatar-3.jpeg')}}" alt="message user image">
								<div class="direct-chat-text">
									Hello. How are you today?
								</div>
							</div>
							<div class="direct-chat-msg right">
								<div class="direct-chat-info clearfix">
									<span class="direct-chat-name float-right">Roberts</span>
									<span class="direct-chat-timestamp float-left">8:05 Am</span>
								</div>
								<img class="direct-chat-img" src="{{asset('assets/img/avatar/avatar-2.jpeg')}}" alt="message user image">
								<div class="direct-chat-text">
									I'm fine. Thanks for asking!
								</div>
							</div>
							<div class="chat-box-single-line  mb-3">
								<abbr class="timestamp">December 14th, 2018</abbr>
							</div>
							<div class="direct-chat-msg doted-border">
								<div class="direct-chat-info clearfix">
									<span class="direct-chat-name float-left">Alica Nestle</span>
									<span class="direct-chat-timestamp float-right">6:20 Am</span>
								</div>
								<img alt="iamgurdeeposahan" src="{{asset('assets/img/avatar/avatar-3.jpeg')}}" class="direct-chat-img"><!-- /.direct-chat-img -->
								<div class="direct-chat-text">
									Hey bro, how’s everything going ?
								</div>
								<div class="direct-chat-msg right">
									<div class="direct-chat-info clearfix">
										<span class="direct-chat-name float-right">Roberts</span>
										<span class="direct-chat-timestamp float-left">7:05 Am</span>
									</div>
									<img class="direct-chat-img" src="{{asset('assets/img/avatar/avatar-2.jpeg')}}" alt="message user image">
									<div class="direct-chat-text">
										Nothing Much!
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="popup-messages-footer">
						<textarea id="status_message" placeholder="Type a message..." rows="10" cols="40" name="message"></textarea>
						<div class="btn-footer">
							<button class="bg_none"><i class="glyphicon glyphicon-film"></i> </button>
							<button class="bg_none"><i class="glyphicon glyphicon-camera"></i> </button>
							<button class="bg_none"><i class="glyphicon glyphicon-paperclip"></i> </button>
							<button class="bg_none pull-right"><i class="glyphicon glyphicon-thumbs-up"></i> </button>
						</div>
					</div>
				</div>
				<!-- Popupchat closed -->

			</div>

			<!--Footers-->
			<footer class="main-footer">
				<div class="text-center">
					Copyright &copy;Splite 2021. Design By<a href="https://spruko.com/"> Spruko</a>
				</div>
			</footer>
			<!--Footers-->
		</div>
		<!--app closed-->

		<!-- Back to top -->
		<a href="#top" id="back-to-top" ><i class="fa fa-angle-up"></i></a>

		<!-- Popup-chat -->
		<a href="#" id="addClass"><i class="ti-comment"></i></a>

		<!--Jquery.min js-->
		<script src="{{asset('assets/js/jquery.min.js')}}')}}"></script>

		<!--popper js-->
		<script src="{{asset('assets/js/popper.js')}}"></script>

		<!--Bootstrap.min js-->
		<script src="{{asset('assets/plugins/bootstrap/js/bootstrap.min.js')}}"></script>

		<!--Tooltip js-->
		<script src="{{asset('assets/js/tooltip.js')}}"></script>

		<!-- Jquery star rating-->
		<script src="{{asset('assets/plugins/rating/jquery.rating-stars.js')}}"></script>

		<!--Jquery.nicescroll.min js-->
		<script src="{{asset('assets/plugins/nicescroll/jquery.nicescroll.min.js')}}"></script>

		<!--Scroll-up-bar.min js-->
		<script src="{{asset('assets/plugins/scroll-up-bar/dist/scroll-up-bar.min.js')}}"></script>

		<!--Horizontalmenu js-->
		<script src="{{asset('assets/plugins/horizontal-menu/webslidemenu.js')}}"></script>

        <!-- Sticky js-->
		<script src="{{asset('assets/js/sticky.js')}}"></script>

		<!--p-scrollbar js-->
            <script src="{{asset('assets/plugins/p-scroll/perfect-scrollbar.js')}}"></script>

		<!-- jQuery Sparklines -->
		<script src="{{asset('assets/plugins/jquery-sparkline/dist/jquery.sparkline.js')}}"></script>

       <!--Jquery.knob js-->
		<script src="{{asset('assets/plugins/othercharts/jquery.knob.js')}}"></script>

		<!--Jquery.sparkline js-->
		<script src="{{asset('assets/plugins/othercharts/jquery.sparkline.min.js')}}"></script>

		<!--Chart js-->
		<script src="{{asset('assets/js/chart.min.js')}}"></script>

		<!--Dashboard js-->
		<script src="{{asset('assets/js/dashboard4.js')}}"></script>

		<!--Other Charts js-->
		<script src="{{asset('assets/plugins/othercharts/jquery.sparkline.min.js')}}"></script>
		<script src="{{asset('assets/js/othercharts.js')}}"></script>

		<!--Sparkline js-->
		<script src="{{asset('assets/js/sparkline.js')}}"></script>

		<!--Showmore js-->
		<script src="{{asset('assets/js/jquery.showmore.js')}}"></script>

		<!--Scripts js-->
		<script src="{{asset('assets/js/scripts.js')}}"></script>
	</body>
</html>