<?php

if (!defined('ROOT_DIR')) {
  define('ROOT_DIR', dirname(__DIR__) . '/');
}

$is_cli = (php_sapi_name() === 'cli' || defined('WP_CLI'));

if ($is_cli) {
  $hostname = 'cms.local.test'; // fallback for CLI
  $protocol = 'https://';
} else {
  if (isset($_SERVER['HTTP_X_FORWARDED_HOST']) && !empty($_SERVER['HTTP_X_FORWARDED_HOST'])) {
    $hostname = $_SERVER['HTTP_X_FORWARDED_HOST'];
  } else {
    $hostname = $_SERVER['HTTP_HOST'] ?? 'localhost';
  }

  if (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https') {
    $_SERVER['HTTPS'] = 'on';
  }

  $hostname = filter_var($hostname, FILTER_SANITIZE_STRING);

  if ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ||
    (!empty($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https')
  ) {
    $protocol = 'https://';
  } else {
    $protocol = 'http://';
  }
}

define('WP_CONTENT_DIR', ROOT_DIR . 'wp-content');
define('WP_CONTENT_URL', $protocol . rtrim($hostname, '/') . '/wp-content');

if (getenv('WP_ENV') !== false) {
  define('WP_ENV', preg_replace('/[^a-z]/', '', getenv('WP_ENV')));
}

if (!defined('WP_ENV')) {
  include ROOT_DIR . 'wp-config/wp-config.env.php';
}

include ROOT_DIR . 'wp-config/wp-config.default.php';
include ROOT_DIR . 'wp-config/wp-config.' . WP_ENV . '.php';

if (!defined('WP_SITEURL')) {
  define('WP_SITEURL', $protocol . rtrim($hostname, '/') . '/wordpress/');
}
if (!defined('WP_HOME')) {
  define('WP_HOME', $protocol . rtrim($hostname, '/'));
}

unset($hostname, $protocol);

if (!defined('ABSPATH')) {
  define('ABSPATH', dirname(__FILE__) . '/wordpress/');
}

require_once ABSPATH . 'wp-settings.php';
