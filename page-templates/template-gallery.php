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

// ── Fallback gallery from original site CDN ──────────────────────
$cdn = 'https://diveintolembeh.com/wp-content/uploads/2018/05/';
$fallback_gallery = [
    [ 'file' => 'Porcelain-Crab_1024-Custom.jpg',              'alt' => 'Porcelain crab',              'cat' => 'macro' ],
    [ 'file' => 'Ambon-Scorpionfish-Custom.jpg',               'alt' => 'Ambon scorpionfish',          'cat' => 'macro' ],
    [ 'file' => 'Ribbon-eel-Custom.jpg',                       'alt' => 'Ribbon eel',                  'cat' => 'macro' ],
    [ 'file' => 'Clownfish-Parasite-2-copy-Custom.jpg',        'alt' => 'Clownfish with parasite',     'cat' => 'macro' ],
    [ 'file' => 'Yellow-blue-nudi_1024-Custom.jpg',            'alt' => 'Yellow & blue nudibranch',    'cat' => 'macro' ],
    [ 'file' => 'Honey-combed-Moray-2_1024-Custom.jpg',        'alt' => 'Honeycomb moray eel',         'cat' => 'macro' ],
    [ 'file' => 'Coconut-Octopus-1-copy-Custom.jpg',           'alt' => 'Coconut octopus',             'cat' => 'macro' ],
    [ 'file' => 'Snake-Eel-Head-Custom.jpg',                   'alt' => 'Snake eel close-up',          'cat' => 'macro' ],
    [ 'file' => 'Yellow-Thorny-Seahorse-Custom.jpg',           'alt' => 'Yellow thorny seahorse',      'cat' => 'macro' ],
    [ 'file' => '2-Ornate-Custom.jpg',                         'alt' => 'Ornate ghost pipefish',       'cat' => 'macro' ],
    [ 'file' => 'T-bar-nudi-laying-eggs-Custom.jpg',           'alt' => 'Nudibranch laying eggs',      'cat' => 'macro' ],
    [ 'file' => 'Yellow-Pygmy-Custom.jpg',                     'alt' => 'Yellow pygmy seahorse',       'cat' => 'macro' ],
    [ 'file' => 'Octo-in-a-bottle-Custom.jpg',                 'alt' => 'Octopus in a bottle',         'cat' => 'macro' ],
    [ 'file' => 'Solar-Powered-Nudi-copy-Custom.jpg',          'alt' => 'Solar-powered nudibranch',    'cat' => 'macro' ],
    [ 'file' => 'Halgerda-malesso_1024-Custom.jpg',            'alt' => 'Halgerda malesso nudibranch', 'cat' => 'macro' ],
    [ 'file' => 'Red-Hairy-Shrimp-copy-Custom.jpg',            'alt' => 'Red hairy shrimp',            'cat' => 'macro' ],
    [ 'file' => 'Nudi-Laying-eggs-Custom.jpg',                 'alt' => 'Nudibranch laying eggs',      'cat' => 'macro' ],
    [ 'file' => 'Nudi-Head-Custom.jpg',                        'alt' => 'Nudibranch portrait',         'cat' => 'macro' ],
    [ 'file' => 'Giant-Frogfish-Custom.jpg',                   'alt' => 'Giant frogfish',              'cat' => 'macro' ],
    [ 'file' => 'Nudi-Picnic-Hypselodoris-emma_1024-Custom.jpg','alt' => 'Hypselodoris emma nudibranch','cat' => 'macro' ],
    [ 'file' => 'Yellow-Boxfish-LR-Custom.jpg',                'alt' => 'Yellow boxfish',              'cat' => 'macro' ],
    [ 'file' => 'Harly-Shrimp-Custom.jpg',                     'alt' => 'Harlequin shrimp',            'cat' => 'macro' ],
    [ 'file' => 'Snake-Eel-with-Cleaner-Shrimp-Custom.jpg',    'alt' => 'Snake eel with cleaner shrimp','cat' => 'macro' ],
    [ 'file' => 'Cowfish_1024-Custom.jpg',                     'alt' => 'Cowfish',                     'cat' => 'macro' ],
    [ 'file' => 'Orange-Frog-Custom.jpg',                      'alt' => 'Orange frogfish',             'cat' => 'macro' ],
    [ 'file' => 'Hairy-Octopus-web_1024-Custom.jpg',           'alt' => 'Hairy octopus',               'cat' => 'macro' ],
    [ 'file' => 'Mimic-Custom.jpg',                            'alt' => 'Mimic octopus',               'cat' => 'macro' ],
    [ 'file' => 'Red-Seahorse-Custom.jpg',                     'alt' => 'Red seahorse',                'cat' => 'macro' ],
    [ 'file' => 'Spearing-Mantis-Shrimp_1024-Custom.jpg',      'alt' => 'Spearing mantis shrimp',      'cat' => 'macro' ],
    [ 'file' => 'Batfish-Custom.jpg',                          'alt' => 'Batfish',                     'cat' => 'macro' ],
    [ 'file' => 'White-Hairy-Frogfish-2_1024-Custom.jpg',      'alt' => 'White hairy frogfish',        'cat' => 'macro' ],
    [ 'file' => 'Yellow-Rhino-Custom.jpg',                     'alt' => 'Yellow rhinopias',            'cat' => 'macro' ],
    [ 'file' => 'thumb_1m_1024-Custom.jpg',                    'alt' => 'Lembeh critter',              'cat' => 'macro' ],
    [ 'file' => 'Pink-Rhinopius-Custom.jpg',                   'alt' => 'Pink rhinopias',              'cat' => 'macro' ],
    [ 'file' => 'Yellowish-Common-Seahorse-Custom.jpg',        'alt' => 'Common seahorse',             'cat' => 'macro' ],
    [ 'file' => 'Nudi-Custom.jpg',                             'alt' => 'Nudibranch',                  'cat' => 'macro' ],
    [ 'file' => 'Hairy-Frogfish-Custom.jpg',                   'alt' => 'Hairy frogfish',              'cat' => 'macro' ],
    [ 'file' => 'thumb_Odd-Crab_1024-Custom.jpg',              'alt' => 'Odd decorator crab',          'cat' => 'macro' ],
    [ 'file' => 'Coconut-Octopus-Custom.jpg',                  'alt' => 'Coconut octopus',             'cat' => 'macro' ],
    [ 'file' => 'frogfishpainted-Custom.jpg',                  'alt' => 'Painted frogfish',            'cat' => 'macro' ],
    [ 'file' => 'Yellow-Thorny-Seahorse-Head-Custom.jpg',      'alt' => 'Thorny seahorse head',        'cat' => 'macro' ],
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
