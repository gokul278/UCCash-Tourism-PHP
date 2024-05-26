const clearerror = () =>{
    $("#errormsg").html("");
}

$(document).ready(function () {
    const getData = () => {

        $.ajax({
            type: "POST",
            url: "./requiredFiles/ajax/indexAjax.php",
            data: {
                "way": "getData"
            },
            success: function (res) {
                var response = JSON.parse(res);
                if (response.status == "success") {
    
                    $(".adminname").html(response.admin_name);
    
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

    getData()
});

$("#loginfrm").submit(function (e) { 
    e.preventDefault();

    $("#loginbtn").html("Loading ...");

    var email = $("#email").val();
    var password = $("#password").val();
    
    $.ajax({
        type: "POST",
        url: "./requiredFiles/ajax/indexAjax.php",
        data: {
            "email" : email,
            "password" : password,
            "way" : "login"
        },
        success: function (res) {
            
            var response = JSON.parse(res);

            if (response.status === "success") {

                location.replace("dashboard.php");

            } else if (response.status === "failed") {

                $("#loginbtn").html("Login");
                $("#errormsg").html('<p style="padding:15px">' + response.message + '</p>');

            }

        }
    });
});

