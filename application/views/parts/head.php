<?php
echo'

<!DOCTYPE html>
<html>
<head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <title>'.$title.'</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <link href="'.base_url().'assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="'.base_url().'assets/css/icons.css" rel="stylesheet" type="text/css" />
         <link href="'.base_url().'assets/plugins/datatables/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
         <link href="'.base_url().'assets/css/animate.css" rel="stylesheet" type="text/css" />
         <link href="'.base_url().'assets/plugins/sweet-alert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />
         <link href="'.base_url().'assets/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
         <link href="'.base_url().'assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
        <link href="'.base_url().'assets/css/style.css" rel="stylesheet" type="text/css" />
    </head>


    <body>

        <!-- Loader -->
        <div id="preloader"><div id="status"><div class="spinner"></div></div></div>

        <!-- Navigation Bar-->
        <header id="topnav">
            <div class="topbar-main">
                <div class="container-fluid">

                   


                    <div class="menu-extras topbar-custom">

                        

                        <ul class="list-inline float-right mb-0">
                            
                           
                            <!-- User-->
                            <li class="list-inline-item dropdown notification-list">
                                <a class="nav-link dropdown-toggle arrow-none waves-effect nav-user" data-toggle="dropdown" href="#" role="button"
                                   aria-haspopup="false" aria-expanded="false">
                                    <img src="assets/images/user.png" alt="user" class="rounded-circle">

                                    '.$_SESSION["name"].'
                                </a>
                                <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                                   <a class="dropdown-item" href="'.base_url().'profile"><i class="dripicons-user text-muted"></i> Profile</a> 
                                   <a class="dropdown-item" href="'.base_url().'logout"><i class="dripicons-exit text-muted"></i> Logout</a>
                                </div>
                            </li>
                            <li class="menu-item list-inline-item">
                                <!-- Mobile menu toggle-->
                                <a class="navbar-toggle nav-link">
                                    <div class="lines">
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                    </div>
                                </a>
                                <!-- End mobile menu toggle-->
                            </li>

                        </ul>
                    </div>
                    <!-- end menu-extras -->

                    <div class="clearfix"></div>

                </div> <!-- end container -->
            </div>
            <!-- end topbar-main -->

            <!-- MENU Start -->
            <div class="navbar-custom">
                <div class="container-fluid">
                    <div id="navigation">
                        <!-- Navigation Menu-->
                        <ul class="navigation-menu">



                            <li class="has-submenu">
                                <a href="'.base_url().'invoice"><i class="fa fa-ticket fa-fw"></i>Invoice</a>
                            </li>


                            <li class="has-submenu">
                                <a href="'.base_url().'receipts"><i class="fa fa-ticket fa-fw"></i>Reciepts</a>
                            </li>

                            <li class="has-submenu">
                                <a href="'.base_url().'credit-notes"><i class="fa fa-file-text-o fa-fw"></i>Credit Notes</a>
                            </li>

                            <li class="has-submenu">
                                <a href="'.base_url().'reports"><i class="fa fa-file-text fa-fw"></i>Report</a>
                            </li>

                            <li class="has-submenu">
                                <a href="'.base_url().'clients"><i class="fa fa-users fa-fw"></i>Clients</a>
                            </li>';

                            if($_SESSION['staff_type']=='1'){
                                echo'<li class="has-submenu">
                                <a href="'.base_url().'staff"><i class="fa fa-users fa-fw"></i>Staff</a>
                            </li>';
                            }
                               
                            echo '<li class="has-submenu">
                                <a href="'.base_url().'settings"><i class="fa fa-cogs fa-fw"></i>Settings</a>
                            </li>

                            
                        </ul>
                        <!-- End navigation menu -->
                    </div> <!-- end #navigation -->
                </div> <!-- end container -->
            </div> <!-- end navbar-custom -->
        </header>
        <!-- End Navigation Bar-->
';
?>