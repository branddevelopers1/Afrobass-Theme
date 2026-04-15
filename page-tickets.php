<?php
/**
 * Template Name: Tickets Page
 * Template Post Type: page
 */
get_header();
$contact_email = fest_setting('fest_email') ?: 'contact@afrobassfestival.com';

/*
 * Showpass iframe URL — provided by Showpass
 * theme-dark=true   : dark background mode
 * layout-list=true  : list layout (less Showpass chrome)
 * tags=afrobass      : filters to only Afrobass events
 * hide-header=true   : hides the Showpass top header bar
 * hide-filter=true   : hides tag/search filters
 * primary-color      : overrides their accent color to match Afrobass brand
 */
$sp_iframe_src = 'https://www.showpass.com/w/tickets/events/list/16715/?theme-dark=true&layout-list=true&tags=afrobass&hide-header=true&hide-filter=true&primary-color=FF2D8A';
?>

<style>
/* ── IFRAME WRAPPER — clips any Showpass chrome that bleeds out ── */
#sp-iframe-wrap {
  position: relative;
  width: 100%;
  overflow: hidden;
  background: #080808;
}

/* Mask bars — positioned over the iframe to cover Showpass header/footer */
#sp-mask-top {
  position: absolute;
  top: 0; left: 0; right: 0;
  height: 64px; /* covers Showpass top bar */
  background: #080808;
  z-index: 10;
  pointer-events: none;
}
#sp-mask-bottom {
  position: absolute;
  bottom: 0; left: 0; right: 0;
  height: 56px; /* covers "Powered by Showpass" footer */
  background: #080808;
  z-index: 10;
  pointer-events: none;
}
#sp-mask-left {
  position: absolute;
  top: 0; left: 0; bottom: 0;
  width: 1px;
  background: #080808;
  z-index: 10;
  pointer-events: none;
}
#sp-mask-right {
  position: absolute;
  top: 0; right: 0; bottom: 0;
  width: 1px;
  background: #080808;
  z-index: 10;
  pointer-events: none;
}

/* The iframe itself — pushed up so the Showpass header is hidden under the mask */
#sp-iframe {
  display: block;
  width: 100%;
  border: none;
  /* Push up by mask-top height so their header goes under our mask */
  margin-top: -64px;
  /* Add bottom padding so their footer goes under our mask */
  margin-bottom: -56px;
  /* Total height = visible height + hidden top + hidden bottom */
  height: calc(740px + 64px + 56px);
  pointer-events: auto;
}

/* Loading state */
#sp-loading {
  position: absolute;
  inset: 0;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  gap: 20px;
  background: #080808;
  z-index: 5;
  transition: opacity 0.5s;
}
#sp-loading.hidden {
  opacity: 0;
  pointer-events: none;
}
.sp-load-bar {
  width: 160px;
  height: 1px;
  background: rgba(255,255,255,0.06);
  overflow: hidden;
  position: relative;
}
.sp-load-bar::after {
  content: '';
  position: absolute;
  top: 0; left: -40%; width: 40%; height: 100%;
  background: #FF2D8A;
  animation: spScan 1.4s cubic-bezier(0.4,0,0.2,1) infinite;
}
@keyframes spScan { from{left:-40%;} to{left:100%;} }

/* Ticket tier cards — override default fest styles for tickets page */
.fest-tickets-section { padding: 0 56px 0; }
.fest-tickets-grid { margin-top: 56px; }

/* Section divider label */
.sp-section-label {
  display: flex;
  align-items: center;
  gap: 20px;
  padding: 40px 56px 32px;
}
.sp-section-label::before {
  content: '';
  width: 2px;
  height: 28px;
  background: #FF2D8A;
  flex-shrink: 0;
}
.sp-section-label-text {
  font-family: 'Unbounded', sans-serif;
  font-size: clamp(22px, 3vw, 36px);
  font-weight: 900;
  color: #fff;
  text-transform: uppercase;
  letter-spacing: -0.5px;
}
.sp-section-label-sub {
  font-family: 'Space Grotesk', sans-serif;
  font-size: 11px;
  font-weight: 500;
  letter-spacing: 2px;
  text-transform: uppercase;
  color: rgba(255,255,255,0.25);
  margin-top: 4px;
}

