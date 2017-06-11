<?php

class SearchModel extends Model
{
    // Массив соответствия ключа поиска к названию колонки в таблице
    private $keys = [
        // Цена (int)
        'price'                => [
            'table_column_name' => 'price',
            'filter_type'       => '',
        ],
        
        // Город (string)
        'city'                 => [
            'table_column_name' => 'city',
            'filter_type'       => '',
        ],
        
        // Нет комиссии (bool)
        'non-commission'       => [
            'table_column_name' => 'non_commission',
            'filter_type'       => '',
        ],
        
        // Торг (bool)
        'bargain'              => [
            'table_column_name' => 'bargain',
            'filter_type'       => '',
        ],
        
        // Тип недвижимости (int)
        'type'                 => [
            'table_column_name' => 'object_type',
            'filter_type'       => '',
        ],
        
        // Срок аренды (int)
        'term'                 => [
            'table_column_name' => 'lease',
            'filter_type'       => '',
        ],
        
        // Количество комнат (int)
        'count_rooms'          => [
            'table_column_name' => 'number_of_rooms',
            'filter_type'       => '',
        ],
        
        // Количество комнат от-до (int)
        'count_rooms_num'      => [
            'table_column_name' => 'number_of_rooms',
            'filter_type'       => '',
        ],
        
        // Площадь от-до (int)
        'area_only'            => [
            'table_column_name' => 'space',
            'filter_type'       => '',
        ],
        
        // Площадь жилая от-до (int)
        'area_residential'     => [
            'table_column_name' => 'residential',
            'filter_type'       => '',
        ],
        
        // Площадь нежилая от-до (int)
        'area_non_residential' => [
            'table_column_name' => 'not_residential',
            'filter_type'       => '',
        ],
        
        // Площадь общая от-до (int)
        'area_general'         => [
            'table_column_name' => 'common',
            'filter_type'       => '',
        ],
        
        // Площадь балкона от-до (int)
        'area_balcony'         => [
            'table_column_name' => 'balcony',
            'filter_type'       => '',
        ],
        
        // Высота потолков от-до (int)
        'height_ceiling'       => [
            'table_column_name' => 'ceiling_height',
            'filter_type'       => '',
        ],
        
        // Этаж от-до (int)
        'floor'                => [
            'table_column_name' => 'floor',
            'filter_type'       => '',
        ],
        
        // Санузел (bool)
        'bathroom'             => [
            'table_column_name' => 'lavatory',
            'filter_type'       => '',
        ],
        
        // Спальня (bool)
        'rooms_0'              => [
            'table_column_name' => 'bedroom',
            'filter_type'       => '',
        ],
        
        // Кухня (bool)
        'rooms_1'              => [
            'table_column_name' => 'kitchen',
            'filter_type'       => '',
        ],
        
        // Гостиная (bool)
        'rooms_2'              => [
            'table_column_name' => 'living_room',
            'filter_type'       => '',
        ],
        
        // Прихожая (bool)
        'rooms_3'              => [
            'table_column_name' => 'hallway',
            'filter_type'       => '',
        ],
        
        // Детская (bool)
        'rooms_4'              => [
            'table_column_name' => 'playroom',
            'filter_type'       => '',
        ],
        
        // Рабочий кабинет (bool)
        'rooms_5'              => [
            'table_column_name' => 'study',
            'filter_type'       => '',
        ],
        
        // Столовая (bool)
        'rooms_6'              => [
            'table_column_name' => 'dining_room',
            'filter_type'       => '',
        ],
        
        // Ванная (bool)
        'rooms_7'              => [
            'table_column_name' => 'bathroom',
            'filter_type'       => '',
        ],
        
        // Комплектация (bool)
        'equipment'            => [
            'table_column_name' => 'equipment',
            'filter_type'       => '',
        ],
        
        // Отделка (int)
        'decoration'           => [
            'table_column_name' => 'furnish',
            'filter_type'       => '',
        ],
        
        // Количество этажей от-до (int)
        'count_floors'         => [
            'table_column_name' => 'number_of_floors',
            'filter_type'       => '',
        ],
        
        // Лифт (int)
        'lift'                 => [
            'table_column_name' => 'elevator',
            'filter_type'       => '',
        ],
        
        // Наличие мусоропровода (bool)
        'garbage'              => [
            'table_column_name' => 'availability_of_garbage_chute',
            'filter_type'       => '',
        ],
        
        // Уточнение вида объекта (int)
        'object_type'          => [
            'table_column_name' => 'clarification_of_the_object_type',
            'filter_type'       => '',
        ],
        
        'object_type_plot'    => [
            'table_column_name' => 'clarification_of_the_object_type',
            'filter_type'       => '',
        ],
        
        // Год постройки/окончания строительства (int)
        'year_building'       => [
            'table_column_name' => 'year_of_construction',
            'filter_type'       => '',
        ],
        
        // Отопление (bool)
        'hc_services_0'       => [
            'table_column_name' => 'heating',
            'filter_type'       => '',
        ],
        
        // Газ (bool)
        'hc_services_1'       => [
            'table_column_name' => 'gas',
            'filter_type'       => '',
        ],
        
        // Электричество (bool)
        'hc_services_2'       => [
            'table_column_name' => 'electricity',
            'filter_type'       => '',
        ],
        
        // Водопровод (bool)
        'hc_services_3'       => [
            'table_column_name' => 'water_pipes',
            'filter_type'       => '',
        ],
        
        // Электричество (bool)
        'hc_services_nr_0'    => [
            'table_column_name' => 'electricity',
            'filter_type'       => '',
        ],
        
        // Водопровод и канализация (bool)
        'hc_services_nr_1'    => [
            'table_column_name' => 'sanitation',
            'filter_type'       => '',
        ],
        
        // Наличие санузлов (bool)
        'hc_services_nr_2'    => [
            'table_column_name' => 'bathroom_available',
            'filter_type'       => '',
        ],
        
        // Парковка (int)
        'parking'             => [
            'table_column_name' => 'parking',
            'filter_type'       => '',
        ],
        
        // Материал стен (int)
        'wall_material'       => [
            'table_column_name' => 'wall_material',
            'filter_type'       => '',
        ],
        
        // Состояние лестничных клеток (int)
        'state_stairs'        => [
            'table_column_name' => 'stairwells_status',
            'filter_type'       => '',
        ],
        
        // Консьерж (bool)
        'security_0'          => [
            'table_column_name' => 'concierge',
            'filter_type'       => '',
        ],
        
        // Охрана (bool)
        'security_1'          => [
            'table_column_name' => 'security',
            'filter_type'       => '',
        ],
        
        // Домофон (bool)
        'security_2'          => [
            'table_column_name' => 'intercom',
            'filter_type'       => '',
        ],
        
        // Видеонаблюдение (bool)
        'security_3'          => [
            'table_column_name' => 'cctv',
            'filter_type'       => '',
        ],
        
        // Сигнализация (bool)
        'security_4'          => [
            'table_column_name' => 'signaling',
            'filter_type'       => '',
        ],
        
        // Кровля (int)
        'roofing'             => [
            'table_column_name' => 'roofing',
            'filter_type'       => '',
        ],
        
        // Фундамент (int)
        'foundation'          => [
            'table_column_name' => 'foundation',
            'filter_type'       => '',
        ],
        
        // Материал стен дома (int)
        'wall_material_house' => [
            'table_column_name' => 'wall_material',
            'filter_type'       => '',
        ],
        
        // Тип дома (int)
        'type_house'          => [
            'table_column_name' => 'type_of_house',
            'filter_type'       => '',
        ],
        
        // Вид постройки (int)
        'view_buildings'      => [
            'table_column_name' => 'type_of_construction',
            'filter_type'       => '',
        ],
        
        // Тип здания (int)
        'type_buildings'      => [
            'table_column_name' => 'building_type',
            'filter_type'       => '',
        ],
        
        // Беседка (bool)
        'add_buildings_0'     => [
            'table_column_name' => 'alcove',
            'filter_type'       => '',
        ],
        
        // Сарай (bool)
        'add_buildings_1'     => [
            'table_column_name' => 'barn',
            'filter_type'       => '',
        ],
        
        // Винный погреб (bool)
        'add_buildings_2'     => [
            'table_column_name' => 'wine_vault',
            'filter_type'       => '',
        ],
        
        // Детская площадка (bool)
        'add_buildings_3'     => [
            'table_column_name' => 'playground',
            'filter_type'       => '',
        ],
        
        // Бассейн (bool)
        'add_buildings_4'     => [
            'table_column_name' => 'swimming_pool',
            'filter_type'       => '',
        ],
        
        // Баня (bool)
        'add_buildings_5'     => [
            'table_column_name' => 'bath',
            'filter_type'       => '',
        ],
        
        // Гостевой дом (bool)
        'add_buildings_6'     => [
            'table_column_name' => 'guest_house',
            'filter_type'       => '',
        ],
        
        // Сторожка (bool)
        'add_buildings_7'     => [
            'table_column_name' => 'lodge',
            'filter_type'       => '',
        ],
        
        // Участок (int)
        'plot'                => [
            'table_column_name' => 'site',
            'filter_type'       => '',
        ],
        
        // Лесные деревья (bool)
        'on_plot_0'           => [
            'table_column_name' => 'forest_trees',
            'filter_type'       => '',
        ],
        
        // Садовые деревья (bool)
        'on_plot_1'           => [
            'table_column_name' => 'garden_trees',
            'filter_type'       => '',
        ],
        
        // Родник (bool)
        'on_plot_2'           => [
            'table_column_name' => 'spring',
            'filter_type'       => '',
        ],
        
        // Река (bool)
        'on_plot_3'           => [
            'table_column_name' => 'river',
            'filter_type'       => '',
        ],
        
        // Берег водоема (bool)
        'on_plot_4'           => [
            'table_column_name' => 'waterfront',
            'filter_type'       => '',
        ],
        
        // Ограждение (int)
        'guardrail'           => [
            'table_column_name' => 'fencing',
            'filter_type'       => '',
        ],
        
        // Объект размещен (int)
        'hosted'              => [
            'table_column_name' => 'object_located',
            'filter_type'       => '',
        ],
        
        // Документы на право владения (string)
        'documents_0'         => [
            'table_column_name' => 'documents_on_tenure',
            'filter_type'       => '',
        ],
        
        // Договор аренды (string)
        'documents_1'         => [
            'table_column_name' => 'lease_contract',
            'filter_type'       => '',
        ],
        
        // Документы на собственность (string)
        'documents_2'         => [
            'table_column_name' => 'property_documents',
            'filter_type'       => '',
        ],
        
        // Проект планировки (string)
        'project'             => [
            'table_column_name' => 'planning_project',
            'filter_type'       => '',
        ],
        
        // 3D проект (string)
        'project3d'           => [
            'table_column_name' => 'three_d_project',
            'filter_type'       => '',
        ],
        
        // Видео (string)
        'video'               => [
            'table_column_name' => 'video',
            'filter_type'       => '',
        ],
    ];
    // Ключи значениям которых соответствуют разные колонки в таблице
    private $differentColumns = [
        'rooms',
        'hc_services',
        'hc_services_nr',
        'security',
        'add_buildings',
        'on_plot',
    ];
    // Полученные объявления
    private $Ads;
    
