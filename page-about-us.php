<?php
/**
 * Template: About / Our Story page
 * Set this as the template for your "About" page in WP admin → Page Attributes
 */
?>
<?php get_header(); ?>

<?php
$story_video = get_field('ab_story_video');
$story_body  = get_field('ab_story_body') ?: '';
$milestones  = get_field('ab_milestones') ?: [];
?>

<section class="ab-story-section" style="min-height:100vh;">
  <div class="ab-story-video-side">
    <div class="ab-story-video-inner">
      <?php if (!empty($story_video['url'])): ?>
        <video autoplay muted loop playsinline>
          <source src="<?php echo esc_url($story_video['url']); ?>" type="video/mp4">
        </video>
      <?php endif; ?>
      <div class="ab-story-video-fallback"></div>
    </div>
    <div class="ab-story-video-overlay"></div>
    <div class="ab-story-video-ui">
      <div class="ab-story-play"><div class="ab-play-tri"></div></div>
      <span class="ab-story-play-label">Watch Our Story</span>
    </div>
  </div>

  <div class="ab-story-content" style="padding-top:160px;">
    <div class="ab-story-watermark" aria-hidden="true">2018</div>
    <div class="ab-section-kicker ab-reveal">Our Story</div>
    <div class="ab-section-title ab-reveal">Built on<br>Culture &<br>Community</div>
    <div class="ab-story-body ab-reveal">
      <?php if ($story_body): echo wp_kses_post($story_body);
      else: ?>
        What started as a <strong>shared passion for Afrobeats</strong> in 2018 has grown into Canada's most trusted Afrobeats production company. We've toured artists coast to coast, sold out venues from 500 to 2,300 people, and built a community of fans who show up every single time.
        <br><br>
        The Afrobass team built this from the ground up — with nothing but hustle, deep roots in the music, and a shared vision: <strong>bring the world-class sound of African music to every major city in Canada.</strong>
        <br><br>
        Since 2018, Afrobass has worked with DJ Ecool (Davido's official DJ), DJ Tunez (Wizkid's DJ), Afro B, Blaqbonez, WSTRN, Oxlade, Ayra Starr, Teni the Entertainer, Falz the Bad Guy, and many more — executing national tours across Canada and sold-out shows from coast to coast.
      <?php endif; ?>
    </div>
    <?php if (!empty($milestones)): ?>
      <div class="ab-milestones ab-reveal">
        <?php foreach ($milestones as $ms): ?>
          <div class="ab-milestone">
            <div class="ab-milestone-year"><?php echo esc_html($ms['year']); ?></div>
            <div class="ab-milestone-text"><?php echo wp_kses_post($ms['text']); ?></div>
          </div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </div>
</section>

<!-- Services Preview -->
<section class="ab-services-section" id="services">
  <div class="ab-services-header">
    <div class="ab-reveal">
      <div class="ab-section-kicker">What We Do</div>
      <div class="ab-section-title">Full-Service<br>Live Entertainment</div>
    </div>
  </div>
  <div class="ab-services-grid">
    <?php
    $svcs = [
      ['01','Concert Production','End-to-end production for sold-out shows. Staging, sound, promotion, and flawless execution.'],
      ['02','Artist Tours','National multi-city tours with full routing, marketing strategy, venue sourcing, and management.'],
      ['03','Talent Booking','Direct relationships with Africa\'s biggest artists. We make the connection — and bring them to Canada.'],
      ['04','Brand Partnerships','Custom sponsorship and activation packages that place your brand inside the culture.'],
    ];
    foreach ($svcs as $i => $s): ?>
      <div class="ab-svc-card ab-reveal ab-delay-<?php echo $i; ?>">
        <div class="ab-svc-num"><?php echo esc_html($s[0]); ?></div>
        <div class="ab-svc-title"><?php echo esc_html($s[1]); ?></div>
        <div class="ab-svc-desc"><?php echo esc_html($s[2]); ?></div>
      </div>
    <?php endforeach; ?>
  </div>
</section>

<!-- CTA -->
<section class="ab-cta-section">
  <div class="ab-cta-bg"></div>
  <div class="ab-cta-left">
    <div class="ab-section-kicker ab-reveal">Work With Us</div>
    <h2 class="ab-cta-title ab-reveal">Let's Build<br>Something <span class="ab-accent">Legendary</span></h2>
    <div class="ab-cta-btns ab-reveal">
      <a href="<?php echo esc_url(home_url('/book-talent')); ?>" class="ab-btn-lg-fill">Book an Artist</a>
      <a href="<?php echo esc_url(home_url('/contact')); ?>" class="ab-btn-lg-outline">Get in Touch</a>
    </div>
  </div>
  <div class="ab-cta-right">
    <div class="ab-contact-label">Contact</div>
    <div class="ab-contact-phone"><?php echo esc_html(ab_setting('ab_phone') ?: '416.846.6483'); ?></div>
    <a href="mailto:<?php echo esc_attr(ab_setting('ab_email') ?: 'contact@afrobass.com'); ?>" class="ab-contact-email">
      <?php echo esc_html(ab_setting('ab_email') ?: 'contact@afrobass.com'); ?>
    </a>
  </div>
</section>

<?php get_footer(); ?>
