<?php

class View extends Access implements ViewInterface
{
    use PrintHelper;

    private $title;
    private $css = "";
    private $js = "";
    private $cssFiles = [];
    private $jsFiles = [];
    private $layout;
    private $content;
    public $data;

    public function __construct($layout)
    {
        $this->layout = $layout;
    }

    public function render($view, $data = null)
    {
        $this->data = $data;
        $this->content = $this->getView($view);
        $this->renderLayout();
    }

    private function title()
    {
        echo $this->title;
    }

    private function head()
    {
        foreach ($this->cssFiles as $file) {
            echo $file;
        }

        if (!empty($this->css)) {
            echo "<style>\n";
            echo $this->css;
            echo "</style>\n";
        }

        foreach ($this->jsFiles as $file) {
            echo $file;
        }

        if (!empty($this->js)) {
            echo "<script>\n";
            echo $this->js;
            echo "</script>\n";
        }
    }

    private function content()
    {
        echo $this->content;
    }

    public function addJSCode($code)
    {
        $this->js .= "{$code}\n";
    }

    public function addJSFile($link, $loadType = null)
    {
        if (filter_var($link, FILTER_VALIDATE_URL)) {
            $this->jsFiles[] = "<script {$loadType} src=\"{$link}\"></script>\n";
        } else {
            $this->jsFiles[] = "<script {$loadType} src=\"/template/js/{$link}\"></script>\n";
        }
    }

    public function addCSSCode($code)
    {
        $this->css .= "{$code}\n";
    }

    public function addCSSFile($link)
    {
        if (filter_var($link, FILTER_VALIDATE_URL)) {
            $this->cssFiles[] = "<link rel=\"stylesheet\" href=\"{$link}\">\n";
        } else {
            $this->cssFiles[] = "<link rel=\"stylesheet\" href=\"/template/css/{$link}\">\n";
        }
    }

    private function getView($view)
    {
        ob_start();
        ob_implicit_flush(false);
        include(ROOT_DIR . '/app/views/' . $view . '.php');
        return ob_get_clean();
    }

    private function renderLayout()
    {
        include(ROOT_DIR . '/template/layouts/' . $this->layout . '.php');
    }

    private function printFormError($errorsArr)
    {
        foreach ($errorsArr as $error) {
            echo "<br><span style='margin-left: 5px; font-family: Arial sans-serif; font-size: 10pt; color: #942a25'>{$error}</span>";
        }
    }
}