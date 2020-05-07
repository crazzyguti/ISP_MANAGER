#!/bin/sh
basedir=$(dirname "$(echo "$0" | sed -e 's,\\,/,g')")

case `uname` in
    *CYGWIN*|*MINGW*|*MSYS*) basedir=`cygpath -w "$basedir"`;;
esac

if [ -x "$basedir/php" ]; then
  "$basedir/php"  "$basedir/../artisan" "$@"
  ret=$?
else 
  php  "$basedir/../artisan" "$@"
  ret=$?
fi
exit $ret
