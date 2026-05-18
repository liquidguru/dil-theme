<?php
/**
 * Template Name: Info
 *
 * Assign this template to the /info/ page in WordPress.
 * Consolidates Getting Here, FAQs, North Sulawesi, and Dive Insurance
 * into one long-read with anchor-link sub-nav.
 */

get_header();
require_once get_template_directory() . '/inc/inner-page.php';

$banner_img = get_theme_mod( 'dil_banner_info', '' );
if ( ! $banner_img && has_post_thumbnail() ) {
    $banner_img = get_the_post_thumbnail_url( null, 'dil-banner' );
}
?>

<?php dil_page_banner( [
    'kicker'   => __( 'Practical information', 'dil' ),
    'title'    => __( 'Info', 'dil' ),
    'subtitle' => __( 'Getting here, what to expect, and everything in between', 'dil' ),
    'bg_url'   => $banner_img,
] ); ?>

<div class="inner-page">

    <main class="inner-page__main" id="main-content" tabindex="-1">

        <!-- Anchor sub-nav -->
        <nav class="info-subnav" aria-label="<?php esc_attr_e( 'Page sections', 'dil' ); ?>">
            <a href="#getting-here"><?php esc_html_e( 'Getting Here', 'dil' ); ?></a>
            <a href="#faqs"><?php esc_html_e( 'FAQs', 'dil' ); ?></a>
            <a href="#north-sulawesi"><?php esc_html_e( 'North Sulawesi', 'dil' ); ?></a>
            <a href="#dive-insurance"><?php esc_html_e( 'Dive Insurance', 'dil' ); ?></a>
        </nav>

        <!-- Section 1 — Getting Here -->
        <div class="inner-section" id="getting-here">
            <div class="section-head">
                <div class="section-head__number mono">01</div>
                <h2 class="section-head__title"><?php esc_html_e( 'Getting Here', 'dil' ); ?></h2>
            </div>

            <?php
            $getting_here_img = get_theme_mod( 'dil_img_flight_map', '' );
            if ( $getting_here_img ) :
            ?>
                <img src="<?php echo esc_url( $getting_here_img ); ?>"
                     alt="<?php esc_attr_e( 'SE Asia flight map to Manado (MDC)', 'dil' ); ?>"
                     loading="lazy"
                     style="width:100%;margin-bottom:28px;">
            <?php else : ?>
                <?php echo dil_placeholder( 'SE Asia flight map to Manado (MDC)' ); // phpcs:ignore ?>
            <?php endif; ?>

            <p style="margin-bottom:20px;">
                <?php esc_html_e( 'Fly into Manado (Sam Ratulangi International, MDC) via Jakarta (Garuda, Lion Air, Batik Air) or Singapore (Silk Air). From Manado airport it\'s 45 minutes to Bitung Harbour; from there a 15-minute speedboat to the resort. We organise all transfers.', 'dil' ); ?>
            </p>

            <div class="accordion" style="margin-top:24px;">
                <div class="accordion__item">
                    <button class="accordion__trigger" aria-expanded="false">
                        <span class="accordion__number"></span>
                        <span class="accordion__title"><?php esc_html_e( 'Visa on arrival', 'dil' ); ?></span>
                        <span class="accordion__icon" aria-hidden="true">+</span>
                    </button>
                    <div class="accordion__body">
                        <p><?php esc_html_e( 'Most nationalities can obtain a 30-day Visa on Arrival (VoA) at Manado airport. It costs USD 35 and can be extended once for another 30 days at a local immigration office.', 'dil' ); ?></p>
                    </div>
                </div>
                <div class="accordion__item">
                    <button class="accordion__trigger" aria-expanded="false">
                        <span class="accordion__number"></span>
                        <span class="accordion__title"><?php esc_html_e( 'Visa-exempt countries', 'dil' ); ?></span>
                        <span class="accordion__icon" aria-hidden="true">+</span>
                    </button>
                    <div class="accordion__body">
                        <p><?php esc_html_e( 'Citizens of ASEAN countries, plus a growing list of others including Australia, New Zealand, UK, USA, and most European countries, can enter Indonesia visa-free for 30 days. Check the latest list on the Indonesian Immigration website.', 'dil' ); ?></p>
                    </div>
                </div>
                <div class="accordion__item">
                    <button class="accordion__trigger" aria-expanded="false">
                        <span class="accordion__number"></span>
                        <span class="accordion__title"><?php esc_html_e( 'Money &amp; banking', 'dil' ); ?></span>
                        <span class="accordion__icon" aria-hidden="true">+</span>
                    </button>
                    <div class="accordion__body">
                        <p><?php esc_html_e( 'The local currency is Indonesian Rupiah (IDR). There are ATMs in Bitung; we recommend withdrawing cash before the boat ride. The resort accepts USD and AUD in cash, and major credit cards for the main bill.', 'dil' ); ?></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Section 2 — FAQs -->
        <div class="inner-section" id="faqs">
            <div class="section-head">
                <div class="section-head__number mono">02</div>
                <h2 class="section-head__title"><?php esc_html_e( 'Frequently Asked Questions', 'dil' ); ?></h2>
            </div>
            <div class="accordion">
                <?php
                $faqs = [
                    [
                        'q' => __( 'Best time to visit?', 'dil' ),
                        'a' => __( 'Diving is good year-round. The dry season (May–October) is generally calmer with better visibility. The wet season (November–April) brings slightly rougher conditions but equal critter diversity and lower rates.', 'dil' ),
                    ],
                    [
                        'q' => __( 'Where exactly is Lembeh?', 'dil' ),
                        'a' => __( 'The Lembeh Strait separates the Indonesian mainland (North Sulawesi) from Lembeh Island. It\'s a narrow, sheltered channel about 18km long and 1–2km wide. The resort is on the western shore at Kasawari Bay.', 'dil' ),
                    ],
                    [
                        'q' => __( 'Local population and language?', 'dil' ),
                        'a' => __( 'The local people are Minahasan (Wanua Pakewa), a predominantly Christian community. Bahasa Indonesia is the national language; Minahasan dialects are spoken locally. Most resort staff speak good English.', 'dil' ),
                    ],
                    [
                        'q' => __( 'Medical facilities?', 'dil' ),
                        'a' => __( 'The nearest recompression chamber is in Manado. There is a clinic in Bitung. We carry oxygen kits on all dive boats and all divemasters hold DAN-certified O2 first-aid qualifications.', 'dil' ),
                    ],
                    [
                        'q' => __( 'Electricity?', 'dil' ),
                        'a' => __( 'Indonesia uses 220V / 50Hz power. Plug type C and F (two round pins). The resort has reliable generator backup. All camera charging stations in the camera room are surge-protected.', 'dil' ),
                    ],
                    [
                        'q' => __( 'What does the DIL logo mean?', 'dil' ),
                        'a' => __( 'The logo is a stylised dragon — a nod to the Komodo dragon of Indonesia and to the fire-coral coloured waters at dusk. It was hand-drawn by the resort\'s founder.', 'dil' ),
                    ],
                ];
                foreach ( $faqs as $faq ) :
                ?>
                <div class="accordion__item">
                    <button class="accordion__trigger" aria-expanded="false">
                        <span class="accordion__number"></span>
                        <span class="accordion__title"><?php echo esc_html( $faq['q'] ); ?></span>
                        <span class="accordion__icon" aria-hidden="true">+</span>
                    </button>
                    <div class="accordion__body">
                        <p><?php echo esc_html( $faq['a'] ); ?></p>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Section 3 — North Sulawesi -->
        <div class="inner-section" id="north-sulawesi">
            <div class="section-head">
                <div class="section-head__number mono">03</div>
                <h2 class="section-head__title"><?php esc_html_e( 'North Sulawesi', 'dil' ); ?></h2>
            </div>
            <p style="margin-bottom:28px;">
                <?php esc_html_e( 'There\'s more to the region than the Strait. Between dives, or on a rest day, North Sulawesi rewards exploration.', 'dil' ); ?>
            </p>
            <?php
            $sulawesi_img = get_theme_mod( 'dil_img_sulawesi_map', '' );
            if ( $sulawesi_img ) :
            ?>
                <img src="<?php echo esc_url( $sulawesi_img ); ?>"
                     alt="<?php esc_attr_e( 'Map of North Sulawesi with resort location', 'dil' ); ?>"
                     loading="lazy"
                     style="width:100%;margin-bottom:28px;">
            <?php endif; ?>

            <div class="region-grid">
                <?php
                $regions = [
                    [ 'mod' => 'dil_img_tangkoko',    'label' => __( 'Tangkoko NP', 'dil' ),           'alt' => __( 'Tangkoko Nature Reserve — tarsier', 'dil' ) ],
                    [ 'mod' => 'dil_img_minahasa',     'label' => __( 'Minahasa Highlands', 'dil' ),    'alt' => __( 'Minahasa Highlands', 'dil' ) ],
                    [ 'mod' => 'dil_img_tomohon',      'label' => __( 'Tomohon Market', 'dil' ),        'alt' => __( 'Tomohon traditional market', 'dil' ) ],
                    [ 'mod' => 'dil_img_tondano',      'label' => __( 'Lake Tondano', 'dil' ),          'alt' => __( 'Lake Tondano crater lake', 'dil' ) ],
                ];
                foreach ( $regions as $region ) :
                    $src = get_theme_mod( $region['mod'], '' );
                    ?>
                    <div class="region-tile">
                        <?php if ( $src ) : ?>
                            <img src="<?php echo esc_url( $src ); ?>" alt="<?php echo esc_attr( $region['alt'] ); ?>" loading="lazy">
                        <?php else : ?>
                            <?php echo dil_placeholder( $region['label'] ); // phpcs:ignore ?>
                        <?php endif; ?>
                        <div class="region-tile__label"><?php echo esc_html( $region['label'] ); ?></div>
                    </div>
                    <?php
                endforeach;
                ?>
            </div>
        </div>

        <!-- Section 4 — Dive Insurance -->
        <div class="inner-section" id="dive-insurance">
            <div class="section-head">
                <div class="section-head__number mono">04</div>
                <h2 class="section-head__title"><?php esc_html_e( 'Dive Insurance', 'dil' ); ?></h2>
            </div>
            <p style="margin-bottom:28px;">
                <?php esc_html_e( 'We require all guests to hold current dive insurance. DAN (Divers Alert Network) is the industry standard and covers emergency evacuation, recompression treatment, and medical costs.', 'dil' ); ?>
            </p>
            <div class="insurance-cards">
                <div class="insurance-card">
                    <div class="insurance-card__period"><?php esc_html_e( '10 days', 'dil' ); ?></div>
                    <div class="insurance-card__price">
                        <sup>USD</sup>20
                    </div>
                    <div class="insurance-card__features">
                        <?php esc_html_e( 'Emergency evacuation · Hyperbaric treatment · Medical expenses · 24/7 emergency hotline', 'dil' ); ?>
                    </div>
                    <a href="https://www.diversalertnetwork.org" target="_blank" rel="noopener"
                       class="btn btn-outline-dark" style="margin-top:20px;width:100%;justify-content:center;">
                        <?php esc_html_e( 'Get covered via DAN', 'dil' ); ?>
                    </a>
                </div>
                <div class="insurance-card">
                    <div class="insurance-card__period"><?php esc_html_e( '30 days', 'dil' ); ?></div>
                    <div class="insurance-card__price">
                        <sup>USD</sup>45
                    </div>
                    <div class="insurance-card__features">
                        <?php esc_html_e( 'Everything in 10-day plan · Multi-trip coverage · Travel disruption · Gear replacement', 'dil' ); ?>
                    </div>
                    <a href="https://www.diversalertnetwork.org" target="_blank" rel="noopener"
                       class="btn btn-primary" style="margin-top:20px;width:100%;justify-content:center;">
                        <?php esc_html_e( 'Get covered via DAN', 'dil' ); ?>
                    </a>
                </div>
            </div>
        </div>

    </main>

    <?php dil_sidebar(); ?>

</div><!-- .inner-page -->

<?php get_footer(); ?>
