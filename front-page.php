<?php
/**
 * Front page template — Dive Into Lembeh home page.
 *
 * Photo assignments (set in Appearance → Customize → Hero Images,
 * or assign the page a featured image for the hero):
 *
 *   Hero:            theme_mod 'dil_hero_image' — full-bleed macro shot
 *   Explore section: theme_mod 'dil_explore_image' — wide-angle/atmospheric
 */

get_header();

// Photo helpers
$explore_img = get_theme_mod( 'dil_explore_image', '' );

// Hero slideshow — up to 5 slides, falls back to dil_hero_image or placeholder
$hero_slides = array_values( array_filter( [
    get_theme_mod( 'dil_hero_slide_1', '' ),
    get_theme_mod( 'dil_hero_slide_2', '' ),
    get_theme_mod( 'dil_hero_slide_3', '' ),
    get_theme_mod( 'dil_hero_slide_4', '' ),
    get_theme_mod( 'dil_hero_slide_5', '' ),
] ) );
if ( empty( $hero_slides ) ) {
    $fallback = get_theme_mod( 'dil_hero_image', '' );
    if ( $fallback ) $hero_slides = [ $fallback ];
}
?>

<!-- ═══════════════════════════════════════════════════════════
     SECTION 1 — HERO
     ═══════════════════════════════════════════════════════════ -->
<section class="hero" aria-label="<?php esc_attr_e( 'Hero', 'dil' ); ?>">

    <div class="hero__bg" id="hero-bg">
        <?php if ( ! empty( $hero_slides ) ) : ?>
            <?php foreach ( $hero_slides as $i => $slide_url ) : ?>
                <img src="<?php echo esc_url( $slide_url ); ?>"
                     class="hero__slide<?php echo $i === 0 ? ' is-active' : ''; ?>"
                     alt="<?php esc_attr_e( 'Macro critter on the black volcanic sand of the Lembeh Strait', 'dil' ); ?>"
                     loading="<?php echo $i === 0 ? 'eager' : 'lazy'; ?>"
                     <?php echo $i === 0 ? 'fetchpriority="high"' : ''; ?>>
            <?php endforeach; ?>
        <?php elseif ( has_post_thumbnail() ) : ?>
            <?php the_post_thumbnail( 'dil-hero', [ 'loading' => 'eager', 'fetchpriority' => 'high', 'class' => 'hero__slide is-active' ] ); ?>
        <?php else : ?>
            <?php echo dil_placeholder( 'Hero — macro critter full-bleed' ); // phpcs:ignore ?>
        <?php endif; ?>
    </div>

    <div class="hero__gradient" aria-hidden="true"></div>

    <div class="hero__meta-tl mono" aria-hidden="true">
        01&deg;&nbsp;39'&nbsp;N&nbsp;&nbsp;125&deg;&nbsp;14'&nbsp;E
    </div>
    <div class="hero__meta-tr mono" aria-hidden="true">
        —&nbsp;<?php esc_html_e( '3 house reefs', 'dil' ); ?>
        &nbsp;·&nbsp;<?php esc_html_e( '2 dive boats', 'dil' ); ?>
        &nbsp;·&nbsp;<?php esc_html_e( 'since 2007', 'dil' ); ?>
    </div>

    <div class="hero__content">
        <h1 class="hero__headline dil-wordmark">
            <?php esc_html_e( 'Dive', 'dil' ); ?>
            <em><?php esc_html_e( 'into', 'dil' ); ?></em>
            <?php esc_html_e( 'Lembeh', 'dil' ); ?>
        </h1>
        <div class="hero__ctas">
            <a href="<?php echo esc_url( home_url( '/galleries/' ) ); ?>" class="btn btn-outline">
                <?php esc_html_e( 'Browse Galleries', 'dil' ); ?>
            </a>
            <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="btn btn-primary">
                <?php esc_html_e( 'Reserve a Bungalow', 'dil' ); ?>
            </a>
        </div>
    </div>

    <!-- Bottom wave — cream fill blends into the section below -->
    <svg class="hero__wave" viewBox="0 0 1440 60" preserveAspectRatio="none" aria-hidden="true">
        <path d="M0 60 L0 30 Q120 10 240 30 T480 30 T720 30 T960 30 T1200 30 T1440 30 L1440 60 Z" fill="#FFFFFF"/>
    </svg>

</section>

<!-- ═══════════════════════════════════════════════════════════
     SECTION 2 — MUCK DIVING HEAVEN INTRO
     ═══════════════════════════════════════════════════════════ -->
