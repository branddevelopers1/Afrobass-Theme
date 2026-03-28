<?php
/**
 * Template Name: Recaps Page
 * Template Post Type: page
 */
get_header();

$recaps = new WP_Query([
  'post_type'      => 'ab_recap',
  'posts_per_page' => -1,
  'orderby'        => 'date',
  'order'          => 'DESC',
]);

// Fallback recap data if no CPT posts yet
$fallback_recaps = [
  ['yt'=>'https://www.youtube.com/watch?v=7_oMwKnmLn8', 'event'=>'Rolling Loud After Party', 'detail'=>'Wizkid & DJ Tunez · Toronto', 'year'=>'2022', 'featured'=>true],
  ['yt'=>'', 'event'=>'Blaqbonez Live in Toronto', 'detail'=>'El Mocambo · 500 Sold Out', 'year'=>'2023', 'featured'=>false],
  ['yt'=>'', 'event'=>'WSTRN Concert', 'detail'=>'The Opera House · 900 Sold Out', 'year'=>'2023', 'featured'=>false],
  ['yt'=>'', 'event'=>'Dope Caesar Canada Tour', 'detail'=>'10 Cities Across Canada', 'year'=>'2025', 'featured'=>false],
  ['yt'=>'', 'event'=>'DJ Kaywise Canada Tour', 'detail'=>'8 City Tour', 'year'=>'2025', 'featured'=>false],
  ['yt'=>'', 'event'=>'Oxlade Tour', 'detail'=>'3 Cities Across Canada', 'year'=>'2024', 'featured'=>false],
];

function ab_yt_embed($url) {
  if (empty($url)) return '';
  preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/)([a-zA-Z0-9_-]{11})/', $url, $m);
  return !empty($m[1]) ? $m[1] : '';
}
?>

<style>
/* ── RECAPS PAGE ── */
.ab-recaps-page { padding-top: 76px; }

.ab-rp-hero {
  padding: 100px 56px 72px;
  background: var(--dark);
  border-bottom: 1px solid var(--dark3);
  position: relative; overflow: hidden;
}
.ab-rp-hero::before {
  content: ''; position: absolute; inset: 0;
  background: radial-gradient(ellipse 50% 80% at 80% 50%, rgba(255,69,0,0.06) 0%, transparent 60%);
}

