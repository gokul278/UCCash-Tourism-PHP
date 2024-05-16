$(document).ready(() => {

    $.ajax({
        type: "POST",
        url: "./requiredFiles/ajax/transferAjax.php",
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
        url: "./requiredFiles/ajax/transferAjax.php",
        data: {
            "way": "getData"
        },
        success: function (res) {
            var response = JSON.parse(res);
            if (response.status == "success") {



                if (response.user_profileimg !== null) {
                    $(".user_profileimg").attr("src", "./img/user/" + response.user_profileimg);
                }

                $(".user_name").html(response.user_name);

                $(".networkingincome").html(response.networkingincome);
                $(".leadershipincome").html(response.leadershipincome);
                $(".carandhousefund").html(response.carandhousefund);
                $(".royaltyincome").html(response.royaltyincome);
                $(".savingsincome").html(response.savingsincome);

            } else if (response.status == "auth_failed" && response.message == "Expired token") {

                location.replace("time_expried.php");

            } else if (response.status == "auth_failed") {

                location.replace("unauth_login.php");

            }
        }
    });

}

const balancecheck = () => {
    const way = $("#floatingSelect").val();

    if (way !== "Select Wallet") {

        $.ajax({
            type: "POST",
            url: "./requiredFiles/ajax/transferAjax.php",
            data: {
                "way": way
            },
            success: function (res) {
                var response = JSON.parse(res);
                if (response.status == "success") {

                    $("#balanacevalue").html(response.balanacevalue + "$");

                    if(response.balanacevalue != "0.00"){
                        $("#transferbtn").prop("disabled",false)
                    }

                } else if (response.status == "auth_failed" && response.message == "Expired token") {

                    location.replace("time_expried.php");

                } else if (response.status == "auth_failed") {

                    location.replace("unauth_login.php");

                }
            }
        });

    }else{

        $("#transferbtn").prop("disabled",true)
        $("#balanacevalue").html("None");

    }
}

const clearerr = () =>{
    $("#errormsg").html('');
}

$("#transferbtn").click(function (e) { 
    e.preventDefault();

    const type = $("#floatingSelect").val();
    const transfervalue = $("#dollarvalue").val();

    if(type == "Select Wallet"){
        $("#errormsg").html('<h5 class="mb-2" style="color:red">Select Wallet Type</h5>');
    }else{

        if(transfervalue.length >= 1){

            $.ajax({
                type: "POST",
                url: "./requiredFiles/ajax/transferAjax.php",
                data: {
                    "way": "transfer",
                    "wallettype" : type,
                    "transfervalue" : transfervalue
                },
                success: function (res) {
                    var response = JSON.parse(res);
                    if (response.status == "success") {
    
                        location.replace("transfer history.php")
    
                    } else if (response.status == "auth_failed" && response.message == "Expired token") {
    
                        location.replace("time_expried.php");
    
                    } else if (response.status == "auth_failed") {
    
                        location.replace("unauth_login.php");
    
                    } else if(response.status == "error"){
                        $("#errormsg").html('<h5 class="mb-2" style="color:red">'+response.message+'</h5>');
                    }
                }
            });

        }else{
            $("#errormsg").html('<h5 class="mb-2" style="color:red">Enter the Transfer Dollar Value</h5>');
        }
        
    }


});