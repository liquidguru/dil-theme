<?php
/**
 * Main template file — fallback for any view not handled by a more specific template.
 * WordPress uses this when no more-specific template is found.
 */

get_header();
require_once get_template_directory() . '/inc/inner-page.php';

dil_page_banner( [
    'kicker' => get_bloginfo( 'name' ),
    'title'  => is_home() ? __( 'Journal', 'dil' ) : single_cat_title( '', false ),
    'no_photo' => true,
] );
?>

<div class="inner-page">
    <main class="inner-page__main" id="main-content" tabindex="-1">
        <?php if ( have_posts() ) : ?>
            <?php while ( have_posts() ) : the_post(); ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class( 'inner-section' ); ?>>
                    <h2 style="font-family:var(--font-heading);font-size:26px;font-weight:500;letter-spacing:0.06em;text-transform:uppercase;margin-bottom:8px;">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h2>
                    <div class="mono" style="margin-bottom:18px;"><?php the_date( 'j F Y' ); ?></div>
                    <?php the_excerpt(); ?>
                    <a href="<?php the_permalink(); ?>" class="btn btn-outline-dark" style="margin-top:18px;">
                        <?php esc_html_e( 'Read more', 'dil' ); ?>
                    </a>
                </article>
            <?php endwhile; ?>
            <?php the_posts_pagination( [ 'mid_size' => 2 ] ); ?>
        <?php else : ?>
            <p><?php esc_html_e( 'Nothing found.', 'dil' ); ?></p>
        <?php endif; ?>
    </main>
    <?php dil_sidebar(); ?>
</div>

<?php get_footer(); ?>
