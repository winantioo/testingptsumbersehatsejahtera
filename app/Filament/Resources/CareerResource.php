<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CareerResource\Pages;
use App\Models\Career;
use Filament\Forms\Components as FormComponents;
use Filament\Schemas\Components as SchemaComponents;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables\Columns;
use Filament\Actions;

class CareerResource extends Resource
{
    protected static ?string $model = Career::class;

    // PERBAIKAN 1: Hapus "?string" agar tidak error 500 lagi
    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-briefcase';

    protected static ?string $navigationLabel = 'Career Center';
    protected static ?string $pluralModelLabel = 'Careers';
    protected static ?int $navigationSort = 2;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                SchemaComponents\Section::make('Status & Media')
                    ->schema([
                        FormComponents\Toggle::make('is_active')
                            ->label('Tampilkan di Website')
                            ->default(true),

                        // PERBAIKAN 2: Konfigurasi Upload Gambar yang lebih santai
                        FormComponents\FileUpload::make('image')
                            ->label('Gambar Sampul')
                            ->disk('public')
                            ->directory('career-images')
                            ->image() // Memastikan hanya file gambar
                            ->imageEditor() // Fitur agar bisa crop manual
                            ->columnSpanFull()
                            ->required(), 
                            // Kita hapus resizeTargetWidth/Height agar tidak error dimensi
                    ]),

                SchemaComponents\Section::make('Detail Program')
                    ->schema([
                        FormComponents\Select::make('title_id')
                            ->label('Kategori Program')
                            ->options([
                                'Lowongan Pekerjaan' => 'Lowongan Pekerjaan',
                                'Program PKPA' => 'Program PKPA',
                                'Magang Kemenhub' => 'Magang Kemenhub',
                            ])
                            ->required(),
                        
                        FormComponents\TextInput::make('badge_text')
                            ->label('Teks Badge')
                            ->placeholder('Hiring / Internship / Taruna')
                            ->maxLength(50),

                        FormComponents\TextInput::make('apply_url')
                            ->label('Link Google Form')
                            ->url()
                            ->required()
                            ->placeholder('https://forms.gle/...')
                            ->columnSpanFull(),

                        FormComponents\Textarea::make('description_id')
                            ->label('Deskripsi Singkat (ID)')
                            ->rows(3)
                            ->columnSpanFull(),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Columns\ImageColumn::make('image')
                    ->label('Sampul')
                    ->disk('public')
                    ->size(80)
                    ->square(),

                Columns\TextColumn::make('title_id')
                    ->label('Program')
                    ->sortable()
                    ->searchable(),

                Columns\TextColumn::make('badge_text')
                    ->label('Badge'),

                Columns\IconColumn::make('is_active')
                    ->label('Aktif')
                    ->boolean(),

                Columns\TextColumn::make('updated_at')
                    ->label('Terakhir Update')
                    ->dateTime('d M Y')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Actions\EditAction::make(),
                Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListCareers::route('/'),
            'create' => Pages\CreateCareer::route('/create'),
            'edit' => Pages\EditCareer::route('/{record}/edit'),
        ];
    }
}