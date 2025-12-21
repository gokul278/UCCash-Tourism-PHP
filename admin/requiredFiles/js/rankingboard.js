var x = 0;

$(document).ready(() => {
  $.ajax({
    type: "POST",
    url: "./requiredFiles/ajax/rankingboardAjax.php",
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
        $("#searchtype").prop("disabled", true);
        getAwards();
        return getData();
      }
    },
  });
});

const changeVal = () => {

  var type = $("#typevalue").val();
  if (type === "none") {
    $("#searchtype").prop("disabled", true);
    $("#clearsearchtype").prop("disabled", false);
  } else {
    $("#searchtype").prop("disabled", false);
    $("#clearsearchtype").prop("disabled", false);
  }
}

const getAwards = () => {
  $.ajax({
    type: "POST",
    url: "./requiredFiles/ajax/rankingboardAjax.php",
    data: {
      way: "getAwards",
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
        $("#lvl1").val(response.lvl1reward);
        $("#lvl2").val(response.lvl2reward);
        $("#lvl3").val(response.lvl3reward);
        $("#lvl4").val(response.lvl4reward);
        $("#lvl5").val(response.lvl5reward);
        $("#lvl6").val(response.lvl6reward);
        $("#lvl7").val(response.lvl7reward);
        $("#lvl8").val(response.lvl8reward);
      }
    },
  });
};

const getData = () => {
  $.ajax({
    type: "POST",
    url: "./requiredFiles/ajax/rankingboardAjax.php",
    data: { way: "getData" },
    success: function (res) {
      var response = JSON.parse(res);

      if (response.status === "success") {
        $(".adminname").html(response.admin_name);

        if (response.profile_image !== null) {
          $(".profile_image").attr(
            "src",
            "./img/user/" + response.profile_image
          );
        }

        // 🔥 Destroy existing DataTable
        if ($.fn.DataTable.isDataTable("#myTable")) {
          rankingTable.clear().destroy();
        }

        if (response.tabledata.length > 0) {
          $("#tabledata").html(response.tabledata);

          // 🔥 Reinitialize DataTable
          rankingTable = new DataTable("#myTable", {
            ordering: false,
            pageLength: 10,
          });
        } else {
          $("#tabledata").html(
            "<tr><td colspan='5'>No Data Found</td></tr>"
          );
        }
      }
      else if (
        response.status === "auth_failed" &&
        response.message === "Expired token"
      ) {
        location.replace("time_expried.php");
      }
      else if (response.status === "auth_failed") {
        location.replace("unauth_login.php");
      }
    },
  });
};

$("#clearsearchtype").click(function (e) {
  e.preventDefault();

  $("#searchtype").prop("disabled", true);
  $("#clearsearchtype").prop("disabled", true);
  $("#typevalue").val("none");

  getData(); // ✅ this will reset everything
});


$("#searchtype").click(function (e) {
  e.preventDefault();

  var type = $("#typevalue").val();

  $.ajax({
    type: "POST",
    url: "./requiredFiles/ajax/rankingboardAjax.php",
    data: {
      way: "typesearch",
      type: type,
    },
    success: function (res) {
      var response = JSON.parse(res);

      if (response.status === "success") {

        if ($.fn.DataTable.isDataTable("#myTable")) {
          rankingTable.clear().destroy();
        }

        if (response.tabledata.length > 0) {
          $("#tabledata").html(response.tabledata);

          rankingTable = new DataTable("#myTable", {
            ordering: false,
            pageLength: 10,
          });
        } else {
          $("#tabledata").html(
            "<tr><td colspan='5'>No Data Found</td></tr>"
          );
        }
      }
    },
  });
});


const lvl1reward = (button) => {
  var userid = $(button).attr("userid");

  // Display the confirmation dialog
  var userConfirmed = window.confirm("Are you sure you want to Grant a Award?");

  // If the user clicked "Yes", userConfirmed will be true
  if (userConfirmed) {
    $.ajax({
      type: "POST",
      url: "./requiredFiles/ajax/rankingboardAjax.php",
      data: {
        way: "awardlvl1",
        userid: userid,
      },
      success: function (res) {
        $("#pagination").empty();
        var response = JSON.parse(res);
        if (response.status == "success") {
          // Call getData() on success
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
      error: function (err) {
        console.error("An error occurred:", err);
      },
    });
  }
};

const lvl2reward = (button) => {
  var userid = $(button).attr("userid");

  // Display the confirmation dialog
  var userConfirmed = window.confirm("Are you sure you want to Grant a Award?");

  // If the user clicked "Yes", userConfirmed will be true
  if (userConfirmed) {
    $.ajax({
      type: "POST",
      url: "./requiredFiles/ajax/rankingboardAjax.php",
      data: {
        way: "awardlvl2",
        userid: userid,
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

const lvl3reward = (button) => {
  var userid = $(button).attr("userid");

  var userConfirmed = window.confirm("Are you sure you want to Grant a Award?");

  // If the user clicked "Yes", userConfirmed will be true
  if (userConfirmed) {
    $.ajax({
      type: "POST",
      url: "./requiredFiles/ajax/rankingboardAjax.php",
      data: {
        way: "awardlvl3",
        userid: userid,
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

const lvl4reward = (button) => {
  var userid = $(button).attr("userid");

  var userConfirmed = window.confirm("Are you sure you want to Grant a Award?");

  // If the user clicked "Yes", userConfirmed will be true
  if (userConfirmed) {
    $.ajax({
      type: "POST",
      url: "./requiredFiles/ajax/rankingboardAjax.php",
      data: {
        way: "awardlvl4",
        userid: userid,
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

const lvl5reward = (button) => {
  var userid = $(button).attr("userid");

  var userConfirmed = window.confirm("Are you sure you want to Grant a Award?");

  // If the user clicked "Yes", userConfirmed will be true
  if (userConfirmed) {
    $.ajax({
      type: "POST",
      url: "./requiredFiles/ajax/rankingboardAjax.php",
      data: {
        way: "awardlvl5",
        userid: userid,
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

const lvl6reward = (button) => {
  var userid = $(button).attr("userid");

  var userConfirmed = window.confirm("Are you sure you want to Grant a Award?");

  // If the user clicked "Yes", userConfirmed will be true
  if (userConfirmed) {
    $.ajax({
      type: "POST",
      url: "./requiredFiles/ajax/rankingboardAjax.php",
      data: {
        way: "awardlvl6",
        userid: userid,
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

const lvl7reward = (button) => {
  var userid = $(button).attr("userid");

  var userConfirmed = window.confirm("Are you sure you want to Grant a Award?");

  // If the user clicked "Yes", userConfirmed will be true
  if (userConfirmed) {
    $.ajax({
      type: "POST",
      url: "./requiredFiles/ajax/rankingboardAjax.php",
      data: {
        way: "awardlvl7",
        userid: userid,
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

$("#rewardForm").on("submit", function (e) {
  e.preventDefault();

  const formData = new FormData(this); // "this" refers to the form element

  $.ajax({
    type: "POST",
    url: "./requiredFiles/ajax/rankingboardAjax.php",
    data: formData,
    contentType: false, // Important for FormData
    processData: false, // Prevent jQuery from converting the data
    success: function (res) {
      var response = JSON.parse(res);
      if (response.status === "success") {
        new Notify({
          status: "success",
          title: "Award Details",
          text: "Award Details Updated...!",
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
        return getAwards();
      } else if (
        response.status === "auth_failed" &&
        response.message === "Expired token"
      ) {
        location.replace("time_expried.php");
      } else if (response.status === "auth_failed") {
        location.replace("unauth_login.php");
      }
    },
  });
});
