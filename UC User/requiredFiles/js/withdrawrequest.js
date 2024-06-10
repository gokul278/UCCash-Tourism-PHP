$(document).ready(() => {

    $.ajax({
        type: "POST",
        url: "./requiredFiles/ajax/withdrawrequestAjax.php",
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
        url: "./requiredFiles/ajax/withdrawrequestAjax.php",
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

                $("#trc20_address").val(response.trc20_address);
                $("#ac_bankname").val(response.ac_bankname);
                $("#ac_holdername").val(response.ac_holdername);
                $("#ac_number").val(response.ac_number);
                $("#ifsc_code").val(response.ifsc_code);
                $("#branch").val(response.branch)

                $("#availablewithdrwabalance").html(response.availablewithdrwabalance + "$");

            } else if (response.status == "auth_failed" && response.message == "Expired token") {

                location.replace("time_expried.php");

            } else if (response.status == "auth_failed") {

                location.replace("unauth_login.php");

            } else if(response.status == "nopay"){

                if (response.user_profileimg !== null) {
                    $(".user_profileimg").attr("src", "./img/user/" + response.user_profileimg);
                }

                $(".user_name").html(response.user_name);
                $("#availablewithdrwabalance").html(response.availablewithdrwabalance + "$");

                $("#payoption").html("<h6 style='color:red;width:100%' align='center'>"+response.message+"</h6>")

            }
        }
    });

}

const checkcrypto = () => {

    if ($("#trc20_address").val().length >= 1) {
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

const checkbank = () => {

    if ($("#ac_bankname").val().length >= 1) {
        if ($("#ac_holdername").val().length >= 1) {
            if ($("#ac_number").val().length >= 1) {
                if ($("#ifsc_code").val().length >= 1) {
                    if ($("#branch").val().length >= 1) {
                        if ($("#bankvalue").val().length >= 1) {
                            $("#bankwithdrawbtn").prop("disabled", false);
                            $("#bankotpbtn").prop("disabled", false);
                        } else {
                            $("#bankwithdrawbtn").prop("disabled", true);
                            $("#bankotpbtn").prop("disabled", true);
                        }
                    } else {
                        $("#bankwithdrawbtn").prop("disabled", true);
                        $("#bankotpbtn").prop("disabled", true);
                    }
                } else {
                    $("#bankwithdrawbtn").prop("disabled", true);
                    $("#bankotpbtn").prop("disabled", true);
                }
            } else {
                $("#bankwithdrawbtn").prop("disabled", true);
                $("#bankotpbtn").prop("disabled", true);
            }
        } else {
            $("#bankwithdrawbtn").prop("disabled", true);
            $("#bankotpbtn").prop("disabled", true);
        }
    } else {
        $("#bankwithdrawbtn").prop("disabled", true);
        $("#bankotpbtn").prop("disabled", true);
    }
}

const cryptootp = () => {

    $("#cryptootpbtn").html("Loading ...");
    var amount = $("#cryptovalue").val();


    $.ajax({
        type: "POST",
        url: "./requiredFiles/ajax/withdrawrequestAjax.php",
        data: {
            "way": "cryptootp",
            "amount": amount
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

const bankotp = () => {
    $("#bankotpbtn").html("Loading ...");
    var amount = $("#bankvalue").val();


    $.ajax({
        type: "POST",
        url: "./requiredFiles/ajax/withdrawrequestAjax.php",
        data: {
            "way": "bankotp",
            "amount": amount
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
                $("#bankotpbtn").html("Resend OTP"); 
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
        url: "./requiredFiles/ajax/withdrawrequestAjax.php",
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

const clearmsgbank = () => {
    $("#errormsgbank").html("");
}


$("#banksubmit").submit(function (e) { 
    e.preventDefault();
    
    var frm = $("#banksubmit")[0];
    var frmdata = new FormData(frm);

    $.ajax({
        type: "POST",
        url: "./requiredFiles/ajax/withdrawrequestAjax.php",
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

                $("#errormsgbank").html(response.message);

            }
        }
    });

});