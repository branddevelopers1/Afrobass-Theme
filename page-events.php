<?php get_header(); ?>

<div class="ab-page-hero">
  <div class="ab-page-hero-content">
    <div class="ab-section-kicker ab-reveal">Afrobass Presents</div>
    <h1 class="ab-page-title ab-reveal">Events<br>& Tours</h1>
    <p class="ab-page-subtitle ab-reveal">Concerts, festivals, and national tours — bringing the best Afrobeats talent to cities across Canada.</p>
  </div>
</div>

<section class="ab-events-section" style="padding-top:72px;">

  <?php
  $filter = sanitize_text_field($_GET['filter'] ?? 'upcoming');
  $status_map = [
    'upcoming' => ['upcoming','on_sale'],
    'past'     => ['past','sold_out'],
  ];
  $statuses = $status_map[$filter] ?? $status_map['upcoming'];
  ?>

  <!-- Filter Tabs -->
  <div class="ab-reveal" style="display:flex;gap:0;margin-bottom:56px;border-bottom:1px solid #1a1a1a;">
    <?php foreach (['upcoming'=>'Upcoming','past'=>'Past Events'] as $key=>$label): ?>
      <a href="?filter=<?php echo esc_attr($key); ?>"
         style="font-family:'Barlow Condensed',sans-serif;font-size:13px;font-weight:700;letter-spacing:3px;text-transform:uppercase;padding:16px 32px;border-bottom:2px solid <?php echo $filter===$key ? '#FF4500' : 'transparent'; ?>;color:<?php echo $filter===$key ? '#fff' : 'rgba(255,255,255,0.3)'; ?>;transition:color 0.2s;">
        <?php echo esc_html($label); ?>
      </a>
    <?php endforeach; ?>
  </div>

  <?php
  $query_args = [
    'post_type'      => ['ab_event','ab_tour'],
    'posts_per_page' => 12,
    'meta_query'     => [[
      'relation' => 'OR',
      ['key'=>'ab_event_status','value'=>$statuses,'compare'=>'IN'],
      ['key'=>'ab_tour_status', 'value'=>$statuses,'compare'=>'IN'],
    ]],
    'orderby' => 'meta_value',
    'meta_key'=> 'ab_event_date',
    'order'   => ($filter === 'past') ? 'DESC' : 'ASC',
  ];
  $events = new WP_Query($query_args);
  ?>

  <div class="ab-events-grid">
    <?php if ($events->have_posts()):
      while ($events->have_posts()): $events->the_post();
        $pt      = get_post_type();
        $is_tour = $pt === 'ab_tour';
        $date    = $is_tour ? get_field('ab_tour_start')     : get_field('ab_event_date');
        $venue   = $is_tour ? ''                              : get_field('ab_event_venue');
        $city    = $is_tour ? get_field('ab_tour_cities')     : get_field('ab_event_city');
        $type    = $is_tour ? 'Tour'                          : get_field('ab_event_type');
        $ticket  = $is_tour ? get_field('ab_tour_ticket_url') : get_field('ab_event_ticket_url');
        $status  = $is_tour ? get_field('ab_tour_status')     : get_field('ab_event_status');
        $flyer   = $is_tour ? get_field('ab_tour_flyer')      : get_field('ab_event_flyer');
        $ddate   = ab_format_event_date($date); if ($city) $ddate .= ' · ' . $city;
        $link    = $ticket ?: get_permalink();
        $ltxt    = $status==='sold_out' ? 'Sold Out' : (($filter==='past') ? 'View Recap →' : 'Get Tickets →');
    ?>
      <div class="ab-event-card ab-reveal">
        <div class="ab-event-img-wrap">
          <?php if (!empty($flyer['url'])): ?>
            <img class="ab-event-img" src="<?php echo esc_url($flyer['url']); ?>" alt="<?php the_title_attribute(); ?>" loading="lazy">
          <?php elseif (has_post_thumbnail()): ?>
            <?php the_post_thumbnail('ab-event-thumb',['class'=>'ab-event-img']); ?>
          <?php else: ?>
            <div class="ab-event-img-fallback" style="background:linear-gradient(135deg,#1a0500,#2a0800);height:100%;"></div>
          <?php endif; ?>
          <span class="ab-event-tag"><?php echo esc_html($type ?: 'Event'); ?></span>
          <?php if ($status==='sold_out'): ?><span class="ab-event-status-live" style="background:rgba(255,69,0,0.9);">Sold Out</span><?php endif; ?>
        </div>
        <div class="ab-event-body">
          <div class="ab-event-date"><?php echo esc_html($ddate); ?></div>
          <div class="ab-event-name"><?php the_title(); ?></div>
          <?php if ($venue): ?><div class="ab-event-venue"><?php echo esc_html($venue); ?></div><?php endif; ?>
          <a href="<?php echo esc_url($link); ?>" class="ab-event-link" <?php if($ticket && $filter!=='past') echo 'target="_blank" rel="noopener"'; ?>>
            <?php echo esc_html($ltxt); ?>
          </a>
        </div>
      </div>
    <?php endwhile; wp_reset_postdata();
    else: ?>
      <div style="grid-column:1/-1;padding:80px 0;text-align:center;">
        <div style="font-family:'Bebas Neue',sans-serif;font-size:48px;color:rgba(255,255,255,0.08);letter-spacing:4px;margin-bottom:16px;">
          <?php echo $filter==='past' ? 'NO PAST EVENTS YET' : 'NO UPCOMING EVENTS'; ?>
        </div>
        <p style="font-size:14px;color:rgba(255,255,255,0.25);">
          <?php echo $filter==='past' ? 'Check back soon — your portfolio is being built.' : 'New shows dropping soon. Follow @afrobass to stay updated.'; ?>
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

<?php get_footer(); ?>
