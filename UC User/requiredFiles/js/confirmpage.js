$(document).ready(() => {
    $.ajax({
        type: "POST",
        url: "./requiredFiles/ajax/confirmpageAjax.php",
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

    function getQueryParam(name) {
        var urlParams = new URLSearchParams(window.location.search);
        return urlParams.get(name);
    }

    // Store the booking code
    var bookingid = getQueryParam('bookingid');

    $.ajax({
        type: "POST",
        url: "./requiredFiles/ajax/confirmpageAjax.php",
        data: {
            "way": "getData",
            "bookingid": bookingid
        },
        success: function (res) {
            var response = JSON.parse(res);
            if (response.status == "success") {

                if (response.user_profileimg != null) {
                    $(".user_profileimg").attr("src", "./img/user/" + response.user_profileimg);
                }

                $(".user_name").html(response.user_name);
                $(".savingtravel").html(response.savingtravel);
                $(".bonustravel").html(response.bonustravel);
                $(".travelcoupon").html(response.travelcoupon);
                $("#tour_amount").html(response.tour_amount + " $");


            } else if (response.status == "auth_failed" && response.message == "Expired token") {

                location.replace("time_expried.php");

            } else if (response.status == "auth_failed") {

                location.replace("unauth_login.php");

            }
        }
    });

}

const amountcheck = () => {

    function getQueryParam(name) {
        var urlParams = new URLSearchParams(window.location.search);
        return urlParams.get(name);
    }

    // Store the booking code
    var bookingid = getQueryParam('bookingid');
    var person = parseInt($("#personinput").val());

    $.ajax({
        type: "POST",
        url: "./requiredFiles/ajax/confirmpageAjax.php",
        data: {
            "way": "checkamount",
            "person": person,
            "bookingid": bookingid
        },
        success: function (res) {
            var response = JSON.parse(res);
            if (response.status == "success") {

                $("#tour_amount").html(response.tour_amount + " $");

            } else if (response.status == "auth_failed" && response.message == "Expired token") {

                location.replace("time_expried.php");

            } else if (response.status == "auth_failed") {

                location.replace("unauth_login.php");

            }
        }
    });
}

$('.plus').click(() => {
    var person = parseInt($("#personinput").val());
    person += 1;
    function getQueryParam(name) {
        var urlParams = new URLSearchParams(window.location.search);
        return urlParams.get(name);
    }

    // Store the booking code
    var bookingid = getQueryParam('bookingid');

    $.ajax({
        type: "POST",
        url: "./requiredFiles/ajax/confirmpageAjax.php",
        data: {
            "way": "checkamount",
            "person": person,
            "bookingid": bookingid
        },
        success: function (res) {
            var response = JSON.parse(res);
            if (response.status == "success") {

                $("#tour_amount").html(response.tour_amount + " $");

            } else if (response.status == "auth_failed" && response.message == "Expired token") {

                location.replace("time_expried.php");

            } else if (response.status == "auth_failed") {

                location.replace("unauth_login.php");

            }
        }
    });
    $("#personinput").val(person);
});

$('.minus').click(() => {
    var person = parseInt($("#personinput").val());
    if (person > 1) {
        person -= 1;
    }
    function getQueryParam(name) {
        var urlParams = new URLSearchParams(window.location.search);
        return urlParams.get(name);
    }

    // Store the booking code
    var bookingid = getQueryParam('bookingid');

    $.ajax({
        type: "POST",
        url: "./requiredFiles/ajax/confirmpageAjax.php",
        data: {
            "way": "checkamount",
            "person": person,
            "bookingid": bookingid
        },
        success: function (res) {
            var response = JSON.parse(res);
            if (response.status == "success") {

                $("#tour_amount").html(response.tour_amount + " $");

            } else if (response.status == "auth_failed" && response.message == "Expired token") {

                location.replace("time_expried.php");

            } else if (response.status == "auth_failed") {

                location.replace("unauth_login.php");

            }
        }
    });
    $("#personinput").val(person); // Update input field value
});