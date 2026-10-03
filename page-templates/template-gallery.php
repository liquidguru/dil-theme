<?php
/**
 * Template Name: Galleries
 *
 * Assign this template to the /galleries/ page in WordPress.
 * Primary source: WP media library attachments with _dil_gallery meta.
 * Fallback: hardcoded CDN images below.
 */

get_header();
require_once get_template_directory() . '/inc/inner-page.php';

$banner_img = get_theme_mod( 'dil_banner_gallery', '' );
if ( ! $banner_img && has_post_thumbnail() ) {
    $banner_img = get_the_post_thumbnail_url( null, 'dil-banner' );
}

// ── Fallback gallery: the original site's macro photos, bundled in the theme (assets/images/gallery) ──
$cdn = DIL_URI . '/assets/images/gallery/';
$fallback_gallery = [
    [ 'file' => 'porcelain-crab-1024-custom.webp',              'alt' => 'Porcelain crab',              'cat' => 'macro' ],
    [ 'file' => 'ambon-scorpionfish-custom.webp',               'alt' => 'Ambon scorpionfish',          'cat' => 'macro' ],
    [ 'file' => 'ribbon-eel-custom.webp',                       'alt' => 'Ribbon eel',                  'cat' => 'macro' ],
    [ 'file' => 'clownfish-parasite-2-copy-custom.webp',        'alt' => 'Clownfish with parasite',     'cat' => 'macro' ],
    [ 'file' => 'yellow-blue-nudi-1024-custom.webp',            'alt' => 'Yellow & blue nudibranch',    'cat' => 'macro' ],
    [ 'file' => 'honey-combed-moray-2-1024-custom.webp',        'alt' => 'Honeycomb moray eel',         'cat' => 'macro' ],
    [ 'file' => 'coconut-octopus-1-copy-custom.webp',           'alt' => 'Coconut octopus',             'cat' => 'macro' ],
    [ 'file' => 'snake-eel-head-custom.webp',                   'alt' => 'Snake eel close-up',          'cat' => 'macro' ],
    [ 'file' => 'yellow-thorny-seahorse-custom.webp',           'alt' => 'Yellow thorny seahorse',      'cat' => 'macro' ],
    [ 'file' => '2-ornate-custom.webp',                         'alt' => 'Ornate ghost pipefish',       'cat' => 'macro' ],
    [ 'file' => 't-bar-nudi-laying-eggs-custom.webp',           'alt' => 'Nudibranch laying eggs',      'cat' => 'macro' ],
    [ 'file' => 'yellow-pygmy-custom.webp',                     'alt' => 'Yellow pygmy seahorse',       'cat' => 'macro' ],
    [ 'file' => 'octo-in-a-bottle-custom.webp',                 'alt' => 'Octopus in a bottle',         'cat' => 'macro' ],
    [ 'file' => 'solar-powered-nudi-copy-custom.webp',          'alt' => 'Solar-powered nudibranch',    'cat' => 'macro' ],
    [ 'file' => 'halgerda-malesso-1024-custom.webp',            'alt' => 'Halgerda malesso nudibranch', 'cat' => 'macro' ],
    [ 'file' => 'red-hairy-shrimp-copy-custom.webp',            'alt' => 'Red hairy shrimp',            'cat' => 'macro' ],
    [ 'file' => 'nudi-laying-eggs-custom.webp',                 'alt' => 'Nudibranch laying eggs',      'cat' => 'macro' ],
    [ 'file' => 'nudi-head-custom.webp',                        'alt' => 'Nudibranch portrait',         'cat' => 'macro' ],
    [ 'file' => 'giant-frogfish-custom.webp',                   'alt' => 'Giant frogfish',              'cat' => 'macro' ],
    [ 'file' => 'nudi-picnic-hypselodoris-emma-1024-custom.webp','alt' => 'Hypselodoris emma nudibranch','cat' => 'macro' ],
    [ 'file' => 'yellow-boxfish-lr-custom.webp',                'alt' => 'Yellow boxfish',              'cat' => 'macro' ],
    [ 'file' => 'harly-shrimp-custom.webp',                     'alt' => 'Harlequin shrimp',            'cat' => 'macro' ],
    [ 'file' => 'snake-eel-with-cleaner-shrimp-custom.webp',    'alt' => 'Snake eel with cleaner shrimp','cat' => 'macro' ],
    [ 'file' => 'cowfish-1024-custom.webp',                     'alt' => 'Cowfish',                     'cat' => 'macro' ],
    [ 'file' => 'orange-frog-custom.webp',                      'alt' => 'Orange frogfish',             'cat' => 'macro' ],
    [ 'file' => 'hairy-octopus-web-1024-custom.webp',           'alt' => 'Hairy octopus',               'cat' => 'macro' ],
    [ 'file' => 'mimic-custom.webp',                            'alt' => 'Mimic octopus',               'cat' => 'macro' ],
    [ 'file' => 'red-seahorse-custom.webp',                     'alt' => 'Red seahorse',                'cat' => 'macro' ],
    [ 'file' => 'spearing-mantis-shrimp-1024-custom.webp',      'alt' => 'Spearing mantis shrimp',      'cat' => 'macro' ],
    [ 'file' => 'batfish-custom.webp',                          'alt' => 'Batfish',                     'cat' => 'macro' ],
    [ 'file' => 'white-hairy-frogfish-2-1024-custom.webp',      'alt' => 'White hairy frogfish',        'cat' => 'macro' ],
    [ 'file' => 'yellow-rhino-custom.webp',                     'alt' => 'Yellow rhinopias',            'cat' => 'macro' ],
    [ 'file' => 'thumb-1m-1024-custom.webp',                    'alt' => 'Lembeh critter',              'cat' => 'macro' ],
    [ 'file' => 'pink-rhinopius-custom.webp',                   'alt' => 'Pink rhinopias',              'cat' => 'macro' ],
    [ 'file' => 'yellowish-common-seahorse-custom.webp',        'alt' => 'Common seahorse',             'cat' => 'macro' ],
    [ 'file' => 'nudi-custom.webp',                             'alt' => 'Nudibranch',                  'cat' => 'macro' ],
    [ 'file' => 'hairy-frogfish-custom.webp',                   'alt' => 'Hairy frogfish',              'cat' => 'macro' ],
    [ 'file' => 'thumb-odd-crab-1024-custom.webp',              'alt' => 'Odd decorator crab',          'cat' => 'macro' ],
    [ 'file' => 'coconut-octopus-custom.webp',                  'alt' => 'Coconut octopus',             'cat' => 'macro' ],
    [ 'file' => 'frogfishpainted-custom.webp',                  'alt' => 'Painted frogfish',            'cat' => 'macro' ],
    [ 'file' => 'yellow-thorny-seahorse-head-custom.webp',      'alt' => 'Thorny seahorse head',        'cat' => 'macro' ],
];

