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

$result = $user->readAll();

    
    echo json_encode($result);
