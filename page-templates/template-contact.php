<?php
/**
 * Template Name: Contact
 *
 * Assign this template to the /contact/ page in WordPress.
 */

get_header();
require_once get_template_directory() . '/inc/inner-page.php';
?>

<?php dil_page_banner( [
    'kicker'   => __( 'Get in touch', 'dil' ),
    'title'    => __( 'Contact', 'dil' ),
    'subtitle' => __( 'We reply within 24 hours', 'dil' ),
    'no_photo' => true,
] ); ?>

<div class="contact-grid">

    <!-- Contact form -->
    <div class="contact-form-wrap" id="main-content" tabindex="-1">
        <h2 class="contact-form__title"><?php esc_html_e( 'Send us a message', 'dil' ); ?></h2>

        <form id="dil-contact-form" novalidate>
            <?php wp_nonce_field( 'dil_nonce', 'dil_form_nonce' ); ?>

            <div class="form-row" data-field="name">
                <label for="contact-name"><?php esc_html_e( 'Your name', 'dil' ); ?></label>
                <input type="text" id="contact-name" name="name"
                       autocomplete="name" required>
                <span class="form-error" aria-live="polite"></span>
            </div>

            <div class="form-row" data-field="email">
                <label for="contact-email"><?php esc_html_e( 'Email address', 'dil' ); ?></label>
                <input type="email" id="contact-email" name="email"
                       autocomplete="email" required>
                <span class="form-error" aria-live="polite"></span>
            </div>

            <div class="form-row">
                <label for="contact-arrival"><?php esc_html_e( 'Planned arrival date', 'dil' ); ?></label>
                <input type="date" id="contact-arrival" name="arrival"
                       placeholder="dd / mm / yyyy">
            </div>

            <div class="form-row">
                <label for="contact-nights"><?php esc_html_e( 'Number of nights', 'dil' ); ?></label>
                <select id="contact-nights" name="nights">
                    <option value=""><?php esc_html_e( 'Select…', 'dil' ); ?></option>
                    <?php foreach ( [ 4, 5, 7, 10, 14, 21 ] as $n ) : ?>
                        <option value="<?php echo esc_attr( $n ); ?>">
                            <?php echo esc_html( $n ); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-row">
                <label for="contact-interest"><?php esc_html_e( 'Main interest', 'dil' ); ?></label>
                <select id="contact-interest" name="interest">
                    <option value=""><?php esc_html_e( 'Select…', 'dil' ); ?></option>
                    <option value="macro-photography"><?php esc_html_e( 'Macro photography', 'dil' ); ?></option>
                    <option value="muck-diving"><?php esc_html_e( 'Muck diving', 'dil' ); ?></option>
                    <option value="wide-angle"><?php esc_html_e( 'Wide-angle / reef diving', 'dil' ); ?></option>
                    <option value="night-diving"><?php esc_html_e( 'Night diving', 'dil' ); ?></option>
                    <option value="non-diver"><?php esc_html_e( 'Non-diver / resort stay', 'dil' ); ?></option>
                    <option value="other"><?php esc_html_e( 'Other', 'dil' ); ?></option>
                </select>
            </div>

            <div class="form-row" data-field="message">
                <label for="contact-message"><?php esc_html_e( 'Message', 'dil' ); ?></label>
                <textarea id="contact-message" name="message" rows="5" required></textarea>
                <span class="form-error" aria-live="polite"></span>
            </div>

            <button type="submit" class="contact-form__submit">
                <?php esc_html_e( 'Send message', 'dil' ); ?>
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                    <path d="M5 12h14M12 5l7 7-7 7"/>
                </svg>
            </button>
        </form>

        <div class="form-success" id="form-success" role="status" aria-live="polite">
            <div class="form-success__title"><?php esc_html_e( 'Message sent', 'dil' ); ?></div>
            <p><?php esc_html_e( "Thank you — we'll reply within 24 hours.", 'dil' ); ?></p>
        </div>
    </div>

    <!-- Contact info -->
    <div class="contact-info-wrap">
        <div class="contact-cards">

            <div class="contact-card">
                <div class="contact-card__label"><?php esc_html_e( 'Email', 'dil' ); ?></div>
                <div class="contact-card__value">
                    <a href="mailto:info@diveintolembeh.com">info@diveintolembeh.com</a>
                </div>
                <div class="contact-card__note"><?php esc_html_e( 'Fastest response', 'dil' ); ?></div>
            </div>

            <div class="contact-card">
                <div class="contact-card__label"><?php esc_html_e( 'Postal address', 'dil' ); ?></div>
                <div class="contact-card__value">Dive Into Lembeh</div>
                <div class="contact-card__note">
                    PT. Pantai Kasawari Indah<br>
                    Kel. Kasawari, Kec. Aertembaga<br>
                    Bitung, North Sulawesi 95528<br>
                    Indonesia
                </div>
            </div>

            <div class="contact-card">
                <div class="contact-card__label"><?php esc_html_e( 'Phone &amp; WhatsApp', 'dil' ); ?></div>
                <div class="contact-card__value">
                    <a href="tel:+62811430660">+62 811 430 660</a>
                </div>
                <div class="contact-card__note"><?php esc_html_e( 'WhatsApp preferred', 'dil' ); ?></div>
            </div>

            <div class="contact-card contact-card--dark">
                <div class="contact-card__label"><?php esc_html_e( 'Reply policy', 'dil' ); ?></div>
                <div class="contact-card__value"><?php esc_html_e( '24-hour response', 'dil' ); ?></div>
                <div class="contact-card__note">
                    <?php esc_html_e( 'We\'re in UTC+8. If you send after 6pm local time, you\'ll hear from us the next morning.', 'dil' ); ?>
                </div>
            </div>

        </div><!-- .contact-cards -->
    </div>

</div><!-- .contact-grid -->

<?php get_footer(); ?>
