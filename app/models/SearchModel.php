<?php

class SearchModel extends Model
{
    private $indexes = [
        // Количество комнат
        'count_rooms' => '',
        // Количество комнат от-до
        'count_rooms_num' => '',
        // Площадь от-до
        'area_only' => '',
        // Площадь жилая от-до
        'area_residential' => '',
        // Площадь нежилая от-до
        'area_non_residential' => '',
        // Площадь общая от-до
        'area_general' => '',
        // Плозадь балкона от-до
        'area_balcony' => '',
        // Высота потолков от-до
        'height_ceiling' => '',
        // Этаж от-до
        'floor' => '',
        // Санузел
        'bathroom' => '',
        // Комнаты
        'rooms_0' => '', // Спальня
        'rooms_1' => '', // Кухня
        'rooms_2' => '', // Гостиная
        'rooms_3' => '', // Прихожая
        'rooms_4' => '', // Детская
        'rooms_5' => '', // Рабочий кабинет
        'rooms_6' => '', // Столовая
        'rooms_7' => '', // Ванная
        // Комплектация
        'equipment' => '',
        // Отделка
        'decoration' => '',
        // Количество этажей от-до
        'count_floors' => '',
        // Лифт
        'lift' => '',
        // Наличие мусоропровода
        'garbage' => '',
        // Уточнение вида объекта
        'object_type' => '',
        'object_type_plot' => '',
        // Год постройки/окончания строительства
        'year_building' => '',
        // Жилищно-коммунальные услуги
        'hc_services_0' => '', // Отопление
        'hc_services_1' => '', // Газ
        'hc_services_2' => '', // Электричество
        'hc_services_3' => '', // Водопровод
        
        'hc_services_nr_0' => '', // Электричество
        'hc_services_nr_1' => '', // Водопровод и канализация
        'hc_services_nr_2' => '', // Наличие санузлов
        // Парковка
        'parking' => '',
        // Материал стен
        'wall_material' => '',
        // Состояние лестничных клеток
        'state_stairs' => '',
        // Безопасность
        'security_0' => '', // Консьерж
        'security_1' => '', // Охрана
        'security_2' => '', // Домофон
        'security_3' => '', // Видеонаблюдение
        'security_4' => '', // Сигнализация
        // Кровля
        'roofing' => '',
        // Фундамент
        'foundation' => '',
        // Материал стен дома
        'wall_material_house' => '',
        // Тип дома
        'type_house' => '',
        // Вид постройки
        'view_buildings' => '',
        // Тип здания
        'type_buildings' => '',
        // Дополнительные строения
        'add_buildings_0' => '', // Беседка
        'add_buildings_1' => '', // Сарай
        'add_buildings_2' => '', // Винный погреб
        'add_buildings_3' => '', // Детская площадка
        'add_buildings_4' => '', // Бассейн
        'add_buildings_5' => '', // Баня
        'add_buildings_6' => '', // Гостевой дом
        'add_buildings_7' => '', // Сторожка
        // Участок
        'plot' => '',
        // На участке
        'on_plot_0' => '', // Лесные деревья
        'on_plot_1' => '', // Садовые деревья
        'on_plot_2' => '', // Родник
        'on_plot_3' => '', // Река
        'on_plot_4' => '', // Берег водоема
        // Ограждение
        'guardrail' => '',
        // Объект размещен
        'hosted' => '',
        // Документы
        'documents' => '',
        // Проект планировки
        'project' => '',
        // 3D проект
        'project3d' => '',
        // Видео
        'video' => '',
    ];
    
