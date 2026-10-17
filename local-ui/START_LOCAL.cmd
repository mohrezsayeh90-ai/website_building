@echo off
setlocal
cd /d "%~dp0"
set "MEHRABAD_PHP="
if exist "%~dp0..\php\php.exe" set "MEHRABAD_PHP=%~dp0..\php\php.exe"
if not defined MEHRABAD_PHP if exist "%~dp0..\..\php\php.exe" set "MEHRABAD_PHP=%~dp0..\..\php\php.exe"
if not defined MEHRABAD_PHP for /f "delims=" %%P in ('where php.exe 2^>nul') do if not defined MEHRABAD_PHP set "MEHRABAD_PHP=%%P"
if not defined MEHRABAD_PHP (
    echo PHP was not found. Extract this folder inside TEST, next to Apache24 and php.
    pause
    exit /b 1
)
echo Mehrabad local UI - sample data, browser-only drafts.
echo Keep this window open. Press Ctrl+C to stop.
powershell.exe -NoProfile -Command "try{$c=New-Object Net.Sockets.TcpClient;$c.Connect('127.0.0.1',8033);$c.Dispose();exit 1}catch{exit 0}"
if errorlevel 1 (
    echo Port 8033 is already in use. Close the existing local UI first.
    pause
    exit /b 1
)
start "" /b powershell.exe -NoProfile -Command "$u='http://127.0.0.1:8033/mehrabad/home'; for($n=0;$n -lt 40;$n++){try{$r=Invoke-WebRequest -Uri $u -UseBasicParsing -TimeoutSec 1;if($r.StatusCode -eq 200){Start-Process $u;break}}catch{};Start-Sleep -Milliseconds 250}"
"%MEHRABAD_PHP%" -n -S 127.0.0.1:8033 -t "%~dp0public" "%~dp0router.php"
set "MEHRABAD_EXIT=%ERRORLEVEL%"
if not "%MEHRABAD_EXIT%"=="0" pause
exit /b %MEHRABAD_EXIT%
