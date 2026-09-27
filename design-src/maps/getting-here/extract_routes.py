"""Extract route centrelines from the Affinity exports.

base.png = map with the kept routes; without-N.png = same minus route N.
The pixels that differ are route N. Each route is a tapered filled 'swoosh', so
its centreline = the middle of the red band, sampled along whichever axis gives
one contiguous run per scanline. Output: smooth SVG path data in page pixels.
"""
import json
import numpy as np
from PIL import Image

D = r'C:\Users\liqui\OneDrive\Desktop\dil-map'
base = np.asarray(Image.open(f'{D}\\base.png').convert('RGB')).astype(int)

ROUTES = {407: 'sin-cgk', 410: 'sin-mdc', 411: 'cgk-mdc', 735: 'dps-upg', 736: 'upg-mdc'}


def runs(line):
    idx = np.flatnonzero(line)
    if not len(idx):
        return []
    splits = np.flatnonzero(np.diff(idx) > 3)
    starts = np.r_[idx[0], idx[splits + 1]]
    ends = np.r_[idx[splits], idx[-1]]
    return list(zip(starts, ends))


def centreline(mask, axis):
    """axis='x': walk columns, midpoint of the band's y-run; 'y': walk rows."""
    pts, multi = [], 0
    m = mask if axis == 'x' else mask.T
    for i in range(m.shape[1]):
        r = runs(m[:, i])
        if not r:
            continue
        if len(r) > 1:
            multi += 1
            r = [max(r, key=lambda s: s[1] - s[0])]
        a, b = r[0]
        mid = (a + b) / 2
        pts.append((i, mid) if axis == 'x' else (mid, i))
    return pts, multi


def simplify(pts, n):
    """Resample to n points evenly spaced along arc length, lightly smoothed."""
    p = np.array(pts, float)
    # smooth with a moving average to iron out anti-alias jitter
    k = 9
    if len(p) > k:
        ker = np.ones(k) / k
        sm = np.c_[np.convolve(p[:, 0], ker, 'same'), np.convolve(p[:, 1], ker, 'same')]
        sm[:k // 2], sm[-(k // 2):] = p[:k // 2], p[-(k // 2):]
        p = sm
    seg = np.r_[0, np.cumsum(np.hypot(*np.diff(p, axis=0).T))]
    t = np.linspace(0, seg[-1], n)
    return np.c_[np.interp(t, seg, p[:, 0]), np.interp(t, seg, p[:, 1])], seg[-1]


def to_path(p):
    """Catmull-Rom through the points → cubic Béziers."""
    d = f'M{p[0][0]:.1f},{p[0][1]:.1f}'
    for i in range(len(p) - 1):
        p0, p1, p2, p3 = p[max(i - 1, 0)], p[i], p[i + 1], p[min(i + 2, len(p) - 1)]
        c1 = p1 + (p2 - p0) / 6
        c2 = p2 - (p3 - p1) / 6
        d += f' C{c1[0]:.1f},{c1[1]:.1f} {c2[0]:.1f},{c2[1]:.1f} {p2[0]:.1f},{p2[1]:.1f}'
    return d


out = {}
for nid, name in ROUTES.items():
    other = np.asarray(Image.open(f'{D}\\without-{nid}.png').convert('RGB')).astype(int)
    mask = np.abs(base - other).sum(axis=2) > 60
    ys, xs = np.nonzero(mask)
    best = None
    for axis in ('x', 'y'):
        pts, multi = centreline(mask, axis)
        if best is None or multi < best[2]:
            best = (axis, pts, multi)
    axis, pts, multi = best
    p, length = simplify(pts, 24)
    out[name] = {'bbox': [int(xs.min()), int(ys.min()), int(xs.max()), int(ys.max())], 'axis': axis,
                 'split_scanlines': multi, 'length': round(float(length)), 'start': p[0].round(1).tolist(),
                 'end': p[-1].round(1).tolist(), 'd': to_path(p)}
    print(f"{name:8} axis={axis} split={multi:3d} len={length:6.0f} start={p[0].round()} end={p[-1].round()} bbox={out[name]['bbox']}")

json.dump(out, open(f'{D}\\routes.json', 'w'), indent=1)

# crop box: everything non-white in the base, plus a margin
nonwhite = (base < 245).any(axis=2)
ys, xs = np.nonzero(nonwhite)
print('content bbox:', xs.min(), ys.min(), xs.max(), ys.max())
