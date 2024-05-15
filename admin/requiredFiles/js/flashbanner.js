$(document).ready(() => {
    $.ajax({
        type: "POST",
        url: "./requiredFiles/ajax/flashbannerAjax.php",
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
        url: "./requiredFiles/ajax/flashbannerAjax.php",
        data: {
            "way": "getData"
        },
        success: function (res) {
            var response = JSON.parse(res);
            if (response.status == "success") {

                $(".adminname").html(response.admin_name);

                if(response.bannerimage != null){
                    $("#bannerimg").html("<img src='.././img/flashbanner/"+response.bannerimage+"' style='width:250px;height:250px' /><input type='hidden' id='bannername' value='"+response.bannerimage+"'/>");
                    $("#deletebtn").prop("disabled",false);
                }else{
                    $("#bannerimg").html("<b>No Image</b>");
                    $("#deletebtn").prop("disabled",true);
                }

            } else if (response.status == "auth_failed" && response.message == "Expired token") {

                location.replace("time_expried.php");

            } else if (response.status == "auth_failed") {

                location.replace("unauth_login.php");

            }
        }
    });

}

$("#uploadflashbanner").submit(function (e) { 
    e.preventDefault();

    var frm = $("#uploadflashbanner")[0];
    var frmdata = new FormData(frm);
    
    $.ajax({
        type: "POST",
        url: "./requiredFiles/ajax/flashbannerAjax.php",
        data: frmdata,
        processData: false,
        contentType: false,
        cache: false,
        success: function (res) {
            var response = JSON.parse(res);
            if (response.status == "success") {

                $("#formFileMultiple").val("");
                var fileNameSpan = document.getElementById('fileName');
                fileNameSpan.textContent = "";
                $("#flashbtn").prop('disabled',true);

                new Notify({
                    status: 'success',
                    title: 'FlashBanner',
                    text: 'FlashBanner Updated...!',
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

$("#deletebtn").click(function (e) { 
    e.preventDefault();

    var bannername = $("#bannername").val();
    
    $.ajax({
        type: "POST",
        url: "./requiredFiles/ajax/flashbannerAjax.php",
        data: {
            "way" : "deleteimage",
            "bannername" : bannername
        },
        success: function (res) {
            var response = JSON.parse(res);
            if (response.status == "success") {

                new Notify({
                    status: 'success',
                    title: 'FlashBanner',
                    text: 'FlashBanner Deleted...!',
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