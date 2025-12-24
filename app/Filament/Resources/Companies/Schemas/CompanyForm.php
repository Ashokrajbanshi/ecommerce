<?php

namespace App\Filament\Resources\Companies\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class CompanyForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('General')
                    ->description('Company information')
                    ->columnSpanFull()
                    ->columns(2)
                    ->collapsible()
                    ->schema([
                        TextInput::make('name')
                            ->required(),
                        TextInput::make('email')
                            ->label('Email address')
                            ->email()
                            ->required(),
                        TextInput::make('phone')
                            ->tel()
                            ->required(),
                        TextInput::make('address')
                            ->required(),
                        FileUpload::make('logo')
                            ->required(),
                    ]),

                Section::make('Social_link')
                    ->description('Company description')
                    ->columnSpanFull()
                    ->collapsible()
                    ->columns(2)
                    ->schema([
                        Textarea::make('play_store_link')
                            ->default(null)
                            ->columnSpanFull(),
                        Textarea::make('ios_store_link')
                            ->default(null)
                            ->columnSpanFull(),
                    ]),
                RichEditor::make('policy')
                    ->default(null)
                    ->extraInputAttributes(['style' => 'height: 300px; overflow-y: auto'])
                    ->columnSpanFull(),
                RichEditor::make('terms')
                    ->default(null)
                    ->extraInputAttributes(['style' => 'height: 300px; overflow-y: auto'])
                    ->columnSpanFull(),
                RichEditor::make('how_to_order')
                    ->default(null)
                    ->extraInputAttributes(['style' => 'height: 300px; overflow-y: auto'])
                    ->columnSpanFull(),
            ]);
    }
}
