<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class SupabaseStorage
{
    protected static string $bucket = 'uploads';
    // app/Services/SupabaseStorage.php

public static function upload(string $filePath, string $path): bool
{
    try {
        if (!empty($filePath) && file_exists($filePath)) {
            $fileContent = file_get_contents($filePath);
            $mimeType = mime_content_type($filePath) ?: 'application/octet-stream';

            $url = rtrim(config('services.supabase.url'), '/') . "/storage/v1/object/" . self::$bucket . "/" . $path;

            $response = Http::withHeaders([
                'apikey' => config('services.supabase.key'),
                'Authorization' => 'Bearer ' . config('services.supabase.key'),
            ])->withBody($fileContent, $mimeType)
              ->post($url);

            return $response->successful();
        }
        return false;
    } catch (\Exception $e) {
        \Illuminate\Support\Facades\Log::error($e->getMessage());
        return false;
    }
}
}