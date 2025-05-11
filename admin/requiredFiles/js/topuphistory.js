$(document).ready(() => {
  $.ajax({
    type: "POST",
    url: "./requiredFiles/ajax/topuphistoryAjax.php",
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
                         <a href="withdraw approval.php" class="dropdown-item ">Withdraw
                             Approval</a>
                         <a href="withdraw history.php" class="dropdown-item active" style="color:#f7c128">Withdraw History</a>
                     </div>
                 </div>
                         <a href="logout.php" class="nav-item nav-link"><i class="fa fa-sign-out-alt me-2"></i>Logout</a>
                 `);
        }

        return getData(); // Load initial data
      }
    },
  });
});

// Event listener for the search button
$("#searchButton").on("click", function () {
  getData(); // Call getData when the button is clicked
});

// Clear button functionality
$("#dateclear").on("click", function () {
  $("#fromDate").val(""); // Clear the from date input
  $("#toDate").val(""); // Clear the to date input
  getData(); // Refresh the data without any filters
});

let flag = false;

const getData = () => {
  const fromDate = $("#fromDate").val();
  const toDate = $("#toDate").val();

  $.ajax({
    type: "POST",
    url: "./requiredFiles/ajax/topuphistoryAjax.php",
    data: {
      way: "getData",
      fromDate: fromDate,
      toDate: toDate,
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
          if (!flag) {
            let table = new DataTable("#myTable", {
              ordering: false,
            });
          }
        } else {
          $("#tabledata").html("<tr><td colspan='12'>No Data Found</td></tr>");
        }

        flag = true;
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

function exportToExcel() {
  var table = document.getElementById("myTable");
  var wb = XLSX.utils.table_to_book(table, { sheet: "Withdrawal History" });
  XLSX.writeFile(wb, "Topup_History.xlsx");
}
