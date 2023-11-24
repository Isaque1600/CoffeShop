$(document).ready(function () {
  function addAnimation(scrollers) {
    scrollers.forEach((scroller) => {
      const scrollerInner = scroller.querySelector(".scroller__inner");
      const scrollerContent = Array.from(scrollerInner.children);

      scrollerContent.forEach((item) => {
        const duplicatedItem = item.cloneNode(true);
        duplicatedItem.setAttribute("aria-hidden", true);
        duplicatedItem.setAttribute("class", "showcase__content");
        scrollerInner.appendChild(duplicatedItem);
      });
    });
  }

  const scrollers = document.querySelectorAll(".scroller");

  addAnimation(scrollers);
});
