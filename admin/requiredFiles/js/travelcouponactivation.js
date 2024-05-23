$(document).ready(() => {
    $.ajax({
        type: "POST",
        url: "./requiredFiles/ajax/travelcouponactivationAjax.php",
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
        url: "./requiredFiles/ajax/travelcouponactivationAjax.php",
        data: {
            "way": "getData"
        },
        success: function (res) {
            var response = JSON.parse(res);
            if (response.status == "success") {

                $(".adminname").html(response.admin_name);
                $("#activationvalue").val(response.activationvalue);
                $("#crypto_value").val(response.crypto_value);
                $("#cryptovalue").val(response.crypto_value);

                if (response.profile_image !== null) {
                    $(".profile_image").attr("src", "./img/user/" + response.profile_image);
                }

            } else if (response.status == "auth_failed" && response.message == "Expired token") {

                location.replace("time_expried.php");

            } else if (response.status == "auth_failed") {

                location.replace("unauth_login.php");

            }
        }
    });

}

const activationenablebtn = () => {
    $("#activationbtn").prop("disabled", false);
}

const updateactivationvalue = () => {

    var activationvalue = $("#activationvalue").val();
    var way = "updateactivationvalue";

    $.ajax({
        type: "POST",
        url: "./requiredFiles/ajax/travelcouponactivationAjax.php",
        data: {
            "way": way,
            "activationvalue": activationvalue
        },
        success: function (res) {
            var response = JSON.parse(res);
            if (response.status == "success") {

                new Notify({
                    status: 'success',
                    title: 'Value Updated',
                    text: 'ID Activation Value Updated...!',
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

                $("#activationbtn").prop("disabled", true);


                return getData();

            } else if (response.status == "auth_failed" && response.message == "Expired token") {

                location.replace("time_expried.php");

            } else if (response.status == "auth_failed") {

                location.replace("unauth_login.php");

            }
        }
    });


}


const getusername = () => {
    var user_id = $("#activationMemberID").val();

    if (user_id.length >= 1) {

        $.ajax({
            type: "POST",
            url: "./requiredFiles/ajax/travelcouponactivationAjax.php",
            data: {
                "way": "getusername",
                "userid": user_id
            },
            success: function (res) {
                var response = JSON.parse(res);
                if (response.status == "success") {

                    if (response.message == "noid") {

                        $("#username").html("<p style='color:red'>Invalid ID</p>");
                        $("#activatebtn").prop("disabled", true)

                    } else {

                        $("#username").html("<p style='color:green'>" + response.message + "</p>");
                        $("#activatebtn").prop("disabled", false)

                    }



                } else if (response.status == "auth_failed" && response.message == "Expired token") {

                    location.replace("time_expried.php");

                } else if (response.status == "auth_failed") {

                    location.replace("unauth_login.php");

                }
            }
        });

    } else {
        $("#username").html("<p>Enter the Valid User</p>");
        $("#activatebtn").prop("disabled", true)
    }
}

const clearerror = () => {
    $("#errormsg").html("")
}


$("#idactivationsubmit").submit(function (e) {
    e.preventDefault();

    $("#activatebtn").html("Loading ...");

    var frm = $("#idactivationsubmit")[0];
    var frmdata = new FormData(frm);

    $.ajax({
        type: "POST",
        url: "./requiredFiles/ajax/travelcouponactivationAjax.php",
        data: frmdata,
        processData: false,
        contentType: false,
        cache: false,
        success: function (res) {
            var response = JSON.parse(res);
            if (response.status == "success") {

                location.replace("travel coupon purchase history.php")

            } else if (response.status == "auth_failed" && response.message == "Expired token") {

                location.replace("time_expried.php");

            } else if (response.status == "auth_failed") {

                location.replace("unauth_login.php");

            } else if (response.status == "error") {
                $("#errormsg").html(response.message)
                $("#activatebtn").html("Activate");
            }
        }
    });

});