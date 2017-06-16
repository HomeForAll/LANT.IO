<?php

class DataBase extends PDO
{
    private $config;
    private $columns;
    private $from;
    private $where = array();

    public function __construct()
    {
        $redis = Registry::get('redis');
        $this->config = unserialize($redis->get('config'));
        parent::__construct('pgsql:host=' . $this->config['db_host'] . ';port=5432;dbname=' . $this->config['db'], $this->config['db_username'], $this->config['db_password']);

    }

    /**
     * Записываем столбцы которые будут выбраны из таблицы указанной в $this->from
     *
     * @param $columns
     * @return $this
     */
    public function select($columns)
    {
        $this->columns = $columns;
        return $this;
    }

    /**
     * Записываем таблицу с которой будем работать.
     *
     * @param $from
     * @return $this
     */
    public function from($from)
    {
        $this->from = $from;
        return $this;
    }

    /**
     * Добавляет фильтр выборки из указанной в $this->from таблицы.
     * Пример использования: PDO->select(*)->from('table')->where('id', '=', '25');
     *
     * @param $column
     * @param $operator
     * @param $value
     * @return $this
     */
    public function where($column, $operator, $value)
    {
        $this->where[] = array(
            'column' => $column,
            'operator' => $operator,
            'value' => $value
        );

        return $this;
    }

    /**
     * Очищает данные запроса
     */
    private function clear()
    {
        $this->columns = '';
        $this->from = '';
        $this->where = array();
    }

    /**
     * Собирает запрос, очищает от спецсимволов и выполняет его
     */
    public function execute()
    {
        // Формируем строку запроса
        $query = 'SELECT ' . $this->columns . ' FROM ' . $this->from;

        if (!empty($this->where)) {
            // Проходим цилом по значенияем where, экранируем спецсимволы и дополняем запрос
            foreach ($this->where as $key => $where) {
                $escaped = pg_escape_string($where['value']);
                $this->where[$key] = $escaped;

                // Если это первый ключ массива добавляем WHERE вначале, вместо AND
                if ($key == 0) {
                    $query .= ' WHERE ' . $where['column'] . ' ' . $where['operator'] . ' \'' . $where['value']. '\'';
                } else {
                    $query .= ' AND ' . $where['column'] . ' ' . $where['operator'] . ' \'' . $where['value']. '\'';
                }
            }
        }


        $result = $this->query($query)->fetchAll();

        return $result;
    }
}
