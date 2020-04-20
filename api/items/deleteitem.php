<?php

session_start();
include_once '../config/database.php';
include_once '../objects/newproduct.php';


$database = new Database();
$db = $database->getConnection();
$product = new NewProduct($db);

$deleted = $product ->delete($_POST['id']);
if($deleted){
    $result_arr = array("status" => true,
            "message" => "successfully deleted");
}else{
    
$result_arr = array("status" => false,
            "message" => "Item can not be deleted");
}

echo json_encode($result_arr);