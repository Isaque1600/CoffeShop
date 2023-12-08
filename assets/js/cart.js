$(document).ready(function () {
  $(".open-cart").on("click", function () {
    $(".cart-sidebar").css("display", "grid");
  });

  $(".close-cart").on("click", function () {
    $(".cart-sidebar").css("display", "none");
  });

  $(".addcart").on("click", function () {
    path = location.href.split("/");
    path.pop();
    path.pop();
    url = "";
    for (const element of path) {
      url += element + "/";
      if (element == "CoffeShop") {
        break;
      }
    }

    // console.log($(this).attr("name"));
    location.href = url + "Cardapio/addcart?name=" + $(this).attr("name");
  });

  $(".trash").on("click", function () {
    path = location.href.split("/");
    path.pop();
    path.pop();
    url = "";
    for (const element of path) {
      url += element + "/";
      if (element == "CoffeShop") {
        break;
      }
    }

    location.href = url + "Cardapio/removecart?name=" + $(this).attr("name");
  });
});
