$(document).ready(() => {
  $.ajax({
    type: "POST",
    url: "./requiredFiles/ajax/membersdetailsAjax.php",
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
        return getData();
      }
    },
  });
});

let firstLoad = 0;

const getData = () => {
  $.ajax({
    type: "POST",
    url: "./requiredFiles/ajax/membersdetailsAjax.php",
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
          if (firstLoad === 0) {
            let table = new DataTable("#myTable", {
              ordering: false,
            });
            firstLoad = 1;
          }
        } else {
          $("#tabledata").html("<td colspan='14'>No Data Found</td>");
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

const clearFilterDate = () => {
  $("#fromDate").val("");
  $("#toDate").val("");
  getData();
};

const clearFilterStatus = () => {
  $("#typevalue").val("");
  getData();
};

$("#invoiceDateFilter").submit((e) => {
  e.preventDefault();

  const fromDate = $("#fromDate").val();
  const toDate = $("#toDate").val();

  $("#typevalue").val("");

  $.ajax({
    type: "POST",
    url: "./requiredFiles/ajax/membersdetailsAjax.php",
    data: {
      way: "dateFilter",
      fromDate: fromDate,
      toDate: toDate,
    },
    success: function (res) {
      var response = JSON.parse(res);
      if (response.status == "success") {
        if (response.tabledata.length > 0) {
          $("#tabledata").html(response.tabledata);
          //   let table = new DataTable("#myTable", {
          //     ordering: false,
          //   });
        } else {
          $("#tabledata").html("<td colspan='14'>No Data Found</td>");
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
});

$("#statusSubmit").submit((e) => {
  e.preventDefault();

  const typevalue = $("#typevalue").val();
  $("#fromDate").val("");
  $("#toDate").val("");

  $.ajax({
    type: "POST",
    url: "./requiredFiles/ajax/membersdetailsAjax.php",
    data: {
      way: "typeFilter",
      typevalue: typevalue,
    },
    success: function (res) {
      var response = JSON.parse(res);
      if (response.status == "success") {
        if (response.tabledata.length > 0) {
          $("#tabledata").html(response.tabledata);
          //   let table = new DataTable("#myTable", {
          //     ordering: false,
          //   });
        } else {
          $("#tabledata").html("<td colspan='14'>No Data Found</td>");
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
});

const downloadinvoice = (certificateid) => {
  // Create a form element
  const form = document.createElement("form");
  form.method = "POST";
  form.action = "activationinvoice.php";
  form.target = "_blank";

  // Create an input element for the certificateid
  const input = document.createElement("input");
  input.type = "hidden";
  input.name = "certificateid";
  input.value = certificateid;

  // Append the input to the form
  form.appendChild(input);

  // Append the form to the body (not visible)
  document.body.appendChild(form);

  // Submit the form
  form.submit();
};

function exportToExcel() {
  var table = document.getElementById("myTable");
  var wb = XLSX.utils.table_to_book(table, { sheet: "Member Details" });
  XLSX.writeFile(wb, "Members_Details.xlsx");
}
