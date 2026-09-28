"""Build the North Sulawesi close-up ("zoom inset") for the fly map, as vector SVG.

Source: popout-area-map.jpg (929x720 — the only surviving copy; the .ai is lost).
The burgundy land is traced from its pixels; labels, stars, flags and the drive
route are redrawn as vectors at positions measured off the same image, so all
coordinates are in that image's pixels (inset region x 336-929, y 0-491).

Output: assets/images/map/lembeh-zoom.svg — inlined into the fly map by
dil_fly_map() and animated by the "Fly map" block in main.js (classes fz-*).

Run:  python build_zoom_inset.py      (needs numpy, scipy, scikit-image, Pillow)
"""
from pathlib import Path
import numpy as np
from PIL import Image
from scipy import ndimage
from skimage import measure, morphology
from skimage.segmentation import flood

HERE = Path(__file__).parent
THEME = HERE.parents[2]
OUT = THEME / 'assets' / 'images' / 'map' / 'lembeh-zoom.svg'

X0, X1, Y1 = 336, 929, 491            # inset region; bottom cut just above the old red cone line
LAND = '#5f0e10'                      # the original burgundy (97,13,13)
PEACH = '#f5bf85'

# ── 1. Trace the land ──────────────────────────────────────────────────────
a = np.asarray(Image.open(HERE / 'popout-area-map.jpg').convert('RGB')).astype(int)
r, g, b = a[..., 0], a[..., 1], a[..., 2]
burg = (r > 45) & (r < 150) & (g < 55) & (b < 55)
mask = np.zeros_like(burg)
mask[:Y1, X0:X1] = burg[:Y1, X0:X1]
for x0, y0, x1, y1 in [(452, 194, 524, 214), (776, 88, 856, 112)]:   # "Bunaken", "Bangka" (burgundy text)
    mask[y0:y1, x0:x1] = False
lake = flood(~burg, (452, 598))                                        # Lake Tondano
yy, xx = np.mgrid[:mask.shape[0], :mask.shape[1]]
# The old plane, drive line, "2hr" and wordmark reach the coast, so they read as sea, not
# holes — paint land under them first (all inside the mainland in the original)
for x0, y0, x1, y1 in [(606, 212, 664, 248),   # plane at the airport
                       (688, 256, 718, 276)]:  # "2hr"
    mask[y0:y1, x0:x1] = True
# DIVE INTO LEMBEH sits right on the coast: a solid box pushed land into the strait, so just
# close up the letter gaps locally — and only keep that inside each line of text, or the closing
# bridges the strait under the H and joins Lembeh island to the mainland
wx0, wy0, wx1, wy1 = 740, 278, 830, 312
closed = mask.copy()
closed[wy0:wy1, wx0:wx1] = morphology.closing(mask[wy0 - 8:wy1 + 8, wx0 - 8:wx1 + 8],
                                              morphology.disk(5))[8:-8, 8:-8]
for x0, y0, x1, y1 in [(740, 281, 826, 296),   # DIVE INTO
                       (749, 296, 818, 309)]:  # LEMBEH (stops at the H — the strait is right there)
    mask[y0:y1, x0:x1] = closed[y0:y1, x0:x1]
for t in np.linspace(0, 1, 120):               # the old drive line: Q(626,238)-(724,290.5)-(822,273)
    px = (1 - t) ** 2 * 626 + 2 * (1 - t) * t * 724 + t * t * 822
    py = (1 - t) ** 2 * 238 + 2 * (1 - t) * t * 290.5 + t * t * 273
    mask |= (xx - px) ** 2 + (yy - py) ** 2 <= 4 ** 2
mask = ndimage.binary_fill_holes(mask)                                 # remaining text holes
# The strait squeezes past the H of LEMBEH and turns west under the wordmark — in the source it's a
# 1-2px gap there, which the smoothing closes, joining Lembeh island to the mainland. Carve it open.
chan = [(830, 282), (820, 298), (815, 306), (806, 310.5), (790, 311.5), (760, 311.5)]
for (ax, ay), (bx, by) in zip(chan, chan[1:]):
    for t in np.linspace(0, 1, 40):
        px, py = ax + (bx - ax) * t, ay + (by - ay) * t
        mask &= ~((xx - px) ** 2 + (yy - py) ** 2 <= 3.5 ** 2)   # wide enough to survive the curve smoothing
for cx, cy, rad in [(573, 271, 13), (825, 267, 11)]:                   # stars bite the coastline
    mask |= (xx - cx) ** 2 + (yy - cy) ** 2 <= rad ** 2
mask &= ~lake
mask = morphology.remove_small_objects(mask, max_size=12)
mask = morphology.closing(mask, morphology.disk(1))


def smooth_closed(p, n=2):
    for _ in range(n):
        p = (np.roll(p, 1, 0) + 2 * p + np.roll(p, -1, 0)) / 4
    return p


def closed_path(pts):
    d, n = f'M{pts[0][0]:.1f},{pts[0][1]:.1f}', len(pts)
    for i in range(n):
        p0, p1, p2, p3 = pts[(i - 1) % n], pts[i], pts[(i + 1) % n], pts[(i + 2) % n]
        c1, c2 = p1 + (p2 - p0) / 6, p2 - (p3 - p1) / 6
        d += f' C{c1[0]:.1f},{c1[1]:.1f} {c2[0]:.1f},{c2[1]:.1f} {p2[0]:.1f},{p2[1]:.1f}'
    return d + 'Z'


