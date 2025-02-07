<?php

namespace App\Services\Filament;

use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Model;

readonly class TableColumns
{
    /**
     * @param string $label
     * @return TextColumn
     */
    public static function getUpdatedAtColumn(string $label = 'Обновлено'): TextColumn
    {
        return TextColumn::make('created_at')
            ->label($label)
            ->placeholder('Никогда')
            ->dateTime('d F Y')
            ->toggleable()
            ->searchable(false)
            ->sortable();
    }

    /**
     * @param string $label
     * @return TextColumn
     */
    public static function getCreatedAtColumn(string $label = 'Создано'): TextColumn
    {
        return TextColumn::make('updated_at')
            ->label($label)
            ->placeholder('Никогда')
            ->dateTime('d F Y')
            ->toggleable()
            ->searchable(false)
            ->sortable();
    }
}


