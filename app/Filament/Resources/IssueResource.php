<?php

namespace App\Filament\Resources;

use App\Filament\Resources\IssueResource\Pages;
use App\Models\Issue;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use App\Models\Gender;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;

class IssueResource extends Resource
{
    protected static ?string $model = Issue::class;

    protected static ?string $navigationIcon = 'heroicon-o-book-open';



    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                        TextInput::make('issue_doi')
                        ->label('DOI'),                
                        Select::make('major_id')
                        ->label('Major')
                        ->relationship('major', 'major_name_en')
                        ->createOptionForm([
                            TextInput::make('major_name_en'),
                            TextInput::make('major_name_kh')
                        ])
                            ->createOptionUsing(function (array $data) {
                            // Create new publication issue
                            return \App\Models\Major::create($data)->id;
                        }),

                        Select::make('journal_type_id')
                        ->label('Journal Type')
                        ->relationship('journalType', 'type_name_en'),
                        
                        Textarea::make('journal_title')
                        ->label('Title'),
                        
                        Select::make('publication_issue_id')
                        ->label('Publication Issue')
                        ->relationship(
                            name: 'publicationIssue',
                            titleAttribute: 'year',
                        )
                        ->getOptionLabelFromRecordUsing(fn ($record) => 
                            "{$record->year} (Vol. {$record->volume_number}, Issue {$record->issue_number})"
                        )
                        ->preload()
                        ->searchable(['year', 'volume_number', 'issue_number'])
                        ->createOptionForm([ // Add this
                            TextInput::make('volume_number')
                                ->required()
                                ->numeric()
                                ->minValue(1),
                            TextInput::make('issue_number')
                                ->required()
                                ->numeric()
                                ->minValue(1),
                            TextInput::make('number_page')
                                ->required(),
                            TextInput::make('year')
                                ->required()
                                ->numeric()
                                ->minValue(1900)
                                ->maxValue(now()->year),
                            
                        ])
                        ->createOptionUsing(function (array $data) {
                            // Create new publication issue
                            return \App\Models\PublicationIssue::create($data)->id;
                        }),
                        Textarea::make('abstract')
                        ->label("Abstract"),
                        TextInput::make('pdf')
                        ->label('PDF'),
                        TextInput::make('number_page')
                        ->Label('Page Number'),
                        Select::make('authors')
                            ->multiple() // If it's a many-to-many relationship
                            ->relationship('authors', 'firstname') // Adjust based on your actual relationship
                            ->getOptionLabelFromRecordUsing(fn ($record) =>
                                "{$record->firstname} {$record->lastname}"
                            )
                            ->searchable(['firstname', 'lastname', 'email'])
                            ->preload()
                            ->createOptionForm([
                                Forms\Components\TextInput::make('firstname')
                                    ->required()
                                    ->maxLength(255),
                                
                                Forms\Components\TextInput::make('lastname') // FIXED: 'lastname' not 'lasttname'
                                    ->required()
                                    ->maxLength(255),
                                
                                Forms\Components\Select::make('gender_id')
                                    ->label('Gender')
                                    ->options(function () {
                                        return Gender::all()->pluck('type_en', 'id')->toArray();
                                    })

                                    ->searchable()
                                    ->preload()
                                    ->required(),
                                
                                Forms\Components\TextInput::make('email')
                                    ->email() // FIXED: email() not numeric()
                                    ->maxLength(255),
                                    
                                Forms\Components\TextInput::make('author_orcid')
                                    ->label('ORCID')
                                    ->maxLength(255),
                            ])
                            ->createOptionUsing(function (array $data) {
                                return \App\Models\JournalAuthor::create($data)->id;
                            }),
                            Select::make('journalKeyword')
                            ->label('Keywords')
                            ->multiple()
                            ->preload()
                            ->relationship('journalKeyword', 'name_en')
                            ->searchable()
                            ->createOptionForm([
                                TextInput::make('name_en')
                                    ->required()
                                    ->maxLength(255),
                                TextInput::make('name_kh')
                                ->required()
                                ->maxLength(255),
                            ])
                            ->createOptionUsing(fn (array $data) =>
                                \App\Models\JournalKeywords::create($data)->id
                            ),
                            Select::make('journalReferences')
                            ->label('References')
                            ->multiple()
                            ->relationship('journalReferences', 'reference')
                            ->searchable()
                            ->preload()
                            ->createOptionForm([
                                Forms\Components\Textarea::make('reference')
                                    ->label('Reference')
                                    ->required(),

                                Forms\Components\TextInput::make('doi')
                                    ->label('DOI'),

                                Forms\Components\TextInput::make('google_scholar')
                                    ->label('Google Scholar'),

                                Forms\Components\TextInput::make('website')
                                    ->label('Website')
                                    ->url(),
                            ])
                            ->createOptionUsing(fn (array $data) =>
                                \App\Models\JournalReference::create($data)->id
                            ),
                            TextInput::make("cite"),
                            Toggle::make("status")
                            ->label('Status')
                            ->default(1) 
                        ]);
                }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                ->label("ID")
                ->sortable(),
                TextColumn::make('major.major_name_en')
                ->label("Major")
                ->badge()
                ->color(fn ($state): string => match ($state) {
                    'Management' => 'primary',
                    'Educational Administration' => 'success',
                    'Marketing' => 'warning',
                    'Information Technology' => 'danger',
                    'Teaching English as Foreign Language' => 'info',
                    default => 'gray',
                })
                ->formatStateUsing(fn ($state) => ucwords(strtolower($state)))
                ->sortable(),
                TextColumn::make('journalType.type_name_en')
                ->label("Journal Type"),
                TextColumn::make('publicationIssue.volume_number')
                ->label("Volume"),
                TextColumn::make('publicationIssue.issue_number')
                ->label("Issue"),
                TextColumn::make('publicationIssue.year')
                ->label("Year")
                ->sortable(),
                TextColumn::make('number_page')
                ->label("Page Number"),
                TextColumn::make('pdf')
                ->label("PDF"),
                TextColumn::make('status')
                ->label("Status")
                ->sortable()
                ->badge()
                ->color(fn ($state): string => match ($state) {
                    1, '1', true, 'true' => 'success  ', // Try multiple possibilities
                    0, '0', false, 'false' => 'gray',
                    default => 'gray',
                })
                
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
            'index' => Pages\ListIssues::route('/'),
            'create' => Pages\CreateIssue::route('/create'),
            'edit' => Pages\EditIssue::route('/{record}/edit'),
        ];
    }
}