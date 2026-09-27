"""Build the web images for the "Getting here" fly map from the clean master.

    base-clean.png  (3810x2460, exported from Affinity with routes kept, planes/Raja
                     Ampat circle/Sorong routes hidden — see README.md)
      → adds the small "Raja Ampat" label
      → crops to the content (+20px margin) and scales to 2000px wide
      → assets/images/map/getting-here-map.webp / .jpg

The crop box is also the SVG viewBox in assets/data/maps/getting-here-lembeh.json —
if you change CROP, update "viewBox" there too.

Run:  python build_web_images.py      (needs Pillow)
"""
from pathlib import Path
from PIL import Image, ImageDraw, ImageFont

HERE = Path(__file__).parent
THEME = HERE.parents[2]
OUT = THEME / 'assets' / 'images' / 'map'

CROP = (174, 212, 3580, 2171)   # page pixels: content bbox (194,232)-(3560,2151) + 20px
WIDTH = 2000

LABELS = [
    # text, (x, y) in page pixels (anchor: middle of the baseline), size, colour
    ('Raja Ampat', (2700, 1402), 34, (61, 61, 61)),
]

im = Image.open(HERE / 'base-clean.png').convert('RGB')
draw = ImageDraw.Draw(im)
for text, xy, size, colour in LABELS:
    font = ImageFont.truetype('arial.ttf', size)
    draw.text(xy, text, font=font, fill=colour, anchor='ms')

web = im.crop(CROP)
web = web.resize((WIDTH, round(web.height * WIDTH / web.width)), Image.Resampling.LANCZOS)
OUT.mkdir(parents=True, exist_ok=True)
web.save(OUT / 'getting-here-map.webp', quality=86, method=6)
web.save(OUT / 'getting-here-map.jpg', quality=86, optimize=True, progressive=True)
for ext in ('webp', 'jpg'):
    f = OUT / f'getting-here-map.{ext}'
    print(f.name, web.size, f.stat().st_size // 1024, 'KB')
print('viewBox:', CROP[0], CROP[1], CROP[2] - CROP[0], CROP[3] - CROP[1])
