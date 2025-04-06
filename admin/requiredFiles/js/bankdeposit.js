$(document).ready(() => {
  $.ajax({
    type: "POST",
    url: "./requiredFiles/ajax/bankdepositAjax.php",
    data: {
      way: "login",
    },
    success: function (res) {
      var response = JSON.parse(res);

      if (
        response.status == "auth_failed" &&
        response.message == "Expired token"
      ) {
        location.replace("time_expried.php");
      } else if (response.status == "auth_failed") {
        location.replace("unauth_login.php");
      } else if (response.status == "success") {
        $("#sidebar").html(`
                    <div class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle active" data-bs-toggle="dropdown"><i
                                        class="fa fa-id-card me-2"></i>ID Activation</a>
                                <div class="dropdown-menu bg-transparent border-0">
                                    <a href="crypto deposit.php" class="dropdown-item">Crypto Deposit</a>
                                    <a href="bank deposit.php" class="dropdown-item active" style="color:#f7c128">Bank Deposit</a>
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
    },
  });
});

const getData = () => {
  $.ajax({
    type: "POST",
    url: "./requiredFiles/ajax/bankdepositAjax.php",
    data: {
      way: "getData",
    },
    success: function (res) {
      var response = JSON.parse(res);
      if (response.status == "success") {
        $(".adminname").html(response.admin_name);
        $("#ac_holdername").val(response.ac_holdername);
        $("#ac_number").val(response.ac_number);
        $("#ifsc_code").val(response.ifsc_code);
        $("#branch").val(response.branch);
        $("#upi_id").val(response.upi_id);
        $("#deposit_value").val(response.deposit_value);

        if (response.profile_image !== null) {
          $(".profile_image").attr(
            "src",
            "./img/user/" + response.profile_image
          );
        }
      } else if (
        response.status == "auth_failed" &&
        response.message == "Expired token"
      ) {
        location.replace("time_expried.php");
      } else if (response.status == "auth_failed") {
        location.replace("unauth_login.php");
      }
    },
  });
};

$("#updatedetails").submit(function (e) {
  e.preventDefault();

  var frm = $("#updatedetails")[0];
  var frmdata = new FormData(frm);

  $.ajax({
    type: "POST",
    url: "./requiredFiles/ajax/bankdepositAjax.php",
    data: frmdata,
    processData: false,
    contentType: false,
    cache: false,
    success: function (res) {
      var response = JSON.parse(res);
      if (response.status == "success") {
        new Notify({
          status: "success",
          title: "Bank Details",
          text: "Bank Details Updated...!",
          effect: "fade",
          speed: 300,
          speed: 300,
          customClass: "",
          customIcon: "",
          showIcon: true,
          showCloseButton: true,
          autoclose: true,
          autotimeout: 3000,
          notificationsGap: null,
          notificationsPadding: null,
          type: "outline",
          position: "right top",
          customWrapper: "",
        });

        return getData();
      } else if (
        response.status == "auth_failed" &&
        response.message == "Expired token"
      ) {
        location.replace("time_expried.php");
      } else if (response.status == "auth_failed") {
        location.replace("unauth_login.php");
      }
    },
  });
});

$("#updateimage").submit(function (e) {
  e.preventDefault();

  var frm = $("#updateimage")[0];
  var frmdata = new FormData(frm);

  $.ajax({
    type: "POST",
    url: "./requiredFiles/ajax/bankdepositAjax.php",
    data: frmdata,
    processData: false,
    contentType: false,
    cache: false,
    success: function (res) {
      var response = JSON.parse(res);
      if (response.status == "success") {
        new Notify({
          status: "success",
          title: "QR Code",
          text: "QR Code Updated...!",
          effect: "fade",
          speed: 300,
          speed: 300,
          customClass: "",
          customIcon: "",
          showIcon: true,
          showCloseButton: true,
          autoclose: true,
          autotimeout: 3000,
          notificationsGap: null,
          notificationsPadding: null,
          type: "outline",
          position: "right top",
          customWrapper: "",
        });

        $("#formFileMultiple").val();
        var fileNameSpan = document.getElementById("fileName");
        fileNameSpan.textContent = "";
      } else if (
        response.status == "auth_failed" &&
        response.message == "Expired token"
      ) {
        location.replace("time_expried.php");
      } else if (response.status == "auth_failed") {
        location.replace("unauth_login.php");
      }
    },
  });
});
