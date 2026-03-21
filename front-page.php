<?php get_header(); ?>

<?php
// ACF Homepage fields
$hero_line1  = get_field('ab_hero_headline') ?: 'We Bring';
$hero_accent = get_field('ab_hero_accent')   ?: 'Africa';
$hero_line3  = get_field('ab_hero_line3')    ?: 'To the World';
$hero_sub    = get_field('ab_hero_subtext')  ?: 'Afrobass produces world-class concerts, tours, and live events across Canada — connecting the best of African music and culture with North American audiences since 2018.';
$hero_video  = get_field('ab_hero_video');
$story_video = get_field('ab_story_video');
$story_body  = get_field('ab_story_body')    ?: '';
$milestones  = get_field('ab_milestones')    ?: [];
$phone       = ab_setting('ab_phone')  ?: '416.846.6483';
$email       = ab_setting('ab_email')  ?: 'contact@afrobass.com';
?>

<!-- ═══════════════════════════════════════════
     HERO
═══════════════════════════════════════════ -->
<section id="ab-hero" aria-label="Hero">
  <div id="ab-hero-video-wrap">
    <?php if (!empty($hero_video['url'])): ?>
      <video id="ab-hero-video" autoplay muted loop playsinline>
        <source src="<?php echo esc_url($hero_video['url']); ?>" type="video/mp4">
      </video>
    <?php else: ?>
      <div class="ab-hero-fallback"></div>
    <?php endif; ?>
    <div class="ab-hero-grain"></div>
  </div>
  <div class="ab-hero-overlay"></div>
  <div class="ab-hero-overlay-left"></div>

  <div id="ab-hero-content">
    <div class="ab-hero-eyebrow">
      <div class="ab-hero-eyebrow-line"></div>
      <span class="ab-hero-eyebrow-text">Canada's Premier Event Producer</span>
    </div>
    <h1 class="ab-hero-h1 ab-parallax" data-speed="0.15">
      <?php echo esc_html($hero_line1); ?><br>
      <span class="ab-accent"><?php echo esc_html($hero_accent); ?></span><br>
      <span class="ab-outline"><?php echo esc_html($hero_line3); ?></span>
    </h1>
    <p class="ab-hero-desc"><?php echo esc_html($hero_sub); ?></p>
    <div class="ab-hero-actions">
      <a href="<?php echo esc_url(home_url('/events')); ?>" class="ab-btn-hero-primary">Upcoming Events</a>
      <a href="<?php echo esc_url(home_url('/book-talent')); ?>" class="ab-btn-hero-secondary">
        <div class="ab-arrow-circle">↗</div>
        Book an Artist
      </a>
    </div>
  </div>

  <div class="ab-scroll-indicator" aria-hidden="true">
    <div class="ab-scroll-line"></div>
    <span class="ab-scroll-text">Scroll</span>
  </div>
</section>

<!-- ═══════════════════════════════════════════
     TICKER
═══════════════════════════════════════════ -->
<div class="ab-ticker" aria-hidden="true">
  <div class="ab-ticker-track">
    <?php for ($i = 0; $i < 2; $i++): ?>
    <div class="ab-ticker-item">
      Afrobeats <span class="ab-ticker-sep">✦</span>
      Amapiano <span class="ab-ticker-sep">✦</span>
      Afro-Caribbean <span class="ab-ticker-sep">✦</span>
      Live Concerts <span class="ab-ticker-sep">✦</span>
      Talent Booking <span class="ab-ticker-sep">✦</span>
      Canada Tours <span class="ab-ticker-sep">✦</span>
      Toronto · Vancouver · Ottawa <span class="ab-ticker-sep">✦</span>
      Afrobass Inc. <span class="ab-ticker-sep">✦</span>
      Est. 2018 <span class="ab-ticker-sep">✦</span>
    </div>
    <?php endfor; ?>
  </div>
</div>

<!-- ═══════════════════════════════════════════
     STATS
