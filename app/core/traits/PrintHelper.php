<?php
trait PrintHelper {
    /**
     * Выводит данные с помощью print_r, в окружении html тега <pre></pre>
     *
     * @param $data
     */
    protected function printInPre($data)
    {
        echo '<pre>';
        print_r($data);
        echo '</pre>';
    }
}