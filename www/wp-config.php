<?php
define('PROJECT_NAME', 'cms');


// Define environment hostnames
define('WP_ENV_DEV_HOSTNAME', PROJECT_NAME . '.local.test');
define('WP_ENV_STAGING_HOSTNAME', PROJECT_NAME . '-stage' . '.jakubferenc' . '.cz');
define('WP_ENV_PRODUCTION_HOSTNAME', 'cms.jakubferenc.cz');


$autoload = __DIR__ . '/../vendor/autoload.php';
if (file_exists($autoload)) {
  require_once $autoload;
}
// boot up the app
require_once(__DIR__ . '/wp-config/wp-config.boot.php');
