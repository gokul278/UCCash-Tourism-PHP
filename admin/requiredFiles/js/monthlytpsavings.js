$(document).ready(() => {
    $.ajax({
        type: "POST",
        url: "./requiredFiles/ajax/monthlytpsavingsAjax.php",
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
        url: "./requiredFiles/ajax/monthlytpsavingsAjax.php",
        data: {
            "way": "getData"
        },
        success: function (res) {
            var response = JSON.parse(res);
            if (response.status == "success") {


                $(".adminname").html(response.admin_name);
                if(response.tabledata.length>0){
                    $("#tabledata").html(response.tabledata);
                    let table = new DataTable('#myTable',{
                        ordering:  false
                    });
                }else{
                    $("#tabledata").html("<tr><td colspan='11'>No Invoice Approval</td></tr>")
                }



            } else if (response.status == "auth_failed" && response.message == "Expired token") {

                location.replace("time_expried.php");

            } else if (response.status == "auth_failed") {

                location.replace("unauth_login.php");

            }
        }
    });

}

const approveinvoice = (button) => {

    const id = $(button).val();
    const userid = $(button).attr('user_id');
    const way = $(button).attr('way');
    const invoiceid = $(button).attr('invoiceid');


    $.ajax({
        type: "POST",
        url: "./requiredFiles/ajax/monthlytpsavingsAjax.php",
        data: {
            "way": way,
            "invoiceid" : invoiceid,
            "userid" : userid,
            "id" : id
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

};

const rejectinvoice = (key) =>{

    var userid = $("#userid"+key).val();
    var invoiceid = $("#invoiceid"+key).val();
    var way = $("#way"+key).val();
    var reason = $("#reason"+key).val();
    var id = $("#id"+key).val();

    $.ajax({
        type: "POST",
        url: "./requiredFiles/ajax/monthlytpsavingsAjax.php",
        data: {
            "way": way,
            "invoiceid" : invoiceid,
            "userid" : userid,
            "reason" : reason,
            "id" : id
        },
        success: function (res) {
            var response = JSON.parse(res);
            if (response.status == "success") {


                $('#exampleModal' + key).modal('hide');
                return getData();

            } else if (response.status == "auth_failed" && response.message == "Expired token") {

                location.replace("time_expried.php");

            } else if (response.status == "auth_failed") {

                location.replace("unauth_login.php");

            }
        }
    });

}