<section class="section section--centered" style="padding-top:120px; padding-bottom:100px;">

    <p class="eyebrow section__kicker"><?php esc_html_e( 'Lembeh Strait, North Sulawesi', 'dil' ); ?></p>

    <h2 class="section__heading">
        <?php esc_html_e( 'Muck Diving', 'dil' ); ?>
        <em><?php esc_html_e( 'Heaven', 'dil' ); ?></em>
    </h2>

    <div class="section__body" style="margin-top:28px;">
        <?php
        // Pull from the WP front page's content if it has text
        $fp = get_post( get_option( 'page_on_front' ) );
        if ( $fp && ! empty( trim( $fp->post_content ) ) ) {
            echo apply_filters( 'the_content', $fp->post_content ); // phpcs:ignore
        } else {
            ?>
            <p class="section__lead">
                <?php esc_html_e( 'The Lembeh Strait is the muck-diving capital of the world — a narrow stretch of black volcanic sand between the Indonesian mainland and Lembeh Island where critters hide in plain sight.', 'dil' ); ?>
            </p>
            <p style="margin-top:20px;">
                <?php esc_html_e( 'Dive Into Lembeh sits right on its western shore. Our house reefs — Hairball and Aw Shucks — are among the most celebrated muck sites on earth. Three dives a day, unhurried, guided by our experienced local divemasters who know every crevice.', 'dil' ); ?>
            </p>
            <?php
        }
        ?>
    </div>

</section>

<hr class="section-rule" style="margin:0 <?php echo esc_attr( 'var(--outer-pad)' ); ?>;">

<!-- ═══════════════════════════════════════════════════════════
     SECTION 3 — SPECS RIBBON
     ═══════════════════════════════════════════════════════════ -->
<div class="specs-ribbon">
    <p class="specs-ribbon__inner">
        <?php esc_html_e( '9 bungalows · 1 suite · 3 longhouse rooms · 2 house reefs · 1 fresh-water pool · 1 camera room', 'dil' ); ?>
    </p>
</div>

<!-- ═══════════════════════════════════════════════════════════
     SECTION 4 — COME, EXPLORE LEMBEH (full-bleed)
     ═══════════════════════════════════════════════════════════ -->
<section class="section--fullbleed" style="min-height:520px;">

    <div class="section__bg">
        <?php if ( $explore_img ) : ?>
            <img src="<?php echo esc_url( $explore_img ); ?>"
                 alt="<?php esc_attr_e( 'The Lembeh Strait at golden hour', 'dil' ); ?>"
                 loading="lazy">
        <?php else : ?>
            <?php echo dil_placeholder( 'Full-bleed — Lembeh Strait / resort wide shot' ); // phpcs:ignore ?>
        <?php endif; ?>
    </div>

    <div class="section__overlay" aria-hidden="true"></div>

    <div class="section__content">
        <h2 class="section__heading">
            <?php esc_html_e( 'Come,', 'dil' ); ?><br>
            <span class="cycle-words" aria-live="polite">
                <span class="cycle-words__word is-active"><em><?php esc_html_e( 'explore', 'dil' ); ?></em></span>
                <span class="cycle-words__word"><em><?php esc_html_e( 'discover', 'dil' ); ?></em></span>
                <span class="cycle-words__word"><em><?php esc_html_e( 'dive into', 'dil' ); ?></em></span>
            </span>
            <?php esc_html_e( 'Lembeh.', 'dil' ); ?>
        </h2>

        <!-- Wax seal SVG -->
        <svg class="wax-seal" viewBox="0 0 100 100" aria-hidden="true">
            <defs>
                <radialGradient id="seal-grad" cx="38%" cy="38%" r="62%">
                    <stop offset="0%"   stop-color="#8F3033"/>
                    <stop offset="100%" stop-color="#4A1517"/>
                </radialGradient>
            </defs>
            <!-- Outer ring with spiky edge -->
            <circle cx="50" cy="50" r="46" fill="url(#seal-grad)"/>
            <!-- Inner circle border -->
            <circle cx="50" cy="50" r="38" fill="none" stroke="rgba(245,236,220,0.35)" stroke-width="1"/>
            <!-- DIL monogram -->
            <text x="50" y="55" text-anchor="middle" font-size="18"
                  font-family="'code-pro-light-lc', sans-serif" letter-spacing="4"
                  fill="rgba(245,236,220,0.85)">DIL</text>
            <!-- Outer spike ring (decorative) -->
            <?php
            for ( $i = 0; $i < 24; $i++ ) {
                $a = $i * 15 * M_PI / 180;
                $x1 = 50 + 46 * cos( $a );
                $y1 = 50 + 46 * sin( $a );
                $x2 = 50 + 50 * cos( $a + 7.5 * M_PI / 180 );
                $y2 = 50 + 50 * sin( $a + 7.5 * M_PI / 180 );
                $x3 = 50 + 46 * cos( $a + 15 * M_PI / 180 );
                $y3 = 50 + 46 * sin( $a + 15 * M_PI / 180 );
                echo '<path d="M' . round($x1,2) . ',' . round($y1,2)
                    . ' L' . round($x2,2) . ',' . round($y2,2)
                    . ' L' . round($x3,2) . ',' . round($y3,2) . ' Z"'
                    . ' fill="url(#seal-grad)"/>';
            }
            ?>
        </svg>

    </div>

