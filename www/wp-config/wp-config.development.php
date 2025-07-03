<?php
// Site domain for local development
define('WP_HOME', 'https://cms.local.test');
define('WP_SITEURL', 'https://cms.local.test/wordpress'); // adjust if WP lives in root

// Database connection (matches docker-compose.yml)
define('DB_NAME',     'wordpress');
define('DB_USER',     'wordpress');
define('DB_PASSWORD', 'wordpress');
define('DB_HOST',     'db'); // ✅ important: do NOT use 'localhost' inside Docker

// Debugging settings
ini_set('log_errors', 'On');
ini_set('display_errors', 'On');
ini_set('error_reporting', E_ALL);

define('WP_DEBUG',         true);
define('WP_DEBUG_LOG',     true);
define('WP_DEBUG_DISPLAY', true);
define('SCRIPT_DEBUG',     true);
define('WP_ENVIRONMENT_TYPE', 'development');

// Public blog visibility
define('BLOG_PUBLIC', '1');
