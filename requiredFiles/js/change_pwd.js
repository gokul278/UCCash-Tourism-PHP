const clearerror = () =>{
    $("#errorshow").html("")
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