$(document).ready(() => {
  $.ajax({
    type: "POST",
    url: "./requiredFiles/ajax/domesticconfirmpageAjax.php",
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
  function getQueryParam(name) {
    var urlParams = new URLSearchParams(window.location.search);
    return urlParams.get(name);
  }

  // Store the booking code
  var bookingid = getQueryParam("bookingid");

  $.ajax({
    type: "POST",
    url: "./requiredFiles/ajax/domesticconfirmpageAjax.php",
    data: {
      way: "getData",
      bookingid: bookingid,
    },
    success: function (res) {
      var response = JSON.parse(res);
      if (response.status == "success") {
        if (response.user_profileimg != null) {
          $(".user_profileimg").attr(
            "src",
            "./img/user/" + response.user_profileimg
          );
        }

        $(".user_name").html(response.user_name);
        $(".bonustravel").html(response.bonustravel);
        $(".tu_points").html(response.tu_points);
        $("#tour_amount").html(response.tour_amount + " $");
        $("#gstamount").html(response.gstamount + " $");
        $("#netamount").html(response.netamount + " $");
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

const amountcheck = () => {
  function getQueryParam(name) {
    var urlParams = new URLSearchParams(window.location.search);
    return urlParams.get(name);
  }

  // Store the booking code
  var bookingid = getQueryParam("bookingid");
  var person = parseInt($("#personinput").val());
  var selectType = $("#paymenttype").val();

  $.ajax({
    type: "POST",
    url: "./requiredFiles/ajax/domesticconfirmpageAjax.php",
    data: {
      way: "checkamount",
      person: person,
      bookingid: bookingid,
      selectType: selectType,
    },
    success: function (res) {
      var response = JSON.parse(res);
      if (response.status == "success") {
        $("#tour_amount").html(response.tour_amount + " $");
        $("#gstamount").html(response.gstamount + " $");
        $("#netamount").html(response.netamount + " $");
        $("#discountamount").html(response.discountamount + " $");
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

$(".plus").click(() => {
  var person = parseInt($("#personinput").val());
  person += 1;
  function getQueryParam(name) {
    var urlParams = new URLSearchParams(window.location.search);
    return urlParams.get(name);
  }

  var selectType = $("#paymenttype").val();

  // Store the booking code
  var bookingid = getQueryParam("bookingid");

  $.ajax({
    type: "POST",
    url: "./requiredFiles/ajax/domesticconfirmpageAjax.php",
    data: {
      way: "checkamount",
      person: person,
      bookingid: bookingid,
      selectType: selectType,
    },
    success: function (res) {
      var response = JSON.parse(res);
      if (response.status == "success") {
        $("#tour_amount").html(response.tour_amount + " $");
        $("#gstamount").html(response.gstamount + " $");
        $("#netamount").html(response.netamount + " $");
        $("#discountamount").html(response.discountamount + " $");
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
  $("#personinput").val(person);
});

$(".minus").click(() => {
  var person = parseInt($("#personinput").val());
  if (person > 1) {
    person -= 1;
  }
  function getQueryParam(name) {
    var urlParams = new URLSearchParams(window.location.search);
    return urlParams.get(name);
  }

  var selectType = $("#paymenttype").val();

  // Store the booking code
  var bookingid = getQueryParam("bookingid");

  $.ajax({
    type: "POST",
    url: "./requiredFiles/ajax/domesticconfirmpageAjax.php",
    data: {
      way: "checkamount",
      person: person,
      bookingid: bookingid,
      selectType: selectType,
    },
    success: function (res) {
      var response = JSON.parse(res);
      if (response.status == "success") {
        $("#tour_amount").html(response.tour_amount + " $");
        $("#gstamount").html(response.gstamount + " $");
        $("#netamount").html(response.netamount + " $");
        $("#discountamount").html(response.discountamount + " $");
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
  $("#personinput").val(person); // Update input field value
});

const checkpaymenttype = () => {
  const paymenttype = $("#paymenttype").val();
  $("#otpbtn").prop("disabled", true);
  amountcheck();
  if (paymenttype === "none") {
    $("#paymentinput").html(
      '<input class="form-control" id="none" type="number" placeholder="Choose the Payment Type" style="height: 50px;" disabled>'
    );
  } else if (paymenttype === "bonustravelpoints") {
    $("#paymentinput").html(
      '<input class="form-control" id="bonustravelpoints" type="number" placeholder="Enter the Bonus Travel Point" oninput="checkbonustp()" style="height: 50px;">'
    );
  } else if (paymenttype === "allpoints") {
    $("#paymentinput").html(`
            <input class="form-control" id="topupwalletpoint" type="number" placeholder="Enter the Top-up Wallet Point" style="height: 50px;" oninput="sumtotal()"><br>
            <input class="form-control" id="bonustravelpoints" type="number" placeholder="Enter the Bonus Travel Point" style="height: 50px;" oninput="sumtotal()"><br>
        `);
  } else if (paymenttype === "topupwallet") {
    $("#paymentinput").html(
      '<input class="form-control" id="topupwalletpoint" type="number" placeholder="Enter the Top-up Wallet Point" oninput="checktopupwallet()" style="height: 50px;">'
    );
  }
};

const sumtotal = () => {
  const topupwalletpoint = parseFloat($("#topupwalletpoint").val()) || 0;
  const bonustravelpoints = parseFloat($("#bonustravelpoints").val()) || 0;

  const totalvalue = topupwalletpoint + bonustravelpoints;

  $("#totalvalue").html("Total Points: " + totalvalue.toFixed(2));

  var person = parseInt($("#personinput").val());

  function getQueryParam(name) {
    var urlParams = new URLSearchParams(window.location.search);
    return urlParams.get(name);
  }

  // Store the booking code
  var bookingid = getQueryParam("bookingid");

  var selectType = $("#paymenttype").val();

  $.ajax({
    type: "POST",
    url: "./requiredFiles/ajax/domesticconfirmpageAjax.php",
    data: {
      way: "checkamount",
      person: person,
      bookingid: bookingid,
      selectType: selectType,
    },
    success: function (res) {
      var response = JSON.parse(res);
      if (response.status == "success") {
        const tourAmount = parseFloat(response.netamount);

        // Use a small tolerance for comparison
        const tolerance = 0.01;
        if (Math.abs(tourAmount - totalvalue) < tolerance) {
          $("#otpbtn").prop("disabled", false);
        } else {
          $("#otpbtn").prop("disabled", true);
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

const checkbonustp = () => {
  const bonustravelpoints = parseFloat($("#bonustravelpoints").val()) || 0;
  var person = parseInt($("#personinput").val());

  function getQueryParam(name) {
    var urlParams = new URLSearchParams(window.location.search);
    return urlParams.get(name);
  }

  // Store the booking code
  var bookingid = getQueryParam("bookingid");
  var selectType = $("#paymenttype").val();

  $.ajax({
    type: "POST",
    url: "./requiredFiles/ajax/domesticconfirmpageAjax.php",
    data: {
      way: "checkamount",
      person: person,
      bookingid: bookingid,
      selectType: selectType,
    },
    success: function (res) {
      var response = JSON.parse(res);
      if (response.status == "success") {
        const tourAmount = parseFloat(response.netamount);

        // Use a small tolerance for comparison
        const tolerance = 0.01;
        if (Math.abs(tourAmount - bonustravelpoints) < tolerance) {
          $("#otpbtn").prop("disabled", false);
        } else {
          $("#otpbtn").prop("disabled", true);
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

const checktopupwallet = () => {
  const checktopupwallet = parseFloat($("#topupwalletpoint").val()) || 0;
  var person = parseInt($("#personinput").val());

  function getQueryParam(name) {
    var urlParams = new URLSearchParams(window.location.search);
    return urlParams.get(name);
  }

  // Store the booking code
  var bookingid = getQueryParam("bookingid");
  var selectType = $("#paymenttype").val();

  $.ajax({
    type: "POST",
    url: "./requiredFiles/ajax/domesticconfirmpageAjax.php",
    data: {
      way: "checkamount",
      person: person,
      bookingid: bookingid,
      selectType: selectType,
    },
    success: function (res) {
      var response = JSON.parse(res);
      if (response.status == "success") {
        const tourAmount = parseFloat(response.netamount);

        // Use a small tolerance for comparison
        const tolerance = 0.01;
        if (Math.abs(tourAmount - checktopupwallet) < tolerance) {
          $("#otpbtn").prop("disabled", false);
        } else {
          $("#otpbtn").prop("disabled", true);
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

$("#otpbtn").click(function (e) {
  e.preventDefault();

  const paymenttype = $("#paymenttype").val();

  function getQueryParam(name) {
    var urlParams = new URLSearchParams(window.location.search);
    return urlParams.get(name);
  }

  // Store the booking code
  var bookingid = getQueryParam("bookingid");

  var personinput = $("#personinput").val();

  if (paymenttype === "none") {
    alert("Choose the Payment Type");
  } else if (paymenttype === "bonustravelpoints") {
    const bonustravelpoints = $("#bonustravelpoints").val();
    $("#paymenttype").prop("disabled", true);
    $("#bonustravelpoints").prop("disabled", true);
    $(".plus").prop("disabled", true);
    $(".minus").prop("disabled", true);
    $("#personinput").prop("disabled", true);

    if (bonustravelpoints.length >= 1) {
      $("#otpbtn").html("Loading ..");
      $.ajax({
        type: "POST",
        url: "./requiredFiles/ajax/domesticconfirmpageAjax.php",
        data: {
          way: "getotp",
          type: "bonustravelpoints",
          personinput: personinput,
          bonustravelpoints: bonustravelpoints,
          bookingid: bookingid,
        },
        success: function (res) {
          var response = JSON.parse(res);
          if (response.status == "success") {
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

            $("#otpbtn").html("Resend OTP");
            $("#confirmButton").prop("disabled", false);
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
    } else {
      alert("Enter the Bonus Travel points");
    }
  } else if (paymenttype === "topupwallet") {
    const topupwalletpoint = $("#topupwalletpoint").val();
    $("#paymenttype").prop("disabled", true);
    $("#savingstravelpoints").prop("disabled", true);
    $(".plus").prop("disabled", true);
    $(".minus").prop("disabled", true);
    $("#personinput").prop("disabled", true);

    var selectType = $("#paymenttype").val();

    if (topupwalletpoint.length >= 1) {
      $("#otpbtn").html("Loading ..");
      $.ajax({
        type: "POST",
        url: "./requiredFiles/ajax/domesticconfirmpageAjax.php",
        data: {
          way: "getotp",
          type: "topupwalletpoint",
          personinput: personinput,
          topupwalletpoint: topupwalletpoint,
          bookingid: bookingid,
        },
        success: function (res) {
          var response = JSON.parse(res);
          if (response.status == "success") {
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
            $("#confirmButton").prop("disabled", false);
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
    } else {
      alert("Enter the Savings Travel points");
    }
  } else if (paymenttype === "allpoints") {
    const topupwalletpoint = $("#topupwalletpoint").val();
    const bonustravelpoints = $("#bonustravelpoints").val();

    if (topupwalletpoint.length >= 1 || bonustravelpoints.length >= 1) {
      $("#paymenttype").prop("disabled", true);
      $("#bonustravelpoints").prop("disabled", true);
      $("#topupwalletpoint").prop("disabled", true);
      $(".plus").prop("disabled", true);
      $(".minus").prop("disabled", true);
      $("#personinput").prop("disabled", true);
      $("#otpbtn").html("Loading ..");
      $.ajax({
        type: "POST",
        url: "./requiredFiles/ajax/domesticconfirmpageAjax.php",
        data: {
          way: "getotp",
          type: "allpoints",
          personinput: personinput,
          topupwalletpoint: topupwalletpoint,
          bonustravelpoints: bonustravelpoints,
          bookingid: bookingid,
        },
        success: function (res) {
          var response = JSON.parse(res);
          if (response.status == "success") {
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
            $("#confirmButton").prop("disabled", false);
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
    } else {
      alert("Enter the TP");
    }
  }
});

const clearerr = () => {
  $("#errormsg").html("");
};

$("#confirmButton").click(function (e) {
  e.preventDefault();

  if ($("#invalidCheck2").is(":checked") && $("#otpinput").val().length >= 6) {
    const paymenttype = $("#paymenttype").val();
    const personinput = $("#personinput").val();
    var otp = $("#otpinput").val();

    function getQueryParam(name) {
      var urlParams = new URLSearchParams(window.location.search);
      return urlParams.get(name);
    }

    // Store the booking code
    var bookingid = getQueryParam("bookingid");

    if (paymenttype === "bonustravelpoints") {
      var bonustravelpoints = $("#bonustravelpoints").val();

      $("#confirmButton").html("Loading ..");
      $("#confirmButton").prop("disabled", true);
      $.ajax({
        type: "POST",
        url: "./requiredFiles/ajax/domesticconfirmpageAjax.php",
        data: {
          way: "tourbookbonustravelpoints",
          personinput: personinput,
          bonustravelpoints: bonustravelpoints,
          bookingid: bookingid,
          otp: otp,
        },
        success: function (res) {
          var response = JSON.parse(res);
          if (response.status == "success") {
            location.replace("domestictourbookinghistory.php");
          } else if (
            response.status == "auth_failed" &&
            response.message == "Expired token"
          ) {
            location.replace("time_expried.php");
          } else if (response.status == "auth_failed") {
            location.replace("unauth_login.php");
          } else if (response.status == "error") {
            $("#errormsg").html(response.message);
            $("#confirmButton").html("Confirm Booking");
            $("#confirmButton").prop("disabled", false);
            $("#otpbtn").html("Get OTP");
          }
        },
      });
    } else if (paymenttype === "topupwallet") {
      var topupwalletpoint = $("#topupwalletpoint").val();

      $("#confirmButton").html("Loading ..");
      $("#confirmButton").prop("disabled", true);
      $.ajax({
        type: "POST",
        url: "./requiredFiles/ajax/domesticconfirmpageAjax.php",
        data: {
          way: "tourbooktopupwallet",
          personinput: personinput,
          topupwalletpoint: topupwalletpoint,
          bookingid: bookingid,
          otp: otp,
        },
        success: function (res) {
          var response = JSON.parse(res);
          if (response.status == "success") {
            location.replace("domestictourbookinghistory.php");
          } else if (
            response.status == "auth_failed" &&
            response.message == "Expired token"
          ) {
            location.replace("time_expried.php");
          } else if (response.status == "auth_failed") {
            location.replace("unauth_login.php");
          } else if (response.status == "error") {
            $("#errormsg").html(response.message);
            $("#confirmButton").html("Confirm Booking");
            $("#confirmButton").prop("disabled", false);
            $("#otpbtn").html("Get OTP");
          }
        },
      });
    } else if (paymenttype === "allpoints") {
      var topupwalletpoint = $("#topupwalletpoint").val();
      var bonustravelpoints = $("#bonustravelpoints").val();

      $("#confirmButton").html("Loading ..");
      $("#confirmButton").prop("disabled", true);
      $.ajax({
        type: "POST",
        url: "./requiredFiles/ajax/domesticconfirmpageAjax.php",
        data: {
          way: "tourallpoints",
          personinput: personinput,
          topupwalletpoint: topupwalletpoint,
          bonustravelpoints: bonustravelpoints,
          bookingid: bookingid,
          otp: otp,
        },
        success: function (res) {
          var response = JSON.parse(res);
          if (response.status == "success") {
            location.replace("domestictourbookinghistory.php");
          } else if (
            response.status == "auth_failed" &&
            response.message == "Expired token"
          ) {
            location.replace("time_expried.php");
          } else if (response.status == "auth_failed") {
            location.replace("unauth_login.php");
          } else if (response.status == "error") {
            $("#errormsg").html(response.message);
            $("#confirmButton").html("Confirm Booking");
            $("#confirmButton").prop("disabled", false);
            $("#otpbtn").html("Get OTP");
          }
        },
      });
    }
  } else {
    alert("Enter Valid OTP and Accept the Terms and Condition");
  }
});
