<?php

namespace App\Filament\Resources;

use Closure;
use Filament\Forms;
use App\Models\Post;
use Filament\Tables;
use Illuminate\Support\Str;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Grid;

use App\Filament\Resources\PostResource\Pages;


class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    // Filament uses heroicons v1 for icons, just rename the heroicon-o- with your liking

    protected static ?string $navigationGroup = 'Content';
    // To add category table to content section in the dashboard

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([
                        // To place the form inside a card

                        Grid::make(2)
                            ->schema([
                                // To display the title and slug input elemets side by side

                                Forms\Components\TextInput::make('title')
                                    ->required()
                                    ->maxLength(2048)
                                    ->reactive()
                                    // This field is reactive

                                    ->afterStateUpdated(function (Closure $set, $state) {
                                        $set('slug', Str::slug($state));
                                    }),
                                // To auto-generate the slug based on the title
                                // We need to listen to the event afterStateUpdated which accepts callback as it is an event
                                // Closure $set and we accept $state as well
                                // Then call $set and pass in the field name 'slug', which should be title converted to slug
                                // $state will be title, Str helpe
                                Forms\Components\TextInput::make('slug')
                                    ->required()
                                    ->maxLength(2048),
                            ]),
                        Forms\Components\RichEditor::make('body')
                            ->required(),
                        Forms\Components\TextInput::make('meta_title'),
                        Forms\Components\TextInput::make('meta_description'),
                        Forms\Components\Toggle::make('active')
                            ->required(),
                        Forms\Components\DateTimePicker::make('published_at'),
                    ])->columnSpan(8),
                Card::make()
                    ->schema([
                        Forms\Components\FileUpload::make('thumbnail'),
                        Forms\Components\Select::make('category_id')
                            ->multiple()
                            ->relationship('categories', 'title')
                            ->required(),
                    ])->columnSpan(4),

            ])->columns(12);
        // To add the user_id in the database, see the function in app/Filament/Resource/PostResource/Createpost.php
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('thumbnail'),
                Tables\Columns\TextColumn::make('title'),
                Tables\Columns\IconColumn::make('active')
                    ->boolean(),
                Tables\Columns\TextColumn::make('user.name'),
                Tables\Columns\TextColumn::make('published_at')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime(),
            ])
            // These columns will be displayed in the dashboard

            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                // To add delete functionality
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}
