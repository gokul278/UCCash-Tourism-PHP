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

      if (response.status === "success") {
        $(".adminname").html(response.admin_name);

        if (response.profile_image) {
          $(".profile_image").attr("src", "./img/user/" + response.profile_image);
        }

        const rows = response.table_rows;
        if (rows.length > 0) {
          let tableHTML = "";

          rows.forEach((row, index) => {
            let idx = index + 1;
            tableHTML += `
              <tr align="center">
                <th scope="row">${idx}</th>
                <td>${row.idactivation_id}</td>
                <td>${row.paid_date}</td>
                <td>${row.user_id}</td>
                <td>${row.user_name}</td>
                <td>${row.deposite_type}</td>
            `;

            if (row.deposite_type === "Crypto") {
              tableHTML += `
                <td>${row.crypto_value}</td>
                <td>${row.txnhash_id}</td>
              `;
            } else if (row.deposite_type === "Bank") {
              tableHTML += `
                <td>${row.bank_value}</td>
                <td>
                  ${row.transaction_id}<br>
                  <button class="btn btn-success view-proof-image" data-src=".././UC User/img/proofImage/${row.proof_image}">
                    <i class="bi bi-eye-fill"></i>
                  </button>
                </td>
              `;
            }

            tableHTML += `
              <td>
                <button type="button" class="btn btn-success" onclick="approveactivation(${idx})" id="approvebtn${idx}"><b>Approve</b></button>
              </td>
              <td>
                <div>
                  <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal${idx}">
                    <b>Reject</b>
                  </button>
                </div>
                <div class="modal fade" id="exampleModal${idx}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel${idx}" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" style="color: #000;" id="exampleModalLabel${idx}">Reject Activation ID: ${row.idactivation_id}</h5>
                        <button type="button" class="close btn btn-danger" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <div class="form-group">
                          <label for="reason${idx}">Reason</label>
                          <input type="hidden" id="userid${idx}" value="${row.user_id}">
                          <input type="hidden" id="activationid${idx}" value="${row.idactivation_id}">
                          <input type="text" class="form-control" id="reason${idx}" placeholder="Enter Reason">
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><strong>Close</strong></button>
                        <button type="button" class="btn btn-primary" onclick="rejectinvoice(${idx})" data-dismiss="modal"><strong style="color: #000;">Submit</strong></button>
                      </div>
                    </div>
                  </div>
                </div>
              </td>
            </tr>
            `;
          });

          $("#tabledata").html(tableHTML);

          let table = new DataTable("#myTable", { ordering: false });

          $(".view-proof-image").off("click").on("click", function () {
            var proofImageSrc = $(this).data("src");
            $("#proofImage").attr("src", proofImageSrc);
            $("#proofImageModal").modal("show");
          });
        } else {
          $("#tabledata").html("<tr><td colspan='12'>No Data Found</td></tr>");
        }
      }
    }
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
