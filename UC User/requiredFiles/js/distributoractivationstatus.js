$(document).ready(() => {
    $.ajax({
        type: "POST",
        url: "./requiredFiles/ajax/distributoractivationstatusAjax.php",
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
        url: "./requiredFiles/ajax/distributoractivationstatusAjax.php",
        data: {
            "way": "getData"
        },
        success: function (res) {
            var response = JSON.parse(res);
            if (response.status == "success") {
                
                $(".user_name").html(response.user_name);
                if (response.user_profileimg.length >= 1) {
                    $(".user_profileimg").attr("src", "./img/user/" + response.user_profileimg);
                }

                if(response.tabledata.length > 0){
                    $("#tabledata").html(response.tabledata)
                }else{
                    $("#tabledata").html("<tr><th colspan='10'>No Data Found</th></tr>");
                }

            } else if (response.status == "auth_failed" && response.message == "Expired token") {

                location.replace("time_expried.php");

            } else if (response.status == "auth_failed") {

                location.replace("unauth_login.php");

            }
        }
    });

}

const check = () =>{
    var fromdate = $("#fromDate").val();
    var todate = $("#toDate").val();

    if(fromdate.length > 0 && todate.length > 0){

        $("#goButton").prop("disabled", false);

    }else{

        $("#goButton").prop("disabled", true);

    }
}

$("#clearbtn").click(function () { 

    $("#fromDate").val("");
    $("#toDate").val("");
    $("#goButton").prop("disabled", true);
    return getData();

});

$("#filterDate").submit(function (e) { 
    e.preventDefault();
    
    var fromdate = $("#fromDate").val();
    var todate = $("#toDate").val();

    $.ajax({
        type: "POST",
        url: "./requiredFiles/ajax/distributoractivationstatusAjax.php",
        data: {
            "way" : "filterdate",
            "fromDate" : fromdate,
            "toDate" : todate
        },
        success: function (res) {

            var response = JSON.parse(res);
            if (response.status == "success") {
                
                if(response.tabledata.length > 0){
                    $("#tabledata").html(response.tabledata)
                }else{
                    $("#tabledata").html("<tr><th colspan='10'>No Data Found</th></tr>");
                }

            } else if (response.status == "auth_failed" && response.message == "Expired token") {

                location.replace("time_expried.php");

            } else if (response.status == "auth_failed") {

                location.replace("unauth_login.php");

            }
            
        }
    });


});
