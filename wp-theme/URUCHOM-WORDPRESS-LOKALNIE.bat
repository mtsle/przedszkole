@echo off
chcp 65001 >nul
title Czarodziejski Dworek - lokalny WordPress
cd /d "%~dp0"
echo.
echo ============================================================
echo   Uruchamiam lokalny WordPress (Czarodziejski Dworek)...
echo   Adres:  http://127.0.0.1:8881
echo   Login:  admin    Haslo: password
echo.
echo   ZOSTAW TO OKNO OTWARTE - tu dziala serwer.
echo   Aby wylaczyc WordPressa: zamknij to okno.
echo ============================================================
echo.
rem Otworz Chrome z opoznieniem (gdy serwer juz wstanie)
start "" /b cmd /c "timeout /t 12 >nul & start "" chrome http://127.0.0.1:8881/ || start "" http://127.0.0.1:8881/"
rem Uruchom prawdziwy WordPress (PHP-wasm), motyw zamontowany, strony z blueprintu
npx --yes @wp-playground/cli@latest start --port=8881 --mount=czarodziejski-dworek:/wordpress/wp-content/themes/czarodziejski-dworek --blueprint=blueprint.json
pause
