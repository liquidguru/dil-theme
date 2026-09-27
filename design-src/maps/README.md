# Fly maps — sources and how to rebuild

Animated route maps: a static base image with planes flying the routes on top.
Nothing in this folder is uploaded to the website — it's the working material.

- **Markup:** `dil_fly_map( 'slug' )` in `functions.php` (used on the Info page)
- **Animation:** "Fly map" block in `assets/js/main.js`
- **Styles:** section 14b "FLY MAP" in `assets/css/main.css`
- **Per map:** `assets/data/maps/<slug>.json` + `assets/images/map/<name>.webp/.jpg`

Adding a map = new base image + new JSON. No code changes.

## getting-here (Lembeh) — built 27 Sep 2026

Source artwork: **`C:\Users\liqui\OneDrive\Ambon\DIL-Working\Graphics\Maps\DIA-DIL-DIR getting here.af`**
(one page, `Layer 1` with 737 pieces, all generic names — refer to them by index).
`flights.af` in the same folder is an OLDER flattened version (orange routes, one plane) — not useful.

### What was hidden for the Lembeh base (`getting-here/base-clean.png`)

| Index | What |
|---|---|
| 408 | Jakarta → Sorong route (CGK-SOQ) |
| 409 | thin pink Manado → Sorong line |
| 730, 731 | "CGK-SOQ" / "4hrs" labels |
| 723, 724, 725 | Raja Ampat circle (group, ring, pin) |
| 733, 734 | "RAJA" / "AMPAT" text |
| 465–591 | plane 1 (SIN-MDC) — replaced by the animated top-down plane |
| 593–718 | plane 2 (CGK-SOQ) |

(#592 sits just below plane 2 but is an island — don't hide it.)

Kept: routes 407 (SIN→CGK), 410 (SIN→MDC), 411 (CGK→MDC), 735 (Bali→Makassar), 736 (Makassar→Manado),
the Lembeh circle (719–722), the "SIN-MDC or CGK-MDC 3.5hrs" labels, all place names.

### Rebuild steps

1. In Affinity (via the Affinity MCP scripts, or by hand): hide the pieces above, export the page as PNG
   (full size, 3810×2460) → `getting-here/base-clean.png`. **Restore visibility and close without saving.**
2. For each kept route N: hide route N, export again as `without-N.png` (same folder as the base).
   `extract_routes.py` diffs each against the base to find that route's shape and traces the centre-line
   → `routes.json`. `check_routes.py` draws them over the map to eyeball.
   (The scripts point at `C:\Users\liqui\OneDrive\Desktop\dil-map` — Affinity scripts can only write to the
   Desktop. Update the `D =` path if you work elsewhere.)
3. `build_web_images.py` → adds the "Raja Ampat" label, crops, writes `assets/images/map/getting-here-map.webp/.jpg`.
4. `build_map_data.py` → writes `assets/data/maps/getting-here-lembeh.json` (routes, flights, timing, pulse).
   **Adjust speed / stagger / which flights fly here**, then re-run and redeploy just the JSON.

Needs Python with `numpy` and `Pillow` (a throwaway venv is fine).

### Notes

- The red routes are filled tapered shapes, not strokes — that's why the centre-line has to be traced.
- The original planes are side-on/perspective, which look wrong when rotated to follow a curve, so the
  animation uses a small top-down plane drawn in SVG (in `dil_fly_map()`).
- Coordinates everywhere are the Affinity page pixels; the JSON `viewBox` is the web crop
  (`CROP` in `build_web_images.py`) — keep the two in step.

## lembeh-zoom (North Sulawesi close-up) — added 27 Sep 2026

After every 2nd landing the flights pause and a close-up of North Sulawesi pops out of the Lembeh
circle: the drive line draws from Manado airport to the resort with a small car and "2hr", the dive
flags pop up and wave, the resort star glows, then it shrinks back and the flights carry on.

- Source: `lembeh-zoom/popout-area-map.jpg` (929×720, from `OneDrive\DIL shared\DIL website\popout area map.jpg`
  — the old "popout" map on the Info page's Topside section). **The .ai is lost**; `blank map.psd` beside it is
  only the blank Indonesia map.
- `lembeh-zoom/build_zoom_inset.py` traces the burgundy land from the JPG (fills text/plane/line holes, keeps
  Lake Tondano) and redraws labels, stars, flags, wordmark and drive route as vectors
  → `assets/images/map/lembeh-zoom.svg` (all coords in the JPG's pixels, inset region x 336–929, y 0–491).
  Edit label text/positions, flag spots (`FLAGS`) or the drive route (`DRIVE`) there and re-run.
- Wiring: the `zoom` block in `build_map_data.py` (`every` = zoom after every Nth landing, `hold` = seconds open,
  `focusY` = where the cone meets the card, `gap` = space between card and circle).
- Layout: wide maps put the card as large as fits left of the Lembeh circle with a cone to it; under 560px
  wide it fills the map (labels are tiny on phones — same as the base map's labels).

## Raja Ampat version (to do)

Same artwork, different selection: keep 408 (CGK→SOQ) and 409 (MDC→SOQ) and the Raja Ampat circle (723–725,
733–734); decide whether to show the Lembeh routes. Export → `raja-ampat/base-clean.png`, trace 408/409 with
`extract_routes.py`, then a `getting-here-raja-ampat.json` with Sorong as the destination
(ping at the Sorong dot, #401, ≈ 2741,1487; pulse on the Raja Ampat ring, #724, ≈ 2743,1397 r≈144).
