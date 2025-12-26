<?php

namespace App\Filament\Client\Resources\Clients;

use App\Filament\Client\Resources\Clients\Pages\CreateClient;
use App\Filament\Client\Resources\Clients\Pages\EditClient;
use App\Filament\Client\Resources\Clients\Pages\ListClients;
use App\Filament\Client\Resources\Clients\Schemas\ClientForm;
use App\Filament\Client\Resources\Clients\Tables\ClientsTable;
use App\Models\Client;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class ClientResource extends Resource
{
    protected static ?string $model = Client::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::Users;

    protected static ?string $modelLabel = 'Profile';
    protected static ?string $pluralModelLabel = 'Profile';
    public static function canCreate(): bool
    {
        return false;
    }
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('id', Auth::id());
    }




    public static function form(Schema $schema): Schema
    {
        return ClientForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ClientsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListClients::route('/'),
            'create' => CreateClient::route('/create'),
            'edit' => EditClient::route('/{record}/edit'),
        ];
    }
}