    public function getRentApartData()
    {
        $conn = new Connection();
        $conn->setParams(
            [
                'host' => 'localhost',
                'port' => 9306,
            ]
        );
        
        $query = SphinxQL::create($conn)->select('*')->from('news');
        
        // $query->where('first_name', '=', 'Robin');
        
        //        $subject          = isset($_POST['subject']) ? $_POST['subject'] : '';
        //        $operation        = isset($_POST['operation']) ? $_POST['operation'] : '';
        $minPrice = isset($_POST['minPrice']) ? $_POST['minPrice'] : '';
        $maxPrice = isset($_POST['maxPrice']) ? $_POST['maxPrice'] : '';
        $parking  = isset($_POST['parking']) ? $_POST['parking'] : '';
        
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
            $query->where('price', 'between', [(int)$price_min, (int)$price_max]);
        } elseif ($price_min) {
            $query->where('price', '>=', (int)$price_min);
        } elseif ($price_max) {
            $query->where('price', '<=', (int)$price_max);
        }
        
        //        $distance_from_metro_min = isset($_POST['distance_from_metro-min']) ? $_POST['distance_from_metro-min'] : '';
        //        $distance_from_metro_max = isset($_POST['distance_from_metro-max']) ? $_POST['distance_from_metro-max'] : '';
        //        if ($distance_from_metro_min && $distance_from_metro_max) {
        //            $query->where('distance_from_metro', 'between', array((int)$distance_from_metro_min, (int)$distance_from_metro_max));
        //        } elseif ($distance_from_metro_min) {
        //            $query->where('distance_from_metro', '>=', (int)$distance_from_metro_min);
        //        } elseif ($distance_from_metro_max) {
        //            $query->where('distance_from_metro', '<=', (int)$distance_from_metro_max);
        //        }
        
        $residential_min = isset($_POST['residential-min']) ? $_POST['residential-min'] : '';
        $residential_max = isset($_POST['residential-max']) ? $_POST['residential-max'] : '';
        if ($residential_min && $residential_max) {
            $query->where('residential', 'between', [(int)$residential_min, (int)$residential_max]);
        } elseif ($residential_min) {
            $query->where('residential', '>=', (int)$residential_min);
        } elseif ($residential_max) {
            $query->where('residential', '<=', (int)$residential_max);
        }
        
        $not_residential_min = isset($_POST['not_residential-min']) ? $_POST['not_residential-min'] : '';
        $not_residential_max = isset($_POST['not_residential-max']) ? $_POST['not_residential-max'] : '';
        if ($not_residential_min && $not_residential_max) {
            $query->where('not_residential', 'between', [(int)$not_residential_min, (int)$not_residential_max]);
        } elseif ($not_residential_min) {
            $query->where('not_residential', '>=', (int)$not_residential_min);
        } elseif ($not_residential_max) {
            $query->where('not_residential', '<=', (int)$not_residential_max);
        }
        
        $total_min = isset($_POST['total-min']) ? $_POST['total-min'] : '';
        $total_max = isset($_POST['total-max']) ? $_POST['total-max'] : '';
        if ($total_min && $total_max) {
            $query->where('total', 'between', [(int)$total_min, (int)$total_max]);
        } elseif ($total_min) {
            $query->where('total', '>=', (int)$total_min);
        } elseif ($total_max) {
            $query->where('total', '<=', (int)$total_max);
        }
        
        $balcony_min = isset($_POST['balcony-min']) ? $_POST['balcony-min'] : '';
        $balcony_max = isset($_POST['balcony-max']) ? $_POST['balcony-max'] : '';
        if ($balcony_min && $balcony_max) {
            $query->where('balcony', 'between', [(int)$balcony_min, (int)$balcony_max]);
        } elseif ($balcony_min) {
            $query->where('balcony', '>=', (int)$balcony_min);
        } elseif ($balcony_max) {
            $query->where('balcony', '<=', (int)$balcony_max);
        }
        
        $ceiling_height_min = isset($_POST['ceiling_height-min']) ? $_POST['ceiling_height-min'] : '';
        $ceiling_height_max = isset($_POST['ceiling_height-max']) ? $_POST['ceiling_height-max'] : '';
        if ($ceiling_height_min && $ceiling_height_max) {
            $query->where('ceiling_height', 'between', [(int)$ceiling_height_min, (int)$ceiling_height_max]);
        } elseif ($ceiling_height_min) {
            $query->where('ceiling_height', '>=', (int)$ceiling_height_min);
        } elseif ($ceiling_height_max) {
            $query->where('ceiling_height', '<=', (int)$ceiling_height_max);
        }
        