land = []
for c in measure.find_contours(np.pad(mask, 2).astype(float), 0.5):
    xy = np.c_[c[:, 1] - 2, c[:, 0] - 2]
    xy[:, 1] = np.minimum(xy[:, 1], Y1)
    if abs(0.5 * np.sum(xy[:, 0] * np.roll(xy[:, 1], -1) - np.roll(xy[:, 0], -1) * xy[:, 1])) < 15:
        continue
    s = measure.approximate_polygon(smooth_closed(xy), tolerance=0.7)[:-1]
    if len(s) >= 4:
        land.append(closed_path(s))
land_d = ' '.join(land)

# ── 2. Vector overlays (positions measured off the source image) ───────────


def star(cx, cy, R, cls=''):
    pts = []
    for k in range(10):
        ang = -np.pi / 2 + k * np.pi / 5
        rad = R if k % 2 == 0 else R * 0.44
        pts.append(f'{cx + rad * np.cos(ang):.1f},{cy + rad * np.sin(ang):.1f}')
    return f'<polygon class="fz-star {cls}" points="{" ".join(pts)}" fill="{PEACH}"/>'


def text(x, y, s, size, fill='#fff', cls='fz-label', weight='normal'):
    return (f'<text class="{cls}" x="{x}" y="{y}" font-size="{size}" fill="{fill}" font-weight="{weight}" '
            f'text-anchor="middle" font-family="Arial, Helvetica, sans-serif">{s}</text>')


# Dive flag: pole base at (0,0), red flag with the white diagonal, gently waving cloth
FLAG = ('<line x1="0" y1="0" x2="0" y2="-46" stroke="#c9c9c9" stroke-width="1.6" stroke-linecap="round"/>'
        '<g class="fz-cloth">'
        '<path d="M0.8,-45 C9,-48.5 17,-42.5 25,-45.5 C29,-47 32,-46.5 34,-46 L34,-25 C26,-22 18,-28 10,-25 C6,-23.5 3,-24 0.8,-24.5Z" '
        'fill="#e3262d" stroke="#a51a1f" stroke-width=".6"/>'
        '<path d="M0.8,-45 L34,-25" stroke="#fff" stroke-width="5.2" clip-path="url(#fz-flagclip)"/>'
        '</g>')
FLAGS = [(716, 103), (481, 182), (481, 303), (837, 262), (858, 344)]   # pole bases

DRIVE = 'M626,238 Q724,290.5 822,273'             # airport → resort, the original's gentle dip

# Small top-down car, nose +x (moved along DRIVE by main.js)
CAR = ('<g class="fz-car" opacity="0"><rect x="-8" y="-4.5" width="16" height="9" rx="3" fill="#fff" '
       'stroke="#3a2a22" stroke-width="1"/><rect x="1.5" y="-3.2" width="3.2" height="6.4" rx="1" fill="#9fb6c4"/></g>')

svg = f'''<svg xmlns="http://www.w3.org/2000/svg" viewBox="{X0} 0 {X1 - X0} {Y1}">
<defs><clipPath id="fz-flagclip"><path d="M0.8,-45 C9,-48.5 17,-42.5 25,-45.5 C29,-47 32,-46.5 34,-46 L34,-25 C26,-22 18,-28 10,-25 C6,-23.5 3,-24 0.8,-24.5Z"/></clipPath></defs>
<path class="fz-land" d="{land_d}" fill="{LAND}" fill-rule="evenodd"/>
<path class="fz-drive" d="{DRIVE}" fill="none" stroke="#e8dccb" stroke-width="2.6" stroke-linecap="round" pathLength="1" stroke-dasharray="1" stroke-dashoffset="1"/>
{CAR}
{star(573.5, 271.5, 15)}
{star(825, 266.5, 11, 'fz-resort')}
{text(629, 191, 'Airport', 15)}
{text(629, 209, '(MDC)', 13)}
{text(564, 311, 'Manado', 14)}
{text(538.5, 403, 'Tomohon', 14)}
{text(485, 208, 'Bunaken', 13, LAND)}
{text(813.5, 105, 'Bangka', 13, LAND)}
{text(765, 237, 'Tangkoko', 11)}
{text(765, 251, 'National', 11)}
{text(765, 265, 'Park', 11)}
{text(700, 258, '1hr', 15, cls='fz-label fz-2hr')}
<g class="fz-wordmark"><text x="782.5" y="292" text-anchor="middle" font-size="12.5">DIVE INTO</text><text x="782.5" y="305.5" text-anchor="middle" font-size="12.5">LEMBEH</text></g>
{''.join(f'<g transform="translate({x},{y})"><g class="fz-flag">{FLAG}</g></g>' for x, y in FLAGS)}
</svg>
'''
OUT.write_text(svg, encoding='utf-8', newline='\n')
print(OUT.name, len(svg) // 1024, 'KB,', len(land), 'land shapes')
