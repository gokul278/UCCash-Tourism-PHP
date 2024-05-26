$(document).ready(() => {

    $.ajax({
        type: "POST",
        url: "./requiredFiles/ajax/coinwithdrawAjax.php",
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
        url: "./requiredFiles/ajax/coinwithdrawAjax.php",
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

                $("#uccwallet").html(response.uccwallet + "$");
                $("#bep20_address").val(response.bep20_address);

            } else if (response.status == "auth_failed" && response.message == "Expired token") {

                location.replace("time_expried.php");

            } else if (response.status == "auth_failed") {

                location.replace("unauth_login.php");

            } else if(response.status == "nopay"){

                if (response.user_profileimg !== null) {
                    $(".user_profileimg").attr("src", "./img/user/" + response.user_profileimg);
                }

                $(".user_name").html(response.user_name);
                $("#uccwallet").html(response.uccwallet + "$");

                $("#payoption").html("<h6 style='color:red;width:100%' align='center'>"+response.message+"</h6>")

            }
        }
    });

}

const checkcrypto = () => {

    if ($("#bep20_address").val().length >= 1) {
        if ($("#cryptovalue").val().length >= 1) {
            $("#cryptowiithdrawbtn").prop("disabled", false);
            $("#cryptootpbtn").prop("disabled", false)
        } else {
            $("#cryptowiithdrawbtn").prop("disabled", true);
            $("#cryptootpbtn").prop("disabled", true);
        }
    } else {
        $("#cryptowiithdrawbtn").prop("disabled", true);
        $("#cryptootpbtn").prop("disabled", true);
    }

}


const cryptootp = () => {

    $("#cryptootpbtn").html("Loading ...");


    $.ajax({
        type: "POST",
        url: "./requiredFiles/ajax/coinwithdrawAjax.php",
        data: {
            "way": "cryptootp",
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
                $("#cryptootpbtn").html("Resend OTP");
            }
        }
    });

}



$("#cryptosubmit").submit(function (e) {
    e.preventDefault();

    var frm = $("#cryptosubmit")[0];
    var frmdata = new FormData(frm);

    $.ajax({
        type: "POST",
        url: "./requiredFiles/ajax/coinwithdrawAjax.php",
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

                location.replace("withdraw history.php");

            } else if (response.status == "error") {

                $("#errormsgcrypto").html(response.message);

            }
        }
    });

});

const clearmsgcrypto = () => {
    $("#errormsgcrypto").html("");
}