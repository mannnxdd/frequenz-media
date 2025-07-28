<?php

namespace App\Console\Commands;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Console\Command;
use App\Models\Project;
use Illuminate\Support\Carbon;

class PublishProjects extends Command
{
     protected $signature = 'projects:publish';
    protected $description = 'Publikasikan proyek yang sudah dijadwalkan';

    public function handle(): int
    {
        $now = Carbon::now();

        $projects = Project::where('is_published', false)
            ->where('status', 'selesai')
            ->whereNotNull('publish_at')
            ->where('publish_at', '<=', $now)
            ->get();

        foreach ($projects as $project) {
            $project->update(['is_published' => true]);
            $this->info("✅ Published project ID {$project->id}");
        }

        return Command::SUCCESS;
    }

    // ✅ Tambahkan ini untuk menjadwalkan langsung di Laravel 12
    public function schedule(Schedule $schedule): void
    {
        $schedule->everyMinute();
    }
}
