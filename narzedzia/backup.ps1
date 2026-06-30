<#
.SYNOPSIS
    Kopia zapasowa projektu „Czarodziejski Dworek" — spakowany ZIP z datą.

.OPIS (PL)
    Tworzy spakowane archiwum ZIP całego projektu (motyw WordPress + statyka +
    dokumentacja), z datą i godziną w nazwie, w folderze kopii zapasowych.
    Pomija śmieci (node_modules, .git, stare ZIP-y). Trzyma kilka ostatnich
    kopii i kasuje najstarsze (rotacja), żeby nie zapełnić dysku.

    To jest kopia LOKALNA (na tym komputerze). Druga, niezależna kopia to
    GitHub (repozytorium mtsle/przedszkole) — patrz ZABEZPIECZENIA.md.
    Trzecia kopia (gdy strona już działa u klienta) to wtyczka UpdraftPlus,
    która kopiuje bazę danych i pliki do chmury.

.UŻYCIE
    Kliknij prawym na pliku → „Uruchom w programie PowerShell".
    Albo w terminalu:
        powershell -ExecutionPolicy Bypass -File narzedzia\backup.ps1
    Opcjonalnie własny folder docelowy i liczba kopii:
        powershell -ExecutionPolicy Bypass -File narzedzia\backup.ps1 -Cel "D:\Kopie" -IleTrzymac 10
#>

param(
    # Folder, w którym lądują kopie ZIP. Domyślnie: <projekt>\_kopie-zapasowe
    [string]$Cel = "",
    # Ile ostatnich kopii zachować (starsze są kasowane).
    [int]$IleTrzymac = 7
)

$ErrorActionPreference = "Stop"

# --- Ustal katalog projektu (rodzic folderu narzedzia\) ---
$Projekt = Split-Path -Parent $PSScriptRoot
if (-not $Projekt) { $Projekt = (Get-Location).Path }

if (-not $Cel) { $Cel = Join-Path $Projekt "_kopie-zapasowe" }
if (-not (Test-Path $Cel)) { New-Item -ItemType Directory -Path $Cel -Force | Out-Null }

# --- Nazwa pliku z datą: kopia-2026-06-30_2310.zip ---
$Stempel = Get-Date -Format "yyyy-MM-dd_HHmm"
$ZipPath = Join-Path $Cel "czarodziejski-dworek-kopia-$Stempel.zip"

Write-Host "==> Tworzę kopię zapasową projektu..." -ForegroundColor Cyan
Write-Host "    Źródło: $Projekt"
Write-Host "    Plik:   $ZipPath"

# --- Foldery / wzorce do pominięcia (śmieci, duplikaty, ciężkie) ---
$Pomijaj = @("node_modules", ".git", "_kopie-zapasowe", "_archiwum", "_pobrane", "_podglad-wp")

# --- Zbierz pliki do spakowania ---
$pliki = Get-ChildItem -Path $Projekt -Recurse -File -Force | Where-Object {
    $sciezka = $_.FullName.Substring($Projekt.Length).TrimStart('\')
    $pierwszy = $sciezka.Split('\')[0]
    ($Pomijaj -notcontains $pierwszy) -and ($_.Extension -ne ".zip")
}

if (-not $pliki) { throw "Nie znaleziono plików do spakowania w $Projekt" }

# --- Pakowanie z zachowaniem struktury (relatywne ścieżki, ukośniki '/') ---
Add-Type -AssemblyName System.IO.Compression
Add-Type -AssemblyName System.IO.Compression.FileSystem

if (Test-Path $ZipPath) { Remove-Item $ZipPath -Force }
$zip = [System.IO.Compression.ZipFile]::Open($ZipPath, [System.IO.Compression.ZipArchiveMode]::Create)
try {
    foreach ($p in $pliki) {
        $rel = $p.FullName.Substring($Projekt.Length).TrimStart('\').Replace('\','/')
        [System.IO.Compression.ZipFileExtensions]::CreateEntryFromFile($zip, $p.FullName, $rel, [System.IO.Compression.CompressionLevel]::Optimal) | Out-Null
    }
} finally {
    $zip.Dispose()
}

$rozmiarMB = [math]::Round((Get-Item $ZipPath).Length / 1MB, 1)
Write-Host "==> Gotowe: $($pliki.Count) plików, $rozmiarMB MB" -ForegroundColor Green

# --- Rotacja: zostaw N najnowszych, skasuj starsze ---
$stare = Get-ChildItem -Path $Cel -Filter "czarodziejski-dworek-kopia-*.zip" |
    Sort-Object LastWriteTime -Descending | Select-Object -Skip $IleTrzymac
if ($stare) {
    Write-Host "==> Rotacja: kasuję $($stare.Count) starszych kopii (trzymam $IleTrzymac)..." -ForegroundColor Yellow
    $stare | Remove-Item -Force
}

Write-Host ""
Write-Host "GOTOWE. Kopie w: $Cel" -ForegroundColor Green
Write-Host "Pamiętaj o drugiej kopii poza komputerem (GitHub / chmura) — patrz ZABEZPIECZENIA.md."
