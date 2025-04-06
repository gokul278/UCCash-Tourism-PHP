$(document).ready(() => {
    $.ajax({
        type: "POST",
        url: "./requiredFiles/ajax/cryptodepositAjax.php",
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

                $("#sidebar").html(`
                    <div class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle active" data-bs-toggle="dropdown"><i
                                        class="fa fa-id-card me-2"></i>ID Activation</a>
                                <div class="dropdown-menu bg-transparent border-0">
                                    <a href="crypto deposit.php" class="dropdown-item active" style="color:#f7c128">Crypto Deposit</a>
                                    <a href="bank deposit.php" class="dropdown-item">Bank Deposit</a>
                                    <a href="travel coupon activation.php" class="dropdown-item">ID Activation</a>
                                    <a href="travel coupon approval.php" class="dropdown-item ">ID
                                        Activation Approval</a>
                                    <a href="travel coupon purchase history.php" class="dropdown-item">ID Activation History</a>
                                </div>
                            </div>
                            <a href="logout.php" class="nav-item nav-link"><i class="fa fa-sign-out-alt me-2"></i>Logout</a>
                    `);
                return getData();
            }
        }
    });

});

const getData = () => {

    $.ajax({
        type: "POST",
        url: "./requiredFiles/ajax/cryptodepositAjax.php",
        data: {
            "way": "getData"
        },
        success: function (res) {
            var response = JSON.parse(res);
            if (response.status == "success") {

                $(".adminname").html(response.admin_name);
                $("#crypto_address").val(response.crypto_address);
                $("#crypto_value").val(response.crypto_value);

                if (response.profile_image !== null) {
                    $(".profile_image").attr("src", "./img/user/" + response.profile_image);
                }

            } else if (response.status == "auth_failed" && response.message == "Expired token") {

                location.replace("time_expried.php");

            } else if (response.status == "auth_failed") {

                location.replace("unauth_login.php");

            }
        }
    });

}

$("#updateaddress").submit(function (e) { 
    e.preventDefault();
    
    var frm = $("#updateaddress")[0];
    var frmdata = new FormData(frm);
    
    $.ajax({
        type: "POST",
        url: "./requiredFiles/ajax/cryptodepositAjax.php",
        data: frmdata,
        processData: false,
        contentType: false,
        cache: false,
        success: function (res) {
            var response = JSON.parse(res);
            if (response.status == "success") {

                new Notify({
                    status: 'success',
                    title: 'Crypto Deposit',
                    text: 'Crypto Deposit Updated...!',
                    effect: 'fade',
                    speed: 300,
                    speed: 300,
                    customClass: '',
                    customIcon: '',
                    showIcon: true,
                    showCloseButton: true,
                    autoclose: true,
                    autotimeout: 3000,
                    notificationsGap: null,
                    notificationsPadding: null,
                    type: 'outline',
                    position: 'right top',
                    customWrapper: '',
                })

                return getData();

            } else if (response.status == "auth_failed" && response.message == "Expired token") {

                location.replace("time_expried.php");

            } else if (response.status == "auth_failed") {

                location.replace("unauth_login.php");

            }
        }
    });

});

$("#updateimage").submit(function (e) { 
    e.preventDefault();
    
    var frm = $("#updateimage")[0];
    var frmdata = new FormData(frm);
    
    $.ajax({
        type: "POST",
        url: "./requiredFiles/ajax/cryptodepositAjax.php",
        data: frmdata,
        processData: false,
        contentType: false,
        cache: false,
        success: function (res) {
            var response = JSON.parse(res);
            if (response.status == "success") {

                new Notify({
                    status: 'success',
                    title: 'QR Code',
                    text: 'QR Code Updated...!',
                    effect: 'fade',
                    speed: 300,
                    speed: 300,
                    customClass: '',
                    customIcon: '',
                    showIcon: true,
                    showCloseButton: true,
                    autoclose: true,
                    autotimeout: 3000,
                    notificationsGap: null,
                    notificationsPadding: null,
                    type: 'outline',
                    position: 'right top',
                    customWrapper: '',
                })

                $("#formFileMultiple").val();
                var fileNameSpan = document.getElementById('fileName');
                fileNameSpan.textContent = "";

            } else if (response.status == "auth_failed" && response.message == "Expired token") {

                location.replace("time_expried.php");

            } else if (response.status == "auth_failed") {

                location.replace("unauth_login.php");

            }
        }
    });

});