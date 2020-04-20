<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

session_start();

if (!isset($_SESSION['user_id'])) {
    header("location: login.php");
    die;
}






$title = "Inventory|New Product";
include 'api/config/database.php';

$sql = "SELECT id, item_name FROM new_product";

$database = new Database();
$con = $database->getConnection();
$result = mysqli_query($con, $sql);
?>



<!doctype html>
<html lang="en-US">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
        <title><?php echo $title; ?></title>
        <meta name="description" content="" />
        <meta name="Author" content="Dorin Grigoras [www.stepofweb.com]" />

        <!-- mobile settings -->
        <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0" />

        <!-- WEB FONTS -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700,800&amp;subset=latin,latin-ext,cyrillic,cyrillic-ext" rel="stylesheet" type="text/css" />

        <!-- CORE CSS -->
        <link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />

        <!-- THEME CSS -->
        <link href="assets/css/essentials.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/layout.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/color_scheme/green.css" rel="stylesheet" type="text/css" id="color_scheme" />
        <link rel="stylesheet" href="css/styles.css"/>
        <link href="assets/css/layout-datatable.css" rel="stylesheet" type="text/css" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet"/>

    </head>
    <!--
            .boxed = boxed version
    -->
    <body>


        <!-- WRAPPER -->
        <div id="wrapper">

            <!-- 
                    ASIDE 
                    Keep it outside of #wrapper (responsive purpose)
            -->
            <aside id="aside">
                <!--
                        Always open:
                        <li class="active alays-open">

                        LABELS:
                                <span class="label label-danger pull-right">1</span>
                                <span class="label label-default pull-right">1</span>
                                <span class="label label-warning pull-right">1</span>
                                <span class="label label-success pull-right">1</span>
                                <span class="label label-info pull-right">1</span>
                -->
             <nav id="sideNav"><!-- MAIN MENU -->
                    <ul class="nav nav-list">
                        <li><!-- dashboard -->
                            <a class="dashboard" href="home.php"><!-- warning - url used by default by ajax (if eneabled) -->
                                <i class="main-icon fa fa-dashboard"></i> <span>Dashboard</span>
                            </a>
                        </li>


                        <li><!-- dashboard -->
                            <a class="dashboard" href="newitem.php"><!-- warning - url used by default by ajax (if eneabled) -->
                                <i class="main-icon fa fa-edit"></i> <span>Create Item</span>
                            </a>
                        </li>



                        <li><!-- dashboard -->
                            <a class="dashboard" href="adjuststock.php"><!-- warning - url used by default by ajax (if eneabled) -->
                                <i class="main-icon fa fa-edit"></i> <span>Adjust Stock</span>
                            </a>
                        </li>



                        <li>
                            <a href="#">
                                <i class="fa fa-menu-arrow pull-right"></i>
                                <i class="main-icon fa fa-pencil-square-o"></i> <span>Reports</span>
                            </a>
                            <ul><!-- submenus -->
                                <li><!-- dashboard -->
                                    <a class="dashboard" href="ledgerentry.php"><!-- warning - url used by default by ajax (if eneabled) -->
                                        <i class="main-icon fa fa-edit"></i> <span>Item Ledger entry</span>
                                    </a>
                                </li>
                                <li><!-- dashboard -->
                                    <a class="dashboard" href="index.php"><!-- warning - url used by default by ajax (if eneabled) -->
                                        <i class="main-icon fa fa-edit"></i> <span>View Items</span>
                                    </a>
                                </li>

                            </ul>
                        </li>


                    </ul>

                    <!-- SECOND MAIN LIST -->



                </nav>

                <span id="asidebg"><!-- aside fixed background --></span>
            </aside>
            <!-- /ASIDE -->


            <!-- HEADER -->
            <header id="header">

                <!-- Mobile Button -->
                <button id="mobileMenuBtn"></button>

                <!-- Logo -->
                <span class="logo pull-left">
                                       <img src="assets/images/bulogo.png" alt="admin panel" height="35" />

                </span>

                <form method="get" action="page-search.html" class="search pull-left hidden-xs">
                    <input type="text" class="form-control" name="k" placeholder="Search for something..." />
                </form>

                <nav>

                    <!-- OPTIONS LIST -->
                    <ul class="nav pull-right">

                        <!-- USER OPTIONS -->
                        <li class="dropdown pull-left">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                <img class="user-avatar" alt="" src="assets/images/noavatar.jpg" height="34" /> 
                                <span class="user-name">
                                    <span class="hidden-xs">
                                        <?php echo $_SESSION["username"]; ?> <i class="fa fa-angle-down"></i>
                                    </span>
                                </span>
                            </a>
                            <ul class="dropdown-menu hold-on-click">
                                
                                
                                <li><!-- settings -->
                                    <a href="page-user-profile.html"><i class="fa fa-cogs"></i> Settings</a>
                                </li>

                                
                                <li><!-- logout -->
                                    <a href="login.php?logout=1"><i class="fa fa-power-off"></i> Log Out</a>
                                </li>
                            </ul>
                        </li>
                        <!-- /USER OPTIONS -->

                    </ul>
                    <!-- /OPTIONS LIST -->

                </nav>

            </header>
            <!-- /HEADER -->


            <!-- 
                    MIDDLE 
            -->
            <section id="middle">


                <!-- page title -->
                <header id="page-header">
                    <h1>Adjust Stock </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php">Home</a></li>
                        <li class="active">Adjust Stock</li>
                    </ol>
                </header>
                <!-- /page title -->


                <div id="content" class="padding-20">

                    <form>
                        <fieldset>




                            <div class="form-group">
                                <label>Item Name.*</label>

                                <input id="item" placeholder="Select Item Name" list="itemname" name="itemname" class="form-control select2">
                                <datalist id="itemname">
                                    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                                        <option value="<?= $row["item_name"]; ?>"></option>
                                    <?php } ?>   
                                </datalist>
                                <!--
                                        .fancy-arrow
                                        .fancy-arrow-double
                                -->


                            </div>


                            <div class="form-group">
                                <label>Adjustment Type*</label>
                                <select id="adjustmenttype" class="form-control">
                                    <option value="">--- Adjustment Type ---</option>
                                    <option value="positive">Positive</option>
                                    <option value="negative">Negative</option>
                                   
                                </select>
                            </div>


                            <div class="form-group">
                                <label>Quantity *</label>
                                <input id="quantity" placeholder="Quantity Added or taken out" value=""  type="number" id="openingstock"  class="form-control required">
                            </div>

                            <div class="form-group">
                                <label>Reason* </label>
                                <input id="reason" placeholder="Reason for Adjustment" value="" type="text" id="optimal"  class="form-control required">
                            </div>
















                        </fieldset>
                        <input id="b" type="button" onclick="createAdjustment()" class="btn btn-teal btn-lg" value="Post">



                    </form>

                </div>
            </section>
            <!-- /MIDDLE -->

        </div>
        <footer class="page-footer text-center font-small">
            <div class="container">
                <p> &copy; 2015-<?php
                                    $today = date(Y);
                                    echo $today;
                                    ?> Codershift.com</p>
            </div>
        </footer>



        <!-- JAVASCRIPT FILES -->
        <script type="text/javascript">var plugin_path = 'assets/plugins/';</script>
        <script type="text/javascript">var plugin_path = 'assets/plugins/';</script>
        <script type="text/javascript" src="assets/plugins/jquery/jquery-2.2.3.min.js"></script>
        <script type="text/javascript" src="assets/js/app.js"></script>
        <script type="text/javascript" src="myjs/tables.js"></script>
        <script type="text/javascript" src="myjs/myjs.js"></script>

        <script>

        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>


    </body>


</html>