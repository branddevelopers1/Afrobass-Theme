<?php
/**
 * Afrobass Theme — functions.php
 * Registers CPTs, ACF fields, menus, scripts, AJAX booking handler
 */

defined('ABSPATH') || exit;

/* ============================================================
   THEME SETUP
============================================================ */
function ab_theme_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', ['search-form','comment-form','comment-list','gallery','caption','script','style']);
    add_image_size('ab-event-thumb', 800, 600, true);
    add_image_size('ab-flyer-card',  400, 560, true);
    add_image_size('ab-hero',        1920, 1080, true);

    register_nav_menus([
        'primary' => __('Primary Navigation', 'afrobass'),
        'footer'  => __('Footer Navigation',  'afrobass'),
    ]);
}
add_action('after_setup_theme', 'ab_theme_setup');

/* ============================================================
   FAVICON
============================================================ */
function ab_favicon() {
    $favicon = get_template_directory_uri() . '/assets/images/favicon.png';
    echo '<link rel="icon" type="image/png" href="' . esc_url($favicon) . '">' . "\n";
    echo '<link rel="shortcut icon" href="' . esc_url($favicon) . '">' . "\n";
    echo '<link rel="apple-touch-icon" href="' . esc_url($favicon) . '">' . "\n";
}
add_action('wp_head', 'ab_favicon', 1);

