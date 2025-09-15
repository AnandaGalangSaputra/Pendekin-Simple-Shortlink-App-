<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ShortlinkController extends Controller
{
    private $file = 'shortlinks.json';

    // Ambil semua shortlink
    public function index()
    {
        if (!Storage::exists($this->file)) {
            Storage::put($this->file, json_encode([]));
        }

        $data = json_decode(Storage::get($this->file), true);
        return response()->json($data);
    }

    // Simpan shortlink baru
    public function store(Request $request)
{
    $request->validate([
        'long_url' => 'required|url',
        'short_name' => 'required|string'
    ]);

    if (!Storage::exists($this->file)) {
        Storage::put($this->file, json_encode([]));
    }

    $data = json_decode(Storage::get($this->file), true);

    // Cek duplikat short_name
    foreach ($data as $item) {
        if ($item['short_name'] === $request->short_name) {
            return response()->json([
                'error' => 'Shortlink sudah digunakan!'
            ], 400);
        }
    }

    $newData = [
        'long_url' => $request->long_url,
        'short_name' => $request->short_name,
        'created_at' => now()->toDateTimeString(),
        'expired_at' => now()->addHours(12)->toDateTimeString(),
    ];

    $data[] = $newData;

    Storage::put($this->file, json_encode($data, JSON_PRETTY_PRINT));

    return response()->json([
        'message' => 'Shortlink berhasil dibuat!',
        'data' => [
            'long_url'   => $newData['long_url'],
            'short_name' => $newData['short_name'],
            // otomatis jadi http://127.0.0.1:8000/gpt3
            'short_url'  => url($newData['short_name']),
            'created_at' => $newData['created_at'],
            'expired_at' => $newData['expired_at'],
        ]
    ]);
}

}
