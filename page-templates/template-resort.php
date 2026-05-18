<?php
/**
 * Template Name: The Resort
 *
 * Assign this template to the /the-resort/ page in WordPress.
 */

get_header();
require_once get_template_directory() . '/inc/inner-page.php';

$banner_img = get_theme_mod( 'dil_banner_resort', '' );
if ( ! $banner_img && has_post_thumbnail() ) {
    $banner_img = get_the_post_thumbnail_url( null, 'dil-banner' );
}
?>

<?php dil_page_banner( [
    'kicker'   => __( 'Kasawari Bay, North Sulawesi', 'dil' ),
    'title'    => __( 'The Resort', 'dil' ),
    'subtitle' => __( '9 bungalows · 1 suite · 3 longhouse rooms on the water\'s edge', 'dil' ),
    'bg_url'   => $banner_img,
] ); ?>

<div class="inner-page">

    <main class="inner-page__main" id="main-content" tabindex="-1">

        <!-- Section 1 — Rooms & Bungalows -->
        <div class="inner-section">
            <div class="section-head">
                <div class="section-head__number mono">01</div>
                <h2 class="section-head__title"><?php esc_html_e( 'Rooms &amp; Bungalows', 'dil' ); ?></h2>
            </div>
            <?php echo apply_filters( 'the_content', get_theme_mod( 'dil_text_resort_rooms', // phpcs:ignore
                __( 'Nine over-water bungalows, one suite, and three longhouse rooms — each designed for comfort after a day in the water. King beds, hot showers, and balconies overlooking the strait.', 'dil' )
            ) ); ?>
            <div class="image-grid image-grid--3col" style="margin-top:28px;">
                <?php
                $resort_rooms = [
                    [ 'mod' => 'dil_img_room_bed',      'alt' => __( 'Bungalow — king-size bed', 'dil' ),       'caption' => __( 'Bungalow · King-size bed', 'dil' ),    'sub' => '7 of 9' ],
                    [ 'mod' => 'dil_img_room_onsen',     'alt' => __( 'Private onsen on balcony', 'dil' ),       'caption' => __( 'Onsen · Balcony', 'dil' ),             'sub' => 'All bungalows' ],
                    [ 'mod' => 'dil_img_room_suite',     'alt' => __( 'Suite lounge area', 'dil' ),              'caption' => __( 'Suite · Lounge', 'dil' ),              'sub' => '1 suite' ],
                    [ 'mod' => 'dil_img_room_garden',    'alt' => __( 'Garden walkway to bungalows', 'dil' ),    'caption' => __( 'Garden walkway', 'dil' ),              'sub' => 'Grounds' ],
                    [ 'mod' => 'dil_img_room_shower',    'alt' => __( 'Walk-in outdoor shower', 'dil' ),         'caption' => __( 'Outdoor shower', 'dil' ),              'sub' => 'All bungalows' ],
                    [ 'mod' => 'dil_img_room_longhouse', 'alt' => __( 'Longhouse room interior', 'dil' ),        'caption' => __( 'Longhouse room', 'dil' ),              'sub' => '3 rooms' ],
                ];
                foreach ( $resort_rooms as $tile ) :
                    $src = get_theme_mod( $tile['mod'], '' );
                    ?>
                    <div class="grid-tile">
                        <?php if ( $src ) : ?>
                            <img src="<?php echo esc_url( $src ); ?>" alt="<?php echo esc_attr( $tile['alt'] ); ?>" loading="lazy">
                        <?php else : ?>
                            <?php echo dil_placeholder( $tile['caption'] ); // phpcs:ignore ?>
                        <?php endif; ?>
                        <div class="grid-tile__caption">
                            <div class="grid-tile__caption-text"><?php echo esc_html( $tile['caption'] ); ?></div>
                            <div class="grid-tile__caption-sub"><?php echo esc_html( $tile['sub'] ); ?></div>
                        </div>
                    </div>
                    <?php
                endforeach;
                ?>
            </div>
        </div>

        <!-- Section 2 — Pool & Restaurant -->
        <div class="inner-section">
            <div class="section-head">
                <div class="section-head__number mono">02</div>
                <h2 class="section-head__title"><?php esc_html_e( 'Pool &amp; Restaurant', 'dil' ); ?></h2>
            </div>
            <?php echo apply_filters( 'the_content', get_theme_mod( 'dil_text_resort_pool', // phpcs:ignore
                __( 'An 18-metre freshwater pool, a restaurant serving Indonesian and Western dishes, and a bar where dive stories are exchanged over cold Bintangs as the sun sets over the strait.', 'dil' )
            ) ); ?>
            <div class="image-grid image-grid--3col" style="margin-top:28px;">
                <?php
                $resort_pool = [
                    [ 'mod' => 'dil_img_pool_main',     'alt' => __( '18m freshwater pool', 'dil' ),     'caption' => __( '18m pool', 'dil' ),             'sub' => 'Freshwater' ],
                    [ 'mod' => 'dil_img_pool_sunrise',  'alt' => __( 'Pool at sunrise', 'dil' ),          'caption' => __( 'Pool at sunrise', 'dil' ),      'sub' => 'Morning' ],
                    [ 'mod' => 'dil_img_pool_deck',     'alt' => __( 'Sun deck by the pool', 'dil' ),     'caption' => __( 'Sun deck', 'dil' ),             'sub' => 'Afternoon' ],
                    [ 'mod' => 'dil_img_restaurant',    'alt' => __( 'Restaurant dining area', 'dil' ),   'caption' => __( 'Restaurant', 'dil' ),           'sub' => 'All meals' ],
                    [ 'mod' => 'dil_img_bar',           'alt' => __( 'Bar at night', 'dil' ),             'caption' => __( 'Bar at night', 'dil' ),         'sub' => 'Evening' ],
                    [ 'mod' => 'dil_img_deck_dinner',   'alt' => __( 'Dinner on the deck', 'dil' ),       'caption' => __( 'Dinner on the deck', 'dil' ),   'sub' => 'By request' ],
                ];
                foreach ( $resort_pool as $tile ) :
                    $src = get_theme_mod( $tile['mod'], '' );
                    ?>
                    <div class="grid-tile">
                        <?php if ( $src ) : ?>
                            <img src="<?php echo esc_url( $src ); ?>" alt="<?php echo esc_attr( $tile['alt'] ); ?>" loading="lazy">
                        <?php else : ?>
                            <?php echo dil_placeholder( $tile['caption'] ); // phpcs:ignore ?>
                        <?php endif; ?>
                        <div class="grid-tile__caption">
                            <div class="grid-tile__caption-text"><?php echo esc_html( $tile['caption'] ); ?></div>
                            <div class="grid-tile__caption-sub"><?php echo esc_html( $tile['sub'] ); ?></div>
                        </div>
                    </div>
                    <?php
                endforeach;
                ?>
            </div>
        </div>

        <!-- Section 3 — Grounds & the Strait -->
        <div class="inner-section">
            <div class="section-head">
                <div class="section-head__number mono">03</div>
                <h2 class="section-head__title"><?php esc_html_e( 'Grounds &amp; the Strait', 'dil' ); ?></h2>
            </div>
            <div class="image-grid image-grid--2col" style="margin-top:4px;">
                <?php
                $resort_grounds = [
                    [ 'mod' => 'dil_img_aerial_property', 'alt' => __( 'Aerial view of resort property', 'dil' ), 'caption' => __( 'Aerial — property', 'dil' ),        'sub' => 'Drone' ],
                    [ 'mod' => 'dil_img_lembeh_island',   'alt' => __( 'Lembeh Island from the resort', 'dil' ),  'caption' => __( 'Lembeh Island view', 'dil' ),       'sub' => 'From the deck' ],
                    [ 'mod' => 'dil_img_gardens',         'alt' => __( 'Resort gardens', 'dil' ),                 'caption' => __( 'Gardens', 'dil' ),                  'sub' => 'Grounds' ],
                    [ 'mod' => 'dil_img_house_reef_above','alt' => __( 'House reef from above', 'dil' ),          'caption' => __( 'House reef from above', 'dil' ),    'sub' => 'Drone' ],
                ];
                foreach ( $resort_grounds as $tile ) :
                    $src = get_theme_mod( $tile['mod'], '' );
                    ?>
                    <div class="grid-tile" style="aspect-ratio:16/9;">
                        <?php if ( $src ) : ?>
                            <img src="<?php echo esc_url( $src ); ?>" alt="<?php echo esc_attr( $tile['alt'] ); ?>" loading="lazy">
                        <?php else : ?>
                            <?php echo dil_placeholder( $tile['caption'] ); // phpcs:ignore ?>
                        <?php endif; ?>
                        <div class="grid-tile__caption">
                            <div class="grid-tile__caption-text"><?php echo esc_html( $tile['caption'] ); ?></div>
                            <div class="grid-tile__caption-sub"><?php echo esc_html( $tile['sub'] ); ?></div>
                        </div>
                    </div>
                    <?php
                endforeach;
                ?>
            </div>
        </div>

        <!-- Section 4 — Sustainability -->
        <div class="inner-section">
            <div class="section-head">
                <div class="section-head__number mono">04</div>
                <h2 class="section-head__title"><?php esc_html_e( 'Sustainability', 'dil' ); ?></h2>
            </div>
            <?php echo apply_filters( 'the_content', get_theme_mod( 'dil_text_resort_sustainability', // phpcs:ignore
                __( 'We run a no-fumigation policy — no chemical pesticides on the property. Guests are issued refillable tumblers to cut single-use plastic. Small things, real impact.', 'dil' )
            ) ); ?>
            <div class="image-grid image-grid--2col" style="margin-top:28px;">
                <?php
                $sustainability = [
                    [ 'mod' => 'dil_img_tumblers',    'alt' => __( 'Refillable tumblers', 'dil' ),      'caption' => __( 'Refillable tumblers', 'dil' ),    'sub' => 'No single-use plastic' ],
                    [ 'mod' => 'dil_img_butterflies', 'alt' => __( 'Butterflies in the garden', 'dil' ), 'caption' => __( 'No-fumigation policy', 'dil' ),   'sub' => 'Grounds' ],
                ];
                foreach ( $sustainability as $tile ) :
                    $src = get_theme_mod( $tile['mod'], '' );
                    ?>
                    <div class="grid-tile">
                        <?php if ( $src ) : ?>
                            <img src="<?php echo esc_url( $src ); ?>" alt="<?php echo esc_attr( $tile['alt'] ); ?>" loading="lazy">
                        <?php else : ?>
                            <?php echo dil_placeholder( $tile['caption'] ); // phpcs:ignore ?>
                        <?php endif; ?>
                        <div class="grid-tile__caption">
                            <div class="grid-tile__caption-text"><?php echo esc_html( $tile['caption'] ); ?></div>
                            <div class="grid-tile__caption-sub"><?php echo esc_html( $tile['sub'] ); ?></div>
                        </div>
                    </div>
                    <?php
                endforeach;
                ?>
            </div>
        </div>

    </main>

    <?php dil_sidebar(); ?>

</div><!-- .inner-page -->

<?php get_footer(); ?>
