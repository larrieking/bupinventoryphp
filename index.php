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


$database = new Database();
$con = $database->getConnection();


$get = $_GET["id"];

if($get == "understock"){
$query = "SELECT * FROM new_product WHERE opening_stock <= understock";
}
elseif ($get == "overstock") {
$query = "SELECT * FROM new_product WHERE opening_stock >= overstock";
}
elseif ($get == "optimal") {
$query = "SELECT * FROM new_product WHERE opening_stock = optimal";

}

else{
    $query = "SELECT * FROM new_product ORDER BY id ASC";

}

$result = mysqli_query($con, $query);
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
        <link href=" https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" rel ="stylesheet"/>
        <link href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css" rel="stylesheet"/>

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
                                
                                <li><!-- my inbox -->
                                    <a href="#"><i class="fa fa-envelope"></i> Inbox
                                        <span class="pull-right label label-default">0</span>
                                    </a>
                                </li>
                                <li><!-- settings -->
                                    <a href="page-user-profile.html"><i class="fa fa-cogs"></i> Settings</a>
                                </li>

                                <li class="divider"></li>

                                
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
                    <h1>Items</h1>
                    <ol class="breadcrumb">
                        <li><a href="#">Home</a></li>
                        <li class="active">All Items</li>
                    </ol>
                </header>


                <div id="content" class="padding-20">

                    <div id = "ble" class = "table-responsive">
                        <table class="display nowrap table table-striped table-hover table-bordered" id="sample_editable_1">
                            <thead>
                                <tr>
                                    <th>Item No</th>
                                    <th>Item Name</th>
                                    <th>UOM</th>
                                    <th>Item Class</th>
                                    <th>Available stock</th>

                                    <th>Delete</th>
                                </tr>
                            </thead>

                            <tbody id = "t">
 <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                                <tr>
                                    <td><?= $row["item_no"]?></td>
                                     <td><?= $row["item_name"]?></td>
                                      <td><?= $row["uom"]?></td>
                                       <td><?= $row["item_class"]?></td>
                                        <td><?= $row["opening_stock"]?></td>
                                        <td><a href= '#' onClick = 'doDelete(<?=$row["id"]?>)'>Delete</a></td>
                                </tr>
                                    <?php } ?> 
                            </tbody>
                        </table>
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


        <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js "></script>
        <script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js "></script>
        <script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.flash.min.js"> </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js "></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js "></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js "></script>
        <script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js "></script>
        <script src="ttps://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>

        <script>

        </script>



    </body>


</html>