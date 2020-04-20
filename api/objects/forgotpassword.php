<?php

include_once 'config/database.php';

class ResetPassword {

    private $id, $email, $token, $date, $status;
    private $con;

    public function __construct($con) {
        $this->con = $con;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getToken() {
        return $this->token;
    }

    public function getStatus() {
        return $this->status;
    }

    public function getTime() {
        return $this->time;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setToken($token) {
        $this->token = $token;
    }

    public function setStatus($status) {
        $this->status = $status;
    }

    public function setTime($time) {
        $this->time = $time;
    }

    public function create() {
        $this->token = bin2hex(openssl_random_pseudo_bytes(16));
        $this->date = time();
        $this->status = "pending";
        $this->id = $this->findByEmail();
        if ($this->id  != "error") {
            $sql = "INSERT INTO forgotpassword (user_id, rkey, time, status) VALUES ('$this->id', '$this->token', '$this->date', '$this->status')";
            $result = mysqli_query($this->con, $sql);
            if ($result and mail($this->email, "Password Reset", "Please click on this link to reset your password:\n\nhttp://mycodershift.host20.uk/bupinventory/resetpass.php?user_id=$this->id&key=$this->token", 'From:' . 'admin@codershift.com')) {
                return array("status" => true,
                    "message" => "<div class='alert alert-success alert-dismissible'>Thank you, Please follow the instruction in the email sent to you to activate your account!</div>");
            } else {
                return array("status" => false, "message" => "<div class = 'alert alert-danger alert-dismissible'>Error reseting your password or sending a confirmation mail.</div>");
            }
        } else {
            return array("status"=>false, "message"=>"<div class = 'alert alert-danger alert-dismissible'>Email Address not Found</div>");
        }
    }

    public function findByEmail() {
        $sql = "SELECT * FROM users WHERE email = '$this->email'";
        $result = mysqli_query($this->con, $sql);
        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            return $row["user_id"];
                    
        } else {
            return "error";
        }
    }

}

?>