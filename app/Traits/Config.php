<?php
namespace App\Traits;

trait Config
{
    private function config($name, $key = null, $default = '')
    {
        $config = json_decode(\App\Models\Admin\Config::findOrFail($name)->value, true);
        if ($key) {
            if ($config[$key]) {
                return $config[$key];
            } else {
                return $default;
            }
        } else {
            return $config;
        }
    }
}