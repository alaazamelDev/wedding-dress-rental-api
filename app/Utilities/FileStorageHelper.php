<?php

namespace App\Utilities;

use Illuminate\Http\UploadedFile;
use Storage;

class FileStorageHelper
{
    /**
     * Store a file and return its path.
     *
     * @param UploadedFile $file The file to be stored.
     * @param string $disk The storage disk to use (default: 'public').
     * @param string $directory The directory where the file should be stored (default: 'uploads').
     * @return string|null The path of the stored file, or null if no file is stored.
     */
    public static function storeFile(
        UploadedFile $file,
        string       $disk = 'public',
        string       $directory = 'uploads'
    ): ?string
    {
        // Check if the file is valid
        if (!$file->isValid()) {
            return null;
        }

        // Generate a unique file name with the original extension
        $fileName = self::generateUniqueFileName($file);

        // Store the file in the specified disk and directory
        return $file->storeAs($directory, $fileName, $disk);
    }

    public static function deleteFile(
        string $file_url,
        string $disk = 'public',
    ): bool
    {
        return Storage::disk($disk)->delete($file_url);
    }

    public static function getFullUrl($url): ?string
    {
        if (!isset($url))
            return null;

        $base_app_url = config('app.url');
        return $base_app_url . Storage::url($url);
    }

    /**
     * Generate a unique file name based on the original file name and extension.
     *
     * @param UploadedFile $file
     * @return string
     */
    private static function generateUniqueFileName(UploadedFile $file): string
    {
        return md5(uniqid() . $file->getClientOriginalName()) . '.' . $file->getClientOriginalExtension();
    }

}
