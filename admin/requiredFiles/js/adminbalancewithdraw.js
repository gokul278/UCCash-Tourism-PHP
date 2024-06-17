$(document).ready(() => {
    $.ajax({
        type: "POST",
        url: "./requiredFiles/ajax/adminbalancewithdrawAjax.php",
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
        url: "./requiredFiles/ajax/adminbalancewithdrawAjax.php",
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

                $("#balanceadminnwallet").html(response.balanceadminnwallet + "$");
                $("#balanceadmingst").html(response.balanceadmingst + "$");


                if (response.tabledata.length >= 5) {
                    $("#tabledata").html(response.tabledata);
                } else {
                    $("#tabledata").html("<tr><td colspan='5'>No Data Found</td></tr>");
                }

            } else if (response.status == "auth_failed" && response.message == "Expired token") {

                location.replace("time_expried.php");

            } else if (response.status == "auth_failed") {

                location.replace("unauth_login.php");

            }
        }
    });

}

const clearerror = () => {
    $("#errormsg").html('');
}

$("#withdrawamount").submit(function (e) {
    e.preventDefault();

    var frm = $("#withdrawamount")[0];
    var frmdata = new FormData(frm);
    $.ajax({
        type: "POST",
        url: "./requiredFiles/ajax/adminbalancewithdrawAjax.php",
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
                    title: 'Withdrawal Status',
                    text: 'Withdrawed Successfully...!',
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

                $('#withdrawamount')[0].reset();

                return getData();

            } else if (response.status == "error") {

                $("#errormsg").html('<b>' + response.message + '</b>');

            }
        }
    });

});


const submitwalletdescription = (id) => {
    var id = $(id).attr("id");
    var description = $("#description" + id).val();

    $.ajax({
        type: "POST",
        url: "./requiredFiles/ajax/adminbalancewithdrawAjax.php",
        data: {
            "way": "updatewalletdescription",
            "id": id,
            "description": description
        },
        success: function (res) {
            var response = JSON.parse(res);
            if (response.status == "success") {

                new Notify({
                    status: 'success',
                    title: 'Description Status',
                    text: 'Description Updated Successfully...!',
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
}

const submitgstdescription = (id) => {
    var id = $(id).attr("id");
    var description = $("#description" + id).val();

    $.ajax({
        type: "POST",
        url: "./requiredFiles/ajax/adminbalancewithdrawAjax.php",
        data: {
            "way": "updategstdescription",
            "id": id,
            "description": description
        },
        success: function (res) {
            var response = JSON.parse(res);
            if (response.status == "success") {

                new Notify({
                    status: 'success',
                    title: 'Description Status',
                    text: 'Description Updated Successfully...!',
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
}