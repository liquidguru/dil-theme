<?php
/**
 * Template Name: The Diving
 *
 * Assign this template to the /the-diving/ page in WordPress.
 */

get_header();
require_once get_template_directory() . '/inc/inner-page.php';

$banner_img = get_theme_mod( 'dil_banner_diving', '' );
if ( ! $banner_img && has_post_thumbnail() ) {
    $banner_img = get_the_post_thumbnail_url( null, 'dil-banner' );
}
?>

<?php dil_page_banner( [
    'kicker'   => __( 'Lembeh Strait, North Sulawesi', 'dil' ),
    'title'    => __( 'The Diving', 'dil' ),
    'subtitle' => __( 'Two house reefs · Three dives daily · Full camera-room facilities', 'dil' ),
    'bg_url'   => $banner_img,
] ); ?>

<div class="inner-page">

    <main class="inner-page__main" id="main-content" tabindex="-1">

        <!-- Anchor sub-nav -->
        <nav class="info-subnav" aria-label="<?php esc_attr_e( 'Page sections', 'dil' ); ?>">
            <a href="#boats"><?php esc_html_e( 'Boats &amp; Schedule', 'dil' ); ?></a>
            <a href="#camera-room"><?php esc_html_e( 'Camera Room', 'dil' ); ?></a>
            <a href="#dive-centre"><?php esc_html_e( 'Dive Centre', 'dil' ); ?></a>
            <a href="#house-reefs"><?php esc_html_e( 'House Reefs', 'dil' ); ?></a>
            <a href="#muck-diving"><?php esc_html_e( 'Muck Diving', 'dil' ); ?></a>
        </nav>

        <!-- Section 1 — Boats & schedule -->
        <div class="inner-section" id="boats">
            <div class="section-head">
                <div class="section-head__number mono">01</div>
                <h2 class="section-head__title"><?php esc_html_e( 'Boats &amp; Schedule', 'dil' ); ?></h2>
            </div>
            <?php echo apply_filters( 'the_content', get_theme_mod( 'dil_text_diving_boats', // phpcs:ignore
                __( '<p>The Lembeh Strait has long been established as one of the best macro diving spots on the planet. Although famous for its \'muck diving\' on black volcanic slopes, the area also boasts some wonderful coral dive sites.</p><p>We schedule up to 3 day dives per day on our twin engine fiberglass dive boats, to a choice of more than 60 dive spots in the Lembeh Strait. After every dive, the boats return to the resort so you can enjoy your surface interval by the swimming pool or make any adjustments to your camera before your next dive. A night dive by boat is available daily, providing we have a minimum of two people.</p>', 'dil' )
            ) ); ?>
            <div class="image-grid image-grid--3col" style="margin-top:28px;">
                <?php
                $boats = [
                    [ 'mod' => 'dil_img_boat1', 'default' => 'https://diveintolembeh.com/wp-content/uploads/2018/03/16b-Medium.jpg',                               'alt' => __( 'Dive boat', 'dil' ),              'caption' => __( 'Dive boat', 'dil' ),         'sub' => 'Morning departure' ],
                    [ 'mod' => 'dil_img_boat2', 'default' => 'https://diveintolembeh.com/wp-content/uploads/2018/03/boat-side-view-Medium.jpeg',                   'alt' => __( 'Dive boat side view', 'dil' ),    'caption' => __( 'Dive boat', 'dil' ),         'sub' => 'Side view' ],
                    [ 'mod' => 'dil_img_boat3', 'default' => 'https://diveintolembeh.com/wp-content/uploads/2018/03/Dive-into-Lembeh-1-Speedboat-Medium.jpg',     'alt' => __( 'Speedboat on the strait', 'dil' ),'caption' => __( 'Speedboat', 'dil' ),         'sub' => 'Kasawari Bay' ],
                    [ 'mod' => 'dil_img_boat4', 'default' => 'https://diveintolembeh.com/wp-content/uploads/2018/03/Engines.jpeg',                                'alt' => __( 'Twin engines', 'dil' ),           'caption' => __( 'Twin engines', 'dil' ),      'sub' => 'Fiberglass boats' ],
                    [ 'mod' => 'dil_img_boat5', 'default' => 'https://diveintolembeh.com/wp-content/uploads/2018/03/Sun-area-on-boat-Medium-1-e1471947051439.jpg','alt' => __( 'Sun deck on the boat', 'dil' ),   'caption' => __( 'Sun deck', 'dil' ),          'sub' => 'Surface interval' ],
                    [ 'mod' => 'dil_img_boat6', 'default' => 'https://diveintolembeh.com/wp-content/uploads/2018/03/View-from-Dive-center-Medium.jpeg',            'alt' => __( 'View from the dive centre', 'dil' ),'caption' => __( 'Dive centre view', 'dil' ),'sub' => 'Kasawari Bay' ],
                ];
                foreach ( $boats as $tile ) :
                    $src = get_theme_mod( $tile['mod'], $tile['default'] ?? '' );
                    ?>
                    <button class="grid-tile" <?php if ( $src ) : ?>data-full="<?php echo esc_url( $src ); ?>" data-alt="<?php echo esc_attr( $tile['alt'] ); ?>"<?php endif; ?>>
                        <?php if ( $src ) : ?>
                            <img src="<?php echo esc_url( $src ); ?>" alt="<?php echo esc_attr( $tile['alt'] ); ?>" loading="lazy">
                        <?php else : ?>
                            <?php echo dil_placeholder( $tile['caption'] ); // phpcs:ignore ?>
                        <?php endif; ?>
                        <div class="grid-tile__caption">
                            <div class="grid-tile__caption-text"><?php echo esc_html( $tile['caption'] ); ?></div>
                            <div class="grid-tile__caption-sub"><?php echo esc_html( $tile['sub'] ); ?></div>
                        </div>
                    </button>
                    <?php
                endforeach;
                ?>
            </div>
        </div>

        <!-- Section 2 — Camera room (3 images matching original) -->
        <div class="inner-section" id="camera-room">
            <div class="section-head">
                <div class="section-head__number mono">02</div>
                <h2 class="section-head__title"><?php esc_html_e( 'The Camera Room', 'dil' ); ?></h2>
            </div>
            <?php echo apply_filters( 'the_content', get_theme_mod( 'dil_text_diving_camera', // phpcs:ignore
                __( '<p>We have a large camera room with dedicated well-lit work stations for each guest, as well as separate rinse tanks for cameras.</p><p>Our dive guides are trained in camera handling and are specialised in working in Lembeh\'s unique underwater environment.</p>', 'dil' )
            ) ); ?>
            <div class="image-grid image-grid--3col" style="margin-top:28px;">
                <?php
                $camera_room = [
                    [ 'mod' => 'dil_img_cam1', 'default' => 'https://diveintolembeh.com/wp-content/uploads/2018/03/CAMERA-ROOM.jpeg',            'alt' => __( 'Camera room overview', 'dil' ),      'caption' => __( 'Camera room', 'dil' ),  'sub' => 'Full facilities' ],
                    [ 'mod' => 'dil_img_cam2', 'default' => 'https://diveintolembeh.com/wp-content/uploads/2018/03/Camera-rinse-tanks.jpg',       'alt' => __( 'Camera rinse tanks', 'dil' ),        'caption' => __( 'Rinse tanks', 'dil' ),  'sub' => 'Individual' ],
                    [ 'mod' => 'dil_img_cam3', 'default' => 'https://diveintolembeh.com/wp-content/uploads/2018/03/Camera-room-and-mats-copy.jpg','alt' => __( 'Camera room and dive mats', 'dil' ), 'caption' => __( 'Camera room', 'dil' ),  'sub' => 'With dive mats' ],
                ];
                foreach ( $camera_room as $tile ) :
                    $src = get_theme_mod( $tile['mod'], $tile['default'] ?? '' );
                    ?>
                    <button class="grid-tile" <?php if ( $src ) : ?>data-full="<?php echo esc_url( $src ); ?>" data-alt="<?php echo esc_attr( $tile['alt'] ); ?>"<?php endif; ?>>
                        <?php if ( $src ) : ?>
                            <img src="<?php echo esc_url( $src ); ?>" alt="<?php echo esc_attr( $tile['alt'] ); ?>" loading="lazy">
                        <?php else : ?>
                            <?php echo dil_placeholder( $tile['caption'] ); // phpcs:ignore ?>
                        <?php endif; ?>
                        <div class="grid-tile__caption">
                            <div class="grid-tile__caption-text"><?php echo esc_html( $tile['caption'] ); ?></div>
                            <div class="grid-tile__caption-sub"><?php echo esc_html( $tile['sub'] ); ?></div>
                        </div>
                    </button>
                    <?php
                endforeach;
                ?>
            </div>
        </div>

        <!-- Section 3 — Dive centre & equipment -->
        <div class="inner-section" id="dive-centre">
            <div class="section-head">
                <div class="section-head__number mono">03</div>
                <h2 class="section-head__title"><?php esc_html_e( 'Dive Centre &amp; Equipment', 'dil' ); ?></h2>
            </div>
            <?php echo apply_filters( 'the_content', get_theme_mod( 'dil_text_diving_centre', // phpcs:ignore
                __( '<p>There is also a guest dive gear locker room, with equipment rinse tanks and showers for after the dives. All tanks and weights are provided.</p>', 'dil' )
            ) ); ?>
            <div class="image-grid image-grid--3col" style="margin-top:28px;">
                <?php
                $dive_centre = [
                    [ 'mod' => 'dil_img_dc1', 'default' => 'https://diveintolembeh.com/wp-content/uploads/2018/03/Guest-locker-room-copy-Medium-1-e1471947448866.jpg', 'alt' => __( 'Guest locker room', 'dil' ),       'caption' => __( 'Locker room', 'dil' ),     'sub' => 'Personal lockers' ],
                    [ 'mod' => 'dil_img_dc2', 'default' => 'https://diveintolembeh.com/wp-content/uploads/2018/03/Equipment-room-night-shot-Medium.jpeg',              'alt' => __( 'Equipment room at night', 'dil' ), 'caption' => __( 'Equipment room', 'dil' ),  'sub' => 'Night shot' ],
                    [ 'mod' => 'dil_img_dc3', 'default' => 'https://diveintolembeh.com/wp-content/uploads/2018/03/Equipment-room-Medium-1-e1471947482648.jpg',         'alt' => __( 'Equipment room', 'dil' ),          'caption' => __( 'Equipment room', 'dil' ),  'sub' => 'Full kit storage' ],
                    [ 'mod' => 'dil_img_dc4', 'default' => 'https://diveintolembeh.com/wp-content/uploads/2018/03/Boat-Interior-Medium.jpg',                           'alt' => __( 'Boat interior', 'dil' ),           'caption' => __( 'Boat interior', 'dil' ),   'sub' => 'Twin-engine boat' ],
                    [ 'mod' => 'dil_img_dc5', 'default' => 'https://diveintolembeh.com/wp-content/uploads/2018/03/Giant-stride-Medium.jpg',                            'alt' => __( 'Giant stride entry', 'dil' ),      'caption' => __( 'Giant stride', 'dil' ),    'sub' => 'House reef' ],
                    [ 'mod' => 'dil_img_dc6', 'default' => 'https://diveintolembeh.com/wp-content/uploads/2018/03/camera-tank-view-Medium.jpg',                        'alt' => __( 'Camera tank view', 'dil' ),        'caption' => __( 'Camera tanks', 'dil' ),    'sub' => 'Dive centre' ],
                ];
                foreach ( $dive_centre as $tile ) :
                    $src = get_theme_mod( $tile['mod'], $tile['default'] ?? '' );
                    ?>
                    <button class="grid-tile" <?php if ( $src ) : ?>data-full="<?php echo esc_url( $src ); ?>" data-alt="<?php echo esc_attr( $tile['alt'] ); ?>"<?php endif; ?>>
                        <?php if ( $src ) : ?>
                            <img src="<?php echo esc_url( $src ); ?>" alt="<?php echo esc_attr( $tile['alt'] ); ?>" loading="lazy">
                        <?php else : ?>
                            <?php echo dil_placeholder( $tile['caption'] ); // phpcs:ignore ?>
                        <?php endif; ?>
                        <div class="grid-tile__caption">
                            <div class="grid-tile__caption-text"><?php echo esc_html( $tile['caption'] ); ?></div>
                            <div class="grid-tile__caption-sub"><?php echo esc_html( $tile['sub'] ); ?></div>
                        </div>
                    </button>
                    <?php
                endforeach;
                ?>
            </div>
        </div>

        <!-- Section 4 — House reefs (text only — no photos on original) -->
        <div class="inner-section" id="house-reefs">
            <div class="section-head">
                <div class="section-head__number mono">04</div>
                <h2 class="section-head__title"><?php esc_html_e( 'House Reefs', 'dil' ); ?></h2>
            </div>
            <?php echo apply_filters( 'the_content', get_theme_mod( 'dil_text_diving_reefs', // phpcs:ignore
                __( '<p>If you have booked a diving package (starting from three nights with two days of diving), we offer complimentary access to our two world-famous house reef dive sites — \'Hairball\' and \'Aw Shucks\' — between the hours of 8AM and 6PM.</p>', 'dil' )
            ) ); ?>
        </div>

        <!-- Section 5 — Muck diving explainer -->
        <div class="inner-section" id="muck-diving">
            <div class="section-head">
                <h2 class="section-head__title"><?php esc_html_e( 'Muck Diving in the Lembeh Strait', 'dil' ); ?></h2>
            </div>
            <div style="border:1px solid var(--border); padding:32px 28px;">
                <p class="section__lead" style="margin-bottom:24px;">
                    <?php esc_html_e( 'Lembeh was the first real muck diving destination in the world.', 'dil' ); ?>
                </p>
                <?php
                $muck_points = [
                    [
                        'heading' => __( 'Nutrition in the water', 'dil' ),
                        'body'    => __( 'You need lots of nutrition in the water to feed the small crustaceans and fish that form the beginning of a plentiful food chain. Crystal-clear blue water is wonderful, but it lacks the nutrients required for critter diving. Frogfish, seahorses, scorpionfish, octopus, crabs, shrimps, eels, nudibranchs, puffers, soles — they\'re all here.', 'dil' ),
                    ],
                    [
                        'heading' => __( 'Volcanic black sand', 'dil' ),
                        'body'    => __( 'White clean sand looks beautiful, but it\'s not ideal for critter photography. The light from your strobe bounces back into the lens, giving bad contrast and over-exposed shots. Volcanic black sand solves both problems — nutrient-rich substrate and a perfect dark backdrop.', 'dil' ),
                    ],
                    [
                        'heading' => __( 'More than just muck', 'dil' ),
                        'body'    => __( 'Lembeh has critter-infested black sandy slopes, but also beautiful coral dive sites. Angels Window and California Dreaming are two of our favourites — proof that the strait offers far more than its \'muck\' reputation suggests.', 'dil' ),
                    ],
                ];
                foreach ( $muck_points as $i => $point ) :
                ?>
                <div style="display:flex;gap:18px;margin-bottom:20px;">
                    <span style="font-family:var(--font-mono);font-size:11px;letter-spacing:0.2em;color:var(--burgundy);padding-top:3px;min-width:24px;"><?php echo sprintf( '%02d', $i + 1 ); ?></span>
                    <div>
                        <strong style="font-family:var(--font-heading);font-size:15px;letter-spacing:0.1em;text-transform:uppercase;display:block;margin-bottom:6px;">
                            <?php echo esc_html( $point['heading'] ); ?>
                        </strong>
                        <p style="font-size:16px;line-height:1.65;color:var(--ink-soft);">
                            <?php echo esc_html( $point['body'] ); ?>
                        </p>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

    </main>

    <?php dil_sidebar(); ?>

</div><!-- .inner-page -->

<?php get_footer(); ?>
