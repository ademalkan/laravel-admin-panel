//  Preloader
jQuery(window).on("load", function () {
  $("#preloader").fadeOut(500);
  $("#main-wrapper").addClass("show");
});

(function ($) {
  "use strict";

  //to keep the current page active
  $(function () {
    for (
      var nk = window.location,
        o = $(".settings-menu a, .menu a")
          .filter(function () {
            return nk.href.includes(this.href);
          })
          .addClass("active")
          .parent()
          .addClass("active");
      ;

    ) {
      // console.log(o)
      if (!o.is("li")) break;
      o = o.parent().addClass("show").parent().addClass("active");
    }
  });

  $('[data-toggle="tooltip"]').tooltip();
})(jQuery);

(function () {
  let onpageLoad = localStorage.getItem("theme");
  let element = document.body;
  onpageLoad && element.classList.add(onpageLoad);
})();

function themeToggle() {
  let element = document.body;
  element.classList.toggle("dark-theme");

  let theme = localStorage.getItem("theme");

  if (theme && theme === "dark-theme") {
    localStorage.setItem("theme", "");
  } else {
    localStorage.setItem("theme", "dark-theme");
  }
}

// Copy
function myFunction() {
  /* Get the text field */
  var copyText = document.getElementById("myInput");

  /* Select the text field */
  copyText.select();
  copyText.setSelectionRange(0, 99999); /* For mobile devices */

  /* Copy the text inside the text field */
  navigator.clipboard.writeText(copyText.value);

  /* Alert the copied text */
  alert("Copied the text: " + copyText.value);
}
