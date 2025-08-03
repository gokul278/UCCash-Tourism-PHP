$(document).ready(() => {
  $.ajax({
    type: "POST",
    url: "./requiredFiles/ajax/indexAjax.php",
    data: {
      way: "getflashbanner",
    },
    success: function (res) {
      var response = JSON.parse(res);
      if (response.status == "success") {
        if (response.flashbanner != null) {
          $("#flashbanner").attr(
            "src",
            ".././img/flashbanner/" + response.flashbanner + ""
          );
          var myModal = new bootstrap.Modal(
            document.getElementById("exampleModal")
          );
          myModal.show();
        }
      }
    },
  });

  $.ajax({
    type: "POST",
    url: "./requiredFiles/ajax/indexAjax.php",
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
    url: "./requiredFiles/ajax/indexAjax.php",
    data: {
      way: "getData",
    },
    success: function (res) {
      var response = JSON.parse(res);
      if (response.status == "success") {
        if (response.user_profileimg !== null) {
          $(".user_profileimg").attr(
            "src",
            "./img/user/" + response.user_profileimg
          );
        }

        if (response.user_referalStatus == "activated") {
          $("#user_referalStatus").html(
            '<b style="color:#66e0ac">&#10687; Active</b>'
          );
        } else if (response.user_referalStatus == "notactivated") {
          $("#user_referalStatus").html(
            '<b style="color:red">&#10687; In Active</b>'
          );
        }

        $(".user_name").html(response.user_name);
        $("#user_id").html(response.user_id);
        $("#user_sponserid").html(response.user_sponserid);

        var parts = response.created_at.split(" ");
        var datePart = parts[0].split("-");
        var reorderedDate = datePart[2] + "/" + datePart[1] + "/" + datePart[0];
        $("#created_at").html(reorderedDate);

        $("#savingtravel").html(response.savingtravel);
        $("#bonustravel").html(response.bonustravel);
        $("#travelcoupon").html(response.travelcoupon);
        $("#networkingincome").html(response.networkingincome);
        $("#leadershipincome").html(response.leadershipincome);
        $("#carandhousefund").html(response.carandhousefund);
        $("#royaltyincome").html(response.royaltyincome);
        $("#savingsincome").html(response.savingsincome);
        $("#reactivationwallet").html(response.reactivationwallet);
        $("#availablewithdrwabalance").html(response.availablewithdrwabalance);
        $("#uccwallet").html(response.uccwallet);
        $("#tu_points").html(response.tu_points);

        if (response.rank.length >= 1) {
          $("#rank").html(response.rank);
        } else {
          $("#rank").html("Member");
        }

        $("#news").html(response.news);

        $(".newscarousel").html();

        const rankboardData = {
          rankboardStatus: response.rankboardStatus,
          rankboardDate: response.rankboardDate,
          rankboardLabel: response.rankboardLabel,
          rankboardAchiveDays: response.rankboardAchiveDays,
        };

        let bannerContent = "";

        if (response.rewardstatus === "notactivated") {
          bannerContent = `
           <div class="reward-banner locked">
                        <div class="content">
                            <span class="reward-icon">🔒</span>
                            <div class="desc-group">
                                <span class="desc bold">You need to Activate your Account</span>
                                <span class="desc">To unlock the $25 reward</span>
                            </div>
                        </div>
                        <a href="https://uccashtourism.com/UC%20User/id%20activation.php" class="button-link">
                            <i class="bi bi-lightning-charge"></i>
                        </a>
                    </div>
          `;
        } else if (response.rewardstatus === "pending") {
          bannerContent = `
          <div class="reward-banner in-progress">
                        <div class="content">
                            <span class="reward-icon">⏳</span>
                            <div class="desc-group">
                                <span class="desc bold">You’ve referred ${parseInt(
                                  response.rewardUsercount
                                )} out of 5 friends</span>
                                <span class="desc">Refer ${
                                  5 - parseInt(response.rewardUsercount)
                                } more to earn your $25 reward,</span>
          <span class="desc">before <strong>${
            response.rewardEnddate
          }</strong></span>
                                <!-- <div class="progress-bar">
                                    <div class="progress-fill" style="width: 60%;"></div>
                                </div> -->
                            </div>
                        </div>
                        <a href="https://uccashtourism.com/UC%20User/referral.php" class="button-link">
                            <i class="bi bi-share-fill"></i>
                        </a>
                    </div>
          `;
        } else if (response.rewardstatus === "finished") {
          bannerContent = `
           <div class="reward-banner">
                        <div class="content">
                            <span class="reward-icon">🎉</span>
                            <div class="desc-group">
                                <span class="desc bold">You’ve reached the 5/5 Referral Reward! You Got $25</span>
                                <span class="desc">Next Reward Starts on ${
                                  new Date(
                                    new Date(response.rewardEnddate).setDate(
                                      new Date(
                                        response.rewardEnddate
                                      ).getDate() + 1
                                    )
                                  )
                                    .toISOString()
                                    .split("T")[0]
                                }</span>
                            </div>
                        </div>
                        <a href="https://uccashtourism.com/UC%20User/rewardbonus.php" class="button-link">
                            <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
          `;
        }

        $("#rewardsBannerPlace").html(bannerContent);

        renderRankboard(rankboardData);
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

function renderRankboard(data) {
  if (data.rankboardStatus) {
    const container = $(`
      <a href="./rank%20board.php" class="mt-1" style="background-color: #2b4e6b; width:100%; display:flex; justify-content: space-between; align-items:center; padding:10px 20px; border-radius: 10px;">
        <div>
          <p class="mb-1 mt-1" style="color: #fff;"><b>${data.rankboardLabel}</b></p>
          <p class="mb-1" style="color: #fff;" id="rankTimer">Loading...</p>
        </div>
       
      </a>
    `);

    $("#rankboardContainer").html(container);

    // Step 1: Convert rankboardDate to Date object
    const baseDate = new Date(data.rankboardDate + "T00:00:00");

    // Step 2: Add days
    baseDate.setDate(
      baseDate.getDate() + parseInt(data.rankboardAchiveDays || 0)
    );

    // Step 3: Add 12 hours bonus
    baseDate.setHours(baseDate.getHours() + 12);

    const targetDate = baseDate; // Final target date with 12h bonus
    const timerEl = document.getElementById("rankTimer");

    function updateTimer() {
      const now = new Date();
      const diff = targetDate - now;

      if (diff <= 0) {
        timerEl.innerHTML = "<span style='color:red;'>Expired</span>";
        clearInterval(timerInterval);
        return;
      }

      const days = Math.floor(diff / (1000 * 60 * 60 * 24));
      const hours = Math.floor((diff / (1000 * 60 * 60)) % 24);
      const minutes = Math.floor((diff / (1000 * 60)) % 60);
      const seconds = Math.floor((diff / 1000) % 60);

      timerEl.innerHTML = `${days}d ${hours}h ${minutes}m ${seconds}s<br><small style="color:limegreen;">(12h bonus)</small>`;
    }

    updateTimer();
    const timerInterval = setInterval(updateTimer, 1000);
  } else {
    $("#rankboardContainer").empty();
  }
}
