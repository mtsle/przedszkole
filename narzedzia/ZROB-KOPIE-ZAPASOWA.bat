@echo off
REM Dwuklik = kopia zapasowa calego projektu do folderu _kopie-zapasowe.
REM Trzyma 7 ostatnich kopii (starsze kasuje automatycznie).
cd /d "%~dp0"
powershell -ExecutionPolicy Bypass -File "%~dp0backup.ps1"
echo.
echo Nacisnij dowolny klawisz, aby zamknac...
pause >nul
