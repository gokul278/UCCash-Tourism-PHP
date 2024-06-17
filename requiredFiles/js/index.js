$("#emailsubmit").submit(function (e) {
    e.preventDefault();

    $("#submitbtn").html("Loading ...");

    var frm = $("#emailsubmit")[0];
    var frmdata = new FormData(frm);
    $.ajax({
        type: "POST",
        url: "./requiredFiles/ajax/indexAjax.php",
        data: frmdata,
        processData: false,
        contentType: false,
        cache: false,
        success: function (res) {
            var response = JSON.parse(res);

            if (response.status == "auth_failed" && response.message == "Expired token") {

                location.replace("time_expried.php");

            } else if (response.status == "auth_failed") {

                location.replace("unauth_login.php");

            } else if (response.status == "success") {

                frm.reset();
                $("#submitbtn").html("Send Details to Contact Us");
                $("#exampleModal").modal("hide")
                swal({
                    title: "Good job!",
                    text: "Your Details Were Submitted and We Contact as Soon !",
                    icon: "success",
                    button: "Close",
                });

            }
        }
    });

});