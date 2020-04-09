<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Database {

    private $host = "localhost";
    private $db_name = "mycoders_inventory";
    private $user_name = "mycoders_inventory";
    private $password = "Elshadai1986$";
    public $con;

    public function getConnection() {
        $this->$con = null;
   

        $this->con = mysqli_connect($this->host, $this->user_name, $this->password, $this->db_name);
        if (!$this->con) {
            echo 'error';
        } else {
            return $this->con;
        }
        
       return $this->con;
    }

}
