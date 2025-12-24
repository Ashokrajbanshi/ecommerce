<?php

namespace App\Filament\Resources\SocialLinks\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class SocialLinkForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make( 'Media')
                    ->columnSpanFull()
                    ->columns(2)
                    ->collapsible()
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('icon')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('url')
                            ->required()
                            ->maxLength(255),
                    ]),
            ]);
    }
}
