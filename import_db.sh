#!/bin/sh
set -e

echo "MYSQLHOST=$MYSQLHOST"
echo "MYSQLPORT=$MYSQLPORT"
echo "MYSQLUSER=$MYSQLUSER"
echo "MYSQLDATABASE=$MYSQLDATABASE"
echo "MYSQLPASSWORD set? $( [ -n "$MYSQLPASSWORD" ] && echo YES || echo NO )"

echo "Testing connection..."
mysql -h "$MYSQLHOST" -P "$MYSQLPORT" -u "$MYSQLUSER" -p"$MYSQLPASSWORD" -e "SELECT VERSION();"

echo "Importing..."
mysql -h "$MYSQLHOST" -P "$MYSQLPORT" -u "$MYSQLUSER" -p"$MYSQLPASSWORD" "$MYSQLDATABASE" < aplikasi_lab.sql

echo "Done."
