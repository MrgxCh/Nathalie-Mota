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
                <?php if (has_post_thumbnail()): ?>
                    <div class="photos-container">
                        <?php the_post_thumbnail(); ?>
                        <!-- Section | Overlay Catalogue -->
                        <?php get_template_part('template-parts/lightbox');?>
                    </div>
                <?php endif; ?>
                </a>
            </div>
            <?php

        endwhile;
        wp_reset_postdata();
    } else {
    }
    wp_die(); // This is required to terminate immediately and return a proper response
}

add_action('wp_ajax_load_more_posts', 'load_more_posts');
add_action('wp_ajax_nopriv_load_more_posts', 'load_more_posts');