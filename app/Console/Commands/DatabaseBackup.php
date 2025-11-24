<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;

class DatabaseBackup extends Command
{

    protected $signature = 'backup:database';

    protected $description = 'Backs up the database and deletes backups older than 5 days';

    public function handle()
    {
        $dbUser = env('DB_USERNAME');
        $dbPass = env('DB_PASSWORD');
        $dbName = env('DB_DATABASE');

        $backupDir = base_path('database_backups');

        if (!File::exists($backupDir)) {
            File::makeDirectory($backupDir, 0755, true);
        }

        $date = now()->format('Y-m-d_H-i-s');
        $backupFile = "{$backupDir}/backup_{$date}.sql";

        $command = "mysqldump --no-tablespaces -u{$dbUser} -p\"{$dbPass}\" {$dbName} > {$backupFile}";

        exec($command, $output, $returnVar);

        if ($returnVar !== 0) {
            $this->error('❌ Database backup failed. Check credentials or permissions.');
            return;
        }

        $this->info("✅ Backup saved to: {$backupFile}");

        $this->deleteOldBackups($backupDir);
    }

    protected function deleteOldBackups($backupDir)
    {
        $files = File::allFiles($backupDir);
        $deletedCount = 0;

        foreach ($files as $file) {
            $modifiedTime = Carbon::createFromTimestamp($file->getMTime());

            if (now()->diffInDays($modifiedTime) > 5) {
                File::delete($file);
                $deletedCount++;
            }
        }

        $this->info("🧹 Deleted {$deletedCount} old backup(s) older than 5 days.");
    }
}
