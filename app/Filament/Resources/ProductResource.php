<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use Illuminate\Support\Facades\Storage;
use App\Imports\ProductsImport;
use App\Models\Product;
use App\Models\ProductCategory;

use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;

use Filament\Forms;
use Filament\Notifications\Notification;

use Maatwebsite\Excel\Facades\Excel;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;

use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;

use Illuminate\Database\Eloquent\Builder;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-cube';
    protected static ?string $navigationLabel = 'Products';
    protected static ?int $navigationSort = 1;

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            TextInput::make('name')
                ->label('Nama Obat')
                ->required()
                ->maxLength(255)
                ->columnSpanFull(),

            Select::make('category_id')
                ->label('Jenis Obat (Kategori)')
                ->options(fn () => ProductCategory::query()
                    ->orderBy('name_id')
                    ->pluck('name_id', 'id')
                    ->toArray()
                )
                ->searchable()
                ->preload()
                ->placeholder('Tanpa Kategori'),

            TextInput::make('manufacturer')
                ->label('Pabrikan')
                ->maxLength(255),

             FileUpload::make('image_path')
                 ->label('Gambar Obat')
                 ->disk('public')
                 ->directory('products')
                 ->acceptedFileTypes(['image/jpeg','image/png','image/webp'])
                 ->maxSize(2048)
                 ->preserveFilenames()
                 // --- Tambahan agar ukuran seragam & HD ---
            ->imageResizeMode('cover') 
            ->imageCropAspectRatio('1:1') // Paksa jadi kotak, atau '16:9' sesuai kebutuhan
            ->imageResizeTargetWidth('800') // Ukuran lebar HD yang pas untuk web
            ->imageResizeTargetHeight('800')
            // -----------------------------------------
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn (Builder $query) => $query->with('category'))
            ->columns([
                ImageColumn::make('image_path')
                    ->disk('public')
                    ->label('Gambar')
                    ->square()
                    ->toggleable(),

                TextColumn::make('name')
                    ->label('Nama')
                    ->searchable()
                    ->sortable()
                    ->wrap(),

                TextColumn::make('category.name_id')
                    ->label('Jenis')
                     ->searchable()
                    ->sortable()
                    ->placeholder('Tanpa Kategori'),

                TextColumn::make('manufacturer')
                    ->label('Pabrikan')
                     ->searchable()
                    ->toggleable()
                    ->placeholder('-'),

                TextColumn::make('updated_at')
                    ->label('Updated')
                    ->dateTime('d M Y H:i')
                    ->toggleable(isToggledHiddenByDefault: true),
                    
                    
                
            ])
            ->defaultSort('name', 'asc')
            ->headerActions([
                \Filament\Actions\Action::make('import')
                    ->label('Import Excel')
                    ->icon('heroicon-o-arrow-up-tray')
                    ->form([
                        Forms\Components\FileUpload::make('file')
                            ->label('File Excel')
                            ->required()
                            // simpan ke storage/app/imports
                            ->disk('local')
                            ->directory('imports')
                            ->preserveFilenames()
                            ->acceptedFileTypes([
                                'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                                'text/csv',
                            ]),
                    ])
                   ->action(function (array $data): void {
    // Filament FileUpload mengembalikan path relative di disk yang dipilih
    $relativePath = $data['file']; // contoh: imports/xxxx.xlsx

    $fullPath = Storage::disk('local')->path($relativePath);

    if (! file_exists($fullPath)) {
        Notification::make()
            ->title('File tidak ditemukan')
            ->body("Path: {$relativePath}")
            ->danger()
            ->send();

        return;
    }

    Excel::import(new ProductsImport, $fullPath);

    Notification::make()
        ->title('Import berhasil')
        ->success()
        ->send();
})

                    
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
            'index'  => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit'   => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
