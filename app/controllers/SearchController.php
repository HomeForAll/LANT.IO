<?php

class SearchController extends Controller
{
    public function actionIndex()
    {
        $data = array();
        
//        foreach ($_POST as $name => $value) {
//            echo "$" . "{$name} = isset(\$_POST['{$name}']) ? \$_POST['{$name}'] : '';<br>";
//        }
    
        if (isset($_POST['apartRent'])) {
            $data = $this->model->getRentApartData();
        }
        
        $this->view->render('search', $data);
    }
}