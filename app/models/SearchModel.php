<?php

class SearchModel extends Model {
    public function __construct() {
        $this->db = new DataBase();
    }

    public function ajaxHandler() {
        switch ($_POST['type']) {
            case 'getRegions':
                $stmt = $this->db->prepare("SELECT * FROM regions");
                $stmt->execute();
                $result = $stmt->fetchAll();
                print_r(json_encode($result, JSON_UNESCAPED_UNICODE));
                break;
            case 'getCities':
                $stmt = $this->db->prepare("SELECT * FROM cities WHERE region_id = :region_id");

                //$start = microtime(true);

                $stmt->execute(array(':region_id' => $_POST['region_id']));
                $result = $stmt->fetchAll();
                print_r(json_encode($result, JSON_UNESCAPED_UNICODE));

                //echo "Время выполнения скрипта: ".(microtime(true) - $start);

                break;
        }
    }
}