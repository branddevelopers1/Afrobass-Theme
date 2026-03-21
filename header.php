<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="theme-color" content="#080808">
<?php wp_head(); ?>
</head>
<body <?php body_class('ab-site'); ?>>
<?php wp_body_open(); ?>

<!-- Custom Cursor -->
<div id="ab-cursor"></div>
<div id="ab-cursor-ring"></div>

<!-- Page Loader (homepage only) -->
<?php if (is_front_page()): ?>
<div id="ab-loader" aria-hidden="true">
  <div id="ab-loader-logo">AFRO<span>BASS</span></div>
  <div id="ab-loader-bar-wrap"><div id="ab-loader-bar"></div></div>
  <div id="ab-loader-text">Loading</div>
</div>
<?php endif; ?>

<!-- Navigation -->
<nav id="ab-nav" role="navigation" aria-label="Main navigation">
  <a href="<?php echo esc_url(home_url('/')); ?>" class="ab-nav-logo" aria-label="Afrobass Home">
    AFRO<span class="ab-dot">·</span>BASS
  </a>

  <ul class="ab-nav-links">
    <li><a href="<?php echo esc_url(home_url('/events')); ?>">Events</a></li>
    <li><a href="<?php echo esc_url(home_url('/tours')); ?>">Tours</a></li>
    <li><a href="<?php echo esc_url(home_url('/about')); ?>">Our Story</a></li>
    <li><a href="<?php echo esc_url(home_url('/book-talent')); ?>">Book Talent</a></li>
    <li><a href="<?php echo esc_url(home_url('/contact')); ?>">Contact</a></li>
  </ul>

  <div class="ab-nav-right">
    <a href="<?php echo esc_url(home_url('/events')); ?>" class="ab-btn-outline-sm">Buy Tickets</a>
    <a href="<?php echo esc_url(home_url('/book-talent')); ?>" class="ab-btn-fill-sm">Book Talent</a>
  </div>

  <button class="ab-hamburger" aria-label="Toggle menu" aria-expanded="false">
    <span></span><span></span><span></span>
  </button>
</nav>

<!-- Mobile Nav -->
<div id="ab-mobile-nav" role="navigation" aria-label="Mobile navigation">
  <a href="<?php echo esc_url(home_url('/events')); ?>" class="ab-mobile-link">Events</a>
  <a href="<?php echo esc_url(home_url('/tours')); ?>" class="ab-mobile-link">Tours</a>
  <a href="<?php echo esc_url(home_url('/about')); ?>" class="ab-mobile-link">Our Story</a>
  <a href="<?php echo esc_url(home_url('/contact')); ?>" class="ab-mobile-link">Contact</a>
  <div class="ab-mobile-cta">
    <a href="<?php echo esc_url(home_url('/book-talent')); ?>" class="ab-btn-fill-sm">Book Talent</a>
    <a href="<?php echo esc_url(home_url('/events')); ?>" class="ab-btn-outline-sm">Buy Tickets</a>
  </div>
  <div style="margin-top:40px;">
    <div style="font-family:'Barlow Condensed',sans-serif;font-size:11px;letter-spacing:3px;text-transform:uppercase;color:rgba(255,255,255,0.25);margin-bottom:12px;">Get in Touch</div>
    <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9]/', '', ab_setting('ab_phone'))); ?>" style="display:block;font-size:22px;font-family:'Bebas Neue',sans-serif;letter-spacing:2px;color:#fff;margin-bottom:8px;"><?php echo esc_html(ab_setting('ab_phone') ?: '416.846.6483'); ?></a>
    <a href="mailto:<?php echo esc_attr(ab_setting('ab_email') ?: 'contact@afrobass.com'); ?>" style="font-size:14px;color:#FF4500;"><?php echo esc_html(ab_setting('ab_email') ?: 'contact@afrobass.com'); ?></a>
  </div>
</div>
