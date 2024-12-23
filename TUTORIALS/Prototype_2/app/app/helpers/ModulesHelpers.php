<?php

if (!function_exists('base_module_path')) {
    function base_module_path($path = '')
    {
        // TODO : on peut charger le string "modules" depuis config("modules.module_path")
        return base_path('modules') . ($path ? DIRECTORY_SEPARATOR . $path : '');
    }
}
