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

const checkpaymenttype = () => {
    const paymenttype = $("#paymenttype").val();

    if (paymenttype === "none") {
        $("#paymentinput").html('<input class="form-control" id="none" type="number" placeholder="Choose the Payment Type" style="height: 50px;" disabled>');
    } else if (paymenttype === "savingstravelpoints") {
        $("#paymentinput").html('<input class="form-control" id="savingstravelpoints" type="number" placeholder="Enter the Savings Travel Point" oninput="checksavingstp()" style="height: 50px;">');
    } else if (paymenttype === "bonustravelpoints") {
        $("#paymentinput").html('<input class="form-control" id="bonustravelpoints" type="number" placeholder="Enter the Bonus Travel Point" oninput="checkbonustp()" style="height: 50px;">');
    } else if (paymenttype === "travelcoupon") {
        $("#paymentinput").html('<input class="form-control" id="travelcoupon" type="number" placeholder="Enter the Travel Coupon\'s" oninput="checktravelcoupon()" style="height: 50px;">');
    } else if (paymenttype === "allpoints") {
        $("#paymentinput").html(`
            <input class="form-control" id="savingstravelpoints" type="number" placeholder="Enter the Savings Travel Point" style="height: 50px;" oninput="sumtotal()"><br>
            <input class="form-control" id="bonustravelpoints" type="number" placeholder="Enter the Bonus Travel Point" style="height: 50px;" oninput="sumtotal()"><br>
            <input class="form-control" id="travelcoupon" type="number" placeholder="Enter the Travel Coupon\'s" style="height: 50px;" oninput="sumtotal()"><br>
            <div id="totalvalue">Total Points: 0</div>
        `);
    }
}

const sumtotal = () => {
    const savingstravelpoints = parseFloat($("#savingstravelpoints").val()) || 0;
    const bonustravelpoints = parseFloat($("#bonustravelpoints").val()) || 0;
    const travelcoupon = parseFloat($("#travelcoupon").val()) || 0;

    const totalvalue = savingstravelpoints + bonustravelpoints + travelcoupon;

    $("#totalvalue").html("Total Points: " + totalvalue.toFixed(2));

    var person = parseInt($("#personinput").val());

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

                const tourAmount = parseFloat(response.tour_amount);

                // Use a small tolerance for comparison
                const tolerance = 0.01;
                if (Math.abs(tourAmount - totalvalue) < tolerance) {
                    $("#otpbtn").prop("disabled", false);
                } else {
                    $("#otpbtn").prop("disabled", true);
                }

            } else if (response.status == "auth_failed" && response.message == "Expired token") {

                location.replace("time_expried.php");

            } else if (response.status == "auth_failed") {

                location.replace("unauth_login.php");

            }
        }
    });
}

const checksavingstp = () => {
    const savingstravelpoints = parseFloat($("#savingstravelpoints").val()) || 0;
    savingstravelpoints.toFixed(2);
    var person = parseInt($("#personinput").val());

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

                const tourAmount = parseFloat(response.tour_amount);

                // Use a small tolerance for comparison
                const tolerance = 0.01;
                if (Math.abs(tourAmount - savingstravelpoints) < tolerance) {
                    $("#otpbtn").prop("disabled", false);
                } else {
                    $("#otpbtn").prop("disabled", true);
                }

            } else if (response.status == "auth_failed" && response.message == "Expired token") {

                location.replace("time_expried.php");

            } else if (response.status == "auth_failed") {

                location.replace("unauth_login.php");

            }
        }
    });
}

const checkbonustp = () => {
    const bonustravelpoints = parseFloat($("#bonustravelpoints").val()) || 0;
    var person = parseInt($("#personinput").val());

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

                const tourAmount = parseFloat(response.tour_amount);

                // Use a small tolerance for comparison
                const tolerance = 0.01;
                if (Math.abs(tourAmount - bonustravelpoints) < tolerance) {
                    $("#otpbtn").prop("disabled", false);
                } else {
                    $("#otpbtn").prop("disabled", true);
                }

            } else if (response.status == "auth_failed" && response.message == "Expired token") {

                location.replace("time_expried.php");

            } else if (response.status == "auth_failed") {

                location.replace("unauth_login.php");

            }
        }
    });
}

