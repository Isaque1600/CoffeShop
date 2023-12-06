$(document).ready(function () {
  $(".open-cart").on("click", function () {
    $(".cart-sidebar").css("display", "grid");
  });

  $(".close-cart").on("click", function () {
    $(".cart-sidebar").css("display", "none");
  });
});
