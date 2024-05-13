$(document).ready(() => {
    $.ajax({
        type: "POST",
        url: "./requiredFiles/ajax/nextgenealogyAjax.php",
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

    var param1var = getQueryVariable("nextid");

    $.ajax({
        type: "POST",
        url: "./requiredFiles/ajax/nextgenealogyAjax.php",
        data: {
            "way": "getData",
            "nextid": param1var
        },
        success: function (res) {
            var response = JSON.parse(res);
            if (response.status == "success") {

                if (response.user_profileimg != null) {
                    $(".user_profileimg").attr("src", "./img/user/" + response.user_profileimg);
                }

                if (response.nextprofileimage != "") {
                    $(".nextuserimage").attr("src", "./img/user/" + response.nextprofileimage);
                }

                $(".user_name").html(response.user_name);

                if (response.activation == "true") {
                    $("#nextid").html(response.nextid);
                    $("#nextname").html(response.nextname);

                    $("#treedata").html(response.tree)
                } else if (response.activation == "false") {
                    $(".genealogy-tree").html("<h1 style='color:red;margin-top:50px' align='center'>Id Not Activated</h1>")
                }



            } else if (response.status == "auth_failed" && response.message == "Expired token") {

                location.replace("time_expried.php");

            } else if (response.status == "auth_failed") {

                location.replace("unauth_login.php");

            }
        }
    });

}