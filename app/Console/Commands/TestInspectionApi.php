<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class TestInspectionApi extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:inspection-api {--url=} {--token=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test the inspection API with sample data';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $url = $this->option('url') ?: 'https://api.gruponobe.com';
        $token = $this->option('token');

        if (!$token) {
            $this->error('Please provide a token with --token option');
            return Command::FAILURE;
        }

        $this->info('🧪 Testing Inspection API...');
        $this->newLine();

        // Test with small base64 image (should work)
        $this->testWithSmallImage($url, $token);
        
        $this->newLine();
        
        // Test with larger base64 image (the problematic case)
        $this->testWithLargeImage($url, $token);

        return Command::SUCCESS;
    }

    private function testWithSmallImage($url, $token)
    {
        $this->info('📸 Testing with small image (1KB)...');
        
        // Create a small 1x1 pixel PNG in base64
        $smallImage = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVR42mNkYPhfDwAChwGA60e6kgAAAABJRU5ErkJggg==';
        
        $data = $this->getSampleData($smallImage);
        
        $response = Http::withHeaders([
            'Authorization' => "Bearer $token",
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->timeout(60)->post("$url/api/cotizador/Inspeccionar", $data);

        if ($response->successful()) {
            $this->info('✅ Small image test: SUCCESS');
            $this->line('Response: ' . $response->body());
        } else {
            $this->error('❌ Small image test: FAILED');
            $this->line('Status: ' . $response->status());
            $this->line('Response: ' . $response->body());
        }
    }

    private function testWithLargeImage($url, $token)
    {
        $this->info('📸 Testing with large image (~25KB)...');
        
        // Create a larger base64 image (simulating a real photo)
        $largeImage = $this->generateLargeBase64Image();
        
        $data = $this->getSampleData($largeImage);
        
        $this->info('Data size: ' . number_format(strlen(json_encode($data))) . ' bytes');
        
        $response = Http::withHeaders([
            'Authorization' => "Bearer $token",
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->timeout(120)->post("$url/api/cotizador/Inspeccionar", $data);

        if ($response->successful()) {
            $this->info('✅ Large image test: SUCCESS');
            $this->line('Response: ' . $response->body());
        } else {
            $this->error('❌ Large image test: FAILED');
            $this->line('Status: ' . $response->status());
            $this->line('Response: ' . $response->body());
        }
    }

    private function getSampleData($imageBase64)
    {
        return [
            'cotz_id' => '12345678-1234-1234-1234-123456789012', // Sample UUID
            'passcode' => '1234',
            'Correo' => 'test@example.com',
            'CantPasajeros' => 5,
            'Cilindros' => 4,
            'Odometro' => 50000,
            'unidadOdometro' => 'km',
            'Foto1' => $imageBase64,
            'Foto2' => $imageBase64,
            'Foto3' => $imageBase64,
            'Foto4' => $imageBase64,
            'Foto5' => $imageBase64,
            'Foto6' => $imageBase64,
            'Foto7' => $imageBase64,
            'Foto8' => $imageBase64,
            'Foto9' => $imageBase64,
            'Foto13' => $imageBase64,
        ];
    }

    private function generateLargeBase64Image()
    {
        // Create a 100x100 pixel image with random colors to simulate a real photo
        $width = 100;
        $height = 100;
        
        $image = imagecreate($width, $height);
        
        // Fill with random colors to make it larger when encoded
        for ($x = 0; $x < $width; $x++) {
            for ($y = 0; $y < $height; $y++) {
                $color = imagecolorallocate($image, rand(0, 255), rand(0, 255), rand(0, 255));
                imagesetpixel($image, $x, $y, $color);
            }
        }
        
        // Capture the image as PNG
        ob_start();
        imagepng($image);
        $imageData = ob_get_contents();
        ob_end_clean();
        
        imagedestroy($image);
        
        return 'data:image/png;base64,' . base64_encode($imageData);
    }
}
