<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <link rel="icon" type="image/x-icon"  href="<?php echo esc_url( DIL_URI . '/assets/images/favicon.ico' ); ?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo esc_url( DIL_URI . '/assets/images/favicon-32x32.png' ); ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo esc_url( DIL_URI . '/assets/images/favicon-16x16.png' ); ?>">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo esc_url( DIL_URI . '/assets/images/apple-touch-icon.png' ); ?>">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<a class="visually-hidden" href="#main-content"><?php esc_html_e( 'Skip to content', 'dil' ); ?></a>

<header class="site-header" id="site-header">

    <div class="header-stripe"></div>

    <!-- Utility bar -->
    <div class="header-utility">
        <span class="header-utility__left">
            <?php esc_html_e( 'Est. MMVII · Kasawari Bay · North Sulawesi', 'dil' ); ?>
        </span>
        <span class="header-utility__right">
            <span><?php esc_html_e( 'Open now', 'dil' ); ?></span>
            &nbsp;·&nbsp;
            <?php esc_html_e( 'Booking 2026 season', 'dil' ); ?>
        </span>
    </div>

    <!-- Full nav (visible when not scrolled) -->
    <div class="full-nav">

        <!-- Wordmark row -->
        <div class="header-wordmark">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="wordmark wordmark--logo">
                <img src="<?php echo esc_url( DIL_URI . '/assets/images/logo.png' ); ?>"
                     alt="<?php bloginfo( 'name' ); ?>"
                     class="wordmark__logo-img"
                     width="320"
                     height="auto">
                <span class="wordmark__tagline">
                    &middot;&nbsp;<?php esc_html_e( 'A Boutique Macro-Dive Resort', 'dil' ); ?>&nbsp;&middot;
                </span>
            </a>
        </div>

        <!-- Main nav row -->
        <nav class="header-nav" aria-label="<?php esc_attr_e( 'Primary navigation', 'dil' ); ?>">

            <?php
            wp_nav_menu( [
                'theme_location' => 'primary',
                'menu_class'     => 'nav-primary',
                'container'      => false,
                'walker'         => new DIL_Nav_Walker(),
                'fallback_cb'    => false,
            ] );
            ?>

            <div class="nav-right">
                <!-- Social icons -->
                <div class="nav-social">
                    <a href="https://www.facebook.com/diveintolembeh" target="_blank" rel="noopener" aria-label="Facebook">
                        <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"/></svg>
                    </a>
                    <a href="https://www.instagram.com/diveintolembeh" target="_blank" rel="noopener" aria-label="Instagram">
                        <svg viewBox="0 0 24 24" aria-hidden="true"><rect x="2" y="2" width="20" height="20" rx="5" ry="5" fill="none" stroke="currentColor" stroke-width="2"/><circle cx="12" cy="12" r="4" fill="none" stroke="currentColor" stroke-width="2"/><circle cx="17.5" cy="6.5" r="1.5"/></svg>
                    </a>
                    <a href="https://www.youtube.com/@diveintolembeh" target="_blank" rel="noopener" aria-label="YouTube">
                        <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M22.54 6.42a2.78 2.78 0 00-1.94-1.96C18.88 4 12 4 12 4s-6.88 0-8.6.46A2.78 2.78 0 001.46 6.42 29 29 0 001 12a29 29 0 00.46 5.58 2.78 2.78 0 001.94 1.96C5.12 20 12 20 12 20s6.88 0 8.6-.46a2.78 2.78 0 001.94-1.96A29 29 0 0023 12a29 29 0 00-.46-5.58z"/><polygon fill="<?php echo esc_attr( get_template_directory_uri() ); ?>" points="9.75,15.02 15.5,12 9.75,8.98 9.75,15.02" style="fill:currentColor"/></svg>
                    </a>
                    <a href="https://vimeo.com/liquidguru" target="_blank" rel="noopener" aria-label="Vimeo">
                        <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M23.977 6.416c-.105 2.338-1.739 5.543-4.894 9.609-3.268 4.247-6.026 6.37-8.29 6.37-1.409 0-2.578-1.294-3.553-3.881L5.322 11.4C4.603 8.816 3.834 7.522 3.01 7.522c-.179 0-.806.378-1.881 1.132L0 7.197a315.065 315.065 0 003.501-3.128C5.08 2.701 6.266 1.984 7.055 1.91c1.867-.18 3.016 1.1 3.447 3.838.465 2.953.789 4.789.971 5.507.539 2.45 1.131 3.674 1.776 3.674.502 0 1.256-.796 2.265-2.385 1.004-1.589 1.54-2.797 1.612-3.628.144-1.371-.395-2.061-1.614-2.061-.574 0-1.167.121-1.777.391 1.186-3.868 3.434-5.757 6.762-5.637 2.473.06 3.628 1.664 3.48 4.807z"/></svg>
                    </a>
                </div>

                <!-- Partner link -->
                <a href="https://diveintorajaampat.com/" class="nav-partner" target="_blank" rel="noopener noreferrer">
                    <img src="<?php echo esc_url( DIL_URI . '/assets/images/dira-logo.png' ); ?>"
                         alt="<?php esc_attr_e( 'Dive Into Raja Ampat', 'dil' ); ?>"
                         class="nav-partner__logo">
                </a>

                <!-- CTAs -->
                <div class="nav-ctas">
                    <a href="<?php echo esc_url( home_url( '/rates/' ) ); ?>" class="btn btn-outline-dark">
                        <?php esc_html_e( 'Rates', 'dil' ); ?>
                    </a>
                    <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="btn btn-primary">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M20 4H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/></svg>
                        <?php esc_html_e( 'Contact', 'dil' ); ?>
                    </a>
                </div>

                <!-- Mobile hamburger -->
                <button class="nav-hamburger" aria-label="<?php esc_attr_e( 'Open menu', 'dil' ); ?>" id="nav-hamburger">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
            </div>

        </nav><!-- .header-nav -->
    </div><!-- .full-nav -->

    <!-- Compact sticky nav (shown on scroll) -->
    <nav class="compact-nav" aria-label="<?php esc_attr_e( 'Compact navigation', 'dil' ); ?>">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="compact-nav__wordmark">
            <img src="<?php echo esc_url( DIL_URI . '/assets/images/logo-compact.png' ); ?>"
                 alt="<?php bloginfo( 'name' ); ?>"
                 class="compact-nav__logo"
                 height="40">
        </a>
        <div class="compact-nav__links">
            <a href="<?php echo esc_url( home_url( '/the-diving/' ) ); ?>"><?php esc_html_e( 'Diving', 'dil' ); ?></a>
            <a href="<?php echo esc_url( home_url( '/the-resort/' ) ); ?>"><?php esc_html_e( 'Resort', 'dil' ); ?></a>
            <a href="<?php echo esc_url( home_url( '/galleries/' ) ); ?>"><?php esc_html_e( 'Galleries', 'dil' ); ?></a>
            <a href="<?php echo esc_url( home_url( '/info/' ) ); ?>"><?php esc_html_e( 'Info', 'dil' ); ?></a>
        </div>
        <a href="https://diveintorajaampat.com/" class="compact-nav__partner" target="_blank" rel="noopener noreferrer">
            <img src="<?php echo esc_url( DIL_URI . '/assets/images/dira-logo.png' ); ?>"
                 alt="<?php esc_attr_e( 'Dive Into Raja Ampat', 'dil' ); ?>"
                 class="compact-nav__partner-logo">
        </a>
        <div class="compact-nav__cta">
            <a href="<?php echo esc_url( home_url( '/rates/' ) ); ?>" class="btn btn-outline-dark">
                <?php esc_html_e( 'Rates', 'dil' ); ?>
            </a>
            <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="btn btn-primary">
                <?php esc_html_e( 'Contact', 'dil' ); ?>
            </a>
        </div>
        <button class="nav-hamburger compact-nav__hamburger" aria-label="<?php esc_attr_e( 'Open menu', 'dil' ); ?>" id="nav-hamburger-compact">
            <span></span>
            <span></span>
            <span></span>
        </button>
    </nav>