/* ============================================================
   SEO — META, OPEN GRAPH, TWITTER CARD, STRUCTURED DATA
============================================================ */
function ab_seo_meta() {
    global $post;

    $site_name   = 'Afrobass';
    $phone       = ab_setting('ab_phone') ?: '416.846.6483';
    $email       = ab_setting('ab_email') ?: 'contact@afrobass.com';
    $og_img_def  = get_template_directory_uri() . '/assets/images/og-image.jpg';
    $site_url    = home_url('/');

    // ── Per-page values ──────────────────────────────────────
    if (is_front_page()) {
        $title       = "Afrobass — Canada's Premier Afrobeats Event Producer";
        $description = "Afrobass produces world-class Afrobeats concerts, tours, and live events across Canada. Featuring DJ Spinall, Oxlade, Victony, DJ Tunez and more. Toronto-based since 2018.";
        $og_img      = $og_img_def;
        $canonical   = $site_url;

    } elseif (is_singular('ab_event')) {
        $flyer       = get_field('ab_event_flyer');
        $date        = get_field('ab_event_date');
        $venue       = get_field('ab_event_venue');
        $city        = get_field('ab_event_city');
        $artists     = get_field('ab_event_artists');
        $date_fmt    = $date ? date('F j, Y', strtotime($date)) : '';
        $title       = get_the_title() . ' — Afrobass';
        $description = 'Live in ' . ($city ?: 'Canada') . ($date_fmt ? ' on ' . $date_fmt : '') . ($venue ? ' at ' . $venue : '') . ($artists ? '. Featuring ' . $artists : '') . '. Tickets available now.';
        $og_img      = !empty($flyer['url']) ? $flyer['url'] : $og_img_def;
        $canonical   = get_permalink();

    } elseif (is_singular('ab_tour')) {
        $flyer       = get_field('ab_tour_flyer');
        $cities      = get_field('ab_tour_cities');
        $artist      = get_field('ab_tour_artist');
        $title       = get_the_title() . ' — Afrobass';
        $description = ($artist ?: 'Afrobeats') . ' live across Canada' . ($cities ? ' — ' . $cities : '') . '. Presented by Afrobass.';
        $og_img      = !empty($flyer['url']) ? $flyer['url'] : $og_img_def;
        $canonical   = get_permalink();

    } elseif (is_page('about') || is_page('our-story')) {
        $title       = 'Our Story — Afrobass';
        $description = "Since 2018, Afrobass has been Canada's home for Afrobeats. From sold-out concerts to national tours, we connect Africa's biggest artists with Canadian audiences.";
        $og_img      = $og_img_def;
        $canonical   = get_permalink();

    } elseif (is_page('events')) {
        $title       = 'Events — Afrobass';
        $description = 'Upcoming Afrobeats concerts and events across Canada. Produced by Afrobass — Toronto, Vancouver, Ottawa and more.';
        $og_img      = $og_img_def;
        $canonical   = get_permalink();

    } elseif (is_page('book-talent') || is_page('contact')) {
        $title       = 'Book Talent — Afrobass';
        $description = 'Book top Afrobeats artists for your event across Canada. Contact Afrobass — Canada\'s premier Afrobeats event producer.';
        $og_img      = $og_img_def;
        $canonical   = get_permalink();

    } else {
        $title       = get_the_title() ? get_the_title() . ' — ' . $site_name : $site_name;
        $description = get_bloginfo('description') ?: "Canada's Premier Afrobeats Event Producer.";
        $og_img      = $og_img_def;
        $canonical   = get_permalink() ?: $site_url;
    }

    $description = esc_attr(wp_strip_all_tags($description));
    $title_esc   = esc_attr($title);
    $og_img_esc  = esc_url($og_img);
    $canonical   = esc_url($canonical);
    ?>

    <!-- SEO Core -->
    <meta name="description" content="<?php echo $description; ?>">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="<?php echo $canonical; ?>">

    <!-- Open Graph (Facebook, LinkedIn, WhatsApp) -->
    <meta property="og:type"        content="website">
    <meta property="og:site_name"   content="<?php echo esc_attr($site_name); ?>">
    <meta property="og:title"       content="<?php echo $title_esc; ?>">
    <meta property="og:description" content="<?php echo $description; ?>">
    <meta property="og:url"         content="<?php echo $canonical; ?>">
    <meta property="og:image"       content="<?php echo $og_img_esc; ?>">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:locale"      content="en_CA">

    <!-- Twitter Card -->
    <meta name="twitter:card"        content="summary_large_image">
    <meta name="twitter:title"       content="<?php echo $title_esc; ?>">
    <meta name="twitter:description" content="<?php echo $description; ?>">
    <meta name="twitter:image"       content="<?php echo $og_img_esc; ?>">

    <!-- Geo / Local SEO -->
    <meta name="geo.region"      content="CA-ON">
    <meta name="geo.placename"   content="Toronto, Ontario, Canada">
    <meta name="geo.position"    content="43.6532;-79.3832">
    <meta name="ICBM"            content="43.6532, -79.3832">

    <!-- Structured Data — Organization -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "EntertainmentBusiness",
      "name": "Afrobass",
      "alternateName": "Afrobass Inc.",
      "description": "Canada's premier Afrobeats event production company. Concerts, tours, and live events across Canada since 2018.",
      "url": "<?php echo esc_js(home_url('/')); ?>",
      "logo": "<?php echo esc_js(get_template_directory_uri() . '/assets/images/favicon.png'); ?>",
      "image": "<?php echo esc_js($og_img); ?>",
      "telephone": "<?php echo esc_js($phone); ?>",
      "email": "<?php echo esc_js($email); ?>",
      "address": {
        "@type": "PostalAddress",
        "addressLocality": "Toronto",
        "addressRegion": "ON",
        "addressCountry": "CA"
      },
      "areaServed": "Canada",
      "foundingDate": "2018",
      "sameAs": [
        "<?php echo esc_js(ab_setting('ab_instagram')); ?>",
        "<?php echo esc_js(ab_setting('ab_youtube')); ?>",
        "<?php echo esc_js(ab_setting('ab_tiktok')); ?>",
        "<?php echo esc_js(ab_setting('ab_facebook')); ?>",
        "<?php echo esc_js(ab_setting('ab_twitter')); ?>"
      ]
    }
    </script>

    <?php
    // Event structured data for single event pages
    if (is_singular('ab_event')):
        $ev_date   = get_field('ab_event_date');
        $ev_venue  = get_field('ab_event_venue');
        $ev_city   = get_field('ab_event_city');
        $ev_ticket = get_field('ab_event_ticket_url');
        $ev_status = get_field('ab_event_status');
        $ev_flyer  = get_field('ab_event_flyer');
        $ev_img    = !empty($ev_flyer['url']) ? $ev_flyer['url'] : $og_img_def;
        $ev_status_schema = ($ev_status === 'sold_out') ? 'SoldOut' : (($ev_status === 'upcoming' || $ev_status === 'on_sale') ? 'EventScheduled' : 'EventPostponed');
    ?>
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "MusicEvent",
      "name": "<?php echo esc_js(get_the_title()); ?>",
      "startDate": "<?php echo esc_js($ev_date ?: ''); ?>",
      "eventStatus": "https://schema.org/<?php echo esc_js($ev_status_schema); ?>",
      "eventAttendanceMode": "https://schema.org/OfflineEventAttendanceMode",
      "location": {
        "@type": "Place",
        "name": "<?php echo esc_js($ev_venue ?: 'TBA'); ?>",
        "address": {
          "@type": "PostalAddress",
          "addressLocality": "<?php echo esc_js($ev_city ?: 'Toronto'); ?>",
          "addressCountry": "CA"
        }
      },
      "image": "<?php echo esc_js($ev_img); ?>",
      "organizer": {
        "@type": "Organization",
        "name": "Afrobass",
        "url": "<?php echo esc_js(home_url('/')); ?>"
      }
      <?php if ($ev_ticket): ?>
      ,"offers": {
        "@type": "Offer",
        "url": "<?php echo esc_js($ev_ticket); ?>",
        "availability": "https://schema.org/<?php echo $ev_status === 'sold_out' ? 'SoldOut' : 'InStock'; ?>",
        "validFrom": "<?php echo esc_js(date('Y-m-d')); ?>"
      }
      <?php endif; ?>
    }
    </script>
    <?php endif; ?>

    <?php
}
add_action('wp_head', 'ab_seo_meta', 5);

