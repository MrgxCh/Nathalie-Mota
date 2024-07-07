<?php function load_more_posts() {
    $response = array(
        'success' => false,
        'data' => '',
        'message' => '',
    );

    try {
        $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
        $category = isset($_GET['category']) ? sanitize_text_field($_GET['category']) : 'ALL';
        $format = isset($_GET['format']) ? sanitize_text_field($_GET['format']) : 'ALL';
        $dateSort = isset($_GET['dateSort']) ? sanitize_text_field($_GET['dateSort']) : 'DESC';

        $args_custom_posts = array(
            'post_type' => 'photo', // Nom publications
            'posts_per_page' => 8, //8 articles en plus
            'paged' => $page,
            'orderby' => 'date',
            'order' => $dateSort != 'ALL' ? $dateSort : 'DESC',
        );

        if ($category != 'ALL' || $format != 'ALL') {
            $tax_query = array('relation' => 'AND');

            if ($category != 'ALL') {
                $tax_query[] = array(
                    'taxonomy' => 'categorie_photo',
                    'field' => 'slug',
                    'terms' => $category
                );
            }

            if ($format != 'ALL') {
                $tax_query[] = array(
                    'taxonomy' => 'format',
                    'field' => 'slug',
                    'terms' => $format
                );
            }

            $args_custom_posts['tax_query'] = $tax_query;
        }

        $custom_posts_query = new WP_Query($args_custom_posts);

        ob_start();

        //Container pour articles, affiche les 8 derniers articles
        if ($custom_posts_query->have_posts()) :
            while ($custom_posts_query->have_posts()) :
                $custom_posts_query->the_post();
                ?>
                <div class="article-container">
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="photos-container">
                            <?php the_post_thumbnail(); ?>
                            <!-- Section | hover lightbox -->
                            <?php $post_id = get_the_ID(); ?>

                            <div class="thumbnail-overlay">

                                <div class="icon-eye">
                                    <a href="<?php the_permalink(); ?>">
                                        <img src="<?php echo get_template_directory_uri() . "/images/icon_eye.png"; ?>" alt="icon-oeil">
                                    </a>
                                </div>

                                <!-- trigger open lightbox -->

                                <div class="icon-fullscreen open-lightbox-trigger">
                                    <img class="zoom lightbox-photo" src="<?php echo get_template_directory_uri() . '/images/icon-fullscreen.png'; ?>" data-image="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'full')); ?>">
                                </div>

                                <?php
                                // Get image title and category
                                $titre_photo = get_the_title($post_id); // Title of the photo
                                $categories_photo = get_the_terms(get_the_ID(), 'categorie_photo'); // Category of the photo 
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
                        </div>
                    <?php endif; ?>
                </div>
            <?php
            endwhile;
            $response['success'] = true;//Affiche les posts
        else :
            $response['message'] = 'No more posts';//Message erreur
        endif;

        $response['data'] = ob_get_clean();
    } catch (Exception $e) {
        $response['message'] = $e->getMessage();
    }

    wp_send_json($response);
    wp_die();
}

add_action('wp_ajax_load_more_posts', 'load_more_posts');
add_action('wp_ajax_nopriv_load_more_posts', 'load_more_posts');?>

