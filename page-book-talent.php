<?php
/**
 * Template Name: Book Talent Page
 * Template Post Type: page
 */
get_header();

$email = ab_setting('ab_email') ?: 'contact@afrobass.com';

// Roster — add real artist CPT query, fallback to hardcoded roster
$artists_query = new WP_Query([
  'post_type'      => 'ab_artist',
  'posts_per_page' => -1,
  'orderby'        => 'menu_order',
  'order'          => 'ASC',
]);
$has_artists = $artists_query->have_posts();

// Fallback roster for display before CPT is populated
$fallback_artists = [
  ['name' => 'DJ Spinall',   'genre' => 'Afrobeats · DJ Set',       'origin' => 'Nigeria'],
  ['name' => 'Hangaëlle',    'genre' => 'Afrobeats · Live',         'origin' => 'Canada'],
  ['name' => 'Martinses',    'genre' => 'Afro-Caribbean · Live',    'origin' => 'Canada'],
  ['name' => 'Brizzy',       'genre' => 'Afrobeats · Live',         'origin' => 'Canada'],
  ['name' => 'Uncles',       'genre' => 'Afrobeats · DJ Set',       'origin' => 'Canada'],
  ['name' => 'TBA',          'genre' => 'More artists coming soon', 'origin' => ''],
];
?>

<style>
/* ── BOOK TALENT PAGE ── */
.ab-bt-hero {
  padding: 160px 56px 80px;
  background: var(--dark);
  border-bottom: 1px solid var(--dark3);
  position: relative; overflow: hidden;
}
.ab-bt-hero::before {
  content: ''; position: absolute; inset: 0;
  background: radial-gradient(ellipse 60% 80% at 80% 30%, rgba(255,69,0,0.07) 0%, transparent 60%);
}
.ab-bt-hero-inner { position: relative; z-index: 1; max-width: 640px; }

/* Artist carousel */
.ab-bt-roster-section {
  background: var(--black);
  border-bottom: 1px solid var(--dark3);
  padding: 0 0 80px;
}
.ab-bt-roster-label {
  padding: 48px 56px 32px;
  font-family: var(--font-cond); font-size: 11px; font-weight: 700;
  letter-spacing: 4px; text-transform: uppercase; color: var(--orange);
  display: flex; align-items: center; gap: 14px;
}
.ab-bt-roster-label::before { content: ''; width: 28px; height: 1px; background: var(--orange); }

.ab-bt-carousel {
  display: flex; gap: 2px; overflow-x: auto;
  padding: 0 56px 0; scroll-snap-type: x mandatory;
  scrollbar-width: none; -ms-overflow-style: none;
}
.ab-bt-carousel::-webkit-scrollbar { display: none; }

