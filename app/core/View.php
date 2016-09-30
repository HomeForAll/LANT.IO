<?php

class View {
    public function displayPage($actionName = null, $title = 'Главная', $data = null) {
        $this->getHeader($title);
        $this->getBody($actionName, $data);
        $this->getFooter();
    }

    protected function getHeader($title = null) {
        include_once ROOT_DIR . '/template/layouts/header.php';
    }

    protected function getBody($actionName, $data = null){
        include_once ROOT_DIR . '/app/views/' . $actionName . 'View.php';
    }

    protected function getFooter() {
        include_once ROOT_DIR . '/template/layouts/footer.php';
    }
}

