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

        <!-- Anchor sub-nav -->
        <nav class="info-subnav" aria-label="<?php esc_attr_e( 'Page sections', 'dil' ); ?>">
            <a href="#bungalows"><?php esc_html_e( 'Bungalows', 'dil' ); ?></a>
            <a href="#suite"><?php esc_html_e( 'Bungalow Suite', 'dil' ); ?></a>
            <a href="#longhouse"><?php esc_html_e( 'Longhouse Rooms', 'dil' ); ?></a>
            <a href="#pool"><?php esc_html_e( 'Swimming Pool', 'dil' ); ?></a>
            <a href="#restaurant"><?php esc_html_e( 'Restaurant &amp; Bar', 'dil' ); ?></a>
            <a href="#environment"><?php esc_html_e( 'Environment', 'dil' ); ?></a>
        </nav>

        <!-- Section 1 — Bungalows -->
        <div class="inner-section" id="bungalows">
            <div class="section-head">
                <div class="section-head__number mono">01</div>
                <h2 class="section-head__title"><?php esc_html_e( 'Bungalows', 'dil' ); ?></h2>
            </div>
            <?php echo apply_filters( 'the_content', get_theme_mod( 'dil_text_resort_bungalows', // phpcs:ignore
                __( '<p>Dive into Lembeh\'s stand-alone bungalows have been laid out so that they all have a view of either our lush garden or our pool or the Lembeh Strait. All materials and labour for the construction of the bungalows was sourced locally to ensure that we put as much back into the local community as possible.</p><p>Our spacious bungalows come with satellite TV, air conditioning, ceiling fan, minibar, safe and ensuite western style bathroom with walk-in shower. Drinking water is provided in all bungalows in the form of a five-gallon hot &amp; cold-water dispenser, with tea and coffee facilities available for your use. We are the only resort in Lembeh where each bungalow has its own private Japanese-style Onsen (hot tub) on the balcony, perfect for relaxing after a fabulous day\'s diving in Lembeh!</p>', 'dil' )
            ) ); ?>
            <div class="image-grid image-grid--3col" style="margin-top:28px;">
                <?php
                $bungalows = [
                    [ 'mod' => 'dil_img_bung1',  'default' => DIL_URI . '/assets/images/resort/bungalow-bed.webp',          'alt' => __( 'Bungalow bedroom with four-poster bed', 'dil' ),          'caption' => __( 'Bedroom', 'dil' ),          'sub' => 'King-size bed' ],
                    [ 'mod' => 'dil_img_bung2',  'default' => DIL_URI . '/assets/images/site/onsen-evening.webp',                'alt' => __( 'Onsen at evening', 'dil' ),           'caption' => __( 'Onsen', 'dil' ),            'sub' => 'All bungalows' ],
                    [ 'mod' => 'dil_img_bung3',  'default' => DIL_URI . '/assets/images/resort/bungalow-interior.webp',       'alt' => __( 'Inside a bungalow', 'dil' ),        'caption' => __( 'Bungalow interior', 'dil' ),'sub' => 'Ensuite bathroom' ],
                    [ 'mod' => 'dil_img_bung4',  'default' => DIL_URI . '/assets/images/site/drone-room-3-and-5-scaled.webp',    'alt' => __( 'Bungalows from above', 'dil' ),       'caption' => __( 'Bungalows', 'dil' ),        'sub' => 'Drone view' ],
                    [ 'mod' => 'dil_img_bung5',  'default' => DIL_URI . '/assets/images/resort/bungalow-garden-path.webp',        'alt' => __( 'Garden path to a bungalow', 'dil' ),          'caption' => __( 'Garden entrance', 'dil' ),  'sub' => 'Grounds' ],
                    [ 'mod' => 'dil_img_bung6',  'default' => DIL_URI . '/assets/images/resort/bungalow-flowers.webp', 'alt' => __( 'Bungalow among frangipani', 'dil' ),    'caption' => __( 'Bungalow', 'dil' ),       'sub' => 'Garden setting' ],
                    [ 'mod' => 'dil_img_bung7',  'default' => DIL_URI . '/assets/images/resort/bungalow-garden.webp',     'alt' => __( 'Bungalow in the tropical garden', 'dil' ),         'caption' => __( 'Bungalow', 'dil' ),         'sub' => 'Tropical garden' ],
                    [ 'mod' => 'dil_img_bung8',  'default' => DIL_URI . '/assets/images/site/onsen-medium.webp',              'alt' => __( 'Onsen balcony', 'dil' ),              'caption' => __( 'Onsen balcony', 'dil' ),    'sub' => 'Daytime' ],
                    [ 'mod' => 'dil_img_bung9',  'default' => DIL_URI . '/assets/images/resort/bungalow-welcome.webp',        'alt' => __( 'Towel swans on the bed at check-in', 'dil' ),              'caption' => __( 'Welcome', 'dil' ),    'sub' => 'Every arrival' ],
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
        <div class="inner-section" id="suite">
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
                    [ 'mod' => 'dil_img_suite1', 'default' => DIL_URI . '/assets/images/resort/suite-bedroom.webp',  'alt' => __( 'Suite bedroom', 'dil' ),  'caption' => __( 'Suite bedroom', 'dil' ),  'sub' => 'King-size bed' ],
                    [ 'mod' => 'dil_img_suite2', 'default' => DIL_URI . '/assets/images/resort/suite-bathroom.webp', 'alt' => __( 'Suite open-air bathroom', 'dil' ), 'caption' => __( 'Rain shower', 'dil' ),     'sub' => 'Semi-open ensuite' ],
                    [ 'mod' => 'dil_img_suite3', 'default' => DIL_URI . '/assets/images/resort/suite-terrace.webp',  'alt' => __( 'Suite terrace', 'dil' ),  'caption' => __( 'Terrace', 'dil' ),         'sub' => 'Strait view' ],
                    [ 'mod' => 'dil_img_suite4', 'default' => DIL_URI . '/assets/images/resort/suite-living.webp', 'alt' => __( 'Suite living room', 'dil' ),   'caption' => __( 'Living room', 'dil' ),     'sub' => 'Separate lounge' ],
                    [ 'mod' => 'dil_img_suite5', 'default' => DIL_URI . '/assets/images/resort/suite-lounge.webp', 'alt' => __( 'Suite lounge with recliners', 'dil' ),   'caption' => __( 'Lounge', 'dil' ),          'sub' => 'Large TV' ],
                    [ 'mod' => 'dil_img_suite6', 'default' => DIL_URI . '/assets/images/resort/suite-outside.webp', 'alt' => __( 'The bungalow suite from outside', 'dil' ), 'caption' => __( 'Suite', 'dil' ), 'sub' => 'From the garden' ],
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
        <div class="inner-section" id="longhouse">
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
                    [ 'mod' => 'dil_img_lh1', 'default' => DIL_URI . '/assets/images/resort/longhouse.webp', 'alt' => __( 'Longhouse exterior', 'dil' ), 'caption' => __( 'Longhouse', 'dil' ),  'sub' => 'Exterior' ],
                    [ 'mod' => 'dil_img_lh2', 'default' => DIL_URI . '/assets/images/resort/longhouse-rooms.webp',           'alt' => __( 'Longhouse rooms 2 and 3', 'dil' ),     'caption' => __( 'Room', 'dil' ),       'sub' => 'Ensuite bathroom' ],
                    [ 'mod' => 'dil_img_lh3', 'default' => DIL_URI . '/assets/images/site/longhouse-scaled.webp',          'alt' => __( 'Longhouse interior', 'dil' ), 'caption' => __( 'Interior', 'dil' ),   'sub' => 'Air-conditioned' ],
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
        <div class="inner-section" id="pool">
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
                    [ 'mod' => 'dil_img_pool1', 'default' => DIL_URI . '/assets/images/resort/pool-day.webp',              'alt' => __( 'Pool overview', 'dil' ),       'caption' => __( 'Pool', 'dil' ),         'sub' => '18m × 6m' ],
                    [ 'mod' => 'dil_img_pool2', 'default' => DIL_URI . '/assets/images/site/new-pool-2-medium.webp',  'alt' => __( 'Pool and sun deck', 'dil' ),   'caption' => __( 'Sun deck', 'dil' ),     'sub' => 'Freshwater' ],
                    [ 'mod' => 'dil_img_pool3', 'default' => DIL_URI . '/assets/images/site/new-pool-view.webp',      'alt' => __( 'Pool with strait view', 'dil' ),'caption' => __( 'Strait view', 'dil' ), 'sub' => 'From the pool' ],
                    [ 'mod' => 'dil_img_pool4', 'default' => DIL_URI . '/assets/images/site/pool-5-rooms-dil-f-copy-medium.webp', 'alt' => __( 'Pool and bungalows', 'dil' ), 'caption' => __( 'Pool & bungalows', 'dil' ), 'sub' => 'Kasawari Bay' ],
                    [ 'mod' => 'dil_img_pool5', 'default' => DIL_URI . '/assets/images/site/dil001.webp',              'alt' => __( 'Pool bar area', 'dil' ),       'caption' => __( 'Pool bar', 'dil' ),     'sub' => 'Evening' ],
                    [ 'mod' => 'dil_img_pool6', 'default' => DIL_URI . '/assets/images/resort/pool-night.webp',    'alt' => __( 'Pool lit up at night', 'dil' ),        'caption' => __( 'Pool', 'dil' ),         'sub' => 'After dark' ],
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
        <div class="inner-section" id="restaurant">
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
                    [ 'mod' => 'dil_img_rest1', 'default' => DIL_URI . '/assets/images/resort/restaurant.webp',        'alt' => __( 'Open-air restaurant', 'dil' ),   'caption' => __( 'Restaurant', 'dil' ),      'sub' => 'Open-air dining' ],
                    [ 'mod' => 'dil_img_rest2', 'default' => DIL_URI . '/assets/images/site/3-resort-aerial-scaled.webp',       'alt' => __( 'Resort aerial view', 'dil' ),    'caption' => __( 'Resort aerial', 'dil' ),   'sub' => 'Drone' ],
                    [ 'mod' => 'dil_img_rest3', 'default' => DIL_URI . '/assets/images/site/signature.webp',                    'alt' => __( 'Signature dish', 'dil' ),        'caption' => __( 'Signature dish', 'dil' ),  'sub' => 'Daily menu' ],
                    [ 'mod' => 'dil_img_rest4', 'default' => DIL_URI . '/assets/images/site/drone-high-medium.webp',         'alt' => __( 'Resort from high above', 'dil' ),'caption' => __( 'High aerial', 'dil' ),     'sub' => 'Drone' ],
                    [ 'mod' => 'dil_img_rest5', 'default' => DIL_URI . '/assets/images/resort/restaurant-evening.webp',   'alt' => __( 'Restaurant in the evening', 'dil' ),         'caption' => __( 'Restaurant', 'dil' ),     'sub' => 'Evening' ],
                    [ 'mod' => 'dil_img_rest6', 'default' => DIL_URI . '/assets/images/resort/bar-night.webp', 'alt' => __( 'The bar at night', 'dil' ),       'caption' => __( 'Bar', 'dil' ),     'sub' => 'After the night dive' ],
                    [ 'mod' => 'dil_img_rest7', 'default' => DIL_URI . '/assets/images/resort/restaurant-table.webp',        'alt' => __( 'Table set for dinner', 'dil' ),       'caption' => __( 'Dinner', 'dil' ),     'sub' => 'Table set' ],
                    [ 'mod' => 'dil_img_rest8', 'default' => DIL_URI . '/assets/images/site/dil006.webp',                    'alt' => __( 'Resort grounds', 'dil' ),        'caption' => __( 'Resort grounds', 'dil' ),  'sub' => 'Grounds' ],
                    [ 'mod' => 'dil_img_rest9', 'default' => DIL_URI . '/assets/images/site/dil-drone-1.webp',               'alt' => __( 'Resort drone shot', 'dil' ),     'caption' => __( 'Drone view', 'dil' ),      'sub' => 'Kasawari Bay' ],
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
        <div class="inner-section" id="environment">
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
