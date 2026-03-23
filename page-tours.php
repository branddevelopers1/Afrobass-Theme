<?php
/**
 * Template Name: Tours Page
 * Template Post Type: page
 */
get_header();

// Get featured upcoming tour
$featured_query = new WP_Query([
  'post_type'      => 'ab_tour',
  'posts_per_page' => 1,
  'meta_query'     => [
    'relation' => 'OR',
    ['key'=>'ab_tour_status','value'=>['upcoming','on_sale'],'compare'=>'IN'],
    ['key'=>'ab_tour_status','compare'=>'NOT EXISTS'],
    ['key'=>'ab_tour_status','value'=>'','compare'=>'='],
  ],
  'orderby'  => 'meta_value',
  'meta_key' => 'ab_tour_start',
  'order'    => 'ASC',
]);

$featured_id = 0;
$ft = [];

if ($featured_query->have_posts()) {
  $featured_query->the_post();
  $featured_id        = get_the_ID();
  $ft['title']        = get_the_title();
  $ft['permalink']    = get_permalink();
  $ft['start']        = get_field('ab_tour_start');
  $ft['end']          = get_field('ab_tour_end');
  $ft['cities']       = get_field('ab_tour_cities');
  $ft['artist']       = get_field('ab_tour_artist');
  $ft['ticket']       = get_field('ab_tour_ticket_url');
  $ft['status']       = get_field('ab_tour_status');
  $ft['flyer']        = get_field('ab_tour_flyer');
  $ft['month']        = $ft['start'] ? strtoupper(date('M', strtotime($ft['start']))) : '';
  $ft['day']          = $ft['start'] ? date('d', strtotime($ft['start'])) : '';
  $ft['year']         = $ft['start'] ? date('Y', strtotime($ft['start'])) : '';
  $ft['end_month']    = $ft['end']   ? strtoupper(date('M d', strtotime($ft['end']))) : '';
  wp_reset_postdata();
}

// More upcoming tours
$upcoming_query = new WP_Query([
  'post_type'      => 'ab_tour',
  'posts_per_page' => 12,
  'post__not_in'   => $featured_id ? [$featured_id] : [],
  'meta_query'     => [
    'relation' => 'OR',
    ['key'=>'ab_tour_status','value'=>['upcoming','on_sale'],'compare'=>'IN'],
    ['key'=>'ab_tour_status','compare'=>'NOT EXISTS'],
    ['key'=>'ab_tour_status','value'=>'','compare'=>'='],
  ],
  'orderby'  => 'meta_value',
  'meta_key' => 'ab_tour_start',
  'order'    => 'ASC',
]);
$has_more_upcoming = $upcoming_query->have_posts();

// Past tours
$past_query = new WP_Query([
  'post_type'      => 'ab_tour',
  'posts_per_page' => 12,
  'meta_query'     => [
    ['key'=>'ab_tour_status','value'=>['past','completed'],'compare'=>'IN'],
  ],
  'orderby'  => 'meta_value',
  'meta_key' => 'ab_tour_start',
  'order'    => 'DESC',
]);
?>