═══════════════════════════════════════════ -->
<div class="ab-stats">
  <div class="ab-stat-block ab-reveal">
    <div class="ab-stat-num"><span class="ab-count-up" data-target="50">0</span><span class="ab-orange">+</span></div>
    <div class="ab-stat-label">Events Produced</div>
  </div>
  <div class="ab-stat-block ab-reveal ab-delay-1">
    <div class="ab-stat-num"><span class="ab-count-up" data-target="3700">0</span><span class="ab-orange">+</span></div>
    <div class="ab-stat-label">Attendees Hosted</div>
  </div>
  <div class="ab-stat-block ab-reveal ab-delay-2">
    <div class="ab-stat-num">20<span class="ab-orange">18</span></div>
    <div class="ab-stat-label">Est. in Canada</div>
  </div>
  <div class="ab-stat-block ab-reveal ab-delay-3">
    <div class="ab-count-up ab-stat-num" data-target="10"><span class="ab-count-up" data-target="10">0</span><span class="ab-orange">+</span></div>
    <div class="ab-stat-label">Cities Reached</div>
  </div>
</div>

<!-- ═══════════════════════════════════════════
     SERVICES
═══════════════════════════════════════════ -->
<section class="ab-services-section" id="services">
  <div class="ab-services-header">
    <div class="ab-reveal">
      <div class="ab-section-kicker">What We Do</div>
      <div class="ab-section-title">Full-Service<br>Live Entertainment</div>
    </div>
    <p class="ab-services-subtitle ab-reveal ab-delay-2">From concept to curtain call — we handle every detail of bringing Afrobeats culture to Canadian audiences.</p>
  </div>
  <div class="ab-services-grid">
    <div class="ab-svc-card ab-reveal">
      <div class="ab-svc-num">01</div>
      <div class="ab-svc-icon"><svg viewBox="0 0 52 52" fill="none"><circle cx="26" cy="26" r="18" stroke="#FF4500" stroke-width="1.5"/><polygon points="22,18 36,26 22,34" fill="#FF4500"/></svg></div>
      <div class="ab-svc-title">Concert Production</div>
      <div class="ab-svc-desc">End-to-end production for sold-out shows. Staging, sound, promotion, and execution from first ticket to final bow.</div>
    </div>
    <div class="ab-svc-card ab-reveal ab-delay-1">
      <div class="ab-svc-num">02</div>
      <div class="ab-svc-icon"><svg viewBox="0 0 52 52" fill="none"><path d="M10 26 L42 26 M32 14 L42 26 L32 38" stroke="#FF4500" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><circle cx="10" cy="26" r="3" fill="#FF4500"/></svg></div>
      <div class="ab-svc-title">Artist Tours</div>
      <div class="ab-svc-desc">National multi-city tours with full routing, marketing strategy, venue sourcing, and on-the-ground management.</div>
    </div>
    <div class="ab-svc-card ab-reveal ab-delay-2">
      <div class="ab-svc-num">03</div>
      <div class="ab-svc-icon"><svg viewBox="0 0 52 52" fill="none"><path d="M26 10 L30 20 L42 21 L34 29 L36 41 L26 35 L16 41 L18 29 L10 21 L22 20 Z" stroke="#FF4500" stroke-width="1.5" stroke-linejoin="round"/></svg></div>
      <div class="ab-svc-title">Talent Booking</div>
      <div class="ab-svc-desc">Direct relationships with Africa's biggest artists. We make the connection — and bring them to Canada.</div>
    </div>
    <div class="ab-svc-card ab-reveal ab-delay-3">
      <div class="ab-svc-num">04</div>
      <div class="ab-svc-icon"><svg viewBox="0 0 52 52" fill="none"><rect x="10" y="18" width="32" height="22" rx="2" stroke="#FF4500" stroke-width="1.5"/><path d="M18 18 L18 12 L34 12 L34 18" stroke="#FF4500" stroke-width="1.5" stroke-linecap="round"/><line x1="26" y1="25" x2="26" y2="33" stroke="#FF4500" stroke-width="1.5" stroke-linecap="round"/><line x1="22" y1="29" x2="30" y2="29" stroke="#FF4500" stroke-width="1.5" stroke-linecap="round"/></svg></div>
      <div class="ab-svc-title">Brand Partnerships</div>
      <div class="ab-svc-desc">Custom sponsorship and activation packages that place your brand inside the culture, not just beside it.</div>
    </div>
  </div>
</section>

<!-- ═══════════════════════════════════════════
     OUR STORY
