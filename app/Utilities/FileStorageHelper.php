<?php

namespace App\Utilities;

use Storage;

class FileStorageHelper
{
    /**
     * Store a file and return its path.
     *
     * @param string $fileUrl The URL of the file to be stored.
     * @param string $disk The storage disk to use (default: 'public').
     * @param string $directory The directory where the file should be stored (default: 'uploads').
     * @return string|null The path of the stored file, or null if no file is stored.
     */
    public static function storeFile(
        string $fileUrl,
        string $disk = 'public',
        string $directory = 'uploads'
    ): ?string
    {
        // Check if the file exists
        if (!file_exists($fileUrl)) {
            return null;
        }

        // Get the file contents
        $fileContents = file_get_contents($fileUrl);

        // Generate a unique file name
        $fileName = $directory . '/' . uniqid() . '_' . basename($fileUrl);

        // Store the file
        Storage::disk($disk)->put($fileName, $fileContents);

        // Return the stored file path without the base URL
        return $fileName;
    }
}
