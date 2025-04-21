<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BrandResource\Pages;
use App\Filament\Resources\BrandResource\RelationManagers;
use Domain\Catalog\Models\Brand;
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
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class BrandResource extends Resource
{
    protected static ?string $model = Brand::class;

    protected static ?string $navigationIcon = 'heroicon-o-tag';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')
                    ->required()
                    ->maxLength(255),
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

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->sortable()
                    ->searchable(),
                ImageColumn::make('thumbnail')
                    ->state(function (Brand $record): string {
                        return str_replace('/storage/', '',$record->thumbnail);
                    }),
                Tables\Columns\ToggleColumn::make('on_home_page'),
                Tables\Columns\TextColumn::make('sorting')
                    ->numeric()
                    ->sortable(),
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBrands::route('/'),
            'create' => Pages\CreateBrand::route('/create'),
            'edit' => Pages\EditBrand::route('/{record}/edit'),
        ];
    }
}
