<?php

namespace App\Filament\Docente\Resources;

use App\Filament\Docente\Resources\ProgresionResource\Pages;
use App\Filament\Docente\Resources\ProgresionResource\RelationManagers;
use App\Models\Progresion;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;
use Joaopaulolndev\FilamentPdfViewer\Forms\Components\PdfViewerField;

class ProgresionResource extends Resource
{
    protected static ?string $model = Progresion::class;

    protected static ?string $label = 'Progresiones';

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('user_id', Auth::user()->id);
    }

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Forms\Components\Select::make('uac')
                    ->options([
                        'Humanidades' => 'Humanidades',
                        'Ciencias Sociales' => 'Ciencias Sociales',
                        'Ciencias Naturales, Experimentales y Tecnologicas' => 'Ciencias Naturales, Experimentales y Tecnologicas',
                        'Pensamiento Matematico' => 'Pensamiento Matematico',
                        'Lengua y Comunicacion' => 'Lengua y Comunicacion',
                        'Conciencia Historica' => 'Conciencia Historica',
                        'Cultura Digital' => 'Cultura Digital',
                        'Ingles' => 'Ingles',
                    ])
                    ->required(),
                Forms\Components\TextInput::make('num_progresion')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('materia')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('status')                
                    ->options([
                        'activo' => 'Activo',
                        'en proceso' => 'En Proceso',
                        'concluido' => 'Concluido',
                    ])
                    
                    ->default('activo')
                    ->required(),
                Forms\Components\FileUpload::make('documento')
                    ->acceptedFileTypes(['application/pdf'])
                    ->preserveFilenames()
                    ->directory('progresiones')
                    ->required(),
                   
                Forms\Components\FileUpload::make('instrumento_evaluacion')
                    ->acceptedFileTypes(['application/pdf'])
                    ->preserveFilenames()
                    ->directory('instrumentos_evaluacion')
                    ->required(),
                    
                    PdfViewerField::make('documento'),
                        //->fileUrl(fn ($record) => $record->documento),
                    //->label('Progresión')
                    //->minHeight('50svh'),

                     PdfViewerField::make('instrumento_evaluacion')                    
                    // ->fileUrl(fn ($record) => $record->instrumento_evaluacion)
                    // ->label('Instrumento de Evaluación')
                    // ->minHeight('50svh')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                // Tables\Columns\TextColumn::make('users.name')
                //     ->label('Docente')
                //     ->sortable()
                //     ->searchable(),
                
                Tables\Columns\TextColumn::make('uac'),
                Tables\Columns\TextColumn::make('num_progresion')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('materia')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'activo' => 'success',
                        'en proceso' => 'warning',
                        'concluido' => 'danger',
                    })
                    ->sortable()
                    ->searchable(),
                // Tables\Columns\TextColumn::make('documento')
                //     ->searchable(),
                // Tables\Columns\TextColumn::make('instrumento_evaluacion')
                //    ->searchable(),
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
            'index' => Pages\ListProgresions::route('/'),
            'create' => Pages\CreateProgresion::route('/create'),
            'edit' => Pages\EditProgresion::route('/{record}/edit'),
        ];
    }
}
