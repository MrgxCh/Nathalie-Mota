<?php function load_more_posts()
{
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
        if ($custom_posts_query->have_posts()):
            while ($custom_posts_query->have_posts()):
                $custom_posts_query->the_post();
                ?>
                <div class="article-container">
                    <?php if (has_post_thumbnail()): ?>
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
                                    <img class="zoom lightbox-photo"
                                        src="<?php echo get_template_directory_uri() . '/images/icon-fullscreen.png'; ?>"
                                        data-image="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'full')); ?>">
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
                <script>
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

                </script>
                <?php
            endwhile;
            $response['success'] = true;//Affiche les posts
        else:
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
add_action('wp_ajax_nopriv_load_more_posts', 'load_more_posts'); ?>