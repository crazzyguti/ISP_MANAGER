@echo OFF
:: in case DelayedExpansion is on and a path contains !
setlocal DISABLEDELAYEDEXPANSION
::php "%~dp0artisan" %*
php "%~dp0..\artisan" route:list
php "%~dp0..\artisan" route:list>routeslist.txt
