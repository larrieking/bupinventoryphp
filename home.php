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

$all = "SELECT * FROM new_product ORDER BY id ASC";
$understock = "SELECT * FROM new_product WHERE opening_stock <= understock";
$overstock = "SELECT * FROM new_product WHERE opening_stock >= overstock";
$optimal = "SELECT * FROM new_product WHERE opening_stock = optimal";
$ledgerentry = "SELECT * FROM stock_adjustment ORDER BY id DESC LIMIT 7";
$ledgerentry1 = "SELECT id, item_name, created_by, opening_stock, date FROM new_product ORDER BY id DESC LIMIT 7";

$database = new Database();
$con = $database->getConnection();
$resultunderstock = mysqli_query($con, $understock);
$resultall = mysqli_query($con, $all);
$resultoverstock = mysqli_query($con, $overstock);
$resultoptimal = mysqli_query($con, $optimal);
$tenledger = mysqli_query($con, $ledgerentry);
$tenitem = mysqli_query($con, $ledgerentry1);
?>






<!doctype html>
<html lang="en-US">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
        <title>Inventory|Items</title>
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
                                <li><!-- my calendar -->
                                    <a href="calendar.html"><i class="fa fa-calendar"></i> <?php echo $_SESSION["user_id"]; ?></a>
                                </li>
                                <li><!-- my inbox -->
                                    <a href="#"><i class="fa fa-envelope"></i> Inbox
                                        <span class="pull-right label label-default">0</span>
                                    </a>
                                </li>
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


                <header id="page-header">
                    <h1>Dashboard</h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php">Home</a></li>
                        <li class="active">Dashboard</li>
                    </ol>
                </header>


                <div id="content" class="padding-20">

                    <!-- BOXES -->
                    <div class="row">

                        <!-- Feedback Box -->
                        <div class="col-md-3 col-sm-6">

                            <!-- BOX -->
                            <div class="box danger"><!-- default, danger, warning, info, success -->

                                <div class="box-title"><!-- add .noborder class if box-body is removed -->
                                    <h4><a href="index.php"><?= mysqli_num_rows($resultall); ?> Items</a></h4>
                                    <small class="block"><?= mysqli_num_rows($resultall); ?>  Total items.</small>
                                    <i class="fa fa-comments"></i>
                                </div>

                                <div class="box-body text-center">
                                    <span class="sparkline" data-plugin-options='{"type":"bar","barColor":"#ffffff","height":"35px","width":"100%","zeroAxis":"false","barSpacing":"2"}'>
                                        331,265,456,411,367,319,402,312,300,312,283,384,372,269,402,319,416,355,416,371,423,259,361,312,269,402,327
                                    </span>
                                </div>

                            </div>
                            <!-- /BOX -->

                        </div>

                        <!-- Profit Box -->
                        <div class="col-md-3 col-sm-6">

                            <!-- BOX -->
                            <div class="box warning"><!-- default, danger, warning, info, success -->

                                <div class="box-title"><!-- add .noborder class if box-body is removed -->
                                    <h4><a href="index.php?id=understock"><?= mysqli_num_rows($resultunderstock); ?> Understock</a></h4>
                                    <small class="block"><?= mysqli_num_rows($resultunderstock); ?> items are below re-order levels</small>
                                    <i class="fa fa-bar-chart-o"></i>
                                </div>

                                <div class="box-body text-center">
                                    <span class="sparkline" data-plugin-options='{"type":"bar","barColor":"#ffffff","height":"35px","width":"100%","zeroAxis":"false","barSpacing":"2"}'>
                                        331,265,456,411,367,319,402,312,300,312,283,384,372,269,402,319,416,355,416,371,423,259,361,312,269,402,327
                                    </span>
                                </div>

                            </div>
                            <!-- /BOX -->

                        </div>

                        <!-- Orders Box -->
                        <div class="col-md-3 col-sm-6">

                            <!-- BOX -->
                            <div class="box default"><!-- default, danger, warning, info, success -->

                                <div class="box-title"><!-- add .noborder class if box-body is removed -->
                                    <h4><a href="index.php?id=overstock"><?= mysqli_num_rows($resultoverstock); ?>  Overstock</a></h4>
                                    <small class="block"><?= mysqli_num_rows($resultoverstock); ?> Items are overstocked</small>
                                    <i class="fa fa-shopping-cart"></i>
                                </div>

                                <div class="box-body text-center">
                                    <span class="sparkline" data-plugin-options='{"type":"bar","barColor":"#ffffff","height":"35px","width":"100%","zeroAxis":"false","barSpacing":"2"}'>
                                        331,265,456,411,367,319,402,312,300,312,283,384,372,269,402,319,416,355,416,371,423,259,361,312,269,402,327
                                    </span>
                                </div>

                            </div>
                            <!-- /BOX -->

                        </div>

                        <!-- Online Box -->
                        <div class="col-md-3 col-sm-6">

                            <!-- BOX -->
                            <div class="box success"><!-- default, danger, warning, info, success -->

                                <div class="box-title"><!-- add .noborder class if box-body is removed -->
                                    <h4><a href="index.php?id=optimal"><?= mysqli_num_rows($resultoptimal); ?>  Optimal </a></h4>
                                    <small class="block"><?= mysqli_num_rows($resultoptimal); ?>   items are at optimum level</small>
                                    <i class="fa fa-globe"></i>
                                </div>

                                <div class="box-body text-center">
                                    <span class="sparkline" data-plugin-options='{"type":"bar","barColor":"#ffffff","height":"35px","width":"100%","zeroAxis":"false","barSpacing":"2"}'>
                                        331,265,456,411,367,319,402,312,300,312,283,384,372,269,402,319,416,355,416,371,423,259,361,312,269,402,327
                                    </span>
                                </div>

                            </div>
                            <!-- /BOX -->

                        </div>

                    </div>
                    <!-- /BOXES -->


                    <div class="row">

                        <div class="col-md-12">

                            <!-- 
                                    PANEL CLASSES:
                                            panel-default
                                            panel-danger
                                            panel-warning
                                            panel-info
                                            panel-success

                                    INFO: 	panel collapse - stored on user localStorage (handled by app.js _panels() function).
                                                    All pannels should have an unique ID or the panel collapse status will not be stored!
                            -->
                            <div id="panel-2" class="panel panel-default">
                                <div class="panel-heading">
                                    <span class="title elipsis">
                                        <strong>OVERVIEW</strong> <!-- panel title -->
                                    </span>

                                    <!-- tabs nav -->
                                    <ul class="nav nav-tabs pull-right">
                                        <li class="active"><!-- TAB 1 -->
                                            <a href="#ttab1_nobg" data-toggle="tab">Recent Entries</a>
                                        </li>
                                        <li class=""><!-- TAB 2 -->
                                            <a href="#ttab2_nobg" data-toggle="tab">Recent Items</a>
                                        </li>
                                    </ul>
                                    <!-- /tabs nav -->


                                </div>

                                <!-- panel content -->
                                <div class="panel-body">

                                    <!-- tabs content -->
                                    <div class="tab-content transparent">

                                        <div id="ttab1_nobg" class="tab-pane active"><!-- TAB 1 CONTENT -->

                                            <div class="table-responsive">
                                                <table class="table table-striped table-hover table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>Item Name</th>
                                                            <th>Adjusted By</th>
                                                            <th>Reason</th>
                                                            <th>Quantity</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>	
                                                        <?php while ($row = mysqli_fetch_assoc($tenledger)) { ?>
                                                            <tr>
                                                                <td><a href="ledgerentry.php?id=<?= $row['itemname']; ?>&table=stock_adjustment"><?= $row["itemname"] ?></a></td>
                                                                <td><?= $row["adjustedby"] ?></td>
                                                                <td><?= $row["reason"] ?></td>
                                                                <td><?= $row["newquantity"] ?></td>

                                                            </tr>
                                                        <?php } ?> 
                                                    </tbody>

                                                </table>

                                                <a class="size-12" href="ledgerentry.php">
                                                    <i class="fa fa-arrow-right text-muted"></i> 
                                                    All Item Ledger Entries..
                                                </a>

                                            </div>

                                        </div><!-- /TAB 1 CONTENT -->

                                        <div id="ttab2_nobg" class="tab-pane"><!-- TAB 2 CONTENT -->

                                            <div class="table-responsive">
                                                <table class="table table-striped table-hover table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>Product Name</th>
                                                            <th>Created By</th>
                                                            <th>Opening Stock</th>

                                                        </tr>
                                                    </thead>

                                                    <tbody>	
                                                        <?php while ($row = mysqli_fetch_assoc($tenitem)) { ?>
                                                            <tr>
                                                                <td><a href="#"><?= $row["item_name"] ?></a></td>
                                                                <td><?= $row["created_by"] ?></td>
                                                                <td><?= $row["opening_stock"] ?></td>


                                                            </tr>
                                                        <?php } ?> 
                                                    </tbody>

                                                </table>

                                                <a class="size-12" href="index.php">
                                                    <i class="fa fa-arrow-right text-muted"></i> 
                                                    View All Items
                                                </a>

                                            </div>

                                        </div><!-- /TAB 1 CONTENT -->

                                    </div>
                                    <!-- /tabs content -->

                                </div>
                                <!-- /panel content -->

                            </div>
                            <!-- /PANEL -->

                        </div>



                    </div>
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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>

        <script>

        </script>



    </body>


</html>