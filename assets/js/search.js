$(document).ready(function () {
  $(".search-input").on("keypress", function (e) {
    if (e.which == 13) {
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
      location.href = url + "Cardapio/pesquisar?search=" + $(this).val();
    }
  });

  $("title").val();
});
