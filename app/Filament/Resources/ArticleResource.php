<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ArticleResource\Pages;
use App\Filament\Resources\ArticleResource\RelationManagers;
use App\Models\Article;
use App\Services\Filament\TableColumns;
use Filament\Forms;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ArticleResource extends Resource
{
    protected static ?string $model = Article::class;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';
    protected static ?string $activeNavigationIcon = 'heroicon-s-newspaper';
    protected static ?string $navigationGroup = 'Контент';
    protected static ?string $navigationLabel = 'Статьи';
    protected static ?string $pluralLabel = 'Статьи';
    protected static ?string $modelLabel = 'Статья';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make()
                    ->columns(4)
                    ->schema([
                        Section::make()
                            ->columnSpan(3)
                            ->schema([
                                TextInput::make('title')
                                    ->label('Заголовок')
                                    ->required()
                                    ->maxLength(255),
                                RichEditor::make('content')
                                    ->label('Текст')
                                    ->required()
                                    ->columnSpanFull()
                                    ->fileAttachmentsDirectory('attachments')
                                    ->maxLength(65535),
                            ]),
                        Section::make()
                            ->columnSpan(1)
                            ->schema([
                                FileUpload::make('preview_image')
                                    ->label('Превью')
                                    ->directory('images/articles')
                                    ->image(),
                                DateTimePicker::make('published_at')
                                    ->label('Дата публикации')
                                    ->required(),
                                Select::make('tag_id')
                                    ->label('Тэги')
                                    ->relationship('tags', 'name')
                                    ->multiple()
                                    ->preload()
                                    ->searchable(),
                            ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->label('Заголовок')
                    ->wrap()
                    ->sortable()
                    ->searchable(),
                TextColumn::make('user.name')
                    ->label('Автор')
                    ->numeric()
                    ->searchable()
                    ->sortable(),
                TextColumn::make('published_at')
                    ->label('Дата публикации')
                    ->dateTime('d F Y')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('tags.name')
                    ->badge()
                    ->separator(','),
                TableColumns::getCreatedAtColumn(),
                TableColumns::getUpdatedAtColumn(),
            ])
            ->filters([
                SelectFilter::make('Автор')
                    ->multiple()
                    ->searchable()
                    ->preload()
                    ->relationship('user', 'name'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListArticles::route('/'),
            'create' => Pages\CreateArticle::route('/create'),
            'view' => Pages\ViewArticle::route('/{record}'),
            'edit' => Pages\EditArticle::route('/{record}/edit'),
        ];
    }
}
