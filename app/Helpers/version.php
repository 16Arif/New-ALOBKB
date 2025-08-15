<?php

if (!function_exists('app_version')) {
    function app_version()
    {
        return trim(file_get_contents(base_path('VERSION')));
    }
}
