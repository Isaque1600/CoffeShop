$(document).ready(function () {
  $("#date").inputmask("datetime", {
    inputFormat: "dd/mm/yyyy",
    placeholder: " ",
    showMaskOnHover: false,
    showMaskOnFocus: false,
    clearIncomplete: true,
    clearMaskOnLostFocus: true,
    jitMasking: true,
  });
});
