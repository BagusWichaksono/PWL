<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Actions\Action;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Wizard;
use Filament\Schemas\Components\Wizard\Step;
use Filament\Schemas\Schema;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Wizard::make([
                    Step::make('Product Info')
                        ->icon('heroicon-o-information-circle')
                        ->description('Isi informasi dasar produk')
                        ->schema([
                            Group::make([
                                TextInput::make('name')
                                    ->label('Name')
                                    ->required(),

                                TextInput::make('sku')
                                    ->label('SKU')
                                    ->required()
                                    ->unique(ignoreRecord: true),
                            ])->columns(2),

                            MarkdownEditor::make('description')
                                ->label('Description')
                                ->columnSpanFull(),
                        ]),

                    Step::make('Pricing & Stock')
                        ->icon('heroicon-o-currency-dollar')
                        ->description('Isi harga dan jumlah stok')
                        ->schema([
                            TextInput::make('price')
                                ->label('Price')
                                ->numeric()
                                ->required()
                                ->minValue(1),

                            TextInput::make('stock')
                                ->label('Stock')
                                ->numeric()
                                ->required()
                                ->minValue(0),
                        ]),

                    Step::make('Media & Status')
                        ->icon('heroicon-o-photo')
                        ->description('Upload gambar dan atur status')
                        ->schema([
                            FileUpload::make('image')
                                ->label('Image')
                                ->image()
                                ->disk('public')
                                ->directory('products'),

                            Checkbox::make('is_active')
                                ->label('Is Active'),

                            Checkbox::make('is_featured')
                                ->label('Is Featured'),
                        ]),
                ])
                    ->columnSpanFull()
                    ->submitAction(
                        Action::make('save')
                            ->label('Save Product')
                            ->color('primary')
                            ->submit('save')
                    ),
            ]);
    }
}