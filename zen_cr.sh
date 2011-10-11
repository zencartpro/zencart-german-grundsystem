chmod -R 777 cache
chmod -R 777 images
chmod -R 777 includes/languages/english/html_includes
chmod -R 777 includes/languages/german/html_includes
chmod -R 777 media
chmod -R 777 pub

chmod -R 777 admin/backups
chmod -R 777 admin/images/graphs

chmod -R 777 $1/backups
chmod -R 777 $1/images/graphs

touch includes/configure.php
touch admin/includes/configure.php
chmod 444 includes/configure.php
chmod 444 $1/includes/configure.php


