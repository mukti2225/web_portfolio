<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class SupabaseStorage
{
    public static function upload($file, $path)
    {
        $response = Http::withHeaders([
            'apikey' => config('services.supabase.key'),
            'Authorization' => 'Bearer ' . config('services.supabase.key'),
        ])->attach(
            'file',
            file_get_contents($file),
            $path
        )->post(
            config('services.supabase.url') . "/storage/v1/object/uploads/{$path}"
        );

        return $response->successful();
    }

    public static function publicUrl($path)
    {
        return config('services.supabase.url') . "/storage/v1/object/public/uploads/{$path}";
    }
}
