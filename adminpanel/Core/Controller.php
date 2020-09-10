<?php

class Controller
{
    var $vars = [];
    var $layout = "default";

    function Set($d)
    {
        $this->vars = array_merge($this->vars, $d);
    }

    function Render($filename)
    {
        extract($this->vars);
        ob_start();
        require(ROOT . "Views/" . ucfirst(str_replace("Controller", "", get_class($this))) . "/" . $filename . ".php");
        $content_for_layout = ob_get_clean();

        if ($this->layout == false)
        {
            $content_for_layout;
        }
        else
        {
            require(ROOT . "Views/Layouts/" . $this->layout . ".php");
        }
    }

    private function SecureInput($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    protected function SecureForm($form)
    {
        foreach ($form as $key => $value)
        {
            $form[$key] = $this->SecureInput($value);
        }
    }

}
?>