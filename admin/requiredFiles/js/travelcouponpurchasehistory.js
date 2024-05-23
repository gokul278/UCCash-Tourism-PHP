$(document).ready(() => {
    $.ajax({
        type: "POST",
        url: "./requiredFiles/ajax/travelcouponpurchasehistoryAjax.php",
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
        url: "./requiredFiles/ajax/travelcouponpurchasehistoryAjax.php",
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

                if(response.tabledata.length > 0){
                    $("#tabledata").html(response.tabledata);
                    let table = new DataTable('#myTable',{
                        ordering:  false
                    });
                }else{
                    $("#tabledata").html("<tr><td colspan='10'>No Data Found</td></tr>");
                }

                $('.view-proof-image').click(function() {
                    // Get the image source from the data-src attribute
                    var proofImageSrc = $(this).data('src');
                    // Set the src attribute of the proof image in the modal
                    $('#proofImage').attr('src', proofImageSrc);
                    // Open the modal
                    $('#proofImageModal').modal('show');
                });

            } else if (response.status == "auth_failed" && response.message == "Expired token") {

                location.replace("time_expried.php");

            } else if (response.status == "auth_failed") {

                location.replace("unauth_login.php");

            }
        }
    });

}