<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Livewire\Features\SupportFileUploads\FileUploadConfiguration;
use Livewire\Features\SupportFileUploads\FileUploadController;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class CustomLivewireController extends FileUploadController
{
    public function handle(): array
    {
        $disk = FileUploadConfiguration::disk();
        $files = request('files');

//        Validator::make(['files' => $files], [
//            'files.*' => FileUploadConfiguration::rules()
//        ])->validate();

        $fileHashPaths = collect($files)->map(function ($file) use ($disk) {
            $filename = TemporaryUploadedFile::generateHashNameWithOriginalNameEmbedded($file);

            return $file->storeAs('/' . FileUploadConfiguration::path(), $filename, [
                'disk' => $disk
            ]);
        });

        // Strip out the temporary upload directory from the paths.
        $filePaths = $fileHashPaths->map(function ($path) {
            return str_replace(FileUploadConfiguration::path('/'), '', $path);
        });

        return ['paths' => $filePaths];
    }
}
