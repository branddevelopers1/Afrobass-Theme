<?php get_header(); the_post(); ?>
<?php
$start   = get_field('ab_tour_start');
$end     = get_field('ab_tour_end');
$cities  = get_field('ab_tour_cities');
$artist  = get_field('ab_tour_artist');
$ticket  = get_field('ab_tour_ticket_url');
$status  = get_field('ab_tour_status');
$flyer   = get_field('ab_tour_flyer');
$ds = $start ? date('F j', strtotime($start)) : '';
$de = $end   ? date('F j, Y', strtotime($end)) : ($start ? date('Y', strtotime($start)) : '');
?>
<div style="padding-top:72px;">
  <section class="ab-single-grid" style="padding-top:80px;">
    <div class="ab-single-flyer ab-reveal">
      <?php if (!empty($flyer['url'])): ?>
        <img src="<?php echo esc_url($flyer['url']); ?>" alt="<?php the_title_attribute(); ?>">
      <?php else: ?>
        <div style="height:500px;background:linear-gradient(135deg,#001a10,#003525);border-radius:4px;display:flex;align-items:center;justify-content:center;">
          <span style="font-family:'Bebas Neue',sans-serif;font-size:48px;color:rgba(255,255,255,0.06);letter-spacing:4px;text-align:center;padding:20px;"><?php the_title(); ?></span>
        </div>
      <?php endif; ?>
    </div>
    <div class="ab-reveal ab-delay-1">
      <div class="ab-section-kicker" style="margin-bottom:20px;">Tour</div>
      <h1 style="font-family:'Bebas Neue',sans-serif;font-size:clamp(48px,7vw,80px);letter-spacing:2px;line-height:0.9;margin-bottom:32px;"><?php the_title(); ?></h1>
      <div class="ab-single-meta">
        <?php if ($artist): ?><div class="ab-single-meta-item"><span class="ab-single-meta-key">Artist</span><span class="ab-single-meta-val"><?php echo esc_html($artist); ?></span></div><?php endif; ?>
        <?php if ($ds): ?><div class="ab-single-meta-item"><span class="ab-single-meta-key">Dates</span><span class="ab-single-meta-val"><?php echo esc_html($ds . ($de ? ' – ' . $de : '')); ?></span></div><?php endif; ?>
        <?php if ($cities): ?><div class="ab-single-meta-item"><span class="ab-single-meta-key">Cities</span><span class="ab-single-meta-val"><?php echo esc_html($cities); ?></span></div><?php endif; ?>
      </div>
      <?php if (get_the_content()): ?><div class="ab-single-desc"><?php the_content(); ?></div><?php endif; ?>
      <?php if ($ticket && $status !== 'past'): ?>
        <a href="<?php echo esc_url($ticket); ?>" class="ab-single-ticket-btn" target="_blank" rel="noopener">Get Tickets →</a>
      <?php endif; ?>
    </div>
  </section>
</div>
<?php get_footer(); ?>
