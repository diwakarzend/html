var header = document.getElementById("masthead");
var sticky = header.offsetTop;

function myFunction() {
  if (window.pageYOffset > sticky) {
    header.classList.add("header-sticky");
  } else {
    header.classList.remove("header-sticky");
  }
}