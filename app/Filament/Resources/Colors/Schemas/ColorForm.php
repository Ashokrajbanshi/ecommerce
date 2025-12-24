<?php

namespace App\Filament\Resources\Colors\Schemas;

use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ColorForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('General')
                ->columnSpanFull()
                ->columns(2)
                ->collapsible()
                ->schema([
                    ColorPicker::make('primary')
                        ->required(),
                    ColorPicker::make('secondary')
                        ->required(),
                    ColorPicker::make('text')
                        ->required(),
                    ColorPicker::make('bg')
                        ->required(),
                ]),
            ]);
    }
}