<?php if ($featured_id): ?>
<!-- ═══ FEATURED UPCOMING TOUR HERO ═══ -->
<section style="padding-top:72px;border-bottom:1px solid #1a1a1a;background:#080808;">
  <div style="display:grid;grid-template-columns:1fr 1fr;min-height:88vh;">

    <!-- Flyer -->
    <div style="position:relative;overflow:hidden;background:#0a0a0a;">
      <?php if (!empty($ft['flyer']['url'])): ?>
        <img src="<?php echo esc_url($ft['flyer']['url']); ?>"
             alt="<?php echo esc_attr($ft['title']); ?>"
             style="width:100%;height:100%;object-fit:cover;display:block;opacity:0.88;">
      <?php else: ?>
        <div style="width:100%;height:100%;min-height:600px;background:linear-gradient(135deg,#000d1a,#001f3f);display:flex;align-items:center;justify-content:center;">
          <span style="font-family:'Bebas Neue',sans-serif;font-size:48px;color:rgba(255,69,0,0.08);letter-spacing:4px;text-align:center;padding:40px;"><?php echo esc_html($ft['title']); ?></span>
        </div>
      <?php endif; ?>
      <div style="position:absolute;inset:0;background:linear-gradient(to right,transparent 55%,rgba(8,8,8,0.97) 100%);pointer-events:none;"></div>
      <div style="position:absolute;inset:0;background:linear-gradient(to top,rgba(8,8,8,0.5) 0%,transparent 40%);pointer-events:none;"></div>
      <div style="position:absolute;top:32px;left:32px;background:#FF4500;color:#fff;font-family:'Barlow Condensed',sans-serif;font-size:10px;font-weight:700;letter-spacing:2px;text-transform:uppercase;padding:5px 14px;border-radius:1px;">
        Tour
      </div>
    </div>

    <!-- Details -->
    <div style="padding:80px 64px;display:flex;flex-direction:column;justify-content:center;position:relative;background:#080808;">
      <div style="position:absolute;top:40px;right:48px;font-family:'Bebas Neue',sans-serif;font-size:140px;color:rgba(255,255,255,0.025);line-height:1;pointer-events:none;user-select:none;"><?php echo esc_html($ft['year']); ?></div>

      <div style="display:flex;align-items:center;gap:14px;margin-bottom:20px;" class="ab-reveal">
        <div style="width:32px;height:1px;background:#FF4500;"></div>
        <span style="font-family:'Barlow Condensed',sans-serif;font-size:11px;font-weight:700;letter-spacing:4px;text-transform:uppercase;color:#FF4500;">On Tour Now</span>
      </div>

      <h1 style="font-family:'Bebas Neue',sans-serif;font-size:clamp(36px,4.5vw,64px);letter-spacing:2px;line-height:0.92;color:#fff;text-transform:uppercase;margin-bottom:32px;" class="ab-reveal">
        <?php echo esc_html($ft['title']); ?>
      </h1>

      <!-- Date block -->
      <?php if ($ft['start']): ?>
      <div style="display:flex;align-items:flex-start;gap:24px;padding:24px 0;border-top:1px solid #1a1a1a;border-bottom:1px solid #1a1a1a;margin-bottom:28px;" class="ab-reveal">
        <div style="text-align:center;min-width:60px;">
          <div style="font-family:'Bebas Neue',sans-serif;font-size:11px;letter-spacing:3px;color:#FF4500;margin-bottom:2px;"><?php echo esc_html($ft['month']); ?></div>
          <div style="font-family:'Bebas Neue',sans-serif;font-size:52px;line-height:1;color:#fff;"><?php echo esc_html($ft['day']); ?></div>
          <div style="font-family:'Barlow Condensed',sans-serif;font-size:10px;letter-spacing:2px;color:rgba(255,255,255,0.3);"><?php echo esc_html($ft['year']); ?></div>
        </div>
        <div style="padding-left:24px;border-left:1px solid #1a1a1a;">
          <?php if ($ft['end']): ?>
            <div style="font-family:'Barlow Condensed',sans-serif;font-size:12px;font-weight:600;letter-spacing:2px;text-transform:uppercase;color:rgba(255,255,255,0.35);margin-bottom:8px;">Through <?php echo esc_html($ft['end_month']); ?></div>
          <?php endif; ?>
          <?php if ($ft['artist']): ?>
            <div style="font-family:'Barlow Condensed',sans-serif;font-size:20px;font-weight:700;letter-spacing:1px;text-transform:uppercase;color:#fff;margin-bottom:4px;"><?php echo esc_html($ft['artist']); ?></div>
          <?php endif; ?>
          <?php if ($ft['cities']): ?>
            <div style="font-size:14px;font-weight:300;color:rgba(255,255,255,0.35);"><?php echo esc_html($ft['cities']); ?></div>
          <?php endif; ?>
        </div>
      </div>
      <?php endif; ?>

      <!-- CTA -->
      <div style="display:flex;flex-direction:column;gap:10px;" class="ab-reveal">
        <?php if ($ft['ticket'] && $ft['status'] !== 'sold_out'): ?>
          <a href="<?php echo esc_url($ft['ticket']); ?>" target="_blank" rel="noopener"
             style="display:block;background:#FF4500;color:#fff;font-family:'Barlow Condensed',sans-serif;font-size:16px;font-weight:700;letter-spacing:3px;text-transform:uppercase;padding:20px 40px;border-radius:2px;text-align:center;text-decoration:none;transition:background 0.2s;"
             onmouseover="this.style.background='#CC3600'" onmouseout="this.style.background='#FF4500'">
            Get Tour Tickets →
          </a>
        <?php elseif ($ft['status'] === 'sold_out'): ?>
          <div style="background:#1a1a1a;color:rgba(255,255,255,0.25);font-family:'Barlow Condensed',sans-serif;font-size:16px;font-weight:700;letter-spacing:3px;text-transform:uppercase;padding:20px 40px;border-radius:2px;text-align:center;">Sold Out</div>
        <?php else: ?>
          <div style="background:#1a1a1a;color:rgba(255,255,255,0.25);font-family:'Barlow Condensed',sans-serif;font-size:16px;font-weight:700;letter-spacing:3px;text-transform:uppercase;padding:20px 40px;border-radius:2px;text-align:center;">Tickets Coming Soon</div>
        <?php endif; ?>
        <a href="<?php echo esc_url($ft['permalink']); ?>"
           style="display:block;background:transparent;color:rgba(255,255,255,0.35);font-family:'Barlow Condensed',sans-serif;font-size:13px;font-weight:600;letter-spacing:3px;text-transform:uppercase;padding:14px 40px;border-radius:2px;text-align:center;border:1px solid #1a1a1a;text-decoration:none;"
           onmouseover="this.style.color='#fff';this.style.borderColor='#333'" onmouseout="this.style.color='rgba(255,255,255,0.35)';this.style.borderColor='#1a1a1a'">
          Tour Details
        </a>
      </div>
    </div>
  </div>
