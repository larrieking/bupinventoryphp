/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//inpu type = text
//

function ret() {
    //username = $("#username").val();
    email = $("#email").val();
    //  password = $("#password").val();
    //password2 = $("#password2").val();
    if (email.length <= 0) {
        toastr.error("Please Enter your Email Address!");
    } else
    {
        $.ajax({
            type: "POST",
            url: "api/items/resetpassword.php",
            dataType: 'json',
            data: {
                // username: username,
                email: email
                        //  password: password

            },

            error: function (result) {
                alert(result.responseText);
            },

            success: function (result) {
                if (result["status"]===true) {
                    $("#resetForm").hide();
                }

                message = result["message"];
                $("#message").html(message);
                // toastr.success(message);
                //window.location = "home.php"
                //$("#notification").html("<div class = 'alert alert-success alert-dismissible'>Thanks for registration, a confirmation email has been sent to "+email+". Please click on the activation link in the mail to activate your account. <br /> Check your SPAM folder if mail is not found in your inbox inbox.</div>");


            }
        });
    }


}


function updatePassword() {
    password1 = $("#password1").val();
    password2 = $("#password2").val();
    hiddenemail = document.getElementById("hiddenemail").value;
    hiddenpassword = document.getElementById("hidden").value;
    error = checkPassword(password1, password2);
    console.log("about to hit ajax body");
    if (error.length > 0) {
        $("#error").html("<div class = 'alert alert-dismissible alert-danger'> " + error + " </div>");
        error = "";

    } else
    {
        console.log("moving to ajax body");
        $.ajax({
            cache: false,
            type: "POST",
            url: "api/items/updatepassword.php",
            dataType: 'json',
            data: {
                // username: username,
                password: password1,
                hiddenemail: hiddenemail,
                hiddenpassword: hiddenpassword
                        //  password: password

            },

            error: function (result) {
                alert(result.responseText);
            },

            success: function (result) {
                if (result["status"]===true) {
                    $("#resetForm").hide();
                }



                $("#error").html(result["message"]);
                // toastr.success(message);
                //window.location = "home.php"
                //$("#notification").html("<div class = 'alert alert-success alert-dismissible'>Thanks for registration, a confirmation email has been sent to "+email+". Please click on the activation link in the mail to activate your account. <br /> Check your SPAM folder if mail is not found in your inbox inbox.</div>");


            }
        });
    }


}


function checkPassword(password, password2) {
    error = '';
    if (password.length <= 0 || password2.length <= 0) {
        error += "Please fill all the inputs";

    } else if (password !== password2) {
        error += "password does not match!";

    } else if (!password.match(/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,20}$/)) {
        error += "Invalid password. password must be between 6 to 20 characters and contain at least one numeric digit, one uppercase and one lowercase letter."

    }

    return error;


}


