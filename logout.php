<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
if(isset($_SESSION['user_id']) && $_GET['logout'] == 1){
    session_destroy();
    session_unset();
    setcookie("rememberme", "", time()-3600);
}
