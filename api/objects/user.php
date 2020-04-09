<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once '../config/database.php';

class User {

    public $email, $user_id, $username, $password, $password2, $activated;
    private $con;

    public function __construct($db) {
        $this->con = $db;
    }

    function createUser() {
        
    }

    public function cleanInput($input) {
        $input = filter_var($input, FILTER_SANITIZE_STRING);
        return $input;
    }

    function getEmail() {
        return $this->email;
    }

    function getUser_id() {
        return $this->user_id;
    }

    function getUsername() {
        return $this->username;
    }

    function getPassword() {
        return $this->password;
    }

    function getPassword2() {
        return $this->password2;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setUser_id($user_id) {
        $this->user_id = $user_id;
    }

    function setUsername($username) {
        $this->username = $username;
    }

    function setPassword($password) {
        $this->password = $password;
    }

    function setPassword2($password2) {
        $this->password2 = $password2;
    }

    function create() {
        $sql = "INSERT INTO users (email, username, password, activated) VALUES ('$this->email', '$this->username', '$this->password', '$this->activated')";
        if (mysqli_query($this->con, $sql)) {
            return true;
        } else {
            return false;
        }
    }

    function readAll() {
        $sql = "SELECT * FROM `users` WHERE 1";
        $result = mysqli_query($this->con, $sql);
        //$users_arr = array();
        $user_array["users"] = array();
        if (mysqli_num_rows($result) > 0) {

            
                while ($results = mysqli_fetch_assoc($result)) {
                    $user_item = array(
                        "user_id" => $results['user_id'],
                        "username" => $results['username'],
                        "email" => $results['email'],
                        "password" => $results["password"]
                    );
                    array_push($user_array["users"], $user_item);
                }
                
        }
             else {
                $user_array["users"] = array();
            }
            
            return $user_array["users"];
        }

        function readByEmail($email) {
            $sql = "SELECT * FROM users WHERE email = '$email'";
            $result = mysqli_query($this->con, $sql);
            return mysqli_num_rows($result);
        }

        function deleteById($id) {
            $sql = "DELETE FROM users WHERE user_id = '$id'";
            if (mysqli_query($this->con, $sql)) {
                return true;
            } else {
                return false;
            }
        }

        function deleteByEmail($email) {
            $sql = "DELETE FROM users WHERE email = '$email'";
            if (mysqli_query($this->con, $sql)) {
                return true;
            } else {
                return false;
            }
        }

        function update($id) {
            $sql = "UPDATE users SET email = '$this->email', password = '$this->password', username = '$this->username' WHERE user_id = '$this->user_id'";
            if (mysqli_query($this->con, $sql)) {
                return true;
            } else {
                return false;
            }
        }

        function updateactivation($activationkey) {
            $sql = "UPDATE users SET activated='activated' WHERE (email='$this->email' AND activated='$activationkey') LIMIT 1";
            mysqli_query($this->con, $sql);
            if (mysqli_affected_rows($this->con) == 1) {
                return true;
            } else {
                return false;
            }
        }

        function findByEmailAndPassword($email, $password) {
            $sql = "SELECT * FROM users WHERE email='$email' AND password='$password' AND activated='activated'";
            $result = mysqli_query($this->con, $sql);
            $count = mysqli_num_rows($result);
            if ($count > 0) {
                $row = mysqli_fetch_assoc($result);
                $data = array("user_id" => $row["user_id"], "password" => $row["password"], "email" => $row["email"], "username" => $row["username"]);
            } else {
                $data = array();
            }
            return $data;
        }

        function clean($email, $key) {
            $this->email = mysqli_real_escape_string($this->con, $email);
            $user->activated = mysqli_real_escape_string($this->con, $key);
        }

    }
    