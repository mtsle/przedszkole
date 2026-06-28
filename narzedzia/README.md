# Narzędzia

Skrypty pomocnicze używane przy budowie strony. **Nie są częścią deliverable'u** —
służą tylko do przygotowania zasobów.

- `_optymalizuj_galerie.py` — optymalizacja i konwersja zdjęć galerii (zmniejszanie wagi, WebP).
- `_montaz.py` — montaż / przygotowanie grafik źródłowych.

## Wymagania
Python 3.10+ oraz `Pillow` (`pip install Pillow`).

## Użycie
Uruchamiać z katalogu, w którym znajdują się obrazy źródłowe, np.:
```bash
python _optymalizuj_galerie.py
```
> Skrypty były pisane pod konkretny układ folderów roboczych — przed użyciem
> sprawdź ścieżki w nagłówku pliku.
