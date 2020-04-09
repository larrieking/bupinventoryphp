<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


class SendEmail{
public $headers = 'From: larrie4christ@gmail.com';
    
    function send($to, $subject, $message){
        if(mail($to, $subject, $message, $this->headers)){
            return true;
        }
        else{
            return false;
        }
    }
}