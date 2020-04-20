<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class stockadjustment {

    public $id, $adjustedBy, $adjustmentType, $date, $itemname, $newQuantity, $oldquantity, $reason;
    private $con;

    public function __construct($db) {
        $this->con = $db;
    }

    public function getId() {
        return $this->id;
    }

    public function getAdjustedBy() {
        return $this->adjustedBy;
    }

    public function getAdjustmentType() {
        return $this->adjustmentType;
    }

    public function getDate() {
        return $this->date;
    }

    public function getItemname() {
        return $this->itemname;
    }

    public function getNewQuantity() {
        return $this->newQuantity;
    }

    public function getReason() {
        return $this->reason;
    }

    public function getOldQuantity() {
        return $this->oldquantity;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setAdjustedBy($adjustedBy) {
        $this->adjustedBy = $adjustedBy;
    }

    public function setAdjustmentType($adjustmentType) {
        $this->adjustmentType = $adjustmentType;
    }

    public function setDate($date) {
        $this->date = $date;
    }

    public function setItemname($itemname) {
        $this->itemname = $itemname;
    }

    public function setNewQuantity($newQuantity) {
        $this->newQuantity = $newQuantity;
    }

    public function setOldquantity($oldquantity) {
        $this->oldquantity = $oldquantity;
    }

    public function setReason($reason) {
        $this->reason = $reason;
    }

    public function create() {
        // $status; $message;
        $qty = $this->newQuantity;

        $this->oldquantity = (int) $this->getItemQuantity($this->itemname);
        //if($this->oldquantity != false and $this->newQuantity<= $this->oldquantity){
        if ($this->adjustmentType == "positive" and $this->oldquantity != -1) {

            $this->newQuantity += $this->oldquantity;
        } elseif ($this->oldquantity != -1 and $this->adjustmentType == "negative" and $this->newQuantity <= $this->oldquantity) {
            $this->newQuantity = $this->oldquantity - $this->newQuantity;
            $qty = 0-$qty;
        } else {
            return array("status" => false, "message" => "Unable to post Adjustment, an error occured!", "m2" => $this->getOldQuantity());
        }
        $sql = "INSERT INTO stock_adjustment (adjustedby, adjustmenttype, date,  itemname, newquantity, oldquantity, reason) VALUES ('$this->adjustedBy', '$this->adjustmentType', '$this->date', '$this->itemname', '$qty', '$this->oldquantity', '$this->reason')";

        $result1 = $this->updateByItemName($this->newQuantity, $this->itemname);

        $result = mysqli_query($this->con, $sql);

        if ($result and $result1) {

            return array("status" => true, "message" => "Account creation successful"
            );
        } else {
            return array("status" => false, "message" => "Unable to post Adjustment", "m2" => $this->getAdjustedBy());
        }
    }

    public function getItemQuantity($itemName) {
        $sql = "SELECT * FROM new_product WHERE (item_name = '$itemName')";
        $result = mysqli_query($this->con, $sql);
        if (mysqli_num_rows($result) >= 1) {
            $row = mysqli_fetch_assoc($result);
            // p = new NewProduct($db)->setOpeningstock($openingstock);
            return $row["opening_stock"];
        } else {
            return -1;
        }
    }

    function updateByItemName($qty, $itemname) {

        $sql = "UPDATE new_product SET opening_stock = '$qty' WHERE ( item_name = '$itemname') ";

        if (mysqli_query($this->con, $sql)) {
            return true;
        } else {
            return false;
        }
    }

}
