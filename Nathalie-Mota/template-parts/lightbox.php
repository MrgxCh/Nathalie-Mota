<?php $id = get_the_ID(); ?>

<!-- Trigger to open the lightbox -->

<div id="lightbox-gallery" class="lightbox-overlay">
    <span class="close-lightbox">&times;</span>
    <div class="lightbox-content">
        <img src="" alt="lightbox-image" id="lightbox-image">

        <!-- Lightbox infos -->
        <div class="lightbox-infos">
            <p class="lightbox-reference"><?php echo get_field('reference', get_the_ID()); ?></p>
            <p class="lightbox-categorie"><?php echo strip_tags(get_the_term_list(get_the_ID(), 'categorie_photo')); ?></p>
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