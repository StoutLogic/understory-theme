<?php

namespace StoutLogic\UnderstoryTheme\Helpers;

class Json
{
    public static function encode($value)
    {
        return json_encode($value, JSON_PRETTY_PRINT);
    }
}
