<?php

class Menu
{
    public static function isActiveRoute($route, $output = 'uk-active active-main-menu')
    {
        if (Route::currentRouteName() == $route) {
            return $output;
        }
    }

    public static function areActiveRoutes(array $routes, $output = 'active')
    {
        foreach ($routes as $route) {
            if (Route::currentRouteName() == $route) {
                return $output;
            }
        }
    }

    public static function isActiveAdminRoute($route, $output = 'active')
    {
        if (Route::currentRouteName() == $route) {
            return $output;
        }
    }

    public static function areActiveAdminRoutes(array $routes, $output = 'active')
    {
        foreach ($routes as $route) {
            if (Route::currentRouteName() == $route) {
                return $output;
            }
        }
    }

    public static function isActiveSubmenu($route, $output = 'uk-active')
    {
        if (Route::currentRouteName() == $route) {
            return $output;
        }
    }
}