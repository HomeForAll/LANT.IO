<?php

class SearchModel extends Model
{
    // Массив соответствия ключа поиска к названию колонки в таблице
    private $indexes = [
        // Количество комнат
        'count_rooms'          => '',
        // Количество комнат от-до
        'count_rooms_num'      => 'count_of_rooms',
        // Площадь от-до
        'area_only'            => '',
        // Площадь жилая от-до
        'area_residential'     => '',
        // Площадь нежилая от-до
        'area_non_residential' => '',
        // Площадь общая от-до
        'area_general'         => '',
        // Плозадь балкона от-до
        'area_balcony'         => '',
        // Высота потолков от-до
        'height_ceiling'       => '',
        // Этаж от-до
        'floor'                => '',
        // Санузел
        'bathroom'             => 'bathroom',
        // Комнаты
        'rooms_0'              => '', // Спальня
        'rooms_1'              => '', // Кухня
        'rooms_2'              => '', // Гостиная
        'rooms_3'              => '', // Прихожая
        'rooms_4'              => '', // Детская
        'rooms_5'              => '', // Рабочий кабинет
        'rooms_6'              => '', // Столовая
        'rooms_7'              => '', // Ванная
        // Комплектация
        'equipment'            => '',
        // Отделка
        'decoration'           => 'decoration',
        // Количество этажей от-до
        'count_floors'         => '',
        // Лифт
        'lift'                 => '',
        // Наличие мусоропровода
        'garbage'              => '',
        // Уточнение вида объекта
        'object_type'          => '',
        'object_type_plot'     => '',
        // Год постройки/окончания строительства
        'year_building'        => '',
        // Жилищно-коммунальные услуги
        'hc_services_0'        => '', // Отопление
        'hc_services_1'        => '', // Газ
        'hc_services_2'        => '', // Электричество
        'hc_services_3'        => '', // Водопровод
        
        'hc_services_nr_0'    => '', // Электричество
        'hc_services_nr_1'    => '', // Водопровод и канализация
        'hc_services_nr_2'    => '', // Наличие санузлов
        // Парковка
        'parking'             => '',
        // Материал стен
        'wall_material'       => '',
        // Состояние лестничных клеток
        'state_stairs'        => '',
        // Безопасность
        'security_0'          => '', // Консьерж
        'security_1'          => '', // Охрана
        'security_2'          => '', // Домофон
        'security_3'          => '', // Видеонаблюдение
        'security_4'          => '', // Сигнализация
        // Кровля
        'roofing'             => '',
        // Фундамент
        'foundation'          => '',
        // Материал стен дома
        'wall_material_house' => '',
        // Тип дома
        'type_house'          => '',
        // Вид постройки
        'view_buildings'      => '',
        // Тип здания
        'type_buildings'      => '',
        // Дополнительные строения
        'add_buildings_0'     => '', // Беседка
        'add_buildings_1'     => '', // Сарай
        'add_buildings_2'     => '', // Винный погреб
        'add_buildings_3'     => '', // Детская площадка
        'add_buildings_4'     => '', // Бассейн
        'add_buildings_5'     => '', // Баня
        'add_buildings_6'     => '', // Гостевой дом
        'add_buildings_7'     => '', // Сторожка
        // Участок
        'plot'                => '',
        // На участке
        'on_plot_0'           => '', // Лесные деревья
        'on_plot_1'           => '', // Садовые деревья
        'on_plot_2'           => '', // Родник
        'on_plot_3'           => '', // Река
        'on_plot_4'           => '', // Берег водоема
        // Ограждение
        'guardrail'           => '',
        // Объект размещен
        'hosted'              => '',
        // Документы
        'documents'           => '',
        // Проект планировки
        'project'             => '',
        // 3D проект
        'project3d'           => '',
        // Видео
        'video'               => '',
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
        $column = $this->indexes[$key];
        
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
