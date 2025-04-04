$(document).ready(() => {
  $.ajax({
    type: "POST",
    url: "./requiredFiles/ajax/idcardAjax.php",
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
    url: "./requiredFiles/ajax/idcardAjax.php",
    data: {
      way: "getData",
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

        $("#memberid").html(response.user_id);
        $("#memberphone").html(response.user_phoneno);
        $("#memberaddress").html(
          response.user_city + ", " + response.user_zipcode
        );

        $("#visitingCard").html(response.tabledata);

        JsBarcode("#barcode", response.user_id, {
          width: 4,
          height: 100,
        });

        $("#generateVistingCard").on("click", function () {
          $("#generateVistingCard").html("Loading ...");

          var currentUrl = window.location.href;

          // Use the URL constructor to parse the URL
          var url = new URL(currentUrl);

          // Get the search params (query string) from the URL
          var searchParams = url.searchParams;

          // Convert SVG to PNG
          var svgElement = document.getElementById("visitingcard");
          var svgData = new XMLSerializer().serializeToString(svgElement);
          var canvas = document.createElement("canvas");
          var ctx = canvas.getContext("2d");
          var img = new Image();

          img.onload = function () {
            canvas.width = img.width;
            canvas.height = img.height;
            ctx.drawImage(img, 0, 0);

            // Create a link element to download the image
            var link = document.createElement("a");
            link.download = "Visiting Card.png";
            link.href = canvas.toDataURL("image/png");
            link.click();
          };

          img.src =
            "data:image/svg+xml;base64," +
            btoa(unescape(encodeURIComponent(svgData)));

          $("#generateVistingCard").html("Download Visiting Card");
        });
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
