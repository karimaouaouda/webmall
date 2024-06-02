<?php

if( !function_exists('karim') ){
    function karim(): string
    {
        return "from karim helper";
    }
}


if( !function_exists('ids_path') ){
    function ids_path($guard): string
    {
        return '/ids/' . $guard . 's/' . $guard . '_' . auth($guard)->user()->id . '/';
    }
}
