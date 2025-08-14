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

        $(".user_id").html(response.user_id);
        $("#memberid").html(response.user_id);
        $("#memberphone").html(response.user_phoneno);
        $("#memberaddress").html(
          response.user_city + ", " + response.user_zipcode
        );

        $("#visitingCard").html(response.tabledata);

        // JsBarcode("#barcode", response.user_id, {
        //   width: 4,
        //   height: 100,
        // });

        var referralurl =
          "https://uccashtourism.com/signup.php?referral=" + response.user_id;

        var qrcode = new QRCode(document.getElementById("barcode"), {
          text: referralurl,
          width: 60,
          height: 60,
          colorDark: "#000000",
          colorLight: "#ffffff",
          correctLevel: QRCode.CorrectLevel.M,
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

function downloadIDCard() {
  const idCard = document.querySelector("#totalidcard");

  html2canvas(idCard, {
    scale: 3, // Increase this for higher quality (e.g., 3x resolution)
    useCORS: true, // Ensures external images are handled
  }).then((canvas) => {
    const link = document.createElement("a");
    link.download = "ID_Card.png";
    link.href = canvas.toDataURL("image/png");
    link.click();
  });
}

// const downloadVisitingCard = () => {
//   const element = document.getElementById("visitingCard"); // correct ID
//   if (!element || element.innerHTML.trim() === "") {
//     console.error("Visiting card element not found or empty");
//     return;
//   }

//   html2canvas(element, { scale: 5, useCORS: true }).then((canvas) => {
//     const imgData = canvas.toDataURL("image/png");
//     const pdf = new jsPDF("landscape", "mm", [89, 51]);
//     pdf.addImage(imgData, "PNG", 0, 0, 89, 51); // no negative offset
//     pdf.save("visiting-card.pdf");
//   });
// };


// const downloadVisitingCard = () => {
//   const element = document.getElementById("visitingcards");

//   const idCard = document.querySelector("#visitingcards");

//   html2canvas(idCard, {
//     scale: 3, // Increase this for higher quality (e.g., 3x resolution)
//     useCORS: true, // Ensures external images are handled
//   }).then((canvas) => {
//     const link = document.createElement("a");
//     link.download = "visitingcard.png";
//     link.href = canvas.toDataURL("image/png");
//     link.click();
//   });
// };

const downloadVisitingCard = () => {
  const { jsPDF } = window.jspdf;
  const idCard = document.getElementById("visitingcards");

  html2canvas(idCard, {
    scale: 5, // higher quality
    useCORS: true, // for external images
  }).then((canvas) => {
    const imgData = canvas.toDataURL("image/png");
    
    // Create jsPDF instance
    const pdf = new jsPDF({
      orientation: "landscape", // or "portrait"
      unit: "px",
      format: [canvas.width, canvas.height], // Match canvas size
    });

    // Add image to PDF
    pdf.addImage(imgData, "PNG", 0, 0, canvas.width, canvas.height);

    // Save PDF
    pdf.save("visitingcard.pdf");
  });
};
