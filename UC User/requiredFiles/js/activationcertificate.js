$(document).ready(() => {

    $.ajax({
        type: "POST",
        url: "./requiredFiles/ajax/indexAjax.php",
        data: {
            "way": "login"
        },
        success: function (res) {
            var response = JSON.parse(res);

            if (response.status == "auth_failed" && response.message == "Expired token") {

                location.replace("time_expried.php");

            } else if (response.status == "auth_failed") {

                location.replace("unauth_login.php");

            } else if (response.status == "success") {
                $('#generateCertificate').on('click', function () {
                    $("#generateCertificate").html("Loading ...");
              
                    var currentUrl = window.location.href;
              
                  // Use the URL constructor to parse the URL
                  var url = new URL(currentUrl);
              
                  // Get the search params (query string) from the URL
                  var searchParams = url.searchParams;
              
                  // Get the value of the certificateid parameter
                  var certificateId = searchParams.get('certificateid');
                    
              
                    // Convert SVG to PNG
                    var svgElement = document.getElementById('certificate');
                    var svgData = new XMLSerializer().serializeToString(svgElement);
                    var canvas = document.createElement('canvas');
                    var ctx = canvas.getContext('2d');
                    var img = new Image();
              
                    img.onload = function () {
                      canvas.width = img.width;
                      canvas.height = img.height;
                      ctx.drawImage(img, 0, 0);
              
                      // Create a link element to download the image
                      var link = document.createElement('a');
                      link.download = 'Independent Distributor Certificate.png';
                      link.href = canvas.toDataURL('image/png');
                      link.click();
                    };
              
                    img.src = 'data:image/svg+xml;base64,' + btoa(unescape(encodeURIComponent(svgData)));

                    $("#generateCertificate").html("Download Certificate");
              
                  });
            }
        }
    });   


});
