<?php

class View extends Access
{
    use PrintHelper;

    private $title;
    private $template;
    private $content;
    public $data;
    
    public function __construct($template)
    {
        $this->template = $template;
    }
    
    public function render($view, $data = null)
    {
        $this->data    = $data;
        $this->content = self::getContent($view);
        self::renderLayout();
    }
    
    private function renderHead()
    {
        include(ROOT_DIR . '/templates/' . $this->template . '/meta.php');
        include(ROOT_DIR . '/templates/' . $this->template . '/links.php');
        include(ROOT_DIR . '/templates/' . $this->template . '/css.php');
        include(ROOT_DIR . '/templates/' . $this->template . '/js.php');
    }
    
    private function renderBody()
    {
        include(ROOT_DIR . '/templates/' . $this->template . '/begin.php');
        include(ROOT_DIR . '/templates/' . $this->template . '/header.php');
        echo $this->content;
        include(ROOT_DIR . '/templates/' . $this->template . '/footer.php');
        include(ROOT_DIR . '/templates/' . $this->template . '/end.php');
    }
    
    private function getContent($view)
    {
        ob_start();
        ob_implicit_flush(false);
        include(ROOT_DIR . '/app/views/' . $view . '.php');
        
        return ob_get_clean();
    }
    
    private function renderLayout()
    {
        include(ROOT_DIR . '/templates/layouts/main.php');
    }
    
    private function printFormError($errorsArr)
    {
        foreach ($errorsArr as $error) {
            echo "<br><span style='margin-left: 5px; font-family: Arial sans-serif; font-size: 10pt; color: #942a25'>{$error}</span>";
        }
    }
}