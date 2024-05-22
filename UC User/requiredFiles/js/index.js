$(document).ready(() => {

    
    $.ajax({
        type: "POST",
        url: "./requiredFiles/ajax/indexAjax.php",
        data: {
            "way": "getflashbanner"
        },
        success: function (res) {
            var response = JSON.parse(res);
            if (response.status == "success") {

                if(response.flashbanner != null){
                    
                    $("#flashbanner").attr("src", ".././img/flashbanner/" + response.flashbanner + "");
                    var myModal = new bootstrap.Modal(document.getElementById('exampleModal'));
                    myModal.show();

                }
            }
        }
    });
    

    $.ajax({
        type: "POST",
        url: "./requiredFiles/ajax/indexAjax.php",
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
        url: "./requiredFiles/ajax/indexAjax.php",
        data: {
            "way": "getData"
        },
        success: function (res) {
            var response = JSON.parse(res);
            if (response.status == "success") {



                if (response.user_profileimg !== null) {
                    $(".user_profileimg").attr("src", "./img/user/" + response.user_profileimg);
                }

                if (response.user_referalStatus == "activated") {

                    $("#user_referalStatus").html('<b style="color:#66e0ac">&#10687; Active</b>')

                } else if (response.user_referalStatus == "notactivated") {

                    $("#user_referalStatus").html('<b style="color:red">&#10687; In Active</b>')
                }

                $(".user_name").html(response.user_name);
                $("#user_id").html(response.user_id);
                $("#user_sponserid").html(response.user_sponserid);

                var parts = response.created_at.split(" ");
                var datePart = parts[0].split("-");
                var reorderedDate = datePart[2] + "/" + datePart[1] + "/" + datePart[0];
                $("#created_at").html(reorderedDate);

                $("#savingtravel").html(response.savingtravel);
                $("#bonustravel").html(response.bonustravel);
                $("#travelcoupon").html(response.travelcoupon);
                $("#networkingincome").html(response.networkingincome);
                $("#leadershipincome").html(response.leadershipincome);
                $("#carandhousefund").html(response.carandhousefund);
                $("#royaltyincome").html(response.royaltyincome);
                $("#savingsincome").html(response.savingsincome);
                $("#reactivationwallet").html(response.reactivationwallet);
                $("#availablewithdrwabalance").html(response.availablewithdrwabalance);


                if(response.rank.length >= 1){
                    $("#rank").html(response.rank);                    
                }else{
                    $("#rank").html("Member"); 
                }


                $("#news").html(response.news);

            } else if (response.status == "auth_failed" && response.message == "Expired token") {

                location.replace("time_expried.php");

            } else if (response.status == "auth_failed") {

                location.replace("unauth_login.php");

            }
        }
    });

}