<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <link rel="icon" href="<?php echo e(asset('assets/img/brand/favicon.icon')); ?>" type="image/x-icon" />
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo e(asset('assets/img/avatar/logo.png')); ?>" />
    <title>Irrigation Billing System</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Nastaliq+Urdu&display=swap" rel="stylesheet">


    <!--Bootstrap.min css-->
    <link rel="stylesheet" href="<?php echo e(asset('assets/plugins/bootstrap/css/bootstrap.min.css')); ?>">

    <!--Style css-->
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/style.css')); ?>">

    <!--Icons css-->
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/icons.css')); ?>">

    <!--P-scrollbar css-->
    <link href="<?php echo e(asset('assets/plugins/p-scroll/perfect-scrollbar.css')); ?>" rel="stylesheet" />

    <!--Sidemenu css-->
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/sidemenu.css')); ?>">

    <!--Chartist css-->
    <link rel="stylesheet" href="<?php echo e(asset('assets/plugins/chartist/chartist.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/plugins/chartist/chartist-plugin-tooltip.css')); ?>">

    <!--Full calendar css-->
    <link rel="stylesheet" href="<?php echo e(asset('assets/plugins/fullcalendar/stylesheet1.css')); ?>">

    <!--morris css-->
    <link rel="stylesheet" href="<?php echo e(asset('assets/plugins/morris/morris.css')); ?>">
    <!--mutli css-->
    <link rel="stylesheet" href="<?php echo e(asset('assets/plugins/multi/multi.min.css')); ?>">


    <!--mutipleselect css-->
    <link rel="stylesheet" href="<?php echo e(asset('assets/plugins/multipleselect/multiple-select.css')); ?>">

    <!--Tempusdominus css-->
    <link rel="stylesheet"
        href="<?php echo e(asset('assets/plugins/tempusdominus-bootstrap-4/tempusdominus-bootstrap-4.css')); ?>">
    <!--Datatables css-->
    <link rel="stylesheet" href="<?php echo e(asset('assets/plugins/Datatable/css/dataTables.bootstrap4.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/plugins/Datatable/css/buttons.bootstrap4.min.css')); ?>">



<!-- Bootstrap Select CSS and JS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta3/css/bootstrap-select.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta3/js/bootstrap-select.min.js"></script>


<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        clifford: "#da373d",
                    },
                },
            },
        };
    </script>

    <style>
        #example_paginate{
            display: none !important;
        }
        #example_info{
            display: none !important;
        }
    </style>
</head>

<body class="app ">

    <!--Header Style -->
    

    <!--loader -->
    <div id="spinner"></div>

    <!--app open-->
    <div id="app" class="page">
        <div class="main-wrapper">

            <!--nav open-->
            <nav class="navbar navbar-expand-lg main-navbar">
                <a href="#" data-toggle="sidebar" class="nav-link nav-link toggle"><i class="fa fa-reorder"></i></a>
                <a class="header-brand" href="index.html">
                    <p>
                        <header>
                            <h3 style="color:#ffffff;font-weight:bold;">E-Abyana</h3>
                            <!--<h1>
        <?php if(session()->has('name')): ?>
