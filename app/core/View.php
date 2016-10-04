<?php

class View {
    public function displayPage($view = null, $title = 'Главная', $data = null) {
        $this->getHeader($title);
        $this->getBody($view, $data);
        $this->getFooter();
    }

    protected function getHeader($title = null) {
        include_once ROOT_DIR . '/template/layouts/header.php';
    }

    protected function getBody($viewFileName, $data = null){
        include_once ROOT_DIR . '/app/views/' . $viewFileName . '.php';
    }

    protected function getFooter() {
        include_once ROOT_DIR . '/template/layouts/footer.php';
    }
}