        $floor_min = isset($_POST['floor-min']) ? $_POST['floor-min'] : '';
        $floor_max = isset($_POST['floor-max']) ? $_POST['floor-max'] : '';
        if ($floor_min && $floor_max) {
            $query->where('floor', 'between', [(int)$floor_min, (int)$floor_max]);
        } elseif ($floor_min) {
            $query->where('floor', '>=', (int)$floor_min);
        } elseif ($floor_max) {
            $query->where('floor', '<=', (int)$floor_max);
        }
        
        $number_of_floors_min = isset($_POST['number_of_floors-min']) ? $_POST['number_of_floors-min'] : '';
        $number_of_floors_max = isset($_POST['number_of_floors-max']) ? $_POST['number_of_floors-max'] : '';
        if ($number_of_floors_min && $number_of_floors_max) {
            $query->where('number_of_floors', 'between', [(int)$number_of_floors_min, (int)$number_of_floors_max]);
        } elseif ($number_of_floors_min) {
            $query->where('number_of_floors', '>=', (int)$number_of_floors_min);
        } elseif ($number_of_floors_max) {
            $query->where('number_of_floors', '<=', (int)$number_of_floors_max);
        }
        
        $year_of_construction_min = isset($_POST['year_of_construction-min']) ? $_POST['year_of_construction-min'] : '';
        $year_of_construction_max = isset($_POST['year_of_construction-max']) ? $_POST['year_of_construction-max'] : '';
        if ($year_of_construction_min && $year_of_construction_max) {
            $query->where('year_of_construction', 'between', [(int)$year_of_construction_min, (int)$year_of_construction_max]);
        } elseif ($year_of_construction_min) {
            $query->where('year_of_construction', '>=', (int)$year_of_construction_min);
        } elseif ($year_of_construction_max) {
            $query->where('year_of_construction', '<=', (int)$year_of_construction_max);
        }
        
        $address = isset($_POST['address']) ? $_POST['address'] : '';
        if ($address || $address !== '') {
            $query->where('address', '=', $address);
        }
        
        $distance_from_metro = isset($_POST['distance_from_metro']) ? $_POST['distance_from_metro'] : '';
        if ($address || $address !== '') {
            $query->where('distance_from_metro', '=', $distance_from_metro);
        }
        
        $country = isset($_POST['country']) ? $_POST['country'] : '';
        if ($country || $country !== '') {
            $query->where('country', '=', $country);
        }
        
        $area = isset($_POST['area']) ? $_POST['area'] : '';
        if ($area || $area !== '') {
            $query->where('area', '=', $area);
        }
        
        $city = isset($_POST['city']) ? $_POST['city'] : '';
        if ($city || $city !== '') {
            $query->where('city', '=', $city);
        }
        
        $region = isset($_POST['region']) ? $_POST['region'] : '';
        if ($city || $region !== '') {
            $query->where('region', '=', $region);
        }
        
        $object_located = isset($_POST['object_located']) ? $_POST['object_located'] : '';
        if ($object_located || $object_located !== '') {
            $query->where('object_located', '=', (int)$object_located);
        }
        
        $number_of_rooms = isset($_POST['number_of_rooms']) ? $_POST['number_of_rooms'] : '';
        if ($number_of_rooms || $number_of_rooms !== '') {
            $query->where('number_of_rooms', '=', (int)$number_of_rooms);
        }
        
        $lavatory = isset($_POST['lavatory']) ? $_POST['lavatory'] : '';
        if ($lavatory || $lavatory !== '') {
            $query->where('lavatory', '=', (int)$lavatory);
        }
        
        $furnish = isset($_POST['furnish']) ? $_POST['furnish'] : '';
        if ($furnish || $furnish !== '') {
            $query->where('furnish', '=', (int)$furnish);
        }
        
