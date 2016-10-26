<?php

class View {
    private $title;
    private $template;
    private $content;
    private $data;

    public function __construct($template) {
        $this->template = $template;
    }

    public function render($view, $data = null) {
        $this->content = self::getContent($view);
        $this->data = $data;
        $this->renderLayout($this->template);
    }

    private function renderHead() {
        require(ROOT_DIR . '/templates/' . $this->template . '/meta.php');
        require(ROOT_DIR . '/templates/' . $this->template . '/links.php');
        require(ROOT_DIR . '/templates/' . $this->template . '/css.php');
        require(ROOT_DIR . '/templates/' . $this->template . '/js.php');
    }

    private function renderBody() {
        require(ROOT_DIR . '/templates/' . $this->template . '/begin.php');
        require(ROOT_DIR . '/templates/' . $this->template . '/header.php');
        echo $this->content;
        require(ROOT_DIR . '/templates/' . $this->template . '/footer.php');
        require(ROOT_DIR . '/templates/' . $this->template . '/end.php');
    }

    private function getContent($view) {
        ob_start();
        ob_implicit_flush(false);
        require(ROOT_DIR . '/app/views/' . $view . '.php');
        return ob_get_clean();
    }

    private function renderLayout($layout) {
        include ROOT_DIR . '/templates/layouts/' . $layout . '.php';
    }
}