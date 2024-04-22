$(document).ready(function () {
    var param1var = getQueryVariable("referral");

    function getQueryVariable(variable) {
        var query = window.location.search.substring(1);
        var vars = query.split("&");
        for (var i = 0; i < vars.length; i++) {
            var pair = vars[i].split("=");
            if (pair[0] == variable) {
                return pair[1];
            }
        }
    }
    if (param1var) {
        $("#sponseridlabel").html("Sponser ID");
        $("#sponserid").val(param1var);
        $("#sponserid").prop('readonly', true);        
        checksponser();
    }
});


const autoid = () => {
    $("#sponserid").val("UCT000000");
    checksponser();
}

const clearerror = () => {
    $("#errorshow").html("")
}

const checksponser = () => {
    const sponserid = $("#sponserid").val();

    $.ajax({
        type: "post",
        url: "./requiredFiles/ajax/signupAjax.php",
        data: {
            "way": "checksponser",
            "sponserid": sponserid
        },
        success: function (res) {
            const response = JSON.parse(res);

            if (response.status == "success") {
                $("#sponseridShow").html('<p style="color: #66e0ac;">' + response.message + '</p>')
            } else if (response.status == "failed") {
                $("#sponseridShow").html('<p style="color: red;">' + response.message + '</p>')
            }
        }
    });
}

const checkmail = () => {
    let email = $("#email").val();
    var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (emailPattern.test(email)) {
        $("#getotpactive").html('<button style="height: 60px;width: 100%" class="btn otpbtn btn-primary" type="button" onclick="getotp()">Get OTP</button>')
    } else {
        $("#getotpactive").html('<button style="height: 60px;width: 100%" class="btn otpbtn btn-primary" disabled>Get OTP</button>')
        $("#registerbtn").html(' <button style="height: 60px;width: 100%" class="btn btn-primary" type="submit" disabled>Register</button>')
    }
}

const getotp = () => {
    $(".otpbtn").html("Loading ... ");
    let email = $("#email").val();
    $.ajax({
        url: "./requiredFiles/ajax/signupAjax.php",
        type: "POST",
        data: { "way": "otpsend", "email": email },
        success: function (res) {
            let response = JSON.parse(res);
            if (response.status == "success") {
                $(".otpbtn").html("Resend OTP");
                $("#registerbtn").html(' <button style="height: 60px;width: 100%" class="btn btn-primary" type="submit">Register</button>')
                new Notify({
                    status: 'success',
                    title: 'OTP Sended',
                    text: 'OTP Sended SuccessFully !',
                    effect: 'slide',
                    speed: 300,
                    customClass: '',
                    customIcon: '',
                    showIcon: true,
                    showCloseButton: true,
                    autoclose: true,
                    autotimeout: 3000,
                    notificationsGap: null,
                    notificationsPadding: null,
                    type: 'filled',
                    position: 'right top',
                    customWrapper: '',
                })
            } else {
                $(".otpbtn").html("Get OTP");
            }
        }
    })
}

const checkrepass = () => {
    var password = $("#password").val();
    var repassword = $("#repassword").val();

    if (password === repassword) {
        $("#passwordshow").html('<p style="color: #66e0ac;"> Password Match </p>');
    } else {
        $("#passwordshow").html('<p style="color: red;"> Password doesn\'t Match</p>');
    }
}

$("#signupsubmit").submit((event) => {
    event.preventDefault();
    $("#registerbtn").html("Loading ...");
    var password = $("#password").val();
    var repassword = $("#repassword").val();
    if (password === repassword) {

        var countrycode = $("#countrycode").val();
        var number = $("#phonenumber").val();

        var sponserid = $("#sponserid").val();
        var name = $("#name").val();
        var email = $("#email").val();
        var otp = $("#otp").val();
        var phoneno = countrycode.concat(number);
        var address = $("#address").val();
        var city = $("#city").val();
        var zipcode = $("#pin").val();
        var country = $("#country").val();
        var state = $("#state").val()

        $.ajax({
            type: "post",
            url: "./requiredFiles/ajax/signupAjax.php",
            data: {
                "way": "newsignup",
                "sponserid": sponserid,
                "name": name,
                "email": email,
                "otp": otp,
                "phoneno": phoneno,
                "address": address,
                "city": city,
                "zipcode": zipcode,
                "country": country,
                "state": state,
                "password": password
            },
            success: function (res) {
                const response = JSON.parse(res);
                if (response.status == "success") {


                    location.replace("signin.php");

                } else if (response.status == "failed") {

                    $("#registerbtn").html('<button style="height: 60px;width: 100%" class="btn btn-primary" type="submit">Register</button>');

                    $("#errorshow").html("<br><p style='background-color:red;color:white;width: 100%;padding:15px;border-radius:10px' align='center'>" + response.message + "</p>")

                }

            }
        });

    } else {

        $("#registerbtn").html('<button style="height: 60px;width: 100%" class="btn btn-primary" type="submit">Register</button>');

        $("#errorshow").html("<br><p style='background-color:red;color:white;width: 100%;padding:15px;border-radius:10px' align='center'>Check the Password</p>")

    }

})