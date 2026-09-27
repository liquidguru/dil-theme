import json, re
from PIL import Image, ImageDraw

D = r'C:\Users\liqui\OneDrive\Desktop\dil-map'
routes = json.load(open(f'{D}\\routes.json'))
im = Image.open(f'{D}\\base.png').convert('RGB')
dr = ImageDraw.Draw(im)
colours = {'sin-cgk': (0, 90, 255), 'sin-mdc': (0, 200, 255), 'cgk-mdc': (255, 170, 0), 'dps-upg': (160, 0, 255), 'upg-mdc': (0, 160, 60)}
for name, r in routes.items():
    nums = list(map(float, re.findall(r'-?\d+\.?\d*', r['d'])))
    # sample the anchor points (every 6 numbers after the first pair are c1 c2 p)
    pts = [(nums[0], nums[1])] + [(nums[i + 4], nums[i + 5]) for i in range(2, len(nums) - 5, 6)]
    dr.line(pts, fill=colours[name], width=5)
    for p in pts:
        dr.ellipse([p[0] - 6, p[1] - 6, p[0] + 6, p[1] + 6], outline=colours[name], width=3)
im.crop((850, 1150, 2450, 2050)).save(f'{D}\\check-routes.png')
print('saved')
