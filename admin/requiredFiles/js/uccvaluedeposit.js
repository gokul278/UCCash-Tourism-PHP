$(document).ready(() => {
    $.ajax({
        type: "POST",
        url: "./requiredFiles/ajax/uccvaluedepositAjax.php",
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

var i = 0;
const getData = () => {

    i++;

    $.ajax({
        type: "POST",
        url: "./requiredFiles/ajax/uccvaluedepositAjax.php",
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

                if (response.tabledata.length >= 1) {
                    $("#tabledata").html(response.tabledata);
                    if(i == 1){
                        let table = new DataTable('#myTable',{
                            ordering:  false
                        });                        
                    }
                } else {
                    $("#tabledata").html(response.tabledata);
                    $("#tabledata").html("<tr><th colspan='8'>No Data Found</th></tr>");
                }

            } else if (response.status == "auth_failed" && response.message == "Expired token") {

                location.replace("time_expried.php");

            } else if (response.status == "auth_failed") {

                location.replace("unauth_login.php");

            }
        }
    });

}

const getuser = () =>{
    var userid = $("#userid").val();


    if(userid.length >= 1){

        $.ajax({
            type: "POST",
            url: "./requiredFiles/ajax/uccvaluedepositAjax.php",
            data: {
                "way": "getusername",
                "userid" : userid
            },
            success: function (res) {
                var response = JSON.parse(res);
                if (response.status == "success") {
    
                    if (response.message == "noid") {
    
                        $("#username").html("<p style='color:red'>Invalid ID</p>");
                        $("#depositbtn").prop("disabled",true);
    
                    } else {
    
                        $("#username").html("<p style='color:green'>" + response.message + "</p>");
                        $("#depositbtn").prop("disabled",false);
    
                    }
    
                } else if (response.status == "auth_failed" && response.message == "Expired token") {
    
                    location.replace("time_expried.php");
    
                } else if (response.status == "auth_failed") {
    
                    location.replace("unauth_login.php");
    
                }
            }
        });

    }else{

        $("#username").html("<p>Enter the User ID</p>");
        $("#depositbtn").prop("disabled",true);

    }    

}


$("#depositevalue").submit(function (e) { 
    e.preventDefault();
    
    var frm = $("#depositevalue")[0];
    var frmdata = new FormData(frm);
    $.ajax({
        type: "POST",
        url: "./requiredFiles/ajax/uccvaluedepositAjax.php",
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
                    title: 'UCC Value',
                    text: 'UCC Value Deposited ..!',
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

                $("#userid").val("");
                $("#depositvalue").val("");
                $("#depositbtn").prop("disabled",true);
                $("#username").html("<p>Enter the User ID</p>");

                return getData();

            }
        }
    });

});