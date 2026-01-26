<?php

namespace App\Filament\Resources;

use App\Models\Ui;
use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use App\Services\SupabaseStorage;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\UiResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\UiResource\RelationManagers;

class UiResource extends Resource
{
    protected static ?string $model = Ui::class;

    protected static ?string $navigationIcon = 'heroicon-o-eye';
    protected static ?string $navigationGroup = 'Portfolio';
    protected static ?string $title = 'Data UI/UX';
    protected static ?string $navigationLabel = 'UI/UX';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->label('Judul Project')
                    ->required(),

                Forms\Components\FileUpload::make('image')
                    ->label('Thumbnail')
                    ->image()
                    ->disk('supabase')       // Langsung tunjuk ke disk supabase
                    ->directory('uis')    // Folder di dalam bucket
                    ->visibility('public')    // Agar bisa diakses publik
                    ->maxSize(2048)
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
                    ->disk('supabase')
                    ->visibility('public')
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
            'index' => Pages\ListUis::route('/'),
            'create' => Pages\CreateUi::route('/create'),
            'edit' => Pages\EditUi::route('/{record}/edit'),
        ];
    }
}
