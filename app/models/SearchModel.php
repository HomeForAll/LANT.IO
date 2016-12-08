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
    
    public function getFiltersData()
    {
        $this->generateVars();
    }
    
    //    private function generateVars()
    //    {
    //        $result = array();
    //
    //        foreach ($_POST as $name => $value) {
    //            $arr = explode('-', $name);
    //
    //            if (count($arr) > 1) {
    //                array_push($result[$arr[0]], array(
    //                    $arr[1] => $value
    //                ));
    //            } else {
    //                array_push($result[$arr[0]], $value ? $value : '');
    //            }
    //
    //            array(
    //                'price' => array(
    //                    'min' => 123,
    //                    'max' => 321,
    //                ),
    //                'bargain' => array(
    //                    1,
    //                ),
    //            );
    //        }
    //        $this->printData($result);
    //    }
    
    public function getRentApartData()
    {
        $client = new SphinxClient();
        $client->SetServer('localhost', 9312);
        $client->SetLimits(0, 10); // Смещение и количество записей, полезно для организации страниц
        //$client->SetMatchMode(SPH_MATCH_EXTENDED2);
        
        $subject          = isset($_POST['subject']) ? ($_POST['subject'] ? $_POST['subject'] : '') : '';
        $operation        = isset($_POST['operation']) ? ($_POST['operation'] ? $_POST['operation'] : '') : '';
        $minPrice         = isset($_POST['minPrice']) ? ($_POST['minPrice'] ? $_POST['minPrice'] : '') : '';
        $maxPrice         = isset($_POST['maxPrice']) ? ($_POST['maxPrice'] ? $_POST['maxPrice'] : '') : '';
        $bargain          = isset($_POST['bargain']) ? ($_POST['bargain'] ? $_POST['bargain'] : '') : '';
        $rentType         = isset($_POST['rentType']) ? ($_POST['rentType'] ? $_POST['rentType'] : '') : '';
        $country          = isset($_POST['country']) ? ($_POST['country'] ? $_POST['country'] : '') : '';
        $area             = isset($_POST['area']) ? ($_POST['area'] ? $_POST['area'] : '') : '';
        $city             = isset($_POST['city']) ? ($_POST['city'] ? $_POST['city'] : '') : '';
        $region           = isset($_POST['region']) ? ($_POST['region'] ? $_POST['region'] : '') : '';
        $street           = isset($_POST['street']) ? ($_POST['street'] ? $_POST['street'] : '') : '';
        $metroMin         = isset($_POST['metroMin']) ? ($_POST['metroMin'] ? $_POST['metroMin'] : '') : '';
        $metroMax         = isset($_POST['metroMax']) ? ($_POST['metroMax'] ? $_POST['metroMax'] : '') : '';
        $roomsNumber      = isset($_POST['roomsNumber']) ? ($_POST['roomsNumber'] ? $_POST['roomsNumber'] : '') : '';
        $spaceMin         = isset($_POST['spaceMin']) ? ($_POST['spaceMin'] ? $_POST['spaceMin'] : '') : '';
        $spaceMax         = isset($_POST['spaceMax']) ? ($_POST['spaceMax'] ? $_POST['spaceMax'] : '') : '';
        $floorMin         = isset($_POST['floorMin']) ? ($_POST['floorMin'] ? $_POST['floorMin'] : '') : '';
        $floorMax         = isset($_POST['floorMax']) ? ($_POST['floorMax'] ? $_POST['floorMax'] : '') : '';
        $equipment        = isset($_POST['equipment']) ? ($_POST['equipment'] ? $_POST['equipment'] : '') : '';
        $ceilingHeight    = isset($_POST['ceilingHeight']) ? ($_POST['ceilingHeight'] ? $_POST['ceilingHeight'] : '') : '';
        $houseType        = isset($_POST['houseType']) ? ($_POST['houseType'] ? $_POST['houseType'] : '') : '';
        $houseFloorNumber = isset($_POST['houseFloorNumber']) ? ($_POST['houseFloorNumber'] ? $_POST['houseFloorNumber'] : '') : '';
        $lift             = isset($_POST['lift']) ? ($_POST['lift'] ? $_POST['lift'] : '') : '';
        $parking          = isset($_POST['parking']) ? ($_POST['parking'] ? $_POST['parking'] : '') : '';
        $concierge        = isset($_POST['concierge']) ? ($_POST['concierge'] ? $_POST['concierge'] : '') : '';
        $security         = isset($_POST['security']) ? ($_POST['security'] ? $_POST['security'] : '') : '';
        $intercom         = isset($_POST['intercom']) ? ($_POST['intercom'] ? $_POST['intercom'] : '') : '';
        $CCTV             = isset($_POST['CCTV']) ? ($_POST['CCTV'] ? $_POST['CCTV'] : '') : '';
        $chute            = isset($_POST['chute']) ? ($_POST['chute'] ? $_POST['chute'] : '') : '';
        $bedroom          = isset($_POST['bedroom']) ? ($_POST['bedroom'] ? $_POST['bedroom'] : '') : '';
        $kitchen          = isset($_POST['kitchen']) ? ($_POST['kitchen'] ? $_POST['kitchen'] : '') : '';
        $livingRoom       = isset($_POST['livingRoom']) ? ($_POST['livingRoom'] ? $_POST['livingRoom'] : '') : '';
        $hallway          = isset($_POST['hallway']) ? ($_POST['hallway'] ? $_POST['hallway'] : '') : '';
        $nursery          = isset($_POST['nursery']) ? ($_POST['nursery'] ? $_POST['nursery'] : '') : '';
        $study            = isset($_POST['study']) ? ($_POST['study'] ? $_POST['study'] : '') : '';
        $canteen          = isset($_POST['canteen']) ? ($_POST['canteen'] ? $_POST['canteen'] : '') : '';
        $bathroom         = isset($_POST['bathroom']) ? ($_POST['bathroom'] ? $_POST['bathroom'] : '') : '';
        $decoration       = isset($_POST['decoration']) ? ($_POST['decoration'] ? $_POST['decoration'] : '') : '';
        $decorationValue  = isset($_POST['decorationValue']) ? ($_POST['decorationValue'] ? $_POST['decorationValue'] : '') : '';
        $lavatory         = isset($_POST['lavatory']) ? ($_POST['lavatory'] ? $_POST['lavatory'] : '') : '';
        $balcony          = isset($_POST['balcony']) ? ($_POST['balcony'] ? $_POST['balcony'] : '') : '';
        $heating          = isset($_POST['heating']) ? ($_POST['heating'] ? $_POST['heating'] : '') : '';
        $gas              = isset($_POST['gas']) ? ($_POST['gas'] ? $_POST['gas'] : '') : '';
        $electricity      = isset($_POST['electricity']) ? ($_POST['electricity'] ? $_POST['electricity'] : '') : '';
        $water            = isset($_POST['water']) ? ($_POST['water'] ? $_POST['water'] : '') : '';
        $TV               = isset($_POST['TV']) ? ($_POST['TV'] ? $_POST['TV'] : '') : '';
        $musicCenter      = isset($_POST['musicCenter']) ? ($_POST['musicCenter'] ? $_POST['musicCenter'] : '') : '';
        $conditioner      = isset($_POST['conditioner']) ? ($_POST['conditioner'] ? $_POST['conditioner'] : '') : '';
        $fridge           = isset($_POST['fridge']) ? ($_POST['fridge'] ? $_POST['fridge'] : '') : '';
        $plate            = isset($_POST['plate']) ? ($_POST['plate'] ? $_POST['plate'] : '') : '';
        $bake             = isset($_POST['bake']) ? ($_POST['bake'] ? $_POST['bake'] : '') : '';
        $microwave        = isset($_POST['microwave']) ? ($_POST['microwave'] ? $_POST['microwave'] : '') : '';
        $dishwasher       = isset($_POST['dishwasher']) ? ($_POST['dishwasher'] ? $_POST['dishwasher'] : '') : '';
        $table            = isset($_POST['table']) ? ($_POST['table'] ? $_POST['table'] : '') : '';
        $bed              = isset($_POST['bed']) ? ($_POST['bed'] ? $_POST['bed'] : '') : '';
        $cupboard         = isset($_POST['cupboard']) ? ($_POST['cupboard'] ? $_POST['cupboard'] : '') : '';
        $stand            = isset($_POST['stand']) ? ($_POST['stand'] ? $_POST['stand'] : '') : '';
        $mirror           = isset($_POST['mirror']) ? ($_POST['mirror'] ? $_POST['mirror'] : '') : '';
        $armchair         = isset($_POST['armchair']) ? ($_POST['armchair'] ? $_POST['armchair'] : '') : '';
        $sofa             = isset($_POST['sofa']) ? ($_POST['sofa'] ? $_POST['sofa'] : '') : '';
        $plan             = isset($_POST['plan']) ? ($_POST['plan'] ? $_POST['plan'] : '') : '';
        $_3d              = isset($_POST['3d']) ? ($_POST['3d'] ? $_POST['3d'] : '') : '';
        $video            = isset($_POST['video']) ? ($_POST['video'] ? $_POST['video'] : '') : '';
        $photo            = isset($_POST['foto']) ? ($_POST['foto'] ? $_POST['foto'] : '') : '';
        
        // Устанавливаем фильтры поиска в соответствии с параметрами
        if ($minPrice && $maxPrice) {
            $client->SetFilterRange('price', $minPrice, $maxPrice);
        } elseif ($minPrice) {
            $client->SetFilterRange('price', $minPrice, 9223372036854775807);
        } elseif ($maxPrice) {
            $client->SetFilterRange('price', 0, $maxPrice);
        }
        
        if ($bargain) {
            $client->SetFilter('bargain', array(1));
        }
        
        if ($rentType) {
            $client->SetFilter('rent_type', array($rentType));
        }
        
        if ($metroMin && $metroMax) {
            $client->SetFilterRange('metro', $metroMin, $metroMax);
        } elseif ($metroMin) {
            $client->SetFilterRange('metro', $metroMin, 9223372036854775807);
        } elseif ($metroMax) {
            $client->SetFilterRange('metro', 0, $metroMax);
        }
        
        if ($roomsNumber) {
            if ($roomsNumber < 4) {
                $client->SetFilter('rooms', array($roomsNumber));
            } else {
                $client->SetFilterRange('rooms', $roomsNumber, 9223372036854775807);
            }
        }
        
        if ($spaceMin && $spaceMax) {
            $client->SetFilterRange('space', $spaceMin, $spaceMax);
        } elseif ($spaceMin) {
            $client->SetFilterRange('space', $spaceMin, 9223372036854775807);
        } elseif ($spaceMax) {
            $client->SetFilterRange('space', 0, $spaceMax);
        }
        
        if ($floorMin && $floorMax) {
            $client->SetFilterRange('floor', $floorMin, $floorMax);
        } elseif ($floorMin) {
            $client->SetFilterRange('floor', $floorMin, 9223372036854775807);
        } elseif ($spaceMax) {
            $client->SetFilterRange('floor', 0, $floorMax);
        }
        
        if ($equipment) {
            $client->SetFilter('equipment', array($equipment));
        }
        
        if ($houseType) {
            $client->SetFilter('house_type', array($houseType));
        }
        
        if ($houseFloorNumber) {
            $client->SetFilter('house_floor_number', array($houseFloorNumber));
        }
        
        if ($lift) {
            $client->SetFilter('lift', array($lift));
        }
        
        if ($parking) {
            $client->SetFilter('parking', array($parking));
        }
        
        if ($concierge) {
            $client->SetFilter('concierge', array($concierge));
        }
        
        if ($security) {
            $client->SetFilter('security', array($security));
        }
        
        if ($intercom) {
            $client->SetFilter('intercom', array($intercom));
        }
        
        if ($CCTV) {
            $client->SetFilter('CCTV', array($CCTV));
        }
        
        if ($chute) {
            $client->SetFilter('chute', array($chute));
        }
        
        if ($bedroom) {
            $client->SetFilter('bedroom', array($bedroom));
        }
        
        if ($kitchen) {
            $client->SetFilter('kitchen', array($kitchen));
        }
        
        if ($livingRoom) {
            $client->SetFilter('living_room', array($livingRoom));
        }
        
        if ($hallway) {
            $client->SetFilter('hallway', array($hallway));
        }
        
        if ($nursery) {
            $client->SetFilter('nursery', array($nursery));
        }
        
        if ($study) {
            $client->SetFilter('study', array($study));
        }
        
        if ($canteen) {
            $client->SetFilter('canteen', array($canteen));
        }
        
        if ($bathroom) {
            $client->SetFilter('bathroom', array($bathroom));
        }
        
        if ($decoration) {
            $client->SetFilter('decoration', array($decorationValue));
        }
        
        if ($lavatory) {
            $client->SetFilter('lavatory', array($lavatory));
        }
        
        if ($balcony) {
            $client->SetFilter('balcony', array($balcony));
        }
        
        if ($heating) {
            $client->SetFilter('heating', array($heating));
        }
        
        if ($gas) {
            $client->SetFilter('gas', array($gas));
        }
        
        if ($electricity) {
            $client->SetFilter('electricity', array($electricity));
        }
        
        if ($water) {
            $client->SetFilter('water', array($water));
        }
        
        if ($TV) {
            $client->SetFilter('TV', array($TV));
        }
        
        if ($musicCenter) {
            $client->SetFilter('musicCenter', array($musicCenter));
        }
        
        if ($conditioner) {
            $client->SetFilter('conditioner', array($conditioner));
        }
        
        if ($fridge) {
            $client->SetFilter('fridge', array($fridge));
        }
        
        if ($plate) {
            $client->SetFilter('plate', array($plate));
        }
        
        if ($bake) {
            $client->SetFilter('bake', array($bake));
        }
        
        if ($microwave) {
            $client->SetFilter('microwave', array($microwave));
        }
        
        if ($dishwasher) {
            $client->SetFilter('dishwasher', array($dishwasher));
        }
        
        if ($table) {
            $client->SetFilter('table', array($table));
        }
        
        if ($bed) {
            $client->SetFilter('bed', array($bed));
        }
        
        if ($cupboard) {
            $client->SetFilter('cupboard', array($cupboard));
        }
        
        if ($stand) {
            $client->SetFilter('stand', array($stand));
        }
        
        if ($mirror) {
            $client->SetFilter('mirror', array($mirror));
        }
        
        if ($armchair) {
            $client->SetFilter('armchair', array($armchair));
        }
        
        if ($sofa) {
            $client->SetFilter('sofa', array($sofa));
        }
        
        if ($plan) {
            $client->SetFilter('plan', array($plan));
        }
        
        if ($_3d) {
            $client->SetFilter('_3d', array($_3d));
        }
        
        if ($video) {
            $client->SetFilter('video', array($video));
        }
        
        if ($photo) {
            $client->SetFilter('photo', array($photo));
        }
        
        $sphinxResults = $client->Query("{$country}, {$area}, {$region}, {$city}, {$street}", "{$subject}{$operation}");
        
        if ($sphinxResults) {
            $IDs = self::getIDsBySphinxResult($sphinxResults);
            
            $stmt = $this->db->prepare("SELECT * FROM mock_data WHERE id IN ({$IDs})");
            $stmt->execute();
            
            $result = $stmt->fetchAll();
            
            echo '<pre>';
            print_r($result);
            echo '</pre>';
            
            return $result;
        }
        
        return false;
    }
    
    //    public function getData($searchType)
    //    {
    //        echo '<pre>';
    //        print_r($_POST);
    //        echo '</pre>';
    //
    //
    ////        if ($_POST['rooms'] == 'more') {
    ////            $stmt = $this->db->prepare("SELECT * FROM apartments WHERE price >= :minPrice AND price <= :maxPrice AND bargain = :bargain AND rooms > 3 AND area >= :minArea AND area <= :maxArea AND equipment <= :equipment");
    ////        } else {
    ////            $stmt = $this->db->prepare("SELECT * FROM apartments WHERE price >= :minPrice AND price <= :maxPrice AND bargain = :bargain AND rooms = :rooms AND area >= :minArea AND area <= :maxArea AND equipment <= :equipment");
    ////            $stmt->bindParam(':rooms', $rooms);
    ////        }
    ////
    ////        $stmt->bindParam(':minPrice', $minPrice);
    ////        $stmt->bindParam(':maxPrice', $maxPrice);
    ////        $stmt->bindParam(':bargain', $bargain);
    ////        $stmt->bindParam(':minArea', $minArea);
    ////        $stmt->bindParam(':maxArea', $maxArea);
    ////        $stmt->bindParam(':equipment', $equipment);
    ////
    ////        $stmt->execute();
    ////
    ////        $result = $stmt->fetchAll();
    //    }
    //
    //    private function getOptions($searchType)
    //    {
    //        if ($_POST['operation'] == 'rent') {
    //            switch ($_POST['subject']) {
    //                case 'apartment':
    //                    if ($searchType == 'simple') {
    //
    //                    } elseif ($searchType == 'extended') {
    //                        $minPrice = $_POST['minPrice'];
    //                        $maxPrice = $_POST['maxPrice'];
    //                        $bargain = (bool)$_POST['bargain'];
    //                        $rentType = $_POST['rentType'];
    //
    //                        $region = $_POST['region'];
    //                        $city = $_POST['city'];
    //                        $district = $_POST['district'];
    //                        $area = $_POST['area'];
    //                        $address = $_POST['address'];
    //
    //                        $metroMin = $_POST['metroMin'];
    //                        $metroMax = $_POST['metroMax'];
    //                        $roomsNumber = $_POST['roomsNumber'];
    //                        $spaceMin = $_POST['spaceMin'];
    //                        $spaceMax = $_POST['spaceMax'];
    //                        $floorMin = $_POST['floorMin'];
    //                        $floorMax = $_POST['floorMax'];
    //                        $equipment = (bool)$_POST['equipment'];
    //                        $ceilingHeight = $_POST['ceilingHeight'];
    //                        $houseType = $_POST['houseType'];
    //                        $houseFloorNumber = $_POST['houseFloorNumber'];
    //                        $lift = $_POST['lift'];
    //                        $parking = $_POST['parking'];
    //                        $chute = $_POST['chute'];
    //                        $decoration = $_POST['decoration'];
    //                        $decorationValue = $_POST['decorationValue'];
    //                        $lavatory = $_POST['lavatory'];
    //                        $plan = $_POST['plan'];
    //                        $_3d = $_POST['_3d'];
    //                        $video = $_POST['video'];
    //                    }
    //                    break;
    //                case 'house':
    //                    if ($searchType == 'simple') {
    //
    //                    } elseif ($searchType == 'extended') {
    //
    //                    }
    //                    break;
    //                case 'ground':
    //                    if ($searchType == 'simple') {
    //
    //                    } elseif ($searchType == 'extended') {
    //
    //                    }
    //                    break;
    //                case 'room':
    //                    if ($searchType == 'simple') {
    //
    //                    } elseif ($searchType == 'extended') {
    //
    //                    }
    //                    break;
    //            }
    //        } elseif ($_POST['operation'] == 'buy') {
    //            switch ($_POST['subject']) {
    //                case 'apartment':
    //                    if ($searchType == 'simple') {
    //
    //                    } elseif ($searchType == 'extended') {
    //
    //                    }
    //                    break;
    //                case 'house':
    //                    if ($searchType == 'simple') {
    //
    //                    } elseif ($searchType == 'extended') {
    //
    //                    }
    //                    break;
    //                case 'ground':
    //                    if ($searchType == 'simple') {
    //
    //                    } elseif ($searchType == 'extended') {
    //
    //                    }
    //                    break;
    //                case 'room':
    //                    if ($searchType == 'simple') {
    //
    //                    } elseif ($searchType == 'extended') {
    //
    //                    }
    //                    break;
    //            }
    //        }
    //        return false;
    //    }
    
    private function getIDsBySphinxResult($arr)
    {
        $IDs = array();
        if (!empty($arr["matches"])) { // если есть результаты поиска - обрабатываем их
            foreach ($arr["matches"] as $id => $data) {
                $IDs[] = $id;
            }
        }
        
        return implode(',', $IDs);
    }
}