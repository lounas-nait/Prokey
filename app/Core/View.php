<?php

namespace App\Core;
use App\Core\Notification;
use App\Core\Auth;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use Twig\TwigFunction;

class View {

    private static $twig = null;

    private static function init() {
        if (self::$twig === null) {
            $loader = new FilesystemLoader(__DIR__ . '/../Views');
            self::$twig = new Environment($loader, [
                'cache' => false,
                'auto_reload' => true,
                'debug' => true,
            ]);

            self::$twig->addGlobal('auth_user', Auth::user());
            self::$twig->addGlobal('notifications', Notification::get());
            self::$twig->addFunction(new TwigFunction('url', function ($path = '') {
                return url($path);
            }));
        }
    }

    public static function render(string $viewName, array $data = []) {
        self::init();
        echo self::$twig->render($viewName . '.twig', $data);
    }

    public static function renderOld(string $viewName ,array $data = []) {
        $viewFile = __DIR__ . '/../Views/' . $viewName . '.php';
        
        if (!file_exists($viewFile)) {
            throw new \Exception("Vue non trouvé : $viewFile");
        }

        extract($data); 

        ob_start();
        include $viewFile;
        $content = ob_get_clean();

        $layoutPath = __DIR__ . '/../Views/layout/main.php';

        $user = Auth::user();
        $notifications = Notification::get();  

        ob_start();
        require $layoutPath;
        $layout = ob_get_clean();
        echo $layout;
    }
}