<?php

namespace App\Filament\Resources\DesainResource\Pages;

use App\Filament\Resources\DesainResource;
use Filament\Actions;
use Illuminate\Support\Facades\Storage;
use App\Services\SupabaseStorage;

use Filament\Resources\Pages\CreateRecord;

class CreateDesain extends CreateRecord
{
    protected static string $resource = DesainResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        try {
            if (isset($data['image']) && $data['image']) {
                // Get the temporary file path
                $tempPath = Storage::disk('public')->path($data['image']);
                
                // Generate unique filename
                $extension = pathinfo($data['image'], PATHINFO_EXTENSION);
                $fileName = 'desains/' . uniqid() . '.' . $extension;
                
                // Upload to Supabase
                $uploaded = SupabaseStorage::upload($tempPath, $fileName);
                
                if ($uploaded) {
                    // Delete temporary file
                    Storage::disk('public')->delete($data['image']);
                    
                    // Replace with Supabase path
                    $data['image'] = $fileName;
                } else {
                    throw new \Exception('Failed to upload to Supabase');
                }
            }
        } catch (\Exception $e) {
            logger()->error('Upload error in CreateDesain', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            throw $e;
        }

        return $data;
    }
}
