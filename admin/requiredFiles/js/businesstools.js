$(document).ready(function () {
  $.ajax({
    type: "POST",
    url: "./requiredFiles/ajax/businesstoolsAjax.php", // Corrected URL
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

function escapeJsString(str) {
  if (str === null || str === undefined) {
    return "";
  }
  // More robust escaping for use in HTML attributes or JS strings
  return String(str)
    .replace(/&/g, "&amp;")
    .replace(/</g, "&lt;")
    .replace(/>/g, "&gt;")
    .replace(/"/g, "&quot;")
    .replace(/'/g, "&#39;");
}

const getData = () => {
  $.ajax({
    type: "POST",
    url: "./requiredFiles/ajax/businesstoolsAjax.php", // Corrected URL
    data: {
      way: "getData",
    },
    success: function (res) {
      var response = JSON.parse(res);
      if (response.status == "success") {
        $(".adminname").html(response.admin_name);

        if (response.profile_image !== null) {
          $(".profile_image").attr(
            "src",
            "./img/user/" + response.profile_image
          );
        }

        var images = "";

        response.galleryimages.forEach((element, index) => {
          const descriptionText = element.description
            ? escapeJsString(element.description)
            : "N/A";
          const rawDescription = element.description ? element.description : "";
          images += `
                    <tr>
                        <th scope="row">${index + 1}</th>
                        <td><a target="_blanket" href="./img/businesstools/${
                          element.imagename
                        }">View</a></td>
                        <td>${descriptionText.replace(/\n/g, "<br>")}</td>
                        <td class="text-center">
                                <button type="button" class="btn btn-info btn-sm me-2" onclick="editDescriptionPrompt(${
                                  element.id
                                }, '${escapeJsString(
            rawDescription
          )}')"><b>Edit</b></button>
                                <button type="button" class="btn btn-danger btn-sm" onclick="imagedelete(${
                                  element.id
                                }, '${escapeJsString(
            element.imagename
          )}')" value="${element.imagename}"><b>Delete</b></button>
                        </td>
                    </tr>`;
        });

        if (images.length == 0) {
          $("#tableimage").html(`
                    <tr>
                        <th colspan='4'> No PDF </th>
                    </tr>`);
        } else {
          $("#tableimage").html(images);
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

$("#addimage").submit(function (e) {
  e.preventDefault();
  $("#uploadbtn").html("Loading");
  var frm = $("#addimage")[0];
  var frmdata = new FormData(frm);

  $.ajax({
    type: "POST",
    url: "./requiredFiles/ajax/businesstoolsAjax.php",
    data: frmdata,
    processData: false,
    contentType: false,
    cache: false,
    success: function (res) {
      var response = JSON.parse(res);
      if (response.status == "success") {
        $("#uploadbtn").prop("disabled", true);
        $("#uploadbtn").html("Upload");
        $("#formFileMultiple").val("");
        $("#imageDescription").val(""); // Clear description textarea
        var fileNameSpan = document.getElementById("fileName");
        fileNameSpan.textContent = "";

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
});

function editDescriptionPrompt(id, currentDescription) {
  const newDescription = prompt("Enter new description:", currentDescription);
  if (newDescription !== null && newDescription !== currentDescription) {
    // Check if user pressed cancel or description changed
    saveDescription(id, newDescription);
  }
}

function saveDescription(id, description) {
  $.ajax({
    type: "POST",
    url: "./requiredFiles/ajax/businesstoolsAjax.php", // Corrected URL
    data: {
      way: "updateDescription",
      id: id,
      description: description,
    },
    success: function (res) {
      var response = JSON.parse(res);
      if (response.status == "success" || response.status == "nochange") {
        // alert("Description updated successfully!"); // Optional: use a nicer notification
        getData(); // Refresh data
      } else if (
        response.status == "auth_failed" &&
        response.message == "Expired token"
      ) {
        location.replace("time_expried.php");
      } else if (response.status == "auth_failed") {
        location.replace("unauth_login.php");
      } else {
        alert(
          "Error updating description: " + (response.message || "Unknown error")
        );
      }
    },
    error: function () {
      alert("AJAX error: Could not update description.");
    },
  });
}

const imagedelete = (id, imageName) => {
  // Now accepts id and imageName
  if (
    !confirm(
      `Are you sure you want to delete the image "${imageName}"? This will also remove its description.`
    )
  ) {
    return;
  }

  $.ajax({
    type: "POST",
    url: "./requiredFiles/ajax/businesstoolsAjax.php",
    data: {
      way: "deleteimage",
      id: id,
      imagename: imageName,
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
};
