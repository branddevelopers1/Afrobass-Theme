<?php
/**
 * Template Name: Afrobass Homepage Layout
 *
 * A reusable page template built from the original front-page design.
 * Assign it to ANY page via the editor: Page → Template → "Afrobass Homepage Layout".
 * All content is driven by that page's ACF fields, so each page can have its own
 * hero text, videos, story, milestones, etc.
 *
 * @package Afrobass
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

get_header();

get_template_part( 'template-parts/homepage-content' );

get_footer();
