<?php
/**
 * Template Name: Rates & Packages
 *
 * Assign this template to the /rates/ page in WordPress.
 */

get_header();
require_once get_template_directory() . '/inc/inner-page.php';

$banner_img = get_theme_mod( 'dil_banner_rates', '' );
if ( ! $banner_img && has_post_thumbnail() ) {
    $banner_img = get_the_post_thumbnail_url( null, 'dil-banner' );
}

// Pricing data — keyed by dives/day then room then nights index (3–14 nights = index 0–11)
$price_data = [
    '2' => [
        'longhouse' => [470,660,850,1040,1230,1420,1610,1800,1990,2180,2370,2560],
        'garden'    => [605,840,1075,1310,1545,1780,2015,2250,2485,2720,2955,3190],
        'pool'      => [620,860,1100,1340,1580,1820,2060,2300,2540,2780,3020,3260],
        'suite'     => [695,960,1225,1490,1755,2020,2285,2550,2815,3080,3345,3610],
    ],
    '3' => [
        'longhouse' => [570,810,1050,1290,1530,1770,2010,2250,2490,2730,2970,3210],
        'garden'    => [705,990,1275,1560,1845,2130,2415,2700,2985,3270,3555,3840],
        'pool'      => [720,1010,1300,1590,1880,2170,2460,2750,3040,3330,3620,3910],
        'suite'     => [795,1110,1425,1740,2055,2370,2685,3000,3315,3630,3945,4260],
    ],
];
?>

<?php dil_page_banner( [
    'kicker'   => __( '2026 Published Rates', 'dil' ),
    'title'    => __( 'Rates &amp; Packages', 'dil' ),
    'subtitle' => __( 'Valid 01 January 2026 – 01 January 2027 · All prices in USD incl. 21% tax', 'dil' ),
    'bg_url'   => $banner_img,
] ); ?>

<!-- Sticky PDF bar -->
<div class="rates-pdf-bar" id="rates-pdf-bar">
    <span class="rates-pdf-bar__label"><?php esc_html_e( '2026 Rates', 'dil' ); ?></span>
    <a href="https://diveintolembeh.com/wp-content/uploads/2025/06/Dive-into-Lembeh-2026-rates.pdf"
       target="_blank" rel="noopener" class="rates-pdf-bar__btn">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true">
            <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/>
            <polyline points="14 2 14 8 20 8"/>
            <line x1="12" y1="11" x2="12" y2="17"/>
            <polyline points="9 14 12 17 15 14"/>
        </svg>
        <?php esc_html_e( 'Download PDF', 'dil' ); ?>
    </a>
</div>

