<?php

define('WP_CLI', true);

// nastav ručně potřebné konstanty (uprav podle potřeby)
define('DB_NAME', 'wordpress');
define('DB_USER', 'wordpress');
define('DB_PASSWORD', 'wordpress');
define('DB_HOST', 'db:3306');
define('WP_DEBUG', true);

define('WP_HOME', 'https://cms.local.test');
define('WP_SITEURL', 'https://cms.local.test/wordpress');

// absolutní cesta k WordPressu (uprav podle cesty)
define('ABSPATH', __DIR__ . '/wordpress/');

require_once ABSPATH . 'wp-settings.php';
