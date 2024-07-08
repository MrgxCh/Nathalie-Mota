<?php $id = get_the_ID() ?>

<!-- Trigger to open the lightbox -->

<div id="lightbox-gallery" class="lightbox-overlay">
    <span class="close-lightbox">&times;</span>
    <div class="lightbox-content">
        <img src="" alt="lightbox-image" id="lightbox-image">

         <!-- Lightbox infos -->
         <div class="lightbox-infos">
            <p class="lightbox-reference"><?php echo get_field('reference', $id) ?></p>
            <p class="lightbox-categorie"><?php echo get_the_terms($id, 'categorie_photo')[0]->name  ?></p>
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