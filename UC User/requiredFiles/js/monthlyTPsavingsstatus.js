$(document).ready(() => {
    $.ajax({
        type: "POST",
        url: "./requiredFiles/ajax/monthlyTPsavingsstatusAjax.php",
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
        url: "./requiredFiles/ajax/monthlyTPsavingsstatusAjax.php",
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

                $("#historytabledata").html(response.table_data);


            } else if (response.status == "auth_failed" && response.message == "Expired token") {

                location.replace("time_expried.php");

            } else if (response.status == "auth_failed") {

                location.replace("unauth_login.php");

            }
        }
    });

}

const changeenable = () =>{
    var fromDate = $("#fromDate").val();
    var toDate = $("#toDate").val();

    if(fromDate.length>0 && toDate.length >0){
        $("#goButton").prop("disabled", false)
    }
}

const clearbtn = () =>{
    $("#fromDate").val("");
    $("#toDate").val("");
    $("#goButton").prop("disabled", true)
    return getData();
}

const getbtn = () =>{

    var fromDate = $("#fromDate").val();
    var toDate = $("#toDate").val();

    $.ajax({
        type: "POST",
        url: "./requiredFiles/ajax/monthlyTPsavingsstatusAjax.php",
        data: {
            "way" : "filterDate",
            "fromDate" : fromDate,
            "toDate" : toDate
        },
        success: function (res) {

            var response = JSON.parse(res);
            if (response.status == "success") {

                $("#historytabledata").html(response.filter_data);


            } else if (response.status == "auth_failed" && response.message == "Expired token") {

                location.replace("time_expried.php");

            } else if (response.status == "auth_failed") {

                location.replace("unauth_login.php");

            }
            
        }
    });
}

const invoiceprint = (button) =>{
    var userid = $(button).attr("userId");
    var username = $(button).attr("username");
    var emailid = $(button).attr("emailid");
    var phoneno = $(button).attr("phoneno");
    var invoiceid = $(button).attr("invoiceid");
    var invoicedate = $(button).attr("invoicedate");
    var paiddate = $(button).attr("paiddate");

    window.open("./requiredFiles/ajax/invoiceAjax.php?way=invoiceprint&userid="+userid+"&username="+username+"&emailid="+emailid+"&phoneno="+phoneno+"&invoiceid="+invoiceid+"&invoicedate="+invoicedate+"&paiddate="+paiddate+"", "_blank");

}