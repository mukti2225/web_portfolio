<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class SupabaseStorage
{
   protected static string $bucket = 'uploads';

    // Pastikan fungsi ini ada dan bersifat 'public static'
    public static function publicUrl(string $path): string
    {
        return rtrim(config('services.supabase.url'), '/') 
            . "/storage/v1/object/public/" 
            . self::$bucket 
            . "/" 
            . $path;
    }
}