Welcome, <?php echo e(session('name')); ?>!
<?php else: ?>
Welcome to E ABYANA
<?php endif; ?>
       </h1> -->
                        </header>
                    </p>
                </a>
                <!--<form class="form-inline">
      <ul class="navbar-nav mr-2">
       <li><a href="#" data-toggle="sidebar" class="nav-link nav-link toggle"><i class="fa fa-reorder"></i></a></li>
       <li><a href="#" data-toggle="search" class="nav-link nav-link d-md-none navsearch"><i class="fa fa-search"></i></a></li>
      </ul>
      <div class="search-element mr-3">
       <input class="form-control" type="search" placeholder="Search" aria-label="Search">
       <span class="Search-icon"><i class="fa fa-search"></i></span>
      </div>
     </form> -->
                <ul class="navbar-nav ml-auto">
                  <!--  <li class="dropdown dropdown-list-toggle d-none d-lg-block">
                        <a href="#" class="nav-link nav-link-lg full-screen-link">
                            <i class="fa fa-expand " id="fullscreen-button"></i>
                        </a>
                    </li> -->
                    <li class="dropdown"><a href="#" data-toggle="dropdown"
                            class="nav-link dropdown-toggle nav-link-lg d-flex">
                            <span class="mr-3 mt-2 d-none d-lg-block ">
                                <span class="text-white"><!--Hello,--><span class="ml-1">
                                        <?php if(session()->has('name')): ?>
                                            <?php echo e(session('name')); ?>

                                        <?php else: ?>
                                            Welcome to E ABYANA
                                        <?php endif; ?>
                                    </span></span>
                            </span>
                            <span><img src="<?php echo e(asset('assets/img/avatar/avatar.png')); ?>" alt="profile-user"
                                    class="rounded-circle w-32 mr-2"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <div class=" dropdown-header noti-title text-center border-bottom pb-3">
                                <h5 class="text-capitalize text-dark mb-1">
                                    <?php if(session()->has('name')): ?>
                                        <?php echo e(session('name')); ?>

                                    <?php else: ?>
                                        Welcome to E ABYANA
                                    <?php endif; ?>
                                </h5>
                                <small class="text-overflow m-0">System User</small>
                            </div>
                            <!--<a class="dropdown-item" href="profile.html"><i class="mdi mdi-account-outline mr-2"></i> <span>My profile</span></a>
        <a class="dropdown-item" href="#"><i class="mdi mdi-settings mr-2"></i> <span>Settings</span></a>
        <a class="dropdown-item" href="#"><i class=" mdi mdi-message-outline mr-2"></i> <span>Mails</span></a>
        <a class="dropdown-item" href="#"><i class=" mdi mdi-account-multiple-outline mr-2"></i> <span>Friends</span></a>
        <a class="dropdown-item" href="#"><i class="fe fe-calendar mr-2"></i> <span>Activity</span></a>
        <a class="dropdown-item" href="#"><i class="mdi mdi-compass-outline mr-2"></i> <span>Support</span></a> -->
                            <div class="dropdown-divider"></div><a class="dropdown-item"
                                href="<?php echo e(route('logout')); ?>"><i class="mdi  mdi-logout-variant mr-2"></i>
                                <span>Logout</span></a>
                        </div>
                    </li>
                </ul>
            </nav>
            <!--nav closed-->

            <!--aside open-->
            <aside class="app-sidebar">
                <div class="app-sidebar__user">
                    <div class="dropdown user-pro-body text-center">
                        <div class="nav-link pl-1 pr-1 leading-none d-flex justify-content-center">
                            <img src="<?php echo e(asset('assets/img/avatar/logo.jpg')); ?>" alt="user-img"
                                class="avatar-xl rounded-circle mb-1">
                        </div>
                        <div class="user-info">
                            <h6 class=" mb-1 text-dark">
                                <?php if(session()->has('name')): ?>
                                    <?php echo e(session('name')); ?>

                                <?php else: ?>
                                    Welcome to E ABYANA
                                <?php endif; ?>
                            </h6>
                            <span class="text-muted app-sidebar__user-name text-sm">Irrigation Department</span>
                        </div>
                    </div>
                </div>
                <ul class="side-menu">

                <li class="slide">
                        <a class="side-menu__item" data-toggle="slide" href="<?php echo e(url('dashboard')); ?>">
                            <i class="side-menu__icon fas fa-home"></i>
                            <span class="side-menu__label">Dashboard</span>
                        </a>
                </li>
                <?php if(session('role_id')!=15 && session('role_id')!=16 && session('role_id')!=17): ?> 
                    <li class="slide">
                        <a class="side-menu__item" data-toggle="slide" href="#">
                            <i class="side-menu__icon fas fa-user-friends"></i> <!-- Change this to a working icon -->
                            <span class="side-menu__label">Manage Irrigators</span>
                            <span class=""></span>
                        </a>
                        <ul class="slide-menu">
                            <li>
                                <a class="slide-item" href="<?php echo e(route('AddIrragtor')); ?>">

                                     <!-- Replace with the appropriate icon class -->
                                    <span>Add Irrigator</span>
                                </a>
                            </li>

                            <!-- <li><a class="slide-item" href="<?php echo e(url('ListIrrigator')); ?>"><span>
                                        ListIrrigator</span></a></li> -->
                        </ul>
                    </li>
                    <?php endif; ?>

                    <li class="slide">
                        <a class="side-menu__item" data-toggle="slide" href="#">
                            <i class="side-menu__icon fas fa-clipboard-list"></i>
                            <span class="side-menu__label">Manage Surveys</span>
                        </a>
                        <ul class="slide-menu">
                            <?php if(session('role_id') == 12 || session('role_id') == 17 || session('role_id') == 1): ?> 
                                <li><a class="slide-item" href="<?php echo e(url('ListLandSurvey')); ?>"><span>  Survey</span></a></li>
                                <li><a class="slide-item" href="<?php echo e(url('listforwardedpatwari')); ?>"><span> List Forwarded Patwari</span></a></li>
                            <?php endif; ?>
                            <?php if(session('role_id') == 15 || session('role_id') == 1): ?> 
                                <li><a class="slide-item" href="<?php echo e(url('ListLandSurveyZilladar')); ?>"><span> Zilladar Survey</span></a></li>
                                <li><a class="slide-item" href="<?php echo e(url('listforwardedzilladar')); ?>"><span> List Forwarded Zilladar</span></a></li>
                            <?php endif; ?>
                            <?php if(session('role_id') == 16 || session('role_id') == 1): ?> 
                                <li><a class="slide-item" href="<?php echo e(url('ListLandSurveyCollector')); ?>"><span> D Collector Survey</span></a></li>
                                <li><a class="slide-item" href="<?php echo e(url('listforwardedcollertor')); ?>"><span> D Collector forwarded</span></a></li>
                            <?php endif; ?>
                            <?php if(session('role_id') == 12 || session('role_id') == 17 || session('role_id') == 1): ?> 
                            <li><a class="slide-item" href="<?php echo e(url('ListBills')); ?>"><span> View Bills</span></a></li>
                        <?php endif; ?>
                        </ul>
                        
                    </li>
                    <?php if(session('role_id') == 17 || session('role_id') == 1): ?> 
                    <li class="slide">
                        <a class="side-menu__item" data-toggle="slide" href="<?php echo e(url('dashboard')); ?>">
                        <i class="side-menu__icon fas fa-file-invoice-dollar"></i>
                            <span class="side-menu__label">Manage Bills</span>
                        </a>
                        <ul class="slide-menu">
                          
                            <li><a class="slide-item" href="<?php echo e(url('ListIrrigatorsForApprovals')); ?>"><span> Approvals</span></a></li>
                            <li><a class="slide-item" href="<?php echo e(url('ListIrrigatorsForBills')); ?>"><span> Generate Bill</span></a></li>
                        </ul>
                    </li>
                    <?php endif; ?>
                    <?php if(session('role_id') == 17 || session('role_id') == 1 || session('role_id') == 16): ?> 
                    <li class="slide">
                        <a class="side-menu__item" data-toggle="slide" href="<?php echo e(url('dashboard')); ?>">
                        <i class="side-menu__icon fas fa-file-invoice"></i>
                            <span class="side-menu__label">Reports</span>
                        </a>
                        <ul class="slide-menu">
                          
                            <li><a class="slide-item" href="<?php echo e(url('ReportViewKhatoni')); ?>"><span> Khatoni Report</span></a></li>
                            <li><a class="slide-item" href="<?php echo e(url('ListIrrigatorsForBills')); ?>"><span> Ghoswara Report</span></a></li>
                        </ul>
                    </li>
                     <?php endif; ?>
                  <!--  <li class="slide">
                        <a class="side-menu__item" data-toggle="slide" href="#">
                            <i class="side-menu__icon fas fa-seedling"></i> 
                            <span class="side-menu__label">Manage Farmer Land</span>
                            <span class=""></span>
                        </a>
                        <ul class="slide-menu">
                            <li>
                                <a class="slide-item" href="<?php echo e(url('LandRecord')); ?>">
                                    <i class="fas fa-seedling"></i> 
                                    <span>Add Farmer</span>
                                </a>
                            </li>

                            <li><a class="slide-item" href="<?php echo e(url('ListLandSurvey')); ?>"><span>List Land
                                        Survey</span></a></li>
                        </ul>
                    </li> -->
                    <!-- <li class="slide">
							<a class="side-menu__item" data-toggle="slide" href="#">
								<i class="side-menu__icon fa fa-file-alt"></i> 
								<span class="side-menu__label">Demand Statement</span>
								<span class="badge badge-orange nav-badge"></span>
							</a>
							<ul class="slide-menu">
								<li><a class="slide-item" href="<?php echo e(url('AddDemendStatement')); ?>"><span>Demand Statement</span></a></li>
								<li><a class="slide-item" href="<?php echo e(url('form')); ?>"><span>List Farmer</span></a></li>
							</ul>
						</li> -->

                    <?php if(session('role_id')==1): ?>
                    <li class="slide">
                        <a class="side-menu__item" data-toggle="slide" href="#">
                            <i class="side-menu__icon fa fa-cog"></i> <!-- Settings icon -->
                            <span class="side-menu__label">Setting</span>
                            <span class="badge badge-orange nav-badge"></span>
                        </a>
                        <ul class="slide-menu">
                            <li><a class="slide-item" href="<?php echo e(route('AddDivsion')); ?>">
                                <span> Add Division (ڈویژن)</</span>
                            </button>
                                    </a></li>
                            <li><a class="slide-item" href="<?php echo e(route('AddDistrict')); ?>"><span>Add
                                        District (ضلع)</span></a></li>
                            <li><a class="slide-item" href="<?php echo e(route('AddTahsil')); ?>"><span>Add
                                        Tehsil (تحصیل)</span></a></li>
                            <li><a class="slide-item" href="<?php echo e(route('AddHalqa')); ?>"><span>Add Halqa (حلقہ)</span></a>
                            </li>
                         
                            <li><a class="slide-item" href="<?php echo e(route('AddVillage')); ?>"><span>Village (موضع)</span></a></li>
                            <li><a class="slide-item" href="<?php echo e(route('AddCanal')); ?>"><span>Add Canal (نہر)</span></a>
                            </li>
                            <li><a class="slide-item" href="<?php echo e(route('AddMinor-Canal')); ?>"><span>Add Distry (شاخ نہر)</span></a>
                            </li>
                            <li><a class="slide-item" href="<?php echo e(route('Distributary')); ?>"><span>Add Minor / Branch (فرعی نہر)</span></a>
                            </li>
                            <li><a class="slide-item" href="<?php echo e(route('CanalOutlet')); ?>"><span>Outlet (آؤٹ لیٹ)</span></a></li>
                            
                            <li><a class="slide-item" href="<?php echo e(route('Addprice')); ?>"><span>Add Crop Price</span></a>
                            </li>
                        </ul>
                </li>
                <li class="slide">
                    <a class="side-menu__item" data-toggle="slide" href="#">
                    <i class="side-menu__icon fas fa-users"></i>
                        <span class="side-menu__label">User Management</span>
                        <span class="badge badge-orange nav-badge"></span>
                    </a>
                    <ul class="slide-menu">
                        <li><a class="slide-item" href="<?php echo e(url('AddRoles')); ?>"><span>Add Roles</span></a></li>
                        
                        <li><a class="slide-item" href="<?php echo e(url('AddUser')); ?>"><span>Add User</span></a></li>
                    </ul>
                </li> 
                <?php endif; ?>
            </aside>
            <!--aside closed-->

            <!--app-content open-->
            <?php echo $__env->yieldContent('content'); ?>
            <!--app-content closed-->

            <!-- Popupchat open
            <div class="popup-box chat-popup" id="qnimate">
                <div class="popup-head">
                    <div class="popup-head-left pull-left"><img src="<?php echo e(asset('assets/img/avatar/avatar-3.jpeg')); ?>"
                            alt="iamgurdeeposahan" class="mr-2"> Alica Nestle</div>
                    <div class="popup-head-right pull-right">
                        <div class="btn-group">
                            <button class="chat-header-button" data-toggle="dropdown" type="button"
                                aria-expanded="false">
                                <i class="glyphicon glyphicon-cog"></i> </button>
                            <ul role="menu" class="dropdown-menu dropdown-menu-right">
                                <li><a href="#">Media</a></li>
                                <li><a href="#">Block</a></li>
                                <li><a href="#">Clear Chat</a></li>
                                <li><a href="#">Email Chat</a></li>
                            </ul>
                        </div>
                        <button data-widget="remove" id="removeClass" class="chat-header-button pull-right"
                            type="button"><i class="glyphicon glyphicon-off"></i></button>
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
                            <img class="direct-chat-img" src="<?php echo e(asset('assets/img/avatar/avatar-3.jpeg')); ?>"
                                alt="message user image">
                            <div class="direct-chat-text">
                                Hello. How are you today?
                            </div>
                        </div>
                        <div class="direct-chat-msg right">
                            <div class="direct-chat-info clearfix">
                                <span class="direct-chat-name float-right">Roberts</span>
                                <span class="direct-chat-timestamp float-left">8:05 Am</span>
                            </div>
                            <img class="direct-chat-img" src="<?php echo e(asset('assets/img/avatar/avatar-2.jpeg')); ?>"
                                alt="message user image">
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
                            <img alt="iamgurdeeposahan" src="<?php echo e(asset('assets/img/avatar/avatar-3.jpeg')); ?>"
                                class="direct-chat-img">
                            <div class="direct-chat-text">
                                Hey bro, how’s everything going ?
                            </div>
                            <div class="direct-chat-msg right">
                                <div class="direct-chat-info clearfix">
                                    <span class="direct-chat-name float-right">Roberts</span>
                                    <span class="direct-chat-timestamp float-left">7:05 Am</span>
                                </div>
                                <img class="direct-chat-img" src="<?php echo e(asset('assets/img/avatar/avatar-2.jpeg')); ?>"
                                    alt="message user image">
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
            Popupchat closed -->

        </div>

        <!--Footer-->
        <footer class="main-footer">
        <div class="text-center">copyright &copy; <strong>E-Abyana</strong> - Irrigation Department KPK&nbsp;&nbsp;|&nbsp;&nbsp;Developed  By <a href="https://www.kpitb.gov.pk/">KPITB</a>&nbsp;&&nbsp;<a href="https://codeforpakistan.org/">CodeForPakistan</a></div>
        </footer>
        <!--/Footer-->
    </div>
    <!--app closed-->

    <!-- Back to top -->
    <a href="#top" id="back-to-top"><i class="fa fa-angle-up"></i></a>

    <!-- Popup-chat 
    <a href="#" id="addClass"><i class="ti-comment"></i></a> -->

 

    <!--popper js-->
    <script src="<?php echo e(asset('assets/js/popper.js')); ?>"></script>

    <!--Bootstrap.min js-->
    <script src="<?php echo e(asset('assets/plugins/bootstrap/js/bootstrap.min.js')); ?>"></script>

    <!--Tooltip js-->
    <script src="<?php echo e(asset('assets/js/tooltip.js')); ?>"></script>

    <!-- Jquery star rating-->
    <script src="<?php echo e(asset('assets/plugins/rating/jquery.rating-stars.js')); ?>"></script>

    <!--Jquery.nicescroll.min js-->
    <script src="<?php echo e(asset('assets/plugins/nicescroll/jquery.nicescroll.min.js')); ?>"></script>

    <!--Scroll-up-bar.min js-->
    <script src="<?php echo e(asset('assets/plugins/scroll-up-bar/dist/scroll-up-bar.min.js')); ?>"></script>

    <!--Sidemenu js-->
    <script src="<?php echo e(asset('assets/plugins/toggle-menu/sidemenu.js')); ?>"></script>

    <!--p-scrollbar js-->
    <script src="<?php echo e(asset('assets/plugins/p-scroll/perfect-scrollbar.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/plugins/p-scroll/p-scroll.js')); ?>"></script>

    <!-- jQuery Sparklines -->
    <script src="<?php echo e(asset('assets/plugins/jquery-sparkline/dist/jquery.sparkline.js')); ?>"></script>

    <!--Jquery.knob js-->
    <script src="<?php echo e(asset('assets/plugins/othercharts/jquery.knob.js')); ?>"></script>

    <!--Jquery.sparkline js-->
    <script src="<?php echo e(asset('assets/plugins/othercharts/jquery.sparkline.min.js')); ?>"></script>

    <!--Chart js-->
    <script src="<?php echo e(asset('assets/js/chart.min.js')); ?>"></script>

    <!--Dashboard js-->
    <script src="<?php echo e(asset('assets/js/dashboard4.js')); ?>"></script>

    <!--Other Charts js-->
    <script src="<?php echo e(asset('assets/plugins/othercharts/jquery.sparkline.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/othercharts.js')); ?>"></script>

    <!--Sparkline js-->
    <script src="<?php echo e(asset('assets/js/sparkline.js')); ?>"></script>

    <!--Showmore js-->
    <script src="<?php echo e(asset('assets/js/jquery.showmore.js')); ?>"></script>

    <!--Scripts js-->
    <script src="<?php echo e(asset('assets/js/scripts.js')); ?>"></script>

    <!--multi js-->
    <script src="<?php echo e(asset('assets/plugins/multi/multi.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/formelementadvnced.js')); ?>"></script>

  
    <!--MutipleSelect js-->
    <script src="<?php echo e(asset('assets/plugins/multipleselect/multiple-select.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/plugins/multipleselect/multi-select.js')); ?>"></script>

    <!--Accordion-Wizard-Form js-->
    <script src="<?php echo e(asset('assets/plugins/accordion-Wizard-Form/jquery.accordion-wizard.min.js')); ?>"></script>

    <!--Tempusdominus js-->
    <script src="<?php echo e(asset('assets/plugins/tempusdominus-bootstrap-4/tempusdominus-bootstrap-4.js')); ?>"></script>

    <!--DataTables js-->
    <script src="<?php echo e(asset('assets/plugins/Datatable/js/jquery.dataTables.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/plugins/Datatable/js/dataTables.bootstrap4.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/plugins/Datatable/js/dataTables.buttons.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/plugins/Datatable/js/buttons.bootstrap4.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/plugins/Datatable/js/jszip.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/plugins/Datatable/js/pdfmake.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/plugins/Datatable/js/vfs_fonts.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/plugins/Datatable/js/buttons.html5.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/plugins/Datatable/js/buttons.print.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/plugins/Datatable/js/buttons.colVis.min.js')); ?>"></script>

    <script src="<?php echo e(asset('assets/js/datatable.js')); ?>"></script>
    <!--Advanced Froms -->
    <script src="<?php echo e(asset('assets/js/advancedform.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/forms.js')); ?>"></script>
    <?php if(Session::has('success')): ?>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: "<?php echo e(Session::get('success')); ?>",
                timer: 3000, // Close after 3 seconds
                showConfirmButton: false
                <?php if(Session::has('success')): ?>
                   <div class = "alert alert-success" >
                    <?php echo e(Session::get('success')); ?>

                    </div>
                <?php endif; ?>

                <?php if(Session::has('error')): ?>
                    <
                    div class = "alert alert-danger" >
                    <?php echo e(Session::get('error')); ?>

                        <
                        /div>
                <?php endif; ?>

            });
        </script>
    <?php endif; ?>

    <!-- JavaScript to Show/Hide Modal -->
    <script>
        const modal = document.getElementById("simpleModal");

        function openModal() {
            modal.classList.remove("hidden"); // Show modal
        }

        function closeModal() {
            modal.classList.add("hidden"); // Hide modal
        }
    </script>
