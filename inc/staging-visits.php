<?php
/**
 * Staging visitor log — shows whether the owners are actually looking at the
 * staging site. STAGING ONLY: does nothing on the live domain.
 *
 * How it works:
 *  - Pages are mostly served from SiteGround's cache, where PHP never runs, so
 *    each page sends a small background "viewed" beacon to admin-ajax (never cached).
 *  - Not counted: logged-in WordPress users, bots, and any browser that has
 *    opened the ignore link once:  https://new.diveintolembeh.com/?dil-ignore-me
 *    (?dil-count-me undoes it on that browser).
 *  - No IP addresses are stored — only a salted hash, so visitors can be told
 *    apart but not identified. Country comes from Cloudflare's CF-IPCountry header.
 *  - Report: WP Admin → Tools → Staging visitors.
 *
 * To remove before launch: delete this file and its require line in functions.php
 * (and the wp_dil_visits table, via the button on the report page).
 */

if ( ! defined( 'ABSPATH' ) ) exit;

/** True on the staging site (and the local copy, for testing) — never on the live site. */
function dil_is_staging(): bool {
    $host = (string) wp_parse_url( home_url(), PHP_URL_HOST );
    return in_array( $host, [ 'new.diveintolembeh.com', 'diveintolembeh.local' ], true );
}

if ( ! dil_is_staging() ) return;

function dil_visits_table(): string {
    global $wpdb;
    return $wpdb->prefix . 'dil_visits';
}

/* ── Table ──────────────────────────────────────────────────── */

function dil_visits_install(): void {
    $version = '1';   // bump to re-run dbDelta after changing the table
    if ( get_option( 'dil_visits_db' ) === $version ) return;
    global $wpdb;
    require_once ABSPATH . 'wp-admin/includes/upgrade.php';
    dbDelta( 'CREATE TABLE ' . dil_visits_table() . " (
        id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
        ts DATETIME NOT NULL,
        visitor CHAR(10) NOT NULL,
        country CHAR(2) NOT NULL DEFAULT '',
        device VARCHAR(10) NOT NULL DEFAULT '',
        page VARCHAR(200) NOT NULL DEFAULT '',
        referrer VARCHAR(200) NOT NULL DEFAULT '',
        PRIMARY KEY  (id),
        KEY visitor (visitor),
        KEY ts (ts)
    ) " . $wpdb->get_charset_collate() . ';' );
    update_option( 'dil_visits_db', $version, false );
}
add_action( 'init', 'dil_visits_install' );

/* ── Beacon (front end) ─────────────────────────────────────── */

add_action( 'wp_footer', function () {
    if ( is_user_logged_in() ) return;   // logged-in pages aren't cached by SiteGround, so this check is reliable
    ?>
<script>
(function () {
  function note(msg) {   // small confirmation banner, gone after 5s
    var n = document.createElement('div'); n.textContent = msg;
    n.style.cssText = 'position:fixed;left:50%;bottom:24px;transform:translateX(-50%);z-index:9999;background:#6E1F22;color:#F5ECDC;padding:12px 18px;font:14px/1.4 sans-serif;border-radius:6px;box-shadow:0 6px 20px rgba(0,0,0,.3);max-width:90vw;text-align:center';
    document.body.appendChild(n); setTimeout(function () { n.remove(); }, 5000);
  }
  try {
    var q = location.search, KEY = 'dil-ignore-me';
    if (/[?&]dil-ignore-me\b/.test(q)) { localStorage.setItem(KEY, '1'); note('✓ This browser will no longer be counted in the staging visitor log.'); }
    if (/[?&]dil-count-me\b/.test(q))  { localStorage.removeItem(KEY);   note('This browser will be counted in the staging visitor log again.'); }
    if (localStorage.getItem(KEY) === '1') return;
  } catch (e) {}
  if (document.body.classList.contains('logged-in')) return;   // cached page viewed by someone now logged in
  if (/bot|crawl|spider|slurp|preview|headless|lighthouse/i.test(navigator.userAgent)) return;
  var d = new FormData();
  d.append('action', 'dil_visit');
  d.append('page', location.pathname);
  d.append('ref', document.referrer && document.referrer.indexOf(location.host) === -1 ? document.referrer : '');
  var url = <?php echo wp_json_encode( admin_url( 'admin-ajax.php' ) ); ?>;
  if (navigator.sendBeacon) navigator.sendBeacon(url, d); else fetch(url, { method: 'POST', body: d, keepalive: true });
})();
</script>
    <?php
}, 99 );

/* ── Record a visit ─────────────────────────────────────────── */

