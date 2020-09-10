<?php

class Dispatcher
{

    private $request;

    public function Dispatch()
    {
        $this->request = new Request();
        Router::parse($this->request->url, $this->request);

        $controller = $this->loadController();

        call_user_func_array([$controller, $this->request->action], $this->request->params);
    }

    public function loadController()
    {
        $name = $this->request->controller . "Controller";
        $file = ROOT . "Controllers/" . $name . ".php";

        if (file_exists($file))
        {
            require($file);
            $controller = new $name();
            return $controller;
        }
        else
        {
            return require(ROOT . "Views/Layouts/default.php");
        }
    }

}
?>