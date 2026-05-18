<?php
/**
 * Inner page shell helpers.
 *
 * dil_page_banner( array $args )
 * dil_sidebar()
 */

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Render the page banner (kicker + title + subtitle over photo or burgundy gradient).
 *
 * @param array $args {
 *   string $kicker     — small eyebrow label
 *   string $title      — H1 text, may contain <em> for italic
 *   string $subtitle   — optional subheading
 *   string $bg_url     — optional background image URL
 *   bool   $no_photo   — force burgundy gradient even if bg_url set
 * }
 */
function dil_page_banner( array $args ): void {
    $defaults = [
        'kicker'   => '',
        'title'    => '',
        'subtitle' => '',
        'bg_url'   => '',
        'no_photo' => false,
    ];
    $a = wp_parse_args( $args, $defaults );

    $has_photo = ! $a['no_photo'] && ! empty( $a['bg_url'] );
    $classes   = 'page-banner' . ( $has_photo ? '' : ' page-banner--no-photo' );
    ?>
    <div class="<?php echo esc_attr( $classes ); ?>">
        <?php if ( $has_photo ) : ?>
            <div class="page-banner__bg">
                <img src="<?php echo esc_url( $a['bg_url'] ); ?>"
                     alt=""
                     loading="lazy">
            </div>
            <div class="page-banner__overlay" aria-hidden="true"></div>
        <?php endif; ?>

        <div class="page-banner__content">
            <?php if ( $a['kicker'] ) : ?>
                <p class="page-banner__kicker eyebrow"><?php echo esc_html( $a['kicker'] ); ?></p>
            <?php endif; ?>

            <?php if ( $a['title'] ) : ?>
                <h1 class="page-banner__title">
                    <?php echo wp_kses( $a['title'], [ 'em' => [], 'br' => [] ] ); ?>
                </h1>
            <?php endif; ?>

            <?php if ( $a['subtitle'] ) : ?>
                <p class="page-banner__subtitle"><?php echo esc_html( $a['subtitle'] ); ?></p>
            <?php endif; ?>
        </div>
    </div>
    <?php
}

/**
 * Render the inner page sidebar (7 widgets).
 */
