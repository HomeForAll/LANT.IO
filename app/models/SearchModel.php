<?php
use Foolz\SphinxQL\Connection;
use Foolz\SphinxQL\SphinxQL;

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
        $conn = new Connection();
        $conn->setParams(array(
            'host' => 'localhost',
            'port' => 9306,
        ));
        
        $query = SphinxQL::create($conn)->select('*')->from('news');
        
        // $query->where('first_name', '=', 'Robin');
        
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
        $photo            = isset($_POST['photo']) ? ($_POST['photo'] ? $_POST['photo'] : '') : '';
        $apartRent        = isset($_POST['apartRent']) ? ($_POST['apartRent'] ? $_POST['apartRent'] : '') : '';
        
        if ($minPrice) {
            $query->where('price', '>=', $minPrice);
        }
    
        if ($plan) {
            $query->where('plan_available', '=', $plan);
        }
        
        $result = $query->execute();
        
        if ($result) {
            //            $IDs = self::getIDsBySphinxResult($sphinxResults);
            //
            //            $stmt = $this->db->prepare("SELECT * FROM mock_data WHERE id IN ({$IDs})");
            //            $stmt->execute();
            //
            //            $result = $stmt->fetchAll();
            
            return $result;
        }
        
        return false;
    }
    
    //    private function getIDsBySphinxResult($arr)
    //    {
    //        $IDs = array();
    //        if (!empty($arr["matches"])) { // если есть результаты поиска - обрабатываем их
    //            foreach ($arr["matches"] as $id => $data) {
    //                $IDs[] = $id;
    //            }
    //        }
    //
    //        return implode(',', $IDs);
    //    }
}