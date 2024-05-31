const checkrepass = () => {
    var password = $("#password").val();
    var repassword = $("#repassword").val();

    var uppercaseRegex = /[A-Z]/;
    var lowercaseRegex = /[a-z]/;
    var specialCharRegex = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/;

    var condition = 0;

    if (password.length >= 8) {
        $("#min8").html("<div style='color:green'><span style='font-size:20px;'><i class='bi bi-check'></i></span> Minimum 8 characters</div>")
        condition++;
    }else if (password.length < 8) {
        $("#min8").html("<span style='font-size:20px;color:red'>*</span> Minimum 8 characters")
    }

    if (uppercaseRegex.test(password)) {
        $("#uppercase").html("<div style='color:green'><span style='font-size:20px;'><i class='bi bi-check'></i></span> A capital (UPPERCASE) Letter</div>")
        condition++;
    }else if (!uppercaseRegex.test(password)) {
        $("#uppercase").html("<span style='font-size:20px;color:red'>*</span> A capital (UPPERCASE) Letter")
    }

    if (lowercaseRegex.test(password)) {
        $("#lowercase").html("<div style='color:green'><span style='font-size:20px;'><i class='bi bi-check'></i></span> A lowercase (LOWERCASE) letter</div>")
        condition++;
    }else if (!lowercaseRegex.test(password)) {
        $("#lowercase").html("<span style='font-size:20px;color:red'>*</span> A lowercase (LOWERCASE) letter")
    }
    
    if (specialCharRegex.test(password)) {
        $("#special").html("<div style='color:green'><span style='font-size:20px;'><i class='bi bi-check'></i></span> A lowercase (LOWERCASE) letter</div>")
        condition++;
    }else if (!specialCharRegex.test(password)) {
        $("#special").html("<span style='font-size:20px;color:red'>*</span> A Special Character")
    }

    if (password === repassword) {
        if(password.length == 0){
            $("#passwordshow").html('<p style="color: red;">Enter Password</p>');
        }else{
            $("#passwordshow").html('<p style="color: green;"> Password Match </p>');
            condition++;
        }
    } else {
        $("#passwordshow").html('<p style="color: red;"> Password doesn\'t Match</p>');
    }

    console.log(condition);

    if(condition === 5){
        $("#submitbtn").prop("disabled",false)
    }
}
const clearmsg = () => {
    $("#invalidpass").html("");
}

$(document).ready(() => {
    $.ajax({
        type: "POST",
        url: "./requiredFiles/ajax/securityAjax.php",
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
        url: "./requiredFiles/ajax/securityAjax.php",
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


            } else if (response.status == "auth_failed" && response.message == "Expired token") {

                location.replace("time_expried.php");

            } else if (response.status == "auth_failed") {

                location.replace("unauth_login.php");

            }
        }
    });

}

$("#changespass").submit(function (e) {
    e.preventDefault();
    $("#submitbtn").text("Loading ...");
    var frm = $("#changespass")[0];
    var frmdata = new FormData(frm);
    $.ajax({
        type: "POST",
        url: "./requiredFiles/ajax/securityAjax.php",
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

            } else if (response.status == "success" && response.message == "changed") {

                $("#OldPassword").val("");
                $("#password").val("");
                $("#repassword").val("");
                $("#passwordshow").html("");
                $("#invalidpass").html("");
                $("#submitbtn").prop("disabled", true);
                $("#submitbtn").text("Save Changes");


                new Notify({
                    status: 'success',
                    title: 'Password Changed',
                    text: 'Password Changed Successfully...!',
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

                return getData();

            } else if (response.status == "success" && response.message == "invalid") {
                $("#submitbtn").text("Save Changes");
                $("#invalidpass").html('<p style="color: red;"> Invalid Old Password </p>');
            }
        }
    });
});