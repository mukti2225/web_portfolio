<?php

namespace App\Filament\Resources\DesainResource\Pages;

use App\Filament\Resources\DesainResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use App\Services\SupabaseStorage;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Filament\Notifications\Notification;

class EditDesain extends EditRecord
{
    protected static string $resource = DesainResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
                ->before(function () {
                    // Hapus file dari Supabase sebelum delete
                    if ($this->record->image) {
                        SupabaseStorage::delete($this->record->image);
                    }
                }),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        // Cek apakah ada upload gambar baru
        if (isset($data['image']) && $data['image'] && str_starts_with($data['image'], 'temp/')) {
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

                // Hapus gambar lama dari Supabase jika ada
                if ($this->record->image) {
                    SupabaseStorage::delete($this->record->image);
                }

                // Hapus file temporary
                Storage::disk('public')->delete($data['image']);
                
                $data['image'] = $fileName;

            } catch (\Exception $e) {
                Log::error('EditDesain - Upload error', [
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

    protected function getSavedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Desain berhasil diupdate')
            ->body('Perubahan data telah tersimpan.');
    }
}
