<?php
/**
 * Single post template — blog posts and any CPT not handled elsewhere.
 */

get_header();
require_once get_template_directory() . '/inc/inner-page.php';

the_post();
$banner_img = has_post_thumbnail() ? get_the_post_thumbnail_url( null, 'dil-banner' ) : '';

dil_page_banner( [
    'kicker' => __( 'Journal', 'dil' ),
    'title'  => get_the_title(),
    'bg_url' => $banner_img,
] );
?>

<div class="inner-page">
    <main class="inner-page__main" id="main-content" tabindex="-1">
        <div class="inner-section">
            <div class="mono" style="margin-bottom:24px;"><?php the_date( 'j F Y' ); ?></div>
            <?php the_content(); ?>
        </div>
        <?php
        the_post_navigation( [
            'prev_text' => __( '← %title', 'dil' ),
            'next_text' => __( '%title →', 'dil' ),
        ] );
        ?>
    </main>
    <?php dil_sidebar(); ?>
</div>

<?php get_footer(); ?>
