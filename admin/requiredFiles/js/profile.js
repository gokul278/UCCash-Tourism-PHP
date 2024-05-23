$(document).ready(() => {
    $.ajax({
        type: "POST",
        url: "./requiredFiles/ajax/profileAjax.php",
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
        url: "./requiredFiles/ajax/profileAjax.php",
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

const textid = () => {
    if ($("#memberid").val().length == 0) {
        $("#goButton").prop("disabled", true);
    } else {
        $("#goButton").prop("disabled", false);
    }
}


const memeberid = () => {

    var memberid = $("#memberid").val();

    $.ajax({
        type: "POST",
        url: "./requiredFiles/ajax/profileAjax.php",
        data: {
            "way": "getmemberid",
            "memberid": memberid
        },
        success: function (res) {
            var response = JSON.parse(res);
            if (response.status == "success") {

                if (response.member == "valid") {

                    $("#name").prop("disabled", false);
                    $("#inputDOB").prop("disabled", false);
                    $("#Aadhaar").prop("disabled", false);
                    $("#Pancard").prop("disabled", false);
                    $("#phone").prop("disabled", false);
                    $("#email").prop("disabled", false);
                    $("#walllet").prop("disabled", false);
                    $("#male").prop("disabled", false);
                    $("#female").prop("disabled", false);
                    $("#submitbtn").prop("disabled", false);


                    $("#sponserid").val(response.user_sponserid);
                    $("#sponser").val(response.user_sponserid);
                    $("#userid").val(response.user_id);
                    $("#name").val(response.user_name);
                    $("#inputDOB").val(response.user_dob)
                    $("#Aadhaar").val(response.user_aadharano)
                    $("#Pancard").val(response.user_panno)
                    $("#phone").val(response.user_phoneno)
                    $("#email").val(response.user_email)
                    $("#walllet").val(response.trc20_address)



                    if (response.user_gender == "male") {

                        $("#user_gender").html('<p class="small mb-1">Gender</p><input type="radio" name="gender" value="male" checked> Male&nbsp;&nbsp;&nbsp;<input type="radio" name="gender" value="female"> Female');

                    } else if (response.user_gender == "female") {

                        $("#user_gender").html('<p class="small mb-1">Gender</p><input type="radio" name="gender" value="male"> Male&nbsp;&nbsp;&nbsp;<input type="radio" name="gender" value="female" checked> Female');

                    }



                } else if (response.member == "invalid") {
                    new Notify({
                        status: 'error',
                        title: 'Invalid',
                        text: 'Invalid Member ID...!',
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
                }

            } else if (response.status == "auth_failed" && response.message == "Expired token") {

                location.replace("time_expried.php");

            } else if (response.status == "auth_failed") {

                location.replace("unauth_login.php");

            }
        }
    });

}

const clearbtn = () => {
    $("#sponserid").val("");
    $("#sponser").val("");
    $("#userid").val("");
    $("#name").val("");
    $("#inputDOB").val("")
    $("#Aadhaar").val("")
    $("#Pancard").val("")
    $("#phone").val("")
    $("#email").val("")
    $("#walllet").val("")
    $("#memberid").val("")
    $("#userid").val("")
    $("#user_gender").html('<p class="small mb-1">Gender</p><input type="radio" name="gender" value="male" disabled> Male&nbsp;&nbsp;&nbsp;<input type="radio" name="gender" value="female" disabled> Female');

    $("#name").prop("disabled", true);
    $("#inputDOB").prop("disabled", true);
    $("#Aadhaar").prop("disabled", true);
    $("#Pancard").prop("disabled", true);
    $("#phone").prop("disabled", true);
    $("#email").prop("disabled", true);
    $("#walllet").prop("disabled", true);
    $("#male").prop("disabled", true);
    $("#female").prop("disabled", true);
    $("#submitbtn").prop("disabled", true);
    $("#goButton").prop("disabled", true);
}

$("#updateEdit").submit(function (e) { 
    e.preventDefault();
    
    var frm = $("#updateEdit")[0];
    var frmdata = new FormData(frm);
    $.ajax({
        type: "POST",
        url: "./requiredFiles/ajax/profileAjax.php",
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

                return clearbtn();

            }
        }
    });
});