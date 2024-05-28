$(document).ready(() => {

    $.ajax({
        type: "POST",
        url: "./requiredFiles/ajax/wallettransferAjax.php",
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
        url: "./requiredFiles/ajax/wallettransferAjax.php",
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

                $(".savingsincome").html(response.savingsincome);

            } else if (response.status == "auth_failed" && response.message == "Expired token") {

                location.replace("time_expried.php");

            } else if (response.status == "auth_failed") {

                location.replace("unauth_login.php");

            }
        }
    });

}

const balancecheck = () => {
    const way = $("#floatingSelect").val();

    if (way !== "Select Wallet") {

        $.ajax({
            type: "POST",
            url: "./requiredFiles/ajax/wallettransferAjax.php",
            data: {
                "way": way
            },
            success: function (res) {
                var response = JSON.parse(res);
                if (response.status == "success") {

                    $("#balanacevalue").html(response.balanacevalue + "$");


                } else if (response.status == "auth_failed" && response.message == "Expired token") {

                    location.replace("time_expried.php");

                } else if (response.status == "auth_failed") {

                    location.replace("unauth_login.php");

                }
            }
        });

    } 
}

const checkuserid = () => {
    var userid = $("#userid").val();

    if (userid.length >= 1) {

        var way = "checksponser";

        $.ajax({
            type: "POST",
            url: "./requiredFiles/ajax/wallettransferAjax.php",
            data: {
                "way": way,
                "userid": userid
            },
            success: function (res) {
                var response = JSON.parse(res);
                if (response.status == "success") {

                    if (response.stage == "ok") {

                        $("#useridmsg").html("<p style='color:green'>" + response.message + "</p>")

                        $("#transferbtn").prop("disabled", false)

                    } else if (response.stage == "not") {

                        $("#useridmsg").html("<p style='color:red'>Invalid User ID</p>")
                        $("#transferbtn").prop("disabled", true)

                    }

                } else if (response.status == "auth_failed" && response.message == "Expired token") {

                    location.replace("time_expried.php");

                } else if (response.status == "auth_failed") {

                    location.replace("unauth_login.php");

                }
            }
        });

    } else {

        $("#useridmsg").html("<p>Enter the User Id</p>")

    }
}

const clearerr = () =>{
    $("#errormsg").html("");
}

$("#transferpoint").submit(function (e) { 
    e.preventDefault();
    

    var frm = $("#transferpoint")[0];
    var frmdata = new FormData(frm);
    $.ajax({
        type: "POST",
        url: "./requiredFiles/ajax/wallettransferAjax.php",
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

                location.replace("savings income.php")

            } else if (response.status == "error") {

                $("#errormsg").html(response.message);

            } 
        }
    });

});
