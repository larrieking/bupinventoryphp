<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once '../config/database.php';

$db = new Database();
$link = $db->getConnection();

//$password = $_POST["password"];
$password = hash('sha256', $_POST["password"]);
$user_id = mysqli_real_escape_string($link, $_POST["hiddenemail"]);
$key = mysqli_real_escape_string($link, $_POST["hiddenpassword"]);
$time = time() - 86400;

//fetch from password reset table

$sql = "SELECT user_id FROM forgotpassword WHERE rkey='$key' AND user_id='$user_id' AND time > '$time' AND status='pending'";

$result = mysqli_query($link, $sql);
if (!$result) {
    $arr = array("status" => false, "message" => "URL expired! <a href='resetpassword.php'>Click here to try again</a></div>");
    //print_r(json_encode($arr));
    exit;
}
if (mysqli_num_rows($result) !== 1) {
    $arr = array("status" => false, "message" => "<div class = 'alert alert-danger alert-dismissible'>Error fetching your details from the database.<a href='resetpassword.php'>Click here to try again</a></div>");
    echo json_encode($arr);
    exit();
} else {
    $sql = "UPDATE users SET password = '$password' WHERE user_id = '$user_id'";
    
    if (!mysqli_query($link, $sql)) {
        $arr = array("status" => false, "message" => "<div class = 'alert alert-danger alert-dismissible'>Unable to update record.<a href='resetpassword.php'>Click here to try again</a></div>");
    } 
}


$sql = "UPDATE forgotpassword SET status='used' WHERE rkey='$key' AND user_id='$user_id'";
$result = mysqli_query($link, $sql);
if(!$result){
   $arr = array("status"=>false, "message"=> '<div class="alert alert-danger">Error updating your password! <a href="resetpassword.php">Click here to try again</a></div></div>');
}else{
    $arr = array("status"=>true, "message"=>'<div class="alert alert-success">Your password has been updated successfully!<a href="index.php">click here to Login</a></div>');  
}


    echo json_encode($arr);



//$sql = "UPDATE users SET password = '$password' WHERE email = '$email'";