        $equipment = isset($_POST['equipment']) ? $_POST['equipment'] : '';
        if ($equipment || $equipment !== '') {
            $query->where('equipment', '=', (int)$equipment);
        }
        
        $elevator = isset($_POST['elevator']) ? $_POST['elevator'] : '';
        if ($elevator || $elevator !== '') {
            $query->where('elevator', '=', (int)$elevator);
        }
        
        $elevator_yes = isset($_POST['elevator_yes']) ? $_POST['elevator_yes'] : '';
        if ($elevator_yes || $elevator_yes !== '') {
            $query->where('elevator_yes', '=', (int)$elevator_yes);
        }
        
        $clarification_of_the_object_type = isset($_POST['clarification_of_the_object_type']) ? $_POST['clarification_of_the_object_type'] : '';
        if ($clarification_of_the_object_type || $clarification_of_the_object_type !== '') {
            $query->where('clarification_of_the_object_type', '=', (int)$clarification_of_the_object_type);
        }
        
        $parking = isset($_POST['parking']) ? $_POST['parking'] : '';
        if ($parking || $parking !== '') {
            $query->where('parking', '=', (int)$parking);
        }
        
        $wall_material = isset($_POST['wall_material']) ? $_POST['wall_material'] : '';
        if ($wall_material || $wall_material !== '') {
            $query->where('wall_material', '=', (int)$wall_material);
        }
        
        $stairwells_status = isset($_POST['stairwells_status']) ? $_POST['stairwells_status'] : '';
        if ($stairwells_status || $stairwells_status !== '') {
            $query->where('stairwells_status', '=', (int)$stairwells_status);
        }
        
        $video = isset($_POST['video']) ? $_POST['video'] : '';
        if ($video || $video !== '') {
            $query->where('video', '=', (int)$video);
        }
        
        $planning_project = isset($_POST['planning_project']) ? $_POST['planning_project'] : '';
        if ($planning_project || $planning_project !== '') {
            $query->where('planning_project', '=', (int)$planning_project);
        }
        
        $three_d_project = isset($_POST['three_d_project']) ? $_POST['three_d_project'] : '';
        if ($three_d_project || $three_d_project !== '') {
            $query->where('three_d_project', '=', (int)$three_d_project);
        }
        
        $type_of_construction = isset($_POST['type_of_construction']) ? $_POST['type_of_construction'] : '';
        if ($type_of_construction || $type_of_construction !== '') {
            $query->where('type_of_construction', '=', (int)$type_of_construction);
        }
        
        $building_type = isset($_POST['building_type']) ? $_POST['building_type'] : '';
        if ($building_type || $building_type !== '') {
            $query->where('building_type', '=', (int)$building_type);
        }
        
        $roofing = isset($_POST['roofing']) ? $_POST['roofing'] : '';
        if ($roofing || $roofing !== '') {
            $query->where('roofing', '=', (int)$roofing);
        }
        
        $foundation = isset($_POST['foundation']) ? $_POST['foundation'] : '';
        if ($foundation || $foundation !== '') {
            $query->where('foundation', '=', (int)$foundation);
        }
        
        $material = isset($_POST['material']) ? $_POST['material'] : '';
        if ($material || $material !== '') {
            $query->where('material', '=', (int)$material);
        }
        
        $municipal = isset($_POST['municipal']) ? $_POST['municipal'] : '';
        if ($municipal || $municipal !== '') {
            $query->where('municipal', '=', (int)$municipal);
        }
        
        $sanitation = isset($_POST['sanitation']) ? $_POST['sanitation'] : '';
        if ($sanitation || $sanitation !== '') {
            $query->where('sanitation', '=', (int)$sanitation);
        }
        
        $bathroom_location = isset($_POST['bathroom_location']) ? $_POST['bathroom_location'] : '';
        if ($bathroom_location || $bathroom_location !== '') {
            $query->where('bathroom_location', '=', (int)$bathroom_location);
        }
        
