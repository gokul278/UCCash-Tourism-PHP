$(document).ready(() => {
    $.ajax({
        type: "POST",
        url: "./requiredFiles/ajax/dashboardAjax.php",
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
        url: "./requiredFiles/ajax/dashboardAjax.php",
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

                $("#totalmembers").html(response.totalmembers);
                $("#totaldistributor").html(response.totaldistributor);
                $("#totalmonthly").html(response.totalmonthly);

                $("#totalsavingtravel").html(response.totalsavingtravel);
                $("#usedsavingtravel").html(response.usedsavingtravel);
                $("#balancesavingtravel").html(response.balancesavingtravel);

                $("#totaltravelcoupon").html(response.totaltravelcoupon);
                $("#usedtravelcoupon").html(response.usedtravelcoupon);
                $("#balancetravelcoupon").html(response.balancetravelcoupon);

                $("#totalbonustravel").html(response.totalbonustravel);
                $("#usedbonustravel").html(response.usedbonustravel);
                $("#balancebonustravel").html(response.balancebonustravel);

                $("#totalnetworkingincome").html(response.totalnetworkingincome);
                $("#usednetworkingincome").html(response.usednetworkingincome);
                $("#balancenetworkingincome").html(response.balancenetworkingincome);

                $("#totalleadershipincome").html(response.totalleadershipincome);
                $("#usedleadershipincome").html(response.usedleadershipincome);
                $("#balanceleadershipincome").html(response.balanceleadershipincome);

                $("#totalcarandhousefund").html(response.totalcarandhousefund);
                $("#usedcarandhousefund").html(response.usedcarandhousefund);
                $("#balancecarandhousefund").html(response.balancecarandhousefund);

                $("#totalroyaltyincome").html(response.totalroyaltyincome);
                $("#usedroyaltyincome").html(response.usedroyaltyincome);
                $("#balanceroyaltyincome").html(response.balanceroyaltyincome);

                $("#totalsavingsincome").html(response.totalsavingsincome);
                $("#usedsavingsincome").html(response.usedsavingsincome);
                $("#balancesavingsincome").html(response.balancesavingsincome);

                $("#totalavailablewithdrwabalance").html(response.totalavailablewithdrwabalance+"$");
                $("#usedavailablewithdrwabalance").html(response.usedavailablewithdrwabalance+"$");
                $("#balanceavailablewithdrwabalance").html(response.balanceavailablewithdrwabalance+"$");

                $("#totalreactivationwallet").html(response.totalreactivationwallet+"$");
                $("#usedreactivationwallet").html(response.usedreactivationwallet+"$");
                $("#balancereactivationwallet").html(response.balancereactivationwallet+"$"); 

                $("#totaluccwallet").html(response.totaluccwallet);
                $("#useduccwallet").html(response.useduccwallet);
                $("#balanceuccwallet").html(response.balanceuccwallet);

                $("#totaladminnwallet").html(response.totaladminnwallet+"$");
                $("#usedadminnwallet").html(response.usedadminnwallet+"$");
                $("#balanceadminnwallet").html(response.balanceadminnwallet+"$");

            } else if (response.status == "auth_failed" && response.message == "Expired token") {

                location.replace("time_expried.php");

            } else if (response.status == "auth_failed") {

                location.replace("unauth_login.php");

            }
        }
    });

}