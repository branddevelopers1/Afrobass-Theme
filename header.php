<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="theme-color" content="#080808">
<?php wp_head(); ?>

<!-- Showpass SDK -->
<script type="text/javascript">
(function(window, document, src) {
  var config = window.__shwps;
  if (typeof config === 'undefined') {
    config = function() { config.c(arguments); };
    config.q = [];
    config.c = function(args) { config.q.push(args); };
    window.__shwps = config;
    var s = document.createElement('script');
    s.type = 'text/javascript';
    s.async = true;
    s.src = src;
    var x = document.getElementsByTagName('script')[0];
    x.parentNode.insertBefore(s, x);
  }
})(window, document, 'https://www.showpass.com/static/dist/sdk.js');
</script>
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
  <div style="display:flex;gap:8px;margin-top:32px;">
    <?php
    $mob_socials = [
      ['url'=>ab_setting('ab_instagram')?:'https://instagram.com/afrobass.ca','label'=>'Instagram','svg'=>'<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="20" height="20" rx="5"/><circle cx="12" cy="12" r="4"/><circle cx="17.5" cy="6.5" r="0.5" fill="currentColor" stroke="none"/></svg>'],
      ['url'=>ab_setting('ab_youtube')?:'https://www.youtube.com/@Afrobass','label'=>'YouTube','svg'=>'<svg viewBox="0 0 24 24" fill="currentColor"><path d="M23 7s-.3-2-1.2-2.8c-1.1-1.2-2.4-1.2-3-1.3C16.2 2.8 12 2.8 12 2.8s-4.2 0-6.8.2c-.6.1-1.9.1-3 1.3C1.3 5 1 7 1 7S.7 9.1.7 11.3v2c0 2.1.3 4.3.3 4.3s.3 2 1.2 2.8c1.1 1.2 2.6 1.1 3.3 1.2C7.6 21.8 12 21.8 12 21.8s4.2 0 6.8-.3c.6-.1 1.9-.1 3-1.3.9-.8 1.2-2.8 1.2-2.8s.3-2.1.3-4.3v-2C23.3 9.1 23 7 23 7zM9.7 15.5v-7.4l8.1 3.7-8.1 3.7z"/></svg>'],
      ['url'=>ab_setting('ab_tiktok')?:'https://www.tiktok.com/@afrobass','label'=>'TikTok','svg'=>'<svg viewBox="0 0 24 24" fill="currentColor"><path d="M19.59 6.69a4.83 4.83 0 01-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 01-2.88 2.5 2.89 2.89 0 01-2.89-2.89 2.89 2.89 0 012.89-2.89c.28 0 .54.04.79.1V9.01a6.33 6.33 0 00-.79-.05 6.34 6.34 0 00-6.34 6.34 6.34 6.34 0 006.34 6.34 6.34 6.34 0 006.33-6.34V9.02a8.16 8.16 0 004.77 1.52V7.1a4.85 4.85 0 01-1-.41z"/></svg>'],
      ['url'=>ab_setting('ab_facebook')?:'https://facebook.com/afrobass.ca','label'=>'Facebook','svg'=>'<svg viewBox="0 0 24 24" fill="currentColor"><path d="M24 12.07C24 5.41 18.63 0 12 0S0 5.41 0 12.07C0 18.1 4.39 23.1 10.13 24v-8.44H7.08v-3.49h3.04V9.41c0-3.02 1.8-4.7 4.54-4.7 1.31 0 2.68.24 2.68.24v2.97h-1.5c-1.5 0-1.96.93-1.96 1.89v2.26h3.32l-.53 3.49h-2.79V24C19.61 23.1 24 18.1 24 12.07z"/></svg>'],
      ['url'=>ab_setting('ab_twitter')?:'https://x.com/afrobassca','label'=>'X','svg'=>'<svg viewBox="0 0 24 24" fill="currentColor"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-4.714-6.231-5.401 6.231H2.744l7.736-8.849L2 2.25h6.946l4.26 5.632L18.244 2.25zm-1.161 17.52h1.833L7.084 4.126H5.117L17.083 19.77z"/></svg>'],
    ];
    foreach($mob_socials as $s): ?>
      <a href="<?php echo esc_url($s['url']); ?>" class="ab-social-icon-link" target="_blank" rel="noopener" aria-label="<?php echo esc_attr($s['label']); ?>"><?php echo $s['svg']; ?></a>
    <?php endforeach; ?>
  </div>
</div>