</section>

<!-- ═══════════════════════════════════════════════════════════
     SECTION 5 — LEMBEH ANNOTATED (accordion)
     ═══════════════════════════════════════════════════════════ -->
<section class="section" style="padding-top:80px;padding-bottom:80px;">

    <div style="max-width:900px;margin:0 auto;">
        <p class="eyebrow section__kicker" style="margin-bottom:32px;">
            <?php esc_html_e( 'Everything you need to know', 'dil' ); ?>
        </p>

        <div class="accordion">

            <div class="accordion__item">
                <button class="accordion__trigger" aria-expanded="false">
                    <span class="accordion__number">01</span>
                    <span class="accordion__title"><?php esc_html_e( 'Getting Here', 'dil' ); ?></span>
                    <span class="accordion__icon" aria-hidden="true">+</span>
                </button>
                <div class="accordion__body">
                    <p><?php esc_html_e( 'Fly into Manado (Sam Ratulangi, MDC) via Jakarta or Singapore. From there it\'s an hour\'s drive to Bitung Harbour and a 15-minute speedboat to the resort. We arrange all transfers included in your package.', 'dil' ); ?></p>
                </div>
            </div>

            <div class="accordion__item">
                <button class="accordion__trigger" aria-expanded="false">
                    <span class="accordion__number">02</span>
                    <span class="accordion__title"><?php esc_html_e( 'Season &amp; Weather', 'dil' ); ?></span>
                    <span class="accordion__icon" aria-hidden="true">+</span>
                </button>
                <div class="accordion__body">
                    <p><?php esc_html_e( 'Diving is year-round. The dry season (May – October) brings calmer seas and best visibility. The wet season (November – April) can be choppy but the muck life is equally spectacular — and rates are lower.', 'dil' ); ?></p>
                </div>
            </div>

            <div class="accordion__item">
                <button class="accordion__trigger" aria-expanded="false">
                    <span class="accordion__number">03</span>
                    <span class="accordion__title"><?php esc_html_e( 'Diving Packages', 'dil' ); ?></span>
                    <span class="accordion__icon" aria-hidden="true">+</span>
                </button>
                <div class="accordion__body">
                    <p><?php esc_html_e( 'Packages include accommodation, three dives per day, tanks, weights, boat, divemaster guide, and all meals. Minimum stay is four nights. Equipment rental, nitrox, and night dives are available as add-ons.', 'dil' ); ?></p>
                </div>
            </div>

            <div class="accordion__item">
                <button class="accordion__trigger" aria-expanded="false">
                    <span class="accordion__number">04</span>
                    <span class="accordion__title"><?php esc_html_e( 'Photographer Studio', 'dil' ); ?></span>
                    <span class="accordion__icon" aria-hidden="true">+</span>
                </button>
                <div class="accordion__body">
                    <p><?php esc_html_e( 'Our dedicated camera room has individual rinse tanks, drying racks, laptop stations with colour-calibrated displays, and high-speed charging. We can arrange macro-photography workshops with visiting instructors on request.', 'dil' ); ?></p>
                </div>
            </div>

        </div><!-- .accordion -->
    </div>

</section>

<hr class="section-rule" style="margin:0 <?php echo esc_attr( 'var(--outer-pad)' ); ?>;">

<!-- ═══════════════════════════════════════════════════════════
     SECTION 6 — DIVE INTO LEMBEH (plate cards)
     ═══════════════════════════════════════════════════════════ -->
