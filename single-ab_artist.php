<?php get_header(); ?>
<?php
if (!have_posts()) { get_footer(); exit; }
the_post();

$role      = get_field('ab_artist_role')     ?: 'Artist';
$genre     = get_field('ab_artist_genre')    ?: '';
$origin    = get_field('ab_artist_origin')   ?: '';
$bio       = get_field('ab_artist_bio')      ?: '';
$spotify   = get_field('ab_artist_spotify')  ?: '';
$instagram = get_field('ab_artist_instagram') ?: '';
$youtube   = get_field('ab_artist_youtube')  ?: '';
$available = get_field('ab_artist_available');
$book_note = get_field('ab_artist_booking_note') ?: '';

// Extract YouTube video ID for embed
$yt_vid_id = '';
if ($youtube) {
    preg_match('/(?:youtu\.be\/|youtube\.com\/(?:watch\?v=|embed\/|shorts\/))([A-Za-z0-9_-]{11})/', $youtube, $yt_m);
    $yt_vid_id = isset($yt_m[1]) ? $yt_m[1] : '';
}

// Extract Spotify embed ID
$spotify_id = '';
if ($spotify) {
    preg_match('/spotify\.com\/artist\/([A-Za-z0-9]+)/', $spotify, $sp_m);
    $spotify_id = isset($sp_m[1]) ? $sp_m[1] : '';
}
?>

