<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UiResource\Pages;
use App\Filament\Resources\UiResource\RelationManagers;
use App\Models\Ui;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

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
                    ->directory('uis')
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
                    ->label('Gambar'),

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
