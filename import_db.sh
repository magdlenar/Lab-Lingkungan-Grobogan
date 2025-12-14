#!/bin/sh
set -e

echo "MYSQLHOST=$MYSQLHOST"
echo "MYSQLPORT=$MYSQLPORT"
echo "MYSQLUSER=$MYSQLUSER"
echo "MYSQLDATABASE=$MYSQLDATABASE"
echo "MYSQLPASSWORD is set? -> $( [ -n "$MYSQLPASSWORD" ] && echo YES || echo NO )"

echo "Waiting for MySQL..."
until mysql -h "$MYSQLHOST" -P "$MYSQLPORT" -u "$MYSQLUSER" -p"$MYSQLPASSWORD" -e "SELECT 1" "$MYSQLDATABASE" >/dev/null 2>&1; do
  sleep 3
done

echo "Importing..."
mysql -h "$MYSQLHOST" -P "$MYSQLPORT" -u "$MYSQLUSER" -p"$MYSQLPASSWORD" "$MYSQLDATABASE" < aplikasi_lab.sql

echo "Done."
