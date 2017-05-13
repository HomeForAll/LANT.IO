<?php

class SupportController extends Controller
{
    public function __construct($template)
    {
        parent::__construct($template);
        $this->checkAuth();
        $this->setModel(new SupportModel());
    }

    public function actionTicketsEditor()
    {
        if (!$this->access['admin_tickets']) {
            $this->view->render('no_access');
            return;
        }

        $this->view->render('tickets_editor', $this->model('SupportModel')->get_tickets());
    }

    public function actionIndex()
    {
        $support_button = '';
        if (isset($_GET['article'])) {
            $this->view->render('article', $this->model('SupportModel')->article_id($_GET['article']));
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
                    'statistic' => $this->model('SupportModel')->getStatistic(),
                    'articles' => $this->model('SupportModel')->support_articles($support_button)
                ));
                }
    }

    public function actionTickets()
    {
        $this->view->render('tickets', $this->model('SupportModel')->getTickets());
    }

    public function actionDialog($ticketID)
    {
        if(isset($_POST['submit'])) {
            $this->model('SupportModel')->addMessage($ticketID);
        }

        $this->view->render('ticket_dialog', $this->model('SupportModel')->getDialog($ticketID[0]));
    }

    public function actionClose($ticketID)
    {
        $this->view->render('ticket_close', $this->model('SupportModel')->closeTicket($ticketID[0]));
    }

    public function actionNew()
    {
        if (isset($_POST['submit'])) {
            $this->view->render('new_ticket', $this->model('SupportModel')->addTicket());
        } else {
            $this->view->render('new_ticket');
        }
    }


}