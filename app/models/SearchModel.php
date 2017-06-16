<?php

class SearchModel extends Model
{
    // Массив соответствия ключа поиска к названию колонки в таблице
    private $keys = [
        // Тип операции (int)
        'tabs'                => [
            'table_column_name' => 'operation_type',
            'filter_type'       => 'in',
        ],

        // TODO: Неизвестно к чему относится
        'blah'                => [
            'table_column_name' => '',
            'filter_type'       => '',
        ],

        // Цена от-до (int)
        'price'                => [
            'table_column_name' => 'price',
            'filter_type'       => 'between',
        ],

        // Город (string)
        'city'                 => [
            'table_column_name' => 'city',
            'filter_type'       => '',
        ],

        // Нет комиссии (bool)
        'non-commission'       => [
            'table_column_name' => 'non_commission',
            'filter_type'       => 'bool',
        ],

        // Торг (bool)
        'bargain'              => [
            'table_column_name' => 'bargain',
            'filter_type'       => 'bool',
        ],

        // Тип недвижимости (int)
        'type'                 => [
            'table_column_name' => 'object_type',
            'filter_type'       => 'in',
        ],

        // Срок аренды (int)
        'term'                 => [
            'table_column_name' => 'lease',
            'filter_type'       => 'in',
        ],

        // Количество комнат (int)
        'count_rooms'          => [
            'table_column_name' => 'number_of_rooms',
            'filter_type'       => 'in',
        ],

        // Количество комнат от-до (int)
        'count_rooms_num'      => [
            'table_column_name' => 'number_of_rooms',
            'filter_type'       => 'between',
        ],

        // Площадь от-до (int)
        'area_only'            => [
            'table_column_name' => 'space',
            'filter_type'       => 'between',
        ],

        // TODO: Спорный момент
        // Площадь (простой поиск) (int)
        'area'            => [
            'table_column_name' => 'space',
            'filter_type'       => '',
        ],

        // Площадь жилая от-до (int)
        'area_residential'     => [
            'table_column_name' => 'residential',
            'filter_type'       => 'between',
        ],

        // Площадь нежилая от-до (int)
        'area_non_residential' => [
            'table_column_name' => 'not_residential',
            'filter_type'       => 'between',
        ],

        // Площадь общая от-до (int)
        'area_general'         => [
            'table_column_name' => 'common',
            'filter_type'       => 'between',
        ],

        // Площадь балкона от-до (int)
        'area_balcony'         => [
            'table_column_name' => 'balcony',
            'filter_type'       => 'between',
        ],

        // Высота потолков от-до (int)
        'height_ceiling'       => [
            'table_column_name' => 'ceiling_height',
            'filter_type'       => 'between',
        ],

        // Этаж от-до (int)
        'floor'                => [
            'table_column_name' => 'floor',
            'filter_type'       => 'between',
        ],

        // Санузел (int)
        'bathroom'             => [
            'table_column_name' => 'lavatory',
            'filter_type'       => 'in',
        ],

        // Спальня (bool)
        'rooms_0'              => [
            'table_column_name' => 'bedroom',
            'filter_type'       => 'bool',
        ],

        // Кухня (bool)
        'rooms_1'              => [
            'table_column_name' => 'kitchen',
            'filter_type'       => 'bool',
        ],

        // Гостиная (bool)
        'rooms_2'              => [
            'table_column_name' => 'living_room',
            'filter_type'       => 'bool',
        ],

        // Прихожая (bool)
        'rooms_3'              => [
            'table_column_name' => 'hallway',
            'filter_type'       => 'bool',
        ],

        // Детская (bool)
        'rooms_4'              => [
            'table_column_name' => 'playroom',
            'filter_type'       => 'bool',
        ],

        // Рабочий кабинет (bool)
        'rooms_5'              => [
            'table_column_name' => 'study',
            'filter_type'       => 'bool',
        ],

        // Столовая (bool)
        'rooms_6'              => [
            'table_column_name' => 'dining_room',
            'filter_type'       => 'bool',
        ],

        // Ванная (bool)
        'rooms_7'              => [
            'table_column_name' => 'bathroom',
            'filter_type'       => 'bool',
        ],

        // Комплектация (bool)
        'equipment'            => [
            'table_column_name' => 'equipment',
            'filter_type'       => 'bool',
        ],

        // Отделка (int)
        'decoration'           => [
            'table_column_name' => 'furnish',
            'filter_type'       => 'in',
        ],

        // Количество этажей от-до (int)
        'count_floors'         => [
            'table_column_name' => 'number_of_floors',
            'filter_type'       => 'between',
        ],

        // Лифт (int)
        'lift'                 => [
            'table_column_name' => 'elevator',
            'filter_type'       => 'in',
        ],

        // Наличие мусоропровода (bool)
        'garbage'              => [
            'table_column_name' => 'availability_of_garbage_chute',
            'filter_type'       => 'bool',
        ],

        // Уточнение вида объекта (int)
        'object_type'          => [
            'table_column_name' => 'clarification_of_the_object_type',
            'filter_type'       => 'in',
        ],

        'object_type_plot'    => [
            'table_column_name' => 'clarification_of_the_object_type',
            'filter_type'       => 'in',
        ],

        // Год постройки/окончания строительства от-до (int)
        'year_building'       => [
            'table_column_name' => 'year_of_construction',
            'filter_type'       => 'between',
        ],

        // Отопление (bool)
        'hc_services_0'       => [
            'table_column_name' => 'heating',
            'filter_type'       => 'bool',
        ],

        // Газ (bool)
        'hc_services_1'       => [
            'table_column_name' => 'gas',
            'filter_type'       => 'bool',
        ],

        // Электричество (bool)
        'hc_services_2'       => [
            'table_column_name' => 'electricity',
            'filter_type'       => 'bool',
        ],

        // Водопровод (bool)
        'hc_services_3'       => [
            'table_column_name' => 'water_pipes',
            'filter_type'       => 'bool',
        ],

        // Электричество (bool)
        'hc_services_nr_0'    => [
            'table_column_name' => 'electricity',
            'filter_type'       => 'bool',
        ],

        // Водопровод и канализация (bool)
        'hc_services_nr_1'    => [
            'table_column_name' => 'sanitation',
            'filter_type'       => 'bool',
        ],

        // Наличие санузлов (bool)
        'hc_services_nr_2'    => [
            'table_column_name' => 'bathroom_available',
            'filter_type'       => 'bool',
        ],

        // Парковка (int)
        'parking'             => [
            'table_column_name' => 'parking',
            'filter_type'       => 'in',
        ],

        // Материал стен (int)
        'wall_material'       => [
            'table_column_name' => 'wall_material',
            'filter_type'       => 'in',
        ],

        // Состояние лестничных клеток (int)
        'state_stairs'        => [
            'table_column_name' => 'stairwells_status',
            'filter_type'       => 'in',
        ],

        // Консьерж (bool)
        'security_0'          => [
            'table_column_name' => 'concierge',
            'filter_type'       => 'bool',
        ],

        // Охрана (bool)
        'security_1'          => [
            'table_column_name' => 'security',
            'filter_type'       => 'bool',
        ],

        // Домофон (bool)
        'security_2'          => [
            'table_column_name' => 'intercom',
            'filter_type'       => 'bool',
        ],

        // Видеонаблюдение (bool)
        'security_3'          => [
            'table_column_name' => 'cctv',
            'filter_type'       => 'bool',
        ],

        // Сигнализация (bool)
        'security_4'          => [
            'table_column_name' => 'signaling',
            'filter_type'       => 'bool',
        ],

        // Кровля (int)
        'roofing'             => [
            'table_column_name' => 'roofing',
            'filter_type'       => 'in',
        ],

        // Фундамент (int)
        'foundation'          => [
            'table_column_name' => 'foundation',
            'filter_type'       => 'in',
        ],

        // Материал стен дома (int)
        'wall_material_house' => [
            'table_column_name' => 'wall_material',
            'filter_type'       => 'in',
        ],

        // Тип дома (int)
        'type_house'          => [
            'table_column_name' => 'type_of_house',
            'filter_type'       => 'in',
        ],

        // Вид постройки (int)
        'view_buildings'      => [
            'table_column_name' => 'type_of_construction',
            'filter_type'       => 'in',
        ],

        // Тип здания (int)
        'type_buildings'      => [
            'table_column_name' => 'building_type',
            'filter_type'       => 'in',
        ],

        // Беседка (bool)
        'add_buildings_0'     => [
            'table_column_name' => 'alcove',
            'filter_type'       => 'bool',
        ],

        // Сарай (bool)
        'add_buildings_1'     => [
            'table_column_name' => 'barn',
            'filter_type'       => 'bool',
        ],

        // Винный погреб (bool)
        'add_buildings_2'     => [
            'table_column_name' => 'wine_vault',
            'filter_type'       => 'bool',
        ],

        // Детская площадка (bool)
        'add_buildings_3'     => [
            'table_column_name' => 'playground',
            'filter_type'       => 'bool',
        ],

        // Бассейн (bool)
        'add_buildings_4'     => [
            'table_column_name' => 'swimming_pool',
            'filter_type'       => 'bool',
        ],

        // Баня (bool)
        'add_buildings_5'     => [
            'table_column_name' => 'bath',
            'filter_type'       => 'bool',
        ],

        // Гостевой дом (bool)
        'add_buildings_6'     => [
            'table_column_name' => 'guest_house',
            'filter_type'       => 'bool',
        ],

        // Сторожка (bool)
        'add_buildings_7'     => [
            'table_column_name' => 'lodge',
            'filter_type'       => 'bool',
        ],

        // Участок (int)
        'plot'                => [
            'table_column_name' => 'site',
            'filter_type'       => 'in',
        ],

        // Лесные деревья (bool)
        'on_plot_0'           => [
            'table_column_name' => 'forest_trees',
            'filter_type'       => 'bool',
        ],

        // Садовые деревья (bool)
        'on_plot_1'           => [
            'table_column_name' => 'garden_trees',
            'filter_type'       => 'bool',
        ],

        // Родник (bool)
        'on_plot_2'           => [
            'table_column_name' => 'spring',
            'filter_type'       => 'bool',
        ],

        // Река (bool)
        'on_plot_3'           => [
            'table_column_name' => 'river',
            'filter_type'       => 'bool',
        ],

        // Берег водоема (bool)
        'on_plot_4'           => [
            'table_column_name' => 'waterfront',
            'filter_type'       => 'bool',
        ],

        // Ограждение (int)
        'guardrail'           => [
            'table_column_name' => 'fencing',
            'filter_type'       => 'in',
        ],

        // Объект размещен (int)
        'hosted'              => [
            'table_column_name' => 'object_located',
            'filter_type'       => 'in',
        ],

        // Документы на право владения (string)
        'documents_0'         => [
            'table_column_name' => 'documents_on_tenure',
            'filter_type'       => '!null',
        ],

        // Договор аренды (string)
        'documents_1'         => [
            'table_column_name' => 'lease_contract',
            'filter_type'       => '!null',
        ],

        // Документы на собственность (string)
        'documents_2'         => [
            'table_column_name' => 'property_documents',
            'filter_type'       => '!null',
        ],

        // Проект планировки (string)
        'project'             => [
            'table_column_name' => 'planning_project',
            'filter_type'       => '!null',
        ],

        // 3D проект (string)
        'project3d'           => [
            'table_column_name' => 'three_d_project',
            'filter_type'       => '!null',
        ],

        // Видео (string)
        'video'               => [
            'table_column_name' => 'video',
            'filter_type'       => '!null',
        ],
    ];
    // Ключи значениям которых соответствуют разные колонки в таблице
    private $multipleColumns = [
        'rooms',
        'hc_services',
        'hc_services_nr',
        'security',
        'add_buildings',
        'on_plot',
        'documents',
    ];
    // Полученные объявления
    private $Ads;
    private $sql = 'SELECT * FROM news_base WHERE';

