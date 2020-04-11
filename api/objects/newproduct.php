<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include_once '../config/database.php';

class  NewProduct{
    private $id, $createdby, $date, $itemclass, $itemname, $itemno, $openingstock, $optimal, $overstock, $understock, $uom, $uses;
    private $con;
    
  public function __construct($db) {
        $this->con = $db;
    }
    
    public function setId($id) {
        $this->id = $id;
    }

    public function setCreatedby($createdby) {
        $this->createdby = $createdby;
    }

    public function setDate($date) {
        $this->date = $date;
    }

    public function setItemclass($itemclass) {
        $this->itemclass = $itemclass;
    }

    public function setItemname($itemname) {
        $this->itemname = $itemname;
    }

    public function setItemno($itemno) {
        $this->itemno = $itemno;
    }

    public function setOpeningstock($openingstock) {
        $this->openingstock = $openingstock;
    }

    public function setOptimal($optimal) {
        $this->optimal = $optimal;
    }

    public function setOverstock($overstock) {
        $this->overstock = $overstock;
    }

    public function setUnderstock($understock) {
        $this->understock = $understock;
    }

    public function setUom($uom) {
        $this->uom = $uom;
    }

    public function setUses($uses) {
        $this->uses = $uses;
    }

    public function setCon($con) {
        $this->con = $con;
    }
    
    public function getId() {
        return $this->id;
    }

    public function getCreatedby() {
        return $this->createdby;
    }

    public function getDate() {
        return $this->date;
    }

    public function getItemclass() {
        return $this->itemclass;
    }

    public function getItemname() {
        return $this->itemname;
    }

    public function getItemno() {
        return $this->itemno;
    }

    public function getOpeningstock() {
        return $this->openingstock;
    }

    public function getOptimal() {
        return $this->optimal;
    }

    public function getOverstock() {
        return $this->overstock;
    }

    public function getUnderstock() {
        return $this->understock;
    }

    public function getUom() {
        return $this->uom;
    }

    public function getUses() {
        return $this->uses;
    }

    public function getCon() {
        return $this->con;
    }

    
    
    function create() {
        $sql = "INSERT INTO new_product (created_by, date, item_class, item_name, item_no, opening_stock, optimal, overstock, understock, uom, uses) VALUES ('$this->createdby', '$this->date', '$this->itemclass', '$this->itemname', '$this->itemno', '$this->openingstock', '$this->optimal', '$this->overstock', '$this->understock', '$this->uom', '$this->uses')";
        if (mysqli_query($this->con, $sql)) {
            return true;
        } else {
            return false;
        }
    }
    
    
     function readAll() {
        $sql = "SELECT * FROM new_product ORDER BY id ASC";
        $result = mysqli_query($this->con, $sql);
        //$users_arr = array();
        $user_array["items"] = array();
        if (mysqli_num_rows($result) > 0) {

            
                while ($results = mysqli_fetch_assoc($result)) {
                    $user_item = array(
                        "id" => $results['id'],
                        "createdby" => $results['created_by'],
                        "date" => $results['date'],
                        "itemclass" => $results["item_class"],
                        "itemname" => $results['item_name'],
                        "itemno" => $results['item_no'],
                        "opening_stock" => $results['opening_stock'],
                        "optimal" => $results["optimal"],
                        "overstock" => $results['overstock'],
                        "understock" => $results['understock'],
                        "uom" => $results['uom'],
                        "uses" => $results["uses"]
                           
                    );
                    array_push($user_array["items"], $user_item);
                }
                
        }
             else {
                $user_array["items"] = array();
            }
            
            return $user_array["items"];
        }



}
