<?php

define('DB_NAME', 'ifmvstage22');
define('DB_USER', 'ifmvstage22');
define('DB_PASSWORD', 'DBifmvstage258');
define('DB_HOST', 'localhost');

ini_set('log_errors','On');
ini_set('display_errors','Off');
ini_set('error_reporting', E_ALL );
define('WP_DEBUG', true);
define('WP_DEBUG_LOG', true);
define('WP_DEBUG_DISPLAY', false);

/* Multisite */
define( 'WP_ALLOW_MULTISITE', true );
define('MULTISITE', true);
define('SUBDOMAIN_INSTALL', false);
define('DOMAIN_CURRENT_SITE', 'dotaznik.assemblage.cz');
define('PATH_CURRENT_SITE', '/');
define('SITE_ID_CURRENT_SITE', 1);
define('BLOG_ID_CURRENT_SITE', 1);


define('BLOG_PUBLIC', '0');

// load up config / environment composer-based libraries
\Sentry\init(['dsn' => 'https://7a98a2d67a29451e923c71243ed1ee26@o275554.ingest.sentry.io/1872115', 'environment' => 'staging' ]);