const checktravelcoupon = () => {
    const travelcoupon = parseFloat($("#travelcoupon").val()) || 0;
    var person = parseInt($("#personinput").val());

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

                const tourAmount = parseFloat(response.tour_amount);

                // Use a small tolerance for comparison
                const tolerance = 0.01;
                if (Math.abs(tourAmount - travelcoupon) < tolerance) {
                    $("#otpbtn").prop("disabled", false);
                } else {
                    $("#otpbtn").prop("disabled", true);
                }

            } else if (response.status == "auth_failed" && response.message == "Expired token") {

                location.replace("time_expried.php");

            } else if (response.status == "auth_failed") {

                location.replace("unauth_login.php");

            }
        }
    });
}

$("#otpbtn").click(function (e) {
    e.preventDefault();

    const paymenttype = $("#paymenttype").val();

    function getQueryParam(name) {
        var urlParams = new URLSearchParams(window.location.search);
        return urlParams.get(name);
    }

    // Store the booking code
    var bookingid = getQueryParam('bookingid');

    var personinput = $("#personinput").val();

    if (paymenttype === "none") {
        alert("Choose the Payment Type")
    } else if (paymenttype === "savingstravelpoints") {

        const savingstravelpoints = $("#savingstravelpoints").val();
        $("#paymenttype").prop("disabled", true);
        $("#savingstravelpoints").prop("disabled", true);
        $(".plus").prop("disabled", true)
        $(".minus").prop("disabled", true)
        $("#personinput").prop("disabled", true)

        if (savingstravelpoints.length >= 1) {

            $("#otpbtn").html("Loading ..")
            $.ajax({
                type: "POST",
                url: "./requiredFiles/ajax/confirmpageAjax.php",
                data: {
                    "way": "getotp",
                    "type": "savingstravelpoints",
                    "personinput": personinput,
                    "savingstravelpoints": savingstravelpoints,
                    "bookingid": bookingid
                },
                success: function (res) {
                    var response = JSON.parse(res);
                    if (response.status == "success") {

                        new Notify({
                            status: 'success',
                            title: 'OTP',
                            text: 'OTP Sended Successfully...!',
                            effect: 'fade',
                            speed: 300,
                            speed: 300,
                            customClass: '',
                            customIcon: '',
                            showIcon: true,
                            showCloseButton: true,
                            autoclose: true,
                            autotimeout: 3000,
                            notificationsGap: null,
                            notificationsPadding: null,
                            type: 'outline',
                            position: 'right top',
                            customWrapper: '',
                        })

                        $("#otpbtn").html("Resend OTP")
                        $("#confirmButton").prop("disabled", false)


                    } else if (response.status == "auth_failed" && response.message == "Expired token") {

                        location.replace("time_expried.php");

                    } else if (response.status == "auth_failed") {

                        location.replace("unauth_login.php");

                    }
                }
            });

        } else {
            alert("Enter the Savings Travel points");
        }

    } else if (paymenttype === "bonustravelpoints") {

        const bonustravelpoints = $("#bonustravelpoints").val();
        $("#paymenttype").prop("disabled", true);
        $("#bonustravelpoints").prop("disabled", true);
        $(".plus").prop("disabled", true)
        $(".minus").prop("disabled", true)
        $("#personinput").prop("disabled", true)

        if (bonustravelpoints.length >= 1) {
            $("#otpbtn").html("Loading ..")
            $.ajax({
                type: "POST",
                url: "./requiredFiles/ajax/confirmpageAjax.php",
                data: {
                    "way": "getotp",
                    "type": "bonustravelpoints",
                    "personinput": personinput,
                    "bonustravelpoints": bonustravelpoints,
                    "bookingid": bookingid
                },
                success: function (res) {
                    var response = JSON.parse(res);
                    if (response.status == "success") {

                        new Notify({
                            status: 'success',
                            title: 'OTP',
                            text: 'OTP Sended Successfully...!',
                            effect: 'fade',
                            speed: 300,
                            speed: 300,
                            customClass: '',
                            customIcon: '',
                            showIcon: true,
                            showCloseButton: true,
                            autoclose: true,
                            autotimeout: 3000,
                            notificationsGap: null,
                            notificationsPadding: null,
                            type: 'outline',
                            position: 'right top',
                            customWrapper: '',
                        })

                        $("#otpbtn").html("Resend OTP")

                        $("#otpbtn").html("Resend OTP")
                        $("#confirmButton").prop("disabled", false)


                    } else if (response.status == "auth_failed" && response.message == "Expired token") {

                        location.replace("time_expried.php");

                    } else if (response.status == "auth_failed") {

                        location.replace("unauth_login.php");

                    }
                }
            });

        } else {
            alert("Enter the Bonus Travel points");
        }

    } else if (paymenttype === "travelcoupon") {

        const travelcoupon = $("#travelcoupon").val();
        $("#paymenttype").prop("disabled", true);
        $("#travelcoupon").prop("disabled", true);
        $(".plus").prop("disabled", true)
        $(".minus").prop("disabled", true)
        $("#personinput").prop("disabled", true)

        if (travelcoupon.length >= 1) {
            $("#otpbtn").html("Loading ..")
            $.ajax({
                type: "POST",
                url: "./requiredFiles/ajax/confirmpageAjax.php",
                data: {
                    "way": "getotp",
                    "type": "travelcoupon",
                    "personinput": personinput,
                    "travelcoupon": travelcoupon,
                    "bookingid": bookingid
                },
                success: function (res) {
                    var response = JSON.parse(res);
                    if (response.status == "success") {

                        new Notify({
                            status: 'success',
                            title: 'OTP',
                            text: 'OTP Sended Successfully...!',
                            effect: 'fade',
                            speed: 300,
                            speed: 300,
                            customClass: '',
                            customIcon: '',
                            showIcon: true,
                            showCloseButton: true,
                            autoclose: true,
                            autotimeout: 3000,
                            notificationsGap: null,
                            notificationsPadding: null,
                            type: 'outline',
                            position: 'right top',
                            customWrapper: '',
                        })

                        $("#otpbtn").html("Resend OTP")
                        $("#confirmButton").prop("disabled", false)

                    } else if (response.status == "auth_failed" && response.message == "Expired token") {

                        location.replace("time_expried.php");

                    } else if (response.status == "auth_failed") {

                        location.replace("unauth_login.php");

                    }
                }
            });

        } else {
            alert("Enter the Travel Coupon");
        }

    } else if (paymenttype === "allpoints") {

        const savingstravelpoints = $("#savingstravelpoints").val();
        const bonustravelpoints = $("#bonustravelpoints").val();
        const travelcoupon = $("#travelcoupon").val();

        if (savingstravelpoints.length >= 1 || bonustravelpoints.length >= 1 || travelcoupon.length >= 1) {
            $("#paymenttype").prop("disabled", true);
            $("#bonustravelpoints").prop("disabled", true);
            $("#savingstravelpoints").prop("disabled", true);
            $("#travelcoupon").prop("disabled", true);
            $(".plus").prop("disabled", true)
            $(".minus").prop("disabled", true)
            $("#personinput").prop("disabled", true)
            $("#otpbtn").html("Loading ..")
            $.ajax({
                type: "POST",
                url: "./requiredFiles/ajax/confirmpageAjax.php",
                data: {
                    "way": "getotp",
                    "type": "allpoints",
                    "personinput": personinput,
                    "savingstravelpoints": savingstravelpoints,
                    "bonustravelpoints": bonustravelpoints,
                    "travelcoupon": travelcoupon,
                    "bookingid": bookingid
                },
                success: function (res) {
                    var response = JSON.parse(res);
                    if (response.status == "success") {

                        new Notify({
                            status: 'success',
                            title: 'OTP',
                            text: 'OTP Sended Successfully...!',
                            effect: 'fade',
                            speed: 300,
                            speed: 300,
                            customClass: '',
                            customIcon: '',
                            showIcon: true,
                            showCloseButton: true,
                            autoclose: true,
                            autotimeout: 3000,
                            notificationsGap: null,
                            notificationsPadding: null,
                            type: 'outline',
                            position: 'right top',
                            customWrapper: '',
                        })
                        $("#otpbtn").html("Resend OTP")
                        $("#confirmButton").prop("disabled", false)

                    } else if (response.status == "auth_failed" && response.message == "Expired token") {

                        location.replace("time_expried.php");

                    } else if (response.status == "auth_failed") {

                        location.replace("unauth_login.php");

                    }
                }
            });

        } else {
            alert("Enter the TP")
        }

    }

});

