<?php

namespace App\Filament\Resources\DesainResource\Pages;

use App\Filament\Resources\DesainResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDesain extends EditRecord
{
    protected static string $resource = DesainResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        try {
            if (isset($data['image']) && $data['image'] && str_starts_with($data['image'], 'temp/')) {
                // Get the temporary file path
                $tempPath = Storage::disk('public')->path($data['image']);
                
                // Generate unique filename
                $extension = pathinfo($data['image'], PATHINFO_EXTENSION);
                $fileName = 'desains/' . uniqid() . '.' . $extension;
                
                // Upload to Supabase
                $uploaded = SupabaseStorage::upload($tempPath, $fileName);
                
                if ($uploaded) {
                    // Delete old file from Supabase if exists
                    // You might want to add a delete method to SupabaseStorage
                    
                    // Delete temporary file
                    Storage::disk('public')->delete($data['image']);
                    
                    // Replace with Supabase path
                    $data['image'] = $fileName;
                } else {
                    throw new \Exception('Failed to upload to Supabase');
                }
            }
        } catch (\Exception $e) {
            logger()->error('Upload error in EditDesain', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            throw $e;
        }

        return $data;
    }
}
