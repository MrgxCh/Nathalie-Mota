<?php $post_id = get_the_ID(); ?>


<div class="thumbnail-overlay">

    <div class="icon-eye">
        <a href="<?php the_permalink(); ?>">
            <img src="<?php echo get_template_directory_uri() . "/images/icon_eye.png"; ?>" alt="icon-oeil">
        </a>
    </div>
    <div class="icon-fullscreen">
    <a href="<?php echo $src = get_the_post_thumbnail_url($post_id, 'full' ); ?>">
            <img src="<?php echo get_template_directory_uri() . "/images/icon-fullscreen.png"; ?>"
                alt="icon-fullscreen">
        </a>
    </div>
    <?php
    // Récupère la référence et la catégorie de l'image associée.
    $titre_photo = get_the_title($post_id); //Titre de la photo
    $categories_photo = get_the_terms(get_the_ID(), 'categorie_photo'); //Categorie de la photo 
    $category_names = array();

    if ($categories_photo) {
        foreach ($categories_photo as $category) {
            $category_names[] = esc_html($category->name);
        }
    }
    ?>

    <div class="photo-info">
        <div class="photo-info-left">
            <p><?php echo esc_html($titre_photo); ?></p>
        </div>
        <div class="photo-info-right">
            <p><?php echo implode(', ', $category_names); ?></p>
        </div>
    </div>
</div>