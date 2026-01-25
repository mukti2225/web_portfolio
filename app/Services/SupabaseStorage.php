<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class SupabaseStorage
{
    protected static string $bucket = 'uploads';

    public static function upload(string $filePath, string $path): bool
    {
        try {
            if (!file_exists($filePath)) {
                Log::error('File not found for upload', ['path' => $filePath]);
                return false;
            }

            $fileContent = file_get_contents($filePath);
            $mimeType = mime_content_type($filePath) ?: 'application/octet-stream';

            $response = Http::withHeaders([
                'apikey' => config('services.supabase.key'),
                'Authorization' => 'Bearer ' . config('services.supabase.key'),
                'Content-Type' => $mimeType,
            ])->withBody($fileContent, $mimeType)
              ->post(config('services.supabase.url') . "/storage/v1/object/" . self::$bucket . "/" . $path);

            if (!$response->successful()) {
                Log::error('Supabase upload failed', [
                    'status' => $response->status(),
                    'body' => $response->body(),
                    'path' => $path
                ]);
                return false;
            }

            Log::info('Supabase upload success', ['path' => $path]);
            return true;

        } catch (\Exception $e) {
            Log::error('Supabase upload exception', [
                'error' => $e->getMessage(),
                'path' => $path
            ]);
            return false;
        }
    }

    public static function delete(string $path): bool
    {
        try {
            $response = Http::withHeaders([
                'apikey' => config('services.supabase.key'),
                'Authorization' => 'Bearer ' . config('services.supabase.key'),
            ])->delete(config('services.supabase.url') . "/storage/v1/object/" . self::$bucket . "/" . $path);

            if (!$response->successful()) {
                Log::warning('Supabase delete failed', [
                    'status' => $response->status(),
                    'body' => $response->body(),
                    'path' => $path
                ]);
                return false;
            }

            Log::info('Supabase delete success', ['path' => $path]);
            return true;

        } catch (\Exception $e) {
            Log::error('Supabase delete exception', [
                'error' => $e->getMessage(),
                'path' => $path
            ]);
            return false;
        }
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
