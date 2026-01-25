<?php

namespace App\Filament\Resources\DesainResource\Pages;

use App\Filament\Resources\DesainResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use App\Services\SupabaseStorage;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Filament\Notifications\Notification;

class CreateDesain extends CreateRecord
{
    protected static string $resource = DesainResource::class;
    
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        if (isset($data['image']) && $data['image']) {
            try {
                $tempPath = Storage::disk('public')->path($data['image']);
                
                if (!file_exists($tempPath)) {
                    throw new \Exception("File temporary tidak ditemukan");
                }

                $extension = pathinfo($data['image'], PATHINFO_EXTENSION);
                $fileName = 'desains/' . uniqid() . '_' . time() . '.' . $extension;
                
                $uploaded = SupabaseStorage::upload($tempPath, $fileName);
                
                if (!$uploaded) {
                    throw new \Exception('Gagal mengupload file ke Supabase Storage');
                }

                // Hapus file temporary
                Storage::disk('public')->delete($data['image']);
                
                $data['image'] = $fileName;

            } catch (\Exception $e) {
                Log::error('CreateDesain - Upload error', [
                    'message' => $e->getMessage(),
                    'data' => $data
                ]);

                Notification::make()
                    ->title('Upload Gagal')
                    ->body('Terjadi kesalahan saat mengupload gambar: ' . $e->getMessage())
                    ->danger()
                    ->send();

                throw $e;
            }
        }

        return $data;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Desain berhasil ditambahkan')
            ->body('Data desain telah tersimpan.');
    }
}
