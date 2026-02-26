<?php

namespace App\Filament\Resources\ContactMessages;

use BackedEnum;
use App\Filament\Resources\ContactMessages\Pages;
use App\Models\ContactMessage;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ContactMessageResource extends Resource
{
    protected static ?string $model = ContactMessage::class;

    // ✅ INI YANG FIX:
    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-envelope';

    protected static ?string $navigationLabel = 'Pesan Masuk';

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('name')->label('Nama Pengirim')->disabled()->maxLength(255),
            TextInput::make('email')->label('Email')->email()->disabled()->maxLength(255),
            TextInput::make('phone')->label('No. Telepon')->tel()->disabled()->maxLength(20),
            TextInput::make('subject')->label('Subjek')->disabled()->maxLength(255)->columnSpanFull(),
            Textarea::make('message')->label('Isi Pesan')->disabled()->rows(6)->columnSpanFull(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('created_at')->label('Tanggal Masuk')->dateTime('d M Y, H:i')->sortable(),
                TextColumn::make('name')->label('Nama')->searchable()->weight('bold'),
                TextColumn::make('email')->label('Email')->copyable(),
                TextColumn::make('subject')->label('Subjek')->limit(30)->searchable(),
                TextColumn::make('message')->label('Pesan')->limit(50)->wrap(),
            ])
            ->defaultSort('created_at', 'desc')
            ->recordActions([ViewAction::make(), DeleteAction::make()])
            ->toolbarActions([
                BulkActionGroup::make([DeleteBulkAction::make()]),
            ]);
    }

    public static function canCreate(): bool
    {
        return false;
    }

public static function getPages(): array
{
    return [
        'index' => Pages\ListContactMessages::route('/'),
        'view'  => Pages\ViewContactMessage::route('/{record}'),
    ];
}

}