.ab-bt-artist-card {
  flex-shrink: 0; width: 240px; scroll-snap-align: start;
  background: var(--dark); cursor: pointer;
  transition: background 0.3s;
  text-decoration: none; color: inherit;
  display: block; position: relative;
}
.ab-bt-artist-card:hover { background: #131313; }
.ab-bt-artist-card:hover .ab-bt-artist-img { transform: scale(1.03); }

.ab-bt-artist-img-wrap {
  height: 280px; overflow: hidden; background: var(--dark2);
  position: relative;
}
.ab-bt-artist-img {
  width: 100%; height: 100%; object-fit: cover; object-position: top;
  display: block; filter: grayscale(15%);
  transition: transform 0.5s cubic-bezier(0.16,1,0.3,1), filter 0.3s;
}
.ab-bt-artist-card:hover .ab-bt-artist-img { filter: grayscale(0%); }

.ab-bt-artist-initials {
  width: 100%; height: 100%;
  display: flex; align-items: center; justify-content: center;
  font-family: var(--font-display); font-size: 56px;
  color: var(--dark3); letter-spacing: 2px;
}
.ab-bt-artist-overlay {
  position: absolute; inset: 0;
  background: linear-gradient(to top, rgba(8,8,8,0.8) 0%, transparent 50%);
}
.ab-bt-artist-tag {
  position: absolute; top: 12px; left: 12px;
  background: var(--orange); color: var(--white);
  font-family: var(--font-cond); font-size: 9px; font-weight: 700;
  letter-spacing: 2px; text-transform: uppercase; padding: 4px 10px; border-radius: 1px;
}
.ab-bt-artist-info { padding: 16px 20px 24px; }
.ab-bt-artist-name {
  font-family: var(--font-display); font-size: 20px; letter-spacing: 1px;
  text-transform: uppercase; color: var(--white); margin-bottom: 4px;
}
.ab-bt-artist-genre {
  font-family: var(--font-cond); font-size: 11px; font-weight: 600;
  letter-spacing: 1.5px; text-transform: uppercase;
  color: rgba(255,255,255,0.35);
}
.ab-bt-artist-origin {
  font-size: 12px; font-weight: 300; color: rgba(255,255,255,0.2);
  margin-top: 4px;
}
.ab-bt-view-btn {
  display: flex; align-items: center; gap: 6px; margin-top: 12px;
  font-family: var(--font-cond); font-size: 10px; font-weight: 700;
  letter-spacing: 2px; text-transform: uppercase; color: var(--orange);
  opacity: 0; transition: opacity 0.2s;
}
.ab-bt-artist-card:hover .ab-bt-view-btn { opacity: 1; }

/* TBA card */
.ab-bt-artist-tba {
  width: 240px; flex-shrink: 0;
  background: var(--dark); display: flex; flex-direction: column;
  align-items: center; justify-content: center; height: 360px;
  border: 1px dashed var(--dark3);
}
.ab-bt-tba-icon {
  width: 56px; height: 56px; border-radius: 50%;
  border: 1px solid var(--dark3);
  display: flex; align-items: center; justify-content: center;
  margin-bottom: 14px;
}
.ab-bt-tba-text {
  font-family: var(--font-cond); font-size: 12px; font-weight: 600;
  letter-spacing: 3px; text-transform: uppercase; color: rgba(255,255,255,0.15);
}

/* Carousel scroll hint */
.ab-bt-scroll-hint {
  padding: 16px 56px 0;
  font-family: var(--font-cond); font-size: 10px; font-weight: 600;
  letter-spacing: 2px; text-transform: uppercase;
  color: rgba(255,255,255,0.2);
  display: flex; align-items: center; gap: 10px;
}
.ab-bt-scroll-hint::before { content: '←'; font-size: 14px; }
.ab-bt-scroll-hint::after  { content: '→'; font-size: 14px; }

/* Booking form */
.ab-bt-form-section {
  padding: 80px 56px 120px; background: var(--dark);
}
.ab-bt-form-grid {
  display: grid; grid-template-columns: 1fr 1.6fr; gap: 80px; align-items: start;
}
.ab-bt-form-info {}
.ab-bt-form-info h2 {
  font-family: var(--font-display); font-size: clamp(32px,4vw,52px);
  letter-spacing: 2px; text-transform: uppercase; color: var(--white);
  line-height: 0.92; margin-bottom: 20px;
}
.ab-bt-form-info p {
  font-size: 14px; font-weight: 300; color: rgba(255,255,255,0.4);
  line-height: 1.8; margin-bottom: 32px;
}
.ab-bt-contact-item { margin-bottom: 20px; }
.ab-bt-contact-label {
  font-family: var(--font-cond); font-size: 10px; font-weight: 700;
  letter-spacing: 3px; text-transform: uppercase;
  color: rgba(255,255,255,0.25); margin-bottom: 6px;
}
.ab-bt-contact-value {
  font-size: 14px; font-weight: 400; color: rgba(255,255,255,0.6);
}
.ab-bt-contact-value a { color: var(--orange); text-decoration: none; }

/* Form matching homepage booking form style */
.ab-bt-form { display: flex; flex-direction: column; gap: 0; }
.ab-bt-field-row { display: grid; grid-template-columns: 1fr 1fr; gap: 24px; }
.ab-bt-field {
  border-bottom: 1px solid var(--dark3); padding: 0;
  transition: border-color 0.2s; margin-bottom: 0;
  position: relative;
}
.ab-bt-field:focus-within { border-bottom-color: var(--orange); }
.ab-bt-field input, .ab-bt-field textarea, .ab-bt-field select {
  width: 100%; background: transparent; border: none; outline: none;
  padding: 18px 0; color: var(--white);
  font-family: var(--font-body); font-size: 15px; font-weight: 300;
  appearance: none; -webkit-appearance: none;
}
.ab-bt-field select { cursor: pointer; }
.ab-bt-field select option { background: var(--dark2); color: var(--white); }
.ab-bt-field textarea { resize: vertical; min-height: 100px; }
.ab-bt-field ::placeholder { color: rgba(255,255,255,0.2); }
.ab-bt-field label {
  display: block; font-family: var(--font-cond); font-size: 10px;
  font-weight: 700; letter-spacing: 3px; text-transform: uppercase;
  color: rgba(255,255,255,0.25); padding-top: 18px; pointer-events: none;
}
.ab-bt-optional {
  font-size: 9px; letter-spacing: 1px; color: rgba(255,255,255,0.15);
  font-weight: 400; text-transform: none; margin-left: 6px;
}
.ab-bt-submit {
  font-family: var(--font-cond); font-size: 14px; font-weight: 700;
  letter-spacing: 3px; text-transform: uppercase;
  background: var(--orange); color: var(--white); border: none;
  padding: 20px 48px; border-radius: 2px; margin-top: 40px;
  width: 100%; transition: background 0.2s;
}
.ab-bt-submit:hover { background: #CC3600; }
.ab-bt-form-msg { font-size: 13px; margin-top: 12px; display: none; }
.ab-bt-form-msg.success { color: #00c850; display: block; }
.ab-bt-form-msg.error { color: #ff4444; display: block; }

@media (max-width: 768px) {
  .ab-bt-hero { padding: 120px 24px 60px; }
  .ab-bt-roster-label { padding: 36px 24px 24px; }
  .ab-bt-carousel { padding: 0 24px; }
  .ab-bt-scroll-hint { padding: 12px 24px 0; }
  .ab-bt-form-section { padding: 60px 24px 80px; }
  .ab-bt-form-grid { grid-template-columns: 1fr; gap: 48px; }
  .ab-bt-field-row { grid-template-columns: 1fr; }
}
</style>

<!-- ═══ HERO ═══ -->
<div class="ab-bt-hero">
  <div class="ab-bt-hero-inner">
    <div class="ab-section-kicker ab-reveal">Talent Booking</div>
    <h1 class="ab-page-title ab-reveal" style="margin-bottom:20px;">Book World-Class<br><span style="color:var(--orange);">Afrobeats Talent</span></h1>
    <p class="ab-reveal" style="font-size:16px;font-weight:300;color:rgba(255,255,255,0.5);line-height:1.8;max-width:480px;">
      Afrobass represents and works with top international Afrobeats, Amapiano, and Afro-Caribbean artists and DJs. Browse our roster below and submit a booking enquiry.
    </p>
  </div>
</div>

<!-- ═══ ARTIST ROSTER CAROUSEL ═══ -->
<section class="ab-bt-roster-section">
  <div class="ab-bt-roster-label">Our Roster</div>
  <div class="ab-bt-carousel" id="ab-bt-carousel">

    <?php if ($has_artists):
      while ($artists_query->have_posts()): $artists_query->the_post();
        $genre    = get_field('ab_artist_genre')  ?: '';
        $origin   = get_field('ab_artist_origin') ?: '';
        $role     = get_field('ab_artist_role')   ?: 'Artist';
        $initials = implode('', array_map(fn($w) => strtoupper($w[0]), array_filter(explode(' ', get_the_title()))));
        $initials = substr($initials, 0, 2);
    ?>
      <a href="<?php the_permalink(); ?>" class="ab-bt-artist-card ab-reveal">
        <div class="ab-bt-artist-img-wrap">
          <?php if (has_post_thumbnail()): ?>
            <?php the_post_thumbnail('ab-event-thumb', ['class'=>'ab-bt-artist-img']); ?>
          <?php else: ?>
            <div class="ab-bt-artist-initials"><?php echo esc_html($initials); ?></div>
          <?php endif; ?>
          <div class="ab-bt-artist-overlay"></div>
          <span class="ab-bt-artist-tag"><?php echo esc_html($role); ?></span>
        </div>
        <div class="ab-bt-artist-info">
          <div class="ab-bt-artist-name"><?php the_title(); ?></div>
          <?php if ($genre): ?><div class="ab-bt-artist-genre"><?php echo esc_html($genre); ?></div><?php endif; ?>
          <?php if ($origin): ?><div class="ab-bt-artist-origin"><?php echo esc_html($origin); ?></div><?php endif; ?>
          <div class="ab-bt-view-btn">View Profile →</div>
        </div>
      </a>
    <?php endwhile; wp_reset_postdata();
    else:
      foreach ($fallback_artists as $a):
        if ($a['name'] === 'TBA'):
    ?>
      <div class="ab-bt-artist-tba">
        <div class="ab-bt-tba-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="rgba(255,255,255,0.15)" stroke-width="1" width="22" height="22"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4.4 3.6-8 8-8s8 3.6 8 8"/></svg>
        </div>
        <div class="ab-bt-tba-text">More Soon</div>
      </div>
    <?php else: ?>
      <div class="ab-bt-artist-card ab-reveal">
        <div class="ab-bt-artist-img-wrap">
          <div class="ab-bt-artist-initials"><?php echo esc_html(strtoupper(substr($a['name'], 0, 2))); ?></div>
          <div class="ab-bt-artist-overlay"></div>
          <span class="ab-bt-artist-tag"><?php echo esc_html(explode(' · ', $a['genre'])[1] ?? 'Artist'); ?></span>
        </div>
        <div class="ab-bt-artist-info">
          <div class="ab-bt-artist-name"><?php echo esc_html($a['name']); ?></div>
          <div class="ab-bt-artist-genre"><?php echo esc_html($a['genre']); ?></div>
          <?php if ($a['origin']): ?><div class="ab-bt-artist-origin"><?php echo esc_html($a['origin']); ?></div><?php endif; ?>
        </div>
      </div>
    <?php endif; endforeach; endif; ?>

  </div>
  <div class="ab-bt-scroll-hint">Scroll to browse</div>
</section>

<!-- ═══ BOOKING FORM ═══ -->
<section class="ab-bt-form-section" id="booking-form">
  <div class="ab-bt-form-grid">

    <!-- Left info -->
    <div class="ab-reveal">
      <div class="ab-section-kicker" style="margin-bottom:20px;">Submit an Enquiry</div>
      <h2>Book Talent<br>for Your<br>Event</h2>
      <p>Fill out the form and our booking team will get back to you within 48 hours. For urgent enquiries, reach us directly.</p>
      <div class="ab-bt-contact-item">
        <div class="ab-bt-contact-label">Booking Email</div>
        <div class="ab-bt-contact-value"><a href="mailto:<?php echo esc_attr($email); ?>"><?php echo esc_html($email); ?></a></div>
      </div>
      <div class="ab-bt-contact-item">
        <div class="ab-bt-contact-label">Phone</div>
        <div class="ab-bt-contact-value"><a href="tel:4168466483"><?php echo esc_html(ab_setting('ab_phone') ?: '416.846.6483'); ?></a></div>
      </div>
      <div class="ab-bt-contact-item" style="margin-top:32px;padding:20px;border:1px solid var(--dark3);border-left:2px solid var(--orange);">
        <div class="ab-bt-contact-label">Response Time</div>
        <div class="ab-bt-contact-value" style="margin-top:6px;">Within 48 business hours</div>
      </div>
    </div>

    <!-- Booking Form -->
    <div class="ab-reveal ab-d2">
      <form id="ab-booking-form" novalidate>

        <div class="ab-bt-field-row">
          <div class="ab-bt-field">
            <label for="bt-name">Your Name</label>
            <input type="text" id="bt-name" name="name" placeholder="Full name" required>
          </div>
          <div class="ab-bt-field">
            <label for="bt-email">Email Address</label>
            <input type="email" id="bt-email" name="email" placeholder="your@email.com" required>
          </div>
        </div>

        <div class="ab-bt-field-row">
          <div class="ab-bt-field">
            <label for="bt-company">Company / Organisation</label>
            <input type="text" id="bt-company" name="company" placeholder="Event company or venue">
          </div>
          <div class="ab-bt-field">
            <label for="bt-phone">Phone Number</label>
            <input type="tel" id="bt-phone" name="phone" placeholder="+1 (416) 000-0000">
          </div>
        </div>

        <div class="ab-bt-field">
          <label for="bt-artist">Artist / DJ Selection <span class="ab-bt-optional">(optional)</span></label>
          <select id="bt-artist" name="artist">
            <option value="">Select from our roster or enter below...</option>
            <?php if ($has_artists):
              $artists_query->rewind_posts();
              while ($artists_query->have_posts()): $artists_query->the_post(); ?>
                <option value="<?php the_title(); ?>"><?php the_title(); ?></option>
              <?php endwhile; wp_reset_postdata();
            else:
              foreach ($fallback_artists as $a):
                if ($a['name'] !== 'TBA'): ?>
                  <option value="<?php echo esc_attr($a['name']); ?>"><?php echo esc_html($a['name']); ?></option>
                <?php endif;
              endforeach;
            endif; ?>
            <option value="Other / Not Listed">Other / Not Listed</option>
          </select>
        </div>

        <div class="ab-bt-field-row">
          <div class="ab-bt-field">
            <label for="bt-event-type">Event Type</label>
            <select id="bt-event-type" name="event_type">
              <option value="">Select event type...</option>
              <option>Concert / Show</option>
              <option>Festival</option>
              <option>Private Event</option>
              <option>Corporate Event</option>
              <option>Club Night</option>
              <option>Wedding / Celebration</option>
              <option>Other</option>
            </select>
          </div>
          <div class="ab-bt-field">
            <label for="bt-date">Event Date</label>
            <input type="text" id="bt-date" name="event_date" placeholder="e.g. June 15, 2026">
          </div>
        </div>

        <div class="ab-bt-field-row">
          <div class="ab-bt-field">
            <label for="bt-location">Event Location / City</label>
            <input type="text" id="bt-location" name="location" placeholder="City, Province / State">
          </div>
          <div class="ab-bt-field">
            <label for="bt-capacity">Expected Attendance</label>
            <select id="bt-capacity" name="capacity">
              <option value="">Select range...</option>
              <option>Under 100</option>
              <option>100 – 500</option>
              <option>500 – 1,000</option>
              <option>1,000 – 2,500</option>
              <option>2,500+</option>
            </select>
          </div>
        </div>

        <div class="ab-bt-field">
          <label for="bt-budget">Budget Range <span class="ab-bt-optional">(optional)</span></label>
          <select id="bt-budget" name="budget">
            <option value="">Select budget range...</option>
            <option>Under $5,000 CAD</option>
            <option>$5,000 – $15,000 CAD</option>
            <option>$15,000 – $30,000 CAD</option>
            <option>$30,000 – $50,000 CAD</option>
            <option>$50,000+ CAD</option>
            <option>Prefer not to say</option>
          </select>
        </div>

        <div class="ab-bt-field">
          <label for="bt-message">Additional Details</label>
          <textarea id="bt-message" name="message" placeholder="Tell us more about your event, any specific requirements, or questions..."></textarea>
        </div>

        <!-- Honeypot -->
        <input type="text" name="website" style="display:none;position:absolute;left:-9999px;" tabindex="-1" autocomplete="off">

        <button type="submit" class="ab-bt-submit">Submit Booking Enquiry →</button>
        <div class="ab-bt-form-msg" id="ab-bt-form-msg" role="alert"></div>
      </form>
    </div>

  </div>
</section>

<script>
document.getElementById('ab-booking-form').addEventListener('submit', async function(e) {
  e.preventDefault();
  const btn = this.querySelector('.ab-bt-submit');
  const msg = document.getElementById('ab-bt-form-msg');
  if (this.querySelector('[name=website]').value) return;
  btn.textContent = 'Sending...'; btn.disabled = true;

  const data = new FormData(this);
  data.append('action', 'ab_booking_enquiry');
  data.append('nonce', abAjax.nonce);

  try {
    const res  = await fetch(abAjax.ajaxurl, { method: 'POST', body: data });
    const json = await res.json();
    msg.className = 'ab-bt-form-msg ' + (json.success ? 'success' : 'error');
    msg.textContent = json.data;
    if (json.success) this.reset();
  } catch {
    msg.className = 'ab-bt-form-msg error';
    msg.textContent = 'Something went wrong. Please email us directly at <?php echo esc_js($email); ?>';
  }
  btn.textContent = 'Submit Booking Enquiry →'; btn.disabled = false;
});
</script>

<?php get_footer(); ?>
