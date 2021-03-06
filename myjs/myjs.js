/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function addUser() {
    username = $("#username").val();
    email = $("#email").val();
    password = $("#password").val();
    password2 = $("#password2").val();
    error = checkPasword(password, password2, email, username)
    if (error.length > 0) {

        toastr.error(error);


    } else {
        $.ajax({
            type: "POST",
            url: "api/items/createuser.php",
            dataType: 'json',
            data: {
                username: username,
                email: email,
                password: password

            },

            error: function (result) {
                alert(result.responseText);
            },

            success: function (result) {
                if (result["status"] === true) {
                    //toastr.success("User Account Created Successfully!");
                    $("#notification").html("<div class = 'alert alert-success alert-dismissible'>Thanks for registration, a confirmation email has been sent to " + email + ". Please click on the activation link in the mail to activate your account. <br /> Check your SPAM folder if mail is not found in your inbox inbox.</div>");
                } else
                    toastr.error(result["message"])


            }
        });
    }
}

function checkPasword(password, password2, email, username) {
    error = '';
    if (email.lenght <= 0 || password.length <= 0 || email.lenght <= 0 || password2.length <= 0 || username.length <= 0) {
        error += "Please fill all the inputs";
    } else if (!email.match(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/)) {
        error += "Email address is invalid";
    } else if (password !== password2) {
        error += "password does not match!";

    } else if (!password.match(/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,20}$/)) {
        error += "Invalid password. password must be between 6 to 20 characters and contain at least one numeric digit, one uppercase and one lowercase letter."

    }

    return error;


}
;




function login() {
    //username = $("#username").val();
    email = $("#email").val();
    password = $("#password").val();
    //password2 = $("#password2").val();
    {
        $.ajax({
            type: "POST",
            url: "api/items/login.php",
            dataType: 'json',
            data: {
                // username: username,
                email: email,
                password: password

            },

            error: function (result) {
                alert(result.responseText);
            },

            success: function (result) {
                if (result["status"] === true) {
                    toastr.success("Login Successful!");
                    window.location = "home.php"
                    //$("#notification").html("<div class = 'alert alert-success alert-dismissible'>Thanks for registration, a confirmation email has been sent to "+email+". Please click on the activation link in the mail to activate your account. <br /> Check your SPAM folder if mail is not found in your inbox inbox.</div>");
                } else
                    toastr.error(result["message"])


            }
        });
    }
}


//echo "<div class = 'alert  alert-success alert-dismissible'>Thanks for registration, a confirmation email has been sent to $email. Please click on the activation link in the mail to activate your account. <br /> Check your SPAM folder if mail absent on inbox.</div>";



function addProduct() {
    
    $("#b").attr('disabled', 'disabled');
     $("#b").val('Sending...');
    itemclass = $("#itemclass").val();
    itemname = $("#itemname").val();
    itemno = $("#itemno").val();
    openingstock = $("#openingstock").val();
    optimal = $("#optimal").val();
    overstock = $("#overstock").val();
    understock = $("#understock").val();
    uom = $("#uom").val();
    uses = $("#uses").val();
    
    error = validateItem(itemname, itemclass, itemno, uses, openingstock);
    //
    if(error.length > 0){
        toastr.error(error);
        $("#b").removeAttr('disabled');
        $("#b").val('Create');
    }else
    {
        $.ajax({
            type: "POST",
            url: "api/items/createitem.php",
            dataType: 'json',
            data: {
                itemclass : itemclass,
                itemname : itemname,
                itemno : itemno,
                openingstock : openingstock,
                optimal : optimal,
                overstock : overstock,
                understock : understock,
                uom : uom,
                uses:uses

            },

            error: function (result) {
                alert(result.responseText);
            },

            success: function (result) {
                if (result["status"] === true) {
                    toastr.success("Item Created Successfully!");
                    window.location = "index.php";
                    $("#b").removeAttr('disabled');
                  //  $("#notification").html("<div class = 'alert alert-success alert-dismissible'>Thanks for registration, a confirmation email has been sent to " + email + ". Please click on the activation link in the mail to activate your account. <br /> Check your SPAM folder if mail is not found in your inbox inbox.</div>");
                } else{
                    mes = result["message"];
                    toastr.error(mes);
                    $("#b").removeAttr('disabled');
                    

                }
                 $("#b").val('Create');
            }
        });
    }
}


function validateItem(itemname, itemclass, itemno, uses, openingstock){
    error = '';
    if(itemname.length <= 0 || itemclass.length <= 0 || itemno.length <= 0 || uses.length <= 0 || openingstock.length <= 0){
        error += "Please complete all required field";
    }
    
    
    return error;
}


function doDelete(id){
    var result = confirm("Are you sure you want to Delete the Doctor Record?");
    if (result === true){
        $.ajax({
            type: "POST",
            url: "api/items/deleteitem.php",
            dataType: 'json',
            data: {
                id : id

            },

            error: function (result) {
                alert(result.responseText);
            },

            success: function (result) {
                if (result["status"] === true) {
                    toastr.success("Item Deleted Successfully");
                   window.location = 'index.php';
                } else
                    toastr.error("An error occured! ")


            }
        });
    }
}


function createAdjustment(){
    
    
    $("#b").attr('disabled', 'disabled');
     $("#b").val('Posting....');
   // itemclass = $("#itemclass").val();
    item = $("#item").val();
    adjustmenttype = $("#adjustmenttype").val();
    quantity= $("#quantity").val();
    reason = $("#reason").val();
   
                      //  toastr.success(adjustmenttype);

   // error = validateItem(itemname, itemclass, itemno, uses, openingstock);
    //
   // if(error.length > 0){
        //toastr.error(error);
       // $("#b").removeAttr('disabled');
       // $("#b").val('Create');
    //}else
    {
        $.ajax({
            type: "POST",
            url: "api/items/stockadjustment.php",
            dataType: 'json',
            data: {
               // itemclass : itemclass,
                item : item,
                adjustmenttype : adjustmenttype,
                qty : quantity,
                reason : reason
                

            },

            error: function (result) {
                alert(result.responseText);
            },

            success: function (result) {
                if (result["status"] === true) {
                    clearInput();
                    toastr.success("Adjustment posted successfully!");
                    //window.location = "index.php";
                    $("#b").removeAttr('disabled');
                  //  $("#notification").html("<div class = 'alert alert-success alert-dismissible'>Thanks for registration, a confirmation email has been sent to " + email + ". Please click on the activation link in the mail to activate your account. <br /> Check your SPAM folder if mail is not found in your inbox inbox.</div>");
                } else{
                    mes = result["message"];
                    toastr.error(mes);
                    $("#b").removeAttr('disabled');
                    

                }
                 $("#b").val('Post');
            }
        });
    }
}


function clearInput(){
    $("#item").val('');
    $("#adjustmenttype").val('');
    $("#quantity").val('');
    $("#reason").val('');
    
}

    
function validateAdjustment(itemname, itemclass, itemno, uses){
    error = '';
    if(itemname.length <= 0 || itemclass.length <= 0 || itemno.length <= 0 || uses.length <= 0 ){
        error += "Please complete all required field";
    }
    
    
    return error;
}