<?php get_header(); ?>
<?php
if (!have_posts()) { get_footer(); exit; }
the_post();

$date     = get_field('ab_event_date');
$time     = get_field('ab_event_time');
$venue    = get_field('ab_event_venue');
$city     = get_field('ab_event_city');
$type     = get_field('ab_event_type') ?: 'Concert / Show';
$ticket      = get_field('ab_event_ticket_url');
$recap_video = get_field('ab_event_recap_url') ?: '';
$status      = get_field('ab_event_status');
$is_past     = ($status === 'past' || $status === 'sold_out');
$flyer    = get_field('ab_event_flyer');
$capacity = get_field('ab_event_capacity');
$artists  = get_field('ab_event_artists');
$disp_date = $date ? date('F j, Y', strtotime($date)) : '';
?>

<div style="padding-top:72px;">
  <section class="ab-single-grid" style="padding-top:80px;padding-bottom:100px;">

    <!-- Flyer -->
    <div class="ab-single-flyer ab-reveal">
      <?php if (!empty($flyer['url'])): ?>
        <img src="<?php echo esc_url($flyer['sizes']['ab-event-thumb'] ?? $flyer['url']); ?>"
             alt="<?php the_title_attribute(); ?>"
             style="width:100%;border-radius:6px;display:block;">
      <?php elseif (has_post_thumbnail()): ?>
        <?php the_post_thumbnail('ab-event-thumb', ['style'=>'width:100%;border-radius:6px;']); ?>
      <?php else: ?>
        <div style="height:500px;background:linear-gradient(135deg,#1a0500,#2a0800);border-radius:6px;display:flex;align-items:center;justify-content:center;">
          <span style="font-family:'Bebas Neue',sans-serif;font-size:36px;color:rgba(255,255,255,0.07);letter-spacing:4px;text-align:center;padding:20px;"><?php the_title(); ?></span>
        </div>
      <?php endif; ?>
    </div>

    <!-- Event Details -->
    <div class="ab-reveal ab-delay-1">
      <div class="ab-section-kicker" style="margin-bottom:20px;"><?php echo esc_html($type); ?></div>
      <h1 style="font-family:'Bebas Neue',sans-serif;font-size:clamp(40px,6vw,72px);letter-spacing:2px;line-height:0.92;color:#fff;text-transform:uppercase;margin-bottom:36px;">
        <?php the_title(); ?>
      </h1>

      <div class="ab-single-meta">
        <?php if ($disp_date): ?>
          <div class="ab-single-meta-item">
            <span class="ab-single-meta-key">Date</span>
            <span class="ab-single-meta-val"><?php echo esc_html($disp_date); ?></span>
          </div>
        <?php endif; ?>
        <?php if ($time): ?>
          <div class="ab-single-meta-item">
            <span class="ab-single-meta-key">Time</span>
            <span class="ab-single-meta-val"><?php echo esc_html($time); ?></span>
          </div>
        <?php endif; ?>
        <?php if ($venue): ?>
          <div class="ab-single-meta-item">
            <span class="ab-single-meta-key">Venue</span>
            <span class="ab-single-meta-val"><?php echo esc_html($venue); ?></span>
          </div>
        <?php endif; ?>
        <?php if ($city): ?>
          <div class="ab-single-meta-item">
            <span class="ab-single-meta-key">City</span>
            <span class="ab-single-meta-val"><?php echo esc_html($city); ?></span>
          </div>
        <?php endif; ?>
        <?php if ($capacity): ?>
          <div class="ab-single-meta-item">
            <span class="ab-single-meta-key">Capacity</span>
            <span class="ab-single-meta-val"><?php echo esc_html($capacity); ?></span>
          </div>
        <?php endif; ?>
        <?php if ($artists): ?>
          <div class="ab-single-meta-item">
            <span class="ab-single-meta-key">Artists</span>
            <span class="ab-single-meta-val"><?php echo esc_html($artists); ?></span>
          </div>
        <?php endif; ?>
      </div>

      <?php if (get_the_content()): ?>
        <div class="ab-single-desc"><?php the_content(); ?></div>
      <?php endif; ?>

      <?php if ($is_past): ?>
        <?php if ($recap_video): ?>
          <?php
          // Extract video ID for embed
          preg_match('/(?:youtu\.be\/|youtube\.com\/(?:watch\?v=|embed\/|shorts\/))([A-Za-z0-9_-]{11})/', $recap_video, $rv_m);
          $recap_vid_id = isset($rv_m[1]) ? $rv_m[1] : '';
          ?>
          <?php if ($recap_vid_id): ?>
            <div style="margin-bottom:16px;">
              <div style="font-family:'Barlow Condensed',sans-serif;font-size:10px;font-weight:700;letter-spacing:3px;text-transform:uppercase;color:rgba(255,255,255,0.25);margin-bottom:14px;">Event Recap</div>
              <div style="position:relative;padding-bottom:56.25%;height:0;overflow:hidden;border-radius:2px;background:#111;">
                <iframe
                  src="https://www.youtube.com/embed/<?php echo esc_attr($recap_vid_id); ?>?rel=0"
                  style="position:absolute;top:0;left:0;width:100%;height:100%;border:0;"
                  allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                  allowfullscreen
                  loading="lazy">
                </iframe>
              </div>
            </div>
          <?php else: ?>
            <a href="<?php echo esc_url($recap_video); ?>"
               class="ab-single-ticket-btn"
               target="_blank" rel="noopener"
               style="background:#1a1a1a;color:rgba(255,255,255,0.7);">
              Watch Recap Video →
            </a>
          <?php endif; ?>
        <?php else: ?>
          <span class="ab-single-ticket-btn" style="background:#1a1a1a;cursor:default;display:inline-block;opacity:0.5;">
            Recap Video Coming Soon
          </span>
        <?php endif; ?>
      <?php elseif ($ticket): ?>
        <a href="<?php echo esc_url($ticket); ?>"
           class="ab-single-ticket-btn"
           target="_blank" rel="noopener">
          Get Tickets →
        </a>
      <?php elseif ($status === 'sold_out'): ?>
        <span class="ab-single-ticket-btn" style="background:#333;cursor:default;display:inline-block;opacity:0.6;">
          Sold Out
        </span>
      <?php else: ?>
        <span class="ab-single-ticket-btn" style="background:#222;cursor:default;display:inline-block;opacity:0.5;">
          Tickets Coming Soon
        </span>
      <?php endif; ?>

      <div style="margin-top:40px;padding-top:32px;border-top:1px solid #1a1a1a;">
        <a href="<?php echo esc_url(home_url('/events')); ?>"
           style="font-family:'Barlow Condensed',sans-serif;font-size:12px;font-weight:700;letter-spacing:3px;text-transform:uppercase;color:rgba(255,255,255,0.3);transition:color 0.2s;">
          ← Back to Events
        </a>
      </div>
    </div>

  </section>
</div>

<?php get_footer(); ?>
