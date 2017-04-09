<?php

class SearchController extends Controller
{
    public function actionIndex()
    {
        $data = array();

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

//        foreach ($_POST as $key => $value) {
//            if (!preg_match('~(-min)~', $key) && !preg_match('~(-min)~', $key) && !preg_match('~(on)~i', $value)) {
//                echo '$' . $key . ' = isset($_POST[\'' . $key . '\']) ? $_POST[\'' . $key . '\'] : \'\'; <br>';
//
//                echo 'if ($' . $key . ' || $' . $key . ' !== \'\') {<br>';
//                  echo '  $query->where(\'' . $key . '\', \'=\', $' . $key . ');<br>';
//                echo '}<br><br>';
//            }
//        }

        $this->view->render('search', $data);
    }

    public function actionGenSearchForm()
    {
        $forms = array();

        if (isset($_POST['submit'])) {
            $forms = $this->model->getFormData($_POST['space_type'], $_POST['operation_type'], $_POST['object_type']);
        }

        $this->view->render('gen_search_form', array(
            'forms' => $forms,
            'types' => $this->model->getFormTypes(),
            'categories' => $this->model->getFormCategories(),
            'subcategories' => $this->model->getFormSubcategories(),
            'elements' => $this->model->getFormElements(),
            'lists' => $this->model->getFormSelectOptions(),
        ));
    }
}