═══════════════════════════════════════════ -->
<section class="ab-story-section" id="story">
  <div class="ab-story-video-side">
    <div class="ab-story-video-inner">
      <?php if (!empty($story_video['url'])): ?>
        <video autoplay muted loop playsinline>
          <source src="<?php echo esc_url($story_video['url']); ?>" type="video/mp4">
        </video>
      <?php endif; ?>
      <div class="ab-story-video-fallback"></div>
    </div>
    <div class="ab-story-video-overlay"></div>
    <div class="ab-story-video-ui">
      <div class="ab-story-play" aria-label="Watch our story">
        <div class="ab-play-tri"></div>
      </div>
      <span class="ab-story-play-label">Watch Our Story</span>
    </div>
  </div>

  <div class="ab-story-content">
    <div class="ab-story-watermark" aria-hidden="true">2018</div>
    <div class="ab-section-kicker ab-reveal">Our Story</div>
    <div class="ab-section-title ab-reveal">Built on<br>Culture &<br>Community</div>

    <div class="ab-story-body ab-reveal">
      <?php if ($story_body): ?>
        <?php echo wp_kses_post($story_body); ?>
      <?php else: ?>
        What started as a <strong>passion for Afrobeats</strong> in 2018 has grown into Canada's most trusted Afrobeats production company. We've toured artists coast to coast, sold out venues from 500 to 2,300 people, and built a community of fans who show up every single time.
        <br><br>
        Our founder Kay O built Afrobass from the ground up — with nothing but hustle, deep roots in the music, and a vision: <strong>bring the world-class sound of African music to every major city in Canada.</strong>
      <?php endif; ?>
    </div>

    <div class="ab-milestones ab-reveal">
      <?php
      $default_milestones = [
        ['year'=>'2018','text'=>'<strong>Founded</strong> — First events with DJ Ecool (Davido\'s DJ) and DJ Tunez (Wizkid\'s DJ). Canada Tour with Afro B.'],
        ['year'=>'2022','text'=>'<strong>Scale-Up</strong> — Teni in Toronto, She\'s Afrique, Pop w/ Mayorkun. Multiple sold-out venues.'],
        ['year'=>'2023','text'=>'<strong>Blaq Bonez Toronto</strong> — El Mocambo 500 sold out. CP24 interview. WSTRN Concert at The Opera House, 900 sold out.'],
        ['year'=>'2025','text'=>'<strong>Afrobass Music Festival</strong> — Queen Elizabeth Theatre, 2,300 cap. Headliners: Oxlade, Victony, DJ Tunez.'],
      ];
      $items = !empty($milestones) ? $milestones : $default_milestones;
      foreach ($items as $ms): ?>
        <div class="ab-milestone">
          <div class="ab-milestone-year"><?php echo esc_html($ms['year']); ?></div>
          <div class="ab-milestone-text"><?php echo wp_kses_post($ms['text']); ?></div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ═══════════════════════════════════════════
     UPCOMING EVENTS
