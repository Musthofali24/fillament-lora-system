<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NodeResource\Pages;
use App\Filament\Resources\NodeResource\RelationManagers;
use App\Models\Node;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class NodeResource extends Resource
{
    protected static ?string $model = Node::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('gateway_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('node_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('local_address')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('spreading_factor')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('signal_bandwidth')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('measure_interval')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('last_seen')
                    ->required()
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('gateway_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('node_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('local_address')
                    ->searchable(),
                Tables\Columns\TextColumn::make('spreading_factor')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('signal_bandwidth')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('measure_interval')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('last_seen')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
            'index' => Pages\ListNodes::route('/'),
            'create' => Pages\CreateNode::route('/create'),
            'edit' => Pages\EditNode::route('/{record}/edit'),
        ];
    }
}
