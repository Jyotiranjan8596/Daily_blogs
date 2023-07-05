<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Filament\Resources\PostResource\RelationManagers;
use App\Models\post;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Illuminate\Support\Facades\Auth;

class PostResource extends Resource
{

    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
         $user_id = Auth::user()->id;
        return $form
            ->schema([
                TextInput::make('id'),
                TextInput::make('title'),
                TextInput::make('cat_id'),
                FileUpload::make('full_img'),
                TextInput::make('video'),
                TextInput::make('detail'),
                TextInput::make('tags')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('post_id'),
                Tables\Columns\TextColumn::make('id'),
                Tables\Columns\TextColumn::make('cat_id'),
                Tables\Columns\TextColumn::make('full_img'),
                Tables\Columns\TextColumn::make('video'),
                Tables\Columns\TextColumn::make('detail'),
                Tables\Columns\TextColumn::make('tags'),

                Tables\Columns\TextColumn::make('title')

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