function dil_sidebar(): void {
    ?>
    <aside class="inner-page__sidebar" aria-label="<?php esc_attr_e( 'Sidebar', 'dil' ); ?>">

        <!-- 1. Weather widget -->
        <div class="sidebar-widget">
            <div class="sidebar-widget__head">
                <span class="sidebar-widget__label"><?php esc_html_e( 'Lembeh Weather', 'dil' ); ?></span>
            </div>
            <div class="sidebar-widget__body widget-weather__body">
                <div>
                    <div class="widget-weather__temp">29&deg;C</div>
                </div>
                <div class="widget-weather__details">
                    <div class="widget-weather__condition"><?php esc_html_e( 'Partly cloudy', 'dil' ); ?></div>
                    <div class="widget-weather__location"><?php esc_html_e( 'Kasawari Bay', 'dil' ); ?></div>
                </div>
            </div>
        </div>

        <!-- 2. Search -->
        <div class="sidebar-widget widget-search">
            <div class="sidebar-widget__head">
                <span class="sidebar-widget__label"><?php esc_html_e( 'Search', 'dil' ); ?></span>
            </div>
            <div class="sidebar-widget__body">
                <?php get_search_form(); ?>
            </div>
        </div>

        <!-- 3. Rates CTA -->
        <div class="sidebar-widget widget-rates">
            <div class="sidebar-widget__head">
                <span class="sidebar-widget__label"><?php esc_html_e( '2026 Season', 'dil' ); ?></span>
            </div>
            <div class="widget-rates__body">
                <div class="widget-rates__heading">
                    <?php esc_html_e( 'Book Your Stay', 'dil' ); ?>
                </div>
                <p class="widget-rates__text">
                    <?php esc_html_e( 'Packages from 4 nights. Includes diving, meals, and transfers. Limited availability.', 'dil' ); ?>
                </p>
                <a href="<?php echo esc_url( home_url( '/info/rates/' ) ); ?>" class="btn btn-outline">
                    <?php esc_html_e( 'View Rates', 'dil' ); ?>
                </a>
            </div>
        </div>

        <!-- 4. Instagram -->
        <div class="sidebar-widget">
            <div class="sidebar-widget__head">
                <span class="sidebar-widget__label"><?php esc_html_e( 'Instagram', 'dil' ); ?></span>
            </div>
            <div class="sidebar-widget__body widget-instagram">
                <?php
                // Output from Instagram Feed plugin (Smash Balloon / SBI) if active
                if ( shortcode_exists( 'instagram-feed' ) ) {
                    echo do_shortcode( '[instagram-feed num=9 cols=3 showheader=false showbutton=false showfollow=false]' );
                } else {
                    ?>
                    <div class="widget-instagram__grid">
                        <?php
                        for ( $i = 0; $i < 9; $i++ ) {
                            echo '<a href="https://www.instagram.com/diveintolembeh" target="_blank" rel="noopener" aria-label="' . esc_attr__( 'Instagram post', 'dil' ) . '">';
                            echo dil_placeholder( 'IG' ); // phpcs:ignore
                            echo '</a>';
                        }
                        ?>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>

        <!-- 5. TripAdvisor -->
        <div class="sidebar-widget">
            <div class="sidebar-widget__head">
                <span class="sidebar-widget__label"><?php esc_html_e( 'Tripadvisor', 'dil' ); ?></span>
            </div>
            <div class="sidebar-widget__body">
                <div class="widget-ta__rating" aria-label="<?php esc_attr_e( '5 out of 5', 'dil' ); ?>">
                    <?php for ( $i = 0; $i < 5; $i++ ) : ?>
                        <span class="widget-ta__dot" aria-hidden="true"></span>
                    <?php endfor; ?>
                </div>
                <p class="widget-ta__count">
                    <?php esc_html_e( 'Excellent &mdash; 200+ reviews', 'dil' ); ?>
                </p>
                <p class="widget-ta__quote">
                    &ldquo;<?php esc_html_e( 'The best muck diving resort I\'ve stayed at. The divemasters know every inch of the strait.', 'dil' ); ?>&rdquo;
                </p>
            </div>
        </div>

        <!-- 6. From the journal (most recent post) -->
        <?php
        $recent = new WP_Query( [ 'posts_per_page' => 1, 'post_status' => 'publish' ] );
        if ( $recent->have_posts() ) :
            $recent->the_post();
            ?>
            <div class="sidebar-widget">
                <div class="sidebar-widget__head">
                    <span class="sidebar-widget__label"><?php esc_html_e( 'From the Journal', 'dil' ); ?></span>
                </div>
                <div class="sidebar-widget__body">
                    <div class="widget-journal__post">
                        <?php if ( has_post_thumbnail() ) : ?>
                            <img class="widget-journal__thumb"
                                 src="<?php the_post_thumbnail_url( 'dil-thumb' ); ?>"
                                 alt="<?php the_title_attribute(); ?>"
                                 loading="lazy">
                        <?php endif; ?>
                        <div>
                            <a href="<?php the_permalink(); ?>" class="widget-journal__title">
                                <?php the_title(); ?>
                            </a>
                            <div class="widget-journal__date mono">
                                <?php echo esc_html( get_the_date( 'j M Y' ) ); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            wp_reset_postdata();
        endif;
        ?>

        <!-- 7. Partners -->
        <div class="sidebar-widget">
            <div class="sidebar-widget__head">
                <span class="sidebar-widget__label"><?php esc_html_e( 'Partners', 'dil' ); ?></span>
            </div>
            <div class="sidebar-widget__body">
                <div class="widget-partners__list">
                    <div class="widget-partner">
                        <div class="widget-partner__icon" aria-hidden="true">DAN</div>
                        <div>
                            <div class="widget-partner__name">DAN Insurance</div>
                            <div class="widget-partner__desc">
                                <a href="https://www.diversalertnetwork.org" target="_blank" rel="noopener">
                                    <?php esc_html_e( 'Dive insurance for every diver', 'dil' ); ?>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="widget-partner">
                        <div class="widget-partner__icon" aria-hidden="true">RA</div>
                        <div>
                            <div class="widget-partner__name">Raja Ampat</div>
                            <div class="widget-partner__desc">
                                <a href="<?php echo esc_url( home_url( '/raja-ampat/' ) ); ?>">
                                    <?php esc_html_e( 'Our sister destination', 'dil' ); ?>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </aside>
    <?php
}
