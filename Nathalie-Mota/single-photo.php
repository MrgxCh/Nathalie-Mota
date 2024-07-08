<?php
/*
 * 
 * Modèle de page : Photo unique.
 * Description : Modèle de page pour une photo unique. 
 * 
 * 
 */
get_header(); ?>

<div class="photo-content">

    <?php
    if (have_posts()):
        while (have_posts()):
            the_post(); ?>

            <div class="right-container">

                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                    <!-- Post image -->
                    <div class="photo-image">
                        <?php if (has_post_thumbnail()): ?>
                            <?php the_post_thumbnail('large'); ?>

                        <?php endif; ?>

                        <!-- Post Content -->
                        <?php the_content(); ?>
                    </div>
            </div>
            <!-- Post Metadata -->
            <div class="left-container">
                <div class="left-content">

                    <!-- Post Title -->
                    <div class="post">
                        <h2><?php the_title(); ?></h2>
                    </div>

                    <?php
                    // Référence de la photo
                    $reference = get_field('reference');
                    if ($reference) {
                        echo '<p>RÉFÉRENCE : <span id="ph-REFERENCE">' . esc_html($reference) . '</span></p>';
                    }
                    ; ?>

                    <!-- Display Categories-->
                    <?php
                    $post_id = get_the_ID(); // Recupere post id
                    $taxonomy = 'categorie_photo'; // ACF Taxonomy
            
                    $post_categories = get_the_terms($post_id, $taxonomy);

                    echo '<p>CATÉGORIES: ';
                    $category_names = array();
                    $category_ids = array();

                    foreach ($post_categories as $category) {
                        if (is_object($category) && isset($category->name)) {

                            if (!in_array($category->term_id, $category_ids)) {
                                $category_names[] = esc_html($category->name);
                                $category_ids[] = $category->term_id;
                            }
                        }
                    }

                    echo implode(', ', $category_names);
                    echo '</p>';
                    ?>

                    <!-- Display Format -->
                    <?php
                    $format_terms = get_the_terms(get_the_ID(), 'format');
                    if ($format_terms) {
                        echo '<p>FORMAT : ';
                        $format_names = array();
                        foreach ($format_terms as $format_term) {
                            $format_names[] = esc_html($format_term->name);
                        }
                        echo implode(', ', $format_names);
                        echo '</p>';
                    }
                    ?>

                    <!-- Display Type de la Photo -->
                    <?php
                    $type = get_field('Type');
                    if ($type) {
                        echo '<p>TYPE : ' . esc_html($type) . '</p>';
                    }
                    ?>

                    <!-- Display Year -->
                    <p class="photo-year">ANNÉE : <?php echo esc_html(get_the_date('Y')) ?></p>
                </div>
            </div>
            </article>

        <?php endwhile;
    else:
        echo '<p>Aucune photo trouvée</p>';
    endif;
    ?>
</div>

<!-- Section | Contact - Navigation de photos - Fleches & Miniature -->
<div class="right-contact">
    <p>Cette photo vous intéresse ?</p>

    <!--Bouton contact avec reference photo (data-reference)-->
    <button id="button-contact-photo" data-reference="<?php echo $reference; ?>">Contact</button>
    <?php
    get_template_part('template-parts/contact');
    ?>

    <!--Bouton navigation précédente-->
    <div class="site-navigation-prev">
        <?php
        $prev_post = get_previous_post();
        if ($prev_post) {
            $prev_title = strip_tags(str_replace('"', '', $prev_post->post_title));
            $prev_post_id = $prev_post->ID;
            echo '<a rel="prev" href="' . get_permalink($prev_post_id) . '" title="' . $prev_title . '" class="previous-post">';
            if (has_post_thumbnail($prev_post_id)) {
                ?>
                <div>
                    <?php echo get_the_post_thumbnail($prev_post_id, array(77, 60)); ?>
                </div>
                <?php
                echo '<img src="' . get_stylesheet_directory_uri() . '/images/fleche-gauche.png" alt="article précédent"  class="navigation-prev"></a>';
            }
        } ?>
    </div>

    <!--Bouton navigation suivante-->
    <div class="site-navigation-next">
        <!-- next_post_link( '%link', '%title', false );  -->
        <?php
        $next_post = get_next_post();
        if ($next_post) {
            $next_title = strip_tags(str_replace('"', '', $next_post->post_title));
            $next_post_id = $next_post->ID;
            echo '<a rel="next" href="' . get_permalink($next_post_id) . '" title="' . $next_title . '" class="next-post">';
            if (has_post_thumbnail($next_post_id)) {
                ?>
                <div><?php echo get_the_post_thumbnail($next_post_id, array(77, 60)); ?></div>
                <?php
            }
            echo '<img src="' . get_stylesheet_directory_uri() . '/images/fleche-droite.png" alt="article suivante" class="navigation-next"></a>';
        }
        ?>
    </div>
</div>


<!--Zone photos dans l'affichage d'un post-->

<h3 class="photo-apparentes-title">VOUS AIMEREZ AUSSI</h3>

<div class="photos-apparentes">

    <!--Récupération des posts de la même catégorie grâce au slug-->

    <div class="affichage-photos">
        <?php

        $current_category_slugs = array();
        $categories = get_the_terms($post_id, $taxonomy);

        if ($categories && !is_wp_error($categories)) {
            foreach ($categories as $category) {
                $current_category_slugs[] = $category->slug;
            }
        }

        $args = array(
            'post_type' => 'photo',//nom CPT UI du post
            'posts_per_page' => 2,//nombre de posts affichés
            'orderby' => 'rand',
            'post__not_in' => array($post_id), //Exclus post affiché
            'tax_query' => array(
                array(
                    'taxonomy' => $taxonomy,// ACF Taxonomy
                    'field' => 'slug',
                    'terms' => $current_category_slugs,
                ),
            ),
        );

        $the_query = new WP_Query($args); ?>

        <?php
        if ($the_query->have_posts())
            while ($the_query->have_posts()) {
                $the_query->the_post(); ?>
                <?php get_template_part('template-parts/lightbox-single-photo');?>
            </div>
            <?php
            }
        wp_reset_postdata();
        ?>
    </a>
</div>
</div>

<?php get_footer(); ?>