@echo OFF
:: in case DelayedExpansion is on and a path contains !
setlocal DISABLEDELAYEDEXPANSION
::php "%~dp0artisan" %*

set IP="192.168.0.100"

php "%~dp0..\artisan" serve --host=%IP% --port=8000

