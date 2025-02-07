<?php

namespace App\Filament\Resources\ArticleResource\Widgets;

use App\Models\Article;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ArticleOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $countArticles = Article::count();

        return [
            Stat::make('Кол-во статей', $countArticles),
        ];
    }
}
