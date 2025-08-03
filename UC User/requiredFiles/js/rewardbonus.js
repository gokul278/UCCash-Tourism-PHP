$(document).ready(() => {
  $.ajax({
    type: "POST",
    url: "./requiredFiles/ajax/rewardbonusAjax.php",
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

const getData = () => {
  $.ajax({
    type: "POST",
    url: "./requiredFiles/ajax/rewardbonusAjax.php",
    data: {
      way: "getData",
    },
    success: function (res) {
      var response = JSON.parse(res);

      if (response.status == "success") {
        console.log(response);

        // Set profile image if exists
        if (response.user_profileimg != null) {
          $(".user_profileimg").attr(
            "src",
            "./img/user/" + response.user_profileimg
          );
        }

        // Set user name
        $(".user_name").html(response.user_name);

        // Build rewards table
        if (response.rewards.length >= 1) {
          let tableRows = "";

          response.rewards.forEach((reward, index) => {
            tableRows += `
                            <tr>
                                <td>${index + 1}</td>
                                <td>${reward.rb_start || "-"}</td>
                                <td>${reward.rb_end || "-"}</td>
                                <td>${
                                  reward.rb_usercount
                                    ? reward.rb_usercount + " / 5"
                                    : "0 / 5"
                                }</td>
                                <td>${reward.rb_point || "-"}</td>
                            </tr>
                        `;
          });

          // Insert rows into table body
          $("#pointstable").html(tableRows);

          // Initialize DataTable
          let table = new DataTable("#myTable", {
            ordering: false,
          });
        } else {
          $("#pointstable").html("<tr><td colspan='5'>No Data</td></tr>");
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