// ── WP media library query (overrides fallback when images exist) ─
$gallery_query = new WP_Query( [
    'post_type'      => 'attachment',
    'post_mime_type' => 'image',
    'post_status'    => 'inherit',
    'posts_per_page' => 120,
    'orderby'        => 'menu_order',
    'order'          => 'ASC',
    'meta_query'     => [ [ 'key' => '_dil_gallery', 'compare' => 'EXISTS' ] ],
] );

$use_wp    = $gallery_query->have_posts();
$wp_items  = $gallery_query->posts;

// ── Build unified items array ──────────────────────────────────────
$gallery_items = [];

if ( $use_wp ) {
    foreach ( $wp_items as $att ) {
        $cat  = get_post_meta( $att->ID, '_dil_gallery_cat', true ) ?: 'macro';
        $th   = wp_get_attachment_image_src( $att->ID, 'dil-tile' );
        $full = wp_get_attachment_image_src( $att->ID, 'full' );
        $alt  = get_post_meta( $att->ID, '_wp_attachment_image_alt', true ) ?: $att->post_title;
        $gallery_items[] = [
            'src'  => $th   ? $th[0]   : '',
            'full' => $full ? $full[0] : '',
            'alt'  => $alt,
            'cat'  => $cat,
        ];
    }
    wp_reset_postdata();
} else {
    foreach ( $fallback_gallery as $img ) {
        $url = $cdn . $img['file'];
        $gallery_items[] = [
            'src'  => $url,
            'full' => $url,
            'alt'  => $img['alt'],
            'cat'  => $img['cat'],
        ];
    }
}

// ── Category counts ────────────────────────────────────────────────
$filters = [
    'all'   => [ 'label' => __( 'All', 'dil' ),   'count' => 0 ],
    'macro' => [ 'label' => __( 'Macro', 'dil' ),  'count' => 0 ],
];
foreach ( $gallery_items as $item ) {
    $filters['all']['count']++;
    if ( isset( $filters[ $item['cat'] ] ) ) {
        $filters[ $item['cat'] ]['count']++;
    }
}
?>

<?php dil_page_banner( [
    'kicker'   => __( 'Steve\'s lens', 'dil' ),
    'title'    => __( 'Galleries', 'dil' ),
    'subtitle' => __( 'All photography by Steve', 'dil' ),
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
    <?php foreach ( $gallery_items as $idx => $item ) : ?>
        <button
            class="gallery-grid__item"
            data-category="<?php echo esc_attr( $item['cat'] ); ?>"
            data-full="<?php echo esc_url( $item['full'] ); ?>"
            data-alt="<?php echo esc_attr( $item['alt'] ); ?>"
            data-index="<?php echo esc_attr( $idx ); ?>"
            aria-label="<?php echo esc_attr( sprintf( __( 'View %s', 'dil' ), $item['alt'] ) ); ?>">
            <img
                src="<?php echo esc_url( $item['src'] ); ?>"
                alt="<?php echo esc_attr( $item['alt'] ); ?>"
                loading="lazy">
        </button>
    <?php endforeach; ?>
</div>

<?php get_footer(); ?>
