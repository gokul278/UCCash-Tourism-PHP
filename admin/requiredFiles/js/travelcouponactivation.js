$(document).ready(() => {
  $.ajax({
    type: "POST",
    url: "./requiredFiles/ajax/travelcouponactivationAjax.php",
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
        if (localStorage.getItem("roleId") === "2") {
          $("#sidebar").html(`
                    <div class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle active" data-bs-toggle="dropdown"><i
                                        class="fa fa-id-card me-2"></i>ID Activation</a>
                                <div class="dropdown-menu bg-transparent border-0">
                                    <a href="crypto deposit.php" class="dropdown-item">Crypto Deposit</a>
                                    <a href="bank deposit.php" class="dropdown-item">Bank Deposit</a>
                                    <a href="travel coupon activation.php" class="dropdown-item active" style="color:#f7c128">ID Activation</a>
                                    <a href="travel coupon approval.php" class="dropdown-item ">ID
                                        Activation Approval</a>
                                    <a href="travel coupon purchase history.php" class="dropdown-item">ID Activation History</a>
                                </div>
                            </div>
                            <a href="logout.php" class="nav-item nav-link"><i class="fa fa-sign-out-alt me-2"></i>Logout</a>
                    `);
        }
        return getData();
      }
    },
  });
});

const getData = () => {
  $.ajax({
    type: "POST",
    url: "./requiredFiles/ajax/travelcouponactivationAjax.php",
    data: {
      way: "getData",
    },
    success: function (res) {
      var response = JSON.parse(res);
      if (response.status == "success") {
        $(".adminname").html(response.admin_name);
        $("#activationvalue").val(response.activationvalue);
        $("#crypto_value").val(response.crypto_value);
        $("#cryptovalue").val(response.crypto_value);

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

const activationenablebtn = () => {
  $("#activationbtn").prop("disabled", false);
};

const updateactivationvalue = () => {
  var activationvalue = $("#activationvalue").val();
  var way = "updateactivationvalue";

  $.ajax({
    type: "POST",
    url: "./requiredFiles/ajax/travelcouponactivationAjax.php",
    data: {
      way: way,
      activationvalue: activationvalue,
    },
    success: function (res) {
      var response = JSON.parse(res);
      if (response.status == "success") {
        new Notify({
          status: "success",
          title: "Value Updated",
          text: "ID Activation Value Updated...!",
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

        $("#activationbtn").prop("disabled", true);

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
};

const getusername = () => {
  var user_id = $("#activationMemberID").val();

  if (user_id.length >= 1) {
    $.ajax({
      type: "POST",
      url: "./requiredFiles/ajax/travelcouponactivationAjax.php",
      data: {
        way: "getusername",
        userid: user_id,
      },
      success: function (res) {
        var response = JSON.parse(res);
        if (response.status == "success") {
          if (response.message == "noid") {
            $("#username").html("<p style='color:red'>Invalid ID</p>");
            $("#activatebtn").prop("disabled", true);
          } else {
            $("#username").html(
              "<p style='color:green'>" + response.message + "</p>"
            );
            $("#activatebtn").prop("disabled", false);
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
  } else {
    $("#username").html("<p>Enter the Valid User</p>");
    $("#activatebtn").prop("disabled", true);
  }
};

const clearerror = () => {
  $("#errormsg").html("");
};

$("#idactivationsubmit").submit(function (e) {
  e.preventDefault();

  $("#activatebtn").html("Loading ...");

  var frm = $("#idactivationsubmit")[0];
  var frmdata = new FormData(frm);

  $.ajax({
    type: "POST",
    url: "./requiredFiles/ajax/travelcouponactivationAjax.php",
    data: frmdata,
    processData: false,
    contentType: false,
    cache: false,
    success: function (res) {
      var response = JSON.parse(res);
      if (response.status == "success") {
        location.replace("travel coupon purchase history.php");
      } else if (
        response.status == "auth_failed" &&
        response.message == "Expired token"
      ) {
        location.replace("time_expried.php");
      } else if (response.status == "auth_failed") {
        location.replace("unauth_login.php");
      } else if (response.status == "error") {
        $("#errormsg").html(response.message);
        $("#activatebtn").html("Activate");
      }
    },
  });
});
