<?php
/**
 * Dive Into Lembeh — Theme Functions
 */

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) exit;

define( 'DIL_VERSION', '1.2.0' );
define( 'DIL_DIR',     get_template_directory() );
define( 'DIL_URI',     get_template_directory_uri() );

// CARTO basemaps key — referer-restricted to diveintolembeh.com, *.diveintolembeh.com, diveintolembeh.local
define( 'DIL_CARTO_KEY', 'cb1_3v34_1_23efb3e25995a7ee0f6a005d' );

// Staging-only visitor log (Tools → Staging visitors). Remove this line + the file before launch.
require_once DIL_DIR . '/inc/staging-visits.php';

/* ── Theme setup ─────────────────────────────────────────────── */

function dil_setup() {
    load_theme_textdomain( 'dil', DIL_DIR . '/languages' );

    add_theme_support( 'automatic-feed-links' );
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'html5', [ 'search-form', 'comment-form', 'gallery', 'caption', 'style', 'script' ] );
    add_theme_support( 'custom-logo' );
    add_theme_support( 'responsive-embeds' );

    // Thumbnail sizes used by the theme
    add_image_size( 'dil-hero',   1920, 1080, true );
    add_image_size( 'dil-banner', 1440, 500,  true );
    add_image_size( 'dil-tile',   800,  600,  true );
    add_image_size( 'dil-thumb',  400,  300,  true );

    register_nav_menus( [
        'primary'  => __( 'Primary Navigation', 'dil' ),
        'footer-1' => __( 'Footer — Explore',   'dil' ),
        'footer-2' => __( 'Footer — Plan',       'dil' ),
        'footer-3' => __( 'Footer — Connect',    'dil' ),
    ] );
}
add_action( 'after_setup_theme', 'dil_setup' );

/* ── Enqueue scripts & styles ───────────────────────────────── */

function dil_scripts() {
    // Google Fonts — DM Mono only (Code Pro & PT Sans via Use Any Font plugin)
    wp_enqueue_style(
        'dil-google-fonts',
        'https://fonts.googleapis.com/css2?family=DM+Mono:ital,wght@0,400;0,500;1,400&family=Tangerine:wght@400;700&display=swap',
        [],
        null
    );

    // Main stylesheet — version from file mtime for automatic cache-busting
    wp_enqueue_style( 'dil-style', DIL_URI . '/assets/css/main.css', [ 'dil-google-fonts' ], filemtime( DIL_DIR . '/assets/css/main.css' ) );

    // Main JS
    wp_enqueue_script( 'dil-main', DIL_URI . '/assets/js/main.js', [], filemtime( DIL_DIR . '/assets/js/main.js' ), true );

    // Pass data to JS
    wp_localize_script( 'dil-main', 'DIL', [
        'ajaxUrl' => admin_url( 'admin-ajax.php' ),
        'nonce'   => wp_create_nonce( 'dil_nonce' ),
    ] );
    // Leaflet map — front page and info page
    if ( is_front_page() || is_page_template( 'page-templates/template-info.php' ) ) {
        wp_enqueue_style(  'leaflet', 'https://unpkg.com/leaflet@1.9.4/dist/leaflet.css', [], '1.9.4' );
        wp_enqueue_script( 'leaflet', 'https://unpkg.com/leaflet@1.9.4/dist/leaflet.js',  [], '1.9.4', true );
    }
}
add_action( 'wp_enqueue_scripts', 'dil_scripts' );

/* ── Widget areas ───────────────────────────────────────────── */

function dil_widgets_init() {
    register_sidebar( [
        'name'          => __( 'Inner Page Sidebar', 'dil' ),
        'id'            => 'sidebar-inner',
        'before_widget' => '<div id="%1$s" class="sidebar-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<div class="sidebar-widget__head"><span class="sidebar-widget__label">',
        'after_title'   => '</span></div>',
    ] );
}
add_action( 'widgets_init', 'dil_widgets_init' );

/* ── Custom nav walker — adds ▾ only to items with children ── */

class DIL_Nav_Walker extends Walker_Nav_Menu {

    public function start_lvl( &$output, $depth = 0, $args = null ) {
        $output .= '<ul class="sub-menu">';
    }

    public function end_lvl( &$output, $depth = 0, $args = null ) {
        $output .= '</ul>';
    }

    public function start_el( &$output, $data_object, $depth = 0, $args = null, $current_object_id = 0 ) {
        $item = $data_object;
        $classes = empty( $item->classes ) ? [] : (array) $item->classes;
        $has_children = in_array( 'menu-item-has-children', $classes );

        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );
        $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