═══════════════════════════════════════════ -->
<section class="ab-events-section" id="events">
  <div class="ab-events-header">
    <div class="ab-reveal">
      <div class="ab-section-kicker">On Sale Now</div>
      <div class="ab-section-title">Upcoming Events<br>& Tours</div>
    </div>
    <a href="<?php echo esc_url(home_url('/events')); ?>" class="ab-view-all ab-reveal">
      View All Events <span class="ab-arr">→</span>
    </a>
  </div>

  <div class="ab-events-grid">
    <?php
    $upcoming = new WP_Query([
      'post_type'      => ['ab_event','ab_tour'],
      'posts_per_page' => 3,
      'meta_query'     => [
        'relation' => 'OR',
        ['key'=>'ab_event_status','value'=>['upcoming','on_sale'],'compare'=>'IN'],
        ['key'=>'ab_tour_status', 'value'=>['upcoming','on_sale'],'compare'=>'IN'],
        ['key'=>'ab_event_status','compare'=>'NOT EXISTS'],
        ['key'=>'ab_event_status','value'=>'','compare'=>'='],
      ],
      'orderby' => 'date',
      'order'   => 'DESC',
    ]);

    if ($upcoming->have_posts()):
      while ($upcoming->have_posts()): $upcoming->the_post();
        $pt      = get_post_type();
        $is_tour = ($pt === 'ab_tour');
        $date    = $is_tour ? get_field('ab_tour_start')      : get_field('ab_event_date');
        $venue   = $is_tour ? ''                               : get_field('ab_event_venue');
        $city    = $is_tour ? get_field('ab_tour_cities')      : get_field('ab_event_city');
        $type    = $is_tour ? 'Tour'                           : get_field('ab_event_type');
        $ticket  = $is_tour ? get_field('ab_tour_ticket_url')  : get_field('ab_event_ticket_url');
        $status  = $is_tour ? get_field('ab_tour_status')      : get_field('ab_event_status');
        $flyer   = $is_tour ? get_field('ab_tour_flyer')       : get_field('ab_event_flyer');
        $display_date = ab_format_event_date($date);
        if ($city) $display_date .= ' · ' . $city;
        $link = $ticket ?: get_permalink();
        $link_text = ($status === 'sold_out') ? 'Sold Out' : ($ticket ? 'Get Tickets →' : 'Tickets Coming Soon →');
    ?>
      <div class="ab-event-card ab-reveal">
        <div class="ab-event-img-wrap">
          <?php if (!empty($flyer['url'])): ?>
            <img class="ab-event-img" src="<?php echo esc_url($flyer['url']); ?>" alt="<?php the_title_attribute(); ?>">
          <?php elseif (has_post_thumbnail()): ?>
            <?php the_post_thumbnail('ab-event-thumb', ['class'=>'ab-event-img','alt'=>get_the_title()]); ?>
          <?php else: ?>
            <div class="ab-event-img-fallback" style="background:linear-gradient(135deg,#1a0500,#2a0800);height:100%;"></div>
          <?php endif; ?>
          <span class="ab-event-tag"><?php echo esc_html($type ?: ($is_tour ? 'Tour' : 'Event')); ?></span>
          <?php if ($status === 'sold_out'): ?>
            <span class="ab-event-status-live">Sold Out</span>
          <?php endif; ?>
        </div>
        <div class="ab-event-body">
          <div class="ab-event-date"><?php echo esc_html($display_date); ?></div>
          <div class="ab-event-name"><?php the_title(); ?></div>
          <?php if ($venue): ?><div class="ab-event-venue"><?php echo esc_html($venue); ?></div><?php endif; ?>
          <a href="<?php echo esc_url($link); ?>" class="ab-event-link" <?php if($ticket) echo 'target="_blank" rel="noopener"'; ?>>
            <?php echo esc_html($link_text); ?>
          </a>
        </div>
      </div>
    <?php
      endwhile; wp_reset_postdata();
    else:
      // Fallback placeholder cards if no events yet
      $placeholders = [
        ['type'=>'Tour','date'=>'Aug 2025 · Toronto, ON','name'=>'DJ Spinall — Motion Tour','venue'=>'Caribana Weekend','link'=>'#','link_text'=>'Get Tickets →','bg'=>'linear-gradient(135deg,#1a0500,#3d1000)'],
        ['type'=>'Festival','date'=>'Sept 2025 · Toronto, ON','name'=>'Afrobass Music Festival','venue'=>'Queen Elizabeth Theatre · 2,300 Cap.','link'=>'#','link_text'=>'Tickets Coming Soon →','bg'=>'linear-gradient(135deg,#0a0510,#1a0030)'],
        ['type'=>'Tour','date'=>'Fall 2025 · Canada','name'=>'National Afrobeats Tour','venue'=>'Toronto · Vancouver · Ottawa','link'=>'#','link_text'=>'Announcement Soon →','bg'=>'linear-gradient(135deg,#001a10,#003525)'],
      ];
      foreach ($placeholders as $p): ?>
        <div class="ab-event-card ab-reveal">
          <div class="ab-event-img-wrap">
            <div class="ab-event-img-fallback" style="background:<?php echo esc_attr($p['bg']); ?>;height:100%;display:flex;align-items:center;justify-content:center;">
              <span style="font-family:'Bebas Neue',sans-serif;font-size:28px;color:rgba(255,255,255,0.07);letter-spacing:4px;text-transform:uppercase;text-align:center;padding:20px;"><?php echo esc_html($p['name']); ?></span>
            </div>
            <span class="ab-event-tag"><?php echo esc_html($p['type']); ?></span>
          </div>
          <div class="ab-event-body">
            <div class="ab-event-date"><?php echo esc_html($p['date']); ?></div>
            <div class="ab-event-name"><?php echo esc_html($p['name']); ?></div>
            <div class="ab-event-venue"><?php echo esc_html($p['venue']); ?></div>
            <a href="<?php echo esc_url($p['link']); ?>" class="ab-event-link"><?php echo esc_html($p['link_text']); ?></a>
          </div>
        </div>
      <?php endforeach;
    endif; ?>
  </div>

  <!-- Past Events Sub-row -->
  <?php
  $past = new WP_Query([
    'post_type'      => 'ab_event',
    'posts_per_page' => 3,
    'meta_query'     => [['key'=>'ab_event_status','value'=>'past','compare'=>'=']],
    'orderby'        => 'meta_value',
    'meta_key'       => 'ab_event_date',
    'order'          => 'DESC',
  ]);
  if ($past->have_posts()):
  ?>
    <div class="ab-past-label">Past Events</div>
    <div class="ab-past-events-grid">
      <?php while ($past->have_posts()): $past->the_post();
        $flyer = get_field('ab_event_flyer');
        $date  = get_field('ab_event_date');
        $city  = get_field('ab_event_city');
        $disp  = ab_format_event_date($date); if ($city) $disp .= ' · '.$city;
      ?>
        <div class="ab-event-card ab-reveal">
          <div class="ab-event-img-wrap">
            <?php if (!empty($flyer['url'])): ?>
              <img class="ab-event-img" src="<?php echo esc_url($flyer['url']); ?>" alt="<?php the_title_attribute(); ?>">
            <?php elseif (has_post_thumbnail()): ?>
              <?php the_post_thumbnail('ab-event-thumb', ['class'=>'ab-event-img']); ?>
            <?php else: ?>
              <div class="ab-event-img-fallback" style="background:#111;height:100%;"></div>
            <?php endif; ?>
            <span class="ab-event-tag" style="background:#333;">Past</span>
          </div>
          <div class="ab-event-body">
            <div class="ab-event-date"><?php echo esc_html($disp); ?></div>
            <div class="ab-event-name"><?php the_title(); ?></div>
            <a href="<?php the_permalink(); ?>" class="ab-event-link">View Recap →</a>
          </div>
        </div>
      <?php endwhile; wp_reset_postdata(); ?>
    </div>
  <?php endif; ?>
