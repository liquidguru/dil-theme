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
    <!-- Dark mode: apply saved preference before paint to prevent flash -->
    <script>(function(){var t=localStorage.getItem('dil-theme');if(t==='dark')document.documentElement.setAttribute('data-theme','dark');}());</script>
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
            <?php echo esc_html( sprintf( __( 'Booking %s', 'dil' ), dil_booking_seasons_label() ) ); ?>
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
                <!-- Social links: one "Follow" dropdown (markup in functions.php) -->
                <?php dil_follow_menu( 'full' ); ?>

                <!-- Dark mode toggle -->
                <button class="dark-mode-toggle" id="dark-mode-toggle" aria-label="<?php esc_attr_e( 'Toggle dark mode', 'dil' ); ?>">
                    <svg class="icon-moon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><path d="M21 12.79A9 9 0 1111.21 3 7 7 0 0021 12.79z"/></svg>
                    <svg class="icon-sun" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><circle cx="12" cy="12" r="5"/><line x1="12" y1="1" x2="12" y2="3"/><line x1="12" y1="21" x2="12" y2="23"/><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"/><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"/><line x1="1" y1="12" x2="3" y2="12"/><line x1="21" y1="12" x2="23" y2="12"/><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"/><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"/></svg>
                </button>

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
            <?php dil_follow_menu( 'compact' ); ?>
        </div>
        <button class="dark-mode-toggle dark-mode-toggle--compact" aria-label="<?php esc_attr_e( 'Toggle dark mode', 'dil' ); ?>">
            <svg class="icon-moon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><path d="M21 12.79A9 9 0 1111.21 3 7 7 0 0021 12.79z"/></svg>
            <svg class="icon-sun" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><circle cx="12" cy="12" r="5"/><line x1="12" y1="1" x2="12" y2="3"/><line x1="12" y1="21" x2="12" y2="23"/><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"/><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"/><line x1="1" y1="12" x2="3" y2="12"/><line x1="21" y1="12" x2="23" y2="12"/><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"/><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"/></svg>
        </button>

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
    <button class="dark-mode-toggle dark-mode-toggle--mobile" aria-label="<?php esc_attr_e( 'Toggle dark mode', 'dil' ); ?>">
        <svg class="icon-moon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><path d="M21 12.79A9 9 0 1111.21 3 7 7 0 0021 12.79z"/></svg>
        <svg class="icon-sun" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><circle cx="12" cy="12" r="5"/><line x1="12" y1="1" x2="12" y2="3"/><line x1="12" y1="21" x2="12" y2="23"/><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"/><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"/><line x1="1" y1="12" x2="3" y2="12"/><line x1="21" y1="12" x2="23" y2="12"/><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"/><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"/></svg>
        <span class="dark-mode-toggle__label dark-mode-toggle__label--dark"><?php esc_html_e( 'Dark mode', 'dil' ); ?></span>
        <span class="dark-mode-toggle__label dark-mode-toggle__label--light"><?php esc_html_e( 'Light mode', 'dil' ); ?></span>
    </button>

    <?php dil_social_icons(); ?>

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