<div style="padding-top:72px;">
  <section class="ab-single-grid" style="padding-top:80px;padding-bottom:100px;">

    <!-- Artist Photo -->
    <div class="ab-single-flyer ab-reveal">
      <?php if (has_post_thumbnail()): ?>
        <?php the_post_thumbnail('large', ['style'=>'width:100%;border-radius:6px;display:block;object-fit:cover;aspect-ratio:3/4;']); ?>
      <?php else: ?>
        <div style="aspect-ratio:3/4;background:linear-gradient(135deg,#1a0500,#2a0800);border-radius:6px;display:flex;align-items:center;justify-content:center;">
          <span style="font-family:'Bebas Neue',sans-serif;font-size:48px;color:rgba(255,255,255,0.07);letter-spacing:4px;text-align:center;padding:20px;"><?php the_title(); ?></span>
        </div>
      <?php endif; ?>
    </div>

    <!-- Artist Details -->
    <div class="ab-reveal ab-delay-1">

      <div class="ab-section-kicker" style="margin-bottom:20px;"><?php echo esc_html($role); ?></div>

      <h1 style="font-family:'Bebas Neue',sans-serif;font-size:clamp(40px,6vw,72px);letter-spacing:2px;line-height:0.92;color:#fff;text-transform:uppercase;margin-bottom:36px;">
        <?php the_title(); ?>
      </h1>

      <!-- Meta: Genre / Origin -->
      <div class="ab-single-meta" style="margin-bottom:32px;">
        <?php if ($genre): ?>
          <div class="ab-single-meta-item">
            <span class="ab-single-meta-key">Genre</span>
            <span class="ab-single-meta-val"><?php echo esc_html($genre); ?></span>
          </div>
        <?php endif; ?>
        <?php if ($origin): ?>
          <div class="ab-single-meta-item">
            <span class="ab-single-meta-key">Origin</span>
            <span class="ab-single-meta-val"><?php echo esc_html($origin); ?></span>
          </div>
        <?php endif; ?>
      </div>

      <!-- Bio -->
      <?php if ($bio): ?>
        <div class="ab-single-desc" style="margin-bottom:36px;">
          <?php echo nl2br(esc_html($bio)); ?>
        </div>
      <?php elseif (get_the_content()): ?>
        <div class="ab-single-desc" style="margin-bottom:36px;"><?php the_content(); ?></div>
      <?php endif; ?>

      <!-- Social Links -->
      <?php if ($instagram || $spotify || $youtube): ?>
        <div style="display:flex;gap:16px;margin-bottom:40px;flex-wrap:wrap;">
          <?php if ($instagram): ?>
            <a href="<?php echo esc_url($instagram); ?>" target="_blank" rel="noopener"
               style="display:inline-flex;align-items:center;gap:8px;font-family:'Barlow Condensed',sans-serif;font-size:11px;font-weight:700;letter-spacing:3px;text-transform:uppercase;color:rgba(255,255,255,0.5);border:1px solid rgba(255,255,255,0.12);padding:10px 18px;border-radius:2px;transition:all 0.2s;text-decoration:none;"
               onmouseover="this.style.color='#fff';this.style.borderColor='rgba(255,255,255,0.4)'"
               onmouseout="this.style.color='rgba(255,255,255,0.5)';this.style.borderColor='rgba(255,255,255,0.12)'">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
              Instagram
            </a>
          <?php endif; ?>
          <?php if ($spotify): ?>
            <a href="<?php echo esc_url($spotify); ?>" target="_blank" rel="noopener"
               style="display:inline-flex;align-items:center;gap:8px;font-family:'Barlow Condensed',sans-serif;font-size:11px;font-weight:700;letter-spacing:3px;text-transform:uppercase;color:rgba(255,255,255,0.5);border:1px solid rgba(255,255,255,0.12);padding:10px 18px;border-radius:2px;transition:all 0.2s;text-decoration:none;"
               onmouseover="this.style.color='#1DB954';this.style.borderColor='#1DB954'"
               onmouseout="this.style.color='rgba(255,255,255,0.5)';this.style.borderColor='rgba(255,255,255,0.12)'">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M12 0C5.4 0 0 5.4 0 12s5.4 12 12 12 12-5.4 12-12S18.66 0 12 0zm5.521 17.34c-.24.359-.66.48-1.021.24-2.82-1.74-6.36-2.101-10.561-1.141-.418.122-.779-.179-.899-.539-.12-.421.18-.78.54-.9 4.56-1.021 8.52-.6 11.64 1.32.42.18.479.659.301 1.02zm1.44-3.3c-.301.42-.841.6-1.262.3-3.239-1.98-8.159-2.58-11.939-1.38-.479.12-1.02-.12-1.14-.6-.12-.48.12-1.021.6-1.141C9.6 9.9 15 10.561 18.72 12.84c.361.181.54.78.241 1.2zm.12-3.36C15.24 8.4 8.82 8.16 5.16 9.301c-.6.179-1.2-.181-1.38-.721-.18-.601.18-1.2.72-1.381 4.26-1.26 11.28-1.02 15.721 1.621.539.3.719 1.02.419 1.56-.299.421-1.02.599-1.559.3z"/></svg>
              Spotify
            </a>
          <?php endif; ?>
          <?php if ($youtube): ?>
            <a href="<?php echo esc_url($youtube); ?>" target="_blank" rel="noopener"
               style="display:inline-flex;align-items:center;gap:8px;font-family:'Barlow Condensed',sans-serif;font-size:11px;font-weight:700;letter-spacing:3px;text-transform:uppercase;color:rgba(255,255,255,0.5);border:1px solid rgba(255,255,255,0.12);padding:10px 18px;border-radius:2px;transition:all 0.2s;text-decoration:none;"
               onmouseover="this.style.color='#FF0000';this.style.borderColor='#FF0000'"
               onmouseout="this.style.color='rgba(255,255,255,0.5)';this.style.borderColor='rgba(255,255,255,0.12)'">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
              YouTube
            </a>
          <?php endif; ?>
        </div>
      <?php endif; ?>

      <!-- Spotify Embed -->
      <?php if ($spotify_id): ?>
        <div style="margin-bottom:40px;">
          <div style="font-family:'Barlow Condensed',sans-serif;font-size:10px;font-weight:700;letter-spacing:3px;text-transform:uppercase;color:rgba(255,255,255,0.25);margin-bottom:14px;">Listen</div>
          <iframe
            src="https://open.spotify.com/embed/artist/<?php echo esc_attr($spotify_id); ?>?utm_source=generator&theme=0"
            width="100%" height="152"
            frameborder="0"
            allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture"
            loading="lazy"
            style="border-radius:6px;">
          </iframe>
        </div>
      <?php endif; ?>

      <!-- YouTube Embed (only if no Spotify) -->
      <?php if ($yt_vid_id && !$spotify_id): ?>
        <div style="margin-bottom:40px;">
          <div style="font-family:'Barlow Condensed',sans-serif;font-size:10px;font-weight:700;letter-spacing:3px;text-transform:uppercase;color:rgba(255,255,255,0.25);margin-bottom:14px;">Watch</div>
          <div style="position:relative;padding-bottom:56.25%;height:0;overflow:hidden;border-radius:4px;background:#111;">
            <iframe
              src="https://www.youtube.com/embed/<?php echo esc_attr($yt_vid_id); ?>?rel=0"
              style="position:absolute;top:0;left:0;width:100%;height:100%;border:0;"
              allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
              allowfullscreen
              loading="lazy">
            </iframe>
          </div>
        </div>
      <?php endif; ?>

      <!-- Book CTA -->
      <?php if ($available): ?>
        <a href="<?php echo esc_url(home_url('/book-talent')); ?>?artist=<?php echo urlencode(get_the_title()); ?>"
           class="ab-single-ticket-btn">
          Book <?php the_title(); ?> →
        </a>
        <?php if ($book_note): ?>
          <p style="margin-top:12px;font-family:'Barlow Condensed',sans-serif;font-size:12px;color:rgba(255,255,255,0.3);letter-spacing:1px;">
            <?php echo esc_html($book_note); ?>
          </p>
        <?php endif; ?>
      <?php else: ?>
        <span class="ab-single-ticket-btn" style="background:#1a1a1a;cursor:default;display:inline-block;opacity:0.5;">
          Currently Unavailable
        </span>
      <?php endif; ?>

      <div style="margin-top:40px;padding-top:32px;border-top:1px solid #1a1a1a;">
        <a href="<?php echo esc_url(home_url('/#talent')); ?>"
           style="font-family:'Barlow Condensed',sans-serif;font-size:12px;font-weight:700;letter-spacing:3px;text-transform:uppercase;color:rgba(255,255,255,0.3);transition:color 0.2s;text-decoration:none;">
          ← Back to Talent
        </a>
      </div>

    </div>
  </section>
</div>

<?php get_footer(); ?>
