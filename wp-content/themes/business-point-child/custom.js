var header = document.getElementById("masthead");
var sticky = header.offsetTop;

function myFunction() {
  if (window.pageYOffset > sticky) {
    header.classList.add("header-sticky");
  } else {
    header.classList.remove("header-sticky");
  }
}

jQuery(".wpcf7-submit").click(function(){
  console.log(jQuery(".wpcf7-form").hasClass("invalid"));
  setTimeout(function(){
  if(jQuery(".wpcf7-form").hasClass("invalid")){
  jQuery(".wpcf7-form").scrollTop(300); 
  }
  },9000);
  });


