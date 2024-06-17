$(document).ready(() => {
    $.ajax({
        type: "POST",
        url: "./requiredFiles/ajax/membersiincomebalancesheetAjax.php",
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

    function getQueryVariable(variable) {
        var query = window.location.search.substring(1);
        var vars = query.split("&");
        for (var i = 0; i < vars.length; i++) {
            var pair = vars[i].split("=");
            if (pair[0] === variable) {
                return decodeURIComponent(pair[1]);
            }
        }
        return null;
    }

    var param1var = getQueryVariable("userid");

    console.log(param1var);

    if (param1var != null) {

        $("#memberid").val(param1var);

        $("#useridbtn").html("Loading");

        $("#useridbtn").prop("disabled", true);

        $.ajax({
            type: "POST",
            url: "./requiredFiles/ajax/membersiincomebalancesheetAjax.php",
            data: {
                "way": "userfilter",
                "userid": param1var
            },
            success: function (res) {
                var response = JSON.parse(res);
                if (response.status == "success") {

                    $(".adminname").html(response.admin_name);

                    if (response.profile_image !== null) {
                        $(".profile_image").attr("src", "./img/user/" + response.profile_image);
                    }

                    $("#useridbtn").html("Search");

                    $("#useridclearbtn").prop("disabled", false);

                    if (response.tabledata.length > 0) {
                        $("#tabledata").html(response.tabledata);
                    } else {
                        $("#tabledata").html("<tr><td colspan='8'>No Data Found</td></tr>");
                    }

                    $("#totalcredit").html(response.totalcredit);
                    $("#totaldebit").html(response.totaldebit);
                    $("#totalbalance").html(response.totalbalance);

                } else if (response.status == "auth_failed" && response.message == "Expired token") {

                    location.replace("time_expried.php");

                } else if (response.status == "auth_failed") {

                    location.replace("unauth_login.php");

                }
            }
        });

    } else {

        $.ajax({
            type: "POST",
            url: "./requiredFiles/ajax/membersiincomebalancesheetAjax.php",
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
                    } else {
                        $("#tabledata").html("<tr><td colspan='8'>No Data Found</td></tr>");
                    }

                    $("#totalcredit").html(response.totalcredit);
                    $("#totaldebit").html(response.totaldebit);
                    $("#totalbalance").html(response.totalbalance);

                } else if (response.status == "auth_failed" && response.message == "Expired token") {

                    location.replace("time_expried.php");

                } else if (response.status == "auth_failed") {

                    location.replace("unauth_login.php");

                }
            }
        });

    }

}

const checkuser = () => {
    var userid = $("#memberid").val();

    if (userid.length >= 7) {
        $("#useridbtn").prop("disabled", false);
    } else {
        $("#useridbtn").prop("disabled", true);
    }
}

$("#useridbtn").click(function (e) {
    e.preventDefault();

    var userid = $("#memberid").val();

    $("#useridbtn").html("Loading");

    $("#useridbtn").prop("disabled", true);

    $.ajax({
        type: "POST",
        url: "./requiredFiles/ajax/membersiincomebalancesheetAjax.php",
        data: {
            "way": "userfilter",
            "userid": userid
        },
        success: function (res) {
            var response = JSON.parse(res);
            if (response.status == "success") {

                $("#useridbtn").html("Search");

                $("#useridclearbtn").prop("disabled", false);

                if (response.tabledata.length > 0) {
                    $("#tabledata").html(response.tabledata);
                } else {
                    $("#tabledata").html("<tr><td colspan='8'>No Data Found</td></tr>");
                }

                $("#totalcredit").html(response.totalcredit);
                $("#totaldebit").html(response.totaldebit);
                $("#totalbalance").html(response.totalbalance);

            } else if (response.status == "auth_failed" && response.message == "Expired token") {

                location.replace("time_expried.php");

            } else if (response.status == "auth_failed") {

                location.replace("unauth_login.php");

            }
        }
    });

});

$("#useridclearbtn").click(function (e) {
    e.preventDefault();

    $("#memberid").val("")

    $("#useridbtn").prop("disabled", true);
    $("#useridclearbtn").prop("disabled", true);
    $("#tabledata").html("<tr><td colspan='8'>Loading ...</td></tr>");

    return getData();
});

const dateinput = () => {
    var fromDate = $("#fromDate").val();
    var toDate = $("#toDate").val();

    if (fromDate.length >= 1 && toDate.length >= 1) {
        $("#searchbtn").prop("disabled", false);
    } else {
        $("#searchbtn").prop("disabled", true);
    }
}

$("#searchbtn").click(function (e) {
    e.preventDefault();

    $("#searchbtn").html("Loading");

    $("#searchbtn").prop("disabled", true);

    var fromDate = $("#fromDate").val();
    var toDate = $("#toDate").val();

    $.ajax({
        type: "POST",
        url: "./requiredFiles/ajax/membersiincomebalancesheetAjax.php",
        data: {
            "way": "datefilter",
            "fromdate": fromDate,
            "todate": toDate
        },
        success: function (res) {
            var response = JSON.parse(res);
            if (response.status == "success") {

                $("#searchbtn").html("Search");

                $("#clearbtnsearch").prop("disabled", false);

                if (response.tabledata.length > 0) {
                    $("#tabledata").html(response.tabledata);
                } else {
                    $("#tabledata").html("<tr><td colspan='8'>No Data Found</td></tr>");
                }

                $("#totalcredit").html(response.totalcredit);
                $("#totaldebit").html(response.totaldebit);
                $("#totalbalance").html(response.totalbalance);

            } else if (response.status == "auth_failed" && response.message == "Expired token") {

                location.replace("time_expried.php");

            } else if (response.status == "auth_failed") {

                location.replace("unauth_login.php");

            }
        }
    });

});

$("#clearbtnsearch").click(function (e) {
    e.preventDefault();

    $("#fromDate").val("");
    $("#toDate").val("");

    $("#useridbtn").prop("disabled", true);
    $("#clearbtnsearch").prop("disabled", true);
    $("#tabledata").html("<tr><td colspan='8'>Loading ...</td></tr>");
    return getData();
});

function exportToExcel() {
    var table = document.getElementById("myTable");
    var wb = XLSX.utils.table_to_book(table, {sheet: "Members Income Balance"});
    XLSX.writeFile(wb, "Members_Income_Balance_Sheet.xlsx");
}
