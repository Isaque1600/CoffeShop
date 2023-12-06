$(document).ready(function () {
  $(".cart-icon").on("click", function () {
    $(".cart-sidebar").css("display", "grid");
  });

  $(".cart-close").on("click", function () {
    $(".cart-sidebar").css("display", "none");
  });
});
