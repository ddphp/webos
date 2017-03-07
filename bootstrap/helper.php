<?php
if (!function_exists('menu_route')) {
    function menu_route($act)
    {
        $r = explode('?', $act);
        $p = isset($r[1]) ? explode('|', $r[1]) : [];
        return route($r[0], $p);
    }
}
