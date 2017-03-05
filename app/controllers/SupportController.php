<?php

class SupportController extends Controller
{
    public function __construct($template, $model)
    {
        parent::__construct($template, $model);
        $this->checkAuth();
    }

    public function actionTicketsEditor()
    {
        $this->view->render('tickets_editor', $this->model->get_tickets());
    }

    public function actionIndex()
    {
        $support_button = '';
        if (isset($_GET['article'])) {
            $this->view->render('article', $this->model->article_id($_GET['article']));
        }
        else {
            if (isset($_POST['account'])) {
                $support_button = 'account';
            }
            if (isset($_POST['pay'])) {
                $support_button = 'pay';
            }
            if (isset($_POST['tech_help'])) {
                $support_button = 'tech_help';
            }
            if (isset($_POST['other'])) {
                $support_button = 'other';
            }
                $this->view->render('support', array(
                    'statistic' => $this->model->getStatistic(),
                    'articles' => $this->model->support_articles($support_button)
                ));
                }
    }

    public function actionTickets()
    {
        $this->view->render('tickets', $this->model->getTickets());
    }

    public function actionDialog($ticketID)
    {
        if(isset($_POST['submit'])) {
            $this->model->addMessage($ticketID);
        }

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