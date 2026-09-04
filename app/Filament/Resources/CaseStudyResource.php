<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CaseStudyResource\Pages;
use App\Models\CaseStudy;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class CaseStudyResource extends Resource
{
    protected static ?string $model = CaseStudy::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Work';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Overview')
                    ->columns(2)
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->required()
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn (string $operation, $state, Forms\Set $set) => $operation === 'create' ? $set('slug', str($state)->slug()) : null),
                        Forms\Components\TextInput::make('slug')
                            ->required()
                            ->unique(ignoreRecord: true),
                        Forms\Components\TextInput::make('client'),
                        Forms\Components\TextInput::make('category'),
                        Forms\Components\TagsInput::make('service_tags')
                            ->placeholder('Add a service tag and press Enter')
                            ->columnSpanFull(),
                        Forms\Components\TagsInput::make('tools')
                            ->placeholder('Add a tool (e.g. Figma) and press Enter')
                            ->columnSpanFull(),
                        Forms\Components\DateTimePicker::make('published_at'),
                        Forms\Components\TextInput::make('sort_order')
                            ->required()
                            ->numeric()
                            ->default(0),
                    ]),

                Forms\Components\Section::make('Case Study Content')
                    ->schema([
                        Forms\Components\Textarea::make('about')
                            ->label('About the Project')
                            ->required()
                            ->rows(4),
                        Forms\Components\Repeater::make('challenges')
                            ->label('Challenges We Faced')
                            ->simple(
                                Forms\Components\TextInput::make('challenge')->required()
                            )
                            ->addActionLabel('Add challenge'),
                        Forms\Components\Repeater::make('problems_solutions')
                            ->label('Problems & Their Solutions')
                            ->schema([
                                Forms\Components\Textarea::make('problem')->required()->rows(2),
                                Forms\Components\Textarea::make('solution')->required()->rows(2),
                            ])
                            ->columns(2)
                            ->addActionLabel('Add problem/solution pair'),
                        Forms\Components\Textarea::make('outcome_results')
                            ->label('Outcome & Results')
                            ->rows(4),
                    ]),

                Forms\Components\Section::make('Client Testimonial')
                    ->columns(2)
                    ->schema([
                        Forms\Components\Textarea::make('testimonial_quote')
                            ->columnSpanFull()
                            ->rows(3),
                        Forms\Components\TextInput::make('testimonial_author'),
                        Forms\Components\TextInput::make('testimonial_title'),
                    ]),

                Forms\Components\Section::make('Media')
                    ->schema([
                        Forms\Components\SpatieMediaLibraryFileUpload::make('cover')
                            ->collection('cover')
                            ->image(),
                        Forms\Components\SpatieMediaLibraryFileUpload::make('gallery')
                            ->collection('gallery')
                            ->image()
                            ->multiple()
                            ->reorderable(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\SpatieMediaLibraryImageColumn::make('cover')
                    ->collection('cover'),
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('client')
                    ->searchable(),
                Tables\Columns\TextColumn::make('category')
                    ->searchable(),
                Tables\Columns\TextColumn::make('published_at')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('sort_order')
                    ->numeric()
                    ->sortable(),
            ])
            ->defaultSort('sort_order')
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
            'index' => Pages\ListCaseStudies::route('/'),
            'create' => Pages\CreateCaseStudy::route('/create'),
            'edit' => Pages\EditCaseStudy::route('/{record}/edit'),
        ];
    }
}