function dil_record_visit(): void {
    // No nonce: pages sit in the cache far longer than a nonce lives. Inputs are
    // length-capped and sanitised; worst case someone pads a staging counter.
    if ( is_user_logged_in() ) wp_die( '', '', [ 'response' => 204 ] );

    $ua = substr( (string) ( $_SERVER['HTTP_USER_AGENT'] ?? '' ), 0, 400 );
    if ( $ua === '' || preg_match( '/bot|crawl|spider|slurp|preview|headless|lighthouse|curl|python|wget/i', $ua ) ) {
        wp_die( '', '', [ 'response' => 204 ] );
    }

    $ip      = (string) ( $_SERVER['HTTP_CF_CONNECTING_IP'] ?? $_SERVER['REMOTE_ADDR'] ?? '' );
    $visitor = substr( hash_hmac( 'sha256', $ip . '|' . $ua, wp_salt( 'auth' ) ), 0, 10 );
    $country = strtoupper( substr( preg_replace( '/[^A-Za-z]/', '', (string) ( $_SERVER['HTTP_CF_IPCOUNTRY'] ?? '' ) ), 0, 2 ) );
    $device  = preg_match( '/iPad|Tablet/i', $ua ) ? 'tablet' : ( preg_match( '/Mobi|Android|iPhone/i', $ua ) ? 'phone' : 'computer' );
    $page    = substr( sanitize_text_field( wp_unslash( $_POST['page'] ?? '' ) ), 0, 200 );
    $ref     = substr( esc_url_raw( wp_unslash( $_POST['ref'] ?? '' ) ), 0, 200 );

    global $wpdb;
    $wpdb->insert( dil_visits_table(), [
        'ts'       => current_time( 'mysql', true ),
        'visitor'  => $visitor,
        'country'  => $country,
        'device'   => $device,
        'page'     => $page ?: '/',
        'referrer' => $ref,
    ] );
    wp_die( '', '', [ 'response' => 204 ] );
}
add_action( 'wp_ajax_nopriv_dil_visit', 'dil_record_visit' );
add_action( 'wp_ajax_dil_visit', 'dil_record_visit' );

/* ── Report: Tools → Staging visitors ───────────────────────── */

add_action( 'admin_menu', function () {
    add_management_page( 'Staging visitors', 'Staging visitors', 'manage_options', 'dil-staging-visitors', 'dil_visits_report' );
} );

function dil_visits_report(): void {
    if ( ! current_user_can( 'manage_options' ) ) return;
    global $wpdb;
    $table = dil_visits_table();

    if ( isset( $_POST['dil_visits_clear'] ) && check_admin_referer( 'dil_visits_clear' ) ) {
        $wpdb->query( "TRUNCATE TABLE {$table}" ); // phpcs:ignore -- table name is ours
        echo '<div class="notice notice-success"><p>Visitor log cleared.</p></div>';
    }

    $visitors = $wpdb->get_results( "
        SELECT visitor, MAX(country) AS country, MAX(device) AS device,
               MIN(ts) AS first_ts, MAX(ts) AS last_ts, COUNT(*) AS views,
               COUNT(DISTINCT page) AS pages,
               GROUP_CONCAT(DISTINCT page ORDER BY page SEPARATOR '  ·  ') AS page_list,
               MAX(referrer) AS referrer
        FROM {$table} GROUP BY visitor ORDER BY last_ts DESC LIMIT 200" ); // phpcs:ignore

    $since = gmdate( 'Y-m-d H:i:s', time() - 7 * DAY_IN_SECONDS );
    $week  = (int) $wpdb->get_var( $wpdb->prepare( "SELECT COUNT(DISTINCT visitor) FROM {$table} WHERE ts >= %s", $since ) ); // phpcs:ignore
    $tz    = new DateTimeZone( 'Australia/Melbourne' );   // Kaj reads this report — his time, not the site's
    $when  = fn( $ts ) => wp_date( 'D j M, g:ia', strtotime( $ts . ' UTC' ), $tz );
    $ignore = add_query_arg( 'dil-ignore-me', '', home_url( '/' ) );
    ?>
    <div class="wrap">
        <h1>Staging visitors</h1>
        <p>People who have looked at the staging site, <strong>not counting</strong> logged-in WordPress users, bots,
           or browsers that have opened the ignore link. Times are Melbourne time.</p>
        <p><strong>Don't count one of your devices:</strong> open this link once on that phone or browser —
           <code><?php echo esc_html( $ignore ); ?></code><br>
           <span class="description">It's remembered in that browser until its site data is cleared. <code>?dil-count-me</code> undoes it.</span></p>

        <h2><?php echo (int) count( $visitors ); ?> visitors in total &nbsp;·&nbsp; <?php echo $week; ?> in the last 7 days</h2>

        <?php if ( ! $visitors ) : ?>
            <p><em>No visits yet.</em></p>
        <?php else : ?>
        <table class="widefat striped">
            <thead><tr>
                <th>Visitor</th><th>Country</th><th>Device</th><th>First visit</th><th>Last visit</th>
                <th>Page views</th><th>Pages looked at</th><th>Came from</th>
            </tr></thead>
            <tbody>
            <?php foreach ( $visitors as $i => $v ) : ?>
                <tr>
                    <td>#<?php echo (int) ( count( $visitors ) - $i ); ?> <code style="opacity:.6"><?php echo esc_html( $v->visitor ); ?></code></td>
                    <td><?php echo esc_html( $v->country ?: '?' ); ?></td>
                    <td><?php echo esc_html( $v->device ); ?></td>
                    <td><?php echo esc_html( $when( $v->first_ts ) ); ?></td>
                    <td><?php echo esc_html( $when( $v->last_ts ) ); ?></td>
                    <td><?php echo (int) $v->views; ?></td>
                    <td style="max-width:420px"><?php echo esc_html( $v->page_list ); ?></td>
                    <td><?php echo esc_html( $v->referrer ? wp_parse_url( $v->referrer, PHP_URL_HOST ) : '—' ); ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <?php endif; ?>

        <form method="post" style="margin-top:24px" onsubmit="return confirm('Clear the whole visitor log?');">
            <?php wp_nonce_field( 'dil_visits_clear' ); ?>
            <button class="button" name="dil_visits_clear" value="1">Clear the log</button>
        </form>
    </div>
    <?php
}
