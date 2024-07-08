<!-- Trigger to open the lightbox -->

<div id="lightbox-gallery" class="lightbox-overlay">
    <span class="close-lightbox">&times;</span>
    <div class="lightbox-content">

        <!--Image url lightbox fullsreen-->
        <img src="" alt="lightbox-image" id="lightbox-image">

        <!--Categorie et reference-->
        <div class="lightbox-infos">
            <span class="lightboxReference"></span>
            <span class="lightboxCategorie"></span>
        </div>

        <!-- Next and previous arrows -->
        <div class="navigation-photo">
            <span class="arrow-left">
                <img src="<?php echo get_template_directory_uri() . '/images/left-arrow.png'; ?>" alt="Précédent">
                Précédent
            </span>
            <span class="arrow-right">
                Suivante
                <img src="<?php echo get_template_directory_uri() . '/images/arrow-right.png'; ?>" alt="Next">
            </span>
        </div>


    </div>
</div>