</section>
<?php endif; ?>

<?php if ($has_more_upcoming): ?>
<!-- ═══ MORE UPCOMING TOURS ═══ -->
<section style="padding:80px 56px;border-bottom:1px solid #1a1a1a;">
  <div style="display:flex;justify-content:space-between;align-items:flex-end;margin-bottom:48px;" class="ab-reveal">
    <div>
      <div class="ab-section-kicker">On Sale Now</div>
      <div class="ab-section-title">Upcoming Tours</div>
    </div>
  </div>
  <div class="ab-events-grid">
    <?php while ($upcoming_query->have_posts()): $upcoming_query->the_post();
      $start   = get_field('ab_tour_start');
      $cities  = get_field('ab_tour_cities');
      $artist  = get_field('ab_tour_artist');
      $ticket  = get_field('ab_tour_ticket_url');
      $status  = get_field('ab_tour_status');
      $flyer   = get_field('ab_tour_flyer');
      $ddate   = $start ? date('M j, Y', strtotime($start)) : '';
      if ($cities) $ddate .= ' · ' . $cities;
      $link    = $ticket ?: get_permalink();
      $ltxt    = $status === 'sold_out' ? 'Sold Out' : ($ticket ? 'Get Tickets →' : 'Tickets Coming Soon →');
    ?>
      <div class="ab-event-card ab-reveal">
        <div class="ab-event-img-wrap">
          <?php if (!empty($flyer['url'])): ?>
            <img class="ab-event-img" src="<?php echo esc_url($flyer['url']); ?>" alt="<?php the_title_attribute(); ?>" loading="lazy">
          <?php else: ?>
            <div class="ab-event-img-fallback" style="background:linear-gradient(135deg,#000d1a,#001f3f);height:100%;"></div>
          <?php endif; ?>
          <span class="ab-event-tag">Tour</span>
        </div>
        <div class="ab-event-body">
          <div class="ab-event-date"><?php echo esc_html($ddate); ?></div>
          <div class="ab-event-name"><?php the_title(); ?></div>
          <?php if ($artist): ?><div class="ab-event-venue"><?php echo esc_html($artist); ?></div><?php endif; ?>
          <a href="<?php echo esc_url($link); ?>" class="ab-event-link"
             <?php if ($ticket) echo 'target="_blank" rel="noopener"'; ?>>
            <?php echo esc_html($ltxt); ?>
          </a>
        </div>
      </div>
    <?php endwhile; wp_reset_postdata(); ?>
  </div>
