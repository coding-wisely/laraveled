<?php

namespace App\Jobs;

use App\Models\Project;
use App\Services\ShareService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ShareProjectJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $project;

    public function __construct(Project $project)
    {
        $this->project = $project;
    }

    public function handle(ShareService $shareService)
    {
        $shareService->shareProject($this->project);
    }
}
