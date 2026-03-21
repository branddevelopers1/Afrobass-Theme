<?php
$phone    = ab_setting('ab_phone')    ?: '416.846.6483';
$email    = ab_setting('ab_email')    ?: 'contact@afrobass.com';
$ig       = ab_setting('ab_instagram');
$yt       = ab_setting('ab_youtube');
$tt       = ab_setting('ab_tiktok');
$fb       = ab_setting('ab_facebook');
$desc     = ab_setting('ab_footer_desc') ?: "Toronto's leading Afrobeats event production company. Bringing Africa to the world through unforgettable live experiences since 2018.";
?>

<footer class="ab-footer" role="contentinfo">
  <div class="ab-footer-top">

    <div>
      <div class="ab-footer-logo">AFRO<span>BASS</span></div>
      <div class="ab-footer-tagline">Canada's Premier Event Producer</div>
      <p class="ab-footer-desc"><?php echo esc_html($desc); ?></p>
    </div>

    <div class="ab-footer-col">
      <h4>Company</h4>
      <a href="<?php echo esc_url(home_url('/about')); ?>">Our Story</a>
      <a href="<?php echo esc_url(home_url('/#services')); ?>">What We Do</a>
      <a href="<?php echo esc_url(home_url('/book-talent')); ?>">Book Talent</a>
      <a href="<?php echo esc_url(home_url('/contact')); ?>">Press & Media</a>
    </div>

    <div class="ab-footer-col">
      <h4>Events</h4>
      <a href="<?php echo esc_url(home_url('/events')); ?>">Upcoming Events</a>
      <a href="<?php echo esc_url(home_url('/events?filter=past')); ?>">Past Events</a>
      <a href="<?php echo esc_url(home_url('/tours')); ?>">Tours</a>
      <a href="<?php echo esc_url(home_url('/#recaps')); ?>">Recaps</a>
    </div>

    <div class="ab-footer-col">
      <h4>Contact</h4>
      <a href="mailto:<?php echo esc_attr($email); ?>"><?php echo esc_html($email); ?></a>
      <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9]/', '', $phone)); ?>"><?php echo esc_html($phone); ?></a>
      <a href="<?php echo esc_url(home_url('/book-talent')); ?>">Talent Booking</a>
      <a href="<?php echo esc_url(home_url('/contact')); ?>">Sponsorship</a>
    </div>

  </div>

  <div class="ab-footer-bottom">
    <span class="ab-footer-copy">
      &copy; <?php echo date('Y'); ?> Test Afrobass Inc. All Rights Reserved.
    </span>
    <nav class="ab-footer-social" aria-label="Social media">
      <?php if ($ig): ?><a href="<?php echo esc_url($ig); ?>" class="ab-social-link" target="_blank" rel="noopener">Instagram</a><?php endif; ?>
      <?php if ($yt): ?><a href="<?php echo esc_url($yt); ?>" class="ab-social-link" target="_blank" rel="noopener">YouTube</a><?php endif; ?>
      <?php if ($tt): ?><a href="<?php echo esc_url($tt); ?>" class="ab-social-link" target="_blank" rel="noopener">TikTok</a><?php endif; ?>
      <?php if ($fb): ?><a href="<?php echo esc_url($fb); ?>" class="ab-social-link" target="_blank" rel="noopener">Facebook</a><?php endif; ?>
    </nav>
  </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
