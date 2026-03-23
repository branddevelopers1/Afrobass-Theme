<?php
$phone    = ab_setting('ab_phone')    ?: '416.846.6483';
$email    = ab_setting('ab_email')    ?: 'contact@afrobass.com';
$ig       = ab_setting('ab_instagram') ?: 'https://instagram.com/afrobass.ca';
$yt       = ab_setting('ab_youtube')   ?: 'https://www.youtube.com/@Afrobass';
$tt       = ab_setting('ab_tiktok')    ?: 'https://www.tiktok.com/@afrobass';
$fb       = ab_setting('ab_facebook')  ?: 'https://facebook.com/afrobass.ca';
$tw       = ab_setting('ab_twitter')   ?: 'https://x.com/afrobassca';
$desc     = ab_setting('ab_footer_desc') ?: "Toronto's leading Afrobeats event production company. Bringing Africa to the world through unforgettable live experiences since 2018.";

$socials = [
    'instagram' => [
        'url' => $ig,
        'label' => 'Instagram',
        'svg' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="20" height="20" rx="5"/><circle cx="12" cy="12" r="4"/><circle cx="17.5" cy="6.5" r="0.5" fill="currentColor" stroke="none"/></svg>'
    ],
    'youtube' => [
        'url' => $yt,
        'label' => 'YouTube',
        'svg' => '<svg viewBox="0 0 24 24" fill="currentColor"><path d="M23 7s-.3-2-1.2-2.8c-1.1-1.2-2.4-1.2-3-1.3C16.2 2.8 12 2.8 12 2.8s-4.2 0-6.8.2c-.6.1-1.9.1-3 1.3C1.3 5 1 7 1 7S.7 9.1.7 11.3v2c0 2.1.3 4.3.3 4.3s.3 2 1.2 2.8c1.1 1.2 2.6 1.1 3.3 1.2C7.6 21.8 12 21.8 12 21.8s4.2 0 6.8-.3c.6-.1 1.9-.1 3-1.3.9-.8 1.2-2.8 1.2-2.8s.3-2.1.3-4.3v-2C23.3 9.1 23 7 23 7zM9.7 15.5v-7.4l8.1 3.7-8.1 3.7z"/></svg>'
    ],
    'tiktok' => [
        'url' => $tt,
        'label' => 'TikTok',
        'svg' => '<svg viewBox="0 0 24 24" fill="currentColor"><path d="M19.59 6.69a4.83 4.83 0 01-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 01-2.88 2.5 2.89 2.89 0 01-2.89-2.89 2.89 2.89 0 012.89-2.89c.28 0 .54.04.79.1V9.01a6.33 6.33 0 00-.79-.05 6.34 6.34 0 00-6.34 6.34 6.34 6.34 0 006.34 6.34 6.34 6.34 0 006.33-6.34V9.02a8.16 8.16 0 004.77 1.52V7.1a4.85 4.85 0 01-1-.41z"/></svg>'
    ],
    'facebook' => [
        'url' => $fb,
        'label' => 'Facebook',
        'svg' => '<svg viewBox="0 0 24 24" fill="currentColor"><path d="M24 12.07C24 5.41 18.63 0 12 0S0 5.41 0 12.07C0 18.1 4.39 23.1 10.13 24v-8.44H7.08v-3.49h3.04V9.41c0-3.02 1.8-4.7 4.54-4.7 1.31 0 2.68.24 2.68.24v2.97h-1.5c-1.5 0-1.96.93-1.96 1.89v2.26h3.32l-.53 3.49h-2.79V24C19.61 23.1 24 18.1 24 12.07z"/></svg>'
    ],
    'x' => [
        'url' => $tw,
        'label' => 'X',
        'svg' => '<svg viewBox="0 0 24 24" fill="currentColor"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-4.714-6.231-5.401 6.231H2.744l7.736-8.849L2 2.25h6.946l4.26 5.632L18.244 2.25zm-1.161 17.52h1.833L7.084 4.126H5.117L17.083 19.77z"/></svg>'
    ],
];
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
      <a href="<?php echo esc_url(home_url('/book-talent')); ?>">Talent Booking</a>
      <a href="<?php echo esc_url(home_url('/contact')); ?>">Invest / Sponsorship</a>
      <a href="<?php echo esc_url(home_url('/contact')); ?>">Brand Partnerships</a>
      <a href="<?php echo esc_url(home_url('/contact')); ?>">Press & Media</a>
    </div>

  </div>

  <div class="ab-footer-bottom">
    <span class="ab-footer-copy">
      &copy; <?php echo date('Y'); ?> Afrobass Inc. All Rights Reserved.
    </span>
    <nav class="ab-footer-social" aria-label="Social media">
      <?php foreach ($socials as $key => $s): ?>
        <a href="<?php echo esc_url($s['url']); ?>"
           class="ab-social-icon-link"
           target="_blank" rel="noopener"
           aria-label="<?php echo esc_attr($s['label']); ?>"
           title="<?php echo esc_attr($s['label']); ?>">
          <?php echo $s['svg']; ?>
        </a>
      <?php endforeach; ?>
    </nav>
  </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
