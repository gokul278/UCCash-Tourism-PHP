$(document).ready(() => {
  $.ajax({
    type: "POST",
    url: "./requiredFiles/ajax/travelcouponpurchasehistoryAjax.php",
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
                      <a class="nav-link dropdown-toggle active" data-bs-toggle="dropdown"><i
                              class="fa fa-id-card me-2"></i>ID Activation</a>
                      <div class="dropdown-menu bg-transparent border-0">
                          <a href="crypto deposit.php" class="dropdown-item">Crypto Deposit</a>
                          <a href="bank deposit.php" class="dropdown-item">Bank Deposit</a>
                          <a href="travel coupon activation.php" class="dropdown-item">ID Activation</a>
                          <a href="travel coupon approval.php" class="dropdown-item" >ID
                              Activation Approval</a>
                          <a href="travel coupon purchase history.php" class="dropdown-item active" style="color:#f7c128">ID Activation History</a>
                      </div>
                  </div>
                  <a href="logout.php" class="nav-item nav-link"><i class="fa fa-sign-out-alt me-2"></i>Logout</a>
          `);
        }
        return getData();
      }
    },
  });

  let value = false;

  const getData = () => {
    const fromDate = $("#fromDate").val();
    const toDate = $("#toDate").val();

    $.ajax({
      type: "POST",
      url: "./requiredFiles/ajax/travelcouponpurchasehistoryAjax.php",
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
            if (!value) {
              let table = new DataTable("#myTable", {
                ordering: false,
              });
            }
          } else {
            $("#tabledata").html(
              "<tr><td colspan='10'>No Data Found</td></tr>"
            );
          }
          value = true;
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

  // Event listener for the search button
  $("#searchButton").on("click", function () {
    getData(); // Call getData when the button is clicked
  });

  $("#dateclear").on("click", function () {
    $("#fromDate").val(""); // Clear the from date input
    $("#toDate").val(""); // Clear the to date input
    getData(); // Refresh the data without any filters
  });

  // Use event delegation for dynamically generated elements
  $(document).on("click", ".view-proof-image", function () {
    var proofImageSrc = $(this).data("src");
    console.log(proofImageSrc)
    $("#proofImage").attr("src", proofImageSrc);
    $("#proofImageModal").modal("show");
  });
});

function exportToExcel() {
  var table = document.getElementById("myTable");
  var wb = XLSX.utils.table_to_book(table, { sheet: "ID Activation History" });
  XLSX.writeFile(wb, "ID_Activation_History.xlsx");
}
