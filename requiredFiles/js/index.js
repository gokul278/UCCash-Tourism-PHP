$(document).on("submit", ".emailsubmit", function (e) {
  e.preventDefault();

  const form = this;
  const formId = form.dataset.formid;

  const phoneInput = window.intlTelInputGlobals.getInstance(
    document.querySelector(`#phone_${formId}`)
  );
  const whatsappInput = window.intlTelInputGlobals.getInstance(
    document.querySelector(`#whatsno_${formId}`)
  );

  form.querySelector(`#phone_country_${formId}`).value =
    phoneInput.getSelectedCountryData().dialCode;
  form.querySelector(`#whatsno_country_${formId}`).value =
    whatsappInput.getSelectedCountryData().dialCode;

  $(`#submitbtn_${formId}`).html("Loading...");

  const frmdata = new FormData(form);

  $.ajax({
    type: "POST",
    url: "./requiredFiles/ajax/indexAjax.php",
    data: frmdata,
    processData: false,
    contentType: false,
    cache: false,
    success: function (res) {
      const response = JSON.parse(res);

      if (
        response.status === "auth_failed" &&
        response.message === "Expired token"
      ) {
        location.replace("time_expried.php");
      } else if (response.status === "auth_failed") {
        location.replace("unauth_login.php");
      } else if (response.status === "success") {
        form.reset();
        $(`#submitbtn_${formId}`).html("Send Details to Contact Us");
        $(`#exampleModal${formId}`).modal("hide");
        swal({
          title: "Thank You!",
          text: "Your Details Were Submitted and We Will Contact You Soon!",
          icon: "success",
          button: "Close",
        });
      }
    },
  });
});
