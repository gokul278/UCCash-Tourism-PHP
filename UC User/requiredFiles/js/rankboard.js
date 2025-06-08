$(document).ready(() => {
  // Initial login check
  $.ajax({
    type: "POST",
    url: "./requiredFiles/ajax/rankboardAjax.php",
    data: { way: "login" },
    success: function (res) {
      const response = JSON.parse(res);

      if (response.status == "auth_failed" && response.message == "Expired token") {
        location.replace("time_expried.php");
      } else if (response.status == "auth_failed") {
        location.replace("unauth_login.php");
      } else if (response.status == "success") {
        getData();
      }
    },
  });
});

const getData = () => {
  $.ajax({
    type: "POST",
    url: "./requiredFiles/ajax/rankboardAjax.php",
    data: { way: "getData" },
    success: function (res) {
      const response = JSON.parse(res);

      if (response.status == "success") {
        if (response.user_profileimg != null) {
          $(".user_profileimg").attr("src", "./img/user/" + response.user_profileimg);
        }
        $(".user_name").html(response.user_name);
        $("#tabledata").html(response.tabledata);

        // For each level from 1 to 7, setup countdown timer
        for (let i = 1; i <= 7; i++) {
          const key = `lvl${i}count`;
          const targetDateStr = response[key]; // "YYYY-MM-DD"
          const cell = $(`.lvl${i}count`);
          if (!cell.length) continue;

          if (!targetDateStr) {
            cell.html("<span style='color:red'>No target date</span>");
            continue;
          }

          // Parse date + add 12 hours bonus
          let targetDate = new Date(targetDateStr + "T00:00:00");
          targetDate = new Date(targetDate.getTime() + 12 * 60 * 60 * 1000);

          // Declare intervalId for this timer
          let intervalId;

          const updateCountdown = () => {
            const now = new Date();
            const diff = targetDate - now;

            if (diff <= 0) {
              cell.html("<span style='color:red'>Expired</span>");
              clearInterval(intervalId);
              return;
            }

            const remaining = Math.floor(diff / 1000);
            const days = Math.floor(remaining / (60 * 60 * 24));
            const hours = Math.floor((remaining % (60 * 60 * 24)) / (60 * 60));
            const minutes = Math.floor((remaining % (60 * 60)) / 60);
            const seconds = remaining % 60;

            cell.html(
              `${days}d ${hours}h ${minutes}m ${seconds}s<br><small style="color:green;">( 12h bonus )</small>`
            );
          };

          updateCountdown();
          intervalId = setInterval(updateCountdown, 1000);
        }
      } else if (response.status == "auth_failed" && response.message == "Expired token") {
        location.replace("time_expried.php");
      } else if (response.status == "auth_failed") {
        location.replace("unauth_login.php");
      }
    },
  });
};
