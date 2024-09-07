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

    const url = new URL(window.location.href);
    const params = new URLSearchParams(url.search);
    const invoiceId = params.get('invoice_id');

    $.ajax({
        type: "POST",
        url: "./requiredFiles/ajax/monthlyTPsavingsAjax.php",
        data: {
            "way": "getData",
            "invoice_id": invoiceId
        },
        success: function (res) {
            var response = JSON.parse(res);
            if (response.status == "success") {

                if (response.user_profileimg != null) {
                    $(".user_profileimg").attr("src", "./img/user/" + response.user_profileimg);
                }

                $(".user_name").html(response.user_name);

                $("#depositvalue").val(response.deposite_value + " UCC")

                $(".invoiceid").html(response.invoice_id);
                $("#invoiceidval").val(response.invoice_id);
                $("#invoicedate").html(response.created_at);

            } else if (response.status == "error") {
                if (response.user_profileimg != null) {
                    $(".user_profileimg").attr("src", "./img/user/" + response.user_profileimg);
                }

                $(".user_name").html(response.user_name);
                $("#nullID").html("<p style='color:red;font-size:25px' align='center'>" + response.message + "</p>");
                $("#contenterror").html("");
                $("#notbtn").prop("disabled", true);
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