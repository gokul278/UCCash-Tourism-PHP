$(document).ready(() => {
  $.ajax({
    type: "POST",
    url: "./requiredFiles/ajax/wallettransferAjax.php",
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
    url: "./requiredFiles/ajax/wallettransferAjax.php",
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

        $(".user_name").html(response.user_name);

        $(".savingstravelpoints").html(response.savingstravelpoints);
        $(".bonustravelpoints").html(response.bonustravelpoints);

        if (response.tabledata.length > 0) {
          $("#tabledata").html(response.tabledata);
        } else {
          $("#tabledata").html("<tr><td colspan='10'>No Data Found</td></tr>");
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

const balancecheck = () => {
  const way = $("#floatingSelect").val();

  if (way !== "none") {
    $.ajax({
      type: "POST",
      url: "./requiredFiles/ajax/wallettransferAjax.php",
      data: {
        way: way,
      },
      success: function (res) {
        var response = JSON.parse(res);
        if (response.status == "success") {
          $("#balanacevalue").html(response.balanacevalue + "$");
          $("#availablepoint").val(response.balanacevalue);
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
    verifyAmount();
  } else {
    $("#balanacevalue").html("None");
    verifyAmount();
  }
};

const verifyAmount = () => {
  const availablepoint = $("#availablepoint").val() || "0";
  const tofloatingSelect = $("#tofloatingSelect").val() || "";
  const floatingSelect = $("#floatingSelect").val() || "";
  const verifyUser = $("#verifyUser").val(); // <== Correct scope
  const dollarvalue = $("#dollarvalue").val() || "";

  console.log("___________>Checked");
  console.log(parseFloat(dollarvalue));
  console.log(availablepoint);
  console.log(tofloatingSelect);
  console.log(floatingSelect);
  console.log(verifyUser);

  const isReady =
    dollarvalue.length >= 1 &&
    availablepoint.length >= 1 &&
    tofloatingSelect.length >= 1 &&
    floatingSelect.length >= 1 &&
    verifyUser === "true";

  if (isReady) {
    if (parseFloat(dollarvalue) <= parseFloat(availablepoint)) {
      $("#otpbtn").prop("disabled", false);
      console.log("True");
    } else {
      $("#otpbtn").prop("disabled", true);
      console.log("False");
    }
  } else {
    $("#otpbtn").prop("disabled", true);
    console.log("False");
  }
};

const checkuserid = () => {
  const userid = $("#userid").val();

  // Reset everything before AJAX
  $("#verifyUser").val("false");
  $("#transferbtn").prop("disabled", true);
  $("#useridmsg").html("");

  if (userid.length >= 1) {
    $.ajax({
      type: "POST",
      url: "./requiredFiles/ajax/wallettransferAjax.php",
      data: {
        way: "checksponser",
        userid: userid,
      },
      success: function (res) {
        const response = JSON.parse(res);
        if (response.status === "success") {
          if (response.stage === "ok") {
            $("#useridmsg").html(
              "<p style='color:green'>" + response.message + "</p>"
            );
            $("#verifyUser").val("true");
            $("#transferbtn").prop("disabled", false);
          } else {
            $("#transferbtn").prop("disabled", true);
            $("#useridmsg").html("<p style='color:red'>Invalid User ID</p>");
            $("#verifyUser").val("false");
          }
        }

        // ✅ call verifyAmount **after** setting the flag
        verifyAmount();
      },
    });
  } else {
    $("#useridmsg").html("<p>Enter the User Id</p>");
    $("#verifyUser").val("false");
    verifyAmount();
  }
};

const clearerr = () => {
  $("#errormsg").html("");
};

$("#transferpoint").submit(function (e) {
  e.preventDefault();

  var frm = $("#transferpoint")[0];
  var frmdata = new FormData(frm);
  $.ajax({
    type: "POST",
    url: "./requiredFiles/ajax/wallettransferAjax.php",
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
        location.reload();
      } else if (response.status == "error") {
        $("#errormsg").html(response.message);
      }
    },
  });
});

const getotp = () => {
  var selectoption = $("#floatingSelect").val();
  var toselectoption = $("#tofloatingSelect").val();
  var points = $("#dollarvalue").val();
  var userid = $("#userid").val();

  if (selectoption !== "none" && points.length >= 1) {
    $("#otpbtn").html("Loading ...");

    $.ajax({
      type: "POST",
      url: "./requiredFiles/ajax/wallettransferAjax.php",
      data: {
        way: "getotp",
        points: points,
        userid: userid,
        selectoption: selectoption,
        toselectoption: toselectoption,
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
          new Notify({
            status: "success",
            title: "OTP",
            text: "OTP Sended Successfully...!",
            effect: "fade",
            speed: 300,
            speed: 300,
            customClass: "",
            customIcon: "",
            showIcon: true,
            showCloseButton: true,
            autoclose: true,
            autotimeout: 3000,
            notificationsGap: null,
            notificationsPadding: null,
            type: "outline",
            position: "right top",
            customWrapper: "",
          });

          $("#otpbtn").html("Resend OTP");
          // $("#floatingSelect").prop("disabled", true);
          $("#dollarvalue").prop("readonly", true);
          $("#userid").prop("readonly", true);
        }
      },
    });
  } else {
    alert("Choose the Wallet Type and Transfer Points");
  }
};
