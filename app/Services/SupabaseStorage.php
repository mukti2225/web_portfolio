<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class SupabaseStorage
{
    protected static string $bucket = 'uploads';

    public static function upload(string $filePath, string $path): bool
    {
        $response = Http::withHeaders([
            'apikey' => config('services.supabase.key'),
            'Authorization' => 'Bearer ' . config('services.supabase.key'),
            'Content-Type' => 'application/octet-stream',
        ])->withBody(
            file_get_contents($filePath),
            'application/octet-stream'
        )->post(
            config('services.supabase.url') . "/storage/v1/object/" . self::$bucket . "/" . $path
        );

        if (! $response->successful()) {
            logger()->error('Supabase upload failed', [
                'status' => $response->status(),
                'body' => $response->body()
            ]);
        }

        return $response->successful();
    }

    public static function publicUrl(string $path): string
    {
        return config('services.supabase.url')
            . "/storage/v1/object/public/"
            . self::$bucket
            . "/"
            . $path;
    }
}
