$(document).ready(() => {
  $.ajax({
    type: "POST",
    url: "./requiredFiles/ajax/topupapprovalAjax.php",
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
        if (localStorage.getItem("roleId") === "3") {
          $("#sidebar").html(`
              <div class="nav-item dropdown">
                   <a href="#" class="nav-link dropdown-toggle active" data-bs-toggle="dropdown"><i
                           class="fa fa-wallet me-2"></i>Withdraw</a>
                   <div class="dropdown-menu bg-transparent border-0">
                       <a href="withdraw approval.php" style="color:#f7c128" class="dropdown-item active">Withdraw
                           Approval</a>
                       <a href="withdraw history.php" class="dropdown-item">Withdraw History</a>
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
    url: "./requiredFiles/ajax/topupapprovalAjax.php",
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
          $("#tabledata").html("<tr><td colspan='12'>No Data Found</td></tr>");
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

const rejectwithdraw = (index) => {
  var withdrawid = $("#id" + index).val();
  var rejectreason = $("#reason" + index).val();

  $("#rejectbtn" + index).html("Loading ...");

  if (rejectreason.length >= 1) {
    $.ajax({
      type: "POST",
      url: "./requiredFiles/ajax/topupapprovalAjax.php",
      data: {
        way: "rejectwithdraw",
        withdrawid: withdrawid,
        rejectreason: rejectreason,
      },
      success: function (res) {
        var response = JSON.parse(res);
        if (response.status == "success") {
          location.replace("topuphistory.php");
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
    alert("Enter Reason");
    $("#rejectbtn" + index).html("Reject");
  }
};

const approvewithdraw = (index) => {
  $("#approvebtn" + index).html("Loading ...");
  $.ajax({
    type: "POST",
    url: "./requiredFiles/ajax/topupapprovalAjax.php",
    data: {
      way: "approvewithdraw",
      approvalId: index,
    },
    success: function (res) {
      var response = JSON.parse(res);
      if (response.status == "success") {
        location.replace("topuphistory.php");
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
