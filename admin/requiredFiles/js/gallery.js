$(document).ready(() => {
    $.ajax({
        type: "POST",
        url: "./requiredFiles/ajax/galleryAjax.php",
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
                return getData();
            }
        }
    });

});

const getData = () => {

    $.ajax({
        type: "POST",
        url: "./requiredFiles/ajax/galleryAjax.php",
        data: {
            "way": "getData"
        },
        success: function (res) {
            var response = JSON.parse(res);
            if (response.status == "success") {

                $(".adminname").html(response.admin_name);

                if (response.profile_image !== null) {
                    $(".profile_image").attr("src", "./img/user/" + response.profile_image);
                }

                var images = "";

                response.galleryimages.forEach((element,index) => {
                    images += `
                    <tr>
                        <th scope="row">`+(index+1)+`</th>
                        <td><img src="./img/gallery/`+element+`" style="width: 250px; height:200px;">
                        </td>
                        <td class="text-center">
                                <button type="button"
                                    class="btn btn-danger" onclick="imagedelete(this)" value="`+element+`"><b>Delete</b></button>
                        </td>
                    </tr>`
                });

                if(images.length == 0){
                    $("#tableimage").html(`
                    <tr>
                        <th colspan='3'> No Images </th>
                    </tr>`)
                }else{
                    $("#tableimage").html(images)
                }


            } else if (response.status == "auth_failed" && response.message == "Expired token") {

                location.replace("time_expried.php");

            } else if (response.status == "auth_failed") {

                location.replace("unauth_login.php");

            }
        }
    });

}

$("#addimage").submit(function (e) {
    e.preventDefault();

    var frm = $("#addimage")[0];
    var frmdata = new FormData(frm);

    $.ajax({
        type: "POST",
        url: "./requiredFiles/ajax/galleryAjax.php",
        data: frmdata,
        processData: false,
        contentType: false,
        cache: false,
        success: function (res) {
            var response = JSON.parse(res);
            if (response.status == "success") {

                $("#uploadbtn").prop("disabled", true);
                $("#formFileMultiple").val("");
                var fileNameSpan = document.getElementById('fileName');
                fileNameSpan.textContent = "";

                return getData();

            } else if (response.status == "auth_failed" && response.message == "Expired token") {

                location.replace("time_expried.php");

            } else if (response.status == "auth_failed") {

                location.replace("unauth_login.php");

            }
        }
    });

});


const imagedelete = (btn) =>{
    var imagename = $(btn).val();

    $.ajax({
        type: "POST",
        url: "./requiredFiles/ajax/galleryAjax.php",
        data: {
            "way" : "deleteimage",
            "imagename" : imagename
        },
        success: function (res) {
            var response = JSON.parse(res);
            if (response.status == "success") {

                return getData();

            } else if (response.status == "auth_failed" && response.message == "Expired token") {

                location.replace("time_expried.php");

            } else if (response.status == "auth_failed") {

                location.replace("unauth_login.php");

            }
        }
    });
}