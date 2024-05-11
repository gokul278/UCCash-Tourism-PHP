$(document).ready(() => {
    $.ajax({
        type: "POST",
        url: "./requiredFiles/ajax/genealogyAjax.php",
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
        url: "./requiredFiles/ajax/genealogyAjax.php",
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


                if (response.activation == "true") {

                    $("#treedata").html("Loading");

                    $("#user_id").html(response.user_id);

                    $("#headname").attr("title", response.title);

                    var levelsend = $("#level").val();

                    $("#treedata").html("Loading");

                    $.ajax({
                        type: "POST",
                        url: "./requiredFiles/ajax/genealogyAjax.php",
                        data: {
                            "way": "levelcheck",
                            "levelsend": levelsend
                        },
                        success: function (res) {
                            var response = JSON.parse(res);
                            if (response.status == "success") {

                                $("#treedata").html(response.treedata);


                            } else if (response.status == "auth_failed" && response.message == "Expired token") {

                                location.replace("time_expried.php");

                            } else if (response.status == "auth_failed") {

                                location.replace("unauth_login.php");

                            }
                        }
                    });

                } else if (response.activation == "false") {
                    $(".genealogy-tree").html("<div style='display:flex;justify-content:center'><h3 style='width:50%;color:red;margin-top:50px;box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);padding-top:20px;padding-bottom:20px;border-radius:10px' align='center'>Id Not Activated</h3></div>")
                }



            } else if (response.status == "auth_failed" && response.message == "Expired token") {

                location.replace("time_expried.php");

            } else if (response.status == "auth_failed") {

                location.replace("unauth_login.php");

            }
        }
    });

}

const levelchange = () => {
    levelsend();
}

const levelsend = () => {

    var levelsend = $("#level").val();

    $("#treedata").html("Loading");

    $.ajax({
        type: "POST",
        url: "./requiredFiles/ajax/genealogyAjax.php",
        data: {
            "way": "levelcheck",
            "levelsend": levelsend
        },
        success: function (res) {
            var response = JSON.parse(res);
            if (response.status == "success") {

                $("#treedata").html(response.treedata);


            } else if (response.status == "auth_failed" && response.message == "Expired token") {

                location.replace("time_expried.php");

            } else if (response.status == "auth_failed") {

                location.replace("unauth_login.php");

            }
        }
    });

}