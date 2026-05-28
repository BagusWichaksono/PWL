<?php

namespace App\Filament\Resources\Posts\Tables;

use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\ReplicateAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ColorColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\DatePicker;

class PostsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                //
                TextColumn::make('id')
                    ->label('ID')
                    ->sortable(),
                TextColumn::make('title')
                    ->sortable()
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('slug')
                    ->sortable()
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('category.name')
                    ->label('Category')
                    ->sortable() // Menampilkan nama kategori [cite: 1550]
                    ->searchable()
                    ->toggleable(),
                ColorColumn::make('color')
                    ->label('Color')
                    ->toggleable(),
                ImageColumn::make('image') // Menampilkan gambar [cite: 1552]
                    ->disk('public')
                    ->toggleable(),
                TextColumn::make('created_at')
                    ->label('Created At')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('tags')
                    ->label('Tags')
                    ->toggleable(isToggledHiddenByDefault: true),
                IconColumn::make('published')
                    ->boolean(),
            ])->defaultSort('created_at', 'asc')
            ->filters([
                Filter::make('created_at')
                    ->label('Creation Date')
                        ->schema([
                            DatePicker::make('created_at')
                                ->label('Select Date :'),
                        ]) 
                        ->query(function ($query, $data) {
                            return $query
                                ->when(
                                    $data['created_at'],
                                    fn ($query, $date) => $query->whereDate('created_at', $date),
                                );
                        }),
                
                SelectFilter::make('category_id')
                    ->label('Category')
                    ->relationship('category', 'name')
                    ->preload(),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
                ReplicateAction::make(),
                Action::make('status')
                    ->label('Status Change')
                    ->icon('heroicon-o-check-circle')
                    ->requiresConfirmation()
                    ->schema([
                        Checkbox::make('published')
                            ->default(fn ($record) : bool => (bool) $record->published),
                    ])
                    ->action(function ($record, array $data) : void {
                        $record->update(['published' => $data['published']]);
                    }),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