/* ============================================================
   ENQUEUE SCRIPTS & STYLES
============================================================ */
function ab_enqueue_assets() {
    wp_enqueue_style(
        'ab-main',
        get_template_directory_uri() . '/assets/css/main.css',
        [],
        '13.0.0'
    );
    wp_enqueue_style(
        'ab-style',
        get_stylesheet_uri(),
        ['ab-main'],
        '13.0.0'
    );
    wp_enqueue_script(
        'ab-main',
        get_template_directory_uri() . '/assets/js/main.js',
        [],
        '13.0.0',
        true
    );
    // Pass AJAX data to JS
    wp_localize_script('ab-main', 'abAjax', [
        'ajaxurl' => admin_url('admin-ajax.php'),
        'nonce'   => wp_create_nonce('ab_booking_nonce'),
    ]);
}
add_action('wp_enqueue_scripts', 'ab_enqueue_assets');

/* ============================================================
   CUSTOM POST TYPE — EVENTS
============================================================ */
function ab_register_cpt_events() {
    register_post_type('ab_event', [
        'labels' => [
            'name'          => 'Events',
            'singular_name' => 'Event',
            'add_new_item'  => 'Add New Event',
            'edit_item'     => 'Edit Event',
            'view_item'     => 'View Event',
            'all_items'     => 'All Events',
            'menu_name'     => 'Events',
        ],
        'public'        => true,
        'has_archive'   => false,
        'rewrite'       => ['slug' => 'event', 'with_front' => false],
        'supports'      => ['title', 'thumbnail', 'editor'],
        'menu_icon'     => 'dashicons-calendar-alt',
        'show_in_rest'  => true,
    ]);
}
add_action('init', 'ab_register_cpt_events');

