$(document).ready(() => {

    $.ajax({
        type: "POST",
        url: "./requiredFiles/ajax/wallettransferAjax.php",
        data: {
            "way": "login"
        },
        success: function (res) {
            var response = JSON.parse(res);

            if (response.status == "auth_failed" && response.message == "Expired token") {

                location.replace("time_expried.php");

            } else if (response.status == "auth_failed") {

                location.replace("unauth_login.php");

            } else if (response.status == "success") {
                return getData();
            }
        }
    });





});


const getData = () => {

    $.ajax({
        type: "POST",
        url: "./requiredFiles/ajax/wallettransferAjax.php",
        data: {
            "way": "getData"
        },
        success: function (res) {
            var response = JSON.parse(res);
            if (response.status == "success") {

                if (response.user_profileimg !== null) {
                    $(".user_profileimg").attr("src", "./img/user/" + response.user_profileimg);
                }

                $(".user_name").html(response.user_name);

                $(".savingstravelpoints").html(response.savingstravelpoints);

                if(response.tabledata.length > 0){
                    $("#tabledata").html(response.tabledata);
                }else{
                    $("#tabledata").html("<tr><td colspan='10'>No Data Found</td></tr>");
                }


            } else if (response.status == "auth_failed" && response.message == "Expired token") {

                location.replace("time_expried.php");

            } else if (response.status == "auth_failed") {

                location.replace("unauth_login.php");

            }
        }
    });

}

const balancecheck = () => {
    const way = $("#floatingSelect").val();

    if (way !== "none") {

        $.ajax({
            type: "POST",
            url: "./requiredFiles/ajax/wallettransferAjax.php",
            data: {
                "way": way
            },
            success: function (res) {
                var response = JSON.parse(res);
                if (response.status == "success") {

                    $("#balanacevalue").html(response.balanacevalue + "$");

                } else if (response.status == "auth_failed" && response.message == "Expired token") {

                    location.replace("time_expried.php");

                } else if (response.status == "auth_failed") {

                    location.replace("unauth_login.php");

                }
            }
        });

    } else{
        $("#balanacevalue").html("None");
    }
}

const checkuserid = () => {
    var userid = $("#userid").val();

    if (userid.length >= 1) {

        var way = "checksponser";

        $.ajax({
            type: "POST",
            url: "./requiredFiles/ajax/wallettransferAjax.php",
            data: {
                "way": way,
                "userid": userid
            },
            success: function (res) {
                var response = JSON.parse(res);
                if (response.status == "success") {

                    if (response.stage == "ok") {

                        $("#useridmsg").html("<p style='color:green'>" + response.message + "</p>")

                        $("#transferbtn").prop("disabled", false)
                        $("#otpbtn").prop("disabled",false)

                    } else if (response.stage == "not") {

                        $("#useridmsg").html("<p style='color:red'>Invalid User ID</p>")
                        $("#transferbtn").prop("disabled", true)
                        $("#otpbtn").prop("disabled",true)

                    }

                } else if (response.status == "auth_failed" && response.message == "Expired token") {

                    location.replace("time_expried.php");

                } else if (response.status == "auth_failed") {

                    location.replace("unauth_login.php");

                }
            }
        });

    } else {

        $("#useridmsg").html("<p>Enter the User Id</p>")

    }
}

const clearerr = () =>{
    $("#errormsg").html("");
}

$("#transferpoint").submit(function (e) { 
    e.preventDefault();
    

    var frm = $("#transferpoint")[0];
    var frmdata = new FormData(frm);
    $.ajax({
        type: "POST",
        url: "./requiredFiles/ajax/wallettransferAjax.php",
        data: frmdata,
        processData: false,
        contentType: false,
        cache: false,
        success: function (res) {
            var response = JSON.parse(res);

            if (response.status == "auth_failed" && response.message == "Expired token") {

                location.replace("time_expried.php");

            } else if (response.status == "auth_failed") {

                location.replace("unauth_login.php");

            } else if (response.status == "success") {

                location.reload();

            } else if (response.status == "error") {

                $("#errormsg").html(response.message);

            } 
        }
    });

});

const getotp = () =>{
    var selectoption = $("#floatingSelect").val();
    var points = $("#dollarvalue").val();
    var userid = $("#userid").val();

    if((selectoption !== "none") && points.length >= 1){

        $("#otpbtn").html("Loading ...");

        $.ajax({
            type: "POST",
            url: "./requiredFiles/ajax/wallettransferAjax.php",
            data: {
                "way" : "getotp",
                "points": points,
                "userid": userid
            },
            success: function (res) {
                var response = JSON.parse(res);
    
                if (response.status == "auth_failed" && response.message == "Expired token") {
    
                    location.replace("time_expried.php");
    
                } else if (response.status == "auth_failed") {
    
                    location.replace("unauth_login.php");
    
                } else if (response.status == "success") {
    
                    new Notify({
                        status: 'success',
                        title: 'OTP',
                        text: 'OTP Sended Successfully...!',
                        effect: 'fade',
                        speed: 300,
                        speed: 300,
                        customClass: '',
                        customIcon: '',
                        showIcon: true,
                        showCloseButton: true,
                        autoclose: true,
                        autotimeout: 3000,
                        notificationsGap: null,
                        notificationsPadding: null,
                        type: 'outline',
                        position: 'right top',
                        customWrapper: '',
                    })
                    
                    $("#otpbtn").html("Resend OTP");
                    $("#floatingSelect").prop("disabled",true);
                    $("#dollarvalue").prop("readonly",true);
                    $("#userid").prop("readonly",true);

                }
            }
        });

    }else{
        alert("Choose the Wallet Type and Transfer Points")
    }
}