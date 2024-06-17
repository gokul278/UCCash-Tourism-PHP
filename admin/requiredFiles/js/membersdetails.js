$(document).ready(() => {
    $.ajax({
        type: "POST",
        url: "./requiredFiles/ajax/membersdetailsAjax.php",
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
        url: "./requiredFiles/ajax/membersdetailsAjax.php",
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

                if (response.tabledata.length > 0) {
                    $("#tabledata").html(response.tabledata);
                    let table = new DataTable('#myTable', {
                        ordering: false,
                        lengthChange: false, // Disable page length control
                        paging: false
                    });
                } else {
                    $("#tabledata").html("<td colspan='14'>No Data Found</td>");
                }


            } else if (response.status == "auth_failed" && response.message == "Expired token") {

                location.replace("time_expried.php");

            } else if (response.status == "auth_failed") {

                location.replace("unauth_login.php");

            }
        }
    });

}


function exportToExcel() {
    var table = document.getElementById("myTable");
    var wb = XLSX.utils.table_to_book(table, { sheet: "Member Details" });
    XLSX.writeFile(wb, "Members_Details.xlsx");
}