<script>
    $(document).ready(function() {
        $('.select_search').select2();
        // Fetch Canals based on Division selection
       $('#div_id').change(function() {
            var division_id = $(this).val();
            $('#canal_id').empty().append('<option value="">Choose Canal</option>');
            $('#minor_id').empty().append('<option value="">Choose Minor Canal</option>');
            $('#distrib_id').empty().append('<option value="">Choose Distributary</option>');

            if (division_id) {
                $.ajax({
                    url: "<?php echo e(route('fetchCanals')); ?>",
                    type: "GET",
                    data: { division_id: division_id },
                    success: function(data) {
                        $.each(data, function(index, canal) {
                            $('#canal_id').append('<option value="' + canal.id + '">' + canal.canal_name + '</option>');
                        });
                    }
                });
            }
        });

        // Fetch Minor Canals based on Canal selection
        $('#canal_id').change(function() {
            var canal_id = $(this).val();
            $('#minor_id').empty().append('<option value="">Choose Minor Canal</option>');
            $('#distrib_id').empty().append('<option value="">Choose Distributary</option>');

            if (canal_id) {
                $.ajax({
                    url: "<?php echo e(route('fetchMinorCanals')); ?>",
                    type: "GET",
                    data: { canal_id: canal_id },
                    success: function(data) {
                        $.each(data, function(index, minor) {
                            $('#minor_id').append('<option value="' + minor.id + '">' + minor.minor_name + '</option>');
                        });
                    }
                });
            }
        });

        // Fetch Distributary Canals based on Minor Canal selection
        $('#minor_id').change(function() {
            var minor_id = $(this).val();
            $('#distrib_id').empty().append('<option value="">Choose Distributary</option>');

            if (minor_id) {
                $.ajax({
                    url: "<?php echo e(route('fetchDistributaryCanals')); ?>",
                    type: "GET",
                    data: { minor_id: minor_id },
                    success: function(data) {
                        $.each(data, function(index, distributary) {
                            $('#distrib_id').append('<option value="' + distributary.id + '">' + distributary.name + '</option>');
                        });
                    }
                });
            }
        });
    });
</script>

</body>

</html>
<?php /**PATH C:\xampp\htdocs\durshal_cfp\abyana\resources\views/layout.blade.php ENDPATH**/ ?>