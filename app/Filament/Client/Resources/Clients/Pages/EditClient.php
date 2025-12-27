<?php

namespace App\Filament\Client\Resources\Clients\Pages;

use App\Filament\Client\Resources\Clients\ClientResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Pages\EditRecord;
use Filament\Schemas\Schema;
use PhpParser\Node\Stmt\Label;

class EditClient extends EditRecord
{
    protected static string $resource = ClientResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // DeleteAction::make(),
            EditAction::make()
                ->label('Change Password')
                ->schema([
                    TextInput::make('password')
                        ->password()
                        ->revealable()
                        ->required(),
                ]),
        ];
    }
}
