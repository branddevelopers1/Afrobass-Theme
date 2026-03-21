<?php get_header(); ?>
<?php
if (!have_posts()) { get_footer(); exit; }
the_post();

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
  <section class="ab-single-grid" style="padding-top:80px;padding-bottom:100px;">

    <div class="ab-single-flyer ab-reveal">
      <?php if (!empty($flyer['url'])): ?>
        <img src="<?php echo esc_url($flyer['url']); ?>" alt="<?php the_title_attribute(); ?>" style="width:100%;border-radius:6px;display:block;">
      <?php else: ?>
        <div style="height:500px;background:linear-gradient(135deg,#001a10,#003525);border-radius:6px;display:flex;align-items:center;justify-content:center;">
          <span style="font-family:'Bebas Neue',sans-serif;font-size:36px;color:rgba(255,255,255,0.07);letter-spacing:4px;text-align:center;padding:20px;"><?php the_title(); ?></span>
        </div>
      <?php endif; ?>
    </div>

    <div class="ab-reveal ab-delay-1">
      <div class="ab-section-kicker" style="margin-bottom:20px;">Tour</div>
      <h1 style="font-family:'Bebas Neue',sans-serif;font-size:clamp(40px,6vw,72px);letter-spacing:2px;line-height:0.92;color:#fff;text-transform:uppercase;margin-bottom:36px;">
        <?php the_title(); ?>
      </h1>
      <div class="ab-single-meta">
        <?php if ($artist): ?>
          <div class="ab-single-meta-item"><span class="ab-single-meta-key">Artist</span><span class="ab-single-meta-val"><?php echo esc_html($artist); ?></span></div>
        <?php endif; ?>
        <?php if ($ds): ?>
          <div class="ab-single-meta-item"><span class="ab-single-meta-key">Dates</span><span class="ab-single-meta-val"><?php echo esc_html($ds . ($de ? ' – ' . $de : '')); ?></span></div>
        <?php endif; ?>
        <?php if ($cities): ?>
          <div class="ab-single-meta-item"><span class="ab-single-meta-key">Cities</span><span class="ab-single-meta-val"><?php echo esc_html($cities); ?></span></div>
        <?php endif; ?>
      </div>
      <?php if (get_the_content()): ?>
        <div class="ab-single-desc"><?php the_content(); ?></div>
      <?php endif; ?>
      <?php if ($ticket && $status !== 'past'): ?>
        <a href="<?php echo esc_url($ticket); ?>" class="ab-single-ticket-btn" target="_blank" rel="noopener">Get Tickets →</a>
      <?php endif; ?>
      <div style="margin-top:40px;padding-top:32px;border-top:1px solid #1a1a1a;">
        <a href="<?php echo esc_url(home_url('/tours')); ?>" style="font-family:'Barlow Condensed',sans-serif;font-size:12px;font-weight:700;letter-spacing:3px;text-transform:uppercase;color:rgba(255,255,255,0.3);">← Back to Tours</a>
      </div>
    </div>

  </section>
</div>

<?php get_footer(); ?>
