<?php

class SupportController extends Controller
{
    public function __construct($template, $model)
    {
        parent::__construct($template, $model);
        $this->checkAuth();
    }

    public function actionIndex()
    {
        $this->view->render('support', $this->model->getStatistic());
    }

    public function actionTickets()
    {
        $this->view->render('tickets', $this->model->getTickets());
    }

    public function actionDialog($ticketID)
    {
        $this->view->render('ticket_dialog', $this->model->getDialog($ticketID[0]));
    }

    public function actionClose($ticketID)
    {
        $this->view->render('ticket_close', $this->model->closeTicket($ticketID[0]));
    }

    public function actionNew()
    {
        if (isset($_POST['submit'])) {
            $this->view->render('new_ticket', $this->model->addTicket());
        } else {
            $this->view->render('new_ticket');
        }
    }
}