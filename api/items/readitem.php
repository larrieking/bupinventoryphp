<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

session_start();
include_once '../config/database.php';
include_once '../objects/newproduct.php';


$database = new Database();
$db = $database->getConnection();
$product = new NewProduct($db);

$result = $product->readAll();
if(count($result)!=0){
    echo json_encode($result);
} else {
    echo false;
}
    