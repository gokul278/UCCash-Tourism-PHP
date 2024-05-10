const getData = () => {
    $.ajax({
        type: "POST",
        url: "./requiredFiles/ajax/idactivationAjax.php",
        data: {
            "way": "getData"
        },
        success: function (res) {
            var response = JSON.parse(res);

            if (response.status == "success") {

                if (response.action == "nopay") {

                    $("#pagecontent").html("<div class='container' algin='center'><h5 style='color:red'>Waiting for pending Approval</h5></div>");
                    $(".toggle-button-container").html("");

                } else if (response.action == "pay") {

                    document.getElementById("deposit address").innerHTML = response.crypto_address;
                    document.getElementById("deposit value").value = response.crypto_value;
                    document.getElementById("cryptovalue").value = response.crypto_value;
                    document.getElementById("imgaddress").src = "../admin/img/deposite/" + response.crypto_image;
                    document.getElementById("bankaddress").src = "../admin/img/deposite/" + response.bankdeposit_image;
                    document.getElementById("ac_holdername").innerHTML = response.ac_holdername;
                    document.getElementById("ac_number").innerHTML = response.ac_number;
                    document.getElementById("ifsc_code").innerHTML = response.ifsc_code;
                    document.getElementById("branch").innerHTML = response.branch;
                    document.getElementById("upi_id").innerHTML = response.upi_id;
                    document.getElementById("deposit_value").innerHTML = response.deposit_value;
                    document.getElementById("user_id").value = response.userid;
                    document.getElementById("userid").value = response.userid;
                    document.getElementById("bankvalue").value = response.deposit_value;

                } else if (response.action ="notpay"){

                    $("#pagecontent").html("<div class='container' algin='center'><h5 style='color:red'>Already ID Activated</h5></div>");
                    $(".toggle-button-container").html("");

                }


                if (response.user_profileimg != null) {
                    $(".user_profileimg").attr("src", "./img/user/" + response.user_profileimg);
                }

                $(".user_name").html(response.user_name);
            } else if (response.status == "auth_failed" && response.message == "Expired token") {
                location.replace("time_expried.php");
            } else if (response.status == "auth_failed") {
                location.replace("unauth_login.php");
            }
        },
        error: function (xhr, status, error) {
            console.error("Error:", error); // Log any errors
        }
    });
}

$(document).ready(() => {
    $.ajax({
        type: "POST",
        url: "./requiredFiles/ajax/idactivationAjax.php",
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
                getData(); // Call getData function after successful login
            }
        },
        error: function (xhr, status, error) {
            console.error("Error:", error); // Log any errors
        }
    });
});

$("#activationcrypto").submit(function (e) {
    e.preventDefault();

    var frm = $("#activationcrypto")[0];
    var frmdata = new FormData(frm);
    $.ajax({
        type: "POST",
        url: "./requiredFiles/ajax/idactivationAjax.php",
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

                location.replace("distributor activation status.php");

            }
        }
    });

});

$("#activationbank").submit(function (e) { 
    e.preventDefault();

    var frm = $("#activationbank")[0];
    var frmdata = new FormData(frm);
    $.ajax({
        type: "POST",
        url: "./requiredFiles/ajax/idactivationAjax.php",
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

                location.replace("distributor activation status.php");

            }
        }
    });

});