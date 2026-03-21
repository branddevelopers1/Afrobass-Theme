<?php
/**
 * Template Name: Events Page
 * Template Post Type: page
 */
get_header();

// Get the next upcoming event to feature at top
$featured_event = new WP_Query([
  'post_type'      => 'ab_event',
  'posts_per_page' => 1,
  'meta_query'     => [
    'relation' => 'OR',
    ['key'=>'ab_event_status','value'=>['upcoming','on_sale'],'compare'=>'IN'],
    ['key'=>'ab_event_status','compare'=>'NOT EXISTS'],
    ['key'=>'ab_event_status','value'=>'','compare'=>'='],
  ],
  'orderby'  => 'date',
  'order'    => 'DESC',
]);

$filter = sanitize_text_field($_GET['filter'] ?? 'upcoming');
$fe_id  = 0;
?>

<?php if ($featured_event->have_posts() && $filter === 'upcoming'): ?>
<?php
$featured_event->the_post();
$fe_date     = get_field('ab_event_date');
$fe_time     = get_field('ab_event_time');
$fe_venue    = get_field('ab_event_venue');
$fe_city     = get_field('ab_event_city');
$fe_type     = get_field('ab_event_type') ?: 'Concert';
$fe_ticket   = get_field('ab_event_ticket_url');
$fe_status   = get_field('ab_event_status');
$fe_flyer    = get_field('ab_event_flyer');
$fe_artists  = get_field('ab_event_artists');
$fe_capacity = get_field('ab_event_capacity');
$fe_id       = get_the_ID();
$fe_month    = $fe_date ? strtoupper(date('M', strtotime($fe_date))) : '';
$fe_day      = $fe_date ? date('d', strtotime($fe_date)) : '';
$fe_year     = $fe_date ? date('Y', strtotime($fe_date)) : '';
$fe_title    = get_the_title();
$fe_link     = get_permalink();
wp_reset_postdata();
?>

