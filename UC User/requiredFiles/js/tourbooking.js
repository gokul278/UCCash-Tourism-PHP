$(document).ready(() => {
    $.ajax({
        type: "POST",
        url: "./requiredFiles/ajax/tourbookingAjax.php",
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
        url: "./requiredFiles/ajax/tourbookingAjax.php",
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

                $("#carddata").html(response.carddata)

                $(".packages-carousel").owlCarousel({
                    autoplay: true,
                    smartSpeed: 1000,
                    center: false,
                    dots: false,
                    loop: true,
                    margin: 25,
                    nav : true,
                    navText : [
                        '<i class="bi bi-arrow-left"></i>',
                        '<i class="bi bi-arrow-right"></i>'
                    ],
                    responsiveClass: true,
                    responsive: {
                        0:{
                            items:1
                        },
                        768:{
                            items:2
                        },
                        992:{
                            items:2
                        },
                        1200:{
                            items:3
                        }
                    }
                });
                

            } else if (response.status == "auth_failed" && response.message == "Expired token") {

                location.replace("time_expried.php");

            } else if (response.status == "auth_failed") {

                location.replace("unauth_login.php");

            }
        }
    });

}