<div class="inner-page">

    <main class="inner-page__main" id="main-content" tabindex="-1">

        <!-- Section 1 — Calculator -->
        <div class="inner-section" id="calculator">
            <div class="section-head">
                <div class="section-head__number mono">01</div>
                <h2 class="section-head__title"><?php esc_html_e( 'Price Calculator', 'dil' ); ?></h2>
            </div>

            <div class="rates-calc" id="rates-calc"
                 data-prices="<?php echo esc_attr( json_encode( $price_data ) ); ?>">

                <div class="rates-calc__body">

                    <!-- Room type -->
                    <fieldset class="rates-calc__group">
                        <legend><?php esc_html_e( 'Room type', 'dil' ); ?></legend>
                        <div class="rates-calc__rooms">
                            <?php
                            $rooms = [
                                'longhouse' => [ __( 'Longhouse', 'dil' ),        __( 'Budget · 3 rooms', 'dil' ) ],
                                'garden'    => [ __( 'Garden / Seaview', 'dil' ),  __( 'Bungalow · 6 available', 'dil' ) ],
                                'pool'      => [ __( 'Pool Front', 'dil' ),        __( 'Bungalow · 3 available', 'dil' ) ],
                                'suite'     => [ __( 'Bungalow Suite', 'dil' ),    __( 'Premium · 1 available', 'dil' ) ],
                            ];
                            foreach ( $rooms as $key => [$label, $sub] ) :
                            ?>
                            <label class="rates-calc__room-option">
                                <input type="radio" name="calc_room" value="<?php echo esc_attr( $key ); ?>"
                                       <?php checked( $key, 'garden' ); ?>>
                                <span class="rates-calc__room-label"><?php echo esc_html( $label ); ?></span>
                                <span class="rates-calc__room-sub"><?php echo esc_html( $sub ); ?></span>
                            </label>
                            <?php endforeach; ?>
                        </div>
                    </fieldset>

                    <div class="rates-calc__row">

                        <!-- Nights -->
                        <fieldset class="rates-calc__group">
                            <legend><?php esc_html_e( 'Duration', 'dil' ); ?></legend>
                            <select name="calc_nights" id="calc_nights" class="rates-calc__select">
                                <?php for ( $n = 3; $n <= 14; $n++ ) : ?>
                                <option value="<?php echo $n; ?>"><?php
                                    $days = $n - 1;
                                    echo esc_html( sprintf( _n( '%d night / %d day', '%d nights / %d days', $n, 'dil' ), $n, $days ) );
                                ?></option>
                                <?php endfor; ?>
                            </select>
                        </fieldset>

                        <!-- Dives per day -->
                        <fieldset class="rates-calc__group">
                            <legend><?php esc_html_e( 'Dives per day', 'dil' ); ?></legend>
                            <div class="rates-calc__toggle">
                                <label>
                                    <input type="radio" name="calc_dives" value="2" checked>
                                    <span><?php esc_html_e( '2 dives', 'dil' ); ?></span>
                                </label>
                                <label>
                                    <input type="radio" name="calc_dives" value="3">
                                    <span><?php esc_html_e( '3 dives', 'dil' ); ?></span>
                                </label>
                            </div>
                        </fieldset>

                        <!-- Guests -->
                        <fieldset class="rates-calc__group">
                            <legend><?php esc_html_e( 'Guests', 'dil' ); ?></legend>
                            <div class="rates-calc__toggle">
                                <label>
                                    <input type="radio" name="calc_guests" value="2" checked>
                                    <span><?php esc_html_e( '2 sharing', 'dil' ); ?></span>
                                </label>
                                <label>
                                    <input type="radio" name="calc_guests" value="1">
                                    <span><?php esc_html_e( '1 solo', 'dil' ); ?></span>
                                </label>
                            </div>
                        </fieldset>

                    </div>

                    <!-- Add-ons -->
                    <fieldset class="rates-calc__group">
                        <legend><?php esc_html_e( 'Add-ons (per person)', 'dil' ); ?></legend>
                        <div class="rates-calc__addons">
                            <label class="rates-calc__addon">
                                <input type="checkbox" name="addon_nitrox" value="1">
                                <span class="rates-calc__addon-label"><?php esc_html_e( 'Nitrox EANx32', 'dil' ); ?></span>
                                <span class="rates-calc__addon-price"><?php esc_html_e( '+$20 / day', 'dil' ); ?></span>
                                <input type="number" name="addon_nitrox_days" min="1" max="13" value="1"
                                       class="rates-calc__qty" style="display:none;"
                                       aria-label="<?php esc_attr_e( 'Number of nitrox days', 'dil' ); ?>">
                            </label>
                            <label class="rates-calc__addon">
                                <input type="checkbox" name="addon_night" value="1">
                                <span class="rates-calc__addon-label"><?php esc_html_e( 'Night dives', 'dil' ); ?></span>
                                <span class="rates-calc__addon-price"><?php esc_html_e( '+$55 each', 'dil' ); ?></span>
                                <input type="number" name="addon_night_qty" min="1" max="10" value="1"
                                       class="rates-calc__qty" style="display:none;"
                                       aria-label="<?php esc_attr_e( 'Number of night dives', 'dil' ); ?>">
                            </label>
                            <label class="rates-calc__addon">
                                <input type="checkbox" name="addon_guide" value="1">
                                <span class="rates-calc__addon-label"><?php esc_html_e( 'Private guide', 'dil' ); ?></span>
                                <span class="rates-calc__addon-price"><?php esc_html_e( '+$100 / day', 'dil' ); ?></span>
                                <input type="number" name="addon_guide_days" min="1" max="13" value="1"
                                       class="rates-calc__qty" style="display:none;"
                                       aria-label="<?php esc_attr_e( 'Number of guide days', 'dil' ); ?>">
                            </label>
                            <label class="rates-calc__addon">
                                <input type="checkbox" name="addon_gear" value="1">
                                <span class="rates-calc__addon-label"><?php esc_html_e( 'Full gear rental', 'dil' ); ?></span>
                                <span class="rates-calc__addon-price"><?php esc_html_e( '+$30 / day', 'dil' ); ?></span>
                                <input type="number" name="addon_gear_days" min="1" max="13" value="1"
                                       class="rates-calc__qty" style="display:none;"
                                       aria-label="<?php esc_attr_e( 'Number of gear rental days', 'dil' ); ?>">
                            </label>
                            <label class="rates-calc__addon">
                                <input type="checkbox" name="addon_nondiver" value="1">
                                <span class="rates-calc__addon-label"><?php esc_html_e( 'Non-diver guest', 'dil' ); ?></span>
                                <span class="rates-calc__addon-price rates-calc__addon-price--dynamic" id="calc-nondiver-rate"><?php esc_html_e( '+$135 / night', 'dil' ); ?></span>
                            </label>
                            <label class="rates-calc__addon">
                                <input type="checkbox" name="addon_transfer" value="1">
                                <span class="rates-calc__addon-label"><?php esc_html_e( 'Airport transfer (return)', 'dil' ); ?></span>
                                <span class="rates-calc__addon-price"><?php esc_html_e( '+$40 / person', 'dil' ); ?></span>
                            </label>
                        </div>
                    </fieldset>

                </div><!-- .rates-calc__body -->

                <!-- Total panel -->
                <div class="rates-calc__total" id="rates-calc-total">
                    <div class="rates-calc__total-room" id="calc-room-label">Garden / Seaview Bungalow</div>
                    <div class="rates-calc__breakdown" id="calc-breakdown"></div>
                    <div class="rates-calc__grand">
                        <span><?php esc_html_e( 'Total', 'dil' ); ?></span>
                        <span class="rates-calc__grand-price" id="calc-total">USD —</span>
                    </div>
                    <div class="rates-calc__per" id="calc-per"></div>
                    <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="btn btn-primary rates-calc__enquire">
                        <?php esc_html_e( 'Enquire now', 'dil' ); ?>
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M20 4H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/></svg>
                    </a>
                    <p class="rates-calc__note"><?php esc_html_e( '* Indicative price pp sharing. Subject to availability.', 'dil' ); ?></p>
                </div>

            </div><!-- .rates-calc -->
        </div>

        <!-- Section 2 — Full pricing tables -->
        <div class="inner-section" id="packages">
            <div class="section-head">
                <div class="section-head__number mono">02</div>
                <h2 class="section-head__title"><?php esc_html_e( 'All-Inclusive Packages', 'dil' ); ?></h2>
            </div>

            <p style="margin-bottom:24px;color:var(--ink-soft);">
                <?php esc_html_e( 'Full-board accommodation · Guided dives by speedboat · House-reef access 8AM–6PM · All taxes, tanks, weights included.', 'dil' ); ?>
            </p>

            <div class="rates-tabs" role="tablist">
                <button class="rates-tab is-active" role="tab" aria-selected="true"  data-target="rates-2dive"><?php esc_html_e( '2 dives / day', 'dil' ); ?></button>
                <button class="rates-tab"            role="tab" aria-selected="false" data-target="rates-3dive"><?php esc_html_e( '3 dives / day', 'dil' ); ?></button>
            </div>

            <div class="rates-table-wrap" id="rates-2dive">
                <table class="rates-table">
                    <thead><tr>
                        <th><?php esc_html_e( 'Package', 'dil' ); ?></th>
                        <th><?php esc_html_e( 'Longhouse', 'dil' ); ?><span class="rates-th-sub">3 rooms</span></th>
                        <th><?php esc_html_e( 'Garden / Seaview', 'dil' ); ?><span class="rates-th-sub">6 bungalows</span></th>
                        <th><?php esc_html_e( 'Pool Front', 'dil' ); ?><span class="rates-th-sub">3 bungalows</span></th>
                        <th><?php esc_html_e( 'Bungalow Suite', 'dil' ); ?><span class="rates-th-sub">1 bungalow</span></th>
                    </tr></thead>
                    <tbody>
                    <?php
                    $rows2 = [
                        ['3N / 2 days','4 dives','$470','$605','$620','$695'],['4N / 3 days','6 dives','$660','$840','$860','$960'],
                        ['5N / 4 days','8 dives','$850','$1,075','$1,100','$1,225'],['6N / 5 days','10 dives','$1,040','$1,310','$1,340','$1,490'],
                        ['7N / 6 days','12 dives','$1,230','$1,545','$1,580','$1,755'],['8N / 7 days','14 dives','$1,420','$1,780','$1,820','$2,020'],
                        ['9N / 8 days','16 dives','$1,610','$2,015','$2,060','$2,285'],['10N / 9 days','18 dives','$1,800','$2,250','$2,300','$2,550'],
                        ['11N / 10 days','20 dives','$1,990','$2,485','$2,540','$2,815'],['12N / 11 days','22 dives','$2,180','$2,720','$2,780','$3,080'],
                        ['13N / 12 days','24 dives','$2,370','$2,955','$3,020','$3,345'],['14N / 13 days','26 dives','$2,560','$3,190','$3,260','$3,610'],
                    ];
                    foreach ( $rows2 as $r ) :
                    ?><tr><td><span class="rates-nights"><?php echo esc_html($r[0]); ?></span><span class="rates-dives"><?php echo esc_html($r[1]); ?></span></td>
                    <td class="rates-price"><?php echo esc_html($r[2]); ?></td><td class="rates-price"><?php echo esc_html($r[3]); ?></td>
                    <td class="rates-price"><?php echo esc_html($r[4]); ?></td><td class="rates-price rates-price--highlight"><?php echo esc_html($r[5]); ?></td></tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <div class="rates-table-wrap" id="rates-3dive" hidden>
                <table class="rates-table">
                    <thead><tr>
                        <th><?php esc_html_e( 'Package', 'dil' ); ?></th>
                        <th><?php esc_html_e( 'Longhouse', 'dil' ); ?><span class="rates-th-sub">3 rooms</span></th>
                        <th><?php esc_html_e( 'Garden / Seaview', 'dil' ); ?><span class="rates-th-sub">6 bungalows</span></th>
                        <th><?php esc_html_e( 'Pool Front', 'dil' ); ?><span class="rates-th-sub">3 bungalows</span></th>
                        <th><?php esc_html_e( 'Bungalow Suite', 'dil' ); ?><span class="rates-th-sub">1 bungalow</span></th>
                    </tr></thead>
                    <tbody>
                    <?php
                    $rows3 = [
                        ['3N / 2 days','6 dives','$570','$705','$720','$795'],['4N / 3 days','9 dives','$810','$990','$1,010','$1,110'],
                        ['5N / 4 days','12 dives','$1,050','$1,275','$1,300','$1,425'],['6N / 5 days','15 dives','$1,290','$1,560','$1,590','$1,740'],
                        ['7N / 6 days','18 dives','$1,530','$1,845','$1,880','$2,055'],['8N / 7 days','21 dives','$1,770','$2,130','$2,170','$2,370'],
                        ['9N / 8 days','24 dives','$2,010','$2,415','$2,460','$2,685'],['10N / 9 days','27 dives','$2,250','$2,700','$2,750','$3,000'],
                        ['11N / 10 days','30 dives','$2,490','$2,985','$3,040','$3,315'],['12N / 11 days','33 dives','$2,730','$3,270','$3,330','$3,630'],
                        ['13N / 12 days','36 dives','$2,970','$3,555','$3,620','$3,945'],['14N / 13 days','39 dives','$3,210','$3,840','$3,910','$4,260'],
                    ];
                    foreach ( $rows3 as $r ) :
                    ?><tr><td><span class="rates-nights"><?php echo esc_html($r[0]); ?></span><span class="rates-dives"><?php echo esc_html($r[1]); ?></span></td>
                    <td class="rates-price"><?php echo esc_html($r[2]); ?></td><td class="rates-price"><?php echo esc_html($r[3]); ?></td>
                    <td class="rates-price"><?php echo esc_html($r[4]); ?></td><td class="rates-price rates-price--highlight"><?php echo esc_html($r[5]); ?></td></tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <div class="rates-footnotes">
                <p><?php esc_html_e( '* All prices per person sharing twin/double. Incl. 21% tax, air tanks, weights and weight belt.', 'dil' ); ?></p>
                <p><?php esc_html_e( '* Single supplement: Bungalows USD 60/night · Longhouse USD 45/night', 'dil' ); ?></p>
                <p><?php esc_html_e( '* Nitrox EANx32: USD 7/tank or USD 20/day · Round-trip airport transfers: USD 40/person', 'dil' ); ?></p>
                <p><?php esc_html_e( '* No dives on arrival day unless agreed in advance. Unused dives are non-refundable.', 'dil' ); ?></p>
            </div>
        </div>

        <!-- Section 3 — What's included -->
        <div class="inner-section" id="included">
            <div class="section-head">
                <div class="section-head__number mono">03</div>
                <h2 class="section-head__title"><?php esc_html_e( "What's Included", 'dil' ); ?></h2>
            </div>
            <div class="rates-incl-grid">
                <div class="rates-incl-col rates-incl-col--yes">
                    <h3><?php esc_html_e( 'Included', 'dil' ); ?></h3>
                    <ul>
                        <?php foreach ( [
                            'Welcome drink on arrival',
                            'Full board — breakfast, lunch & dinner (lunch excluded arrival day)',
                            'Breakfast on check-out day',
                            'Unlimited tea, local coffee & drinking water',
                            'Guided dives by speedboat as per package',
                            'House-reef access 8AM–6PM on diving days',
                            'Air tanks, weights & weight belt',
                            'Free Wi-Fi throughout the resort',
                            'All government taxes (21%)',
                        ] as $item ) : ?>
                        <li><?php echo esc_html( $item ); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class="rates-incl-col rates-incl-col--no">
                    <h3><?php esc_html_e( 'Not Included', 'dil' ); ?></h3>
                    <ul>
                        <?php foreach ( [
                            'Alcoholic beverages & soft drinks',
                            'Massages',
                            'Land excursions',
                            'Nitrox / EANx',
                            'Night dives',
                            'Rental equipment',
                            'Dive centre gratuities',
                            'Airport transfers',
                        ] as $item ) : ?>
                        <li><?php echo esc_html( $item ); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>

            <div style="margin-top:32px;padding:24px 28px;border:1px solid var(--border);">
                <h3 style="font-family:var(--font-heading);font-size:13px;letter-spacing:0.12em;text-transform:uppercase;margin-bottom:16px;"><?php esc_html_e( 'Non-diver rates (per person / per night)', 'dil' ); ?></h3>
                <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(180px,1fr));gap:12px;">
                    <?php foreach ( [
                        ['Longhouse room','USD 90'],['Garden / Seaview bungalow','USD 135'],
                        ['Pool Front bungalow','USD 140'],['Bungalow Suite','USD 165'],
                    ] as [$label,$price] ) : ?>
                    <div style="padding:12px 16px;background:var(--surface);">
                        <div style="font-size:12px;letter-spacing:0.1em;text-transform:uppercase;font-family:var(--font-heading);color:var(--ink-soft);margin-bottom:4px;"><?php echo esc_html($label); ?></div>
                        <div style="font-family:var(--font-mono);font-size:18px;color:var(--burgundy);"><?php echo esc_html($price); ?></div>
                        <div style="font-size:12px;color:var(--ink-soft);margin-top:2px;"><?php esc_html_e('incl. full board','dil'); ?></div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <!-- Section 4 — Add-ons -->
        <div class="inner-section" id="addons">
            <div class="section-head">
                <div class="section-head__number mono">04</div>
                <h2 class="section-head__title"><?php esc_html_e( 'Dive Centre Add-ons', 'dil' ); ?></h2>
            </div>
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:32px;">
                <div>
                    <h3 style="font-family:var(--font-heading);font-size:12px;letter-spacing:0.12em;text-transform:uppercase;margin-bottom:16px;color:var(--ink-soft);"><?php esc_html_e('Extra dives','dil'); ?></h3>
                    <table class="rates-addon-table">
                        <?php foreach([['Extra day dive','USD 50'],['Night or mandarin dive (boat)','USD 55'],['Dive outside package','USD 55'],['Nitrox EANx32 — per tank','USD 7'],['Nitrox EANx32 — per day (max)','USD 20'],['Private guide — per dive','USD 35'],['Private guide — per day','USD 100']] as [$l,$p]): ?>
                        <tr><td><?php echo esc_html($l); ?></td><td><?php echo esc_html($p); ?></td></tr>
                        <?php endforeach; ?>
                    </table>
                    <h3 style="font-family:var(--font-heading);font-size:12px;letter-spacing:0.12em;text-transform:uppercase;margin:24px 0 16px;color:var(--ink-soft);"><?php esc_html_e('PADI courses','dil'); ?></h3>
                    <table class="rates-addon-table">
                        <?php foreach([['Discover Scuba Diving','USD 150'],['Open Water','USD 500'],['Advanced Open Water','USD 380'],['Enriched Air Nitrox (EANx)','USD 180']] as [$l,$p]): ?>
                        <tr><td><?php echo esc_html($l); ?></td><td><?php echo esc_html($p); ?></td></tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <div>
                    <h3 style="font-family:var(--font-heading);font-size:12px;letter-spacing:0.12em;text-transform:uppercase;margin-bottom:16px;color:var(--ink-soft);"><?php esc_html_e('Equipment rental','dil'); ?></h3>
                    <table class="rates-addon-table">
                        <?php foreach([['Full set — per day','USD 30'],['Full set — per dive','USD 15'],['Computer','USD 10'],['Regulator','USD 8'],['BCD','USD 7'],['Wetsuit','USD 7'],['Torch','USD 10'],['Mask & Snorkel','USD 4'],['Fins','USD 4']] as [$l,$p]): ?>
                        <tr><td><?php echo esc_html($l); ?></td><td><?php echo esc_html($p); ?></td></tr>
                        <?php endforeach; ?>
                    </table>
                    <p style="font-size:13px;color:var(--ink-soft);margin-top:12px;"><?php esc_html_e('Reserve rental equipment at time of booking — supply is limited.','dil'); ?></p>
                </div>
            </div>
        </div>

        <!-- Section 5 — Policies -->
        <div class="inner-section" id="policies">
            <div class="section-head">
                <div class="section-head__number mono">05</div>
                <h2 class="section-head__title"><?php esc_html_e( 'Policies', 'dil' ); ?></h2>
            </div>
            <div class="accordion">
                <div class="accordion__item">
                    <button class="accordion__trigger" aria-expanded="false"><span class="accordion__title"><?php esc_html_e('Check-in & check-out','dil'); ?></span><span class="accordion__icon" aria-hidden="true">+</span></button>
                    <div class="accordion__body"><p><?php esc_html_e('Check-in from 2PM. Early check-in (subject to availability): USD 30/person. Check-out by 11AM. Late check-out to 5PM: half-day room charge. Beyond 5PM: full-day charge.','dil'); ?></p></div>
                </div>
                <div class="accordion__item">
                    <button class="accordion__trigger" aria-expanded="false"><span class="accordion__title"><?php esc_html_e('Child policy','dil'); ?></span><span class="accordion__icon" aria-hidden="true">+</span></button>
                    <div class="accordion__body"><p><?php esc_html_e('Children under 6 sharing with guardian: free. Children 6–12 years: USD 40/day for accommodation and all meals.','dil'); ?></p></div>
                </div>
                <div class="accordion__item">
                    <button class="accordion__trigger" aria-expanded="false"><span class="accordion__title"><?php esc_html_e('Group offers','dil'); ?></span><span class="accordion__icon" aria-hidden="true">+</span></button>
                    <div class="accordion__body"><p><?php esc_html_e('Group of 8 paying guests: 1 place free. Group of 20: 3 places free. FOC based on twin/double sharing, minimum 3 nights / 2 diving days.','dil'); ?></p></div>
                </div>
                <div class="accordion__item">
                    <button class="accordion__trigger" aria-expanded="false"><span class="accordion__title"><?php esc_html_e('Deposit & payment','dil'); ?></span><span class="accordion__icon" aria-hidden="true">+</span></button>
                    <div class="accordion__body">
                        <p><?php esc_html_e('20% non-refundable deposit (min USD 250/person) within 14 days of invoice. Final payment 30 days before arrival. For bookings within 30 days of arrival, full payment required immediately.','dil'); ?></p>
                        <p style="margin-top:12px;"><?php esc_html_e('Accepted: IDR, USD, EUR, GBP, SGD. Visa/MasterCard accepted with 2% surcharge.','dil'); ?></p>
                    </div>
                </div>
                <div class="accordion__item">
                    <button class="accordion__trigger" aria-expanded="false"><span class="accordion__title"><?php esc_html_e('Cancellation','dil'); ?></span><span class="accordion__icon" aria-hidden="true">+</span></button>
                    <div class="accordion__body">
                        <p><?php esc_html_e('All cancellations in writing to info@diveintolembeh.com.','dil'); ?></p>
                        <table style="margin-top:12px;width:100%;font-size:14px;border-collapse:collapse;">
                            <tr style="border-bottom:1px solid var(--border);"><th style="text-align:left;padding:8px 0;font-family:var(--font-heading);font-size:11px;letter-spacing:0.1em;text-transform:uppercase;"><?php esc_html_e('Notice','dil'); ?></th><th style="text-align:left;padding:8px 0;font-family:var(--font-heading);font-size:11px;letter-spacing:0.1em;text-transform:uppercase;"><?php esc_html_e('Charge','dil'); ?></th></tr>
                            <tr style="border-bottom:1px solid var(--border);"><td style="padding:8px 0;"><?php esc_html_e('91–180 days','dil'); ?></td><td style="padding:8px 0;"><?php esc_html_e('25% fee, or deposit held 6 months','dil'); ?></td></tr>
                            <tr style="border-bottom:1px solid var(--border);"><td style="padding:8px 0;"><?php esc_html_e('46–90 days','dil'); ?></td><td style="padding:8px 0;"><?php esc_html_e('50% fee, or deposit held 6 months','dil'); ?></td></tr>
                            <tr><td style="padding:8px 0;"><?php esc_html_e('45 days or less','dil'); ?></td><td style="padding:8px 0;color:var(--burgundy);"><?php esc_html_e('Forfeit all monies paid','dil'); ?></td></tr>
                        </table>
                    </div>
                </div>
                <div class="accordion__item">
                    <button class="accordion__trigger" aria-expanded="false"><span class="accordion__title"><?php esc_html_e('How to book','dil'); ?></span><span class="accordion__icon" aria-hidden="true">+</span></button>
                    <div class="accordion__body">
                        <p><?php esc_html_e('Email info@diveintolembeh.com with full names, travel dates, package type, room type, number of divers/non-divers, and dietary requirements.','dil'); ?></p>
                        <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn btn-primary" style="margin-top:20px;display:inline-flex;">
                            <?php esc_html_e('Send an enquiry','dil'); ?>
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" style="margin-left:8px;"><path d="M20 4H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/></svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </main>

    <?php dil_sidebar(); ?>

</div><!-- .inner-page -->

<?php get_footer(); ?>
