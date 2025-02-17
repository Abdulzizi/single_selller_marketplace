<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Spatie\DbDumper\Databases\MySql;
use Illuminate\Support\Facades\File;

class BackupDatabase extends Command
{
    protected $signature = 'backup:database';
    protected $description = 'Backup MySQL and MongoDB databases and upload to Cloudinary';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $this->info('Starting database backup...');

        $timestamp = now()->format('Y-m-d_H-i-s');
        $backupPath = storage_path("backups");
        if (!File::exists($backupPath)) {
            File::makeDirectory($backupPath, 0755, true);
        }

        // Backup MySQL
        $mysqlFileName = "mysql_backup_{$timestamp}.sql";
        $mysqlFilePath = "{$backupPath}/{$mysqlFileName}";

        MySql::create()
            ->setHost(env('DB_HOST'))
            ->setDbName(env('DB_DATABASE'))
            ->setUserName(env('DB_USERNAME'))
            ->setPassword(env('DB_PASSWORD'))
            ->dumpToFile($mysqlFilePath);

        $this->info('MySQL backup completed.');

        // Backup MongoDB
        $mongoFileName = "mongodb_backup_{$timestamp}.gz";
        $mongoFilePath = "{$backupPath}/{$mongoFileName}";
        $mongoUri = env('MONGO_URI', 'mongodb://localhost:27017');
        $mongoDatabase = env('MONGO_DB', 'your_mongo_database');

        $mongoDumpCommand = "mongodump --uri=\"{$mongoUri}\" --db={$mongoDatabase} --archive={$mongoFilePath} --gzip";
        shell_exec($mongoDumpCommand);

        $this->info('MongoDB backup completed.');

        // Upload to Cloudinary
        $this->uploadToCloudinary($mysqlFilePath, 'mysql_backup');
        $this->uploadToCloudinary($mongoFilePath, 'mongodb_backup');

        $this->info('Backup successfully uploaded to Cloudinary.');
    }

    private function uploadToCloudinary($filePath, $folder)
    {
        $this->info("Uploading {$filePath} to Cloudinary...");
        Cloudinary::upload($filePath, [
            'folder' => "database_backups/{$folder}",
            'resource_type' => 'raw'
        ]);

        $this->info("Upload of {$filePath} completed.");
    }
}
