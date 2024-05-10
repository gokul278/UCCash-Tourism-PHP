$(document).ready(() => {
    $.ajax({
        type: "POST",
        url: "./requiredFiles/ajax/monthlysavingspendinginvoiceAjax.php",
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
        url: "./requiredFiles/ajax/monthlysavingspendinginvoiceAjax.php",
        data: {
            "way": "getData"
        },
        success: function (res) {
            var response = JSON.parse(res);
            if (response.status == "success") {

                if (response.user_profileimg != null) {
                    $(".user_profileimg").attr("src", "./img/user/" + response.user_profileimg);
                }

                $(".user_name").html(response.user_name);
                $("#pendinginvoicetable").html(response.table_data);
                

            } else if (response.status == "auth_failed" && response.message == "Expired token") {

                location.replace("time_expried.php");

            } else if (response.status == "auth_failed") {

                location.replace("unauth_login.php");

            }
        }
    });

}

const changebtn = () =>{
    if($("#fromDate").val().length >0 && $("#toDate").val().length >0){
        $("#gobtn").prop("disabled", false);
    }
}

const clearbtn = () =>{
    $("#fromDate").val("");
    $("#toDate").val("");
    return getData();
}

const goButton = () =>{
    var fromDate = $("#fromDate").val();
    var toDate = $("#toDate").val();

    $.ajax({
        type: "POST",
        url: "./requiredFiles/ajax/monthlysavingspendinginvoiceAjax.php",
        data: {
            "way" : "filterdate",
            "fromDate" : fromDate,
            "toDate" : toDate
        },
        success: function (res) {
            var response = JSON.parse(res);
            if (response.status == "success") {

                $("#pendinginvoicetable").html(response.filter_data);
                

            } else if (response.status == "auth_failed" && response.message == "Expired token") {

                location.replace("time_expried.php");

            } else if (response.status == "auth_failed") {

                location.replace("unauth_login.php");

            }
        }
    });
}