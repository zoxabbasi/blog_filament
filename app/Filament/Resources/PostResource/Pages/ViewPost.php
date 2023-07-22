<?php

namespace App\Filament\Resources\PostResource\Pages;

use Filament\Pages\Actions\EditAction;
use App\Filament\Resources\PostResource;
use App\Filament\Widgets\PostOvverview;
use Filament\Resources\Pages\ViewRecord;

class ViewPost extends ViewRecord
{
    protected static string $resource = PostResource::class;

    protected function getActions(): array
    {
        return [
            EditAction::make(),
        ];
    }

}
