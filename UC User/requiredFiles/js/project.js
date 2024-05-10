$(document).ready(function () {
    $.ajax({
        type: "POST",
        url: "./requiredFiles/ajax/profilesAjax.php",
        data: {
            "way": "verify"
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
        url: "./requiredFiles/ajax/profilesAjax.php",
        data: {
            "way": "getData"
        },
        success: function (res) {
            var response = JSON.parse(res);

            if (response.status == "auth_failed" && response.message == "Expired token") {

                location.replace("time_expried.php");

            } else if (response.status == "auth_failed") {

                location.replace("unauth_login.php");

            } else if (response.status == "success") {

                var username = response.user_name.split(" ");

                $(".user_name").html(response.user_name);
                $("#inputFirstName").val(username[0]);
                $("#inputLastName").val(username[1]);
                $("#inputPhone").val(response.user_phoneno);
                $("#inputBirthday").val(response.user_dob);
                $("#Aadhaarnumber").val(response.user_aadharano);
                $("#pannumber").val(response.user_panno);

                if (response.user_maritalstatus == "married") {

                    $("#user_maritalstatus").html('<p class="small mb-1">Marital Status</p><input type="radio" name="maritalstatus" value="married" checked> Yes&nbsp;&nbsp;&nbsp;<input type="radio" name="maritalstatus" value="unmarried"> No');

                } else if (response.user_maritalstatus == "unmarried") {

                    $("#user_maritalstatus").html('<p class="small mb-1">Marital Status</p><input type="radio" name="maritalstatus" value="married" > Yes&nbsp;&nbsp;&nbsp;<input type="radio" name="maritalstatus" value="unmarried" checked> No');

                }

                if(response.user_gender == "male"){

                    $("#user_gender").html('<p class="small mb-1">Gender</p><input type="radio" name="gender" value="male" checked> Male&nbsp;&nbsp;&nbsp;<input type="radio" name="gender" value="female"> Female');

                }else if(response.user_gender == "female"){

                    $("#user_gender").html('<p class="small mb-1">Gender</p><input type="radio" name="gender" value="male"> Male&nbsp;&nbsp;&nbsp;<input type="radio" name="gender" value="female" checked> Female');

                }

                if (response.user_profileimg != null) {
                    $(".user_profileimg").attr("src", "./img/user/" + response.user_profileimg);
                }

            }
        }
    });
}

const changeimg = () => {
    var fileInput = document.getElementById('profileimg');
    var file = fileInput.files[0];
    var reader = new FileReader();
    reader.onload = function (event) {
        $(".changeuserprofile").attr("src", event.target.result);
    }
    reader.readAsDataURL(file);
    $('#imgsavebtn').removeAttr('disabled');
}

$("#profileimgupdate").submit(function (e) {
    e.preventDefault();
    var frm = $("#profileimgupdate")[0];
    var frmdata = new FormData(frm);
    $.ajax({
        type: "POST",
        url: "./requiredFiles/ajax/profilesAjax.php",
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

                new Notify({
                    status: 'success',
                    title: 'Image Updated',
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

                $("#profileimg").val("");
                $('#imgsavebtn').attr('disabled', 'disabled');
                return getData();

            }
        }
    });
});


$("#profileupdate").submit(function (e) {
    e.preventDefault();
    var frm = $("#profileupdate")[0];
    var frmdata = new FormData(frm);
    $.ajax({
        type: "POST",
        url: "./requiredFiles/ajax/profilesAjax.php",
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

                new Notify({
                    status: 'success',
                    title: 'Details Updated',
                    text: 'Profile Details Updated...!',
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

            }
        }
    });
});