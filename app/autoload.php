<?php

namespace StoutLogic\UnderstoryTheme;

// Register our autoloaders
spl_autoload_register(__NAMESPACE__ . '\\autoload');

function autoload($cls)
{
    $cls = ltrim($cls, '\\');

    if (strpos($cls, __NAMESPACE__) !== 0) {
        return;
    }

    $classWithoutNameSpace = str_replace(__NAMESPACE__, '', $cls);
    $path = dirname(__FILE__) . str_replace('\\', DIRECTORY_SEPARATOR, $classWithoutNameSpace) . '.php';

    if (!file_exists($path)) {
        $classSlugified = strtolower(str_replace('_', '', preg_replace('/(?<=\\w)(?=[A-Z])/', "-$1", $classWithoutNameSpace)));
        $path = dirname(__FILE__) . str_replace('\\', DIRECTORY_SEPARATOR, $classSlugified) . '.php';
    }

    require_once($path);
}
