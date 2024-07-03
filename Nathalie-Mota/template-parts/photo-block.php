<!--CONTENT: BLOC PHOTOS ACCUEIL-->
<div class="liste-photos">
    <input type="hidden" name="page" value="1">
    <div class="gallerie">
        <?php
        $args_custom_posts = array(
            'post_type' => 'photo',
            'posts_per_page' => 8,
            'orderby' => 'date',
            'order' => 'DESC',
        );

        $custom_posts_query = new WP_Query($args_custom_posts);
        while ($custom_posts_query->have_posts()):
            $custom_posts_query->the_post();
            ?>
            <div class="article-container">
            <a href="<?php the_permalink(); ?>">
                <?php if (has_post_thumbnail()): ?>
                    <div class="photos-container">
                        <a href="<?php the_permalink(); ?>">
                            <?php the_post_thumbnail(); ?>
                            <!-- Section | Overlay Catalogue -->
                            <div class="thumbnail-overlay">
                                <img src="<?php echo get_template_directory_uri(); ?>/images/icon_eye.png" alt="Icône de l'œil">
                                <div class="icon-fullscreen">
                                <img src="<?php echo get_template_directory_uri(); ?>/images/icon-fullscreen.png" alt="Icone de fullscreen">
                                </div>
                                <?php
                                // Récupère la référence et la catégorie de l'image associée.
                                $reference_photo = get_field('reference'); //Reference de la photo
                                $categories = get_the_terms(get_the_ID(), 'categorie_photo'); //Categorie de la photo 
                                $category_names = array();

                                if ($categories) {
                                    foreach ($categories as $category) {
                                        $category_names[] = esc_html($category->name);
                                    }
                                }
                                ?>

                                <div class="photo-info">
                                    <div class="photo-info-left">
                                        <p><?php echo esc_html($reference_photo); ?></p>
                                    </div>
                                    <div class="photo-info-right">
                                        <p><?php echo implode(', ', $category_names); ?></p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endif; ?>
            </a>
            </div>
    <?php endwhile; ?>
</div>
    <?php wp_reset_postdata(); // Rétablir les données de publication d'origine ?>
<!-- Ajouter un lien pour afficher toutes les publications personnalisées -->
<div class="pagination-button">
    <button id="load-more">Charger plus</button>
</div>
</div>