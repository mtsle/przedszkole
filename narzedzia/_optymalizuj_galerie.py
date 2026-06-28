# -*- coding: utf-8 -*-
"""Optymalizacja zdjec do galerii Czarodziejski Dworek.
- dedup: jesli istnieje <stem>-scaled.<ext>, pomijamy twin bez -scaled (tez <stem>-N)
- odsiewamy miniaturki: dluzszy bok < 700 px
- WebP, dluzszy bok <= 1600, quality 83, exif_transpose
- wyjscie: img/real/galeria/{zycie|zajecia|joga}/
- generuje manifest (JS array) na stdout + plik _gallery_manifest.txt
"""
import re, json, sys
from pathlib import Path
from PIL import Image, ImageOps

SRC = Path(r"c:\Users\matot\Desktop\strona1\_pobrane")
OUT = Path(r"c:\Users\matot\Desktop\strona1\przedszkole-dworek\img\real\galeria")
MIN_LONG = 700
MAX_LONG = 1600
Q = 83
THUMB_LONG = 1000   # lekkie miniatury do siatki
QT = 80

# folder zrodlowy -> (kategoria-slug, podpisy znanych plikow)
CATS = {
    "galeria": "zycie",
    "program": "zajecia",
    "joga":    "joga",
}
CAPS = {
    "basen.jpg": "Basen",
    "Integracja-sensoryczna.jpg": "Integracja sensoryczna",
}

# Kategoria TREŚCIOWA (wg tego, co widać na zdjęciu) — niezależna od folderu/źródła.
# Klucz = nazwa pliku wynikowego bez rozszerzenia (stem po usunięciu -scaled).
# Domyślnie: galeria->sale, program->zajecia, joga->zajecia; poniżej wyjątki.
DEFAULT_CAT = {"galeria": "sale", "program": "zajecia", "joga": "zajecia"}
CATMAP = {
    # plac zabaw / ogród (seria DSCN86xx z folderu galeria)
    "DSCN8672": "plac", "DSCN8674": "plac", "DSCN8677": "plac", "DSCN8678": "plac",
    "DSCN8680": "plac", "DSCN8681": "plac", "DSCN8684": "plac", "DSCN8690": "plac",
    # DSCN8693 to szatnia (wnętrze) -> trafia do "sale" przez domyślne mapowanie
    # warsztaty (malowanie, zabawa z jajkami)
    "14352215_1127711757291514_4423992085707816596_o": "warsztaty",
    "18922542_1390890647640289_1906660161621174899_o": "warsztaty",
    # wycieczka / spacer (park, zbieranie kasztanów)
    "14441168_1135398743189482_7683901133527903398_n": "wycieczki",
}

def scaled_stems(files):
    """zwraca zbior stemow ktore maja wersje -scaled"""
    s = set()
    for f in files:
        m = re.match(r"^(.*)-scaled$", f.stem)
        if m:
            s.add(m.group(1))
    return s

def is_dup_twin(f, sstems):
    if "-scaled" in f.stem:
        return False
    if f.stem in sstems:
        return True
    # <stem>-N  (np. DSCN9985-1) -> traktuj jako twin DSCN9985
    m = re.match(r"^(.*)-\d+$", f.stem)
    if m and m.group(1) in sstems:
        return True
    return False

manifest = []
total_in = total_out = skipped_dup = skipped_small = 0

for folder, cat in CATS.items():
    sdir = SRC / folder
    if not sdir.is_dir():
        print(f"!! brak {sdir}")
        continue
    odir = OUT / cat
    odir.mkdir(parents=True, exist_ok=True)
    files = [p for p in sorted(sdir.iterdir())
             if p.is_file() and p.suffix.lower() in (".jpg", ".jpeg", ".png", ".webp")]
    sstems = scaled_stems(files)
    for f in files:
        total_in += 1
        if is_dup_twin(f, sstems):
            skipped_dup += 1
            print(f"  dup  {folder}/{f.name}")
            continue
        try:
            im = Image.open(f)
            im = ImageOps.exif_transpose(im)
            w, h = im.size
            if max(w, h) < MIN_LONG:
                skipped_small += 1
                print(f"  mini {folder}/{f.name} ({w}x{h})")
                continue
            if max(w, h) > MAX_LONG:
                if w >= h:
                    nw, nh = MAX_LONG, round(h * MAX_LONG / w)
                else:
                    nw, nh = round(w * MAX_LONG / h), MAX_LONG
                im = im.resize((nw, nh), Image.LANCZOS)
            else:
                nw, nh = w, h
            if im.mode in ("RGBA", "P", "LA"):
                im = im.convert("RGB")
            stem = re.sub(r"-scaled$", "", f.stem)
            out_name = stem + ".webp"
            im.save(odir / out_name, "WEBP", quality=Q, method=6)
            total_out += 1
            # lekka miniatura do siatki
            tdir = odir / "thumbs"; tdir.mkdir(exist_ok=True)
            tw, thh = nw, nh
            if max(nw, nh) > THUMB_LONG:
                if nw >= nh:
                    tw, thh = THUMB_LONG, round(nh * THUMB_LONG / nw)
                else:
                    tw, thh = round(nw * THUMB_LONG / nh), THUMB_LONG
            im.resize((tw, thh), Image.LANCZOS).save(tdir / out_name, "WEBP", quality=QT, method=6)
            display_cat = CATMAP.get(stem, DEFAULT_CAT.get(folder, "zajecia"))
            entry = {"src": f"img/real/galeria/{cat}/{out_name}",
                     "thumb": f"img/real/galeria/{cat}/thumbs/{out_name}",
                     "w": nw, "h": nh, "cat": display_cat}
            if f.name in CAPS:
                entry["cap"] = CAPS[f.name]
            manifest.append(entry)
        except Exception as e:
            print(f"  ERR  {folder}/{f.name}: {e}")

# manifest jako gotowa tablica JS
lines = []
for e in manifest:
    cap = f', cap:{json.dumps(e["cap"], ensure_ascii=False)}' if "cap" in e else ""
    lines.append(f'  {{src:"{e["src"]}", thumb:"{e["thumb"]}", w:{e["w"]}, h:{e["h"]}, cat:"{e["cat"]}"{cap}}},')
js = ("/* Auto-generowane przez _pobrane/_optymalizuj_galerie.py — nie edytuj ręcznie. */\n"
      "window.GALLERY = [\n" + "\n".join(lines) + "\n];\n")
out_js = Path(r"c:\Users\matot\Desktop\strona1\przedszkole-dworek\js\gallery-data.js")
out_js.write_text(js, encoding="utf-8")
Path(SRC / "_gallery_manifest.txt").write_text(js, encoding="utf-8")
print(f"dane galerii -> {out_js}")

print("\n==== PODSUMOWANIE ====")
print(f"wejscie: {total_in} | zapisane: {total_out} | dup: {skipped_dup} | mini: {skipped_small}")
for cat in set(CATS.values()):
    n = sum(1 for e in manifest if e["cat"] == cat)
    print(f"  {cat}: {n}")
print(f"manifest JS -> {SRC / '_gallery_manifest.txt'}")
