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

    public function getData($searchType)
    {
        echo '<pre>';
        print_r($_POST);
        echo '</pre>';
        if ($searchType == 'simple') {
            if ($_POST['subject'] == 'apartment') {
                $minPrice = (!empty($_POST['minPrice'])) ? (integer)$_POST['minPrice'] : 0;
                $maxPrice = (!empty($_POST['maxPrice'])) ? (integer)$_POST['maxPrice'] : 100000000;
                $bargain = (!empty($_POST['bargain'])) ? 1 : 0;
                $rooms = ($_POST['rooms'] == 'more') ? 1 : $_POST['rooms'];
                $minArea = (!empty($_POST['minPrice'])) ? (integer)$_POST['minPrice'] : 0;
                $maxArea = (!empty($_POST['maxPrice'])) ? (integer)$_POST['maxPrice'] : 100000000;
                $equipment = (bool)$_POST['equipment'];

            } elseif ($_POST['subject'] == 'house') {

            } elseif ($_POST['subject'] == 'ground') {

            } elseif ($_POST['subject'] == 'room') {

            } else {

            }
        } elseif ($searchType == 'extended') {
            if ($_POST['subject'] == 'apartment') {
                $minPrice = 0;
                $maxPrice = 0;
                $bargain = 0;
                $rentType = 0;
                $region = 0;
                $city = 0;
                $district = 0;
                $area = 0;
                $address = 0;
                $metroMin = 0;
                $metroMax = 0;
                $roomsNumber = 0;
                $spaceMin = 0;
                $spaceMax = 0;
                $floorMin = 0;
                $floorMax = 0;
                $equipment = 0;
                $ceilingHeight = 0;
                $houseType = 0;
                $houseFloorNumber = 0;
                $lift = 0;
                $parking = 0;
                $chute = 0;
                $decoration = 0;
                $decorationValue = 0;
                $lavatory = 0;
                $plan = 0;
                $_3d = 0;
                $video = 0;

            } elseif ($_POST['subject'] == 'house') {

            } elseif ($_POST['subject'] == 'ground') {

            } elseif ($_POST['subject'] == 'room') {

            } else {

            }
        }

//        if ($_POST['rooms'] == 'more') {
//            $stmt = $this->db->prepare("SELECT * FROM apartments WHERE price >= :minPrice AND price <= :maxPrice AND bargain = :bargain AND rooms > 3 AND area >= :minArea AND area <= :maxArea AND equipment <= :equipment");
//        } else {
//            $stmt = $this->db->prepare("SELECT * FROM apartments WHERE price >= :minPrice AND price <= :maxPrice AND bargain = :bargain AND rooms = :rooms AND area >= :minArea AND area <= :maxArea AND equipment <= :equipment");
//            $stmt->bindParam(':rooms', $rooms);
//        }
//
//        $stmt->bindParam(':minPrice', $minPrice);
//        $stmt->bindParam(':maxPrice', $maxPrice);
//        $stmt->bindParam(':bargain', $bargain);
//        $stmt->bindParam(':minArea', $minArea);
//        $stmt->bindParam(':maxArea', $maxArea);
//        $stmt->bindParam(':equipment', $equipment);
//
//        $stmt->execute();
//
//        $result = $stmt->fetchAll();
    }
}