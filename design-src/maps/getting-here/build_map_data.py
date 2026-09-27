"""Write assets/data/maps/getting-here-lembeh.json — everything the fly map needs.

Routes come from routes.json (extract_routes.py). Flights, timing, the pulse and
the landing ping are set here: edit, re-run, redeploy the JSON. No code changes.

Run:  python build_map_data.py
"""
import json
from pathlib import Path

HERE = Path(__file__).parent
THEME = HERE.parents[2]
routes = json.loads((HERE / 'routes.json').read_text())

data = {
    'image': {
        'webp': 'assets/images/map/getting-here-map.webp',
        'jpg': 'assets/images/map/getting-here-map.jpg',
        'width': 2000, 'height': 1150,
    },
    'viewBox': [174, 212, 3406, 1959],          # page-pixel crop used by build_web_images.py
    'alt': 'Map of Indonesia showing flights to Manado, the gateway to Lembeh: from Singapore '
           '(SIN-MDC) or Jakarta (CGK-MDC), about 3.5 hours, or from Bali via Makassar. A close-up of '
           'North Sulawesi shows the 2-hour drive from Manado airport to Dive Into Lembeh, with dive sites '
           'at Bunaken, Bangka and Lembeh.',
    # Centre-lines of the red route swooshes, traced from the Affinity artwork (page pixels)
    'routes': {name: r['d'] for name, r in routes.items()},
    # Each flight flies its legs in order; [route, reversed?] — reversed when the traced
    # path runs away from the destination
    'flights': [
        {'name': 'Singapore → Manado', 'legs': [['sin-mdc', False]]},
        {'name': 'Jakarta → Manado', 'legs': [['cgk-mdc', True]]},
        {'name': 'Bali → Makassar → Manado', 'legs': [['dps-upg', False], ['upg-mdc', False]]},
        {'name': 'Singapore → Jakarta → Manado', 'legs': [['sin-cgk', False], ['cgk-mdc', True]]},
    ],
    'timing': {'speed': 300, 'stagger': 3.2, 'rest': 1.5},   # map units/s, s between departures, s after landing
    'pulse': {'cx': 2361, 'cy': 1303, 'r': 144},              # Lembeh circle (Affinity node #720)
    'ping': {'cx': 2297, 'cy': 1325, 'r': 22},                # Manado airport dot (#404)
    # North Sulawesi close-up that pops out of the Lembeh circle after landings
    # (built by design-src/maps/lembeh-zoom/build_zoom_inset.py)
    'zoom': {
        'svg': 'assets/images/map/lembeh-zoom.svg',
        'local': [336, 0, 593, 491],       # the inset's own viewBox (source-image pixels)
        'focusY': [236, 350],              # inset y-range around Lembeh — the cone joins the card's edge here
        'from': {'cx': 2361, 'cy': 1303, 'r': 144},
        'gap': 90,                         # map units between the card and the circle (wide layout)
        'every': 2,                        # zoom in after every Nth landing
        'hold': 6.5,                       # seconds the close-up stays open
    },
}

out = THEME / 'assets' / 'data' / 'maps' / 'getting-here-lembeh.json'
out.parent.mkdir(parents=True, exist_ok=True)
out.write_text(json.dumps(data, ensure_ascii=False, indent=1) + '\n', encoding='utf-8', newline='\n')
print(out, out.stat().st_size // 1024, 'KB')
