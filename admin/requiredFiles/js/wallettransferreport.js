$(document).ready(() => {
    $.ajax({
        type: "POST",
        url: "./requiredFiles/ajax/wallettransferreportAjax.php",
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
        url: "./requiredFiles/ajax/wallettransferreportAjax.php",
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

                } else {

                    $("#tabledata").html("<tr><td colspan='8'>No Data Found</td></tr>");

                }

            } else if (response.status == "auth_failed" && response.message == "Expired token") {

                location.replace("time_expried.php");

            } else if (response.status == "auth_failed") {

                location.replace("unauth_login.php");

            }
        }
    });

}


$("#idsearch").click(function (e) {
    e.preventDefault();

    var userid = $("#userid").val();

    $.ajax({
        type: "POST",
        url: "./requiredFiles/ajax/wallettransferreportAjax.php",
        data: {
            "way": "seachid",
            "userid": userid
        },
        success: function (res) {
            var response = JSON.parse(res);
            if (response.status == "success") {

                if (response.tabledata.length >= 1) {

                    $("#tabledata").html(response.tabledata);

                } else {

                    $("#tabledata").html("<tr><td colspan='8'>No Data Found</td></tr>");

                }

            } else if (response.status == "auth_failed" && response.message == "Expired token") {

                location.replace("time_expried.php");

            } else if (response.status == "auth_failed") {

                location.replace("unauth_login.php");

            }
        }
    });

});


$("#idclear").click(function (e) {
    e.preventDefault();

    $("#userid").val("");

    return getData();
});


$("#datesearch").click(function (e) {
    e.preventDefault();

    var fromdate = $("#fromDate").val();
    var todate = $("#toDate").val();

    $.ajax({
        type: "POST",
        url: "./requiredFiles/ajax/wallettransferreportAjax.php",
        data: {
            "way": "searchdate",
            "fromdate": fromdate,
            "todate" : todate
        },
        success: function (res) {
            var response = JSON.parse(res);
            if (response.status == "success") {

                if (response.tabledata.length >= 1) {

                    $("#tabledata").html(response.tabledata);

                } else {

                    $("#tabledata").html("<tr><td colspan='8'>No Data Found</td></tr>");

                }

            } else if (response.status == "auth_failed" && response.message == "Expired token") {

                location.replace("time_expried.php");

            } else if (response.status == "auth_failed") {

                location.replace("unauth_login.php");

            }
        }
    });

});

$("#dateclear").click(function (e) { 
    e.preventDefault();
    
    $("#fromDate").val("");
    $("#toDate").val("");
    
    return getData();
});