<?php
/**
 * Front Page
 *
 * The site's front page is set (in Settings → Reading / Customizer) to the
 * Events page, so visitors land directly on ticket-buying. When that's the
 * case we render the Events layout here. If the front page is ever switched
 * to a different page, we fall back to the shared homepage content so the
 * original homepage design still works.
 *
 * The homepage design itself remains reachable as a normal page at
 * /home-page/ (which uses template-homepage.php).
 *
 * @package Afrobass
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

$front = get_queried_object();
$front_slug = ( $front && isset( $front->post_name ) ) ? $front->post_name : '';

if ( $front_slug === 'events' ) {
    // Render the Events page layout at the site root.
    $events_tpl = locate_template( 'page-events.php' );
    if ( $events_tpl ) {
        include $events_tpl;
        return;
    }
}

// Fallback: original homepage design.
get_header();
get_template_part( 'homepage-content' );
get_footer();
