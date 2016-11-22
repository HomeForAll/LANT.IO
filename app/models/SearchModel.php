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

    private function getOptions($searchType)
    {
        if ($_POST['operation'] == 'rent') {
            switch ($_POST['subject']) {
                case 'apartment':
                    if ($searchType == 'simple') {

                    } elseif ($searchType == 'extended') {
                        $minPrice = $_POST['minPrice'];
                        $maxPrice = $_POST['maxPrice'];
                        $bargain = (bool)$_POST['bargain'];
                        $rentType = $_POST['rentType'];

                        $region = $_POST['region'];
                        $city = $_POST['city'];
                        $district = $_POST['district'];
                        $area = $_POST['area'];
                        $address = $_POST['address'];

                        $metroMin = $_POST['metroMin'];
                        $metroMax = $_POST['metroMax'];
                        $roomsNumber = $_POST['roomsNumber'];
                        $spaceMin = $_POST['spaceMin'];
                        $spaceMax = $_POST['spaceMax'];
                        $floorMin = $_POST['floorMin'];
                        $floorMax = $_POST['floorMax'];
                        $equipment = (bool)$_POST['equipment'];
                        $ceilingHeight = $_POST['ceilingHeight'];
                        $houseType = $_POST['houseType'];
                        $houseFloorNumber = $_POST['houseFloorNumber'];
                        $lift = $_POST['lift'];
                        $parking = $_POST['parking'];
                        $chute = $_POST['chute'];
                        $decoration = $_POST['decoration'];
                        $decorationValue = $_POST['decorationValue'];
                        $lavatory = $_POST['lavatory'];
                        $plan = $_POST['plan'];
                        $_3d = $_POST['_3d'];
                        $video = $_POST['video'];
                    }
                    break;
                case 'house':
                    if ($searchType == 'simple') {

                    } elseif ($searchType == 'extended') {

                    }
                    break;
                case 'ground':
                    if ($searchType == 'simple') {

                    } elseif ($searchType == 'extended') {

                    }
                    break;
                case 'room':
                    if ($searchType == 'simple') {

                    } elseif ($searchType == 'extended') {

                    }
                    break;
            }
        } elseif ($_POST['operation'] == 'buy') {
            switch ($_POST['subject']) {
                case 'apartment':
                    if ($searchType == 'simple') {

                    } elseif ($searchType == 'extended') {

                    }
                    break;
                case 'house':
                    if ($searchType == 'simple') {

                    } elseif ($searchType == 'extended') {

                    }
                    break;
                case 'ground':
                    if ($searchType == 'simple') {

                    } elseif ($searchType == 'extended') {

                    }
                    break;
                case 'room':
                    if ($searchType == 'simple') {

                    } elseif ($searchType == 'extended') {

                    }
                    break;
            }
        }
        return false;
    }
}