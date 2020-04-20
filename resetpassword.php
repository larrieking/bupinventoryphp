<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();


?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>BUPInventory| Reset Password</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
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

</head>
<body class="hold-transition">
   
    <div class="login-page">
       
<div class="login-box" >
    
  <!-- /.login-logo -->
     <div id="message"></div>
  <div  id="resetForm" class="card">
    <div class="card-body login-card-body">
      
        <p class="login-box-msg"><strong>Reset your password </strong></p>
       
        <form>
        <div class="input-group mb-3">
            <input type="email" class="form-control" placeholder="Email" name="email" id="email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
       
        <div class="row">
          
          <!-- /.col -->
          <div class="col-4">
               <input type='button'  class="btn btn-primary btn-block" onclick="ret()" value='Send'>
              
          </div>
          <!-- /.col -->
        </div>
      </form>

      
      <!-- /.social-auth-links -->

     
      
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="assets/plugins/jquery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 4 -->
<script src="assets/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="assets/js/adminlte.min.js"></script>
<script src="myjs/reset.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>

</body>
</html>
