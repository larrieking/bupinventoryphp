<?php

//Start session
session_start();
include_once '../config/database.php';
include_once '../objects/user.php';
//include 'SendMail.php';
//Connect to the database
//include("connection.php");
//Check user inputs
//Define error messages
//Get email and password
//Store errors in errors variable
//else: No errors
//Prepare variables for the query

$database = new Database();
$db = $database->getConnection();
$user = new User($db);


$user->email = $_POST["email"];
$user->password = $_POST["password"];
$user->password = hash('sha256', $user->password);
//Run query: Check combinaton of email & password exists
//$sql = "SELECT * FROM users WHERE email='$user->email' AND password='$user->password' AND activated='activated'";

$data = $user->findByEmailAndPassword($user->email, $user->password);

if (count($data)>0) {
    $_SESSION['user_id'] = $data['user_id'];
    $_SESSION['username'] = $data['username'];
    $_SESSION['email'] = $data['email'];
    if (!empty($_POST["rememberme"])) {
        $authentificator1 = bin2hex(openssl_random_pseudo_bytes(10));
        //2*2*...*2
        $authentificator2 = openssl_random_pseudo_bytes(20);

        //Store them in a cookie
        function f1($a, $b) {
            $c = $a . "," . bin2hex($b);
            return $c;
        }

        $cookieValue = f1($authentificator1, $authentificator2);
        setcookie(
                "rememberme",
                $cookieValue,
                time() + 1296000
        );

        //Run query to store them in rememberme table
        function f2($a) {
            $b = hash('sha256', $a);
            return $b;
        }

        $f2authentificator2 = f2($authentificator2);
        $user_id = $_SESSION['user_id'];
        $expiration = date('Y-m-d H:i:s', time() + 1296000);

        $rem = new rememberme($db, $authentificator1, $authentificator2, $data["user_id"]);

        //  $result = mysqli_query($, $sql);
        if ($rem->create()) {
            $remember = "There was an error storing data to remember you next time.";
            //"echo  '<div class="alert alert-danger">"There was an error storing data to remember you next time.</div>';  
        } else {
            $remember = "Success";
        }
    }

    //echo '<div class="alert alert-danger">Error running the query!</div>';
    $user_array = array(
        "status" => true,
        "message" => "Login Successful!",
    );
}
//If email & password don't match print error
else {
    $user_array = array(
        "status" => false,
        "message" => "wrong username or password!"
    );
}
//$result = "failure";
//echo '<div class="alert alert-danger">Wrong Username or Password</div>';
//else
//Create two variables $authentificator1 and $authentificator2
//Store them in a cookie
//Run query to store them in rememberme table
//If query unsuccessful
//print error
//else
//print "success"

print_r(json_encode($user_array));
?>