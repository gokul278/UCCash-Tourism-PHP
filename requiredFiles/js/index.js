$(document).ready(function () {

    $.ajax({
        type: "POST",
        url: "./requiredFiles/ajax/indexAjax.php",
        data: {
            "way" : "getflashbanner"
        },
        success: function (res) {
            var response = JSON.parse(res);
            if(response.status == "success"){
                $("#flashbanner").attr("src", "./img/flashbanner/" + response.flashbanner+"");
                var myModal = new bootstrap.Modal(document.getElementById('exampleModal'));
                myModal.show();
            }
        }
    });

});