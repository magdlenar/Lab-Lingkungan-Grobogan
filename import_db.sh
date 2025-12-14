#!/bin/sh
set -e

echo "Waiting for MySQL..."
until mysql -h "$MYSQLHOST" -P "$MYSQLPORT" -u "$MYSQLUSER" -p"$MYSQLPASSWORD" -e "SELECT 1" "$MYSQLDATABASE"; do
  sleep 3
done

echo "Importing database..."
mysql -h "$MYSQLHOST" -P "$MYSQLPORT" -u "$MYSQLUSER" -p"$MYSQLPASSWORD" "$MYSQLDATABASE" < aplikasi_lab.sql

echo "Import done."
