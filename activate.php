<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once 'api/config/database.php';
include_once 'api/objects/user.php';


$database = new Database();
$db = $database->getConnection();
$user = new User($db);

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Account Activation</title>
       <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="assets/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet"/>
        <style>
            h1{
                color:purple;   
            }
            .contactForm{
                border:1px solid #7c73f6;
                margin-top: 50px;
                border-radius: 15px;
            }
        </style> 

    </head>
        <body>
<div class="container-fluid">
    <div class="row">
        <div class=" col-sm-8 offset-2 contactForm">
            <h1>Account Activation</h1>
<?php
//If email or activation key is missing show an error
if(!isset($_GET['email']) || !isset($_GET['key'])){
    echo '<div class="alert alert-danger">There was an error. Please click on the activation link you received by email.</div>'; exit;
}
//else
    //Store them in two variables

    //Prepare variables for the query
$user->email = $_GET['email'];
$user->activated = $_GET['key'];
$user->clean($user->email, $user->activated);
    //Run query: set activation field to "activated" for the provided email
if($user->updateactivation($user->activated)){
    //If query is successful, show success message and invite user to login

    echo '<div class="alert alert-success">Your account has been activated.</div>';
    echo '<a href="index.php" type="button" class="btn-lg btn-sucess">Log in<a/>';
    
}else{
    //Show error message
    echo '<div class="alert alert-danger">Your account could not be activated. Please try again later.</div>';
    echo '<div class="alert alert-danger">' . mysqli_error($link) . '</div>';
    
}
?>
            
        </div>
    </div>
</div>
        <script src="assets/plugins/jquery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 4 -->
<script src="assets/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="assets/js/adminlte.min.js"></script>
<script src ="myjs/myjs.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
        </body>
</html>