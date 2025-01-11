<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MechanicResource\Pages;
use App\Filament\Resources\MechanicResource\RelationManagers;
use App\Models\Mechanic;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Table\ImageColumn;

class MechanicResource extends Resource
{
    protected static ?string $model = Mechanic::class;

    protected static ?string $navigationIcon = 'heroicon-o-cog';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->label('Nombre'),
                Forms\Components\TextInput::make('specialty')
                    ->label('Especialidad'),
                Forms\Components\FileUpload::make('image')
                    ->disk('public')
                    ->label('Imagen')
                    ->image()
                    ->directory('mecanicos/imagenes') // Carpeta donde se guardará
                    ->required() // Si es obligatorio
                    ->maxSize(2048) // Tamaño máximo en KB (2 MB)

            ]);
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->sortable(),
                Tables\Columns\TextColumn::make('name')->label('Nombre')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('specialty')->label('Especialidad')->searchable(),
                Tables\Columns\ImageColumn::make('image')
                    ->label('Imagen')
                    ->circular()
                    ->size(50),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Creado')
                    ->dateTime('d-m-Y H:i'),
            ])
            ->filters([
                // Aquí puedes agregar filtros por especialidad, etc.
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
            'index' => Pages\ListMechanics::route('/'),
            'create' => Pages\CreateMechanic::route('/create'),
            'edit' => Pages\EditMechanic::route('/{record}/edit'),
        ];
    }
}
