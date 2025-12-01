<?php

namespace App\Core;
class View {

    public static function render(string $entity, string $viewName ,array $data = []) {
        $viewFile = __DIR__ . '/../Views/' . $entity . '/' . $viewName . '.php';

        if (!file_exists($viewFile)) {
            throw new \Exception("Vue non trouvé : $viewFile");
        }

        extract($data); 

        ob_start();
        include $viewFile;
        $content = ob_get_clean();

        $layoutPath = __DIR__ . '/../Views/layout/main.php';

        ob_start();
        require $layoutPath;
        $layout = ob_get_clean();
        echo $layout;
    }
}