<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Desain;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use App\Services\SupabaseStorage;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\DesainResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\DesainResource\RelationManagers;

class DesainResource extends Resource
{
    protected static ?string $model = Desain::class;

    protected static ?string $navigationIcon = 'heroicon-o-photo';
    protected static ?string $navigationGroup = 'Portfolio';
    protected static ?string $title = 'Data Desain';
    protected static ?string $navigationLabel = 'Desain';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->label('Judul Project')
                    ->required(),

                Forms\Components\FileUpload::make('image')
                    ->label('Thumbnail')
                    ->storeFiles(false)
                    ->maxSize(2048)
                    // ->directory('desains')
                    ->saveUploadedFileUsing(function ($file) {
                        $path = 'desains/' . uniqid() . '.' . $file->getClientOriginalExtension();

                        SupabaseStorage::upload(
                            $file->getRealPath(),
                            $path
                        );

                        return $path;
                     })
                    ->required(),

                Forms\Components\TextInput::make('link')
                    ->label('Link')
                    ->url('link')
                    ->placeholder('https://example.com'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->label('Gambar')
                    ->getStateUsing(fn ($record) =>
                        SupabaseStorage::publicUrl($record->image)
                        )
                    ->height(80),

                Tables\Columns\TextColumn::make('title')
                    ->label('Judul')
                    ->searchable(),

                Tables\Columns\TextColumn::make('link')
                    ->label('Link')
                    ->limit(30)
                    ->url('link')
                    ->openUrlInNewTab(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDesains::route('/'),
            'create' => Pages\CreateDesain::route('/create'),
            'edit' => Pages\EditDesain::route('/{record}/edit'),
        ];
    }
}
