$(document).ready(() => {
    $.ajax({
        type: "POST",
        url: "./requiredFiles/ajax/tourdestinationeditAjax.php",
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

    document.querySelectorAll('.image-upload-model').forEach(model => {
        model.addEventListener('change', function (event) {
            if (event.target.classList.contains('file-input')) {
                const input = event.target;
                const span = input.nextElementSibling.nextElementSibling;
                span.textContent = input.files.length > 0 ? input.files[0].name : '';
            }
        });

        model.querySelectorAll('.file-label').forEach(label => {
            label.addEventListener('click', function () {
                const input = label.previousElementSibling;
                input.click();
            });
        });
    });


    $("#newdestination").submit(function (e) {
        e.preventDefault();


        $("#addbtn").html('<strong style="color: #000;">Loading ..</strong>');

        var frm = $("#newdestination")[0];
        var frmdata = new FormData(frm);
        $.ajax({
            type: "POST",
            url: "./requiredFiles/ajax/tourdestinationeditAjax.php",
            data: frmdata,
            processData: false,
            contentType: false,
            cache: false,
            success: function (res) {
                var response = JSON.parse(res);

                if (response.status == "auth_failed" && response.message == "Expired token") {

                    location.replace("time_expried.php");

                } else if (response.status == "auth_failed") {

                    location.replace("unauth_login.php");

                } else if (response.status == "success") {

                    location.reload();
                }
            }
        });


    });

});

const getData = () => {

    $.ajax({
        type: "POST",
        url: "./requiredFiles/ajax/tourdestinationeditAjax.php",
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

                if (response.tabledata.length >= 1) {
                    $("#tabledata").html(response.tabledata);
                } else {
                    $("#tabledata").html("<tr><th colspan='8'>No Data Found</th></tr>");
                }

            } else if (response.status == "auth_failed" && response.message == "Expired token") {

                location.replace("time_expried.php");

            } else if (response.status == "auth_failed") {

                location.replace("unauth_login.php");

            }
        }
    });

}


const addtextbox = (id) => {

    var boxid = $(id).attr('boxid');
    var max = parseInt($(id).attr('max'));
    max += 1;

    $("#textboxes" + boxid).append(`
        <div class="form-group mb-2" id="box`+ boxid + `` + max + `">
            <label for="days`+ boxid + `` + max + `">Day ` + max + `</label>
            <textarea class="form-control day-1-textbox"
                name="days`+ max + `" id="days` + boxid + `` + max + `" placeholder=""
                style="height: 100px;"></textarea>
        </div>
    `);

    $(id).attr('max', max);

}

const removetextbox = (id) => {

    var boxid = $(id).attr('boxid');
    var max = parseInt($("#textboxbtn" + boxid).attr('max'));

    if (max != 1) {

        $("#box" + boxid + max).remove();
        max -= 1;
        $("#textboxbtn" + boxid).attr('max', max);

    }

}


const updatetour = (id) => {


    var tourid = $(id).attr('tourid');
    $("#updatebtn" + tourid).html('<strong style="color: #000;">Loading ..</strong>')

    var frm = $("#updatedestination" + tourid)[0];
    var frmdata = new FormData(frm);
    $.ajax({
        type: "POST",
        url: "./requiredFiles/ajax/tourdestinationeditAjax.php",
        data: frmdata,
        processData: false,
        contentType: false,
        cache: false,
        success: function (res) {
            var response = JSON.parse(res);

            if (response.status == "auth_failed" && response.message == "Expired token") {

                location.replace("time_expried.php");

            } else if (response.status == "auth_failed") {

                location.replace("unauth_login.php");

            } else if (response.status == "success") {

                location.reload();
            }
        }
    });

}




