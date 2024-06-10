var x = 0;

$(document).ready(() => {
    $.ajax({
        type: "POST",
        url: "./requiredFiles/ajax/tourbookinghistoryAjax.php",
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
        url: "./requiredFiles/ajax/tourbookinghistoryAjax.php",
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

                if(response.tabledata.length >=1){
                    $("#tabledata").html(response.tabledata);
                    if (x == 1) {
                        let table = new DataTable('#myTable', {
                            ordering: false
                        });
                    }
                }else{
                    $("#tabledata").html("<tr><th colspan='13'>No Booking History</th></tr>");
                }

            } else if (response.status == "auth_failed" && response.message == "Expired token") {

                location.replace("time_expried.php");

            } else if (response.status == "auth_failed") {

                location.replace("unauth_login.php");

            }
        }
    });

}


const changevisitedstatus = (id) =>{
    var id = $(id).attr("id");

    var userConfirmed = window.confirm("Are you sure you want to Change the Status of Tour?");

    // If the user clicked "Yes", userConfirmed will be true
    if (userConfirmed) {

        $.ajax({
            type: "POST",
            url: "./requiredFiles/ajax/tourbookinghistoryAjax.php",
            data: {
                "way": "changevisitedstatus",
                "id": id
            },
            success: function (res) {
                var response = JSON.parse(res);
                if (response.status == "success") {
    
                    return getData();
    
                } else if (response.status == "auth_failed" && response.message == "Expired token") {
    
                    location.replace("time_expried.php");
    
                } else if (response.status == "auth_failed") {
    
                    location.replace("unauth_login.php");
    
                }
            }
        });

    }
}