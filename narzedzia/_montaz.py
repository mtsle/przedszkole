# -*- coding: utf-8 -*-
"""Tworzy oznaczone montaze (kontaktowki) wszystkich zdjec galerii do kategoryzacji wizualnej."""
import json
from pathlib import Path
from PIL import Image, ImageDraw, ImageFont, ImageOps

BASE = Path(r"c:\Users\matot\Desktop\strona1\przedszkole-dworek\img\real\galeria")
CATS = ["zycie", "zajecia", "joga"]
OUT = Path(r"c:\Users\matot\Desktop\strona1")
CELL_W, CELL_H, LABEL_H = 360, 270, 26
COLS, PER = 6, 30

try:
    font = ImageFont.truetype(r"C:\Windows\Fonts\arialbd.ttf", 22)
    fsmall = ImageFont.truetype(r"C:\Windows\Fonts\arial.ttf", 13)
except Exception:
    font = ImageFont.load_default(); fsmall = font

# zbierz pliki w tej samej kolejnosci co gallery-data
files = []
for cat in CATS:
    tdir = BASE / cat / "thumbs"
    for f in sorted(tdir.glob("*.webp")):
        files.append((cat, f))

legend = []
chunks = [files[i:i+PER] for i in range(0, len(files), PER)]
for ci, chunk in enumerate(chunks):
    rows = (len(chunk) + COLS - 1) // COLS
    W = COLS * CELL_W
    H = rows * (CELL_H + LABEL_H)
    sheet = Image.new("RGB", (W, H), (245, 240, 232))
    d = ImageDraw.Draw(sheet)
    for k, (cat, f) in enumerate(chunk):
        gi = ci * PER + k  # globalny indeks
        legend.append({"i": gi, "cat": cat, "name": f.stem})
        col, row = k % COLS, k // COLS
        x = col * CELL_W
        y = row * (CELL_H + LABEL_H)
        im = ImageOps.contain(Image.open(f).convert("RGB"), (CELL_W - 6, CELL_H - 6))
        ox = x + (CELL_W - im.width) // 2
        oy = y + (CELL_H - im.height) // 2
        sheet.paste(im, (ox, oy))
        # etykieta
        d.rectangle([x, y + CELL_H, x + CELL_W, y + CELL_H + LABEL_H], fill=(30, 22, 16))
        d.text((x + 6, y + CELL_H + 4), f"#{gi}  {f.stem[:34]}", fill=(255, 230, 180), font=fsmall)
        # duzy indeks w rogu
        d.rectangle([x + 2, y + 2, x + 46, y + 28], fill=(249, 115, 22))
        d.text((x + 6, y + 3), f"{gi}", fill=(255, 255, 255), font=font)
    out = OUT / f"_montaz_{ci+1}.png"
    sheet.save(out)
    print(f"OK {out}  ({len(chunk)} zdj)")

(OUT / "_montaz_legend.json").write_text(json.dumps(legend, ensure_ascii=False, indent=0), encoding="utf-8")
print(f"legenda -> {OUT/'_montaz_legend.json'}  | razem {len(files)} zdj, {len(chunks)} montaze")
