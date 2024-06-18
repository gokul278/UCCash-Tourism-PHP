const checkrepass = () => {
    const password = $("#password").val();
    const repassword = $("#repassword").val();
    const isValid = password.length > 5 && repassword.length > 5 && password === repassword;

    $("#changestatus").prop("disabled", !isValid);
}

$("#passchange").submit(function (e) { 
    e.preventDefault();
    
    var frm = $("#passchange")[0];
    var frmdata = new FormData(frm);
    $.ajax({
        type: "POST",
        url: "./requiredFiles/ajax/change_pwdAjax.php",
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

                location.replace("./index.php")

            } else if (response.status == "error") {

                $("#errorshow").html(response.message);

            }
        }
    });
});

const clearerror = () =>{
    $("#errorshow").html("");
}
