<?php

class DataBase extends PDO
{
    private $settings;
    private $queryOptions = '';
    
    public function __construct()
    {
        $this->settings = require __DIR__ . '/../config/settings.php';
        parent::__construct('pgsql:host=' . $this->settings['db_host'] . ';port=5432;dbname=' . $this->settings['db'], $this->settings['db_username'], $this->settings['db_password'], array(
            PDO::ATTR_PERSISTENT => true,
        ));
    }
    
    /***
     * Дополнительные параметры необходимо добавлять с помощью
     * соответсвующих методов $this->addColumnForSelect() и $this->addLikeForSelect()
     *
     * @param $table
     * @param string|array $selection Какие столбцы выбирать
     *
     * @return array Возвращает выбранный из базы результат в виде массива
     */
    public function select($table, $selection)
    {
        $selection = (is_array($selection)) ? implode(',', $selection) : $selection;
        
        $query = "SELECT {$selection} FROM {$table}";
        
        if ($this->queryOptions) {
            $query .= $this->queryOptions;
        }
        
        $select = $this->prepare($query);
        $select->execute();
        
        return $select->fetchAll();
    }
    
    public function addColumnForSelect($column, $value)
    {
        if ($this->queryOptions) {
            $this->queryOptions .= "AND {$column} = '{$value}' ";
        } else {
            $this->queryOptions .= " WHERE {$column} = '{$value}' ";
        }
    }
    
    public function addLikeForSelect($column, $value)
    {
        if ($this->queryOptions) {
            $this->queryOptions .= "AND {$column} LIKE '{$value}' ";
        } else {
            $this->queryOptions .= " WHERE {$column} LIKE '{$value}' ";
        }
    }
    
    public function clearOptions()
    {
        $this->queryOptions = '';
    }
}