<?php

use Carbon\Carbon;

if (!function_exists('formatDate')) {
    function formatDate($date, $format = 'd-m-Y H:i:s')
    {
        return Carbon::parse($date)->format($format);
    }
}

if (!function_exists('formatRupiah')) {
    function formatRupiah($value) {
        return 'Rp ' . number_format($value, 0, ',', '.');
    }
}

if (!function_exists('formatNumber')) {
    function formatNumber($value) {
        return number_format($value, 0, ',', '.');
    }
}
