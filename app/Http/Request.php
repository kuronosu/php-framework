<?php

namespace App\Http;

class Request
{
    protected $uri;
    protected static $controllers = [];

    public function __construct()
    {
        $this->uri = $_SERVER['REQUEST_URI'];
    }

    public function getController()
    {
        if (array_key_exists($this->uri, Request::$controllers)) {
            return Request::$controllers[$this->uri];
        }
        return null;
    }

    public function getMethod()
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    public function send()
    {
        $controller = $this->getController();
        if ($controller == null) {
            http_response_code(404);
            view('404')->send();
            die();
        }
        $method = $this->getMethod();

        try {
            $response = call_user_func([new $controller, $method]);
        } catch (\Throwable $th) {
            http_response_code(405);
            view('405')->send();
            die();
        }


        try {
            if ($response instanceof Response) {
                $response->send();
            } else {
                throw new \Exception("Error Processing Request");
            }
        } catch (\Throwable $e) {
            echo "Details {$e->getMessage()}";
        }
    }

    public static function register($uri, $controller)
    {
        Request::$controllers[$uri] = $controller;
    }
}