/* ============================================================
   CUSTOM POST TYPE — TOURS
============================================================ */
function ab_register_cpt_tours() {
    register_post_type('ab_tour', [
        'labels' => [
            'name'          => 'Tours',
            'singular_name' => 'Tour',
            'add_new_item'  => 'Add New Tour',
            'edit_item'     => 'Edit Tour',
            'view_item'     => 'View Tour',
            'all_items'     => 'All Tours',
            'menu_name'     => 'Tours',
        ],
        'public'        => true,
        'has_archive'   => false,
        'rewrite'       => ['slug' => 'tour', 'with_front' => false],
        'supports'      => ['title', 'thumbnail', 'editor'],
        'menu_icon'     => 'dashicons-location-alt',
        'show_in_rest'  => true,
    ]);
}
add_action('init', 'ab_register_cpt_tours');

/* ============================================================
   ACF FIELD GROUPS
   Registered in code — no plugin UI needed for initial setup
============================================================ */
function ab_register_acf_fields() {
    if (!function_exists('acf_add_local_field_group')) return;

    /* ── EVENTS ── */
    acf_add_local_field_group([
        'key'    => 'group_ab_event',
        'title'  => 'Event Details',
        'fields' => [
            ['key'=>'field_ab_event_date',       'label'=>'Event Date',        'name'=>'ab_event_date',       'type'=>'date_picker',  'display_format'=>'F j, Y', 'return_format'=>'Y-m-d'],
            ['key'=>'field_ab_event_time',       'label'=>'Doors / Show Time', 'name'=>'ab_event_time',       'type'=>'text',         'placeholder'=>'Doors 8PM / Show 9PM'],
            ['key'=>'field_ab_event_venue',      'label'=>'Venue Name',        'name'=>'ab_event_venue',      'type'=>'text'],
            ['key'=>'field_ab_event_city',       'label'=>'City',              'name'=>'ab_event_city',       'type'=>'text',         'placeholder'=>'Toronto, ON'],
            ['key'=>'field_ab_event_type',       'label'=>'Event Type',        'name'=>'ab_event_type',       'type'=>'select',
                'choices'=>['Concert'=>'Concert','Festival'=>'Festival','Tour'=>'Tour','Party'=>'Party','Corporate'=>'Corporate']
            ],
            ['key'=>'field_ab_event_ticket_url', 'label'=>'Ticket URL',        'name'=>'ab_event_ticket_url', 'type'=>'url'],
            ['key'=>'field_ab_event_status',     'label'=>'Status',            'name'=>'ab_event_status',     'type'=>'select',
                'choices'=>['upcoming'=>'Upcoming','sold_out'=>'Sold Out','past'=>'Past Event','cancelled'=>'Cancelled'],
                'default_value'=>'upcoming'
            ],
            ['key'=>'field_ab_event_flyer',      'label'=>'Event Flyer',       'name'=>'ab_event_flyer',      'type'=>'image',        'return_format'=>'array', 'preview_size'=>'ab-event-thumb'],
            ['key'=>'field_ab_event_capacity',   'label'=>'Venue Capacity',    'name'=>'ab_event_capacity',   'type'=>'text',         'placeholder'=>'2,300'],
            ['key'=>'field_ab_event_artists',    'label'=>'Artists / Headliners','name'=>'ab_event_artists',  'type'=>'textarea',     'rows'=>3],
        ],
        'location' => [[ ['param'=>'post_type','operator'=>'==','value'=>'ab_event'] ]],
    ]);

    /* ── TOURS ── */
    acf_add_local_field_group([
        'key'    => 'group_ab_tour',
        'title'  => 'Tour Details',
        'fields' => [
            ['key'=>'field_ab_tour_start',       'label'=>'Tour Start Date',   'name'=>'ab_tour_start',       'type'=>'date_picker',  'return_format'=>'Y-m-d'],
            ['key'=>'field_ab_tour_end',         'label'=>'Tour End Date',     'name'=>'ab_tour_end',         'type'=>'date_picker',  'return_format'=>'Y-m-d'],
            ['key'=>'field_ab_tour_cities',      'label'=>'Cities',            'name'=>'ab_tour_cities',      'type'=>'text',         'placeholder'=>'Toronto · Vancouver · Ottawa'],
            ['key'=>'field_ab_tour_artist',      'label'=>'Artist Name',       'name'=>'ab_tour_artist',      'type'=>'text'],
            ['key'=>'field_ab_tour_ticket_url',  'label'=>'Ticket / Info URL', 'name'=>'ab_tour_ticket_url',  'type'=>'url'],
            ['key'=>'field_ab_tour_status',      'label'=>'Status',            'name'=>'ab_tour_status',      'type'=>'select',
                'choices'=>['upcoming'=>'Upcoming','on_sale'=>'On Sale Now','past'=>'Past Tour'],
                'default_value'=>'upcoming'
            ],
            ['key'=>'field_ab_tour_flyer',       'label'=>'Tour Poster / Flyer','name'=>'ab_tour_flyer',      'type'=>'image',        'return_format'=>'array', 'preview_size'=>'ab-event-thumb'],
        ],
        'location' => [[ ['param'=>'post_type','operator'=>'==','value'=>'ab_tour'] ]],
    ]);

    /* ── HOMEPAGE OPTIONS ── */
    acf_add_local_field_group([
        'key'    => 'group_ab_homepage',
        'title'  => 'Homepage Settings',
        'fields' => [
            ['key'=>'field_ab_hero_headline',    'label'=>'Hero Headline (Line 1)',  'name'=>'ab_hero_headline',   'type'=>'text',  'default_value'=>'We Bring'],
            ['key'=>'field_ab_hero_accent',      'label'=>'Hero Accent Word',        'name'=>'ab_hero_accent',     'type'=>'text',  'default_value'=>'Africa'],
            ['key'=>'field_ab_hero_line3',       'label'=>'Hero Line 3',             'name'=>'ab_hero_line3',      'type'=>'text',  'default_value'=>'To the World'],
            ['key'=>'field_ab_hero_subtext',     'label'=>'Hero Subtext',            'name'=>'ab_hero_subtext',    'type'=>'textarea','rows'=>3],
            ['key'=>'field_ab_hero_video',       'label'=>'Hero Background Video',   'name'=>'ab_hero_video',      'type'=>'file',  'return_format'=>'array', 'mime_types'=>'mp4,webm'],
            ['key'=>'field_ab_story_video',      'label'=>'Our Story Video',         'name'=>'ab_story_video',     'type'=>'file',  'return_format'=>'array', 'mime_types'=>'mp4,webm'],
            ['key'=>'field_ab_story_body',       'label'=>'Our Story Body Text',     'name'=>'ab_story_body',      'type'=>'wysiwyg'],
            ['key'=>'field_ab_milestones',       'label'=>'Milestones',              'name'=>'ab_milestones',      'type'=>'repeater',
                'sub_fields'=>[
                    ['key'=>'field_ab_ms_year',  'label'=>'Year',  'name'=>'year',  'type'=>'text'],
                    ['key'=>'field_ab_ms_text',  'label'=>'Text',  'name'=>'text',  'type'=>'textarea','rows'=>2],
                ]
            ],
        ],
        'location' => [[ ['param'=>'page_type','operator'=>'==','value'=>'front_page'] ]],
    ]);

    /* ── SITE SETTINGS (Options Page) ── */
    if (function_exists('acf_add_options_page')) {
        acf_add_options_page([
            'page_title' => 'Afrobass Site Settings',
            'menu_title' => 'Site Settings',
            'menu_slug'  => 'afrobass-settings',
            'capability' => 'manage_options',
            'icon_url'   => 'dashicons-admin-site-alt3',
        ]);
        acf_add_local_field_group([
            'key'    => 'group_ab_settings',
            'title'  => 'Site Settings',
            'fields' => [
                ['key'=>'field_ab_phone',        'label'=>'Phone Number',    'name'=>'ab_phone',        'type'=>'text', 'default_value'=>'416.846.6483'],
                ['key'=>'field_ab_email',        'label'=>'Email Address',   'name'=>'ab_email',        'type'=>'email','default_value'=>'contact@afrobass.com'],
                ['key'=>'field_ab_instagram',    'label'=>'Instagram URL',   'name'=>'ab_instagram',    'type'=>'url'],
                ['key'=>'field_ab_youtube',      'label'=>'YouTube URL',     'name'=>'ab_youtube',      'type'=>'url'],
                ['key'=>'field_ab_tiktok',       'label'=>'TikTok URL',      'name'=>'ab_tiktok',       'type'=>'url'],
                ['key'=>'field_ab_facebook',     'label'=>'Facebook URL',    'name'=>'ab_facebook',     'type'=>'url'],
                ['key'=>'field_ab_twitter',      'label'=>'X / Twitter URL', 'name'=>'ab_twitter',      'type'=>'url'],
                ['key'=>'field_ab_footer_desc',  'label'=>'Footer Description','name'=>'ab_footer_desc','type'=>'textarea','rows'=>3],
            ],
            'location' => [[ ['param'=>'options_page','operator'=>'==','value'=>'afrobass-settings'] ]],
        ]);
    }

    /* ── VIDEO RECAPS ── */
    acf_add_local_field_group([
        'key'    => 'group_ab_recap',
        'title'  => 'Recap Video',
        'fields' => [
            ['key'=>'field_ab_recap_youtube',  'label'=>'YouTube Embed URL',    'name'=>'ab_recap_youtube',  'type'=>'url',  'instructions'=>'Paste the full YouTube URL e.g. https://youtu.be/xxxxx'],
            ['key'=>'field_ab_recap_thumb',    'label'=>'Thumbnail Image',      'name'=>'ab_recap_thumb',    'type'=>'image','return_format'=>'array'],
            ['key'=>'field_ab_recap_event',    'label'=>'Event Name',           'name'=>'ab_recap_event',    'type'=>'text'],
            ['key'=>'field_ab_recap_detail',   'label'=>'Event Detail',         'name'=>'ab_recap_detail',   'type'=>'text', 'placeholder'=>'El Mocambo · 500 Sold Out'],
            ['key'=>'field_ab_recap_year',     'label'=>'Year',                 'name'=>'ab_recap_year',     'type'=>'text', 'placeholder'=>'2023'],
            ['key'=>'field_ab_recap_featured', 'label'=>'Featured (large card)','name'=>'ab_recap_featured', 'type'=>'true_false', 'default_value'=>0],
        ],
        'location' => [[ ['param'=>'post_type','operator'=>'==','value'=>'ab_recap'] ]],
    ]);
}
add_action('acf/init', 'ab_register_acf_fields');

