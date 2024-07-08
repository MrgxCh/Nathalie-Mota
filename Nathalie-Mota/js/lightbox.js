jQuery(document).ready(function ($) {
    var $lightboxCategory = $('.lightboxCategorie');
    var $lightboxReference = $('.lightboxReference');
    var currentIndex = 0;
    var images = $('.open-lightbox-trigger');

    // Ouvre la lightbox lorsqu'on clique sur l'icône fullscreen
    $('.open-lightbox-trigger').on('click', function (e) {
        e.preventDefault();
        $('#lightbox-gallery').css('display', 'block');

        const imageUrl = $(this).find('img').attr('data-image');
        $('#lightbox-image').attr('src', imageUrl);

        // Récupère les données de catégorie et référence
        var categoryText = $(this).find('img').data('category').toUpperCase();
        var referenceText = $(this).find('img').data('reference');

        // Met à jour les éléments HTML avec les valeurs récupérées
        $lightboxCategory.text(categoryText);
        $lightboxReference.text(referenceText);

        // Détermine l'index de l'image actuelle
        currentIndex = $(this).index('.open-lightbox-trigger');
    });

    // Ferme la lightbox en cliquant sur le bouton de fermeture (X) ou en dehors de la lightbox
    $('.close-lightbox, #lightbox-gallery').on('click', function (e) {
        $('#lightbox-gallery').css('display', 'none');
    });

    // Empêche la propagation du clic dans la lightbox
    $('.lightbox-content').on('click', function (e) {
        e.stopPropagation();
    });

    // Navigation vers l'image suivante lorsqu'on clique sur la flèche droite
    $('.arrow-right').on('click', function () {
        currentIndex = (currentIndex + 1) % images.length;
        updateLightboxImage();
    });

    // Navigation vers l'image précédente lorsqu'on clique sur la flèche gauche
    $('.arrow-left').on('click', function () {
        currentIndex = (currentIndex - 1 + images.length) % images.length;
        updateLightboxImage();
    });

    // Met à jour l'image et les informations de la lightbox
    function updateLightboxImage() {
        const currentImage = images.eq(currentIndex);
        const imageUrl = currentImage.find('img').attr('data-image');
        $('#lightbox-image').attr('src', imageUrl);

        var categoryText = currentImage.find('img').data('category').toUpperCase();
        var referenceText = currentImage.find('img').data('reference');

        $lightboxCategory.text(categoryText);
        $lightboxReference.text(referenceText);
    }

    // Gère les liens webp
    $('a[href$=".webp"]').on('click', function (e) {
        e.preventDefault();
        $('#lightbox-gallery').css('display', 'block');

        const imageUrl = $(this).attr('href');
        $('#lightbox-image').attr('src', imageUrl);

        var categoryText = $(this).find('img').data('category').toUpperCase();
        var referenceText = $(this).find('img').data('reference');

        $lightboxCategory.text(categoryText);
        $lightboxReference.text(referenceText);

        currentIndex = $(this).index('a[href$=".webp"]');
    });
});
