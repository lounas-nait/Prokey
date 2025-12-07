<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Notification;
use App\Repositories\FileRepository;

class FileController extends Controller
{
    protected $fileRepository;

    public function __construct()
    {
        $this->fileRepository = new FileRepository();
    }

    // Télécharger un fichier
    public function download($id)
    {
        $file = $this->fileRepository->getById($id);

        if (!$file) {
            Notification::add('error', 'Fichier introuvable');
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
        }

        $filepath = __DIR__ . '/../../storage/files/' . $file['stored_name'];

        if (!file_exists($filepath)) {
            Notification::add('error', 'Fichier introuvable sur le serveur');
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
        }

        header('Content-Description: File Transfer');
        header('Content-Type: ' . $file['mime_type']);
        header('Content-Disposition: attachment; filename="' . $file['filename'] . '"');
        header('Content-Length: ' . $file['size']);
        readfile($filepath);
        exit;
    }

    // Supprimer un fichier
    public function delete($id)
    {
        $file = $this->fileRepository->getById($id);

        if ($file) {
            $filepath = __DIR__ . '/../../storage/files/' . $file['stored_name'];
            if (file_exists($filepath)) {
                unlink($filepath);
            }
            $this->fileRepository->delete($id);
            Notification::add('success', 'Fichier supprimé');
        } else {
            Notification::add('error', 'Fichier introuvable');
        }

        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }
}
