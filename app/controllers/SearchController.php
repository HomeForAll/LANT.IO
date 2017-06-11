<?php

class SearchController extends Controller
{
    public function __construct($layout)
    {
        parent::__construct($layout);
        $this->setModel(new SearchModel());
    }

    public function actionIndex()
    {

//        foreach ($_SESSION['forms'] as $name => $value) {
//            echo "$" . "{$name} = isset(\$_POST['{$name}']) ? \$_POST['{$name}'] : '';<br>";
//        }

//        foreach ($_POST as $name => $value) {
//            $_SESSION['forms'][$name] = '';
//        }

//        $this->printData('POST:');
//        $this->printData($_POST);
//        $this->printData("\n\n");
//        $this->printData('SESSION:');
//        $this->printData($_SESSION);
//        $this->printData('Общее количество параметров: ' . count($_SESSION['forms']));

        //$data['formData'] = $this->model->getRentApartData();

//        if (isset($_POST['apartRent'])) {
//            $data['objects'] = $this->model->getRentApartData();
//        }

        //var_dump($_POST);

        function str_search($path, $extension, $str)
        {
            $file_arr = array();
            foreach (glob(rtrim($path, '/') . "/*." . $extension) as $filename) {
                if (strstr(file_get_contents($filename), $str) != false)
                    $file_arr[] = $filename;
            }

            return $file_arr ? true : false;
        }

        //str_search('my_dir', 'файл.txt', 'строка поиска');

//        foreach ($_POST as $key => $value) {
//            if (preg_match('~(on)~i', $value)
//                && !str_search(ROOT_DIR . '/app/models', 'SearchModel.php', $key)
//            ) {
//
//                echo '$' . $key . ' = isset($_POST[\'' . $key . '\']) ? $_POST[\'' . $key . '\'] : \'\'; <br>';
//
//                echo 'if ($' . $key . ' || $' . $key . ' !== \'\') {<br>';
//                echo '$query->where(\'' . $key . '\', \'=\', 1);<br>';
//                echo '};<br><br>';
//            }
//        }

//        foreach ($_POST as $key => $value) {
//            if (preg_match('~(-max)~', $key)) {
//                continue;
//            }
//
//            if (preg_match('~(-min)~', $key)
//                && !str_search(ROOT_DIR . '/app/models', 'SearchModel.php', $key)
//            ) {
//                $key = explode('-', $key)[0];
//
//                echo '$' . $key . '_min = isset($_POST[\'' . $key . '\']) ? $_POST[\'' . $key . '\'] : \'\'; <br>';
//                echo '$' . $key . '_max = isset($_POST[\'' . $key . '\']) ? $_POST[\'' . $key . '\'] : \'\'; <br>';
//
//                echo 'if ($' . $key . '_min && $' . $key . '_max) {<br>';
//                echo ' $query->where(\'' . $key . '\', \'between\', array((int)$' . $key . '_min, (int)$' . $key . '_max));<br>';
//                echo '} elseif ($' . $key . '_min) {<br>';
//                echo '$query->where(\'' . $key . '\', \'>=\', (int)$' . $key . '_min);<br>';
//                echo '} elseif ($' . $key . '_max) {<br>';
//                echo '$query->where(\'' . $key . '\', \'<=\', (int)$' . $key . '_max);<br>';
//                echo '}<br><br>';
//            }
//        }

//        foreach ($_POST as $key => $value) {
//            if (!preg_match('~(-min)~', $key)
//                && !preg_match('~(-max)~', $key)
//                && !preg_match('~(on)~i', $value)
//                && !str_search(ROOT_DIR . '/app/models', 'SearchModel.php', $key)) {
//
//                echo '$' . $key . ' = isset($_POST[\'' . $key . '\']) ? $_POST[\'' . $key . '\'] : \'\'; <br>';
//                echo 'if ($' . $key . ' || $' . $key . ' !== \'\') {<br>';
//                echo '  $query->where(\'' . $key . '\', \'=\', $' . $key . ');<br>';
//                echo '}<br><br>';
//            }
//        }
        $data = array();
        $data['formData'] = $this->model('SearchModel')->getRentApartData();

        $this->ifAJAX(function() {
//            foreach ($_POST as &$value) {
//                if (preg_match('~(Пустая форма Option)~i', $value)) {
//                    $value = '';
//                }
//            }

            $data = $this->model('SearchModel')->getRentApartData();
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
        });

        $this->view->render('search', $data);
    }
    
    public function actionTest() {
        if (!empty($_GET)) {
            $this->model('SearchModel')->fetchAds($_GET);
        }
    }
}