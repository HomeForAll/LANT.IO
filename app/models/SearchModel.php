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
        $bargain = isset($_POST['bargain']) ? $_POST['bargain'] : '';
        $rentType = isset($_POST['rentType']) ? $_POST['rentType'] : '';
        $country = isset($_POST['country']) ? $_POST['country'] : '';
        $area = isset($_POST['area']) ? $_POST['area'] : '';
        $city = isset($_POST['city']) ? $_POST['city'] : '';
        $region = isset($_POST['region']) ? $_POST['region'] : '';
        $street = isset($_POST['street']) ? $_POST['street'] : '';
        $metroMin = isset($_POST['metroMin']) ? $_POST['metroMin'] : '';
        $metroMax = isset($_POST['metroMax']) ? $_POST['metroMax'] : '';
        $roomsNumber = isset($_POST['roomsNumber']) ? $_POST['roomsNumber'] : '';
        $spaceMin = isset($_POST['spaceMin']) ? $_POST['spaceMin'] : '';
        $spaceMax = isset($_POST['spaceMax']) ? $_POST['spaceMax'] : '';
        $floorMin = isset($_POST['floorMin']) ? $_POST['floorMin'] : '';
        $floorMax = isset($_POST['floorMax']) ? $_POST['floorMax'] : '';
        $equipment = isset($_POST['equipment']) ? $_POST['equipment'] : '';
        $ceilingHeight = isset($_POST['ceilingHeight']) ? $_POST['ceilingHeight'] : '';
        $houseType = isset($_POST['houseType']) ? $_POST['houseType'] : '';
        $houseFloorNumber = isset($_POST['houseFloorNumber']) ? $_POST['houseFloorNumber'] : '';
        $lift = isset($_POST['lift']) ? $_POST['lift'] : '';
        $parking = isset($_POST['parking']) ? $_POST['parking'] : '';
        $concierge = isset($_POST['concierge']) ? $_POST['concierge'] : '';
        $security = isset($_POST['security']) ? $_POST['security'] : '';
        $intercom = isset($_POST['intercom']) ? $_POST['intercom'] : '';
        $CCTV = isset($_POST['CCTV']) ? $_POST['CCTV'] : '';
        $chute = isset($_POST['chute']) ? $_POST['chute'] : '';
        $bedroom = isset($_POST['bedroom']) ? $_POST['bedroom'] : '';
        $kitchen = isset($_POST['kitchen']) ? $_POST['kitchen'] : '';
        $livingRoom = isset($_POST['livingRoom']) ? $_POST['livingRoom'] : '';
        $hallway = isset($_POST['hallway']) ? $_POST['hallway'] : '';
        $nursery = isset($_POST['nursery']) ? $_POST['nursery'] : '';
        $study = isset($_POST['study']) ? $_POST['study'] : '';
        $canteen = isset($_POST['canteen']) ? $_POST['canteen'] : '';
        $bathroom = isset($_POST['bathroom']) ? $_POST['bathroom'] : '';
        $decoration = isset($_POST['decoration']) ? $_POST['decoration'] : '';
        $decorationValue = isset($_POST['decorationValue']) ? $_POST['decorationValue'] : '';
        $lavatory = isset($_POST['lavatory']) ? $_POST['lavatory'] : '';
        $balcony = isset($_POST['balcony']) ? $_POST['balcony'] : '';
        $heating = isset($_POST['heating']) ? $_POST['heating'] : '';
        $gas = isset($_POST['gas']) ? $_POST['gas'] : '';
        $electricity = isset($_POST['electricity']) ? $_POST['electricity'] : '';
        $water = isset($_POST['water']) ? $_POST['water'] : '';
        $TV = isset($_POST['TV']) ? $_POST['TV'] : '';
        $musicCenter = isset($_POST['musicCenter']) ? $_POST['musicCenter'] : '';
        $conditioner = isset($_POST['conditioner']) ? $_POST['conditioner'] : '';
        $fridge = isset($_POST['fridge']) ? $_POST['fridge'] : '';
        $plate = isset($_POST['plate']) ? $_POST['plate'] : '';
        $bake = isset($_POST['bake']) ? $_POST['bake'] : '';
        $microwave = isset($_POST['microwave']) ? $_POST['microwave'] : '';
        $dishwasher = isset($_POST['dishwasher']) ? $_POST['dishwasher'] : '';
        $table = isset($_POST['table']) ? $_POST['table'] : '';
        $bed = isset($_POST['bed']) ? $_POST['bed'] : '';
        $cupboard = isset($_POST['cupboard']) ? $_POST['cupboard'] : '';
        $stand = isset($_POST['stand']) ? $_POST['stand'] : '';
        $mirror = isset($_POST['mirror']) ? $_POST['mirror'] : '';
        $armchair = isset($_POST['armchair']) ? $_POST['armchair'] : '';
        $sofa = isset($_POST['sofa']) ? $_POST['sofa'] : '';
        $plan = isset($_POST['plan']) ? $_POST['plan'] : '';
        $_3d = isset($_POST['3d']) ? $_POST['3d'] : '';
        $video = isset($_POST['video']) ? $_POST['video'] : '';
        $photo = isset($_POST['photo']) ? $_POST['photo'] : '';
        $floorsNumber = isset($_POST['floorsNumber']) ? $_POST['floorsNumber'] : '';
        $season = isset($_POST['season']) ? $_POST['season'] : '';
        $type = isset($_POST['type']) ? $_POST['type'] : '';
        $style = isset($_POST['style']) ? $_POST['style'] : '';
        $Material = isset($_POST['Material']) ? $_POST['Material'] : '';
        $TSJ = isset($_POST['TSJ']) ? $_POST['TSJ'] : '';
        $fencing = isset($_POST['fencing']) ? $_POST['fencing'] : '';
        $landscape = isset($_POST['landscape']) ? $_POST['landscape'] : '';
        $entrance = isset($_POST['entrance']) ? $_POST['entrance'] : '';
        $bath = isset($_POST['bath']) ? $_POST['bath'] : '';
        $garage = isset($_POST['garage']) ? $_POST['garage'] : '';
        $barn = isset($_POST['barn']) ? $_POST['barn'] : '';
        $pool = isset($_POST['pool']) ? $_POST['pool'] : '';
        $alcove = isset($_POST['alcove']) ? $_POST['alcove'] : '';
        $Hall = isset($_POST['Hall']) ? $_POST['Hall'] : '';
        $basement = isset($_POST['basement']) ? $_POST['basement'] : '';
        $boilerroom = isset($_POST['boilerroom']) ? $_POST['boilerroom'] : '';
        $veranda = isset($_POST['veranda']) ? $_POST['veranda'] : '';
        $wardrobe = isset($_POST['wardrobe']) ? $_POST['wardrobe'] : '';
        $Flora = isset($_POST['Flora']) ? $_POST['Flora'] : '';
        $roomsperpay = isset($_POST['roomsperpay']) ? $_POST['roomsperpay'] : '';
        $roomlocation = isset($_POST['roomlocation']) ? $_POST['roomlocation'] : '';
        $spaceMinKitchen = isset($_POST['spaceMinKitchen']) ? $_POST['spaceMinKitchen'] : '';
        $spaceMaxKitchen = isset($_POST['spaceMaxKitchen']) ? $_POST['spaceMaxKitchen'] : '';
        $stairs = isset($_POST['stairs']) ? $_POST['stairs'] : '';

        /**
         * Базовые параметры
         */
        if ($minPrice && $maxPrice) {
            $query->where('price', 'between', array((int)$minPrice, (int)$maxPrice));
        } elseif ($minPrice) {
            $query->where('price', '>=', (int)$minPrice);
        } elseif ($maxPrice) {
            $query->where('price', '<=', (int)$maxPrice);
        }

        if ($bargain || $bargain !== '') {
            $query->where('bargain_available', '=', (int)$bargain);
        }

        if ($rentType || $rentType !== '') {
            $query->where('type_of_rent', '=', (int)$rentType);
        }

        if ($country || $country !== '') {
            $query->where('country', '=', $country);
        }

        if ($area || $area !== '') {
            $query->where('area', '=', $area);
        }

        if ($city || $city !== '') {
            $query->where('city', '=', $city);
        }

        if ($region || $region !== '') {
            $query->where('region', '=', $region);
        }

        if ($street || $street !== '') {
            $query->where('street', '=', $street);
        }

        if ($metroMin && $metroMax) {
            $query->where('distance_from_metro', 'between', array((int)$metroMin, (int)$metroMax));
        } elseif ($metroMin) {
            $query->where('distance_from_metro', '>=', (int)$metroMin);
        } elseif ($metroMax) {
            $query->where('distance_from_metro', '<=', (int)$metroMax);
        }

        /**
         * Описание объекта
         *
         * Квартира
         */
        if ($roomsNumber || $roomsNumber !== '') {
            if ($roomsNumber > 3) {
                $query->where('number_of_rooms', '>=', 3);
            } else {
                $query->where('number_of_rooms', '=', (int)$roomsNumber);
            }
        }

        if ($spaceMin && $spaceMax) {
            $query->where('space', 'between', array((int)$spaceMin, (int)$spaceMax));
        } elseif ($spaceMin) {
            $query->where('space', '>=', (int)$spaceMin);
        } elseif ($spaceMax) {
            $query->where('space', '<=', (int)$spaceMax);
        }

        if ($floorMin && $floorMax) {
            $query->where('floor', 'between', array((int)$floorMin, (int)$floorMax));
        } elseif ($floorMin) {
            $query->where('floor', '>=', (int)$floorMin);
        } elseif ($floorMax) {
            $query->where('floor', '<=', (int)$floorMax);
        }

        if ($equipment || $equipment !== '') {
            $query->where('equipment', '=', (int)$equipment);
        }

        if ($ceilingHeight || $ceilingHeight !== '') {
            $query->where('ceiling_height', '=', (int)$ceilingHeight);
        }

        /**
         * Дом квартиры
         */
        if ($houseType || $houseType !== '') {
            $query->where('type_of_house', '=', (int)$houseType);
        }

        if ($houseFloorNumber || $houseFloorNumber !== '') {
            $query->where('number_of_floors', '=', (int)$houseFloorNumber);
        }

        if ($lift || $lift !== '') {
            $query->where('elevator_available', '=', (int)$lift);
        }

        if ($parking || $parking !== '') {
            $query->where('parking_type', '=', (int)$parking);
        }

        if ($concierge || $concierge !== '') {
            $query->where('concierge', '=', 1);
        }

        if ($security || $security !== '') {
            $query->where('security', '=', 1);
        }

        if ($intercom || $intercom !== '') {
            $query->where('intercom', '=', 1);
        }

        if ($CCTV || $CCTV !== '') {
            $query->where('CCTV', '=', 1);
        }

        if ($chute || $chute !== '') {
            $query->where('garbage_available', '=', (int)$chute);
        }

        /**
         * Состав квартиры
         */
        if ($bedroom || $bedroom !== '') {
            $query->where('bedroom_num', '=', 1);
        }

        if ($kitchen || $kitchen !== '') {
            $query->where('kitchen_num', '=', 1);
        }

        if ($livingRoom || $livingRoom !== '') {
            $query->where('living_room_num', '=', 1);
        }

        if ($hallway || $hallway !== '') {
            $query->where('hallway_num', '=', 1);
        }

        if ($nursery || $nursery !== '') {
            $query->where('play_room_num', '=', 1);
        }

        if ($study || $study !== '') {
            $query->where('cabinet_num', '=', 1);
        }

        if ($canteen || $canteen !== '') {
            $query->where('dining_room_num', '=', 1);
        }

        if ($bathroom || $bathroom !== '') {
            $query->where('bathroom_num', '=', 1);
        }

        if ($decoration || $decoration !== '') {
            if ($decorationValue || $decorationValue !== '') {
                $query->where('room_condition', '=', (int)$decorationValue);
            }
        }

        if ($lavatory || $lavatory !== '') {
            $query->where('toilet', '=', (int)$lavatory);
        }

        if ($balcony || $balcony !== '') {
            $query->where('balcony', '=', 1);
        }

        if ($heating || $heating !== '') {
            $query->where('heating_available', '=', 1);
        }

        if ($gas || $gas !== '') {
            $query->where('gas_available', '=', 1);
        }

        if ($electricity || $electricity !== '') {
            $query->where('electricity_available', '=', 1);
        }

        if ($water || $water !== '') {
            $query->where('plumbing_available', '=', 1);
        }

        if ($TV || $TV !== '') {
            $query->where('televisor_num', '>=', 1);
        }

        if ($musicCenter || $musicCenter !== '') {
            $query->where('music_center_num', '>=', 1);
        }

        if ($conditioner || $conditioner !== '') {
            $query->where('conditioning_num', '>=', 1);
        }

        if ($fridge || $fridge !== '') {
            $query->where('fridge_num', '>=', 1);
        }

        if ($plate || $plate !== '') {
            $query->where('plate_num', '>=', 1);
        }

        if ($bake || $bake !== '') {
            $query->where('stove_num', '>=', 1);
        }

        if ($microwave || $microwave !== '') {
            $query->where('microwave_num', '>=', 1);
        }

        if ($dishwasher || $dishwasher !== '') {
            $query->where('dishwasher_num', '>=', 1);
        }

        if ($table || $table !== '') {
            $query->where('table_num', '>=', 1);
        }

        if ($bed || $bed !== '') {
            $query->where('bed_num', '>=', 1);
        }

        if ($cupboard || $cupboard !== '') {
            $query->where('cupboard_num', '>=', 1);
        }

        if ($stand || $stand !== '') {
            $query->where('stand_num', '>=', 1);
        }

        if ($mirror || $mirror !== '') {
            $query->where('mirror_num', '>=', 1);
        }

        if ($armchair || $armchair !== '') {
            $query->where('armchair_num', '>=', 1);
        }

        if ($sofa || $sofa !== '') {
            $query->where('sofa_num', '>=', 1);
        }

        if ($floorsNumber || $floorsNumber !== '') {
            $query->where('number_of_floors', '>=', 1);
        }

        if ($season || $season !== '') {
            $query->where('seasonality', '=', $season);
        }

        if ($type || $type !== '') {
            $query->where('type_of_house', '=', $type);
        }

        if ($style || $style !== '') {
            $query->where('style_of_house', '=', $style);
        }

        if ($Material || $Material !== '') {
            $query->where('material_lining', '=', $Material);
        }

        if ($TSJ || $TSJ !== '') {
            $query->where('tszh', '=', $TSJ);
        }

        if ($fencing || $fencing !== '') {
            $query->where('fencing', '=', $fencing);
        }

        if ($landscape || $landscape !== '') {
            $query->where('landscape', '=', $landscape);
        }

        if ($entrance || $entrance !== '') {
            $query->where('number_of_inputs', '=', $entrance);
        }

        if ($bath || $bath !== '') {
            $query->where('bathhouse_num', '>=', 1);
        }

        if ($garage || $garage !== '') {
            $query->where('garage_num', '>=', 1);
        }

        if ($barn || $barn !== '') {
            $query->where('barn_num', '>=', 1);
        }

        if ($pool || $pool !== '') {
            $query->where('pool_num', '>=', 1);
        }

        if ($alcove || $alcove !== '') {
            $query->where('беседка продаваемого дома', '=', 1);
        }

        if ($Hall || $Hall !== '') {
            $query->where('hall_num', '>=', 1);
        }

        if ($basement || $basement !== '') {
            $query->where('basement_num', '>=', 1);
        }

        if ($boilerroom || $boilerroom !== '') {
            $query->where('boiler_num', '>=', 1);
        }

        if ($veranda || $veranda !== '') {
            $query->where('veranda_num', '>=', 1);
        }

        if ($wardrobe || $wardrobe !== '') {
            $query->where('dressingroom_num', '>=', 1);
        }

        if ($Flora || $Flora !== '') {
            $query->where('flora', '=', $Flora);
        }

        if ($roomsperpay || $roomsperpay !== '') {
            $query->where('rooms_for_sale', '=', $roomsperpay);
        }

        if ($roomlocation || $roomlocation !== '') {
            $query->where('room_location', '=', $roomlocation);
        }

        if ($spaceMinKitchen && $spaceMaxKitchen) {
            $query->where('кухня при аренде комнаты', 'between', array((int)$spaceMinKitchen, (int)$spaceMaxKitchen));
        } elseif ($spaceMinKitchen) {
            $query->where('кухня при аренде комнаты', '>=', (int)$spaceMinKitchen);
        } elseif ($spaceMaxKitchen) {
            $query->where('кухня при аренде комнаты', '<=', (int)$spaceMaxKitchen);
        }

        if ($stairs || $stairs !== '') {
            $query->where('stairs_available', '=', 1);
        }

        /**
         * Вложения
         */
        if ($plan || $plan !== '') {
            $query->where('plan_available', '=', (int)$plan);
        }

        if ($_3d || $_3d !== '') {
            $query->where('three_d_available', '=', (int)$_3d);
        }

        if ($video || $video !== '') {
            echo $video;
            $query->where('video_available', '=', (int)$video);
        }

        if ($photo || $photo !== '') {
            echo $photo;
            $query->where('photo_available', '=', (int)$photo);
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