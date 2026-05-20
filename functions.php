<?php
/**
 * Dive Into Lembeh — Theme Functions
 */

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) exit;

define( 'DIL_VERSION', '1.2.0' );
define( 'DIL_DIR',     get_template_directory() );
define( 'DIL_URI',     get_template_directory_uri() );

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

/* ── Remove emoji scripts (not needed) ──────────────────────── */

remove_action( 'wp_head',             'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles',     'print_emoji_styles' );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'admin_print_styles',  'print_emoji_styles' );
