<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                //
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255)
                    ->unique(ignoreRecord: true), // Validasi email harus unik
                TextInput::make('password')
                    ->password()
                    ->required()
                    ->minLength(6) // Validasi password minimal 6 karakter
                    ->hiddenOn('edit'), // (Opsional) Biasanya password disembunyikan saat mode edit
            ]);
    }
}
