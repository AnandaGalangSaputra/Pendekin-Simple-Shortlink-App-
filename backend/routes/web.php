<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;


Route::get('/', function () {
    return view('welcome');
});



Route::get('/{short}', function ($short) {
    $file = 'shortlinks.json';

    if (!Storage::exists($file)) {
        abort(404, 'Shortlink tidak ditemukan');
    }

    $data = json_decode(Storage::get($file), true);

    foreach ($data as $item) {
        if ($item['short_name'] === $short) {
            // cek expire
            if (now()->greaterThan($item['expired_at'])) {
                abort(410, 'Shortlink sudah expired'); // 410 = Gone
            }
            return redirect($item['long_url']);
        }
    }

    abort(404, 'Shortlink tidak ditemukan');
});