</section>

<!-- ═══════════════════════════════════════════
     VIDEO RECAPS
═══════════════════════════════════════════ -->
<section class="ab-recaps-section" id="recaps">
  <div class="ab-recaps-header">
    <div class="ab-reveal">
      <div class="ab-section-kicker">Relive the Experience</div>
      <div class="ab-section-title">Past Event<br>Recaps</div>
    </div>
    <a href="<?php echo esc_url(home_url('/recaps')); ?>" class="ab-view-all ab-reveal">
      All Videos <span class="ab-arr">→</span>
    </a>
  </div>

  <div class="ab-recaps-grid">
    <?php
    $recaps = new WP_Query(['post_type'=>'ab_recap','posts_per_page'=>3,'orderby'=>'date','order'=>'DESC']);
    $recap_count = 0;
    $default_recaps = [
      ['event'=>'Blaq Bonez Live — Toronto','detail'=>'El Mocambo · 500 Sold Out · CP24 Featured','year'=>'May 2023','bg'=>'linear-gradient(135deg,#1a0500,#3d1000)','featured'=>true],
      ['event'=>'WSTRN Concert','detail'=>'Opera House · 900 Sold Out','year'=>'Oct 2023','bg'=>'linear-gradient(135deg,#00101a,#003040)','featured'=>false],
      ['event'=>'Teni the Entertainer','detail'=>'Toronto · Sold Out','year'=>'2022','bg'=>'linear-gradient(135deg,#0d0018,#2a0050)','featured'=>false],
    ];

    if ($recaps->have_posts()):
      while ($recaps->have_posts()): $recaps->the_post();
        $yt       = get_field('ab_recap_youtube');
        $thumb    = get_field('ab_recap_thumb');
        $ev_name  = get_field('ab_recap_event')  ?: get_the_title();
        $detail   = get_field('ab_recap_detail') ?: '';
        $year     = get_field('ab_recap_year')   ?: '';
        $featured = (bool)get_field('ab_recap_featured') || $recap_count === 0;
        $embed    = ab_youtube_embed($yt);
        $card_class = 'ab-recap-card ab-reveal' . ($recap_count > 0 ? ' ab-delay-' . $recap_count : '');
        $thumb_class = $featured ? 'ab-recap-thumb' : 'ab-recap-thumb ab-recap-thumb-sm';
        $data_video  = $embed ? ' data-video="' . esc_attr($embed) . '"' : '';
    ?>
        <div class="<?php echo esc_attr($card_class); ?>" <?php echo $data_video; ?> style="cursor:pointer;">
          <div class="<?php echo esc_attr($thumb_class); ?>">
            <div class="ab-recap-bg" style="<?php echo !empty($thumb['url']) ? 'background:url('.esc_url($thumb['url']).') center/cover;' : 'background:linear-gradient(135deg,#1a0500,#2a0800);'; ?>">
              <?php if (empty($thumb['url'])): ?>
                <div class="ab-recap-bg-text"><?php echo esc_html($ev_name); ?></div>
              <?php endif; ?>
            </div>
            <div class="ab-recap-play-wrap"><div class="ab-play-btn"><div class="ab-play-tri"></div></div></div>
            <?php if ($year): ?><div class="ab-recap-year"><?php echo esc_html($year); ?></div><?php endif; ?>
          </div>
          <div class="ab-recap-info">
            <div class="ab-recap-title"><?php echo esc_html($ev_name); ?></div>
            <div class="ab-recap-detail"><?php echo esc_html($detail); ?></div>
          </div>
        </div>
    <?php $recap_count++; endwhile; wp_reset_postdata();
    else:
      foreach ($default_recaps as $i => $r):
        $card_class = 'ab-recap-card ab-reveal' . ($i > 0 ? ' ab-delay-' . $i : '');
        $thumb_class = $r['featured'] ? 'ab-recap-thumb' : 'ab-recap-thumb ab-recap-thumb-sm';
    ?>
        <div class="<?php echo esc_attr($card_class); ?>">
          <div class="<?php echo esc_attr($thumb_class); ?>">
            <div class="ab-recap-bg" style="background:<?php echo esc_attr($r['bg']); ?>;">
              <div class="ab-recap-bg-text"><?php echo esc_html($r['event']); ?></div>
            </div>
            <div class="ab-recap-play-wrap"><div class="ab-play-btn"><div class="ab-play-tri"></div></div></div>
            <div class="ab-recap-year"><?php echo esc_html($r['year']); ?></div>
          </div>
          <div class="ab-recap-info">
            <div class="ab-recap-title"><?php echo esc_html($r['event']); ?></div>
            <div class="ab-recap-detail"><?php echo esc_html($r['detail']); ?></div>
          </div>
        </div>
    <?php endforeach; endif; ?>
  </div>
