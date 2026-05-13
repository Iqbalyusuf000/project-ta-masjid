<?php

namespace App\Filament\Resources\Contacts\Schemas;

use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ContactForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->disabled(),
                TextInput::make('email')
                    ->email()
                    ->disabled(),
                TextInput::make('phone_number')
                    ->tel()
                    ->disabled(),
                TextInput::make('subject')
                    ->disabled(),
                Select::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'read' => 'Read',
                        'replied' => 'Replied',
                    ]),
                RichEditor::make('description')
                    ->disabled(),
            ]);
    }
}
