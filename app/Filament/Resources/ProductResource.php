<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use Domain\Catalog\Models\Brand;
use Domain\Catalog\Models\Category;
use Domain\Product\Models\Product;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Support\ValueObjects\Price;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Forms\Components\Tabs::make()->schema([
                    Forms\Components\Tabs\Tab::make('Post')->schema([
                        TextInput::make('title')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('price')
                            ->minValue(0)
                            ->numeric()
                            ->required()
                            ->formatStateUsing(fn (?Price $state) => $state?->raw() ?? null),
                        Select::make('brand_id')
                            ->label('Brand')
                            ->relationship('brand', 'title')
                            ->required()
                            ->searchable(),
                        TextInput::make('quantity')
                            ->minValue(0)
                            ->numeric()
                            ->required(),
                        Toggle::make('on_home_page'),
                        FileUpload::make('thumbnail')
                            ->directory('images/brands')
                            ->visibility('public')
                            ->formatStateUsing(fn ($state) => $state
                                ? array(str_replace('/storage/', '', $state))
                                : null
                            )
                            ->dehydrateStateUsing(
                                fn ($state) => is_array($state) && !empty($state)
                                    ? '/storage/' . $state[array_key_first($state)]
                                    : ($state ? '/storage/' . $state : null)
                            ),
                        TextInput::make('sorting')
                            ->minValue(0)
                            ->maxValue(999)
                            ->numeric()
                            ->required(),
                        Textarea::make('text'),
                        /*Select::make('categories')
                            ->multiple()
                            ->relationship('categories', 'title')
                            ->required()
                            ->searchable(),
                        Forms\Components\CheckboxList::make('categories')
                            ->relationship('categories', 'title')
                            ->columns(2)
                            ->required()
                            ->searchable()
                            ->label('Categories')*/
                    ]),

                    Forms\Components\Tabs\Tab::make('Categories')->schema([

                        Forms\Components\CheckboxList::make('List of categories')
                            ->relationship('categories', 'title')
                            ->columns(2)
                            ->required()
                            ->searchable(),
                    ]),

                    /*Forms\Components\Tabs\Tab::make('Properties')->schema([

                        Forms\Components\CheckboxList::make('List of properties')
                            ->relationship('properties', 'title')
                            ->columns(1)
                            ->searchable()
                            ->pivotData([
                                'value' =>
                                    Forms\Components\TextInput::make('value')
                                    ->required()
                                    ->maxLength(255)
                            ])
                        ,
                    ]),*/
                ])

            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('price'),
                Tables\Columns\TextColumn::make('brand.title'),
                ImageColumn::make('thumbnail')
                    ->state(function (Product $record): string {
                        return str_replace('/storage/', '', $record->thumbnail);
                    }),
                Tables\Columns\ToggleColumn::make('on_home_page'),
                Tables\Columns\TextColumn::make('sorting')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('quantity')
                    ->numeric()
                    ->sortable()
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\PropertiesRelationManager::class
        ];
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
