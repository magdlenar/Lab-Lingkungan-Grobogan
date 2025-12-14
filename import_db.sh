#!/bin/sh
set -e

MYSQL_OPTS="--protocol=tcp --ssl=0"

echo "MYSQLHOST=$MYSQLHOST"
echo "MYSQLPORT=$MYSQLPORT"
echo "MYSQLUSER=$MYSQLUSER"
echo "MYSQLDATABASE=$MYSQLDATABASE"
echo "MYSQLPASSWORD set? $( [ -n "$MYSQLPASSWORD" ] && echo YES || echo NO )"

echo "Testing connection..."
mysql $MYSQL_OPTS -h "$MYSQLHOST" -P "$MYSQLPORT" -u "$MYSQLUSER" -p"$MYSQLPASSWORD" -e "SELECT 1;" "$MYSQLDATABASE"

echo "Importing..."
mysql $MYSQL_OPTS -h "$MYSQLHOST" -P "$MYSQLPORT" -u "$MYSQLUSER" -p"$MYSQLPASSWORD" "$MYSQLDATABASE" < aplikasi_lab.sql

echo "Done."