        $output .= '<li' . $class_names . '>';

        $atts = [
            'title'  => ! empty( $item->attr_title ) ? $item->attr_title : '',
            'target' => ! empty( $item->target )     ? $item->target     : '',
            'rel'    => ! empty( $item->xfn )         ? $item->xfn       : '',
            'href'   => ! empty( $item->url )         ? $item->url       : '',
        ];

        $atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );
        $attributes = '';
        foreach ( $atts as $attr => $value ) {
            if ( ! empty( $value ) ) {
                $attributes .= ' ' . esc_attr( $attr ) . '="' . esc_attr( $value ) . '"';
            }
        }

        $title = apply_filters( 'the_title', $item->title, $item->ID );
        $output .= '<a' . $attributes . '>' . esc_html( $title ) . '</a>';
    }

    public function end_el( &$output, $data_object, $depth = 0, $args = null ) {
        $output .= '</li>';
    }
}

/* ── Helper: placeholder image ──────────────────────────────── */

function dil_placeholder( string $label, string $extra_class = '' ): string {
    return '<div class="photo-placeholder ' . esc_attr( $extra_class ) . '"><span>' . esc_html( $label ) . '</span></div>';
}

/* ── Helper: night-dive hero slide data ─────────────────────── */

/**
 * Turns a hero slide URL into { src, name } for the night-dive hero caption.
 * Name comes from the original slide filenames, then the Media Library title
 * (skipped when it is just the filename, which is WordPress's default).
 */
function dil_hero_slide_data( string $url ): array {
    $known = [
        'sl-pygmy'  => __( 'Pygmy seahorse', 'dil' ),
        'sl-frog'   => __( 'Frogfish', 'dil' ),
        'sl-nudi01' => __( 'Nudibranch', 'dil' ),
        'sl-solar'  => __( 'Solar-powered nudibranch', 'dil' ),
        'sl-candy'  => __( 'Candy crab', 'dil' ),
    ];
    $slug = strtolower( pathinfo( (string) wp_parse_url( $url, PHP_URL_PATH ), PATHINFO_FILENAME ) );
    $name = $known[ $slug ] ?? '';
    if ( ! $name && ( $id = attachment_url_to_postid( $url ) ) ) {
        $title = get_the_title( $id );
        if ( strtolower( $title ) !== $slug ) $name = $title;
    }
    return [ 'src' => $url, 'name' => $name ];
}

/* ── Social links (Follow dropdown + mobile menu icons) ─────── */

/** The site's social profiles — edit links here; every header/menu uses this list. */
function dil_social_links(): array {
    return [
        'Facebook'  => [ 'https://www.facebook.com/diveintolembeh', '<path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"/>' ],
        'Instagram' => [ 'https://www.instagram.com/diveintolembeh', '<rect x="2" y="2" width="20" height="20" rx="5" ry="5" fill="none" stroke="currentColor" stroke-width="2"/><circle cx="12" cy="12" r="4" fill="none" stroke="currentColor" stroke-width="2"/><circle cx="17.5" cy="6.5" r="1.5"/>' ],
        'YouTube'   => [ 'https://www.youtube.com/@diveintolembeh', '<path d="M22.54 6.42a2.78 2.78 0 00-1.94-1.96C18.88 4 12 4 12 4s-6.88 0-8.6.46A2.78 2.78 0 001.46 6.42 29 29 0 001 12a29 29 0 00.46 5.58 2.78 2.78 0 001.94 1.96C5.12 20 12 20 12 20s6.88 0 8.6-.46a2.78 2.78 0 001.94-1.96A29 29 0 0023 12a29 29 0 00-.46-5.58z"/><polygon points="9.75,15.02 15.5,12 9.75,8.98 9.75,15.02" style="fill:var(--paper, #fff)"/>' ],
        'Vimeo'     => [ 'https://vimeo.com/liquidguru', '<path d="M23.977 6.416c-.105 2.338-1.739 5.543-4.894 9.609-3.268 4.247-6.026 6.37-8.29 6.37-1.409 0-2.578-1.294-3.553-3.881L5.322 11.4C4.603 8.816 3.834 7.522 3.01 7.522c-.179 0-.806.378-1.881 1.132L0 7.197a315.065 315.065 0 003.501-3.128C5.08 2.701 6.266 1.984 7.055 1.91c1.867-.18 3.016 1.1 3.447 3.838.465 2.953.789 4.789.971 5.507.539 2.45 1.131 3.674 1.776 3.674.502 0 1.256-.796 2.265-2.385 1.004-1.589 1.54-2.797 1.612-3.628.144-1.371-.395-2.061-1.614-2.061-.574 0-1.167.121-1.777.391 1.186-3.868 3.434-5.757 6.762-5.637 2.473.06 3.628 1.664 3.48 4.807z"/>' ],
    ];
}