<section style="padding-top:72px;border-bottom:1px solid #1a1a1a;background:#080808;">
  <div style="display:grid;grid-template-columns:1fr 1fr;min-height:88vh;">

    <div style="position:relative;overflow:hidden;background:#0a0a0a;">
      <?php if (!empty($fe_flyer['url'])): ?>
        <img src="<?php echo esc_url($fe_flyer['url']); ?>"
             alt="<?php echo esc_attr($fe_title); ?>"
             style="width:100%;height:100%;object-fit:cover;display:block;opacity:0.9;">
      <?php else: ?>
        <div style="width:100%;height:100%;min-height:600px;background:linear-gradient(135deg,#1a0500,#2d0800);display:flex;align-items:center;justify-content:center;">
          <span style="font-family:'Bebas Neue',sans-serif;font-size:48px;color:rgba(255,69,0,0.15);letter-spacing:4px;text-align:center;padding:40px;"><?php echo esc_html($fe_title); ?></span>
        </div>
      <?php endif; ?>
      <div style="position:absolute;inset:0;background:linear-gradient(to right,transparent 60%,rgba(8,8,8,0.95) 100%);pointer-events:none;"></div>
      <div style="position:absolute;top:32px;left:32px;background:#FF4500;color:#fff;font-family:'Barlow Condensed',sans-serif;font-size:11px;font-weight:700;letter-spacing:2px;text-transform:uppercase;padding:6px 16px;border-radius:2px;">
        <?php echo esc_html($fe_type); ?>
      </div>
    </div>

    <div style="padding:80px 64px;display:flex;flex-direction:column;justify-content:center;position:relative;background:#080808;">
      <div style="position:absolute;top:40px;right:40px;font-family:'Bebas Neue',sans-serif;font-size:120px;color:rgba(255,255,255,0.025);line-height:1;pointer-events:none;user-select:none;"><?php echo esc_html($fe_year); ?></div>

      <div style="display:flex;align-items:center;gap:14px;margin-bottom:20px;">
        <div style="width:32px;height:1px;background:#FF4500;"></div>
        <span style="font-family:'Barlow Condensed',sans-serif;font-size:11px;font-weight:700;letter-spacing:4px;text-transform:uppercase;color:#FF4500;">Next Up</span>
      </div>

      <h1 style="font-family:'Bebas Neue',sans-serif;font-size:clamp(40px,5vw,68px);letter-spacing:2px;line-height:0.92;color:#fff;text-transform:uppercase;margin-bottom:32px;">
        <?php echo esc_html($fe_title); ?>
      </h1>

      <?php if ($fe_date): ?>
      <div style="display:flex;align-items:flex-start;gap:20px;margin-bottom:32px;padding:24px 0;border-top:1px solid #1a1a1a;border-bottom:1px solid #1a1a1a;">
        <div style="text-align:center;min-width:64px;">
          <div style="font-family:'Bebas Neue',sans-serif;font-size:11px;letter-spacing:3px;color:#FF4500;margin-bottom:4px;"><?php echo esc_html($fe_month); ?></div>
          <div style="font-family:'Bebas Neue',sans-serif;font-size:52px;line-height:1;color:#fff;"><?php echo esc_html($fe_day); ?></div>
          <div style="font-family:'Barlow Condensed',sans-serif;font-size:11px;letter-spacing:2px;color:rgba(255,255,255,0.3);"><?php echo esc_html($fe_year); ?></div>
        </div>
        <div style="padding-left:20px;border-left:1px solid #1a1a1a;">
          <?php if ($fe_time): ?>
            <div style="font-family:'Barlow Condensed',sans-serif;font-size:13px;font-weight:600;letter-spacing:2px;text-transform:uppercase;color:rgba(255,255,255,0.4);margin-bottom:6px;"><?php echo esc_html($fe_time); ?></div>
          <?php endif; ?>
          <?php if ($fe_venue): ?>
            <div style="font-family:'Barlow Condensed',sans-serif;font-size:20px;font-weight:700;letter-spacing:1px;text-transform:uppercase;color:#fff;margin-bottom:4px;"><?php echo esc_html($fe_venue); ?></div>
          <?php endif; ?>
          <?php if ($fe_city): ?>
            <div style="font-size:14px;font-weight:300;color:rgba(255,255,255,0.4);"><?php echo esc_html($fe_city); ?></div>
          <?php endif; ?>
        </div>
      </div>
      <?php endif; ?>

      <?php if ($fe_artists): ?>
      <div style="margin-bottom:32px;">
        <div style="font-family:'Barlow Condensed',sans-serif;font-size:10px;font-weight:700;letter-spacing:3px;text-transform:uppercase;color:rgba(255,255,255,0.25);margin-bottom:10px;">Featuring</div>
        <div style="font-family:'Barlow Condensed',sans-serif;font-size:18px;font-weight:700;letter-spacing:1px;text-transform:uppercase;color:rgba(255,255,255,0.7);"><?php echo esc_html($fe_artists); ?></div>
      </div>
      <?php endif; ?>

      <div style="display:flex;flex-direction:column;gap:12px;">
        <?php if ($fe_ticket && $fe_status !== 'sold_out'): ?>
          <a href="<?php echo esc_url($fe_ticket); ?>" target="_blank" rel="noopener"
             style="display:block;background:#FF4500;color:#fff;font-family:'Barlow Condensed',sans-serif;font-size:16px;font-weight:700;letter-spacing:3px;text-transform:uppercase;padding:20px 40px;border-radius:2px;text-align:center;text-decoration:none;"
             onmouseover="this.style.background='#CC3600'" onmouseout="this.style.background='#FF4500'">
            Buy Tickets Now →
          </a>
          <a href="<?php echo esc_url($fe_link); ?>"
             style="display:block;background:transparent;color:rgba(255,255,255,0.4);font-family:'Barlow Condensed',sans-serif;font-size:13px;font-weight:600;letter-spacing:3px;text-transform:uppercase;padding:14px 40px;border-radius:2px;text-align:center;border:1px solid #1a1a1a;text-decoration:none;"
             onmouseover="this.style.color='#fff';this.style.borderColor='#333'" onmouseout="this.style.color='rgba(255,255,255,0.4)';this.style.borderColor='#1a1a1a'">
            Event Details
          </a>
        <?php elseif ($fe_status === 'sold_out'): ?>
          <div style="background:#1a1a1a;color:rgba(255,255,255,0.3);font-family:'Barlow Condensed',sans-serif;font-size:16px;font-weight:700;letter-spacing:3px;text-transform:uppercase;padding:20px 40px;border-radius:2px;text-align:center;">Sold Out</div>
          <a href="<?php echo esc_url($fe_link); ?>" style="display:block;text-align:center;font-family:'Barlow Condensed',sans-serif;font-size:13px;font-weight:600;letter-spacing:3px;text-transform:uppercase;color:rgba(255,255,255,0.3);text-decoration:none;padding:14px;">Event Details →</a>
        <?php else: ?>
          <div style="background:#1a1a1a;color:rgba(255,255,255,0.3);font-family:'Barlow Condensed',sans-serif;font-size:16px;font-weight:700;letter-spacing:3px;text-transform:uppercase;padding:20px 40px;border-radius:2px;text-align:center;">Tickets Coming Soon</div>
          <a href="<?php echo esc_url($fe_link); ?>"
             style="display:block;background:transparent;color:rgba(255,255,255,0.4);font-family:'Barlow Condensed',sans-serif;font-size:13px;font-weight:600;letter-spacing:3px;text-transform:uppercase;padding:14px 40px;border-radius:2px;text-align:center;border:1px solid #1a1a1a;text-decoration:none;">
            Event Details
          </a>
        <?php endif; ?>
      </div>

      <?php if ($fe_capacity): ?>
      <div style="margin-top:24px;display:flex;align-items:center;gap:8px;">
        <div style="width:6px;height:6px;border-radius:50%;background:#FF4500;"></div>
        <span style="font-family:'Barlow Condensed',sans-serif;font-size:11px;font-weight:600;letter-spacing:2px;text-transform:uppercase;color:rgba(255,255,255,0.2);">Venue Capacity: <?php echo esc_html($fe_capacity); ?></span>
      </div>
      <?php endif; ?>
    </div>
  </div>