const clearerr = () => {
    $("#errormsg").html("");
}


$("#confirmButton").click(function (e) {
    e.preventDefault();

    if (($('#invalidCheck2').is(':checked')) && ($("#otpinput").val().length >= 6)) {
        const paymenttype = $("#paymenttype").val();
        const personinput = $("#personinput").val();
        var otp = $("#otpinput").val();

        function getQueryParam(name) {
            var urlParams = new URLSearchParams(window.location.search);
            return urlParams.get(name);
        }

        // Store the booking code
        var bookingid = getQueryParam('bookingid');

        if (paymenttype === "savingstravelpoints") {

            var savingstravelpoints = $("#savingstravelpoints").val();


            $("#confirmButton").html("Loading ..")
            $("#confirmButton").prop("disabled", true)
            $.ajax({
                type: "POST",
                url: "./requiredFiles/ajax/confirmpageAjax.php",
                data: {
                    "way": "tourbooksavingstravelpoints",
                    "personinput": personinput,
                    "savingstravelpoints": savingstravelpoints,
                    "bookingid": bookingid,
                    "otp": otp
                },
                success: function (res) {
                    var response = JSON.parse(res);
                    if (response.status == "success") {

                        location.replace('booking%20history.php');

                    } else if (response.status == "auth_failed" && response.message == "Expired token") {

                        location.replace("time_expried.php");

                    } else if (response.status == "auth_failed") {

                        location.replace("unauth_login.php");

                    } else if (response.status == "error") {
                        $("#errormsg").html(response.message)
                        $("#confirmButton").html("Confirm Booking")
                        $("#confirmButton").prop("disabled", false)
                        $("#otpbtn").html("Get OTP")
                    }
                }
            });

        } else if (paymenttype === "bonustravelpoints") {
            var bonustravelpoints = $("#bonustravelpoints").val();


            $("#confirmButton").html("Loading ..")
            $("#confirmButton").prop("disabled", true)
            $.ajax({
                type: "POST",
                url: "./requiredFiles/ajax/confirmpageAjax.php",
                data: {
                    "way": "tourbookbonustravelpoints",
                    "personinput": personinput,
                    "bonustravelpoints": bonustravelpoints,
                    "bookingid": bookingid,
                    "otp": otp
                },
                success: function (res) {
                    var response = JSON.parse(res);
                    if (response.status == "success") {

                        location.replace('booking%20history.php');

                    } else if (response.status == "auth_failed" && response.message == "Expired token") {

                        location.replace("time_expried.php");

                    } else if (response.status == "auth_failed") {

                        location.replace("unauth_login.php");

                    } else if (response.status == "error") {
                        $("#errormsg").html(response.message)
                        $("#confirmButton").html("Confirm Booking")
                        $("#confirmButton").prop("disabled", false)
                        $("#otpbtn").html("Get OTP")
                    }
                }
            });
        }else if (paymenttype === "travelcoupon") {
            var travelcoupon = $("#travelcoupon").val();


            $("#confirmButton").html("Loading ..")
            $("#confirmButton").prop("disabled", true)
            $.ajax({
                type: "POST",
                url: "./requiredFiles/ajax/confirmpageAjax.php",
                data: {
                    "way": "tourbooktravelcoupon",
                    "personinput": personinput,
                    "travelcoupon": travelcoupon,
                    "bookingid": bookingid,
                    "otp": otp
                },
                success: function (res) {
                    var response = JSON.parse(res);
                    if (response.status == "success") {

                        location.replace('booking%20history.php');

                    } else if (response.status == "auth_failed" && response.message == "Expired token") {

                        location.replace("time_expried.php");

                    } else if (response.status == "auth_failed") {

                        location.replace("unauth_login.php");

                    } else if (response.status == "error") {
                        $("#errormsg").html(response.message)
                        $("#confirmButton").html("Confirm Booking")
                        $("#confirmButton").prop("disabled", false)
                        $("#otpbtn").html("Get OTP")
                    }
                }
            });
        }else if (paymenttype === "allpoints") {

            var savingstravelpoints = $("#savingstravelpoints").val();
            var bonustravelpoints = $("#bonustravelpoints").val();
            var travelcoupon = $("#travelcoupon").val();


            $("#confirmButton").html("Loading ..")
            $("#confirmButton").prop("disabled", true)
            $.ajax({
                type: "POST",
                url: "./requiredFiles/ajax/confirmpageAjax.php",
                data: {
                    "way": "tourallpoints",
                    "personinput": personinput,
                    "savingstravelpoints": savingstravelpoints,
                    "bonustravelpoints": bonustravelpoints,
                    "travelcoupon": travelcoupon,
                    "bookingid": bookingid,
                    "otp": otp
                },
                success: function (res) {
                    var response = JSON.parse(res);
                    if (response.status == "success") {

                        location.replace('booking%20history.php');

                    } else if (response.status == "auth_failed" && response.message == "Expired token") {

                        location.replace("time_expried.php");

                    } else if (response.status == "auth_failed") {

                        location.replace("unauth_login.php");

                    } else if (response.status == "error") {
                        $("#errormsg").html(response.message)
                        $("#confirmButton").html("Confirm Booking")
                        $("#confirmButton").prop("disabled", false)
                        $("#otpbtn").html("Get OTP") 
                    }
                }
            });
        }
    } else {
        alert("Enter Valid OTP and Accept the Terms and Condition");
    }
});

