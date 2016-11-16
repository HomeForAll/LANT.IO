<?php

class SearchModel extends Model
{

    public function __construct()
    {
        $this->db = new DataBase();
    }

    public function ajaxHandler()
    {
        // TODO: Implement ajaxHandler() method.
    }

    public function getData()
    {
        $minPrice = (!empty($_POST['minPrice'])) ? (integer)$_POST['minPrice'] : 0;
        $maxPrice = (!empty($_POST['maxPrice'])) ? (integer)$_POST['maxPrice'] : 100000000;
        $bargain = (!empty($_POST['bargain'])) ? 1 : 0;
        $rooms = ($_POST['rooms'] == 'more') ? 1 : $_POST['rooms'];
        $minArea = (!empty($_POST['minPrice'])) ? (integer)$_POST['minPrice'] : 0;
        $maxArea = (!empty($_POST['maxPrice'])) ? (integer)$_POST['maxPrice'] : 100000000;
        $equipment = (bool)$_POST['equipment'];

        if ($_POST['rooms'] == 'more') {
            $stmt = $this->db->prepare("SELECT * FROM apartments WHERE price >= :minPrice AND price <= :maxPrice AND bargain = :bargain AND rooms > 3 AND area >= :minArea AND area <= :maxArea AND equipment <= :equipment");
        } else {
            $stmt = $this->db->prepare("SELECT * FROM apartments WHERE price >= :minPrice AND price <= :maxPrice AND bargain = :bargain AND rooms = :rooms AND area >= :minArea AND area <= :maxArea AND equipment <= :equipment");
            $stmt->bindParam(':rooms', $rooms);
        }

        $stmt->bindParam(':minPrice', $minPrice);
        $stmt->bindParam(':maxPrice', $maxPrice);
        $stmt->bindParam(':bargain', $bargain);
        $stmt->bindParam(':minArea', $minArea);
        $stmt->bindParam(':maxArea', $maxArea);
        $stmt->bindParam(':equipment', $equipment);

        $stmt->execute();

        $result = $stmt->fetchAll();

        echo '<pre>';
        print_r($result);
        echo '</pre>';
    }
}