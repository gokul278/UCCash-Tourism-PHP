const clearerror = () =>{
    $("#errorshow").html("")
}

$("#passchange").submit(function (e) { 
    e.preventDefault();
    $("#changebtn").html('<button type="text" class="btn btn-primary py-3 w-100 mb-4">Loading ...</button>')

    var password = $("#password").val();
    var repassword = $("#repassword").val();
    var userid = $("#user_id").val();
    var hashvalue = $("#hashvalue").val();

    if(password === repassword){

        $.ajax({
            type: "POST",
            url: "./requiredFiles/ajax/change_pwdAjax.php",
            data: {
                "way" : "passwordchange",
                "userid" : userid,
                "hashvalue" : hashvalue,
                "password" : password
            },
            success: function (res) {
                const response = JSON.parse(res);

                if(response.status === "success"){
                    location.replace("signin.php");
                }
            }
        });

    }else{

        $("#changebtn").html('<button type="submit" class="btn btn-primary py-3 w-100 mb-4">Change Password</button>')

        $("#errorshow").html('<p style="background-color: red;color:white; padding:10px;border-radius:10px" align="center"> Match the Password </p>')
    }

});