<?php

namespace App\Filament\Resources;

use App\Enums\ProductStatus;
use App\Filament\Resources\ProductResource\Pages;
use App\Models\Product;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';

    protected static ?string $navigationGroup = 'Quan ly cua hang';

    protected static ?string $navigationLabel = 'San pham';

    protected static ?string $modelLabel = 'San pham';

    protected static ?string $pluralModelLabel = 'San pham';

    protected static ?string $slug = 'sv23810310259/products';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make(12)
                    ->schema([
                        Select::make('category_id')
                            ->label('Danh muc')
                            ->relationship('category', 'name')
                            ->searchable()
                            ->preload()
                            ->required()
                            ->columnSpan(4),
                        TextInput::make('name')
                            ->label('Ten san pham')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug((string) $state)))
                            ->columnSpan(4),
                        TextInput::make('slug')
                            ->label('Slug')
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true)
                            ->columnSpan(4),
                        TextInput::make('price')
                            ->label('Gia ban')
                            ->required()
                            ->numeric()
                            ->live(onBlur: true)
                            ->minValue(0)
                            ->prefix('VND')
                            ->columnSpan(3),
                        TextInput::make('discount_percent')
                            ->label('Giam gia (%)')
                            ->helperText('Truong sang tao: giam gia de tu dong tinh gia sau khi giam.')
                            ->required()
                            ->numeric()
                            ->live(onBlur: true)
                            ->minValue(0)
                            ->maxValue(100)
                            ->default(0)
                            ->columnSpan(3),
                        Placeholder::make('discounted_price_preview')
                            ->label('Gia sau giam')
                            ->content(function (callable $get): string {
                                $price = (float) ($get('price') ?? 0);
                                $discount = (int) ($get('discount_percent') ?? 0);
                                $discountedPrice = round($price * (100 - max(0, min(100, $discount))) / 100, 2);

                                return number_format($discountedPrice, 0, ',', '.') . ' VNÐ';
                            })
                            ->columnSpan(3),
                        TextInput::make('stock_quantity')
                            ->label('Ton kho')
                            ->required()
                            ->numeric()
                            ->rule('integer')
                            ->minValue(0)
                            ->live()
                            ->afterStateUpdated(function ($state, callable $set, callable $get): void {
                                if ((int) $state === 0 && $get('status') !== ProductStatus::Draft->value) {
                                    $set('status', ProductStatus::OutOfStock->value);
                                }
                            })
                            ->columnSpan(3),
                        Select::make('status')
                            ->label('Trang thai')
                            ->options(ProductStatus::options())
                            ->required()
                            ->default(ProductStatus::Draft->value)
                            ->columnSpan(6),
                        FileUpload::make('image_path')
                            ->label('Anh dai dien')
                            ->image()
                            ->disk('public')
                            ->directory('products')
                            ->visibility('public')
                            ->maxFiles(1)
                            ->columnSpan(6),
                        RichEditor::make('description')
                            ->label('Mo ta')
                            ->toolbarButtons([
                                'bold',
                                'italic',
                                'underline',
                                'bulletList',
                                'orderedList',
                                'redo',
                                'undo',
                            ])
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image_path')
                    ->label('Anh')
                    ->disk('public')
                    ->square(),
                TextColumn::make('name')
                    ->label('Ten san pham')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('category.name')
                    ->label('Danh muc')
                    ->sortable(),
                TextColumn::make('price')
                    ->label('Gia')
                    ->sortable()
                    ->formatStateUsing(fn ($state): string => number_format((float) $state, 0, ',', '.') . ' VNÐ'),
                TextColumn::make('discount_percent')
                    ->label('Giam gia')
                    ->suffix('%')
                    ->alignCenter(),
                TextColumn::make('discounted_price')
                    ->label('Gia sau giam')
                    ->formatStateUsing(fn ($state): string => number_format((float) $state, 0, ',', '.') . ' VNÐ'),
                TextColumn::make('stock_quantity')
                    ->label('Ton kho')
                    ->sortable(),
                TextColumn::make('status')
                    ->label('Trang thai')
                    ->badge()
                    ->formatStateUsing(function ($state): string {
                        $status = $state instanceof ProductStatus ? $state : ProductStatus::from((string) $state);

                        return $status->label();
                    })
                    ->color(function ($state): string {
                        $status = $state instanceof ProductStatus ? $state : ProductStatus::from((string) $state);

                        return match ($status) {
                            ProductStatus::Draft => 'gray',
                            ProductStatus::Published => 'success',
                            ProductStatus::OutOfStock => 'danger',
                        };
                    }),
            ])
            ->filters([
                SelectFilter::make('category')
                    ->label('Danh muc')
                    ->relationship('category', 'name')
                    ->searchable()
                    ->preload(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
