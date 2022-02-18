
let input = document.querySelector('.searchInput');

document.querySelector(".searchButton").addEventListener("click", buttonPressed);

input.addEventListener("keyup", function(event) {
  if (event.keyCode === 13) {
   event.preventDefault();
   buttonPressed();
  }
});

function buttonPressed() {
    if(!input.value==""){
        window.location="searchPage.php?search="+input.value;

    }
   
  }