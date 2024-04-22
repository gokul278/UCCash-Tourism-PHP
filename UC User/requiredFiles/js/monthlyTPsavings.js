$(document).ready(() => {
    $.ajax({
        type: "POST",
        url: "./requiredFiles/ajax/monthlyTPsavingsAjax.php",
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
        url: "./requiredFiles/ajax/monthlyTPsavingsAjax.php",
        data: {
            "way": "getData"
        },
        success: function (res) {
            var response = JSON.parse(res);
            if (response.status == "success") {

                if (response.user_profileimg.length >= 1) {
                    $(".user_profileimg").attr("src", "./img/user/" + response.user_profileimg);
                }

                $(".user_name").html(response.user_name);

                $("#depositvalue").val(response.uccvalue + " UCC")

                if (response.invoiceid == "nullID") {

                    $("#nullID").html("<p style='color:red'>No Pending Invoice</p>");
                    $("#notbtn").prop("disabled", true);

                } else {

                    $(".invoiceid").html(response.invoiceid);
                    $("#invoiceidval").val(response.invoiceid);
                    $("#invoicedate").html(response.invoicedate);

                }

            } else if (response.status == "auth_failed" && response.message == "Expired token") {

                location.replace("time_expried.php");

            } else if (response.status == "auth_failed") {

                location.replace("unauth_login.php");

            }
        }
    });

}

$("#submithashid").submit(function (e) {
    e.preventDefault();
    var uccvalue = $("#depositvalue").val();
    var txnhashid = $("#pasteBox").val();
    var invoiceidval = $("#invoiceidval").val();

    $.ajax({
        type: "POST",
        url: "./requiredFiles/ajax/monthlyTPsavingsAjax.php",
        data: {
            "way": "submithashid",
            "uccvalue": uccvalue,
            "txnhashid": txnhashid,
            "invoiceidval": invoiceidval
        },
        success: function (res) {
            var response = JSON.parse(res);
            if (response.status == "success") {

                location.replace("monthly TP savings status.php");

            } else if (response.status == "auth_failed" && response.message == "Expired token") {

                location.replace("time_expried.php");

            } else if (response.status == "auth_failed") {

                location.replace("unauth_login.php");

            }
        }
    });

});