</section>
<?php endif; ?>

<!-- ═══ PAST TOURS ═══ -->
<?php if ($past_query->have_posts()): ?>
<section style="padding:80px 56px 120px;background:#060606;">
  <div style="display:flex;justify-content:space-between;align-items:flex-end;margin-bottom:48px;" class="ab-reveal">
    <div>
      <div class="ab-section-kicker">Archive</div>
      <div class="ab-section-title">Past Tours</div>
    </div>
  </div>
  <div class="ab-events-grid">
    <?php while ($past_query->have_posts()): $past_query->the_post();
      $start  = get_field('ab_tour_start');
      $cities = get_field('ab_tour_cities');
      $artist = get_field('ab_tour_artist');
      $flyer  = get_field('ab_tour_flyer');
      $ddate  = $start ? date('M j, Y', strtotime($start)) : '';
      if ($cities) $ddate .= ' · ' . $cities;
    ?>
      <div class="ab-event-card ab-reveal">
        <div class="ab-event-img-wrap">
          <?php if (!empty($flyer['url'])): ?>
            <img class="ab-event-img" src="<?php echo esc_url($flyer['url']); ?>" alt="<?php the_title_attribute(); ?>" loading="lazy">
          <?php else: ?>
            <div class="ab-event-img-fallback" style="background:linear-gradient(135deg,#111,#1a1a1a);height:100%;"></div>
          <?php endif; ?>
          <span class="ab-event-tag" style="background:#333;">Past Tour</span>
        </div>
        <div class="ab-event-body">
          <div class="ab-event-date"><?php echo esc_html($ddate); ?></div>
          <div class="ab-event-name"><?php the_title(); ?></div>
          <?php if ($artist): ?><div class="ab-event-venue"><?php echo esc_html($artist); ?></div><?php endif; ?>
          <a href="<?php the_permalink(); ?>" class="ab-event-link">View Details →</a>
        </div>
      </div>
    <?php endwhile; wp_reset_postdata(); ?>
  </div>
</section>
<?php else: ?>
<!-- No past tours yet -->
<section style="padding:80px 56px 120px;background:#060606;">
  <div class="ab-reveal">
    <div class="ab-section-kicker">Archive</div>
    <div class="ab-section-title" style="margin-bottom:48px;">Past Tours</div>
  </div>
  <div style="padding:80px 0;text-align:center;">
    <div style="font-family:'Bebas Neue',sans-serif;font-size:48px;color:rgba(255,255,255,0.05);letter-spacing:4px;margin-bottom:16px;">MORE TO COME</div>
    <p style="font-size:14px;color:rgba(255,255,255,0.2);">Past tours will appear here as they are added.</p>
  </div>
</section>
<?php endif; ?>

<style>
@media (max-width: 768px) {
  section > div[style*="grid-template-columns:1fr 1fr"] {
    grid-template-columns: 1fr !important;
    min-height: auto !important;
  }
  section > div[style*="grid-template-columns:1fr 1fr"] > div:first-child {
    min-height: 360px !important;
  }
  section > div[style*="grid-template-columns:1fr 1fr"] > div:last-child {
    padding: 40px 24px 60px !important;
  }
  section[style*="padding:80px 56px"] {
    padding: 60px 24px !important;
  }
}
</style>

<?php get_footer(); ?>
