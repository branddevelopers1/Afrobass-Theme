<?php
/**
 * Front Page
 *
 * The static front page now just reuses the shared homepage template part,
 * so the exact same layout can be assigned to other pages via
 * "template-homepage.php" (Template Name: Afrobass Homepage Layout).
 *
 * @package Afrobass
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

get_header();

get_template_part( 'template-parts/homepage-content' );

get_footer();
