var x = 0;

$(document).ready(() => {
  $.ajax({
    type: "POST",
    url: "./requiredFiles/ajax/domestictourbookinghistoryAjax.php",
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
        if (localStorage.getItem("roleId") === "4") {
          $("#sidebar").html(`
                                    <a href="tour destination edit.php" class="nav-item nav-link"><i
                                      class="far fa-map me-2"></i>Tour<p style="text-align: center;">Destinations</p></a>
                              <a href="tour booking history.php" class="nav-item nav-link active"><i class="fa fa-bookmark me-2"></i>Tour
                                  Booking<p style="text-align: center;"> History</p></a>
                                           <a href="logout.php" class="nav-item nav-link"><i class="fa fa-sign-out-alt me-2"></i>Logout</a>
                                   `);
        }
        return getData();
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

// Function to export table data to Excel
function exportToExcel() {
  var table = document.getElementById("myTable");
  var wb = XLSX.utils.table_to_book(table, { sheet: "Tour Booking History" });
  XLSX.writeFile(wb, "Tour_Booking_History.xlsx");
}

const getData = () => {
  const fromDate = $("#fromDate").val();
  const toDate = $("#toDate").val();

  x += 1;

  $.ajax({
    type: "POST",
    url: "./requiredFiles/ajax/domestictourbookinghistoryAjax.php",
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

        if (response.tabledata.length >= 1) {
          $("#tabledata").html(response.tabledata);
          if (x == 1) {
            let table = new DataTable("#myTable", {
              ordering: false,
            });
          }
        } else {
          $("#tabledata").html(
            "<tr><th colspan='13'>No Booking History</th></tr>"
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

const changevisitedstatus = (id) => {
  var id = $(id).attr("id");

  var userConfirmed = window.confirm(
    "Are you sure you want to Change the Status of Tour?"
  );

  // If the user clicked "Yes", userConfirmed will be true
  if (userConfirmed) {
    $.ajax({
      type: "POST",
      url: "./requiredFiles/ajax/domestictourbookinghistoryAjax.php",
      data: {
        way: "changevisitedstatus",
        id: id,
      },
      success: function (res) {
        var response = JSON.parse(res);
        if (response.status == "success") {
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
  }
};
