<?php

namespace App\Filament\Resources\RedirectLinksResource\Pages;

use App\Filament\Resources\RedirectLinksResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRedirectLinks extends EditRecord
{
    protected static string $resource = RedirectLinksResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
