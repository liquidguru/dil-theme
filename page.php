<?php
/**
 * Default page template — used for any page without a specific template assigned.
 * Renders page content in the inner-page shell (main + sidebar).
 */

get_header();
require_once get_template_directory() . '/inc/inner-page.php';

$banner_img = has_post_thumbnail() ? get_the_post_thumbnail_url( null, 'dil-banner' ) : '';

dil_page_banner( [
    'kicker' => get_bloginfo( 'name' ),
    'title'  => get_the_title(),
    'bg_url' => $banner_img,
] );
?>

<div class="inner-page">
    <main class="inner-page__main" id="main-content" tabindex="-1">
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
            <div class="inner-section">
                <?php the_content(); ?>
            </div>
        <?php endwhile; endif; ?>
    </main>
    <?php dil_sidebar(); ?>
</div>

<?php get_footer(); ?>
