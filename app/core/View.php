<?php

class View {
    private $title;
    private $template;
    private $name;
    private $data;

    public function __construct($template) {
        $this->template = $template;
    }

    public function render($view, $data = null) {
        $this->name = $view;
        $this->data = $data;
        include ROOT_DIR . '/templates/layouts/main.php';
    }

    private function renderHead() {
        include ROOT_DIR . '/templates/' . $this->template . '/meta.php';
        include ROOT_DIR . '/templates/' . $this->template . '/links.php';
        include ROOT_DIR . '/templates/' . $this->template . '/css.php';
        include ROOT_DIR . '/templates/' . $this->template . '/js.php';
    }

    private function renderBody() {
        include ROOT_DIR . '/templates/' . $this->template . '/begin.php';
        include ROOT_DIR . '/templates/' . $this->template . '/header.php';
        include ROOT_DIR . '/app/views/' . $this->name . '.php';
        include ROOT_DIR . '/templates/' . $this->template . '/footer.php';
        include ROOT_DIR . '/templates/' . $this->template . '/end.php';
    }
}