/* ── Register Recaps CPT ── */
function ab_register_cpt_recaps() {
    register_post_type('ab_recap', [
        'labels'    => ['name'=>'Video Recaps','singular_name'=>'Video Recap','menu_name'=>'Recaps'],
        'public'    => false,
        'show_ui'   => true,
        'supports'  => ['title'],
        'menu_icon' => 'dashicons-video-alt3',
    ]);
}
add_action('init', 'ab_register_cpt_recaps');

/* ============================================================
   BOOKING FORM AJAX HANDLER
============================================================ */
function ab_handle_booking_form() {
    check_ajax_referer('ab_booking_nonce', 'nonce');

    // Rate limiting — max 3 submissions per IP per hour
    $ip         = sanitize_text_field($_SERVER['REMOTE_ADDR'] ?? '');
    $rate_key   = 'ab_form_rate_' . md5($ip);
    $rate_count = (int) get_transient($rate_key);
    if ($rate_count >= 3) {
        wp_send_json_error('Too many submissions. Please try again later or email us directly at contact@afrobass.com');
    }
    set_transient($rate_key, $rate_count + 1, HOUR_IN_SECONDS);

    // Honeypot — bots fill this, humans don't
    if (!empty($_POST['website'])) {
        wp_send_json_error('Submission rejected.');
    }

    $fields = [
        'first_name'  => sanitize_text_field($_POST['first_name']  ?? ''),
        'last_name'   => sanitize_text_field($_POST['last_name']   ?? ''),
        'company'     => sanitize_text_field($_POST['company']     ?? ''),
        'email'       => sanitize_email($_POST['email']            ?? ''),
        'event_type'  => sanitize_text_field($_POST['event_type']  ?? ''),
        'city'        => sanitize_text_field($_POST['city']        ?? ''),
        'message'     => sanitize_textarea_field($_POST['message'] ?? ''),
    ];

    if (empty($fields['email']) || !is_email($fields['email'])) {
        wp_send_json_error('Please enter a valid email address.');
    }
    if (empty($fields['first_name'])) {
        wp_send_json_error('Please enter your name.');
    }

    $to      = get_field('ab_email', 'option') ?: 'contact@afrobass.com';
    $subject = 'New Talent Booking Inquiry — ' . $fields['first_name'] . ' ' . $fields['last_name'];
    $body    = "New booking inquiry from afrobass.com\n\n";
    $body   .= "Name:       {$fields['first_name']} {$fields['last_name']}\n";
    $body   .= "Company:    {$fields['company']}\n";
    $body   .= "Email:      {$fields['email']}\n";
    $body   .= "Event Type: {$fields['event_type']}\n";
    $body   .= "City:       {$fields['city']}\n\n";
    $body   .= "Message:\n{$fields['message']}\n";

    $headers = [
        'Content-Type: text/plain; charset=UTF-8',
        'Reply-To: ' . $fields['first_name'] . ' ' . $fields['last_name'] . ' <' . $fields['email'] . '>',
    ];

    $sent = wp_mail($to, $subject, $body, $headers);

    if ($sent) {
        wp_send_json_success('Thanks! We\'ll be in touch within 48 hours.');
    } else {
        wp_send_json_error('Failed to send. Please email us directly at ' . $to);
    }
}
add_action('wp_ajax_ab_booking_form',        'ab_handle_booking_form');
add_action('wp_ajax_nopriv_ab_booking_form', 'ab_handle_booking_form');

