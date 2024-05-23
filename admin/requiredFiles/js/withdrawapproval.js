$(document).ready(() => {
    $.ajax({
        type: "POST",
        url: "./requiredFiles/ajax/withdrawapprovalAjax.php",
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
        url: "./requiredFiles/ajax/withdrawapprovalAjax.php",
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

                if (response.tabledata.length > 0) {
                    $("#tabledata").html(response.tabledata);
                    let table = new DataTable('#myTable', {
                        ordering: false
                    });
                } else {
                    $("#tabledata").html("<tr><td colspan='12'>No Data Found</td></tr>");
                }

            } else if (response.status == "auth_failed" && response.message == "Expired token") {

                location.replace("time_expried.php");

            } else if (response.status == "auth_failed") {

                location.replace("unauth_login.php");

            }
        }
    });

}

const rejectwithdraw = (index) => {
    var withdrawid = $("#id" + index).val();
    var rejectreason = $("#reason" + index).val();

    $("#rejectbtn" + index).html("Loading ...");

    if (rejectreason.length >= 1) {

        $.ajax({
            type: "POST",
            url: "./requiredFiles/ajax/withdrawapprovalAjax.php",
            data: {
                "way": "rejectwithdraw",
                "withdrawid": withdrawid,
                "rejectreason": rejectreason
            },
            success: function (res) {
                var response = JSON.parse(res);
                if (response.status == "success") {

                    location.replace("withdraw history.php")

                } else if (response.status == "auth_failed" && response.message == "Expired token") {

                    location.replace("time_expried.php");

                } else if (response.status == "auth_failed") {

                    location.replace("unauth_login.php");

                }
            }
        });
    }else{
        alert("Enter Reason");
        $("#rejectbtn" + index).html("Reject");
    }

}

const approvewithdraw = (index) => {
    var withdrawid = $("#id" + index).val();
    var txnid = $("#txnid" + index).val();

    $("#approvebtn" + index).html("Loading ...");

    if(txnid.length >= 1){

    $.ajax({
        type: "POST",
        url: "./requiredFiles/ajax/withdrawapprovalAjax.php",
        data: {
            "way": "approvewithdraw",
            "withdrawid": withdrawid,
            "txnid": txnid
        },
        success: function (res) {
            var response = JSON.parse(res);
            if (response.status == "success") {

                location.replace("withdraw history.php")

            } else if (response.status == "auth_failed" && response.message == "Expired token") {

                location.replace("time_expried.php");

            } else if (response.status == "auth_failed") {

                location.replace("unauth_login.php");

            }
        }
    });

}else{

    

}

}