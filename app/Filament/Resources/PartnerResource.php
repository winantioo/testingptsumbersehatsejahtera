<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PartnerResource\Pages;
use App\Models\Partner;

use Filament\Resources\Resource;
use Filament\Schemas\Schema; 
use Filament\Tables\Table;

use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions;

class PartnerResource extends Resource
{
    protected static ?string $model = Partner::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-hand-raised';
    protected static ?string $navigationLabel = 'Partners';
    protected static ?string $pluralModelLabel = 'Partners';
    protected static ?int $navigationSort = 3;

public static function form(Schema $schema): Schema
{
    return $schema->schema([
        FileUpload::make('logo_path')
            ->label('Logo Perusahaan / Principal')
            ->disk('public')
            ->directory('partners')
            ->image()
            ->imageEditor() 
            ->acceptedFileTypes(types: ['image/png', 'image/jpeg', 'image/webp', 'image/svg+xml'])
            ->maxSize(2048)
            ->required()
            ->columnSpanFull()
    ]);
}

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('logo_path')
                    ->label('Logo')
                    ->disk('public')
                    ->size(80)
                    ->square(),
                    
                TextColumn::make('created_at')
                    ->label('Diupload pada')
                    ->dateTime('d M Y')
                    ->sortable(),
         ])
            ->filters([
                //
            ])
            ->actions([
                \Filament\Actions\EditAction::make(),
                \Filament\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                \Filament\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPartners::route('/'),
            'create' => Pages\CreatePartner::route('/create'),
            'edit' => Pages\EditPartner::route('/{record}/edit'),
        ];
    }
}