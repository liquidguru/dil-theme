# Dive Into Lembeh — WordPress Theme

Classic PHP WordPress theme for [diveintolembeh.com](https://diveintolembeh.com) — a boutique macro-dive resort in the Lembeh Strait, North Sulawesi.

## Design

Field-journal editorial aesthetic. Burgundy (`#6E1F22`) and cream (`#F5ECDC`) palette.

### Font stack
| Token | Font | Use |
|---|---|---|
| `--font-heading` | Code Pro Light LC | Section headings, nav |
| `--font-body` | PT Sans | Body copy |
| `--font-mono` | DM Mono (Google) | Coordinates, meta text |
| `--font-logo` | DeliDeluxeITCStd | DIVE / LEMBEH wordmark |
| `--font-script` | Zapfino Linotype Two | *into* in wordmark |

Code Pro and PT Sans are served via the **Use Any Font** WordPress plugin. Zapfino and DeliDeluxe are self-hosted in `assets/fonts/`.

## Theme structure

```
dil-theme/
├── style.css               # WP theme header
├── functions.php           # Enqueue, nav menus, AJAX contact, DIL_Nav_Walker
├── header.php              # Full nav + compact sticky nav + mobile overlay
├── footer.php              # Footer grid + social links
├── front-page.php          # Homepage (hero slideshow, all sections)
├── page.php                # Generic page template
├── single.php              # Single post
├── inc/
│   └── inner-page.php      # dil_page_banner() + dil_sidebar()
├── page-templates/
│   ├── template-resort.php
│   ├── template-diving.php
│   ├── template-gallery.php
│   ├── template-info.php
│   └── template-contact.php
└── assets/
    ├── css/main.css
    ├── js/main.js
    ├── fonts/              # Self-hosted fonts
    └── images/             # logo.png, logo-compact.png
```

## Key theme mods (Appearance → Customize)

| Mod key | Description |
|---|---|
| `dil_hero_slide_1–5` | Hero slideshow images |
| `dil_explore_image` | "Come explore" section photo |
| `dil_card_diving_image` | Diving plate card photo |
| `dil_card_resort_image` | Resort plate card photo |
| `dil_hero_video_id` | Vimeo ID for video section |

## Local development

Built with [LocalWP](https://localwp.com). Local site: `diveintolembeh.local`.

Sync theme files from repo to local WP:
```powershell
$src = "C:/Users/liqui/dev/diveintolembeh/dil-theme"
$dst = "C:/Users/liqui/Local Sites/diveintolembeh/app/public/wp-content/themes/dil-theme"
Copy-Item "$src/*" $dst -Recurse -Force
```

## Deploy

Target: `new.diveintolembeh.com` (staging) → `diveintolembeh.com` (production).