/* Featured recap - large */
.ab-rp-featured {
  display: grid; grid-template-columns: 1fr 1fr;
  gap: 2px; background: var(--dark3);
  margin-bottom: 2px;
}
.ab-rp-video-wrap {
  position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden;
  background: var(--dark2); cursor: pointer;
}
.ab-rp-video-wrap iframe {
  position: absolute; top: 0; left: 0; width: 100%; height: 100%; border: 0;
}
.ab-rp-thumb-wrap {
  position: absolute; inset: 0; cursor: pointer;
  display: flex; align-items: center; justify-content: center;
  background: var(--dark2); transition: opacity 0.3s;
}
.ab-rp-thumb-wrap img {
  width: 100%; height: 100%; object-fit: cover; opacity: 0.7;
}
.ab-rp-play {
  position: absolute; width: 72px; height: 72px; border-radius: 50%;
  background: rgba(255,69,0,0.9); display: flex; align-items: center; justify-content: center;
  transition: transform 0.2s, background 0.2s; z-index: 2;
}
.ab-rp-thumb-wrap:hover .ab-rp-play { transform: scale(1.1); background: var(--orange); }
.ab-rp-play svg { width: 28px; height: 28px; fill: #fff; margin-left: 4px; }
.ab-rp-thumb-wrap.hidden { opacity: 0; pointer-events: none; }

.ab-rp-featured-info {
  background: var(--dark); padding: 48px 48px;
  display: flex; flex-direction: column; justify-content: center;
}
.ab-rp-featured-badge {
  display: inline-flex; align-items: center; gap: 8px;
  background: rgba(255,69,0,0.1); border: 1px solid rgba(255,69,0,0.2);
  padding: 5px 14px; border-radius: 1px; margin-bottom: 24px; width: fit-content;
}
.ab-rp-featured-badge span {
  font-family: var(--font-cond); font-size: 10px; font-weight: 700;
  letter-spacing: 3px; text-transform: uppercase; color: var(--orange);
}
.ab-rp-featured-title {
  font-family: var(--font-display); font-size: clamp(28px,4vw,48px);
  letter-spacing: 2px; text-transform: uppercase; color: var(--white);
  line-height: 0.95; margin-bottom: 16px;
}
.ab-rp-featured-detail {
  font-family: var(--font-cond); font-size: 14px; font-weight: 600;
  letter-spacing: 1.5px; text-transform: uppercase;
  color: rgba(255,255,255,0.35); margin-bottom: 8px;
}
.ab-rp-featured-year {
  font-family: var(--font-display); font-size: 96px; font-weight: 700;
  color: rgba(255,255,255,0.03); line-height: 1;
  position: absolute; bottom: 16px; right: 24px; pointer-events: none;
}

/* Grid of remaining recaps */
.ab-rp-grid {
  display: grid; grid-template-columns: repeat(3, 1fr);
  gap: 2px; background: var(--dark3);
}
.ab-rp-card {
  background: var(--dark); overflow: hidden;
  transition: background 0.3s;
}
.ab-rp-card:hover { background: #111; }
.ab-rp-card-video { position: relative; padding-bottom: 56.25%; height: 0; background: var(--dark2); }
.ab-rp-card-video iframe {
  position: absolute; top: 0; left: 0; width: 100%; height: 100%; border: 0;
}
.ab-rp-card-thumb {
  position: absolute; inset: 0; cursor: pointer;
  display: flex; align-items: center; justify-content: center;
}
.ab-rp-card-thumb img { width: 100%; height: 100%; object-fit: cover; opacity: 0.6; transition: opacity 0.3s; }
.ab-rp-card:hover .ab-rp-card-thumb img { opacity: 0.8; }
.ab-rp-card-play {
  position: absolute; width: 52px; height: 52px; border-radius: 50%;
  background: rgba(255,69,0,0.85); display: flex; align-items: center; justify-content: center;
  transition: transform 0.2s; z-index: 2;
}
.ab-rp-card:hover .ab-rp-card-play { transform: scale(1.1); }
.ab-rp-card-play svg { width: 20px; height: 20px; fill: #fff; margin-left: 3px; }
.ab-rp-card-thumb.hidden { opacity: 0; pointer-events: none; }

/* Placeholder for no video */
.ab-rp-no-video {
  position: absolute; inset: 0;
  display: flex; flex-direction: column; align-items: center; justify-content: center;
  background: var(--dark2); gap: 12px;
}
.ab-rp-no-video-icon {
  width: 52px; height: 52px; border-radius: 50%;
  border: 1px solid var(--dark3); display: flex; align-items: center; justify-content: center;
}
.ab-rp-no-video-icon svg { width: 22px; height: 22px; color: var(--dark3); }
.ab-rp-no-video-text {
  font-family: var(--font-cond); font-size: 10px; font-weight: 600;
  letter-spacing: 2px; text-transform: uppercase; color: rgba(255,255,255,0.1);
}

.ab-rp-card-info { padding: 16px 20px 24px; }
.ab-rp-card-year {
  font-family: var(--font-cond); font-size: 10px; font-weight: 700;
  letter-spacing: 3px; text-transform: uppercase; color: var(--orange); margin-bottom: 6px;
}
.ab-rp-card-title {
  font-family: var(--font-cond); font-size: 18px; font-weight: 700;
  letter-spacing: 1px; text-transform: uppercase; color: var(--white); margin-bottom: 4px;
}
.ab-rp-card-detail {
  font-size: 12px; font-weight: 300; color: rgba(255,255,255,0.3);
}

/* Empty state */
.ab-rp-empty {
  padding: 120px 56px; text-align: center;
}
.ab-rp-empty-num {
  font-family: var(--font-display); font-size: 96px;
  color: rgba(255,255,255,0.03); letter-spacing: 8px; margin-bottom: 24px;
}
.ab-rp-empty-text { font-size: 15px; color: rgba(255,255,255,0.2); }

@media (max-width: 1024px) {
  .ab-rp-featured { grid-template-columns: 1fr; }
  .ab-rp-featured-info { padding: 32px; }
  .ab-rp-grid { grid-template-columns: 1fr 1fr; }
}
@media (max-width: 768px) {
  .ab-rp-hero { padding: 80px 24px 48px; }
  .ab-rp-grid { grid-template-columns: 1fr; }
}
</style>

<div class="ab-recaps-page">

  <!-- Page Hero -->
  <div class="ab-rp-hero">
    <div style="position:relative;z-index:1;">
      <div class="ab-section-kicker ab-reveal">Relive the Experience</div>
      <h1 class="ab-page-title ab-reveal">Event Recaps<br><span style="color:var(--orange);">& Videos</span></h1>
      <p class="ab-reveal" style="font-size:16px;font-weight:300;color:rgba(255,255,255,0.4);line-height:1.8;max-width:480px;margin-top:16px;">
        Watch highlights from Afrobass concerts, tours, and events across Canada. Add recap videos via WP Admin → Recaps → Add New.
      </p>
    </div>
  </div>

  <?php
  $has_recaps = $recaps->have_posts();
  $items = [];

  if ($has_recaps) {
    while ($recaps->have_posts()): $recaps->the_post();
      $items[] = [
        'id'       => get_the_ID(),
        'title'    => get_the_title(),
        'yt'       => get_field('ab_recap_youtube')  ?: '',
        'thumb'    => get_field('ab_recap_thumb')    ?: [],
        'event'    => get_field('ab_recap_event')    ?: get_the_title(),
        'detail'   => get_field('ab_recap_detail')   ?: '',
        'year'     => get_field('ab_recap_year')     ?: '',
        'featured' => get_field('ab_recap_featured') ?: false,
      ];
    endwhile;
    wp_reset_postdata();
    // Sort: featured first
    usort($items, fn($a,$b) => $b['featured'] <=> $a['featured']);
  } else {
    // Use fallback
    foreach ($fallback_recaps as $r) {
      $items[] = [
        'id'       => 0,
        'title'    => $r['event'],
        'yt'       => $r['yt'],
        'thumb'    => [],
        'event'    => $r['event'],
        'detail'   => $r['detail'],
        'year'     => $r['year'],
        'featured' => $r['featured'],
      ];
    }
  }

  $featured = array_shift($items); // First item is featured
  ?>

  <!-- Featured Recap -->
  <?php if ($featured): ?>
  <div class="ab-rp-featured">
    <?php $vid_id = ab_yt_embed($featured['yt']); ?>
    <div style="position:relative;">
      <div class="ab-rp-video-wrap" id="rp-feat-wrap">
        <?php if ($vid_id): ?>
          <div class="ab-rp-thumb-wrap" id="rp-feat-thumb" onclick="playVideo('rp-feat-wrap','rp-feat-thumb','<?php echo esc_js($vid_id); ?>')">
            <?php if (!empty($featured['thumb']['url'])): ?>
              <img src="<?php echo esc_url($featured['thumb']['url']); ?>" alt="<?php echo esc_attr($featured['event']); ?>">
            <?php else: ?>
              <img src="https://img.youtube.com/vi/<?php echo esc_attr($vid_id); ?>/maxresdefault.jpg" alt="<?php echo esc_attr($featured['event']); ?>">
            <?php endif; ?>
            <div class="ab-rp-play">
              <svg viewBox="0 0 24 24"><polygon points="5,3 19,12 5,21"/></svg>
            </div>
          </div>
        <?php else: ?>
          <div class="ab-rp-no-video">
            <div class="ab-rp-no-video-icon">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1"><path d="M15 10l4.553-2.069A1 1 0 0121 8.868v6.264a1 1 0 01-1.447.899L15 14M4 8h8a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4a2 2 0 012-2z"/></svg>
            </div>
            <div class="ab-rp-no-video-text">Video Coming Soon</div>
          </div>
        <?php endif; ?>
      </div>
    </div>

    <div class="ab-rp-featured-info ab-reveal" style="position:relative;">
      <div class="ab-rp-featured-badge">
        <span>Featured Recap</span>
      </div>
      <div class="ab-rp-featured-title"><?php echo esc_html($featured['event']); ?></div>
      <?php if ($featured['detail']): ?>
        <div class="ab-rp-featured-detail"><?php echo esc_html($featured['detail']); ?></div>
      <?php endif; ?>
      <?php if ($featured['year']): ?>
        <div class="ab-rp-featured-year"><?php echo esc_html($featured['year']); ?></div>
      <?php endif; ?>
      <?php if ($vid_id): ?>
        <a href="<?php echo esc_url($featured['yt']); ?>" target="_blank" rel="noopener"
           style="display:inline-flex;align-items:center;gap:10px;margin-top:32px;font-family:var(--font-cond);font-size:12px;font-weight:700;letter-spacing:3px;text-transform:uppercase;color:var(--orange);text-decoration:none;border-bottom:1px solid rgba(255,69,0,0.3);padding-bottom:2px;">
          Watch on YouTube →
        </a>
      <?php endif; ?>
    </div>
  </div>
  <?php endif; ?>

  <!-- Recaps Grid -->
  <?php if (!empty($items)): ?>
  <section style="padding:0 0 120px;">
    <div class="ab-rp-grid">
      <?php foreach ($items as $i => $item):
        $vid = ab_yt_embed($item['yt']);
        $delay = ($i % 3) + 1;
      ?>
        <div class="ab-rp-card ab-reveal ab-d<?php echo $delay; ?>">
          <div class="ab-rp-card-video" id="rp-card-<?php echo $i; ?>">
            <?php if ($vid): ?>
              <div class="ab-rp-card-thumb" id="rp-thumb-<?php echo $i; ?>"
                   onclick="playVideo('rp-card-<?php echo $i; ?>','rp-thumb-<?php echo $i; ?>','<?php echo esc_js($vid); ?>')">
                <?php if (!empty($item['thumb']['url'])): ?>
                  <img src="<?php echo esc_url($item['thumb']['url']); ?>" alt="<?php echo esc_attr($item['event']); ?>" loading="lazy">
                <?php else: ?>
                  <img src="https://img.youtube.com/vi/<?php echo esc_attr($vid); ?>/maxresdefault.jpg" alt="<?php echo esc_attr($item['event']); ?>" loading="lazy">
                <?php endif; ?>
                <div class="ab-rp-card-play">
                  <svg viewBox="0 0 24 24"><polygon points="5,3 19,12 5,21"/></svg>
                </div>
              </div>
            <?php else: ?>
              <div class="ab-rp-no-video">
                <div class="ab-rp-no-video-icon">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1"><path d="M15 10l4.553-2.069A1 1 0 0121 8.868v6.264a1 1 0 01-1.447.899L15 14M4 8h8a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4a2 2 0 012-2z"/></svg>
                </div>
                <div class="ab-rp-no-video-text">Video Coming Soon</div>
              </div>
            <?php endif; ?>
          </div>
          <div class="ab-rp-card-info">
            <?php if ($item['year']): ?>
              <div class="ab-rp-card-year"><?php echo esc_html($item['year']); ?></div>
            <?php endif; ?>
            <div class="ab-rp-card-title"><?php echo esc_html($item['event']); ?></div>
            <?php if ($item['detail']): ?>
              <div class="ab-rp-card-detail"><?php echo esc_html($item['detail']); ?></div>
            <?php endif; ?>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </section>
  <?php endif; ?>

</div>

<script>
function playVideo(wrapId, thumbId, videoId) {
  var wrap  = document.getElementById(wrapId);
  var thumb = document.getElementById(thumbId);
  var iframe = document.createElement('iframe');
  iframe.src = 'https://www.youtube.com/embed/' + videoId + '?autoplay=1&rel=0';
  iframe.style.cssText = 'position:absolute;top:0;left:0;width:100%;height:100%;border:0;';
  iframe.allow = 'autoplay; encrypted-media';
  iframe.allowFullscreen = true;
  wrap.appendChild(iframe);
  thumb.classList.add('hidden');
}
</script>

<?php get_footer(); ?>
