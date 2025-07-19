$(document).ready(() => {
  $.ajax({
    type: "POST",
    url: "./requiredFiles/ajax/travelcouponapprovalAjax.php",
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
                                <a href="travel coupon activation.php" class="dropdown-item">ID Activation</a>
                                <a href="travel coupon approval.php" class="dropdown-item active" style="color:#f7c128">ID
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
    url: "./requiredFiles/ajax/travelcouponapprovalAjax.php",
    data: {
      way: "getData",
    },
    success: function (res) {
      var response = JSON.parse(res);
      if (response.status == "success") {
        $(".adminname").html(response.admin_name);

        if (response.profile_image !== null) {
          $(".profile_image").attr(
            "src",
            "./img/user/" + response.profile_image
          );
        }

        if (response.tabledata.length > 0) {
          $("#tabledata").html(response.tabledata);
          let table = new DataTable("#myTable", {
            ordering: false,
          });
        } else {
          $("#tabledata").html("<tr><td colspan='10'>No Data Found</td></tr>");
        }

        $(".view-proof-image").click(function () {
          // Get the image source from the data-src attribute
          var proofImageSrc = $(this).data("src");
          // Set the src attribute of the proof image in the modal
          $("#proofImage").attr("src", proofImageSrc);
          // Open the modal
          $("#proofImageModal").modal("show");
        });
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

const rejectinvoice = (id) => {
  var reason = $("#reason" + id).val();
  var userid = $("#userid" + id).val();
  var activationid = $("#activationid" + id).val();

  $.ajax({
    type: "POST",
    url: "./requiredFiles/ajax/travelcouponapprovalAjax.php",
    data: {
      way: "rejectactivation",
      reason: reason,
      userid: userid,
      activationid: activationid,
    },
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
      }
    },
  });
};

const approveactivation = (id) => {
  var userid = $("#userid" + id).val();
  var activationid = $("#activationid" + id).val();

  $("#approvebtn" + id).html("Loading...");
  $("#approvebtn" + id).prop("disabled", true);

  $.ajax({
    type: "POST",
    url: "./requiredFiles/ajax/travelcouponapprovalAjax.php",
    data: {
      way: "approveactivation",
      userid: userid,
      activationid: activationid,
    },
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
      }
    },
  });
};