@media (max-width: 768px) {
  #sp-iframe { height: calc(900px + 64px + 56px); }
  .fest-tickets-section { padding: 0 24px 0; }
  .sp-section-label { padding: 32px 24px 24px; }
}
</style>

<div style="padding-top:72px;">

  <!-- ── HERO ── -->
  <div class="fest-lineup-hero">
    <div class="fest-kicker fest-reveal">Afrobass Music Festival 2026</div>
    <h1 class="fest-title fest-reveal" style="margin-bottom:20px;">Get Your<br>Tickets</h1>
    <p style="font-size:16px;font-weight:300;color:rgba(255,255,255,0.4);max-width:560px;line-height:1.7;" class="fest-reveal">
      Saturday, August 15, 2026 &middot; Rebel Entertainment Complex &middot; Toronto &middot; 19+
    </p>
  </div>

  <!-- ── TIER OVERVIEW CARDS ── -->
  <section class="fest-tickets-section">
    <div class="fest-tickets-grid">

      <!-- General Admission -->
      <div class="fest-ticket-tier fest-reveal">
        <span class="fest-tier-badge">General</span>
        <div class="fest-tier-name">General Admission</div>
        <div class="fest-tier-desc">Full access to the festival grounds, all performances, and vendor areas.</div>
        <div class="fest-tier-perks">
          <div class="fest-tier-perk"><div class="fest-tier-perk-dot"></div>All performances &mdash; full night</div>
          <div class="fest-tier-perk"><div class="fest-tier-perk-dot"></div>General standing floor</div>
          <div class="fest-tier-perk"><div class="fest-tier-perk-dot"></div>Food &amp; vendor access</div>
          <div class="fest-tier-perk"><div class="fest-tier-perk-dot"></div>19+ valid ID required</div>
        </div>
        <a href="#ticket-checkout" onclick="document.getElementById('ticket-checkout').scrollIntoView({behavior:'smooth'});return false;"
           class="fest-tier-btn fest-tier-btn-outline" style="display:block;text-align:center;">
          Select Tickets &darr;
        </a>
      </div>

      <!-- VIP -->
      <div class="fest-ticket-tier featured fest-reveal fest-d1">
        <span class="fest-tier-badge">Most Popular</span>
        <div class="fest-tier-name">VIP Experience</div>
        <div class="fest-tier-desc">Premium access with exclusive areas, dedicated bar, and priority entry.</div>
        <div class="fest-tier-perks">
          <div class="fest-tier-perk"><div class="fest-tier-perk-dot"></div>Everything in General Admission</div>
          <div class="fest-tier-perk"><div class="fest-tier-perk-dot"></div>Dedicated VIP area &amp; bar</div>
          <div class="fest-tier-perk"><div class="fest-tier-perk-dot"></div>Priority entry &mdash; skip the line</div>
          <div class="fest-tier-perk"><div class="fest-tier-perk-dot"></div>Exclusive VIP lounge access</div>
        </div>
        <a href="#ticket-checkout" onclick="document.getElementById('ticket-checkout').scrollIntoView({behavior:'smooth'});return false;"
           class="fest-tier-btn fest-tier-btn-fill" style="display:block;text-align:center;">
          Select Tickets &darr;
        </a>
      </div>

      <!-- Table Package -->
      <div class="fest-ticket-tier fest-reveal fest-d2">
        <span class="fest-tier-badge">Groups</span>
        <div class="fest-tier-name">Table Package</div>
        <div class="fest-tier-desc">Reserved table for your group with bottle service and a dedicated host.</div>
        <div class="fest-tier-perks">
          <div class="fest-tier-perk"><div class="fest-tier-perk-dot"></div>Table for 6&ndash;10 guests</div>
          <div class="fest-tier-perk"><div class="fest-tier-perk-dot"></div>Bottle service included</div>
          <div class="fest-tier-perk"><div class="fest-tier-perk-dot"></div>Dedicated event host</div>
          <div class="fest-tier-perk"><div class="fest-tier-perk-dot"></div>Best views of the stage</div>
        </div>
        <a href="mailto:<?php echo esc_attr($contact_email); ?>?subject=Table Package Enquiry — Afrobass Fest 2026"
           class="fest-tier-btn fest-tier-btn-outline" style="display:block;text-align:center;">
          Enquire &rarr;
        </a>
      </div>

    </div>
  </section>

  <!-- ── CHECKOUT SECTION ── -->
  <div id="ticket-checkout" style="margin-top:80px;border-top:1px solid rgba(255,255,255,0.04);">

    <!-- Section label — branded, no Showpass mention -->
    <div class="sp-section-label fest-reveal">
      <div>
        <div class="sp-section-label-text">Select Your Tickets</div>
        <div class="sp-section-label-sub">August 15, 2026 &middot; Rebel Entertainment Complex &middot; Toronto</div>
      </div>
    </div>

    <!-- Iframe wrapper — masks Showpass branding top and bottom -->
    <div id="sp-iframe-wrap" style="height:740px;">

      <!-- Loading state shown until iframe loads -->
      <div id="sp-loading">
        <div style="font-family:'Unbounded',sans-serif;font-size:10px;font-weight:700;letter-spacing:4px;text-transform:uppercase;color:rgba(255,255,255,0.2);">Loading Tickets</div>
        <div class="sp-load-bar"></div>
      </div>

      <!-- Top mask — hides Showpass header bar -->
      <div id="sp-mask-top"></div>

      <!-- The Showpass iframe — dark theme, filtered to this event -->
      <iframe
        id="sp-iframe"
        src="<?php echo esc_url($sp_iframe_src); ?>"
        frameborder="0"
        scrolling="no"
        allowpaymentrequest
        title="Ticket Selection"
        onload="document.getElementById('sp-loading').classList.add('hidden');"
        style="width:100%;">
      </iframe>

      <!-- Bottom mask — hides "Powered by Showpass" footer -->
      <div id="sp-mask-bottom"></div>

    </div>

    <!-- Reassurance strip directly below iframe — your branding, your trust signals -->
    <div style="background:#060606;border-top:1px solid rgba(255,255,255,0.04);padding:24px 56px;display:flex;align-items:center;justify-content:space-between;gap:24px;flex-wrap:wrap;">
      <div style="display:flex;align-items:center;gap:32px;flex-wrap:wrap;">
        <div style="display:flex;align-items:center;gap:10px;">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#FF2D8A" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
          <span style="font-family:'Space Grotesk',sans-serif;font-size:11px;font-weight:500;letter-spacing:1px;color:rgba(255,255,255,0.3);">Secure Checkout</span>
        </div>
        <div style="display:flex;align-items:center;gap:10px;">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#FF2D8A" stroke-width="2"><rect x="1" y="4" width="22" height="16" rx="2"/><line x1="1" y1="10" x2="23" y2="10"/></svg>
          <span style="font-family:'Space Grotesk',sans-serif;font-size:11px;font-weight:500;letter-spacing:1px;color:rgba(255,255,255,0.3);">All Major Cards Accepted</span>
        </div>
        <div style="display:flex;align-items:center;gap:10px;">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#FF2D8A" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2A19.79 19.79 0 0 1 11.69 19a19.5 19.5 0 0 1-6-6A19.79 19.79 0 0 1 2.12 4.18 2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
          <span style="font-family:'Space Grotesk',sans-serif;font-size:11px;font-weight:500;letter-spacing:1px;color:rgba(255,255,255,0.3);">Need help? <a href="mailto:<?php echo esc_attr($contact_email); ?>" style="color:#FF2D8A;text-decoration:none;"><?php echo esc_html($contact_email); ?></a></span>
        </div>
      </div>
      <div style="font-family:'Unbounded',sans-serif;font-size:10px;font-weight:700;letter-spacing:2px;text-transform:uppercase;color:rgba(255,255,255,0.08);">AFROBASS MUSIC FESTIVAL 2026</div>
    </div>

  </div>

  <!-- ── EVENT DETAILS ── -->
  <div style="padding:0 0 0;border-top:1px solid rgba(255,255,255,0.04);" class="fest-reveal">
    <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:2px;background:rgba(255,255,255,0.04);">
      <?php foreach([
        ['Date',     'Saturday, August 15, 2026'],
        ['Venue',    'Rebel Entertainment Complex'],
        ['Address',  '11 Polson St, Toronto, ON'],
        ['Age',      '19+ Valid ID Required'],
      ] as $d): ?>
        <div style="background:#080808;padding:28px 32px;">
          <div style="font-family:'Space Grotesk',sans-serif;font-size:9px;font-weight:700;letter-spacing:3px;text-transform:uppercase;color:rgba(255,255,255,0.2);margin-bottom:8px;"><?php echo esc_html($d[0]); ?></div>
          <div style="font-size:13px;color:rgba(255,255,255,0.7);"><?php echo esc_html($d[1]); ?></div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>

  <!-- ── FAQ TEASER ── -->
  <div style="padding:80px 56px;border-top:1px solid rgba(255,255,255,0.04);display:grid;grid-template-columns:1fr 1fr;gap:80px;align-items:center;" class="fest-reveal">
    <div>
      <div class="fest-kicker">Need Help?</div>
      <h2 style="font-family:'Unbounded',sans-serif;font-size:clamp(28px,3vw,44px);font-weight:900;letter-spacing:-1px;color:#fff;text-transform:uppercase;margin-top:12px;margin-bottom:16px;">Ticket FAQs</h2>
      <p style="font-size:14px;font-weight:300;color:rgba(255,255,255,0.4);line-height:1.8;">Questions about refunds, transfers, age requirements, or what's included? We have answers.</p>
    </div>
    <div style="display:flex;gap:16px;flex-wrap:wrap;">
      <a href="<?php echo esc_url(home_url('/faq')); ?>" class="fest-btn-primary" style="display:inline-block;">Read the FAQ &rarr;</a>
      <a href="mailto:<?php echo esc_attr($contact_email); ?>"
         style="display:inline-flex;align-items:center;font-family:'Space Grotesk',sans-serif;font-size:11px;font-weight:700;letter-spacing:2px;text-transform:uppercase;color:rgba(255,255,255,0.35);text-decoration:none;padding:17px 32px;border:1px solid rgba(255,255,255,0.08);border-radius:2px;transition:color 0.2s,border-color 0.2s;"
         onmouseover="this.style.color='#fff';this.style.borderColor='rgba(255,255,255,0.2)'"
         onmouseout="this.style.color='rgba(255,255,255,0.35)';this.style.borderColor='rgba(255,255,255,0.08)'">
        Contact Us
      </a>
    </div>
  </div>

</div>

<script>
/* Adjust iframe height dynamically for mobile */
(function(){
  function resizeIframe(){
    var wrap = document.getElementById('sp-iframe-wrap');
    var iframe = document.getElementById('sp-iframe');
    if (!wrap || !iframe) return;
    if (window.innerWidth < 768) {
      wrap.style.height = '900px';
      iframe.style.height = 'calc(900px + 64px + 56px)';
    } else {
      wrap.style.height = '740px';
      iframe.style.height = 'calc(740px + 64px + 56px)';
    }
  }
  resizeIframe();
  window.addEventListener('resize', resizeIframe);

  /* Listen for postMessage from Showpass iframe to adjust height dynamically */
  window.addEventListener('message', function(e){
    if (!e.origin || e.origin.indexOf('showpass.com') === -1) return;
    if (e.data && e.data.height) {
      var wrap = document.getElementById('sp-iframe-wrap');
      var iframe = document.getElementById('sp-iframe');
      var h = parseInt(e.data.height, 10);
      if (h > 200) {
        wrap.style.height = h + 'px';
        iframe.style.height = (h + 64 + 56) + 'px';
      }
    }
  });
})();
</script>

<?php get_footer(); ?>
