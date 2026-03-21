<?php get_header(); ?>

<?php
the_post();
$date     = get_field('ab_event_date');
$time     = get_field('ab_event_time');
$venue    = get_field('ab_event_venue');
$city     = get_field('ab_event_city');
$type     = get_field('ab_event_type') ?: 'Event';
$ticket   = get_field('ab_event_ticket_url');
$status   = get_field('ab_event_status');
$flyer    = get_field('ab_event_flyer');
$capacity = get_field('ab_event_capacity');
$artists  = get_field('ab_event_artists');
$disp_date = $date ? date('F j, Y', strtotime($date)) : '';
?>

<div style="padding-top:72px;">
  <section class="ab-single-grid" style="padding-top:80px;">

    <div class="ab-single-flyer ab-reveal">
      <?php if (!empty($flyer['url'])): ?>
        <img src="<?php echo esc_url($flyer['sizes']['ab-event-thumb'] ?? $flyer['url']); ?>" alt="<?php the_title_attribute(); ?>">
      <?php elseif (has_post_thumbnail()): ?>
        <?php the_post_thumbnail('ab-event-thumb'); ?>
      <?php else: ?>
        <div style="height:500px;background:linear-gradient(135deg,#1a0500,#2a0800);border-radius:4px;display:flex;align-items:center;justify-content:center;">
          <span style="font-family:'Bebas Neue',sans-serif;font-size:48px;color:rgba(255,255,255,0.06);letter-spacing:4px;"><?php the_title(); ?></span>
        </div>
      <?php endif; ?>
    </div>

    <div class="ab-reveal ab-delay-1">
      <div class="ab-section-kicker" style="margin-bottom:20px;"><?php echo esc_html($type); ?></div>
      <h1 style="font-family:'Bebas Neue',sans-serif;font-size:clamp(48px,7vw,80px);letter-spacing:2px;line-height:0.9;margin-bottom:32px;"><?php the_title(); ?></h1>

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

      <?php if (have_posts()): the_post(); if (get_the_content()): ?>
        <div class="ab-single-desc"><?php the_content(); ?></div>
      <?php endif; endif; ?>

      <?php if ($ticket && $status !== 'sold_out'): ?>
        <a href="<?php echo esc_url($ticket); ?>" class="ab-single-ticket-btn" target="_blank" rel="noopener">Get Tickets →</a>
      <?php elseif ($status === 'sold_out'): ?>
        <span class="ab-single-ticket-btn" style="background:#333;cursor:default;display:inline-block;">Sold Out</span>
      <?php endif; ?>
    </div>

  </section>
</div>

<?php get_footer(); ?>
