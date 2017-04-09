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

    public function getJSONData()
    {
        return json_encode([
            'subject' => isset($_POST['subject']) ? $_POST['subject'] : '',
            'operation' => isset($_POST['operation']) ? $_POST['operation'] : '',
            'minPrice' => isset($_POST['minPrice']) ? $_POST['minPrice'] : '',
            'maxPrice' => isset($_POST['maxPrice']) ? $_POST['maxPrice'] : '',
            'bargain' => isset($_POST['bargain']) ? $_POST['bargain'] : '',
            'rentType' => isset($_POST['rentType']) ? $_POST['rentType'] : '',
            'suggest' => isset($_POST['suggest']) ? $_POST['suggest'] : '',
            'country' => isset($_POST['country']) ? $_POST['country'] : '',
            'area' => isset($_POST['area']) ? $_POST['area'] : '',
            'city' => isset($_POST['city']) ? $_POST['city'] : '',
            'region' => isset($_POST['region']) ? $_POST['region'] : '',
            'street' => isset($_POST['street']) ? $_POST['street'] : '',
            'metroMin' => isset($_POST['metroMin']) ? $_POST['metroMin'] : '',
            'metroMax' => isset($_POST['metroMax']) ? $_POST['metroMax'] : '',
            'roomsNumber' => isset($_POST['roomsNumber']) ? $_POST['roomsNumber'] : '',
            'spaceMin' => isset($_POST['spaceMin']) ? $_POST['spaceMin'] : '',
            'spaceMax' => isset($_POST['spaceMax']) ? $_POST['spaceMax'] : '',
            'floorMin' => isset($_POST['floorMin']) ? $_POST['floorMin'] : '',
            'floorMax' => isset($_POST['floorMax']) ? $_POST['floorMax'] : '',
            'equipment' => isset($_POST['equipment']) ? $_POST['equipment'] : '',
            'ceilingHeight' => isset($_POST['ceilingHeight']) ? $_POST['ceilingHeight'] : '',
            'houseType' => isset($_POST['houseType']) ? $_POST['houseType'] : '',
            'houseFloorNumber' => isset($_POST['houseFloorNumber']) ? $_POST['houseFloorNumber'] : '',
            'lift' => isset($_POST['lift']) ? $_POST['lift'] : '',
            'parking' => isset($_POST['parking']) ? $_POST['parking'] : '',
            'concierge' => isset($_POST['concierge']) ? $_POST['concierge'] : '',
            'security' => isset($_POST['security']) ? $_POST['security'] : '',
            'intercom' => isset($_POST['intercom']) ? $_POST['intercom'] : '',
            'CCTV' => isset($_POST['CCTV']) ? $_POST['CCTV'] : '',
            'chute' => isset($_POST['chute']) ? $_POST['chute'] : '',
            'bedroom' => isset($_POST['bedroom']) ? $_POST['bedroom'] : '',
            'kitchen' => isset($_POST['kitchen']) ? $_POST['kitchen'] : '',
            'livingRoom' => isset($_POST['livingRoom']) ? $_POST['livingRoom'] : '',
            'hallway' => isset($_POST['hallway']) ? $_POST['hallway'] : '',
            'nursery' => isset($_POST['nursery']) ? $_POST['nursery'] : '',
            'study' => isset($_POST['study']) ? $_POST['study'] : '',
            'canteen' => isset($_POST['canteen']) ? $_POST['canteen'] : '',
            'bathroom' => isset($_POST['bathroom']) ? $_POST['bathroom'] : '',
            'decoration' => isset($_POST['decoration']) ? $_POST['decoration'] : '',
            'decorationValue' => isset($_POST['decorationValue']) ? $_POST['decorationValue'] : '',
            'lavatory' => isset($_POST['lavatory']) ? $_POST['lavatory'] : '',
            'balcony' => isset($_POST['balcony']) ? $_POST['balcony'] : '',
            'heating' => isset($_POST['heating']) ? $_POST['heating'] : '',
            'gas' => isset($_POST['gas']) ? $_POST['gas'] : '',
            'electricity' => isset($_POST['electricity']) ? $_POST['electricity'] : '',
            'water' => isset($_POST['water']) ? $_POST['water'] : '',
            'TV' => isset($_POST['TV']) ? $_POST['TV'] : '',
            'musicCenter' => isset($_POST['musicCenter']) ? $_POST['musicCenter'] : '',
            'conditioner' => isset($_POST['conditioner']) ? $_POST['conditioner'] : '',
            'fridge' => isset($_POST['fridge']) ? $_POST['fridge'] : '',
            'plate' => isset($_POST['plate']) ? $_POST['plate'] : '',
            'bake' => isset($_POST['bake']) ? $_POST['bake'] : '',
            'microwave' => isset($_POST['microwave']) ? $_POST['microwave'] : '',
            'dishwasher' => isset($_POST['dishwasher']) ? $_POST['dishwasher'] : '',
            'table' => isset($_POST['table']) ? $_POST['table'] : '',
            'bed' => isset($_POST['bed']) ? $_POST['bed'] : '',
            'cupboard' => isset($_POST['cupboard']) ? $_POST['cupboard'] : '',
            'stand' => isset($_POST['stand']) ? $_POST['stand'] : '',
            'mirror' => isset($_POST['mirror']) ? $_POST['mirror'] : '',
            'armchair' => isset($_POST['armchair']) ? $_POST['armchair'] : '',
            'sofa' => isset($_POST['sofa']) ? $_POST['sofa'] : '',
            'plan' => isset($_POST['plan']) ? $_POST['plan'] : '',
            '3d' => isset($_POST['3d']) ? $_POST['3d'] : '',
            'video' => isset($_POST['video']) ? $_POST['video'] : '',
            'photo' => isset($_POST['photo']) ? $_POST['photo'] : '',
            'floorsNumber' => isset($_POST['floorsNumber']) ? $_POST['floorsNumber'] : '',
            'season' => isset($_POST['season']) ? $_POST['season'] : '',
            'type' => isset($_POST['type']) ? $_POST['type'] : '',
            'style' => isset($_POST['style']) ? $_POST['style'] : '',
            'Material' => isset($_POST['Material']) ? $_POST['Material'] : '',
            'TSJ' => isset($_POST['TSJ']) ? $_POST['TSJ'] : '',
            'fencing' => isset($_POST['fencing']) ? $_POST['fencing'] : '',
            'landscape' => isset($_POST['landscape']) ? $_POST['landscape'] : '',
            'entrance' => isset($_POST['entrance']) ? $_POST['entrance'] : '',
            'bath' => isset($_POST['bath']) ? $_POST['bath'] : '',
            'garage' => isset($_POST['garage']) ? $_POST['garage'] : '',
            'barn' => isset($_POST['barn']) ? $_POST['barn'] : '',
            'pool' => isset($_POST['pool']) ? $_POST['pool'] : '',
            'alcove' => isset($_POST['alcove']) ? $_POST['alcove'] : '',
            'Hall' => isset($_POST['Hall']) ? $_POST['Hall'] : '',
            'basement' => isset($_POST['basement']) ? $_POST['basement'] : '',
            'boilerroom' => isset($_POST['boilerroom']) ? $_POST['boilerroom'] : '',
            'veranda' => isset($_POST['veranda']) ? $_POST['veranda'] : '',
            'wardrobe' => isset($_POST['wardrobe']) ? $_POST['wardrobe'] : '',
            'Flora' => isset($_POST['Flora']) ? $_POST['Flora'] : '',
            'roomsperpay' => isset($_POST['roomsperpay']) ? $_POST['roomsperpay'] : '',
            'roomlocation' => isset($_POST['roomlocation']) ? $_POST['roomlocation'] : '',
            'spaceMinKitchen' => isset($_POST['spaceMinKitchen']) ? $_POST['spaceMinKitchen'] : '',
            'spaceMaxKitchen' => isset($_POST['spaceMaxKitchen']) ? $_POST['spaceMaxKitchen'] : '',
            'stairs' => isset($_POST['stairs']) ? $_POST['stairs'] : '',
        ]);
    }

    public function getRentApartData()
    {
        $conn = new Connection();
        $conn->setParams(array(
            'host' => 'localhost',
            'port' => 9306,
        ));

        $query = SphinxQL::create($conn)->select('*')->from('news');

        // $query->where('first_name', '=', 'Robin');

//        $subject          = isset($_POST['subject']) ? $_POST['subject'] : '';
//        $operation        = isset($_POST['operation']) ? $_POST['operation'] : '';
        $minPrice = isset($_POST['minPrice']) ? $_POST['minPrice'] : '';
        $maxPrice = isset($_POST['maxPrice']) ? $_POST['maxPrice'] : '';
        $parking = isset($_POST['parking']) ? $_POST['parking'] : '';

        $cadastral_number = isset($_POST['cadastral_number']) ? $_POST['cadastral_number'] : '';
        if ($cadastral_number || $cadastral_number !== '') {
            $query->where('cadastral_number', '=', 1);
        };

        $bargain = isset($_POST['bargain']) ? $_POST['bargain'] : '';
        if ($bargain || $bargain !== '') {
            $query->where('bargain', '=', 1);
        };

        $bathroom = isset($_POST['bathroom']) ? $_POST['bathroom'] : '';
        if ($bathroom || $bathroom !== '') {
            $query->where('bathroom', '=', 1);
        };

        $dining_room = isset($_POST['dining_room']) ? $_POST['dining_room'] : '';
        if ($dining_room || $dining_room !== '') {
            $query->where('dining_room', '=', 1);
        };

        $study = isset($_POST['study']) ? $_POST['study'] : '';
        if ($study || $study !== '') {
            $query->where('study', '=', 1);
        };

        $playroom = isset($_POST['playroom']) ? $_POST['playroom'] : '';
        if ($playroom || $playroom !== '') {
            $query->where('playroom', '=', 1);
        };

        $hallway = isset($_POST['hallway']) ? $_POST['hallway'] : '';
        if ($hallway || $hallway !== '') {
            $query->where('hallway', '=', 1);
        };

        $living_room = isset($_POST['living_room']) ? $_POST['living_room'] : '';
        if ($living_room || $living_room !== '') {
            $query->where('living_room', '=', 1);
        };

        $kitchen = isset($_POST['kitchen']) ? $_POST['kitchen'] : '';
        if ($kitchen || $kitchen !== '') {
            $query->where('kitchen', '=', 1);
        };

        $bedroom = isset($_POST['bedroom']) ? $_POST['bedroom'] : '';
        if ($bedroom || $bedroom !== '') {
            $query->where('bedroom', '=', 1);
        };

        $availability_of_garbage_chute = isset($_POST['availability_of_garbage_chute']) ? $_POST['availability_of_garbage_chute'] : '';
        if ($availability_of_garbage_chute || $availability_of_garbage_chute !== '') {
            $query->where('availability_of_garbage_chute', '=', 1);
        };

        $signaling = isset($_POST['signaling']) ? $_POST['signaling'] : '';
        if ($signaling || $signaling !== '') {
            $query->where('signaling', '=', 1);
        };

        $cctv = isset($_POST['cctv']) ? $_POST['cctv'] : '';
        if ($cctv || $cctv !== '') {
            $query->where('cctv', '=', 1);
        };

        $intercom = isset($_POST['intercom']) ? $_POST['intercom'] : '';
        if ($intercom || $intercom !== '') {
            $query->where('intercom', '=', 1);
        };

        $security = isset($_POST['security']) ? $_POST['security'] : '';
        if ($security || $security !== '') {
            $query->where('security', '=', 1);
        };

        $concierge = isset($_POST['concierge']) ? $_POST['concierge'] : '';
        if ($concierge || $concierge !== '') {
            $query->where('concierge', '=', 1);
        };

        $water_pipes = isset($_POST['water_pipes']) ? $_POST['water_pipes'] : '';
        if ($water_pipes || $water_pipes !== '') {
            $query->where('water_pipes', '=', 1);
        };

        $electricity = isset($_POST['electricity']) ? $_POST['electricity'] : '';
        if ($electricity || $electricity !== '') {
            $query->where('electricity', '=', 1);
        };

        $gas = isset($_POST['gas']) ? $_POST['gas'] : '';
        if ($gas || $gas !== '') {
            $query->where('gas', '=', 1);
        };

        $heating = isset($_POST['heating']) ? $_POST['heating'] : '';
        if ($heating || $heating !== '') {
            $query->where('heating', '=', 1);
        };

//        if ($minPrice && $maxPrice) {
//            $query->where('price', 'between', array((int)$minPrice, (int)$maxPrice));
//        } elseif ($minPrice) {
//            $query->where('price', '>=', (int)$minPrice);
//        } elseif ($maxPrice) {
//            $query->where('price', '<=', (int)$maxPrice);
//        }
//
//        if ($parking || $parking !== '') {
//            $query->where('parking', '=', (int)$parking);
//        }

        $price_min = isset($_POST['price-min']) ? $_POST['price-min'] : '';
        $price_max = isset($_POST['price-max']) ? $_POST['price-max'] : '';
        if ($price_min && $price_max) {
            $query->where('price', 'between', array((int)$price_min, (int)$price_max));
        } elseif ($price_min) {
            $query->where('price', '>=', (int)$price_min);
        } elseif ($price_max) {
            $query->where('price', '<=', (int)$price_max);
        }

        $distance_from_metro_min = isset($_POST['distance_from_metro-min']) ? $_POST['distance_from_metro-min'] : '';
        $distance_from_metro_max = isset($_POST['distance_from_metro-max']) ? $_POST['distance_from_metro-max'] : '';
        if ($distance_from_metro_min && $distance_from_metro_max) {
            $query->where('distance_from_metro', 'between', array((int)$distance_from_metro_min, (int)$distance_from_metro_max));
        } elseif ($distance_from_metro_min) {
            $query->where('distance_from_metro', '>=', (int)$distance_from_metro_min);
        } elseif ($distance_from_metro_max) {
            $query->where('distance_from_metro', '<=', (int)$distance_from_metro_max);
        }

        $residential_min = isset($_POST['residential-min']) ? $_POST['residential-min'] : '';
        $residential_max = isset($_POST['residential-max']) ? $_POST['residential-max'] : '';
        if ($residential_min && $residential_max) {
            $query->where('residential', 'between', array((int)$residential_min, (int)$residential_max));
        } elseif ($residential_min) {
            $query->where('residential', '>=', (int)$residential_min);
        } elseif ($residential_max) {
            $query->where('residential', '<=', (int)$residential_max);
        }

        $not_residential_min = isset($_POST['not_residential-min']) ? $_POST['not_residential-min'] : '';
        $not_residential_max = isset($_POST['not_residential-max']) ? $_POST['not_residential-max'] : '';
        if ($not_residential_min && $not_residential_max) {
            $query->where('not_residential', 'between', array((int)$not_residential_min, (int)$not_residential_max));
        } elseif ($not_residential_min) {
            $query->where('not_residential', '>=', (int)$not_residential_min);
        } elseif ($not_residential_max) {
            $query->where('not_residential', '<=', (int)$not_residential_max);
        }

        $total_min = isset($_POST['total-min']) ? $_POST['total-min'] : '';
        $total_max = isset($_POST['total-max']) ? $_POST['total-max'] : '';
        if ($total_min && $total_max) {
            $query->where('total', 'between', array((int)$total_min, (int)$total_max));
        } elseif ($total_min) {
            $query->where('total', '>=', (int)$total_min);
        } elseif ($total_max) {
            $query->where('total', '<=', (int)$total_max);
        }

        $balcony_min = isset($_POST['balcony-min']) ? $_POST['balcony-min'] : '';
        $balcony_max = isset($_POST['balcony-max']) ? $_POST['balcony-max'] : '';
        if ($balcony_min && $balcony_max) {
            $query->where('balcony', 'between', array((int)$balcony_min, (int)$balcony_max));
        } elseif ($balcony_min) {
            $query->where('balcony', '>=', (int)$balcony_min);
        } elseif ($balcony_max) {
            $query->where('balcony', '<=', (int)$balcony_max);
        }

        $ceiling_height_min = isset($_POST['ceiling_height-min']) ? $_POST['ceiling_height-min'] : '';
        $ceiling_height_max = isset($_POST['ceiling_height-max']) ? $_POST['ceiling_height-max'] : '';
        if ($ceiling_height_min && $ceiling_height_max) {
            $query->where('ceiling_height', 'between', array((int)$ceiling_height_min, (int)$ceiling_height_max));
        } elseif ($ceiling_height_min) {
            $query->where('ceiling_height', '>=', (int)$ceiling_height_min);
        } elseif ($ceiling_height_max) {
            $query->where('ceiling_height', '<=', (int)$ceiling_height_max);
        }

        $floor_min = isset($_POST['floor-min']) ? $_POST['floor-min'] : '';
        $floor_max = isset($_POST['floor-max']) ? $_POST['floor-max'] : '';
        if ($floor_min && $floor_max) {
            $query->where('floor', 'between', array((int)$floor_min, (int)$floor_max));
        } elseif ($floor_min) {
            $query->where('floor', '>=', (int)$floor_min);
        } elseif ($floor_max) {
            $query->where('floor', '<=', (int)$floor_max);
        }

        $number_of_floors_min = isset($_POST['number_of_floors-min']) ? $_POST['number_of_floors-min'] : '';
        $number_of_floors_max = isset($_POST['number_of_floors-max']) ? $_POST['number_of_floors-max'] : '';
        if ($number_of_floors_min && $number_of_floors_max) {
            $query->where('number_of_floors', 'between', array((int)$number_of_floors_min, (int)$number_of_floors_max));
        } elseif ($number_of_floors_min) {
            $query->where('number_of_floors', '>=', (int)$number_of_floors_min);
        } elseif ($number_of_floors_max) {
            $query->where('number_of_floors', '<=', (int)$number_of_floors_max);
        }

        $year_of_construction_min = isset($_POST['year_of_construction-min']) ? $_POST['year_of_construction-min'] : '';
        $year_of_construction_max = isset($_POST['year_of_construction-max']) ? $_POST['year_of_construction-max'] : '';
        if ($year_of_construction_min && $year_of_construction_max) {
            $query->where('year_of_construction', 'between', array((int)$year_of_construction_min, (int)$year_of_construction_max));
        } elseif ($year_of_construction_min) {
            $query->where('year_of_construction', '>=', (int)$year_of_construction_min);
        } elseif ($year_of_construction_max) {
            $query->where('year_of_construction', '<=', (int)$year_of_construction_max);
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

    public function getFormTypes()
    {
        $space = $this->db->query('SELECT * FROM form_space_types ORDER BY id');
        $operation = $this->db->query('SELECT * FROM form_operation_types ORDER BY id');
        $object = $this->db->query('SELECT * FROM form_object_types ORDER BY id');

        $space_types = $space->fetchAll();
        $operation_types = $operation->fetchAll();
        $object_types = $object->fetchAll();

        return array(
            'space_types' => $space_types,
            'operation_types' => $operation_types,
            'object_types' => $object_types,
        );
    }

    public function getFormData($space_type, $operation_type = null, $object_type = null)
    {
        $query = $this->db->select('*')->from('forms')->where('space_type', '=', $space_type);

        if ($object_type) {
            $query->where('object_type', '=', $object_type);
        }

        if ($operation_type) {
            $query->where('operation', '=', $operation_type);
        }

        return $query->execute();
    }

    public function getFormCategories()
    {
        $query = $this->db->query('SELECT * FROM form_categories ORDER BY id');
        return $query->fetchAll();
    }

    public function getFormSubcategories()
    {
        $query = $this->db->query('SELECT * FROM form_subcategories ORDER BY id');
        return $query->fetchAll();
    }

    public function getFormElements()
    {
        $query = $this->db->query('SELECT * FROM form_elements ORDER BY id');
        return $query->fetchAll();
    }

    public function getFormSelectOptions()
    {
        $query = $this->db->query('SELECT * FROM form_select_options ORDER BY id');
        return $query->fetchAll();
    }
}