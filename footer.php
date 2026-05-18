</main><!-- #main-content -->

<footer class="site-footer">

    <div class="footer-eyeline" aria-hidden="true">see you under</div>

    <div class="footer-grid">

        <!-- Brand block -->
        <div class="footer-brand">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="wordmark">
                <span class="wordmark__text">
                    Dive<em>into</em>Lembeh
                </span>
                <span class="wordmark__tagline">
                    &middot;&nbsp;<?php esc_html_e( 'A Boutique Macro-Dive Resort', 'dil' ); ?>&nbsp;&middot;
                </span>
            </a>
            <div class="footer-brand__social">
                <a href="https://www.facebook.com/diveintolembeh" target="_blank" rel="noopener" aria-label="Facebook">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"/></svg>
                </a>
                <a href="https://www.instagram.com/diveintolembeh" target="_blank" rel="noopener" aria-label="Instagram">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><circle cx="12" cy="12" r="4"/><circle cx="17.5" cy="6.5" r="1" fill="currentColor" stroke="none"/></svg>
                </a>
                <a href="https://www.youtube.com/@diveintolembeh" target="_blank" rel="noopener" aria-label="YouTube">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M22.54 6.42a2.78 2.78 0 00-1.94-1.96C18.88 4 12 4 12 4s-6.88 0-8.6.46A2.78 2.78 0 001.46 6.42 29 29 0 001 12a29 29 0 00.46 5.58 2.78 2.78 0 001.94 1.96C5.12 20 12 20 12 20s6.88 0 8.6-.46a2.78 2.78 0 001.94-1.96A29 29 0 0023 12a29 29 0 00-.46-5.58z"/><polygon points="9.75,15.02 15.5,12 9.75,8.98" fill="rgba(110,31,34,0.15)"/></svg>
                </a>
            </div>
        </div>

        <!-- Footer nav columns -->
        <div class="footer-col">
            <p class="footer-col__heading"><?php esc_html_e( 'Explore', 'dil' ); ?></p>
            <?php
            wp_nav_menu( [
                'theme_location' => 'footer-1',
                'container'      => false,
                'depth'          => 1,
                'fallback_cb'    => function() {
                    echo '<ul>
                        <li><a href="' . esc_url( home_url('/the-diving/') ) . '">' . esc_html__('The Diving', 'dil') . '</a></li>
                        <li><a href="' . esc_url( home_url('/the-resort/') ) . '">' . esc_html__('The Resort', 'dil') . '</a></li>
                        <li><a href="' . esc_url( home_url('/galleries/') ) . '">' . esc_html__('Galleries', 'dil') . '</a></li>
                        <li><a href="' . esc_url( home_url('/info/') ) . '">' . esc_html__('Info', 'dil') . '</a></li>
                    </ul>';
                },
            ] );
            ?>
        </div>

        <div class="footer-col">
            <p class="footer-col__heading"><?php esc_html_e( 'Plan Your Trip', 'dil' ); ?></p>
            <?php
            wp_nav_menu( [
                'theme_location' => 'footer-2',
                'container'      => false,
                'depth'          => 1,
                'fallback_cb'    => function() {
                    echo '<ul>
                        <li><a href="' . esc_url( home_url('/info/rates/') ) . '">' . esc_html__('Rates &amp; Packages', 'dil') . '</a></li>
                        <li><a href="' . esc_url( home_url('/info/getting-here/') ) . '">' . esc_html__('Getting Here', 'dil') . '</a></li>
                        <li><a href="' . esc_url( home_url('/info/') ) . '">' . esc_html__('FAQs', 'dil') . '</a></li>
                        <li><a href="' . esc_url( home_url('/contact/') ) . '">' . esc_html__('Contact', 'dil') . '</a></li>
                    </ul>';
                },
            ] );
            ?>
        </div>

        <div class="footer-col">
            <p class="footer-col__heading"><?php esc_html_e( 'Connect', 'dil' ); ?></p>
            <?php
            wp_nav_menu( [
                'theme_location' => 'footer-3',
                'container'      => false,
                'depth'          => 1,
                'fallback_cb'    => function() {
                    echo '<ul>
                        <li><a href="mailto:info@diveintolembeh.com">info@diveintolembeh.com</a></li>
                        <li><a href="https://www.facebook.com/diveintolembeh" target="_blank" rel="noopener">' . esc_html__('Facebook', 'dil') . '</a></li>
                        <li><a href="https://www.instagram.com/diveintolembeh" target="_blank" rel="noopener">' . esc_html__('Instagram', 'dil') . '</a></li>
                        <li><a href="https://www.youtube.com/@diveintolembeh" target="_blank" rel="noopener">' . esc_html__('YouTube', 'dil') . '</a></li>
                    </ul>';
                },
            ] );
            ?>
        </div>

    </div><!-- .footer-grid -->

    <div class="footer-bottom">
        <p>
            <?php
            printf(
                /* translators: %1$s = current year, %2$s = site name */
                esc_html__( '&copy; %1$s %2$s &mdash; All rights reserved', 'dil' ),
                esc_html( date( 'Y' ) ),
                esc_html( get_bloginfo( 'name' ) )
            );
            ?>
        </p>
        <p class="mono">
            01&deg;&nbsp;39'&nbsp;26"&nbsp;N&nbsp;&nbsp;
            125&deg;&nbsp;14'&nbsp;52"&nbsp;E
        </p>
    </div>

</footer><!-- .site-footer -->

<!-- Global lightbox (must be before wp_footer so main.js can find it by ID) -->
<div class="lightbox" id="dil-lightbox" role="dialog" aria-modal="true" aria-label="<?php esc_attr_e( 'Photo lightbox', 'dil' ); ?>" hidden>
    <button class="lightbox__close" id="lightbox-close" aria-label="<?php esc_attr_e( 'Close', 'dil' ); ?>">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true">
            <line x1="4" y1="4" x2="20" y2="20"/><line x1="20" y1="4" x2="4" y2="20"/>
        </svg>
    </button>
    <button class="lightbox__prev" id="lightbox-prev" aria-label="<?php esc_attr_e( 'Previous photo', 'dil' ); ?>">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true">
            <polyline points="15 18 9 12 15 6"/>
        </svg>
    </button>
    <div class="lightbox__stage">
        <img class="lightbox__img" id="lightbox-img" src="" alt="">
        <div class="lightbox__caption" id="lightbox-caption"></div>
    </div>
    <button class="lightbox__next" id="lightbox-next" aria-label="<?php esc_attr_e( 'Next photo', 'dil' ); ?>">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true">
            <polyline points="9 18 15 12 9 6"/>
        </svg>
    </button>
</div>

<?php wp_footer(); ?>
</body>
</html>
