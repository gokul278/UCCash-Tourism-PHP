$(document).ready(() => {
    $.ajax({
        type: "POST",
        url: "./requiredFiles/ajax/bookinghistoryAjax.php",
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
        url: "./requiredFiles/ajax/bookinghistoryAjax.php",
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

                if (response.tabledata.length >= 1) {
                    $("#tabledata").html(response.tabledata);
                } else {
                    $("#tabledata").html("<tr><th colspan='10'>No Booking History</th></tr>");
                }

            } else if (response.status == "auth_failed" && response.message == "Expired token") {

                location.replace("time_expried.php");

            } else if (response.status == "auth_failed") {

                location.replace("unauth_login.php");

            }
        }
    });

}

const tourinvoice = (id) => {

    const form = document.createElement('form');
    form.method = 'POST';
    form.action = './tourbookinginvoice.php';
    form.target = '_blank';

    // Creating the first hidden input for bookingid
    const inputBookingId = document.createElement('input');
    inputBookingId.type = 'hidden';
    inputBookingId.name = 'bookingid';
    inputBookingId.value = $(id).attr("id"); // Assuming `id` is a jQuery selector or a variable containing the id

    // Creating the second hidden input for userid
    const inputUserId = document.createElement('input');
    inputUserId.type = 'hidden';
    inputUserId.name = 'userid';
    inputUserId.value = $(id).attr("userid"); // Assuming `id` is a jQuery selector or a variable containing the id

    // Appending inputs to the form
    form.appendChild(inputBookingId);
    form.appendChild(inputUserId);

    // Appending form to the body and submitting
    document.body.appendChild(form);
    form.submit();



}