</section>

<!-- ═══════════════════════════════════════════
     FLYER MARQUEE
═══════════════════════════════════════════ -->
<section class="ab-flyers-section" id="portfolio">
  <div class="ab-flyers-header">
    <div class="ab-reveal">
      <div class="ab-section-kicker">Our Portfolio</div>
      <div class="ab-section-title">Past Events</div>
    </div>
    <a href="<?php echo esc_url(home_url('/events?filter=past')); ?>" class="ab-view-all ab-reveal">
      View All <span class="ab-arr">→</span>
    </a>
  </div>

  <div class="ab-flyers-marquee ab-reveal">
    <div class="ab-flyers-track">
      <?php
      // Build flyer list from past events CPT + fallback to known WP image URLs
      $flyer_events = new WP_Query(['post_type'=>'ab_event','posts_per_page'=>12,'meta_query'=>[['key'=>'ab_event_status','value'=>'past']]]);
      $flyer_items = [];

      if ($flyer_events->have_posts()):
        while ($flyer_events->have_posts()): $flyer_events->the_post();
          $f = get_field('ab_event_flyer') ?: [];
          $flyer_items[] = ['url' => !empty($f['url']) ? $f['url'] : '', 'name' => get_the_title(), 'bg' => '#1a0800'];
        endwhile; wp_reset_postdata();
      endif;

      // Always include known real flyers as fallback / supplement
      $known_flyers = [
        ['url'=>'http://afrobass.com/wp-content/uploads/2022/11/Shes-Afrique-with-DJ-Tunez.png','name'=>"She's Afrique",'bg'=>'#1a0800'],
        ['url'=>'http://afrobass.com/wp-content/uploads/2022/11/mayorkun-full.png','name'=>'Pop w/ Mayorkun','bg'=>'#0a1a00'],
        ['url'=>'http://afrobass.com/wp-content/uploads/2022/11/Teni-April-27th.png','name'=>'Teni in Toronto','bg'=>'#00101a'],
        ['url'=>'https://afrobass.com/wp-content/uploads/2023/04/Afrobass-live-in-Toronto-square-scaled.jpg','name'=>'Blaq Bonez','bg'=>'#0d0018'],
        ['url'=>'http://afrobass.com/wp-content/uploads/2022/11/FINAL-afrofete.png','name'=>'Afro Fete','bg'=>'#1a0800'],
        ['url'=>'http://afrobass.com/wp-content/uploads/2022/11/afrobass-dj-e-cool-ottawa.jpg','name'=>'DJ Ecool Ottawa','bg'=>'#001800'],
        ['url'=>'http://afrobass.com/wp-content/uploads/2022/11/Last-Vibe-front-2.jpeg','name'=>'Last Vibe','bg'=>'#180018'],
        ['url'=>'http://afrobass.com/wp-content/uploads/2022/11/juls-toronto-march-8-afrobass.jpeg','name'=>"Jul's Baby",'bg'=>'#0a1200'],
      ];
      if (empty($flyer_items)) $flyer_items = $known_flyers;

      // Duplicate for seamless loop
      $all_flyers = array_merge($flyer_items, $flyer_items);
      foreach ($all_flyers as $flyer): ?>
        <div class="ab-flyer-card">
          <?php if (!empty($flyer['url'])): ?>
            <img src="<?php echo esc_url($flyer['url']); ?>" alt="<?php echo esc_attr($flyer['name']); ?>" loading="lazy"
              onerror="this.style.display='none';this.nextElementSibling.style.display='flex';">
          <?php endif; ?>
          <div class="ab-flyer-ph" style="background:<?php echo esc_attr($flyer['bg']); ?>;<?php echo empty($flyer['url']) ? 'display:flex;' : 'display:none;'; ?>">
            <span style="font-family:'Bebas Neue',sans-serif;font-size:28px;color:rgba(255,69,0,0.3);">★</span>
            <span class="ab-flyer-ph-name"><?php echo esc_html($flyer['name']); ?></span>
          </div>
          <div class="ab-flyer-overlay"><span><?php echo esc_html($flyer['name']); ?></span></div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ═══════════════════════════════════════════
     BOOKING FORM
