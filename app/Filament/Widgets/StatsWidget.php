<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\ProjectResource\Pages\ListProjects;
use App\Models\Comment;
use App\Models\Project;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsWidget extends BaseWidget
{
    protected function getStats(): array
    {
        $projectsCount = Project::count();
        $usersCount = User::count();
        $unapprovedCommentsCount = Comment::whereNull('approved')->count();

        return [
            'projects' => Stat::make('Projects', $projectsCount)
                ->description('Total projects available')
                ->descriptionIcon('heroicon-o-folder-open')
                ->color('primary')
                ->url(ListProjects::getUrl()),

            'users' => Stat::make('Users', $usersCount)
                ->description('Registered users')
                ->descriptionIcon('heroicon-s-user-group')
                ->color('success'),

            'comments' => Stat::make('Unapproved Comments', $unapprovedCommentsCount)
                ->description("{$unapprovedCommentsCount} need review")
                ->descriptionIcon('heroicon-s-exclamation-circle')
                ->color($unapprovedCommentsCount ? 'warning' : 'success'),

        ];
    }
}
