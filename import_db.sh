#!/bin/sh
set -e

# MySQL client kamu tidak support --ssl-mode, jadi pakai opsi SSL lama yang kompatibel
MYSQL_OPTS="--ssl=1 --ssl-verify-server-cert=0"

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
