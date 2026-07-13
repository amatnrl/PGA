<?php

namespace App\Services;

use Config\Database;
use ZipArchive;

class BackupService
{
    private string $backupDir;

    public function __construct()
    {
        $this->backupDir = WRITEPATH . 'backups/';

        if (! is_dir($this->backupDir)) {
            mkdir($this->backupDir, 0755, true);
        }
    }

    public function createBackup(): array
    {
        $timestamp = date('Y-m-d_His');
        $db        = Database::connect();
        $platform  = $db->getPlatform();

        $dbFile = $this->backupDriverAwareDump($db, $platform, $timestamp);
        $mediaFile = $this->zipUploads($timestamp);

        return ['database' => $dbFile, 'media' => $mediaFile];
    }

    private function backupDriverAwareDump($db, string $platform, string $timestamp): string
    {
        if ($platform === 'SQLite3') {
            $dbConfig = config('Database')->default;
            $sourcePath = WRITEPATH . $dbConfig['database'];
            $destName   = "db-{$timestamp}.sqlite3";
            copy($sourcePath, $this->backupDir . $destName);

            return $destName;
        }

        // MySQLi (or compatible): shell out to mysqldump with escaped arguments.
        $dbConfig = config('Database')->default;
        $destName = "db-{$timestamp}.sql";
        $destPath = $this->backupDir . $destName;

        $cmd = sprintf(
            'mysqldump --host=%s --user=%s --password=%s %s > %s 2>/dev/null',
            escapeshellarg($dbConfig['hostname']),
            escapeshellarg($dbConfig['username']),
            escapeshellarg($dbConfig['password']),
            escapeshellarg($dbConfig['database']),
            escapeshellarg($destPath)
        );

        shell_exec($cmd);

        return $destName;
    }

    private function zipUploads(string $timestamp): string
    {
        $destName = "media-{$timestamp}.zip";
        $destPath = $this->backupDir . $destName;
        $uploadsDir = FCPATH . 'uploads';

        $zip = new ZipArchive();
        $zip->open($destPath, ZipArchive::CREATE | ZipArchive::OVERWRITE);

        if (is_dir($uploadsDir)) {
            $files = new \RecursiveIteratorIterator(
                new \RecursiveDirectoryIterator($uploadsDir, \RecursiveDirectoryIterator::SKIP_DOTS)
            );

            foreach ($files as $file) {
                $localPath = substr($file->getPathname(), strlen($uploadsDir) + 1);
                $zip->addFile($file->getPathname(), 'uploads/' . $localPath);
            }
        }

        $zip->close();

        return $destName;
    }

    public function listBackups(): array
    {
        $files = glob($this->backupDir . '*');
        $rows  = [];

        foreach ($files as $file) {
            $rows[] = [
                'name'    => basename($file),
                'size'    => filesize($file),
                'created' => date('Y-m-d H:i:s', filemtime($file)),
            ];
        }

        usort($rows, fn ($a, $b) => strcmp($b['created'], $a['created']));

        return $rows;
    }

    public function getFilePath(string $name): ?string
    {
        $path = $this->backupDir . basename($name);

        return is_file($path) ? $path : null;
    }

    public function deleteBackup(string $name): bool
    {
        $path = $this->backupDir . basename($name);

        return is_file($path) && unlink($path);
    }
}
