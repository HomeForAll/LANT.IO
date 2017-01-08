<?php

class SupportController extends Controller
{
    public function actionIndex() {
        $this->view->render('support');
    }

    public function actionTickets() {
        $this->view->render('tickets');
    }

    public function actionNew() {
        if (isset($_POST['submit'])) {
            $this->view->render('new_ticket', $this->model->addTicket());
        } else {
            $this->view->render('new_ticket');
        }
    }
}