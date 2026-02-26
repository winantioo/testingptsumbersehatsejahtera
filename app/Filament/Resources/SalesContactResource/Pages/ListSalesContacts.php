<?php

namespace App\Filament\Resources\SalesContactResource\Pages;

use App\Filament\Resources\SalesContactResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSalesContacts extends ListRecords
{
    protected static string $resource = SalesContactResource::class;

    protected function getHeaderActions(): array
    {
        return [Actions\CreateAction::make()];
    }
}
