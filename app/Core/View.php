<?php

namespace App\Core;
class View {

    public static function render($view, $data = []) {
        $viewFile = __DIR__ . '/../Views/' . $view . '/index.php';
        if (file_exists($viewFile)) {
            extract($data);
            ob_start();
            include $viewFile;
            return ob_get_clean();

            require __DIR__ . '/../Views/layout/main.php';
        } else {
            throw new \Exception("View file not found: " . $viewFile);
        }
    }
}