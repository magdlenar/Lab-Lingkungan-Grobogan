#!/bin/sh
set -e

echo "Waiting for MySQL..."
until mysqladmin ping -h"$MYSQLHOST" -P"$MYSQLPORT" -u"$MYSQLUSER" -p"$MYSQLPASSWORD" --silent; do
  sleep 2
done

echo "Importing aplikasi_lab.sql..."
mysql -h "$MYSQLHOST" -P "$MYSQLPORT" -u "$MYSQLUSER" -p"$MYSQLPASSWORD" "$MYSQLDATABASE" < aplikasi_lab.sql

echo "Done."
