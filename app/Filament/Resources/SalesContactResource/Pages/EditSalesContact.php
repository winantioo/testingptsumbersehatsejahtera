<?php

namespace App\Filament\Resources\SalesContactResource\Pages;

use App\Filament\Resources\SalesContactResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSalesContact extends EditRecord
{
    protected static string $resource = SalesContactResource::class;

    protected function getHeaderActions(): array
    {
        return [Actions\DeleteAction::make()];
    }
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
