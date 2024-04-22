const clearerror = () => {
    $("#errormsg").html("");
}


$("#signinfrm").submit(function (e) {
    e.preventDefault();
    $("#loginbtn").html("Loading ...");
    var userid = $("#userid").val();
    var password = $("#password").val();

    $.ajax({
        type: "POST",
        url: "./requiredFiles/ajax/signinAjax.php",
        data: {
            "way": "login",
            "userid": userid,
            "password": password
        },
        success: function (res) {

            var response = JSON.parse(res);

            if (response.status === "success") {

                location.replace("UC User/index.php");

            } else if (response.status === "failed") {

                $("#loginbtn").html("Login");
                $("#errormsg").html('<p style="padding:15px">' + response.message + '</p>')
            }

        }
    });

});