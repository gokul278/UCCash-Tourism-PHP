const clearerror = () => {
    $("#errorshow").html("")
}

$("#forgetpass").submit((event) => {
    event.preventDefault();
    $("#forgetbtn").html('<button type="text" class="btn btn-primary py-3 w-100 mb-4">Loading ...</button>')
    var userid = $("#userid").val();

    $.ajax({
        type: "POST",
        url: "./requiredFiles/ajax/forgetpasswordAjax.php",
        data: {
            "way": "forgetPassword",
            "userid": userid
        },
        success: function (res) {
            const response = JSON.parse(res);
            if (response.status === "success") {
                $("#userid").val("")
                $("#errorshow").html('<p style="background-color: #66e0ac;color:white; padding:10px;border-radius:10px" align="center">' + response.message + '</p>')
                $("#forgetbtn").html('<button type="button" class="btn btn-primary py-3 w-100 mb-4"> Send Mail </button>')
                new Notify({
                    status: 'success',
                    title: 'Mail Sended',
                    text: 'Forget Mail Sended SuccessFully !',
                    effect: 'slide',
                    speed: 300,
                    customClass: '',
                    customIcon: '',
                    showIcon: true,
                    showCloseButton: true,
                    autoclose: true,
                    autotimeout: 3000,
                    notificationsGap: null,
                    notificationsPadding: null,
                    type: 'filled',
                    position: 'right top',
                    customWrapper: '',
                })
            } else if (response.status === "failed") {
                $("#errorshow").html('<p style="background-color: red;color:white; padding:10px;border-radius:10px" align="center">' + response.message + '</p>')
                $("#forgetbtn").html('<button type="submit" class="btn btn-primary py-3 w-100 mb-4">Send Mail</button>');
            }
        }
    });
})