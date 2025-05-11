const getData = () => {
  $.ajax({
    type: "POST",
    url: "./requiredFiles/ajax/topupdepositeAjax.php",
    data: {
      way: "getData",
    },
    success: function (res) {
      var response = JSON.parse(res);

      if (response.status == "success") {
        document.getElementById("deposit address").innerHTML =
          response.crypto_address;
        // document.getElementById("deposit value").value =
        //   response.crypto_value;
        document.getElementById("cryptovalue").value = response.crypto_value;
        document.getElementById("imgaddress").src =
          "../admin/img/deposite/" + response.crypto_image;
        document.getElementById("bankaddress").src =
          "../admin/img/deposite/" + response.bankdeposit_image;
        document.getElementById("ac_holdername").innerHTML =
          response.ac_holdername;
        document.getElementById("ac_number").innerHTML = response.ac_number;
        document.getElementById("ifsc_code").innerHTML = response.ifsc_code;
        document.getElementById("branch").innerHTML = response.branch;
        document.getElementById("upi_id").innerHTML = response.upi_id;
        // document.getElementById("deposit_value").innerHTML =
        //   response.deposit_value;
        document.getElementById("user_id").value = response.userid;
        document.getElementById("userid").value = response.userid;
        document.getElementById("inrval").value = response.inr_value;
        document.getElementById("inrShow").innerHTML =
          "1 USD = " + response.inr_value + " INR";
        // document.getElementById("bankvalue").value = response.deposit_value;

        if (response.user_profileimg != null) {
          $(".user_profileimg").attr(
            "src",
            "./img/user/" + response.user_profileimg
          );
        }

        $(".user_name").html(response.user_name);
      } else if (
        response.status == "auth_failed" &&
        response.message == "Expired token"
      ) {
        location.replace("time_expried.php");
      } else if (response.status == "auth_failed") {
        location.replace("unauth_login.php");
      }
    },
    error: function (xhr, status, error) {
      console.error("Error:", error); // Log any errors
    },
  });
};

$(document).ready(() => {
  $.ajax({
    type: "POST",
    url: "./requiredFiles/ajax/topupdepositeAjax.php",
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
        getData(); // Call getData function after successful login
      }
    },
    error: function (xhr, status, error) {
      console.error("Error:", error); // Log any errors
    },
  });
});

$("#activationcrypto").submit(function (e) {
  e.preventDefault();

  $("#cryptoSubmit").html("Loading");

  var frm = $("#activationcrypto")[0];
  var frmdata = new FormData(frm);
  $.ajax({
    type: "POST",
    url: "./requiredFiles/ajax/topupdepositeAjax.php",
    data: frmdata,
    processData: false,
    contentType: false,
    cache: false,
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
        location.replace("topuphistory.php");
      }
    },
  });
});

const getBankDepositeVal = () => {
  const depositeval = document.getElementById("bank_deposit_value").value;
  const inrval = document.getElementById("inrval").value;

  const val = (parseFloat(depositeval) / parseFloat(inrval)).toFixed(2);

  console.log(val != "NaN" ? val : 0);

  document.getElementById("bank_topup_wallet").value = val != "NaN" ? val : 0;
};

const getCryptoDepositeVal = () => {
  const depositeval = document.getElementById("crypto_deposit_value").value;

  document.getElementById("crypto_topup_wallet").value = depositeval;
};

$("#activationbank").submit(function (e) {
  e.preventDefault();

  $("#cryptoSubmit").html("Loading");

  var frm = $("#activationbank")[0];
  var frmdata = new FormData(frm);
  $.ajax({
    type: "POST",
    url: "./requiredFiles/ajax/topupdepositeAjax.php",
    data: frmdata,
    processData: false,
    contentType: false,
    cache: false,
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
        location.replace("topuphistory.php");
      }
    },
  });
});
