<?php

namespace App\Filament\Resources\Contacts\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Actions\Action;

class ContactsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('email')
                    ->searchable(),
                TextColumn::make('subject')
                    ->searchable(),
                TextColumn::make('description')
                    ->searchable(),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'pending' => 'warning',
                        'read' => 'info',
                        'replied' => 'success'
                    }),
                TextColumn::make('created_at')
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),

                // Whatapps Action
                Action::make('whatsapp')
                    ->label('WhatsApp')
                    ->icon('heroicon-o-chat-bubble-left-right')
                    ->color('success')
                    ->url(
                        fn($record) =>

                        'https://wa.me/' .
                        preg_replace('/^0/', '62', $record->phone_number) .

                        '?text=' .

                        urlencode(
                            "Assalamu'alaikum {$record->name},\n\n" .
                            "Terima kasih telah menghubungi Masjid Al Kautsar Cempolorejo.\n\n" .
                            "Pesan/informasi yang Anda kirimkan telah kami tindak lanjuti.\n\n" .
                            "Jazakumullahu khairan."
                        )

                    )
                    ->openUrlInNewTab(),

                // Email Action
                Action::make('email')
                    ->label('Email')
                    ->icon('heroicon-o-envelope')
                    ->color('info')
                    ->url(
                        fn($record) =>

                        'mailto:' . $record->email .

                        '?subject=' .

                        urlencode('Tindak Lanjut Informasi Masjid Al Kautsar') .

                        '&body=' .

                        urlencode(
                            "Assalamu'alaikum {$record->name},\n\n" .
                            "Terima kasih telah menghubungi Masjid Al Kautsar Cempolorejo.\n\n" .
                            "Pesan/informasi yang Anda kirimkan telah kami tindak lanjuti.\n\n" .
                            "Jazakumullahu khairan."
                        )

                    ),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
