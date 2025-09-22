<?php
namespace App\Core;

class Router {
    private $routes = [];

    public function Get($uri, $action) {
        $this->routes['GET'][$uri] = $action;
    }

    public function Post($uri, $action) {
        $this->routes['POST'][$uri] = $action;
    }

    public function Dispatch($uri) {
        $method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
        $action = $this->routes[$method][$uri] ?? null;

        if (!$action) {
            $this->ShowError404();
            return;
        }

        list($controllerName, $methodName) = explode('@', $action);
        $controllerClass = "App\\Controllers\\$controllerName";

        if (!class_exists($controllerClass)) {
            throw new \Exception("Clase controlador no encontrada: $controllerClass");
        }

        $controller = new $controllerClass();

        if (!method_exists($controller, $methodName)) {
            throw new \Exception("Método no encontrado: $methodName en $controllerClass");
        }

        call_user_func([$controller, $methodName]);
    }

    private function ShowError404() {
        require __DIR__ . '/../Views/Errors/Error404.php';
    }

    private function ShowError500($message) {
        $errorMessage = $message;
        require __DIR__ . '/../Views/Errors/Error500.php';
    }
}