</header><!-- .site-header -->

<!-- Mobile nav overlay -->
<div class="mobile-nav" id="mobile-nav" role="dialog" aria-modal="true" aria-label="<?php esc_attr_e( 'Mobile navigation', 'dil' ); ?>">
    <button class="mobile-nav__close" id="mobile-nav-close" aria-label="<?php esc_attr_e( 'Close menu', 'dil' ); ?>">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true">
            <line x1="4" y1="4" x2="20" y2="20"/>
            <line x1="20" y1="4" x2="4" y2="20"/>
        </svg>
    </button>
    <nav class="mobile-nav__links">
        <a href="<?php echo esc_url( home_url( '/the-diving/' ) ); ?>"><?php esc_html_e( 'Diving', 'dil' ); ?></a>
        <a href="<?php echo esc_url( home_url( '/the-resort/' ) ); ?>"><?php esc_html_e( 'Resort', 'dil' ); ?></a>
        <a href="<?php echo esc_url( home_url( '/galleries/' ) ); ?>"><?php esc_html_e( 'Galleries', 'dil' ); ?></a>
        <a href="<?php echo esc_url( home_url( '/info/' ) ); ?>"><?php esc_html_e( 'Info', 'dil' ); ?></a>
        <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php esc_html_e( 'Contact', 'dil' ); ?></a>
    </nav>
    <div class="mobile-nav__ctas">
        <a href="<?php echo esc_url( home_url( '/rates/' ) ); ?>" class="btn btn-outline-dark">
            <?php esc_html_e( 'Rates', 'dil' ); ?>
        </a>
        <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="btn btn-primary">
            <?php esc_html_e( 'Enquire Now', 'dil' ); ?>
        </a>
    </div>
    <a href="https://diveintorajaampat.com/" class="mobile-nav__partner" target="_blank" rel="noopener noreferrer">
        <img src="<?php echo esc_url( DIL_URI . '/assets/images/dira-logo.png' ); ?>"
             alt="<?php esc_attr_e( 'Dive Into Raja Ampat — Sister Resort', 'dil' ); ?>">
    </a>
</div>

<main id="main-content">
