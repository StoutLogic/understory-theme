<?php

namespace StoutLogic\DPatents\Helpers;

class Image
{
    public static function url($filename)
    {
        return \get_template_directory_uri().'/assets/dist/img/'.$filename;
    }
}
