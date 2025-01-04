<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AppointmentResource\Pages;
use App\Filament\Resources\AppointmentResource\RelationManagers;
use App\Models\Appointment;
use Filament\Forms;
use App\Models;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AppointmentResource extends Resource
{
    protected static ?string $model = Appointment::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('customer_id')
                    ->relationship('customer', 'name')
                    ->label('Cliente')
                    ->searchable()
                    ->required(),
                Forms\Components\Select::make('mechanic_id')
                    ->relationship('mechanic', 'name')
                    ->label('Mecánico')
                    ->searchable()
                    ->required(),
                Forms\Components\DateTimePicker::make('scheduled_at')
                    ->label('Fecha y hora')
                    ->withoutSeconds()
                    ->required(),
                Forms\Components\Textarea::make('description')
                    ->label('Descripción del servicio'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->sortable(),
                Tables\Columns\TextColumn::make('customer.name')
                    ->label('Cliente')
                    ->searchable(),
                Tables\Columns\TextColumn::make('mechanic.name')
                    ->label('Mecánico')
                    ->searchable(),
                Tables\Columns\TextColumn::make('scheduled_at')
                    ->label('Fecha y hora')
                    ->dateTime('d-m-Y H:i')
                    ->sortable(),
                Tables\Columns\TextColumn::make('description')
                    ->label('Descripción')
                    ->limit(20),
            ])
            ->filters([
                // Por ejemplo, filtrar por mecánico, por fecha, etc.
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
    public static function rules(Model $record = null): array
    {
        return [
            'customer_id'  => ['required', 'exists:customers,id'],
            'mechanic_id'  => ['required', 'exists:mechanics,id'],
            'scheduled_at' => [
                'required',
                // Validación custom: no permitir duplicados con el mismo mechanic_id + scheduled_at
                function ($attribute, $value, $fail) use ($record) {
                    $exists = Appointment::where('mechanic_id', request('mechanic_id'))
                        ->where('scheduled_at', $value)
                        // Ignora la cita actual si se está editando
                        ->when($record, function ($query) use ($record) {
                            return $query->where('id', '!=', $record->id);
                        })
                        ->exists();

                    if ($exists) {
                        $fail('El mecánico ya tiene un turno en esa fecha y hora.');
                    }
                }
            ],
        ];
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
            'index' => Pages\ListAppointments::route('/'),
            'create' => Pages\CreateAppointment::route('/create'),
            'edit' => Pages\EditAppointment::route('/{record}/edit'),
        ];
    }
}
