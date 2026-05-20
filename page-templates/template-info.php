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

$cdn = 'https://diveintolembeh.com/wp-content/uploads/';
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
            <a href="#topside"><?php esc_html_e( 'Topside', 'dil' ); ?></a>
            <a href="#dive-insurance"><?php esc_html_e( 'Dive Insurance', 'dil' ); ?></a>
        </nav>

        <!-- Section 1 — Getting Here -->
        <div class="inner-section" id="getting-here">
            <div class="section-head">
                <div class="section-head__number mono">01</div>
                <h2 class="section-head__title"><?php esc_html_e( 'Getting Here', 'dil' ); ?></h2>
            </div>

            <?php
            $map_img = get_theme_mod( 'dil_img_indo_map', $cdn . '2018/04/DIL_indo-loc.jpg' );
            if ( $map_img ) :
            ?>
                <button class="grid-tile" data-full="<?php echo esc_url( $map_img ); ?>" data-alt="<?php esc_attr_e( 'Indonesia location map showing Lembeh Strait', 'dil' ); ?>" style="margin-bottom:28px;">
                    <img src="<?php echo esc_url( $map_img ); ?>"
                         alt="<?php esc_attr_e( 'Indonesia location map showing Lembeh Strait', 'dil' ); ?>"
                         loading="lazy"
                         style="width:100%;">
                </button>
            <?php endif; ?>

            <?php echo apply_filters( 'the_content', get_theme_mod( 'dil_text_gethere_intro', // phpcs:ignore
                __( '<p>Manado airport — Sam Ratulangi International (MDC) — is the international gateway to North Sulawesi and is approximately a 60-minute drive from the resort. Once in Bitung you board a 15-minute speedboat to Kasawari Bay. We organise all transfers.</p>', 'dil' )
            ) ); ?>

            <div class="info-flights" style="margin:24px 0 28px;">
                <h3 style="font-family:var(--font-heading);font-size:13px;letter-spacing:0.15em;text-transform:uppercase;margin-bottom:16px;"><?php esc_html_e( 'Flight options', 'dil' ); ?></h3>
                <div style="display:grid;gap:12px;">
                    <div style="padding:16px 20px;border:1px solid var(--border);">
                        <strong style="font-family:var(--font-heading);font-size:13px;letter-spacing:0.1em;text-transform:uppercase;"><?php esc_html_e( 'Via Singapore', 'dil' ); ?></strong>
                        <p style="margin-top:6px;font-size:15px;color:var(--ink-soft);"><?php esc_html_e( 'Singapore Airlines and Scoot fly direct to Manado. Flights operate Monday, Wednesday and Friday. Book via traveloka.com or your preferred booking portal.', 'dil' ); ?></p>
                    </div>
                    <div style="padding:16px 20px;border:1px solid var(--border);">
                        <strong style="font-family:var(--font-heading);font-size:13px;letter-spacing:0.1em;text-transform:uppercase;"><?php esc_html_e( 'Via Jakarta', 'dil' ); ?></strong>
                        <p style="margin-top:6px;font-size:15px;color:var(--ink-soft);"><?php esc_html_e( 'Garuda Indonesia and Batik Air operate frequent connections from Jakarta (CGK) to Manado. Multiple daily departures.', 'dil' ); ?></p>
                    </div>
                </div>
            </div>

            <div class="accordion" style="margin-top:24px;">
                <div class="accordion__item">
                    <button class="accordion__trigger" aria-expanded="false">
                        <span class="accordion__title"><?php esc_html_e( 'Visa on Arrival', 'dil' ); ?></span>
                        <span class="accordion__icon" aria-hidden="true">+</span>
                    </button>
                    <div class="accordion__body">
                        <p><?php esc_html_e( 'Indonesia offers a free 30-day Visa on Arrival to citizens of 169 countries. Your passport must be valid for at least 6 months, have a minimum of 2 blank pages, and you must hold a return or onward ticket. The visa can be extended once for an additional 30 days at a local immigration office.', 'dil' ); ?></p>
                    </div>
                </div>
                <div class="accordion__item">
                    <button class="accordion__trigger" aria-expanded="false">
                        <span class="accordion__title"><?php esc_html_e( 'Visa-free entry', 'dil' ); ?></span>
                        <span class="accordion__icon" aria-hidden="true">+</span>
                    </button>
                    <div class="accordion__body">
                        <p><?php esc_html_e( 'Citizens of ASEAN member countries (Brunei, Malaysia, Philippines, Singapore, Thailand, Vietnam and others), plus Chile and Hong Kong, can enter Indonesia without a visa. Check the latest requirements with the Indonesian Embassy or consulate in your home country before travel.', 'dil' ); ?></p>
                    </div>
                </div>
                <div class="accordion__item">
                    <button class="accordion__trigger" aria-expanded="false">
                        <span class="accordion__title"><?php esc_html_e( 'Money &amp; banking', 'dil' ); ?></span>
                        <span class="accordion__icon" aria-hidden="true">+</span>
                    </button>
                    <div class="accordion__body">
                        <p><?php esc_html_e( 'The local currency is Indonesian Rupiah (IDR). ATMs are available in Bitung — we recommend withdrawing cash before boarding the speedboat. The resort accepts USD and AUD cash, and major credit cards for the main bill.', 'dil' ); ?></p>
                    </div>
                </div>
            </div>

            <!-- Location map -->
            <div class="map-frame map-frame--inline" style="margin-top:36px;">
                <div id="dil-map-gethere"></div>
            </div>

            <script>
            document.addEventListener('DOMContentLoaded', function () {
                if (typeof L === 'undefined') return;
                var lat = 1.5005, lng = 125.2411;
                var map = L.map('dil-map-gethere', {
                    center:             [lat, lng],
                    zoom:               12,
                    zoomControl:        false,
                    scrollWheelZoom:    false,
                    attributionControl: false,
                });
                setTimeout(function () { map.invalidateSize(); }, 50);
                L.tileLayer('https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png', {
                    subdomains: 'abcd',
                    maxZoom:    20,
                }).addTo(map);
                L.control.attribution({ prefix: false, position: 'bottomright' })
                    .addAttribution('&copy; <a href="https://www.openstreetmap.org/copyright" target="_blank">OpenStreetMap</a> &copy; <a href="https://carto.com/" target="_blank">CARTO</a>')
                    .addTo(map);
                L.control.zoom({ position: 'bottomright' }).addTo(map);
                var icon = L.divIcon({
                    className:   'dil-map-marker',
                    html:        '<div class="dil-map-marker__pulse"></div><div class="dil-map-marker__dot"></div>',
                    iconSize:    [24, 24],
                    iconAnchor:  [12, 12],
                    popupAnchor: [0, -16],
                });
                L.marker([lat, lng], { icon: icon })
                    .addTo(map)
                    .bindPopup(
                        '<p class="map-popup__name">Dive Into Lembeh</p>' +
                        '<p class="map-popup__sub">Kasawari Bay &middot; Lembeh Strait<br>North Sulawesi, Indonesia</p>'
                    )
                    .openPopup();
            });
            </script>
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
                        'q' => __( 'Where exactly is Lembeh?', 'dil' ),
                        'a' => __( 'The Lembeh Strait is a narrow, sheltered channel in North Sulawesi, Indonesia — approximately 18km long and 1–2km wide, separating the Sulawesi mainland from Lembeh Island. The resort sits on the western shore at Kasawari Bay. Time zone is GMT+8 (WITA — Central Indonesian Time).', 'dil' ),
                    ],
                    [
                        'q' => __( 'Best time to visit?', 'dil' ),
                        'a' => __( 'Diving is excellent year-round in Lembeh. The dry season (May–October) generally offers calmer conditions and better visibility. The wet season (November–April) brings slightly rougher seas but equal or better critter diversity, and lower accommodation rates.', 'dil' ),
                    ],
                    [
                        'q' => __( 'What is the climate like?', 'dil' ),
                        'a' => __( 'Lembeh sits on the equator, so expect consistent warm temperatures of 25°–28°C (78°–82°F) year-round, both above and below the water. Water visibility ranges from 8–20m depending on season and tidal conditions.', 'dil' ),
                    ],
                    [
                        'q' => __( 'Local population and language?', 'dil' ),
                        'a' => __( 'The local people are Minahasan — a predominantly Christian community with a distinct culture, cuisine, and history. Bahasa Indonesia is the national language; Minahasan dialects are spoken locally. Most resort staff speak good English.', 'dil' ),
                    ],
                    [
                        'q' => __( 'Electricity?', 'dil' ),
                        'a' => __( 'Indonesia uses 220V / 50Hz. Plug types C and F (two round pins). The resort has reliable generator backup. All camera-charging stations in the camera room are surge-protected.', 'dil' ),
                    ],
                    [
                        'q' => __( 'Medical facilities?', 'dil' ),
                        'a' => __( 'The nearest recompression chamber is in Manado. A clinic is available in Bitung. We carry oxygen kits on all dive boats and all divemasters hold DAN-certified O₂ first-aid qualifications. Dive insurance is mandatory for all guests — see the Dive Insurance section below.', 'dil' ),
                    ],
                    [
                        'q' => __( 'What is the Lembeh Sea Dragon?', 'dil' ),
                        'a' => __( 'The Lembeh Sea Dragon is our resort mascot and logo — a stylised creature inspired by the Lembeh Strait\'s extraordinary critter life. It has become synonymous with muck diving and the unique underwater world of the strait.', 'dil' ),
                    ],
                ];
                foreach ( $faqs as $faq ) :
                ?>
                <div class="accordion__item">
                    <button class="accordion__trigger" aria-expanded="false">
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

        <!-- Section 3 — Topside -->
        <div class="inner-section" id="topside">
            <div class="section-head">
                <div class="section-head__number mono">03</div>
                <h2 class="section-head__title"><?php esc_html_e( 'Topside', 'dil' ); ?></h2>
            </div>

            <?php
            $ts1 = get_theme_mod( 'dil_img_topside1', $cdn . '2018/05/TS01.jpg' );
            $ts2 = get_theme_mod( 'dil_img_topside2', $cdn . '2018/05/TS02.jpg' );
            ?>
            <div class="image-grid image-grid--2col" style="margin-bottom:28px;">
                <?php foreach ( [ $ts1, $ts2 ] as $i => $src ) : if ( $src ) : ?>
                    <button class="grid-tile" data-full="<?php echo esc_url( $src ); ?>" data-alt="<?php echo esc_attr__( 'North Sulawesi topside', 'dil' ); ?>">
                        <img src="<?php echo esc_url( $src ); ?>" alt="<?php echo esc_attr__( 'North Sulawesi topside', 'dil' ); ?>" loading="lazy">
                    </button>
                <?php endif; endforeach; ?>
            </div>

            <?php
            $area_map = get_theme_mod( 'dil_img_area_map', $cdn . '2018/05/popout-area-map.jpg' );
            if ( $area_map ) :
            ?>
                <img src="<?php echo esc_url( $area_map ); ?>"
                     alt="<?php esc_attr_e( 'North Sulawesi area map', 'dil' ); ?>"
                     loading="lazy"
                     style="width:100%;margin-bottom:28px;">
            <?php endif; ?>

            <?php echo apply_filters( 'the_content', get_theme_mod( 'dil_text_topside_intro', // phpcs:ignore
                __( '<p>There is plenty to see and do when you surface. North Sulawesi is a fascinating region with a rich history — Portuguese, Spanish, Dutch and Japanese colonial periods all left their mark before Indonesian independence in 1949. The local Minahasan culture, cuisine, and highland scenery are worth at least one rest day.</p>', 'dil' )
            ) ); ?>

            <div style="display:grid;gap:24px;margin-top:28px;">

                <div style="border:1px solid var(--border);padding:28px;">
                    <h3 style="font-family:var(--font-heading);font-size:13px;letter-spacing:0.15em;text-transform:uppercase;margin-bottom:12px;"><?php esc_html_e( 'Tangkoko National Park', 'dil' ); ?></h3>
                    <?php echo apply_filters( 'the_content', get_theme_mod( 'dil_text_topside_tangkoko', // phpcs:ignore
                        __( '<p>An afternoon trip (departing after lunch, returning around 7pm) into the rainforest to see the Tarsius Spectrum — the world\'s smallest nocturnal primate at just 15cm — plus black macaques, cuscus, and hornbills. Wear long trousers, socks, and trainers.</p>', 'dil' )
                    ) ); ?>
                </div>

                <div style="border:1px solid var(--border);padding:28px;">
                    <h3 style="font-family:var(--font-heading);font-size:13px;letter-spacing:0.15em;text-transform:uppercase;margin-bottom:12px;"><?php esc_html_e( 'Minahasa Highlands', 'dil' ); ?></h3>
                    <?php echo apply_filters( 'the_content', get_theme_mod( 'dil_text_topside_highlands', // phpcs:ignore
                        __( '<p>A full-day excursion (7am departure, back for dinner) up to 600m elevation. The route takes in the ancient Sawangan cemetery, the famous Tomohon traditional food market, Woloan village — where traditional wooden houses are pre-built for export — Lake Tondano with a freshwater fish lunch, and the striking three-coloured Lake Linau.</p>', 'dil' )
                    ) ); ?>
                </div>

            </div>
        </div>

        <!-- Section 4 — Dive Insurance -->
        <div class="inner-section" id="dive-insurance">
            <div class="section-head">
                <div class="section-head__number mono">04</div>
                <h2 class="section-head__title"><?php esc_html_e( 'Dive Insurance', 'dil' ); ?></h2>
            </div>

            <div style="display:flex;align-items:flex-start;gap:32px;flex-wrap:wrap;margin-bottom:28px;">
                <?php
                $dan_logo = get_theme_mod( 'dil_img_dan_logo', $cdn . '2017/07/DAN-2-Mobile-249x300.png' );
                if ( $dan_logo ) :
                ?>
                    <img src="<?php echo esc_url( $dan_logo ); ?>"
                         alt="<?php esc_attr_e( 'DAN — Divers Alert Network', 'dil' ); ?>"
                         loading="lazy"
                         style="width:120px;flex-shrink:0;">
                <?php endif; ?>
                <div>
                    <?php echo apply_filters( 'the_content', get_theme_mod( 'dil_text_insurance_intro', // phpcs:ignore
                        __( '<p><strong>Indonesian law requires all divers to hold valid dive insurance.</strong> Given our remote location, we strongly recommend DAN (Divers Alert Network) — the world\'s most respected non-profit dive insurance provider. DAN Short Term Insurance is available for 10 or 30 days and can be arranged in advance or on arrival at the resort.</p>', 'dil' )
                    ) ); ?>
                </div>
            </div>

            <table style="width:100%;border-collapse:collapse;font-size:15px;margin-bottom:28px;">
                <thead>
                    <tr style="border-bottom:2px solid var(--burgundy);">
                        <th style="text-align:left;padding:10px 0;font-family:var(--font-heading);font-size:12px;letter-spacing:0.12em;text-transform:uppercase;"><?php esc_html_e( 'Benefit', 'dil' ); ?></th>
                        <th style="text-align:right;padding:10px 0;font-family:var(--font-heading);font-size:12px;letter-spacing:0.12em;text-transform:uppercase;"><?php esc_html_e( 'Coverage', 'dil' ); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $coverage = [
                        [ __( 'Diving accident / illness — medical &amp; evacuation', 'dil' ), 'USD 100,000' ],
                        [ __( 'Lost dive equipment (due to diving accident)', 'dil' ),          'USD 4,000'   ],
                        [ __( 'Extra accommodation &amp; travel (due to diving accident)', 'dil' ), 'USD 4,000' ],
                        [ __( 'Accidental death &amp; dismemberment', 'dil' ),                  'USD 5,000'   ],
                        [ __( '24/7 emergency assistance hotline', 'dil' ),                     __( 'Yes', 'dil' ) ],
                        [ __( 'Depth limit', 'dil' ),                                           __( 'Unlimited', 'dil' ) ],
                    ];
                    foreach ( $coverage as $i => $row ) :
                    ?>
                    <tr style="border-bottom:1px solid var(--border);<?php echo $i % 2 === 0 ? 'background:var(--surface);' : ''; ?>">
                        <td style="padding:10px 8px;"><?php echo esc_html( $row[0] ); ?></td>
                        <td style="padding:10px 8px;text-align:right;font-family:var(--font-mono);font-size:13px;"><?php echo esc_html( $row[1] ); ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <div style="background:var(--surface);border:1px solid var(--border);padding:20px 24px;font-size:14px;color:var(--ink-soft);">
                <strong style="font-family:var(--font-heading);font-size:12px;letter-spacing:0.12em;text-transform:uppercase;display:block;margin-bottom:8px;"><?php esc_html_e( 'Emergency number', 'dil' ); ?></strong>
                <a href="tel:+61882129242" style="font-family:var(--font-mono);font-size:16px;color:var(--burgundy);">+61 8 8212 9242</a>
                <p style="margin-top:8px;"><?php esc_html_e( 'No restrictions on age, depth, equipment, or gas mix. Coverage available to divers of all experience levels. Payment can be added to your resort bill or charged to a personal credit card.', 'dil' ); ?></p>
            </div>

        </div>

    </main>

    <?php dil_sidebar(); ?>

</div><!-- .inner-page -->

<?php get_footer(); ?>