/**
 * Social links collapsed into one "Follow" dropdown. Used in the full header and
 * the compact (scrolled) header; $variant keeps the ids unique. Behaviour in main.js.
 */
function dil_follow_menu( string $variant = 'full' ): void {
    $id    = 'nav-social-menu-' . sanitize_key( $variant );
    $links = dil_social_links();
    ?>
    <div class="nav-social nav-social--<?php echo esc_attr( sanitize_key( $variant ) ); ?>">
        <button class="nav-social__toggle" type="button" aria-expanded="false" aria-controls="<?php echo esc_attr( $id ); ?>">
            <?php esc_html_e( 'Follow', 'dil' ); ?>
        </button>
        <ul class="nav-social__menu" id="<?php echo esc_attr( $id ); ?>">
            <?php foreach ( $links as $name => [ $url, $svg ] ) : ?>
                <li><a href="<?php echo esc_url( $url ); ?>" target="_blank" rel="noopener">
                    <svg viewBox="0 0 24 24" aria-hidden="true"><?php echo $svg; // phpcs:ignore -- static SVG markup above ?></svg>
                    <?php echo esc_html( $name ); ?>
                </a></li>
            <?php endforeach; ?>
        </ul>
    </div>
    <?php
}

/** Row of round social icon links — the mobile menu's version of the Follow dropdown. */
function dil_social_icons(): void {
    ?>
    <div class="social-icons">
        <?php foreach ( dil_social_links() as $name => [ $url, $svg ] ) : ?>
            <a href="<?php echo esc_url( $url ); ?>" target="_blank" rel="noopener" aria-label="<?php echo esc_attr( $name ); ?>">
                <svg viewBox="0 0 24 24" aria-hidden="true"><?php echo $svg; // phpcs:ignore -- static SVG markup ?></svg>
            </a>
        <?php endforeach; ?>
    </div>
    <?php
}

/* ── Helper: animated "fly map" ─────────────────────────────── */

/**
 * Prints an animated route map: a static base image with planes flying the routes
 * (animation in main.js, styles in main.css section "Fly map").
 * Each map is one data file — assets/data/maps/{$slug}.json — built by the scripts
 * in design-src/maps/ (see the README there). A new map = a new JSON + base image.
 * Clicking it opens the static map full size in the lightbox.
 */
