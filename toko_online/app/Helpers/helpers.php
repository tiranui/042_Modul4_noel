<?php

if (!function_exists('rupiah')) {
    function rupiah($angka): string
    {
        return 'Rp ' . number_format((float) $angka, 0, ',', '.');
    }
}

if (!function_exists('generate_id_user')) {
    function generate_id_user(): string
    {
        $last = \App\Models\User::orderByDesc('id_user')->first();

        if (! $last) {
            return 'USR00001';
        }

        $digits = preg_replace('/\D/', '', $last->id_user);
        $num = $digits !== '' ? ((int) $digits) + 1 : 1;

        return 'USR' . str_pad($num, 5, '0', STR_PAD_LEFT);
    }
}

if (!function_exists('generate_id_order')) {
    function generate_id_order(): string
    {
        return 'ORD' . date('Ymd') . strtoupper(substr(uniqid(), -4));
    }
}