<?php

class SearchController extends Controller
{
    public function actionIndex()
    {
        $data = '';
        //        if (isset($_POST['simple'])) {
        //            $data = $this->model->getData('simple');
        //        } elseif (isset($_POST['extended'])) {
        //            $data = $this->model->getData('extended');
        //        }
        
        //        echo '<pre>';
        //        print_r($_POST);
        //        echo '</pre>';
        
//        foreach ($_POST as $name => $value) {
//            echo "$" . "{$name} = isset(\$_POST['{$name}']) ? (\$_POST['{$name}'] ? \$_POST['{$name}'] : '') : '';<br>";
//        }
        
        if (isset($_POST['apartRent'])) {
            $data = $this->model->getRentApartData();
        }
        
        $this->view->render('search', $data);
    }
}