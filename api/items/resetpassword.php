<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

session_start();
include_once '../config/database.php';
//include_once '../objects/adjuststock.php';
include_once '../objects/forgotpassword.php';

$database = new Database();
$db = $database->getConnection();
$adjust = new ResetPassword($db);
$email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
$adjust->setEmail($email);
print_r(json_encode($adjust->create()));

