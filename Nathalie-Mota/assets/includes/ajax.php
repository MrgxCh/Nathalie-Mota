<!--CONTENT: PAGINATION INFINIE-->
<?php
function load_more_posts()
{
    $page = $_GET['page'];

    $args_custom_posts = array(
        'post_type' => 'photo', // CPU UI post nom
        'posts_per_page' => 8,
    );

    // Vérification des paramètres de catégorie et de format dans la requête GET
    if (
        $_GET['category'] != NULL &&
        $_GET['category'] != 'ALL' &&
        $_GET['format'] != NULL &&
        $_GET['format'] != 'ALL'
    ) {
        // Si à la fois la catégorie et le format sont spécifiés, nous créons une requête complexe (opérateur logique "ET")
        $args_custom_posts['tax_query'] = array(
            'relation' => 'AND',
            array(
                'taxonomy' => 'categorie_photo',
                'field' => 'slug',
                'terms' => $_GET['category']
            ),
            array(
                'taxonomy' => 'format',
                'field' => 'slug',
                'terms' => $_GET['format']
            )
        );
    } else {
        if (
            $_GET['category'] != NULL &&
            $_GET['category'] != 'ALL'
        ) {
            $args_custom_posts['tax_query'] = array(
                array(
                    'taxonomy' => 'categorie_photo',
                    'field' => 'slug',
                    'terms' => $_GET['category']
                )
            );
        }
        if (
            $_GET['format'] != NULL &&
            $_GET['format'] != 'ALL'
        ) {
            $args_custom_posts['tax_query'] = array(
                array(
                    'taxonomy' => 'format',
                    'field' => 'slug',
                    'terms' => $_GET['format']
                )
            );
        }
    }
    $args_custom_posts['orderby'] = 'date';
    $args_custom_posts['order'] = $_GET['dateSort'] != 'ALL' ? $_GET['dateSort'] : 'DESC';
    $args_custom_posts['paged'] = $page;

    $custom_posts_query = new WP_Query($args_custom_posts); // Obtient publications personnalisé

    if ($custom_posts_query->have_posts()) {
        while ($custom_posts_query->have_posts()):
            $custom_posts_query->the_post();

            ?>
            <div class="article-container">
                <a href="<?php the_permalink(); ?>">
                    <?php if (has_post_thumbnail()): ?>
                        <div class="photos-container">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail(); ?>
                         
                                <div class="thumbnail-overlay">
                                    <img src="<?php echo get_template_directory_uri(); ?>/images/icon_eye.png"
                                        alt="Icône de l'œil"> 
                                    <i class="fas fa-expand-arrows-alt fullscreen-icon"></i>
                                    <?php
                                 
                                    $related_reference_photo = get_field('reference_photo');
                                    $related_categories = get_the_terms(get_the_ID(), 'categorie');
                                    $related_category_names = array();

                                    if ($related_categories) {
                                        foreach ($related_categories as $category) {
                                            $related_category_names[] = esc_html($category->name);
                                        }
                                    }
                                    ?>
                                    <div class="photo-info">
                                        <div class="photo-info-left">
                                            <p><?php echo esc_html($related_reference_photo); ?></p>
                                        </div>
                                        <div class="photo-info-right">
                                            <p><?php echo implode(', ', $related_category_names); ?></p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php endif; ?>
                </a>
            </div>
            <?php

        endwhile;
        wp_reset_postdata(); 
    } else {
        // Aucun autre article à charger
    }
    die();
}

add_action('wp_ajax_load_more_posts', 'load_more_posts'); 
add_action('wp_ajax_nopriv_load_more_posts', 'load_more_posts'); 