        $fencing = isset($_POST['fencing']) ? $_POST['fencing'] : '';
        if ($fencing || $fencing !== '') {
            $query->where('fencing', '=', 1);
        };
        
        $possible_to_post = isset($_POST['possible_to_post']) ? $_POST['possible_to_post'] : '';
        if ($possible_to_post || $possible_to_post !== '') {
            $query->where('possible_to_post', '=', 1);
        };
        
        $sanitation_description = isset($_POST['sanitation_description']) ? $_POST['sanitation_description'] : '';
        if ($sanitation_description || $sanitation_description !== '') {
            $query->where('sanitation_description', '=', 1);
        };
        
        $bathroom_description = isset($_POST['bathroom_description']) ? $_POST['bathroom_description'] : '';
        if ($bathroom_description || $bathroom_description !== '') {
            $query->where('bathroom_description', '=', 1);
        };
        
        $documents_on_ownership = isset($_POST['documents_on_ownership']) ? $_POST['documents_on_ownership'] : '';
        if ($documents_on_ownership || $documents_on_ownership !== '') {
            $query->where('documents_on_ownership', '=', 1);
        };
        
        $lease_contract = isset($_POST['lease_contract']) ? $_POST['lease_contract'] : '';
        if ($lease_contract || $lease_contract !== '') {
            $query->where('lease_contract', '=', 1);
        };
        
        $distance_from_mkad_or_metro_min = isset($_POST['distance_from_mkad_or_metro']) ? $_POST['distance_from_mkad_or_metro'] : '';
        $distance_from_mkad_or_metro_max = isset($_POST['distance_from_mkad_or_metro']) ? $_POST['distance_from_mkad_or_metro'] : '';
        if ($distance_from_mkad_or_metro_min && $distance_from_mkad_or_metro_max) {
            $query->where('distance_from_mkad_or_metro', 'between', [(int)$distance_from_mkad_or_metro_min, (int)$distance_from_mkad_or_metro_max]);
        } elseif ($distance_from_mkad_or_metro_min) {
            $query->where('distance_from_mkad_or_metro', '>=', (int)$distance_from_mkad_or_metro_min);
        } elseif ($distance_from_mkad_or_metro_max) {
            $query->where('distance_from_mkad_or_metro', '<=', (int)$distance_from_mkad_or_metro_max);
        }
        
        $space_min = isset($_POST['space']) ? $_POST['space'] : '';
        $space_max = isset($_POST['space']) ? $_POST['space'] : '';
        if ($space_min && $space_max) {
            $query->where('space', 'between', [(int)$space_min, (int)$space_max]);
        } elseif ($space_min) {
            $query->where('space', '>=', (int)$space_min);
        } elseif ($space_max) {
            $query->where('space', '<=', (int)$space_max);
        }
        
        $electricity_min = isset($_POST['electricity']) ? $_POST['electricity'] : '';
        $electricity_max = isset($_POST['electricity']) ? $_POST['electricity'] : '';
        if ($electricity_min && $electricity_max) {
            $query->where('electricity', 'between', [(int)$electricity_min, (int)$electricity_max]);
        } elseif ($electricity_min) {
            $query->where('electricity', '>=', (int)$electricity_min);
        } elseif ($electricity_max) {
            $query->where('electricity', '<=', (int)$electricity_max);
        }
        
        $bathroom_number_min = isset($_POST['bathroom_number']) ? $_POST['bathroom_number'] : '';
        $bathroom_number_max = isset($_POST['bathroom_number']) ? $_POST['bathroom_number'] : '';
        if ($bathroom_number_min && $bathroom_number_max) {
            $query->where('bathroom_number', 'between', [(int)$bathroom_number_min, (int)$bathroom_number_max]);
        } elseif ($bathroom_number_min) {
            $query->where('bathroom_number', '>=', (int)$bathroom_number_min);
        } elseif ($bathroom_number_max) {
            $query->where('bathroom_number', '<=', (int)$bathroom_number_max);
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
}
