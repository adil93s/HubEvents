/*Navbar responsive*/
$(document).ready(function () {
  const menuHamburger = document.querySelector(".checkbox");
  const navLinks = document.querySelector(".nav");

  menuHamburger.addEventListener("click", () => {
    navLinks.classList.toggle("mobile-menu");
    if (navLinks.classList.contains("mobile-menu")) {
      $("body").addClass("stop-scrolling");
      $("body").bind("touchmove", function (e) {
        e.preventDefault();
      });
      $("main").css("filter", "blur(8px)");
    } else {
      $("body").removeClass("stop-scrolling");
      $("body").unbind("touchmove");
      $("main").css("filter", "none");
    }
  });
});

/*Function edit logo*/
let loadFile = function (event) {
  let image = document.querySelector(".profile img");
  image.src = URL.createObjectURL(event.target.files[0]);
  document.getElementById("form_image").submit();
};

let loadFileAssociation = function (event) {
  let image = document.querySelector(".avatar img");
  let banner = document.querySelector(".page-header img");
  image.src = URL.createObjectURL(event.target.files[0]);
  banner.src = URL.createObjectURL(event.target.files[0]);
  document.getElementById("form_image").submit();
};