<section class="section section--centered">

    <p class="eyebrow section__kicker"><?php esc_html_e( 'The Experience', 'dil' ); ?></p>

    <h2 class="section__heading dil-wordmark">
        <?php esc_html_e( 'Dive', 'dil' ); ?><em><?php esc_html_e( 'into', 'dil' ); ?></em><?php esc_html_e( 'Lembeh', 'dil' ); ?>
    </h2>

    <p class="section__body" style="margin:24px auto 48px; max-width:660px;">
        <?php esc_html_e( 'Ten bungalows on the water\'s edge, two legendary muck sites at your doorstep, and a team that\'s been diving this strait since 2007.', 'dil' ); ?>
    </p>

    <div class="plate-cards">

        <div class="plate-card">
            <div class="plate-card__image">
                <?php
                $diving_card_img = get_theme_mod( 'dil_card_diving_image', '' );
                if ( $diving_card_img ) :
                ?>
                    <img src="<?php echo esc_url( $diving_card_img ); ?>"
                         alt="<?php esc_attr_e( 'Diver on the Lembeh house reef', 'dil' ); ?>"
                         loading="lazy">
                <?php else : ?>
                    <?php echo dil_placeholder( 'Incredible Diving — diver/critter shot' ); // phpcs:ignore ?>
                <?php endif; ?>
            </div>
            <div class="plate-card__label">
                <div class="plate-card__script"><?php esc_html_e( 'Incredible', 'dil' ); ?></div>
                <div class="plate-card__title"><?php esc_html_e( 'Diving', 'dil' ); ?></div>
            </div>
        </div>

        <div class="plate-card">
            <div class="plate-card__image">
                <?php
                $resort_card_img = get_theme_mod( 'dil_card_resort_image', '' );
                if ( $resort_card_img ) :
                ?>
                    <img src="<?php echo esc_url( $resort_card_img ); ?>"
                         alt="<?php esc_attr_e( 'Bungalow at Dive Into Lembeh resort', 'dil' ); ?>"
                         loading="lazy">
                <?php else : ?>
                    <?php echo dil_placeholder( 'Delightful Rooms — bungalow / suite shot' ); // phpcs:ignore ?>
                <?php endif; ?>
            </div>
            <div class="plate-card__label">
                <div class="plate-card__script"><?php esc_html_e( 'Delightful', 'dil' ); ?></div>
                <div class="plate-card__title"><?php esc_html_e( 'Rooms', 'dil' ); ?></div>
            </div>
        </div>

    </div><!-- .plate-cards -->

</section>

<!-- ═══════════════════════════════════════════════════════════
     SECTION 7 — CRITTER COMPASS
     ═══════════════════════════════════════════════════════════ -->
<section class="critter-compass">

    <div class="critter-compass__text">
        <p class="eyebrow section__kicker"><?php esc_html_e( 'What lives here', 'dil' ); ?></p>
        <h2 class="section__heading" style="font-size:52px;margin-bottom:20px;">
            <?php esc_html_e( 'Critter', 'dil' ); ?><br>
            <?php esc_html_e( 'Compass', 'dil' ); ?>
        </h2>
        <p class="section__body" style="font-size:16px;margin-bottom:32px;max-width:400px;">
            <?php esc_html_e( 'Hover any species on the dial to learn more about what you\'ll find on a dive here.', 'dil' ); ?>
        </p>

        <div class="critter-compass__info">
            <p class="critter-compass__placeholder">
                <em><?php esc_html_e( 'Hover a species on the dial', 'dil' ); ?></em>
            </p>
        </div>
    </div>

    <div class="critter-compass__svg-wrap">
        <svg class="critter-compass__svg" viewBox="0 0 520 520" aria-label="<?php esc_attr_e( 'Critter Compass — 8 macro species of the Lembeh Strait', 'dil' ); ?>" role="img">
            <!-- Built by main.js -->
        </svg>
    </div>

</section>

<!-- ═══════════════════════════════════════════════════════════
     SECTION 8 — FOUR MINUTES UNDER (video)
     ═══════════════════════════════════════════════════════════ -->
<section class="video-section">

    <p class="eyebrow section__kicker" style="margin-bottom:18px;">
        <?php esc_html_e( 'Watch', 'dil' ); ?>
    </p>
    <h2 class="video-section__heading">
        <?php esc_html_e( 'Four minutes under', 'dil' ); ?>
    </h2>

    <div class="video-frame">
        <div class="video-frame__inner">
            <?php
            $video_id = get_theme_mod( 'dil_hero_video_id', '' );
            if ( $video_id ) :
            ?>
                <iframe
                    src="https://player.vimeo.com/video/<?php echo esc_attr( $video_id ); ?>?color=6E1F22&byline=0&portrait=0"
                    title="<?php esc_attr_e( 'Dive Into Lembeh — four minutes underwater', 'dil' ); ?>"
                    frameborder="0"
                    allow="autoplay; fullscreen; picture-in-picture"
                    allowfullscreen
                    loading="lazy">
                </iframe>
            <?php else : ?>
                <?php echo dil_placeholder( 'Video — Vimeo embed (set dil_hero_video_id in Customizer)' ); // phpcs:ignore ?>
            <?php endif; ?>
        </div>
    </div>

</section>

<?php get_footer(); ?>
