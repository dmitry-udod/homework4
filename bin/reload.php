<?php

require_once __DIR__.'/base_script.php';

build_bootstrap();

show_run("fixtures:load", "app/console doctrine:mongodb:fixtures:load");
show_run("schema:create", "app/console doctrine:mongodb:schema:create");
show_run("schema:create:index", "app/console doctrine:mongodb:schema:create --index");

show_run("Destroying cache dir manually", "rm -rf app/cache/*");

show_run("Creating directories for app kernel", "mkdir -p app/cache/dev app/cache/test app/logs");

show_run("Warming up dev cache", "php app/console --env=dev cache:clear");
show_run("Warming up dev cache", "php app/console --env=prod cache:clear");
//show_run("Warming up test cache", "php app/console --env=test cache:clear");

show_run("Changing permissions", "chmod -R 777 app/cache app/logs");

show_run("assets:install", "app/console assets:install");
show_run("Changing permissions", "chmod -R 777 app/cache app/logs web/uploads");

exit(0);