    /**
     * Метод выбирает объявления исходя из заданных фильтров
     *
     * @param array $filters передать сюда $_GET или $_POST с фильтрами
     */
    public function fetchAds($filters)
    {
        $sql = 'SELECT * FROM news_base WHERE';
        
        // Обрабатываем первый фильтр и добвляем его в запрос
        $firstKey    = key($filters);
        $firstFilter = array_shift($filters);
        $this->addFilter($firstKey, $firstFilter, $sql, true);
        
        // Обрабатываем оставшиеся фильтры
        foreach ($filters as $k => $filter) {
            $this->addFilter($k, $filter, $sql);
        }
        
        // Выполняем запрос и записываем результаты в $this->Ads
        // TODO: Дописать
        echo $sql . '<br>';
        
        $query = $this->db->prepare($sql);
        $query->execute();
        $this->Ads = $query->fetchAll();
    }
    
    private function addFilter($key, $filter, &$sql, $f = false)
    {
        $column = $this->keys[$key]['table_column_name'];
        
        if ($f) {
            if (is_array($filter)) {
                $sql .= " {$column} BETWEEN {$filter['from']} AND {$filter['to']}";
            } else {
                $sql .= " {$column} IN('{$filter}')";
            }
        } else {
            if (is_array($filter)) {
                $sql .= " OR {$column} BETWEEN {$filter['from']} AND {$filter['to']}";
            } else {
                $sql .= " OR {$column} IN('{$filter}')";
            }
        }
    }
    
    public function getAds()
    {
        return $this->Ads;
    }
}
