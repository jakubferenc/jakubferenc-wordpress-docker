<?php
define('PROJECT_NAME', 'cms');


// Define environment hostnames
define('WP_ENV_DEV_HOSTNAME', PROJECT_NAME . '.local');
define('WP_ENV_STAGING_HOSTNAME', PROJECT_NAME . '-stage' . '.jakubferenc' . '.cz');
define('WP_ENV_PRODUCTION_HOSTNAME', 'cms.jakubferenc.cz');


define('COMPOSER_AUTOLOAD_PATH', dirname(__DIR__) . '/vendor/autoload.php');

// require composer autoload
require_once(COMPOSER_AUTOLOAD_PATH);

// boot up the app
require_once(__DIR__ . '/wp-config/wp-config.boot.php');
