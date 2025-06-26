<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class UploadTestController extends Controller
{
    /**
     * Test file upload endpoint
     */
    public function test(Request $request)
    {
        try {
            Log::info('Upload test started', [
                'content_length' => $request->header('Content-Length'),
                'content_type' => $request->header('Content-Type'),
                'method' => $request->method(),
                'has_files' => $request->hasFile('file'),
            ]);

            // Validate the file
            $request->validate([
                'file' => 'required|file|max:204800', // 200MB
            ]);

            $file = $request->file('file');
            
            $fileInfo = [
                'original_name' => $file->getClientOriginalName(),
                'size' => $file->getSize(),
                'mime_type' => $file->getMimeType(),
                'extension' => $file->getClientOriginalExtension(),
            ];

            Log::info('File info', $fileInfo);

            // Store the file
            $path = $file->store('test-uploads', 'temp');
            
            Log::info('File stored successfully', ['path' => $path]);

            // Clean up test file after 5 seconds (for testing)
            dispatch(function () use ($path) {
                sleep(5);
                Storage::disk('temp')->delete($path);
            })->afterResponse();

            return response()->json([
                'success' => true,
                'message' => 'File uploaded successfully',
                'file_info' => $fileInfo,
                'stored_path' => $path,
                'php_config' => [
                    'upload_max_filesize' => ini_get('upload_max_filesize'),
                    'post_max_size' => ini_get('post_max_size'),
                    'memory_limit' => ini_get('memory_limit'),
                    'max_execution_time' => ini_get('max_execution_time'),
                ],
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validation error', ['errors' => $e->errors()]);
            return response()->json([
                'success' => false,
                'error' => 'Validation failed',
                'details' => $e->errors(),
            ], 422);

        } catch (\Exception $e) {
            Log::error('Upload test failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return response()->json([
                'success' => false,
                'error' => 'Upload failed',
                'message' => $e->getMessage(),
                'php_config' => [
                    'upload_max_filesize' => ini_get('upload_max_filesize'),
                    'post_max_size' => ini_get('post_max_size'),
                    'memory_limit' => ini_get('memory_limit'),
                ],
            ], 500);
        }
    }

    /**
     * Get current PHP upload configuration
     */
    public function config()
    {
        return response()->json([
            'php_config' => [
                'upload_max_filesize' => ini_get('upload_max_filesize'),
                'post_max_size' => ini_get('post_max_size'),
                'memory_limit' => ini_get('memory_limit'),
                'max_execution_time' => ini_get('max_execution_time'),
                'max_input_time' => ini_get('max_input_time'),
                'max_file_uploads' => ini_get('max_file_uploads'),
                'file_uploads' => ini_get('file_uploads') ? 'On' : 'Off',
            ],
            'laravel_config' => [
                'environment' => config('app.env'),
                'debug' => config('app.debug'),
                'default_filesystem_disk' => config('filament.default_filesystem_disk'),
            ],
            'server_info' => [
                'php_version' => PHP_VERSION,
                'server_software' => $_SERVER['SERVER_SOFTWARE'] ?? 'Unknown',
                'request_time' => date('Y-m-d H:i:s'),
            ],
        ]);
    }
}
