<?php
/**
 * Template Name: Galleries
 *
 * Assign this template to the /galleries/ page in WordPress.
 * Pulls images from the WordPress media library (gallery post type or attachment query).
 */

get_header();
require_once get_template_directory() . '/inc/inner-page.php';

$banner_img = get_theme_mod( 'dil_banner_gallery', '' );
if ( ! $banner_img && has_post_thumbnail() ) {
    $banner_img = get_the_post_thumbnail_url( null, 'dil-banner' );
}

// Filter categories — edit as needed when real gallery CPT is set up
$filters = [
    'all'        => [ 'label' => __( 'All', 'dil' ),          'count' => 0 ],
    'macro'      => [ 'label' => __( 'Macro', 'dil' ),         'count' => 0 ],
    'wide-angle' => [ 'label' => __( 'Wide-angle', 'dil' ),    'count' => 0 ],
    'resort'     => [ 'label' => __( 'Resort', 'dil' ),        'count' => 0 ],
    '360'        => [ 'label' => __( '360 Photos', 'dil' ),    'count' => 0 ],
    'above'      => [ 'label' => __( 'Above water', 'dil' ),   'count' => 0 ],
];

// Fetch gallery images — adjust query to suit your gallery CPT/taxonomy
$gallery_args = [
    'post_type'      => 'attachment',
    'post_mime_type' => 'image',
    'post_status'    => 'inherit',
    'posts_per_page' => 60,
    'orderby'        => 'menu_order',
    'order'          => 'ASC',
    'meta_query'     => [
        [
            'key'     => '_dil_gallery',
            'compare' => 'EXISTS',
        ],
    ],
];

$gallery_query = new WP_Query( $gallery_args );
$gallery_items = $gallery_query->posts;

// Count by category
foreach ( $gallery_items as $item ) {
    $cat = get_post_meta( $item->ID, '_dil_gallery_cat', true ) ?: 'macro';
    if ( isset( $filters[ $cat ] ) ) {
        $filters[ $cat ]['count']++;
    }
    $filters['all']['count']++;
}
?>

<?php dil_page_banner( [
    'kicker'   => __( 'Steve\'s lens', 'dil' ),
    'title'    => __( 'Galleries', 'dil' ),
    'subtitle' => __( 'All photos taken by Steve', 'dil' ),
    'bg_url'   => $banner_img,
] ); ?>

<!-- Filter tabs -->
<div class="gallery-filters" role="tablist">
    <?php foreach ( $filters as $key => $filter ) : ?>
        <button
            class="filter-tab<?php echo $key === 'all' ? ' is-active' : ''; ?>"
            data-filter="<?php echo esc_attr( $key ); ?>"
            role="tab"
            aria-selected="<?php echo $key === 'all' ? 'true' : 'false'; ?>">
            <?php echo esc_html( $filter['label'] ); ?>
            <?php if ( $filter['count'] ) : ?>
                <span class="filter-tab__count"><?php echo esc_html( $filter['count'] ); ?></span>
            <?php endif; ?>
        </button>
    <?php endforeach; ?>
</div>

<!-- Gallery grid -->
<div class="gallery-grid" id="gallery-grid">
    <?php if ( ! empty( $gallery_items ) ) : ?>
        <?php foreach ( $gallery_items as $item ) : ?>
            <?php
            $cat = get_post_meta( $item->ID, '_dil_gallery_cat', true ) ?: 'macro';
            $src = wp_get_attachment_image_src( $item->ID, 'dil-tile' );
            $lg  = wp_get_attachment_image_src( $item->ID, 'full' );
            $alt = get_post_meta( $item->ID, '_wp_attachment_image_alt', true ) ?: $item->post_title;
            ?>
            <div class="gallery-grid__item" data-category="<?php echo esc_attr( $cat ); ?>">
                <img
                    src="<?php echo $src ? esc_url( $src[0] ) : ''; ?>"
                    alt="<?php echo esc_attr( $alt ); ?>"
                    loading="lazy"
                    data-full="<?php echo $lg ? esc_url( $lg[0] ) : ''; ?>">
            </div>
        <?php endforeach; ?>
        <?php wp_reset_postdata(); ?>

    <?php else : ?>
        <!-- No images yet — show placeholder grid -->
        <p style="padding:60px var(--outer-pad);color:var(--ink-soft);font-style:italic;">
            <?php esc_html_e( 'Gallery images will appear here. Tag media library images with the _dil_gallery meta key to include them.', 'dil' ); ?>
        </p>
    <?php endif; ?>
</div>

<?php get_footer(); ?>
