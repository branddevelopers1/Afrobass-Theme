<?php get_header(); ?>

<?php
$phone = ab_setting('ab_phone') ?: '416.846.6483';
$email = ab_setting('ab_email') ?: 'contact@afrobass.com';
?>

<div class="ab-page-hero">
  <div class="ab-page-hero-content">
    <div class="ab-section-kicker ab-reveal">Afrobass Inc.</div>
    <h1 class="ab-page-title ab-reveal">Get in<br>Touch</h1>
    <p class="ab-page-subtitle ab-reveal">For talent booking, sponsorship opportunities, media enquiries, and general questions.</p>
  </div>
</div>

<section class="ab-contact-section">
  <div class="ab-contact-grid">

    <!-- Contact Info -->
    <div>
      <div class="ab-section-kicker ab-reveal" style="margin-bottom:40px;">Contact Details</div>
      <div class="ab-contact-info-item ab-reveal">
        <div class="ab-contact-info-label">Phone</div>
        <div class="ab-contact-info-val">
          <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9]/','',$phone)); ?>"><?php echo esc_html($phone); ?></a>
        </div>
      </div>
      <div class="ab-contact-info-item ab-reveal ab-delay-1">
        <div class="ab-contact-info-label">Email</div>
        <div class="ab-contact-info-val">
          <a href="mailto:<?php echo esc_attr($email); ?>"><?php echo esc_html($email); ?></a>
        </div>
      </div>
      <div class="ab-contact-info-item ab-reveal ab-delay-2">
        <div class="ab-contact-info-label">Based In</div>
        <div class="ab-contact-info-val">Toronto, Ontario, Canada</div>
      </div>
      <div class="ab-contact-info-item ab-reveal ab-delay-3">
        <div class="ab-contact-info-label">Serving</div>
        <div class="ab-contact-info-val">All of Canada</div>
      </div>

      <?php
      $ig = ab_setting('ab_instagram');
      $yt = ab_setting('ab_youtube');
      $tt = ab_setting('ab_tiktok');
      if ($ig || $yt || $tt):
      ?>
      <div class="ab-contact-info-item ab-reveal" style="margin-top:40px;">
        <div class="ab-contact-info-label">Follow Us</div>
        <div style="display:flex;gap:20px;margin-top:12px;">
          <?php if ($ig): ?><a href="<?php echo esc_url($ig); ?>" class="ab-social-link" target="_blank" rel="noopener">Instagram</a><?php endif; ?>
          <?php if ($yt): ?><a href="<?php echo esc_url($yt); ?>" class="ab-social-link" target="_blank" rel="noopener">YouTube</a><?php endif; ?>
          <?php if ($tt): ?><a href="<?php echo esc_url($tt); ?>" class="ab-social-link" target="_blank" rel="noopener">TikTok</a><?php endif; ?>
        </div>
      </div>
      <?php endif; ?>
    </div>

    <!-- Contact Form -->
    <div>
      <div class="ab-section-kicker ab-reveal" style="margin-bottom:40px;">Send a Message</div>
      <form id="ab-booking-form" novalidate class="ab-reveal">
        <div class="ab-form-row">
          <div class="ab-form-group">
            <label class="ab-form-label" for="c_first">First Name</label>
            <input type="text" id="c_first" name="first_name" class="ab-form-input" placeholder="First name" required>
          </div>
          <div class="ab-form-group">
            <label class="ab-form-label" for="c_last">Last Name</label>
            <input type="text" id="c_last" name="last_name" class="ab-form-input" placeholder="Last name" required>
          </div>
        </div>
        <div class="ab-form-group">
          <label class="ab-form-label" for="c_email">Email</label>
          <input type="email" id="c_email" name="email" class="ab-form-input" placeholder="your@email.com" required>
        </div>
        <div class="ab-form-group">
          <label class="ab-form-label" for="c_type">Enquiry Type</label>
          <select id="c_type" name="event_type" class="ab-form-select ab-form-input">
            <option value="">Select type</option>
            <option>Talent Booking</option>
            <option>Sponsorship</option>
            <option>Media / Press</option>
            <option>General Enquiry</option>
          </select>
        </div>
        <div class="ab-form-group">
          <label class="ab-form-label" for="c_msg">Message</label>
          <textarea id="c_msg" name="message" class="ab-form-textarea" style="height:140px;" placeholder="Tell us how we can help..."></textarea>
        </div>
        <button type="submit" class="ab-form-submit">Send Message →</button>
        <div class="ab-form-message" role="alert"></div>
      </form>
    </div>

  </div>
</section>

<?php get_footer(); ?>
