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
    $("#sponserid").val("UCT99999");
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


    if(email.length >= 1){

        $.ajax({
            type: "post",
            url: "./requiredFiles/ajax/signupAjax.php",
            data: {
                "way": "mailidcheck",
                "email": email
            },
            success: function (res) {
                const response = JSON.parse(res);
    
                if (response.status == "success") {
                    
                    $("#getotpactive").html('<button style="height: 60px;width: 100%" class="btn otpbtn btn-primary" type="button" onclick="getotp()">Get OTP</button>');
    
                    var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                    if (emailPattern.test(email)) {
                        $("#emailidshow").html('<p style="color: #66e0ac;">' + response.message + '</p>');
                    } else {
                        $("#emailidshow").html('<p style="color: red;"> Invalid Mail </p>');
                    }
    
                } else if (response.status == "failed") {
                    $("#emailidshow").html('<p style="color: red;">' + response.message + '</p>');
                    $("#getotpactive").html('<button style="height: 60px;width: 100%" class="btn otpbtn btn-primary" disabled>Get OTP</button>')
                    $("#registerbtn").html(' <button style="height: 60px;width: 100%" class="btn btn-primary" type="submit" disabled>Register</button>')
                }
            }
        });

    }else{
        $("#emailidshow").html('');
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

    var uppercaseRegex = /[A-Z]/;
    var lowercaseRegex = /[a-z]/;
    var specialCharRegex = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/;

    if (password.length >= 8) {
        $("#min8").html("<div style='color:green'><span style='font-size:20px;'><i class='bi bi-check'></i></span> Minimum 8 characters</div>")
    }else if (password.length < 8) {
        $("#min8").html("<span style='font-size:20px;color:red'>*</span> Minimum 8 characters")
    }

    if (uppercaseRegex.test(password)) {
        $("#uppercase").html("<div style='color:green'><span style='font-size:20px;'><i class='bi bi-check'></i></span> A capital (UPPERCASE) Letter</div>")
    }else if (!uppercaseRegex.test(password)) {
        $("#uppercase").html("<span style='font-size:20px;color:red'>*</span> A capital (UPPERCASE) Letter")
    }

    if (lowercaseRegex.test(password)) {
        $("#lowercase").html("<div style='color:green'><span style='font-size:20px;'><i class='bi bi-check'></i></span> A lowercase (LOWERCASE) letter</div>")
    }else if (!lowercaseRegex.test(password)) {
        $("#lowercase").html("<span style='font-size:20px;color:red'>*</span> A lowercase (LOWERCASE) letter")
    }
    
    if (specialCharRegex.test(password)) {
        $("#special").html("<div style='color:green'><span style='font-size:20px;'><i class='bi bi-check'></i></span> A lowercase (LOWERCASE) letter</div>")
    }else if (!specialCharRegex.test(password)) {
        $("#special").html("<span style='font-size:20px;color:red'>*</span> A Special Character")
    }

    if (password === repassword) {
        if(password.length == 0){
            $("#passwordshow").html('<p style="color: red;">Enter Password</p>');
        }else{
            $("#passwordshow").html('<p style="color: green;"> Password Match </p>');
        }
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