//MODALE CONTACT

const modal = document.getElementById('myModal');
const btn = document.getElementById("menu-item-88");
const span = document.getElementsByClassName("close")[0];

btn.onclick = function () {
  modal.style.display = "block";
}

span.onclick = function () {
  modal.style.display = "none";
}

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
