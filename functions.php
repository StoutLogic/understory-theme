<?php

namespace StoutLogic\UnderstoryTheme;

use StoutLogic\UnderstoryTheme\Config;

// Bootstrap
require_once('app/autoload.php');

// Make sure Timber is activated
if (class_exists('\Understory\Site')) {
    // Ensure our required plugins are loaded
    $plugins = new Config\Plugins();

    $site = new Site();
}
