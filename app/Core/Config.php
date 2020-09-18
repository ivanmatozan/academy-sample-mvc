<?php

namespace App\Core;

class Config
{
    public static function get(string $key)
    {
        $configPath = 'app' . DIRECTORY_SEPARATOR . 'config.php';
        $config = include BP . DIRECTORY_SEPARATOR . $configPath;
        return $config[$key] ?? null;
    }
}
