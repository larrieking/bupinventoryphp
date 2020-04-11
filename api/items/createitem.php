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

$product ->setCreatedby($_SESSION["username"]);
$product->setDate(date('Y-m-d-H:i:s'));
$product->setItemclass($_POST["itemclass"]);
$product->setItemname($_POST["itemname"]);
$product->setItemno($_POST["itemno"]);
$product->setOpeningstock($_POST["openingstock"]);
$product->setOptimal($_POST["optimal"]);
$product->setOverstock($_POST["overstock"]);
$product->setUnderstock($_POST["understock"]);
$product->setUom($_POST["uom"]);
$product->setUses($_POST["uses"]);


if($product->create()){
    $result_arr = array(
        "status"=>true,
        "message"=>"Item Created Successfully"
    );
}else{
    
    $result_arr = array(
        "status"=>false,
        "message"=>"Error creating item"
    );
    
}

echo json_encode($result_arr);

