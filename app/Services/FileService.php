<?php

namespace App\Services;

class FileService
{
    public static function upload(array $file)
    {
        if (!isset($file['error']) || $file['error'] !== UPLOAD_ERR_OK) {
            return null;
        }

        $uploadDir = __DIR__ . '/../../storage/files/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        $originalName = $file['name'];
        $originalName = basename($originalName);

        $storedName = uniqid('', true) . '_' . preg_replace('/[^A-Za-z0-9_\-\.]/', '_', $originalName);
        $destination = $uploadDir . $storedName;

        if (!move_uploaded_file($file['tmp_name'], $destination)) {
            return null;
        }

        return [
            'filename' => $originalName,
            'stored_name' => $storedName,
            'mime_type' => $file['type'] ?? mime_content_type($destination),
            'size' => filesize($destination),
            'path' => $destination
        ];
    }

    public static function removeStoredFile($storedName)
    {
        $path = __DIR__ . '/../../storage/files/' . $storedName;
        if (file_exists($path)) {
            @unlink($path);
            return true;
        }
        return false;
    }
}
