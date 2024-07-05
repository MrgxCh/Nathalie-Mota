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
                <?php if (has_post_thumbnail()): ?>
                    <div class="photos-container">
                        <?php the_post_thumbnail(); ?>
                        <!-- Section | Overlay Catalogue -->
                       <?php get_template_part('template-parts/lightbox');?>
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