function dil_fly_map( string $slug ): void {
    $file = DIL_DIR . '/assets/data/maps/' . sanitize_file_name( $slug ) . '.json';
    if ( ! is_readable( $file ) ) return;
    $map = json_decode( (string) file_get_contents( $file ), true );
    if ( ! is_array( $map ) || empty( $map['image'] ) ) return;

    $img  = $map['image'];
    $jpg  = DIL_URI . '/' . $img['jpg'];
    $webp = DIL_URI . '/' . $img['webp'];
    $vb   = implode( ' ', array_map( 'floatval', $map['viewBox'] ) );
    $id   = 'fm-' . sanitize_key( $slug );
    $alt  = $map['alt'] ?? '';
    // Only what the animation needs goes to the browser
    // Optional close-up that pops out after landings (its own SVG file, inlined below)
    $zoom = $map['zoom'] ?? null;
    $zoom_svg = '';
    if ( $zoom && is_readable( DIL_DIR . '/' . $zoom['svg'] ) ) {
        // keep the inner markup only; the outer <svg> is rebuilt with our own viewBox
        $zoom_svg = preg_replace( '#^.*?<svg[^>]*>|</svg>\s*$#s', '', (string) file_get_contents( DIL_DIR . '/' . $zoom['svg'] ) );
    } else {
        $zoom = null;
    }
    $config = wp_json_encode( [
        'routes'  => $map['routes'],
        'flights' => $map['flights'],
        'timing'  => $map['timing'] ?? [],
        'plane'   => '#' . $id . '-plane',
        'zoom'    => $zoom ? array_diff_key( $zoom, [ 'svg' => 1 ] ) : null,
    ] );
    ?>
    <div class="fly-map grid-tile" id="<?php echo esc_attr( $id ); ?>"
         style="aspect-ratio: <?php echo (int) $img['width']; ?> / <?php echo (int) $img['height']; ?>;"
         data-full="<?php echo esc_url( $jpg ); ?>" data-alt="<?php echo esc_attr( $alt ); ?>"
         data-fly-map="<?php echo esc_attr( $config ); ?>"
         role="button" tabindex="0" aria-label="<?php esc_attr_e( 'Open the map full size', 'dil' ); ?>">
        <picture>
            <source srcset="<?php echo esc_url( $webp ); ?>" type="image/webp">
            <img src="<?php echo esc_url( $jpg ); ?>" width="<?php echo (int) $img['width']; ?>" height="<?php echo (int) $img['height']; ?>"
                 alt="<?php echo esc_attr( $alt ); ?>" loading="lazy">
        </picture>
        <svg viewBox="<?php echo esc_attr( $vb ); ?>" aria-hidden="true" focusable="false">
            <defs>
                <!-- Top-down airliner, nose pointing +x -->
                <g id="<?php echo esc_attr( $id ); ?>-plane">
                    <path d="M42,0 C42,-3.5 38,-5 33,-5 L8,-5 L-6,-40 L-15,-40 L-7,-5 L-27,-5 L-34,-16 L-40,-16 L-37,-4.5 L-39,0 L-37,4.5 L-40,16 L-34,16 L-27,5 L-7,5 L-15,40 L-6,40 L8,5 L33,5 C38,5 42,3.5 42,0 Z"
                          fill="#fff" stroke="#6b6b6b" stroke-width="2.2" stroke-linejoin="round"/>
                    <path d="M30,-2.2 L36,-2.2" stroke="#9aa3a8" stroke-width="2.4" stroke-linecap="round"/>
                </g>
            </defs>
            <?php if ( ! empty( $map['pulse'] ) ) : $p = $map['pulse']; ?>
                <circle class="fly-map__pulse" cx="<?php echo (float) $p['cx']; ?>" cy="<?php echo (float) $p['cy']; ?>" r="<?php echo (float) $p['r']; ?>"/>
                <circle class="fly-map__pulse fly-map__pulse--2" cx="<?php echo (float) $p['cx']; ?>" cy="<?php echo (float) $p['cy']; ?>" r="<?php echo (float) $p['r']; ?>"/>
            <?php endif; ?>
            <?php if ( ! empty( $map['ping'] ) ) : $g = $map['ping']; ?>
                <circle class="fly-map__ping" cx="<?php echo (float) $g['cx']; ?>" cy="<?php echo (float) $g['cy']; ?>" r="<?php echo (float) $g['r']; ?>"/>
            <?php endif; ?>
            <g class="fly-map__flights"></g>
            <?php if ( $zoom ) : $l = $zoom['local']; ?>
                <!-- Close-up: cone + card + inset; geometry set by main.js (wide vs narrow screens) -->
                <g class="fly-map__zoom" style="transform-origin: <?php echo (float) $zoom['from']['cx']; ?>px <?php echo (float) $zoom['from']['cy']; ?>px;">
                    <polygon class="fly-map__cone" points="0,0"/>
                    <rect class="fly-map__card" rx="22"/>
                    <svg class="fly-map__inset" viewBox="<?php echo esc_attr( implode( ' ', array_map( 'floatval', $l ) ) ); ?>" preserveAspectRatio="xMidYMid meet" overflow="visible">
                        <?php echo $zoom_svg; // phpcs:ignore -- our own static SVG file ?>
                    </svg>
                </g>
            <?php endif; ?>
        </svg>
    </div>
    <?php
}

/* ── Helper: get page ID by path ─────────────────────────────── */

function dil_page_id( string $path ): int {
    $page = get_page_by_path( $path );
    return $page ? (int) $page->ID : 0;
}

/* ── Helper: featured image or placeholder ───────────────────── */

function dil_thumbnail( int $post_id, string $size = 'dil-tile', string $label = 'Photo' ): string {
    if ( has_post_thumbnail( $post_id ) ) {
        return get_the_post_thumbnail( $post_id, $size, [ 'loading' => 'lazy' ] );
    }
    return dil_placeholder( $label );
}

/* ── Contact form AJAX handler ───────────────────────────────── */

