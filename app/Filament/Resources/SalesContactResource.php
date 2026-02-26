<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SalesContactResource\Pages;
use App\Models\SalesContact;

use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;

use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions;

class SalesContactResource extends Resource
{
    protected static ?string $model = SalesContact::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationLabel = 'Contact Sales';
    protected static ?int $navigationSort = 3;

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            TextInput::make('name')
                ->label('Nama Sales')
                ->required()
                ->maxLength(255),

            TextInput::make('area_id')
                ->label('Area Penjualan')
                ->required()
                ->maxLength(255),

            TextInput::make('whatsapp')
                ->label('Nomor WhatsApp')
                ->required()
                ->maxLength(30)
                ->helperText('Boleh 08xxx / +62xxx / 62xxx.'),

            FileUpload::make('photo_path')
                ->label('Foto Sales')
                ->disk('public')
                ->directory('sales')
                ->image()
                ->maxSize(2048)
                ->columnSpanFull(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('photo_path')
                    ->disk('public')
                    ->label('Foto')
                    ->circular(),

                TextColumn::make('name')
                    ->label('Nama')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('area_id')
                    ->label('Area Penjualan')
                    ->toggleable(),

                TextColumn::make('whatsapp')
                    ->label('WhatsApp'),

                TextColumn::make('updated_at')
                    ->label('Updated')
                    ->dateTime('d M Y H:i')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->actions([
    \Filament\Actions\EditAction::make(),
    \Filament\Actions\DeleteAction::make(),
]);

    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListSalesContacts::route('/'),
            'create' => Pages\CreateSalesContact::route('/create'),
            'edit'   => Pages\EditSalesContact::route('/{record}/edit'),
        ];
    }
}
