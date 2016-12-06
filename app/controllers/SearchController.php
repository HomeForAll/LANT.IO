<?php

class SearchController extends Controller {
    public function actionIndex() {
        $data = '';
//        if (isset($_POST['simple'])) {
//            $data = $this->model->getData('simple');
//        } elseif (isset($_POST['extended'])) {
//            $data = $this->model->getData('extended');
//        }

//        echo '<pre>';
//        print_r($_POST);
//        echo '</pre>';

        foreach ($_POST as $name => $value) {
            echo "$" . "{$name} = (\$_POST['{$name}'] ? \$_POST['{$name}'] : '');<br>";
        }

        $this->view->render('search', $data);
    }
}