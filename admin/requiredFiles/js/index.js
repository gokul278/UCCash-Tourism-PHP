const clearerror = () =>{
    $("#errormsg").html("");
}

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