<?php

namespace App\Filament\Resources\Clients\Pages;

use App\Filament\Resources\Clients\ClientResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Pages\EditRecord;

class EditClient extends EditRecord
{
    protected static string $resource = ClientResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make()
            ->label('Change Password')
            ->schema([
                TextInput::make('password')
                    ->password()
                    ->revealable()
                    ->required(),
            ]),
            DeleteAction::make(),
        ];
    }
}