</section>

<?php endif; ?>

<section style="padding:80px 56px 120px;background:#080808;">

  <div style="display:flex;gap:0;margin-bottom:56px;border-bottom:1px solid #1a1a1a;">
    <?php foreach (['upcoming'=>'Upcoming','past'=>'Past Events'] as $key=>$label): ?>
      <a href="?filter=<?php echo esc_attr($key); ?>"
         style="font-family:'Barlow Condensed',sans-serif;font-size:13px;font-weight:700;letter-spacing:3px;text-transform:uppercase;padding:16px 32px;border-bottom:2px solid <?php echo $filter===$key ? '#FF4500' : 'transparent'; ?>;color:<?php echo $filter===$key ? '#fff' : 'rgba(255,255,255,0.3)'; ?>;text-decoration:none;display:inline-block;">
        <?php echo esc_html($label); ?>
      </a>
    <?php endforeach; ?>
  </div>

  <div style="margin-bottom:40px;">
    <div class="ab-section-kicker"><?php echo $filter === 'past' ? 'Archive' : 'On Sale Now'; ?></div>
    <div class="ab-section-title"><?php echo $filter === 'past' ? 'Past Events' : 'All Upcoming Events'; ?></div>
  </div>

  <?php
  $exclude_id = ($filter === 'upcoming' && !empty($fe_id)) ? [$fe_id] : [];
  $meta_clause = $filter === 'past'
    ? ['key'=>'ab_event_status','value'=>['past','sold_out'],'compare'=>'IN']
    : ['key'=>'ab_event_status','value'=>['upcoming','on_sale'],'compare'=>'IN'];

  $events = new WP_Query([
    'post_type'      => 'ab_event',
    'posts_per_page' => 12,
    'post__not_in'   => $exclude_id,
    'meta_query'     => ['relation'=>'OR', $meta_clause, ['key'=>'ab_event_status','compare'=>'NOT EXISTS']],
    'orderby'        => 'date',
    'order'          => $filter === 'past' ? 'DESC' : 'ASC',
  ]);
  ?>

  <div class="ab-events-grid">
    <?php if ($events->have_posts()):
      while ($events->have_posts()): $events->the_post();
        $date   = get_field('ab_event_date');
        $venue  = get_field('ab_event_venue');
        $city   = get_field('ab_event_city');
        $type   = get_field('ab_event_type') ?: 'Event';
        $ticket = get_field('ab_event_ticket_url');
        $status = get_field('ab_event_status');
        $flyer  = get_field('ab_event_flyer');
        $ddate  = $date ? date('M j, Y', strtotime($date)) : '';
        if ($city) $ddate .= ' · ' . $city;
        $link   = $ticket ?: get_permalink();
        $ltxt   = $status === 'sold_out' ? 'Sold Out' : ($filter === 'past' ? 'View Recap →' : ($ticket ? 'Get Tickets →' : 'Tickets Coming Soon →'));
    ?>
      <div class="ab-event-card ab-reveal">
        <div class="ab-event-img-wrap">
          <?php if (!empty($flyer['url'])): ?>
            <img class="ab-event-img" src="<?php echo esc_url($flyer['url']); ?>" alt="<?php the_title_attribute(); ?>" loading="lazy">
          <?php elseif (has_post_thumbnail()): ?>
            <?php the_post_thumbnail('ab-event-thumb', ['class'=>'ab-event-img']); ?>
          <?php else: ?>
            <div class="ab-event-img-fallback" style="background:linear-gradient(135deg,#1a0500,#2a0800);height:100%;"></div>
          <?php endif; ?>
          <span class="ab-event-tag"><?php echo esc_html($type); ?></span>
          <?php if ($status === 'sold_out'): ?>
            <span class="ab-event-status-live" style="background:rgba(100,100,100,0.9);">Sold Out</span>
          <?php endif; ?>
        </div>
        <div class="ab-event-body">
          <div class="ab-event-date"><?php echo esc_html($ddate); ?></div>
          <div class="ab-event-name"><?php the_title(); ?></div>
          <?php if ($venue): ?><div class="ab-event-venue"><?php echo esc_html($venue); ?></div><?php endif; ?>
          <a href="<?php echo esc_url($link); ?>" class="ab-event-link"
             <?php if ($ticket && $filter !== 'past') echo 'target="_blank" rel="noopener"'; ?>>
            <?php echo esc_html($ltxt); ?>
          </a>
        </div>
      </div>
    <?php endwhile; wp_reset_postdata();
    else: ?>
      <div style="grid-column:1/-1;padding:80px 0;text-align:center;">
        <div style="font-family:'Bebas Neue',sans-serif;font-size:48px;color:rgba(255,255,255,0.06);letter-spacing:4px;margin-bottom:16px;">
          <?php echo $filter === 'past' ? 'NO PAST EVENTS YET' : 'MORE EVENTS DROPPING SOON'; ?>
        </div>
        <p style="font-size:14px;color:rgba(255,255,255,0.2);">
          <?php echo $filter === 'past' ? 'Your event archive will build up over time.' : 'Follow @afrobass to stay updated on new announcements.'; ?>
        </p>
      </div>
    <?php endif; ?>
  </div>

  <?php if ($events->max_num_pages > 1): ?>
    <div style="text-align:center;margin-top:64px;">
      <?php echo paginate_links(['total'=>$events->max_num_pages,'type'=>'list']); ?>
    </div>
  <?php endif; ?>

</section>

<style>
@media (max-width: 768px) {
  section > div[style*="grid-template-columns:1fr 1fr"] { grid-template-columns:1fr !important; }
  section > div[style*="grid-template-columns:1fr 1fr"] > div:first-child { min-height:380px !important; }
  section > div[style*="grid-template-columns:1fr 1fr"] > div:last-child { padding:40px 24px 60px !important; }
}
</style>

<?php get_footer(); ?>
