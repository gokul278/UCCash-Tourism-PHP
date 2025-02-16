$(document).ready(() => {
  $.ajax({
    type: "POST",
    url: "./requiredFiles/ajax/membersdetailsAjax.php",
    data: { way: "login" },
    success: function (res) {
      var response = JSON.parse(res);
      if (response.status == "auth_failed" && response.message == "Expired token") {
        location.replace("time_expried.php");
      } else if (response.status == "auth_failed") {
        location.replace("unauth_login.php");
      } else if (response.status == "success") {
        return getData();
      }
    },
  });
});

let firstLoad = 0;
let isFiltered = false; // ✅ Track whether a filter is applied

const getData = () => {
  $.ajax({
    type: "POST",
    url: "./requiredFiles/ajax/membersdetailsAjax.php",
    data: { way: "getData" },
    success: function (res) {
      var response = JSON.parse(res);
      if (response.status == "success") {
        $(".adminname").html(response.admin_name);

        if (response.profile_image !== null) {
          $(".profile_image").attr("src", "./img/user/" + response.profile_image);
        }

        if (response.tabledata.length > 0) {
          $("#tabledata").html(response.tabledata);

          if (!isFiltered) { // ✅ Only initialize DataTable when no filter is applied
            // if (firstLoad === 0) {
              $("#myTable").DataTable({
                ordering: false,
                pageLength: 10,
              });
              firstLoad = 1;
            // }
          }
        } else {
          $("#tabledata").html("<td colspan='14'>No Data Found</td>");
        }
      } else if (response.status == "auth_failed" && response.message == "Expired token") {
        location.replace("time_expried.php");
      } else if (response.status == "auth_failed") {
        location.replace("unauth_login.php");
      }
    },
  });
};

// ✅ Clear Filter Functions
const clearFilterDate = () => {
  $("#fromDate").val("");
  $("#toDate").val("");
  isFiltered = false; // ✅ Reset filter flag
  getData();
};

const clearFilterStatus = () => {
  $("#typevalue").val("");
  isFiltered = false; // ✅ Reset filter flag
  getData();
};

// ✅ From-To Date Filter
$("#invoiceDateFilter").submit((e) => {
  e.preventDefault();

  const fromDate = $("#fromDate").val();
  const toDate = $("#toDate").val();
  $("#typevalue").val("");

  isFiltered = true; // ✅ Set filter flag

  $.ajax({
    type: "POST",
    url: "./requiredFiles/ajax/membersdetailsAjax.php",
    data: { way: "dateFilter", fromDate: fromDate, toDate: toDate },
    success: function (res) {
      var response = JSON.parse(res);
      if (response.status == "success") {
        if ($.fn.DataTable.isDataTable("#myTable")) {
          $("#myTable").DataTable().destroy(); // 🚀 Destroy DataTable when filtering
        }
        $("#myTable tbody").empty(); // 🔥 Clear table before updating
        $("#tabledata").html(response.tabledata);
      } else {
        $("#tabledata").html("<td colspan='14'>No Data Found</td>");
      }
    },
  });
});

// ✅ Status Filter
$("#statusSubmit").submit((e) => {
  e.preventDefault();

  const typevalue = $("#typevalue").val();
  $("#fromDate").val("");
  $("#toDate").val("");

  isFiltered = true; // ✅ Set filter flag

  $.ajax({
    type: "POST",
    url: "./requiredFiles/ajax/membersdetailsAjax.php",
    data: { way: "typeFilter", typevalue: typevalue },
    success: function (res) {
      var response = JSON.parse(res);
      if (response.status == "success") {
        if ($.fn.DataTable.isDataTable("#myTable")) {
          $("#myTable").DataTable().destroy(); // 🚀 Destroy DataTable when filtering
        }
        $("#myTable tbody").empty(); // 🔥 Clear table before updating
        $("#tabledata").html(response.tabledata);
      } else {
        $("#tabledata").html("<td colspan='14'>No Data Found</td>");
      }
    },
  });
});

// ✅ Invoice Download Function
const downloadinvoice = (certificateid) => {
  const form = document.createElement("form");
  form.method = "POST";
  form.action = "activationinvoice.php";
  form.target = "_blank";

  const input = document.createElement("input");
  input.type = "hidden";
  input.name = "certificateid";
  input.value = certificateid;

  form.appendChild(input);
  document.body.appendChild(form);
  form.submit();
};

// ✅ Export to Excel Function
function exportToExcel() {
  var table = document.getElementById("myTable");
  var wb = XLSX.utils.table_to_book(table, { sheet: "Member Details" });
  XLSX.writeFile(wb, "Members_Details.xlsx");
}
