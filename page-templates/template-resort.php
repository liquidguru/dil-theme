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

$cdn18 = 'https://diveintolembeh.com/wp-content/uploads/2018/';
$cdn25 = 'https://diveintolembeh.com/wp-content/uploads/2025/07/';
?>

<?php dil_page_banner( [
    'kicker'   => __( 'Kasawari Bay, North Sulawesi', 'dil' ),
    'title'    => __( 'The Resort', 'dil' ),
    'subtitle' => __( '9 bungalows · 1 suite · 3 longhouse rooms on the water\'s edge', 'dil' ),
    'bg_url'   => $banner_img,
] ); ?>

<div class="inner-page">

    <main class="inner-page__main" id="main-content" tabindex="-1">

        <!-- Section 1 — Bungalows -->
        <div class="inner-section">
            <div class="section-head">
                <div class="section-head__number mono">01</div>
                <h2 class="section-head__title"><?php esc_html_e( 'Bungalows', 'dil' ); ?></h2>
            </div>
            <?php echo apply_filters( 'the_content', get_theme_mod( 'dil_text_resort_bungalows', // phpcs:ignore
                __( '<p>Dive into Lembeh\'s stand-alone bungalows have been laid out so that they all have a view of the Lembeh Strait. All materials and labour for the construction of the bungalows was sourced locally to ensure that we put as much back into the local community as possible.</p><p>Our spacious bungalows come with satellite TV, air conditioning, ceiling fan, minibar, safe and ensuite western style bathroom with walk-in shower. Drinking water is provided in all bungalows in the form of a five-gallon hot &amp; cold-water dispenser, with tea and coffee facilities available for your use. We are the only resort in Lembeh where each bungalow has its own private Japanese-style Onsen (hot tub) on the balcony, perfect for relaxing after a fabulous day\'s diving in Lembeh!</p>', 'dil' )
            ) ); ?>
            <div class="image-grid image-grid--3col" style="margin-top:28px;">
                <?php
                $bungalows = [
                    [ 'mod' => 'dil_img_bung1',  'default' => $cdn25 . 'Bungalow-bed-scaled.jpg',          'alt' => __( 'Bungalow bedroom', 'dil' ),          'caption' => __( 'Bedroom', 'dil' ),          'sub' => 'King-size bed' ],
                    [ 'mod' => 'dil_img_bung2',  'default' => $cdn25 . 'Onsen-Evening.jpg',                'alt' => __( 'Onsen at evening', 'dil' ),           'caption' => __( 'Onsen', 'dil' ),            'sub' => 'All bungalows' ],
                    [ 'mod' => 'dil_img_bung3',  'default' => $cdn25 . 'inside-bungalow-scaled.jpg',       'alt' => __( 'Inside the bungalow', 'dil' ),        'caption' => __( 'Bungalow interior', 'dil' ),'sub' => 'Ensuite bathroom' ],
                    [ 'mod' => 'dil_img_bung4',  'default' => $cdn25 . 'Drone-room-3-and-5-scaled.png',    'alt' => __( 'Bungalows from above', 'dil' ),       'caption' => __( 'Bungalows', 'dil' ),        'sub' => 'Drone view' ],
                    [ 'mod' => 'dil_img_bung5',  'default' => $cdn25 . 'bungalow-with-flowers.jpg',        'alt' => __( 'Bungalow exterior', 'dil' ),          'caption' => __( 'Garden entrance', 'dil' ),  'sub' => 'Grounds' ],
                    [ 'mod' => 'dil_img_bung6',  'default' => $cdn18 . '05/front-view-bungalow-4-Medium.jpg', 'alt' => __( 'Bungalow front view', 'dil' ),    'caption' => __( 'Bungalow 4', 'dil' ),       'sub' => 'Front view' ],
                    [ 'mod' => 'dil_img_bung7',  'default' => $cdn18 . '03/Room-side-view-Medium.jpg',     'alt' => __( 'Bungalow side view', 'dil' ),         'caption' => __( 'Bungalow', 'dil' ),         'sub' => 'Side view' ],
                    [ 'mod' => 'dil_img_bung8',  'default' => $cdn18 . '05/Onsen-Medium.jpg',              'alt' => __( 'Onsen balcony', 'dil' ),              'caption' => __( 'Onsen balcony', 'dil' ),    'sub' => 'Daytime' ],
                    [ 'mod' => 'dil_img_bung9',  'default' => $cdn18 . '05/Room-inside-Medium.jpg',        'alt' => __( 'Room interior', 'dil' ),              'caption' => __( 'Room interior', 'dil' ),    'sub' => 'Air-conditioned' ],
                    [ 'mod' => 'dil_img_bung10', 'default' => $cdn18 . '05/17-Bungalow-Bedroom-Medium.jpg','alt' => __( 'Bungalow bedroom', 'dil' ),           'caption' => __( 'Bedroom', 'dil' ),          'sub' => 'Strait view' ],
                ];
                foreach ( $bungalows as $tile ) :
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

        <!-- Section 2 — Bungalow Suite -->
        <div class="inner-section">
            <div class="section-head">
                <div class="section-head__number mono">02</div>
                <h2 class="section-head__title"><?php esc_html_e( 'Bungalow Suite', 'dil' ); ?></h2>
            </div>
            <?php echo apply_filters( 'the_content', get_theme_mod( 'dil_text_resort_suite', // phpcs:ignore
                __( '<p>Our bungalow suite is perfectly suited for a couple and comes with a bedroom with king-size bed, a separate lounge area with large TV and comfy relax chairs and has a big semi-open ensuite bathroom with rain shower. The suite has 2 air conditioning units, ceiling fans, minibar, safe, and a hot &amp; cold-water dispenser drinking water and tea and coffee. The large balcony has a Japanese style onsen, to end a perfect day\'s diving.</p>', 'dil' )
            ) ); ?>
            <div class="image-grid image-grid--3col" style="margin-top:28px;">
                <?php
                $suite = [
                    [ 'mod' => 'dil_img_suite1', 'default' => $cdn25 . 'suite-bedroom.jpg',  'alt' => __( 'Suite bedroom', 'dil' ),  'caption' => __( 'Suite bedroom', 'dil' ),  'sub' => 'King-size bed' ],
                    [ 'mod' => 'dil_img_suite2', 'default' => $cdn25 . 'suite-bathroom.jpg', 'alt' => __( 'Suite bathroom', 'dil' ), 'caption' => __( 'Rain shower', 'dil' ),     'sub' => 'Semi-open ensuite' ],
                    [ 'mod' => 'dil_img_suite3', 'default' => $cdn25 . 'suite-veranda.jpg',  'alt' => __( 'Suite veranda', 'dil' ),  'caption' => __( 'Veranda', 'dil' ),         'sub' => 'Strait view' ],
                    [ 'mod' => 'dil_img_suite4', 'default' => $cdn25 . 'suite-lounge-3.jpg', 'alt' => __( 'Suite lounge', 'dil' ),   'caption' => __( 'Lounge area', 'dil' ),     'sub' => 'Separate lounge' ],
                    [ 'mod' => 'dil_img_suite5', 'default' => $cdn25 . 'suite-lounge-2.jpg', 'alt' => __( 'Suite lounge', 'dil' ),   'caption' => __( 'Lounge', 'dil' ),          'sub' => 'Large TV' ],
                ];
                foreach ( $suite as $tile ) :
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

        <!-- Section 3 — Longhouse Rooms -->
        <div class="inner-section">
            <div class="section-head">
                <div class="section-head__number mono">03</div>
                <h2 class="section-head__title"><?php esc_html_e( 'Longhouse Rooms', 'dil' ); ?></h2>
            </div>
            <?php echo apply_filters( 'the_content', get_theme_mod( 'dil_text_resort_longhouse', // phpcs:ignore
                __( '<p>Our longhouse rooms are a budget option for guests that still want a comfy room but not the luxury of our bungalows. These 3 rooms are located under one roof and have our standard comfy beds, air conditioning, minibar, safe and an ensuite bathroom with shower and balcony.</p>', 'dil' )
            ) ); ?>
            <div class="image-grid image-grid--3col" style="margin-top:28px;">
                <?php
                $longhouse = [
                    [ 'mod' => 'dil_img_lh1', 'default' => $cdn25 . 'Longhouse-outside-scaled.jpg', 'alt' => __( 'Longhouse exterior', 'dil' ), 'caption' => __( 'Longhouse', 'dil' ),  'sub' => 'Exterior' ],
                    [ 'mod' => 'dil_img_lh2', 'default' => $cdn25 . 'P1012348-scaled.jpg',           'alt' => __( 'Longhouse room', 'dil' ),     'caption' => __( 'Room', 'dil' ),       'sub' => 'Ensuite bathroom' ],
                    [ 'mod' => 'dil_img_lh3', 'default' => $cdn25 . 'Longhouse-scaled.jpg',          'alt' => __( 'Longhouse interior', 'dil' ), 'caption' => __( 'Interior', 'dil' ),   'sub' => 'Air-conditioned' ],
                ];
                foreach ( $longhouse as $tile ) :
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

        <!-- Section 4 — Swimming Pool -->
        <div class="inner-section">
            <div class="section-head">
                <div class="section-head__number mono">04</div>
                <h2 class="section-head__title"><?php esc_html_e( 'Swimming Pool', 'dil' ); ?></h2>
            </div>
            <?php echo apply_filters( 'the_content', get_theme_mod( 'dil_text_resort_pool', // phpcs:ignore
                __( '<p>Our resort has an 18m by 6m fresh water swimming pool with a spacious sun deck for sunbathing in between dives, offering a view over the Lembeh Strait.</p>', 'dil' )
            ) ); ?>
            <div class="image-grid image-grid--3col" style="margin-top:28px;">
                <?php
                $pool = [
                    [ 'mod' => 'dil_img_pool1', 'default' => $cdn18 . '05/dil008.jpg',              'alt' => __( 'Pool overview', 'dil' ),       'caption' => __( 'Pool', 'dil' ),         'sub' => '18m × 6m' ],
                    [ 'mod' => 'dil_img_pool2', 'default' => $cdn18 . '03/New-Pool-2-Medium.jpeg',  'alt' => __( 'Pool and sun deck', 'dil' ),   'caption' => __( 'Sun deck', 'dil' ),     'sub' => 'Freshwater' ],
                    [ 'mod' => 'dil_img_pool3', 'default' => $cdn18 . '03/New-Pool-view.jpeg',      'alt' => __( 'Pool with strait view', 'dil' ),'caption' => __( 'Strait view', 'dil' ), 'sub' => 'From the pool' ],
                    [ 'mod' => 'dil_img_pool4', 'default' => $cdn18 . '05/pool-5-rooms-DIL-F-copy-Medium.jpg', 'alt' => __( 'Pool and bungalows', 'dil' ), 'caption' => __( 'Pool & bungalows', 'dil' ), 'sub' => 'Kasawari Bay' ],
                    [ 'mod' => 'dil_img_pool5', 'default' => $cdn18 . '05/dil001.jpg',              'alt' => __( 'Pool bar area', 'dil' ),       'caption' => __( 'Pool bar', 'dil' ),     'sub' => 'Evening' ],
                    [ 'mod' => 'dil_img_pool6', 'default' => $cdn18 . '03/New-Pool-Medium.jpeg',    'alt' => __( 'Pool at dawn', 'dil' ),        'caption' => __( 'Pool', 'dil' ),         'sub' => 'Dawn' ],
                ];
                foreach ( $pool as $tile ) :
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

        <!-- Section 5 — Restaurant & Bar -->
        <div class="inner-section">
            <div class="section-head">
                <div class="section-head__number mono">05</div>
                <h2 class="section-head__title"><?php esc_html_e( 'Restaurant &amp; Bar', 'dil' ); ?></h2>
            </div>
            <?php echo apply_filters( 'the_content', get_theme_mod( 'dil_text_resort_restaurant', // phpcs:ignore
                __( '<p>All meals are served in our open-air restaurant, and our experienced cooks provide you with a great selection of local and international dishes, with fresh baked breads made daily for you.</p><p>For the evenings, we have a fully stocked bar, and our photo-pro and marine biologist give presentations on our large TV in the restaurant on a regular basis. Our fully stocked bar is a great place to hang out and swap diving stories with other guests or staff.</p>', 'dil' )
            ) ); ?>
            <div class="image-grid image-grid--3col" style="margin-top:28px;">
                <?php
                $restaurant = [
                    [ 'mod' => 'dil_img_rest1', 'default' => $cdn25 . 'Open-air-resto-scaled.jpg',        'alt' => __( 'Open-air restaurant', 'dil' ),   'caption' => __( 'Restaurant', 'dil' ),      'sub' => 'Open-air dining' ],
                    [ 'mod' => 'dil_img_rest2', 'default' => $cdn25 . '3-Resort-Aerial-scaled.jpg',       'alt' => __( 'Resort aerial view', 'dil' ),    'caption' => __( 'Resort aerial', 'dil' ),   'sub' => 'Drone' ],
                    [ 'mod' => 'dil_img_rest3', 'default' => $cdn25 . 'Signature.jpg',                    'alt' => __( 'Signature dish', 'dil' ),        'caption' => __( 'Signature dish', 'dil' ),  'sub' => 'Daily menu' ],
                    [ 'mod' => 'dil_img_rest4', 'default' => $cdn18 . '05/Drone-high-Medium.jpg',         'alt' => __( 'Resort from high above', 'dil' ),'caption' => __( 'High aerial', 'dil' ),     'sub' => 'Drone' ],
                    [ 'mod' => 'dil_img_rest5', 'default' => $cdn18 . '05/4-Resort-Aerial3-Medium.jpg',   'alt' => __( 'Resort aerial', 'dil' ),         'caption' => __( 'Aerial view', 'dil' ),     'sub' => 'Drone' ],
                    [ 'mod' => 'dil_img_rest6', 'default' => $cdn18 . '05/4A-Resort-aerial-2-Medium.jpg', 'alt' => __( 'Resort aerial 2', 'dil' ),       'caption' => __( 'Aerial view', 'dil' ),     'sub' => 'Drone' ],
                    [ 'mod' => 'dil_img_rest7', 'default' => $cdn18 . '05/3A-Aerial-4-Medium.jpg',        'alt' => __( 'Resort aerial 3', 'dil' ),       'caption' => __( 'Aerial view', 'dil' ),     'sub' => 'Drone' ],
                    [ 'mod' => 'dil_img_rest8', 'default' => $cdn18 . '05/dil006.jpg',                    'alt' => __( 'Resort grounds', 'dil' ),        'caption' => __( 'Resort grounds', 'dil' ),  'sub' => 'Grounds' ],
                    [ 'mod' => 'dil_img_rest9', 'default' => $cdn18 . '03/DIL_drone-1.jpg',               'alt' => __( 'Resort drone shot', 'dil' ),     'caption' => __( 'Drone view', 'dil' ),      'sub' => 'Kasawari Bay' ],
                ];
                foreach ( $restaurant as $tile ) :
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

        <!-- Section 6 — Environmental Commitment (text only) -->
        <div class="inner-section">
            <div class="section-head">
                <div class="section-head__number mono">06</div>
                <h2 class="section-head__title"><?php esc_html_e( 'Environmental Commitment', 'dil' ); ?></h2>
            </div>
            <?php echo apply_filters( 'the_content', get_theme_mod( 'dil_text_resort_environment', // phpcs:ignore
                __( '<p>Because we respect our environment, we do not use plastic bottles or straws in the resort. Guests are given their own personal refillable water tumbler on check in, which they get to keep as a souvenir of their stay with us. To minimise our carbon footprint, we kindly ask guests to be conservative in the use of water and electricity and turn lights and TV off whilst not in the room.</p><p>We do not fumigate against mosquitoes. We have seen the impact these chemicals have on butterflies, small lizards and other wildlife which we all treasure, and instead, we provide mosquito repellants for all our guests.</p>', 'dil' )
            ) ); ?>
        </div>

    </main>

    <?php dil_sidebar(); ?>

</div><!-- .inner-page -->

<?php get_footer(); ?>
