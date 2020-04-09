<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
include_once '../config/database.php';
include_once '../objects/user.php';


$database = new Database();
$db = $database->getConnection();
$user = new User($db);


$headers = 'From: larrie4christ@gmail.com';

$user->email = $_POST['email'];
$user->password = hash("sha256", $_POST['password']);
$user->username = $_POST['username'];
$user->activated = bin2hex(openssl_random_pseudo_bytes(16));
$message = "Please click on this link to activate your account: \n\n";
$message .= "http://mycodershift.host20.uk/bupinventory/activate.php?email=" . urlencode($user->email) . "&key=$user->activated";

$userExist = $user->readByEmail($user->email);
if ($userExist>0) {
    $user_array = array(
        "status" => false,
        "message" => "Email alreaady exists!"
    );
} else if ($user->create()) {


    $user_array = array("status" => true,
        "message" => "Successfully Signup",
        "id" => $user->user_id,
        "username" => $user->username,
        "email" => $user->email,
        "mailDelivered" => mail($user->email, "Confirm your Registration ", $message, $headers));
} else {
    $user_array = array(
        "status" => false,
        "message" => "Unknown Error!"
    );
}



print_r(json_encode($user_array));


