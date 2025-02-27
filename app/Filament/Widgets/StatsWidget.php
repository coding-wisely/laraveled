<?php

namespace App\Filament\Widgets;

use App\Enums\TrackableEnum;
use App\Filament\Resources\CommentResource\Pages\ListComments;
use App\Filament\Resources\ProjectResource\Pages\ListProjects;
use App\Models\Comment;
use App\Models\Project;
use App\Models\Track;
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
        $totalWebsiteTracks = Track::where('action', TrackableEnum::WEBISTE_VISITED)->count();

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
                ->color($unapprovedCommentsCount ? 'warning' : 'success')
                ->url(ListComments::getUrl(['activeTab' => 'unapproved'])),

            'websiteTracks' => Stat::make('Website Tracks', $totalWebsiteTracks)
                ->description('Total website visits')
                ->descriptionIcon('heroicon-o-globe-alt')
                ->color('info'),

        ];
    }
}
