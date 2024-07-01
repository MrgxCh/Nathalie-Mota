//MODALE CONTACT

const modal = document.getElementById('myModal');
// Get the button that opens the modal
const btn = document.getElementById("menu-item-88");
// Get the <span> element that closes the modal
const span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function () {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function () {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function (event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
// MODAL CONTACT - SINGLE-PHOTO
const photomodal = document.getElementById('myModal');
const photoBtn = document.getElementById("button-contact-photo");
const photoSpan = document.getElementsByClassName("close")[0];

photoBtn.onclick = function () {
  photomodal.style.display = "block";
}
photoSpan.onclick = function () {
  photomodal.style.display = "none";
}

//Récupere l'id reference quand boutton contact est cliqué
jQuery(document).ready(function ($) {
  var refPhotoValue = photoBtn.dataset.reference;
  $("#refPhoto").val(refPhotoValue);
});

window.onclick = function (event) {
  if (event.target == modal) {
    photomodal.style.display = "none";
  }
}


//RESPONSIVE MOBILE: menu burger

function showResponsiveMenu() {
  var icon = document.getElementsByClassName("navigation");
  var root = document.getElementsByClassName("MenuBurger");
  if (menu.className === "") {
    menu.className = "open";
    icon.className = "open";
    root.style.overflowY = "hidden";
  } else {
    menu.className = "";
    icon.className = "";
    root.style.overflowY = "";
  }
}