/* ============================================================
   HELPER FUNCTIONS
============================================================ */

/** Get site setting (phone, email, socials etc.) */
function ab_setting(string $key): string {
    if (!function_exists('get_field')) return '';
    return (string)(get_field($key, 'option') ?: '');
}

/** Render event type badge */
function ab_event_type_badge(string $type): string {
    return '<span class="ab-event-tag">' . esc_html($type) . '</span>';
}

/** Format event date for display */
function ab_format_event_date(string $date_str): string {
    if (!$date_str) return '';
    $ts = strtotime($date_str);
    return $ts ? date('M Y', $ts) : $date_str;
}

/** Is event upcoming? */
function ab_is_upcoming(string $date_str): bool {
    if (!$date_str) return true;
    return strtotime($date_str) >= strtotime('today');
}

/** Get YouTube embed URL from various YouTube URL formats */
function ab_youtube_embed(string $url): string {
    if (empty($url)) return '';
    preg_match('/(?:youtu\.be\/|youtube\.com\/(?:watch\?v=|embed\/|shorts\/))([A-Za-z0-9_-]{11})/', $url, $m);
    return isset($m[1]) ? 'https://www.youtube.com/embed/' . $m[1] : $url;
}

/* ============================================================
   FORCE PAGE TEMPLATES BY SLUG
   Eliminates need to manually assign templates in WP admin
============================================================ */
function ab_force_page_templates($template) {
    if (!is_page()) return $template;

    $slug = get_post_field('post_name', get_queried_object_id());
    $map  = [
        'events'      => 'page-events.php',
        'tours'       => 'page-events.php',
        'about'       => 'page-about.php',
        'our-story'   => 'page-about.php',
        'contact'     => 'page-contact.php',
        'book-talent' => 'page-book-talent.php',
    ];

    if (isset($map[$slug])) {
        $located = locate_template($map[$slug]);
        if ($located) return $located;
    }
    return $template;
}
add_filter('template_include', 'ab_force_page_templates', 99);