    public function fetchAdsCount($filters)
    {
        $this->sql = 'SELECT count(*) FROM news_base WHERE';
        $this->fetchAds($filters);
    }

    /**
     * Метод выбирает объявления исходя из заданных фильтров
     *
     * @param array $filters передать сюда $_GET или $_POST с фильтрами
     */
    public function fetchAds($filters)
    {
        // Обрабатываем первый фильтр и добвляем его в запрос
        $firstKey    = key($filters);
        $firstFilter = array_shift($filters);
        $this->addFilter($firstKey, $firstFilter, true);

        // Обрабатываем оставшиеся фильтры
        foreach ($filters as $key => $filter) {
            $this->addFilter($key, $filter);
        }

        // Выполняем запрос и записываем результаты в $this->Ads
        $this->sql .= " ORDER BY price LIMIT 100";
        $query = $this->db->prepare($this->sql);
        $query->execute();
        $this->Ads = $query->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * @param $key - ключ элемента присланный в запросе
     * @param $filter
     * @param bool $first - передеать true если обрабатывается первый фильтр,
     * необходимо для правильного составления запроса
     */
    private function addFilter($key, $filter, $first = false)
    {
        if (empty($filter) && $filter != '0' || is_array($filter) && empty($filter['from']) && empty($filter['to'])) {
            return;
        }

        if (in_array($key, $this->multipleColumns)) {
            $arr = explode(',', $filter);

            foreach ($arr as $number) {
                $column = $this->keys[$key . '_' .  $number]['table_column_name'];
                $type = $this->keys[$key . '_' .  $number]['filter_type'];

                if ($first) {
                    switch ($type) {
                        case 'bool':
                            $this->sql .= " {$column} = true";
                            break;
                        case '!null':
                            $this->sql .= " {$column} IS NOT NULL";
                            break;
                    }
                } else {
                    switch ($type) {
                        case 'bool':
                            $this->sql .= " AND {$column} = true";
                            break;
                        case '!null':
                            $this->sql .= " AND {$column} IS NOT NULL";
                            break;
                    }
                }
            }
        } else if (isset($this->keys[$key])) {
            $column = $this->keys[$key]['table_column_name'];
            $type = $this->keys[$key]['filter_type'];

            if ($first) {
                switch ($type) {
                    case 'between':
                        $this->sql .= " {$column} BETWEEN {$filter['from']} AND {$filter['to']}";
                        break;
                    case 'in':
                        $this->sql .= " {$column} IN({$filter})";
                        break;
                    case 'bool':
                        $this->sql .= " {$column} = true";
                        break;
                    case '!null':
                        $this->sql .= " {$column} IS NOT NULL";
                        break;
                }
            } else {
                switch ($type) {
                    case 'between':
                        $this->sql .= " AND {$column} BETWEEN {$filter['from']} AND {$filter['to']}";
                        break;
                    case 'in':
                        $this->sql .= " AND {$column} IN({$filter})";
                        break;
                    case 'bool':
                        $this->sql .= " OR {$column} = true";
                        break;
                    case '!null':
                        $this->sql .= " AND {$column} IS NOT NULL";
                        break;
                }
            }
        }
    }

    /**
     * @return mixed полученные объявления с помощью $this->fetchAds()
     */
    public function getAds()
    {
        return $this->Ads;
    }
}
