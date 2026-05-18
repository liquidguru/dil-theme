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

        <!-- Section 1 — Boats & schedule -->
        <div class="inner-section">
            <div class="section-head">
                <div class="section-head__number mono">01</div>
                <h2 class="section-head__title"><?php esc_html_e( 'Boats &amp; Schedule', 'dil' ); ?></h2>
            </div>
            <?php echo apply_filters( 'the_content', get_theme_mod( 'dil_text_diving_boats', // phpcs:ignore
                __( 'Two traditional wooden dive boats depart three times a day — morning, afternoon, and optional night dive. Maximum six divers per boat so the divemaster can give every diver personal attention.', 'dil' )
            ) ); ?>
            <div class="image-grid image-grid--3col" style="margin-top:28px;">
                <?php
                $boats = [
                    [ 'mod' => 'dil_img_boat1',     'alt' => __( 'Dive boat at the jetty', 'dil' ),         'caption' => __( 'The dive boat', 'dil' ),         'sub' => 'Morning departure' ],
                    [ 'mod' => 'dil_img_boat2',     'alt' => __( 'Divers entering the water', 'dil' ),       'caption' => __( 'Giant stride entry', 'dil' ),    'sub' => 'House reef' ],
                    [ 'mod' => 'dil_img_boat3',     'alt' => __( 'Divemaster briefing', 'dil' ),             'caption' => __( 'Pre-dive briefing', 'dil' ),     'sub' => 'Daily' ],
                    [ 'mod' => 'dil_img_boat4',     'alt' => __( 'Dive boat at sunset', 'dil' ),             'caption' => __( 'Sunset return', 'dil' ),         'sub' => 'Afternoon dive' ],
                    [ 'mod' => 'dil_img_boat5',     'alt' => __( 'Dock and jetty', 'dil' ),                  'caption' => __( 'The jetty', 'dil' ),             'sub' => 'Kasawari Bay' ],
                    [ 'mod' => 'dil_img_boat6',     'alt' => __( 'Divers on surface', 'dil' ),               'caption' => __( 'Surface interval', 'dil' ),      'sub' => 'Between dives' ],
                ];
                foreach ( $boats as $tile ) :
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

        <!-- Section 2 — Camera room -->
        <div class="inner-section">
            <div class="section-head">
                <div class="section-head__number mono">02</div>
                <h2 class="section-head__title"><?php esc_html_e( 'The Camera Room', 'dil' ); ?></h2>
            </div>
            <?php echo apply_filters( 'the_content', get_theme_mod( 'dil_text_diving_camera', // phpcs:ignore
                __( 'A dedicated camera room with individual rinse tanks, drying racks, laptop stations with colour-calibrated displays, and high-speed charging. Macro workshops available on request.', 'dil' )
            ) ); ?>
            <div class="image-grid image-grid--3col" style="margin-top:28px;">
                <?php
                $camera_room = [
                    [ 'mod' => 'dil_img_cam1', 'alt' => __( 'Camera room rinse tanks', 'dil' ),          'caption' => __( 'Rinse tanks', 'dil' ),           'sub' => 'Individual' ],
                    [ 'mod' => 'dil_img_cam2', 'alt' => __( 'Drying racks for camera gear', 'dil' ),      'caption' => __( 'Drying racks', 'dil' ),          'sub' => 'Camera room' ],
                    [ 'mod' => 'dil_img_cam3', 'alt' => __( 'Laptop station for editing', 'dil' ),        'caption' => __( 'Editing station', 'dil' ),       'sub' => 'Colour-calibrated' ],
                    [ 'mod' => 'dil_img_cam4', 'alt' => __( 'Underwater camera housing', 'dil' ),         'caption' => __( 'Camera housing', 'dil' ),        'sub' => 'Rental available' ],
                    [ 'mod' => 'dil_img_cam5', 'alt' => __( 'Macro photography setup', 'dil' ),           'caption' => __( 'Macro setup', 'dil' ),           'sub' => 'Workshop' ],
                    [ 'mod' => 'dil_img_cam6', 'alt' => __( 'Charging station', 'dil' ),                  'caption' => __( 'Charging station', 'dil' ),      'sub' => 'High-speed' ],
                ];
                foreach ( $camera_room as $tile ) :
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

        <!-- Section 3 — House reefs -->
        <div class="inner-section">
            <div class="section-head">
                <div class="section-head__number mono">03</div>
                <h2 class="section-head__title"><?php esc_html_e( 'House Reefs', 'dil' ); ?></h2>
            </div>
            <?php echo apply_filters( 'the_content', get_theme_mod( 'dil_text_diving_reefs', // phpcs:ignore
                __( 'Hairball and Aw Shucks — two of the most celebrated muck sites on earth — are our house reefs. Entry directly from the resort. Maximum depth 15m. Night dives on Hairball are legendary.', 'dil' )
            ) ); ?>
            <div class="image-grid image-grid--2col" style="margin-top:28px;">
                <?php
                $reefs = [
                    [ 'mod' => 'dil_img_hairball',  'alt' => __( 'Hairball house reef', 'dil' ),    'caption' => __( 'Hairball', 'dil' ),   'sub' => 'House reef · 0 – 15m' ],
                    [ 'mod' => 'dil_img_awshucks',  'alt' => __( 'Aw Shucks house reef', 'dil' ),   'caption' => __( 'Aw Shucks', 'dil' ),  'sub' => 'House reef · 0 – 12m' ],
                ];
                foreach ( $reefs as $tile ) :
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

        <!-- Section 4 — Muck diving explainer -->
        <div class="inner-section">
            <div class="section-head">
                <h2 class="section-head__title"><?php esc_html_e( 'Muck Diving in the Lembeh Strait', 'dil' ); ?></h2>
            </div>
            <div style="border:1px solid var(--border); padding:32px 28px;">
                <p class="section__lead" style="margin-bottom:24px;">
                    <?php esc_html_e( 'What makes the Lembeh Strait special is what isn\'t there: the coral.', 'dil' ); ?>
                </p>
                <?php
                $muck_points = [
                    [
                        'heading' => __( 'Why the black sand?', 'dil' ),
                        'body'    => __( 'Volcanic run-off from the mountains has created a silty, nutrient-rich substrate that\'s irresistible to critters who hide rather than swim. The strait is effectively a wall-to-wall ambush party.', 'dil' ),
                    ],
                    [
                        'heading' => __( 'Cryptic species', 'dil' ),
                        'body'    => __( 'Mimic octopus, hairy frogfish, blue-ringed octopus, flamboyant cuttlefish, mandarin fish — the Lembeh Strait harbours more weird and wonderful species per square metre than anywhere else on earth.', 'dil' ),
                    ],
                    [
                        'heading' => __( 'The slow dive', 'dil' ),
                        'body'    => __( 'Muck diving is done slowly. You hover above the substrate, move in centimetres, and wait. A 60-minute dive might cover 50 metres. That\'s how it\'s supposed to work.', 'dil' ),
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
