<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once '../config/database.php';

class rememberme{
    public $id, $authentificator1, $authentificator2, $user_id, $expires;


private $con;
    


    public function __construct($db, $auth1, $auth2, $user, $expires) {
        $this->con = $db;
        $this->authentificator1 = $db;
        $this->authentificator2 = $auth2;
        $this->user_id = $user;
        $this->expires = $expires;
        
    }
    
    
    function  create(){
        $sql = "INSERT INTO rememberme
        (`authentificator1`, `f2authentificator2`, `user_id`, `expires`)
        VALUES
        ('$this->authentificator1', '$this->f2authentificator2', '$this->user_id', '$this->expiration')";
        if(mysqli_query($this->con, $sql)){
            return true;
        } else {
            return false;
        }
    }
    
}