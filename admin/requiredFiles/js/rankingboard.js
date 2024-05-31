var x = 0;

$(document).ready(() => {
    $.ajax({
        type: "POST",
        url: "./requiredFiles/ajax/rankingboardAjax.php",
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

    x += 1;

    $.ajax({
        type: "POST",
        url: "./requiredFiles/ajax/rankingboardAjax.php",
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
                    if (x == 1) {
                        let table = new DataTable('#myTable', {
                            ordering: false
                        });
                    }
                } else {
                    $("#tabledata").html("<tr><td colspan='5'>No Data Found</td></tr>")
                }

            } else if (response.status == "auth_failed" && response.message == "Expired token") {

                location.replace("time_expried.php");

            } else if (response.status == "auth_failed") {

                location.replace("unauth_login.php");

            }
        }
    });

}

$("#clearsearchtype").click(function (e) {
    e.preventDefault();

    $("#searchtype").prop("disabled", false);
    $("#clearsearchtype").prop("disabled", true);

    $("#typevalue").val("none");

    return getData();
});



$("#searchtype").click(function (e) {
    e.preventDefault();

    var type = $("#typevalue").val();

    $.ajax({
        type: "POST",
        url: "./requiredFiles/ajax/rankingboardAjax.php",
        data: {
            "way": "typesearch",
            "type": type
        },
        success: function (res) {
            var response = JSON.parse(res);
            if (response.status == "success") {
                $("#clearsearchtype").prop("disabled", false);

                if (response.tabledata.length > 0) {
                    $("#tabledata").html(response.tabledata);
                } else {
                    $("#tabledata").html("<tr><td colspan='5'>No Data Found</td></tr>")
                }

            } else if (response.status == "auth_failed" && response.message == "Expired token") {

                location.replace("time_expried.php");

            } else if (response.status == "auth_failed") {

                location.replace("unauth_login.php");

            }
        }
    });

});

const lvl1reward = (button) => {
    var userid = $(button).attr('userid');

    $.ajax({
        type: "POST",
        url: "./requiredFiles/ajax/rankingboardAjax.php",
        data: {
            "way": "awardlvl1",
            "userid": userid
        },
        success: function (res) {
            var response = JSON.parse(res);
            if (response.status == "success") {

                return getData()

            } else if (response.status == "auth_failed" && response.message == "Expired token") {

                location.replace("time_expried.php");

            } else if (response.status == "auth_failed") {

                location.replace("unauth_login.php");

            }
        }
    });
};


const lvl2reward = (button) => {
    var userid = $(button).attr('userid');

    $.ajax({
        type: "POST",
        url: "./requiredFiles/ajax/rankingboardAjax.php",
        data: {
            "way": "awardlvl2",
            "userid": userid
        },
        success: function (res) {
            var response = JSON.parse(res);
            if (response.status == "success") {

                return getData()

            } else if (response.status == "auth_failed" && response.message == "Expired token") {

                location.replace("time_expried.php");

            } else if (response.status == "auth_failed") {

                location.replace("unauth_login.php");

            }
        }
    });
};

const lvl3reward = (button) => {
    var userid = $(button).attr('userid');

    $.ajax({
        type: "POST",
        url: "./requiredFiles/ajax/rankingboardAjax.php",
        data: {
            "way": "awardlvl3",
            "userid": userid
        },
        success: function (res) {
            var response = JSON.parse(res);
            if (response.status == "success") {

                return getData()

            } else if (response.status == "auth_failed" && response.message == "Expired token") {

                location.replace("time_expried.php");

            } else if (response.status == "auth_failed") {

                location.replace("unauth_login.php");

            }
        }
    });
}

const lvl4reward = (button) => {
    
    var userid = $(button).attr('userid');

    $.ajax({
        type: "POST",
        url: "./requiredFiles/ajax/rankingboardAjax.php",
        data: {
            "way": "awardlvl4",
            "userid": userid
        },
        success: function (res) {
            var response = JSON.parse(res);
            if (response.status == "success") {

                return getData()

            } else if (response.status == "auth_failed" && response.message == "Expired token") {

                location.replace("time_expried.php");

            } else if (response.status == "auth_failed") {

                location.replace("unauth_login.php");

            }
        }
    });

}

const lvl5reward = (button) => {
    
    var userid = $(button).attr('userid');

    $.ajax({
        type: "POST",
        url: "./requiredFiles/ajax/rankingboardAjax.php",
        data: {
            "way": "awardlvl5",
            "userid": userid
        },
        success: function (res) {
            var response = JSON.parse(res);
            if (response.status == "success") {

                return getData()

            } else if (response.status == "auth_failed" && response.message == "Expired token") {

                location.replace("time_expried.php");

            } else if (response.status == "auth_failed") {

                location.replace("unauth_login.php");

            }
        }
    });

}

const lvl6reward = (button) => {
    
    var userid = $(button).attr('userid');

    $.ajax({
        type: "POST",
        url: "./requiredFiles/ajax/rankingboardAjax.php",
        data: {
            "way": "awardlvl6",
            "userid": userid
        },
        success: function (res) {
            var response = JSON.parse(res);
            if (response.status == "success") {

                return getData()

            } else if (response.status == "auth_failed" && response.message == "Expired token") {

                location.replace("time_expried.php");

            } else if (response.status == "auth_failed") {

                location.replace("unauth_login.php");

            }
        }
    });

}

const lvl7reward = (button) => {
    
    var userid = $(button).attr('userid');

    $.ajax({
        type: "POST",
        url: "./requiredFiles/ajax/rankingboardAjax.php",
        data: {
            "way": "awardlvl7",
            "userid": userid
        },
        success: function (res) {
            var response = JSON.parse(res);
            if (response.status == "success") {

                return getData()

            } else if (response.status == "auth_failed" && response.message == "Expired token") {

                location.replace("time_expried.php");

            } else if (response.status == "auth_failed") {

                location.replace("unauth_login.php");

            }
        }
    });

}