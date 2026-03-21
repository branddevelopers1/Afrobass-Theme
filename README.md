# Afrobass WordPress Theme
**Version:** 1.0.0  
**Author:** Afrobass Inc.  
**Contact:** contact@afrobass.com | 416.846.6483

---

## Installation

### 1. Install WordPress
Fresh install recommended. Delete all default themes and plugins except what's listed below.

### 2. Required Plugin
Install this ONE free plugin:
- **Advanced Custom Fields (ACF)** — https://wordpress.org/plugins/advanced-custom-fields/  
  *(Free version is all you need)*

### 3. Upload Theme
1. Go to **WordPress Admin → Appearance → Themes → Add New → Upload Theme**
2. Upload `afrobass-theme.zip`
3. Click **Activate**

### 4. Set Homepage
1. Create a new Page titled "Home"
2. Go to **Settings → Reading**
3. Set "Your homepage displays" to **A static page**
4. Select "Home" as the homepage

### 5. Create Your Pages
Create these pages in **Pages → Add New** (titles must match exactly):
- `Home` → used as front page (front-page.php auto-applies)
- `Events` → set template to **Events Page**
- `Tours` → set template to **Events Page** (same template, filters to tours)
- `About` → set template to **About Page**
- `Book Talent` → set template to **Contact Page**
- `Contact` → set template to **Contact Page**

To set a template: Edit the page → Page Attributes (right sidebar) → Template dropdown.

### 6. Site Settings
Go to **Admin → Site Settings** (left sidebar, new menu item added by ACF):
- Phone number
- Email address
- Social media URLs (Instagram, YouTube, TikTok, Facebook)
- Footer description

### 7. Add Your First Event
1. Go to **Admin → Events → Add New**
2. Fill in: Title, Event Date, Venue, City, Event Type, Ticket URL, Status, Upload Flyer
3. Set Status to "Upcoming" — it will auto-appear on homepage and events page
4. When the event passes, change Status to "Past" — it moves to the past events section

### 8. Add a Tour
Same as events but under **Admin → Tours**.

### 9. Add Video Recaps
1. Go to **Admin → Recaps → Add New**
2. Paste a YouTube URL (any format works: youtu.be/xxx or youtube.com/watch?v=xxx)
3. Upload a thumbnail image
4. Check "Featured" on the first/largest card

### 10. Hero Video
1. Go to **Pages → Home → Edit**
2. In the ACF fields panel scroll to "Hero Background Video"
3. Upload your concert video (MP4, under 20MB recommended for web — compress with HandBrake first)
4. Same for "Our Story Video"

---

## Customisation

### Changing Colours
All colours are CSS variables in `assets/css/main.css` line 1–20:
```css
:root {
  --orange:     #FF4500;  /* Main brand orange */
  --black:      #080808;  /* Background */
  ...
}
```
Change `--orange` to update the entire brand colour instantly.

### Adding Pages
Duplicate any existing page template PHP file, rename it `page-{slug}.php`, and edit the content.

### Typography
Fonts are loaded from Google Fonts in `assets/css/main.css`. To change:
1. Update the `@import` URL at the top of main.css
2. Update the `--font-display`, `--font-body`, `--font-cond` variables

---

## File Structure
```
afrobass-theme/
├── style.css              ← Theme declaration (required by WP)
├── functions.php          ← CPTs, ACF fields, AJAX, helpers
├── header.php             ← Nav, cursor, loader
├── footer.php             ← Footer, wp_footer()
├── front-page.php         ← Homepage (all sections)
├── page-about.php         ← Our Story page
├── page-events.php        ← Events + Tours listing
├── page-contact.php       ← Contact + general form
├── single-event.php       ← Individual event page
├── single-tour.php        ← Individual tour page
├── index.php              ← WP fallback (required)
├── assets/
│   ├── css/main.css       ← All styles
│   └── js/main.js         ← Cursor, loader, parallax, reveal, AJAX form
└── README.md              ← This file
```

---

## Notes for Developer
- Booking form submits via AJAX to `admin-ajax.php` and emails `contact@afrobass.com`
- Make sure your WordPress host has **wp_mail** working (or install WP Mail SMTP plugin)
- For video recaps: YouTube embed URLs are extracted automatically from any YouTube URL format
- Flyer marquee on homepage auto-pulls from past events CPT. If none exist, falls back to hardcoded Afrobass image URLs from the old site
- The theme has zero dependency on Elementor, page builders, or any other paid plugins

---

## Support
contact@afrobass.com | 416.846.6483
