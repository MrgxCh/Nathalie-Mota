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


//MODAL CONTACT - MOBILE MENU
//MODALE CONTACT

const mobileModal = document.getElementById('myModal');
const mobileBtn = document.getElementById("menu-item-363");
const mobileSpan = document.getElementsByClassName("close")[0];

mobileBtn.onclick = function () {
  mobileModal.style.display = "block";
}

mobileSpan.onclick = function () {
  mobileModal.style.display = "none";
}

window.onclick = function (event) {
  if (event.target == modal) {
    mobileModal.style.display = "none";
  }
}

// MODAL CONTACT - SINGLE-PHOTO
const photomodal = document.getElementById('myModal');
const photoBtn = document.getElementById('button-contact-photo');
const photoSpan = document.getElementsByClassName("close")[0];

photoBtn.onclick = function () {
  photomodal.style.display = "block";
};

photoSpan.onclick = function () {
  photomodal.style.display = "none";
};

//Récupere l'id reference quand boutton contact est cliqué
jQuery(document).ready(function ($) {
  var refPhotoValue = photoBtn.dataset.reference;
  $("#refPhoto").val(refPhotoValue);
});

window.onclick = function (event) {
  if (event.target == modal) {
    photomodal.style.display = "none";
  }
};

//HOVER SINGLE PHOTO | NAVIGATION
document.addEventListener('DOMContentLoaded', function() {
  // Sélection des éléments de navigation
  const arrowLeft = document.querySelector('.navigation-prev');
  const imageLeft = document.querySelector('.image-prev');
  const arrowRight = document.querySelector('.navigation-next');
  const imageRight = document.querySelector('.image-next');

  // Événement mouseenter pour afficher l'image au survol
  arrowLeft.addEventListener('mouseenter', function() {
      imageLeft.style.display = 'flex';
  });

  arrowRight.addEventListener('mouseenter', function() {
    imageRight.style.display = 'flex';
});

  // Événement mouseleave pour cacher l'image lorsque le survol est terminé
  arrowLeft.addEventListener('mouseleave', function() {
      imageLeft.style.display = 'none';
  });

  arrowRight.addEventListener('mouseleave', function() {
    imageRight.style.display = 'none';
});
});



//RESPONSIVE MOBILE: menu burger

function Open(x) {
  x.classList.toggle("change");

  var navx = document.getElementsByClassName("nav")[0];
  if (navx.style.display === "block") {
    navx.style.display = "none";
  } else {
    navx.style.display = "block";
  }
}




