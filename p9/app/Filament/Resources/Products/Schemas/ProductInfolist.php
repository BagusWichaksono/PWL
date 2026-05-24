<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Schema;

class ProductInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('Product Tabs')
                    ->vertical()
                    ->tabs([
                        Tabs\Tab::make('Product Info')
                        ->icon('heroicon-o-information-circle')
                        ->schema([
                            TextEntry::make('name')
                                ->label('Product Name')
                                ->weight('bold')
                                ->color('primary'),

                            TextEntry::make('id')
                                ->label('Product ID'),

                            TextEntry::make('sku')
                                ->label('Product SKU')
                                ->badge()
                                ->color('success'),

                            TextEntry::make('description')
                                ->label('Product Description'),

                            TextEntry::make('created_at')
                                ->label('Product Creation Date')
                                ->date('d M Y')
                                ->color('info'),
                        ]),

                        Tabs\Tab::make('Pricing & Stock')
                            ->icon('heroicon-o-currency-dollar')
                            ->badge(fn ($record): string => (string) ($record?->stock ?? 0))
                            ->badgeColor(function ($record): string {
                                $stock = $record?->stock ?? 0;

                                if ($stock > 10) {
                                    return 'success';
                                }

                                if ($stock > 0) {
                                    return 'warning';
                                }

                                return 'danger';
                            })
                            ->schema([
                                TextEntry::make('price')
                                    ->label('Product Price')
                                    ->icon('heroicon-o-currency-dollar')
                                    ->formatStateUsing(fn ($state): string => 'Rp ' . number_format((int) $state, 0, ',', '.')),

                                TextEntry::make('stock')
                                    ->label('Product Stock')
                                    ->icon('heroicon-o-cube')
                                    ->weight('bold')
                                    ->color('primary'),
                            ]),

                        Tabs\Tab::make('Media & Status')
                            ->icon('heroicon-o-photo')
                            ->schema([
                                ImageEntry::make('image')
                                    ->label('Product Image')
                                    ->disk('public'),

                                IconEntry::make('is_active')
                                    ->label('Is Active')
                                    ->boolean(),

                                IconEntry::make('is_featured')
                                    ->label('Is Featured')
                                    ->boolean(),
                            ]),
                    ])
                    ->columnSpanFull(),
            ]);
    }
}