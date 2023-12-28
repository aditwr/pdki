<?php

if (!function_exists('formatDate')) {
    function formatDate($date, $format = 'd F Y')
    {
        return \Carbon\Carbon::parse($date)->format($format);
    }
}
if (!function_exists('user_email')) {
    function user_email()
    {
        return auth()->user()->email;
    }
}