═══════════════════════════════════════════ -->
<section class="ab-booking-section" id="booking">
  <div class="ab-booking-watermark" aria-hidden="true">BOOK</div>
  <div class="ab-booking-grid">

    <div>
      <div class="ab-reveal">
        <div class="ab-section-kicker">Work With Us</div>
        <div class="ab-section-title" style="margin-bottom:48px;">Book an<br>Artist</div>
      </div>
      <form id="ab-booking-form" novalidate>
        <div class="ab-form-row ab-reveal">
          <div class="ab-form-group">
            <label class="ab-form-label" for="ab_first_name">First Name</label>
            <input type="text" id="ab_first_name" name="first_name" class="ab-form-input" placeholder="Kay" required>
          </div>
          <div class="ab-form-group">
            <label class="ab-form-label" for="ab_last_name">Last Name</label>
            <input type="text" id="ab_last_name" name="last_name" class="ab-form-input" placeholder="O" required>
          </div>
        </div>
        <div class="ab-form-group ab-reveal">
          <label class="ab-form-label" for="ab_company">Company / Organization</label>
          <input type="text" id="ab_company" name="company" class="ab-form-input" placeholder="Your company name">
        </div>
        <div class="ab-form-group ab-reveal">
          <label class="ab-form-label" for="ab_email">Email Address</label>
          <input type="email" id="ab_email" name="email" class="ab-form-input" placeholder="you@company.com" required>
        </div>
        <div class="ab-form-row ab-reveal">
          <div class="ab-form-group">
            <label class="ab-form-label" for="ab_event_type">Event Type</label>
            <select id="ab_event_type" name="event_type" class="ab-form-select ab-form-input">
              <option value="">Select type</option>
              <option>Concert / Show</option>
              <option>Festival</option>
              <option>Corporate Event</option>
              <option>Private Party</option>
              <option>Tour</option>
            </select>
          </div>
          <div class="ab-form-group">
            <label class="ab-form-label" for="ab_city">Event City</label>
            <input type="text" id="ab_city" name="city" class="ab-form-input" placeholder="Toronto, ON">
          </div>
        </div>
        <div class="ab-form-group ab-reveal">
          <label class="ab-form-label" for="ab_message">Artist / Message</label>
          <textarea id="ab_message" name="message" class="ab-form-textarea" placeholder="Which artist are you interested in booking? Tell us about your event..."></textarea>
        </div>
        <button type="submit" class="ab-form-submit ab-reveal">Submit Inquiry →</button>
        <!-- Honeypot — do not remove -->
        <input type="text" name="website" style="display:none;position:absolute;left:-9999px;" tabindex="-1" autocomplete="off">
        <div class="ab-form-message" role="alert"></div>
      </form>
    </div>

    <div class="ab-booking-info ab-reveal">
      <div class="ab-section-kicker" style="margin-bottom:24px;">Why Afrobass</div>
      <div class="ab-booking-features">
        <div class="ab-booking-feature">
          <div class="ab-bf-icon"><svg viewBox="0 0 20 20" fill="none"><path d="M3 10 L8 15 L17 5" stroke="#FF4500" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg></div>
          <div>
            <div class="ab-bf-title">Direct Artist Relationships</div>
            <div class="ab-bf-desc">We've worked with Davido's DJ, Wizkid's DJ, and headliners with millions of streams. No middlemen.</div>
          </div>
        </div>
        <div class="ab-booking-feature">
          <div class="ab-bf-icon"><svg viewBox="0 0 20 20" fill="none"><circle cx="10" cy="10" r="7" stroke="#FF4500" stroke-width="1.5"/><path d="M10 6 L10 10 L13 12" stroke="#FF4500" stroke-width="1.5" stroke-linecap="round"/></svg></div>
          <div>
            <div class="ab-bf-title">7 Years of Experience</div>
            <div class="ab-bf-desc">Since 2018 we've produced 50+ events, 3,700+ attendees, across 10+ Canadian cities without a single cancellation.</div>
          </div>
        </div>
        <div class="ab-booking-feature">
          <div class="ab-bf-icon"><svg viewBox="0 0 20 20" fill="none"><path d="M4 14 L4 8 L10 4 L16 8 L16 14" stroke="#FF4500" stroke-width="1.5" stroke-linejoin="round"/><rect x="7" y="10" width="6" height="4" rx="1" stroke="#FF4500" stroke-width="1.5"/></svg></div>
          <div>
            <div class="ab-bf-title">Full Production Support</div>
            <div class="ab-bf-desc">We don't just book the artist — staging, promotion, and on-the-night execution is all included.</div>
          </div>
        </div>
        <div class="ab-booking-feature">
          <div class="ab-bf-icon"><svg viewBox="0 0 20 20" fill="none"><path d="M3 10 C3 6.13 6.13 3 10 3 C13.87 3 17 6.13 17 10 C17 13.87 13.87 17 10 17" stroke="#FF4500" stroke-width="1.5"/><path d="M6 10 L10 10 L10 15" stroke="#FF4500" stroke-width="1.5" stroke-linecap="round"/></svg></div>
          <div>
            <div class="ab-bf-title">Trusted Network</div>
            <div class="ab-bf-desc">Media coverage (CP24), established venue relationships, and a loyal 5,000+ subscriber fanbase.</div>
          </div>
        </div>
      </div>
    </div>

  </div>
