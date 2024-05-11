$(document).ready(() => {

    $.ajax({
        type: "POST",
        url: "./requiredFiles/ajax/directmemberlistAjax.php",
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
        url: "./requiredFiles/ajax/directmemberlistAjax.php",
        data: {
            "way": "getData"
        },
        success: function (res) {
            var response = JSON.parse(res);
            if (response.status == "success") {



                if (response.user_profileimg !== null) {
                    $(".user_profileimg").attr("src", "./img/user/" + response.user_profileimg);
                }

                $(".user_name").html(response.user_name);

                if(response.tabledata.length >= 1){
                    $("#tabledata").html(response.tabledata);
                }else{
                    $("#tabledata").html("<tr><th colspan='9'>No Data Found</th></tr>");
                }

                

            } else if (response.status == "auth_failed" && response.message == "Expired token") {

                location.replace("time_expried.php");

            } else if (response.status == "auth_failed") {

                location.replace("unauth_login.php");

            }
        }
    });

}