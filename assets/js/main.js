$(document).ready(function () {
  $("body").on("click", function () {
    if ($(".popUp-content").is(":not(:hover)")) {
      $(".popUp").fadeOut("fast", function () {
        $(".popUp").css("display", "none");
      });
    }
  });

  $(".popUp-close").on("click", function () {
    $(".popUp").fadeOut("fast", function () {
      $(".popUp").css("display", "none");
    });
  });
});