</section>

<!-- ═══════════════════════════════════════════
     CTA BAND
═══════════════════════════════════════════ -->
<section class="ab-cta-section">
  <div class="ab-cta-bg"></div>
  <div class="ab-cta-left">
    <div class="ab-section-kicker ab-reveal">Let's Work Together</div>
    <h2 class="ab-cta-title ab-reveal">Ready to<br>Bring the <span class="ab-accent">Culture</span><br>to Your City?</h2>
    <p class="ab-cta-desc ab-reveal">Partner with Canada's leading Afrobeats event producer. Concerts, tours, festivals, corporate events — we make it unforgettable.</p>
    <div class="ab-cta-btns ab-reveal">
      <a href="<?php echo esc_url(home_url('/book-talent')); ?>" class="ab-btn-lg-fill">Book an Artist</a>
      <a href="<?php echo esc_url(home_url('/contact')); ?>" class="ab-btn-lg-outline">Sponsorship</a>
    </div>
  </div>
  <div class="ab-cta-right">
    <div class="ab-contact-label ab-reveal">Get in Touch</div>
    <div class="ab-contact-phone ab-reveal"><?php echo esc_html($phone); ?></div>
    <a href="mailto:<?php echo esc_attr($email); ?>" class="ab-contact-email ab-reveal"><?php echo esc_html($email); ?></a>
  </div>
</section>

<?php get_footer(); ?>
