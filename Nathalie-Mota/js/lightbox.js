jQuery(document).ready(function ($) {
    // Trigger la lightbox en cliquant sur icon fullscreen
    $('.open-lightbox-trigger').on('click', function (e) {
        e.preventDefault();
        $('#lightbox-gallery').css('display', 'block');

        const imageUrl = $(this).find('img').attr('data-image');
        console.log('Image URL:', imageUrl); // Vérifie l'attribut de data-image
        $('#lightbox-image').attr('src', imageUrl);

        currentIndex = $(this).index('.open-lightbox-trigger');
        updateLightboxInfos($(this)); // Update lightbox info
    });

    // Gestion de la fermeture de la lightbox en cliquant sur le bouton(span x)
    $('.close-lightbox, #lightbox-gallery').on('click', function (e) {
        $('#lightbox-gallery').css('display', 'none');
    });

    // Empêche la lightbox de se fermer en cliquant sur un élément de la lightbox
    $('.lightbox-content').on('click', function (e) {
        e.stopPropagation();
    });


    /*IMAGES*/
    let currentIndex = 0;
    const images = $('.open-lightbox-trigger');
   
    // Image suivante lorsqu'on clique sur la flèche droite
    $('.arrow-right').on('click', function () {
        currentIndex = (currentIndex + 1) % images.length;
        updateLightboxImage();
    });

    // Image précédente lorsqu'on clique sur la flèche gauche
    $('.arrow-left').on('click', function () {
        currentIndex = (currentIndex - 1 + images.length) % images.length;
        updateLightboxImage();
    });
    
    //Récupère image
    function updateLightboxImage() {
        const currentImage = images.eq(currentIndex);
        const imageUrl = currentImage.find('img').attr('data-image');
        console.log('Navigated Image URL:', imageUrl); // Vérifie l'attribut de data-image
        $('#lightbox-image').attr('src', imageUrl);

        updateLightboxInfos(currentImage); // Update lightbox inf
    }

    //Récupère catégorie et référence

    function updateLightboxImage() {
        const currentImage = images.eq(currentIndex);
        const imageUrl = currentImage.find('img').attr('data-image');
        const reference = currentImage.data('reference');
        const category = currentImage.data('category');
    
        console.log('Navigated Image URL:', imageUrl); // Debugging line
        console.log('Navigated Reference:', reference); // Debugging line
        console.log('Navigated Category:', category); // Debugging line
    
        $('#lightbox-image').attr('src', imageUrl);
    
        updateLightboxInfos(currentImage); // Update lightbox info
    }

    function updateLightboxInfos(element) {
        const reference = element.attr('data-reference');
        const category = element.attr('data-category');

        console.log('Reference:', reference); // Debugging line
        console.log('Category:', category);   // Debugging line

        $('.lightbox-reference').text(reference);
        $('.lightbox-categorie').text(category);
    }

    //Gère les liens webp
    $('a[href$=".webp"]').on('click', function (e) {
        e.preventDefault();
        $('#lightbox-gallery').css('display', 'block');

        const imageUrl = $(this).attr('href');
        console.log('WEBP Image URL:', imageUrl); // Vérifie le href de l'image
        $('#lightbox-image').attr('src', imageUrl);
    });
});
