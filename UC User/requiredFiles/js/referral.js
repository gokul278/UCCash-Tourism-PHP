$(document).ready(() => {
    $.ajax({
        type: "POST",
        url: "./requiredFiles/ajax/referralAjax.php",
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
        url: "./requiredFiles/ajax/referralAjax.php",
        data: {
            "way": "getData"
        },
        success: function (res) {
            var response = JSON.parse(res);
            if (response.status == "success") {


                if (response.user_profileimg != null) {
                    $(".user_profileimg").attr("src", "./img/user/" + response.user_profileimg);
                }

                $(".user_name").html(response.user_name);

                if (response.user_referalStatus == "notactivated") {

                    $(".notactivated").css({ "display": "block" });
                    $(".notactivated").html('<h5 style="color:red" align="center">To Get the Referral Link, You Process the ID Activation </h5>');

                } else if (response.user_referalStatus == "activated") {

                    var referralurl = "https://uccashtourism.com/signup.php?referral="+response.user_id;
                    var qrcode = new QRCode(document.getElementById("qrcode"), {
                        text: referralurl,
                        width: 128,
                        height: 128,
                        colorDark: "#000000",
                        colorLight: "#ffffff",
                        correctLevel: QRCode.CorrectLevel.H
                    });
                    $("#referrallink").val(referralurl)
                    $(".activated").css({ "display": "block" });


                }


            } else if (response.status == "auth_failed" && response.message == "Expired token") {

                location.replace("time_expried.php");

            } else if (response.status == "auth_failed") {

                location.replace("unauth_login.php");

            }
        }
    });

}