/* ─── BOOKING ENQUIRY AJAX ─── */
function ab_booking_enquiry() {
    check_ajax_referer('ab_nonce', 'nonce');
    if (!empty($_POST['website'])) { wp_send_json_error('Rejected.'); }

    $ip    = sanitize_text_field($_SERVER['REMOTE_ADDR'] ?? '');
    $key   = 'ab_book_rate_' . md5($ip);
    $count = (int) get_transient($key);
    if ($count >= 5) { wp_send_json_error('Too many submissions. Please try again later.'); }
    set_transient($key, $count + 1, HOUR_IN_SECONDS);

    $name       = sanitize_text_field($_POST['name']       ?? '');
    $email      = sanitize_email($_POST['email']           ?? '');
    $company    = sanitize_text_field($_POST['company']    ?? '');
    $phone      = sanitize_text_field($_POST['phone']      ?? '');
    $artist     = sanitize_text_field($_POST['artist']     ?? '');
    $event_type = sanitize_text_field($_POST['event_type'] ?? '');
    $event_date = sanitize_text_field($_POST['event_date'] ?? '');
    $location   = sanitize_text_field($_POST['location']   ?? '');
    $capacity   = sanitize_text_field($_POST['capacity']   ?? '');
    $budget     = sanitize_text_field($_POST['budget']     ?? '');
    $message    = sanitize_textarea_field($_POST['message'] ?? '');

    if (!$email || !is_email($email)) { wp_send_json_error('Please enter a valid email address.'); }
    if (!$name) { wp_send_json_error('Please enter your name.'); }

    $to      = get_field('ab_email', 'option') ?: 'contact@afrobass.com';
    $subject = "Booking Enquiry — {$name}" . ($artist ? " ({$artist})" : '');
    $body    = "New booking enquiry from afrobass.com\n\n";
    $body   .= "Name:       {$name}\n";
    $body   .= "Email:      {$email}\n";
    $body   .= "Phone:      {$phone}\n";
    $body   .= "Company:    {$company}\n\n";
    $body   .= "Artist:     {$artist}\n";
    $body   .= "Event Type: {$event_type}\n";
    $body   .= "Event Date: {$event_date}\n";
    $body   .= "Location:   {$location}\n";
    $body   .= "Capacity:   {$capacity}\n";
    $body   .= "Budget:     {$budget}\n\n";
    $body   .= "Additional Details:\n{$message}\n";

    $headers = [
        'Content-Type: text/plain; charset=UTF-8',
        "Reply-To: {$name} <{$email}>",
    ];

    wp_mail($to, $subject, $body, $headers);
    wp_send_json_success('Your booking enquiry has been submitted. Our team will respond within 48 hours.');
}
add_action('wp_ajax_ab_booking_enquiry',        'ab_booking_enquiry');
add_action('wp_ajax_nopriv_ab_booking_enquiry', 'ab_booking_enquiry');
function ab_flush_rewrites() { flush_rewrite_rules(); }
add_action('after_switch_theme', 'ab_flush_rewrites');

/* ============================================================
   ACF NOT ACTIVE — ADMIN NOTICE
============================================================ */
function ab_acf_notice() {
    if (function_exists('acf_add_local_field_group')) return;
    echo '<div class="notice notice-warning is-dismissible"><p><strong>Afrobass Theme:</strong> Please install and activate the free <a href="https://wordpress.org/plugins/advanced-custom-fields/" target="_blank">Advanced Custom Fields</a> plugin to enable all content management features.</p></div>';
}
add_action('admin_notices', 'ab_acf_notice');
