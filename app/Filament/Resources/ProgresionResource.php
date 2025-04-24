<?php

namespace App\Filament\Resources;



use App\Filament\Resources\ProgresionResource\Pages;
use App\Filament\Resources\ProgresionResource\RelationManagers;
use App\Models\Progresion;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Actions\Action;
use Joaopaulolndev\FilamentPdfViewer\Forms\Components\PdfViewerField;
use Illuminate\Support\Facades\Auth;
use Filament\Tables\Filters\SelectFilter;
use Filament\Forms\Components\Section;


class ProgresionResource extends Resource
{
    protected static ?string $model = Progresion::class;

    protected static ?string $label = 'Progresiones';

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->schema([
                        Section::make('Datos Generales')
                            ->schema([
                                Forms\Components\Select::make('user_id')
                                    ->relationship(name:'users', titleAttribute:'name')
                                    ->searchable()
                                    ->label('Usuario')
                                    ->required(),
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
                            ])->columns(2),
                        Section::make('Documentos')
                            ->schema([                       
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
                            ])->columns(2),
                    ])->columns(2),
                Section::make('Documentos')
                    ->schema([
                        PdfViewerField::make('documento'),
                        PdfViewerField::make('instrumento_evaluacion')
                            ->label('Instrumento de Evaluación')
                            //->fileUrl(fn ($record) => $record->instrumento_evaluacion)
                    ])->columns(2),                    
            ])->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('users.name')                    
                    ->label('Docente')
                    //->hidden()
                    ->sortable()
                    ->searchable(),                
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
                SelectFilter::make('status')
                    ->options([
                        'activo' => 'Activo',
                        'en proceso' => 'En Proceso',
                        'concluido' => 'Concluido',
                    ]),
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
            'index' => Pages\ListProgresions::route('/'),
            'create' => Pages\CreateProgresion::route('/create'),
            'edit' => Pages\EditProgresion::route('/{record}/edit'),
        ];
    }

    

    
}
