jQuery(document).ready(function ($) {
    // Opens the lightbox on clicking the fullscreen icon
    $('.open-lightbox-trigger').on('click', function (e) {
        e.preventDefault();
        $('#lightbox-gallery').css('display', 'block');

        const imageUrl = $(this).find('img').attr('data-image');
        console.log('Image URL:', imageUrl); // Debugging line to verify data-image attribute
        $('#lightbox-image').attr('src', imageUrl);

        currentIndex = $(this).index('.open-lightbox-trigger');
    });

    // Closes the lightbox on clicking the close button or the lightbox background
    $('.close-lightbox, #lightbox-gallery').on('click', function (e) {
        $('#lightbox-gallery').css('display', 'none');
    });

    // Prevents the lightbox content from closing when clicking inside it
    $('.lightbox-content').on('click', function (e) {
        e.stopPropagation();
    });

    /*IMAGES*/
    let currentIndex = 0;
    const images = $('.open-lightbox-trigger');

    // Navigate to the next image
    $('.arrow-right').on('click', function () {
        currentIndex = (currentIndex + 1) % images.length;
        updateLightboxImage();
    });

    // Navigate to the previous image
    $('.arrow-left').on('click', function () {
        currentIndex = (currentIndex - 1 + images.length) % images.length;
        updateLightboxImage();
    });

    function updateLightboxImage() {
        const currentImage = images.eq(currentIndex);
        const imageUrl = currentImage.find('img').attr('data-image');
        console.log('Navigated Image URL:', imageUrl); // Debugging line to verify data-image attribute
        $('#lightbox-image').attr('src', imageUrl);
    }

    // Optional: Add lightbox functionality for .webp links
    $('a[href$=".webp"]').on('click', function (e) {
        e.preventDefault();
        $('#lightbox-gallery').css('display', 'block');

        const imageUrl = $(this).attr('href');
        console.log('WEBP Image URL:', imageUrl); // Debugging line to verify href attribute
        $('#lightbox-image').attr('src', imageUrl);
    });
});
