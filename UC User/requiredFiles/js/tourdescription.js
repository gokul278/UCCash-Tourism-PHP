$(document).ready(() => {
    $.ajax({
        type: "POST",
        url: "./requiredFiles/ajax/tourdescriptionAjax.php",
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
    var bookingCode = getQueryParam('bookingid');

    $.ajax({
        type: "POST",
        url: "./requiredFiles/ajax/tourdescriptionAjax.php",
        data: {
            "way": "getData",
            "bookingcode" : bookingCode 
        },
        success: function (res) {
            var response = JSON.parse(res);
            if (response.status == "success") {

                if (response.user_profileimg != null) {
                    $(".user_profileimg").attr("src", "./img/user/" + response.user_profileimg);
                }

                $(".user_name").html(response.user_name);

                $("#daysplandata").html(response.daysplandata);

                $("#displayedImage").attr("src","./img/tourdestination/"+response.tour_image1);
                $("#tour_thumbnail").attr("src","./img/tourdestination/"+response.tour_thumbnail);
                $("#tour_image1").attr("src","./img/tourdestination/"+response.tour_image1)
                $("#tour_image2").attr("src","./img/tourdestination/"+response.tour_image2)
                $("#tour_image3").attr("src","./img/tourdestination/"+response.tour_image3)
                $("#tour_image4").attr("src","./img/tourdestination/"+response.tour_image4)
                $("#tour_image5").attr("src","./img/tourdestination/"+response.tour_image5)
                


                const images = [
                    './img/tourdestination/'+response.tour_image1,
                    './img/tourdestination/'+response.tour_image2,
                    './img/tourdestination/'+response.tour_image3,
                    './img/tourdestination/'+response.tour_image4,
                    './img/tourdestination/'+response.tour_image5,
                    './img/tourdestination/'+response.tour_thumbnail,
                ];

                $("#tour_name").html(response.tour_name+' <span style="color: #f7c128;">Overview</span>')
                $("#tour_bookingcode").html('<b>Booking Code : '+response.tour_bookingcode+'</b>')
                $("#tour_days").html('<b>Days : '+response.tour_days+'</b>')
                $("#tour_fromdate").html('<b>From Date : '+response.tour_fromdate+'</b>')
                $("#tour_todate").html('<b>To Date : '+response.tour_todate+'</b>')
                $("#tour_amount").html('<b>Amount : '+response.tour_amount+' TP per person (Included GST 18%)</b>')
                $("#tour_inclusion").html(response.tour_inclusion);
                $("#tour_exclusion").html(response.tour_exclusion);
                $("#tourname").html('<span style="color: #f7c128; text-align: center;">'+response.tour_name+'</span> Itinerary');
                $("#confirmbtn").html('<a href="confirm page.php?bookingid='+response.tourid+'"><button style="background-color: #f7c128; color: white; padding: 10px 20px; border: none; border-radius: 5px; font-size: 16px; cursor: pointer; animation: pulse 1.5s infinite;">Continue Booking</button> </a>')

                let currentIndex = 0;

                const displayedImage = document.getElementById('displayedImage');
                const prevButton = document.getElementById('prevButton');
                const nextButton = document.getElementById('nextButton');
                const thumbnails = document.querySelectorAll('.thumbnail-image');

                function showImage(index) {
                    displayedImage.src = images[index];
                    currentIndex = index; // Update the currentIndex
                }

                prevButton.addEventListener('click', () => {
                    currentIndex = (currentIndex > 0) ? currentIndex - 1 : images.length - 1;
                    showImage(currentIndex);
                });

                nextButton.addEventListener('click', () => {
                    currentIndex = (currentIndex < images.length - 1) ? currentIndex + 1 : 0;
                    showImage(currentIndex);
                });

                thumbnails.forEach((thumbnail, index) => {
                    thumbnail.addEventListener('click', () => {
                        showImage(index); // Update the main image when thumbnail is clicked
                    });
                });

                // Optional: Auto slide every 8 seconds
                setInterval(() => {
                    currentIndex = (currentIndex < images.length - 1) ? currentIndex + 1 : 0;
                    showImage(currentIndex);
                }, 8000);

            } else if (response.status == "auth_failed" && response.message == "Expired token") {

                location.replace("time_expried.php");

            } else if (response.status == "auth_failed") {

                location.replace("unauth_login.php");

            }
        }
    });

}