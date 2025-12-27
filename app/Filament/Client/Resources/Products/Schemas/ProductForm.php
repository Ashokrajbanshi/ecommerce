<?php

namespace App\Filament\Client\Resources\Products\Schemas;

use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Product Details')
                    ->columnSpanFull()
                    ->collapsible()
                    ->columns(2)
                    ->schema([
                        TextInput::make('name')
                            ->required(),
                        TextInput::make('price')
                            ->required()
                            ->numeric()
                            ->prefix('Rs.'),
                        TextInput::make('discount')
                            ->required()
                            ->numeric()
                            ->suffix('%')
                            ->default(0),
                        FileUpload::make('image')
                            ->multiple()
                            ->required()
                            ->columnSpanFull(),
                    ]),
                        RichEditor::make('description')
                            ->required()
                            ->extraAttributes(['style' => 'min-height: 400px; overflow-y =auto;'])
                            ->columnSpanFull(),
            ]);
    }
}