function dil_handle_contact() {
    check_ajax_referer( 'dil_nonce', 'nonce' );

    $name     = sanitize_text_field( $_POST['name']    ?? '' );
    $email    = sanitize_email(      $_POST['email']   ?? '' );
    $arrival  = sanitize_text_field( $_POST['arrival'] ?? '' );
    $nights   = sanitize_text_field( $_POST['nights']  ?? '' );
    $interest = sanitize_text_field( $_POST['interest'] ?? '' );
    $message  = sanitize_textarea_field( $_POST['message'] ?? '' );

    $errors = [];
    if ( empty( $name ) )               $errors['name']    = __( 'Please enter your name.', 'dil' );
    if ( ! is_email( $email ) )         $errors['email']   = __( 'Please enter a valid email address.', 'dil' );
    if ( empty( $message ) )            $errors['message'] = __( 'Please enter a message.', 'dil' );

    if ( ! empty( $errors ) ) {
        wp_send_json_error( [ 'errors' => $errors ] );
    }

    $to      = 'info@diveintolembeh.com';
    $subject = sprintf( __( 'Enquiry from %s — Dive Into Lembeh', 'dil' ), $name );
    $body    = sprintf(
        "Name: %s\nEmail: %s\nArrival: %s\nNights: %s\nInterest: %s\n\n%s",
        $name, $email, $arrival, $nights, $interest, $message
    );

    $headers = [
        'Content-Type: text/plain; charset=UTF-8',
        'Reply-To: ' . $name . ' <' . $email . '>',
    ];

    $sent = wp_mail( $to, $subject, $body, $headers );

    if ( $sent ) {
        wp_send_json_success( [ 'message' => __( "Thank you — we'll reply within 24 hours.", 'dil' ) ] );
    } else {
        wp_send_json_error( [ 'message' => __( 'Something went wrong. Please email us directly.', 'dil' ) ] );
    }
}
add_action( 'wp_ajax_nopriv_dil_contact', 'dil_handle_contact' );
add_action( 'wp_ajax_dil_contact',        'dil_handle_contact' );

/* ── Hotel / LodgingBusiness JSON-LD schema ─────────────────── */

function dil_schema_jsonld() {
    $schema = [
        '@context'    => 'https://schema.org',
        '@type'       => [ 'LodgingBusiness', 'Resort' ],
        'name'        => 'Dive Into Lembeh',
        'alternateName' => 'DIL',
        'description' => 'Boutique macro-dive resort on the Lembeh Strait, North Sulawesi. World-class muck diving, private Onsen bungalows, freshwater pool and personalised service.',
        'url'         => 'https://www.diveintolembeh.com',
        'logo'        => get_template_directory_uri() . '/assets/images/logo.png',
        'image'       => get_template_directory_uri() . '/assets/images/hero-1.jpg',
        'telephone'   => '',
        'email'       => 'info@diveintolembeh.com',
        'address'     => [
            '@type'           => 'PostalAddress',
            'streetAddress'   => 'Kasawari Bay, Bitung',
            'addressLocality' => 'Bitung',
            'addressRegion'   => 'North Sulawesi',
            'postalCode'      => '95524',
            'addressCountry'  => 'ID',
        ],
        'geo' => [
            '@type'     => 'GeoCoordinates',
            'latitude'  => '1.5005',
            'longitude' => '125.2411',
        ],
        'priceRange'  => '$$$',
        'starRating'  => [
            '@type'       => 'Rating',
            'ratingValue' => '4',
        ],
        'amenityFeature' => [
            [ '@type' => 'LocationFeatureSpecification', 'name' => 'Freshwater Swimming Pool',  'value' => true ],
            [ '@type' => 'LocationFeatureSpecification', 'name' => 'Private Onsen Hot Tub',     'value' => true ],
            [ '@type' => 'LocationFeatureSpecification', 'name' => 'Air Conditioning',          'value' => true ],
            [ '@type' => 'LocationFeatureSpecification', 'name' => 'Restaurant',                'value' => true ],
            [ '@type' => 'LocationFeatureSpecification', 'name' => 'Bar',                       'value' => true ],
            [ '@type' => 'LocationFeatureSpecification', 'name' => 'Dive Centre',               'value' => true ],
            [ '@type' => 'LocationFeatureSpecification', 'name' => 'Camera Room',               'value' => true ],
            [ '@type' => 'LocationFeatureSpecification', 'name' => 'Free WiFi',                 'value' => true ],
        ],
        'numberOfRooms' => 13,
        'checkinTime'   => '14:00',
        'checkoutTime'  => '12:00',
        'currenciesAccepted' => 'USD, IDR',
        'paymentAccepted'    => 'Cash, Credit Card, Bank Transfer',
        'sameAs' => [
            'https://www.facebook.com/diveintolembeh',
            'https://www.instagram.com/diveintolembeh',
            'https://www.youtube.com/@diveintolembeh',
            'https://vimeo.com/liquidguru',
        ],
    ];

    echo '<script type="application/ld+json">' . wp_json_encode( $schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT ) . '</script>' . "\n";
}
add_action( 'wp_head', 'dil_schema_jsonld' );

/* ── Remove emoji scripts (not needed) ──────────────────────── */

remove_action( 'wp_head',             'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles',     'print_emoji_styles' );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'admin_print_styles',  'print_emoji_styles' );
