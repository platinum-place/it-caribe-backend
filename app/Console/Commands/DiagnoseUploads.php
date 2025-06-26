<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class DiagnoseUploads extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'uploads:diagnose';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Diagnose file upload configuration and permissions';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('🔍 Diagnosing file upload configuration...');
        $this->newLine();

        // PHP Configuration
        $this->info('📋 PHP Configuration:');
        $this->table(['Setting', 'Value'], [
            ['upload_max_filesize', ini_get('upload_max_filesize')],
            ['post_max_size', ini_get('post_max_size')],
            ['memory_limit', ini_get('memory_limit')],
            ['max_execution_time', ini_get('max_execution_time')],
            ['max_input_time', ini_get('max_input_time')],
            ['max_file_uploads', ini_get('max_file_uploads')],
            ['file_uploads', ini_get('file_uploads') ? 'On' : 'Off'],
        ]);

        $this->newLine();

        // Storage Directories
        $this->info('📁 Storage Directories:');
        $directories = [
            'storage/app/private' => storage_path('app/private'),
            'storage/app/public' => storage_path('app/public'),
            'storage/app/temp' => storage_path('app/temp'),
            'storage/logs' => storage_path('logs'),
        ];

        foreach ($directories as $name => $path) {
            $exists = is_dir($path);
            $writable = $exists ? is_writable($path) : false;
            $permissions = $exists ? substr(sprintf('%o', fileperms($path)), -4) : 'N/A';
            
            $status = $exists ? ($writable ? '✅' : '❌') : '❌';
            $this->line("$status $name: " . ($exists ? "exists" : "missing") . 
                      ($exists ? ", writable: " . ($writable ? "yes" : "no") . ", permissions: $permissions" : ""));
        }

        $this->newLine();

        // Disk Configuration
        $this->info('💾 Disk Configuration:');
        $disks = ['local', 'public', 'temp'];
        
        foreach ($disks as $disk) {
            try {
                $diskConfig = config("filesystems.disks.$disk");
                if ($diskConfig) {
                    $this->line("✅ $disk: " . $diskConfig['root']);
                    
                    // Test write permissions
                    $testFile = "$disk-test-" . time() . ".txt";
                    try {
                        Storage::disk($disk)->put($testFile, 'test');
                        Storage::disk($disk)->delete($testFile);
                        $this->line("   ✅ Write test: passed");
                    } catch (\Exception $e) {
                        $this->line("   ❌ Write test: failed - " . $e->getMessage());
                    }
                } else {
                    $this->line("❌ $disk: not configured");
                }
            } catch (\Exception $e) {
                $this->line("❌ $disk: error - " . $e->getMessage());
            }
        }

        $this->newLine();

        // Environment
        $this->info('🌍 Environment:');
        $this->table(['Variable', 'Value'], [
            ['APP_ENV', config('app.env')],
            ['APP_DEBUG', config('app.debug') ? 'true' : 'false'],
            ['FILAMENT_FILESYSTEM_DISK', config('filament.default_filesystem_disk')],
        ]);

        $this->newLine();

        // Recommendations
        $this->info('💡 Recommendations for production:');
        $this->line('1. Ensure all storage directories exist and are writable');
        $this->line('2. Check nginx/apache configuration for client_max_body_size');
        $this->line('3. Verify proxy settings if using reverse proxy');
        $this->line('4. Check server logs for specific error messages');
        $this->line('5. Test with smaller files first to isolate the issue');

        return Command::SUCCESS;
    }
}
