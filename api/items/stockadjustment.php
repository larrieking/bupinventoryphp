<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
include_once '../config/database.php';
include_once '../objects/adjuststock.php';


$database = new Database();
$db = $database->getConnection();
$adjust = new stockadjustment($db);

$adjust->setItemname($_POST["item"]);
$adjust->setAdjustmentType($_POST["adjustmenttype"]);
$adjust->setNewQuantity((int)($_POST["qty"]));
$adjust->setReason($_POST["reason"]);
$adjust->setDate(date("d-m-Y"));
$adjust->setAdjustedBy($_SESSION["username"]);
$data = $adjust->create();



echo json_encode($data);
    

    


