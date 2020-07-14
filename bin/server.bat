@echo OFF
:: in case DelayedExpansion is on and a path contains !
setlocal DISABLEDELAYEDEXPANSION
::php "%~dp0artisan" %*

set IP=www.gaberovo.bg
set PORT=8000

set URL=http://%IP%:%PORT%
set _Prog="C:\Program Files\Firefox Developer Edition\firefox.exe"
echo %URL%
 %_Prog% %URL%

php "%~dp0..\artisan" serve --host=%IP% --port=%PORT%




