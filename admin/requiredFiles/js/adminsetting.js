$(document).ready(() => {
    $.ajax({
        type: "POST",
        url: "./requiredFiles/ajax/adminsettingAjax.php",
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
        url: "./requiredFiles/ajax/adminsettingAjax.php",
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

$("#updateimage").submit(function (e) {
    e.preventDefault();

    $("#submitbtn").html("Loading ...")

    var frm = $("#updateimage")[0];
    var frmdata = new FormData(frm);

    $.ajax({
        type: "POST",
        url: "./requiredFiles/ajax/adminsettingAjax.php",
        data: frmdata,
        processData: false,
        contentType: false,
        cache: false,
        success: function (res) {
            var response = JSON.parse(res);
            if (response.status == "success") {

                $("#submitbtn").html("Save changes");
                $("#submitbtn").prop("disabled", true);

                const input = document.getElementById('uploadButton');
                const fileName = document.getElementById('fileName');

                // Reset the file input
                input.value = '';
                // Clear the file name display
                fileName.textContent = '';

                new Notify({
                    status: 'success',
                    title: 'Profile Updated',
                    text: 'Profile Image Updated...!',
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

            } else if (response.status == "auth_failed" && response.message == "Expired token") {

                location.replace("time_expried.php");

            } else if (response.status == "auth_failed") {

                location.replace("unauth_login.php");

            }
        }
    });

});


const checkpass = () =>{

    var currentpassword = $("#currentpassword").val();
    var pasasword = $("#password").val();
    var repasasword = $("#repassword").val();

    if(currentpassword.length >= 5){
        if(pasasword.length >= 5){
            if(repasasword == pasasword){
                $("#submitpasswordbtn").prop("disabled",false);
            }else{
                $("#submitpasswordbtn").prop("disabled",true);
            }
        }else{
            $("#submitpasswordbtn").prop("disabled",true);
        }
    }else{
        $("#submitpasswordbtn").prop("disabled",true);
    }

}

const clearerror = () =>{
    $("#errormsg").html("");
}


$("#passwordchanage").submit(function (e) { 
    e.preventDefault();
    
    var frm = $("#passwordchanage")[0];
    var frmdata = new FormData(frm);
    $.ajax({
        type: "POST",
        url: "./requiredFiles/ajax/adminsettingAjax.php",
        data: frmdata,
        processData: false,
        contentType: false,
        cache: false,
        success: function (res) {
            try {
                var response = JSON.parse(res);

                if (response.status == "auth_failed" && response.message == "Expired token") {
                    location.replace("time_expried.php");
                } else if (response.status == "auth_failed") {
                    location.replace("unauth_login.php");
                } else if (response.status == "success") {
                    new Notify({
                        status: 'success',
                        title: 'Password Updated',
                        text: 'Password Updated Successfully...!',
                        effect: 'fade',
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
                    });
                    frm.reset();
                } else if (response.status == "error") {
                    $("#errormsg").html("<b>"+response.message+"</b>");
                    $("#submitpasswordbtn").prop("disabled", true);
                }
            } catch (e) {
                console.error("Invalid JSON response from server:", res);
            }
        }
    });
});
