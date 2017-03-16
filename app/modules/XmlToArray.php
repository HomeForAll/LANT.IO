<?php
class XmlToArray
{
    var $xml = '';

    function XmlToArray($xml)
    {
        $this->xml = $xml;
    }

    function _struct_to_array($values, &$i)
    {
        $child = array();
        if (isset($values[$i]['value'])) array_push($child, $values[$i]['value']);
        while ($i++ < count($values)) {
            switch ($values[$i]['type']) {
                case 'cdata':
                    array_push($child, $values[$i]['value']);
                    break;

                case 'complete':
                    $name = $values[$i]['tag'];
                    if (!empty($name)) {
                        $child[$name] = ($values[$i]['value']) ? ($values[$i]['value']) : '';
                        if (isset($values[$i]['attributes'])) {
                            $child[$name] = $values[$i]['attributes'];
                        }
                    }
                    break;
                case 'open':
                    $name = $values[$i]['tag'];
                    $size = isset($child[$name]) ? sizeof($child[$name]) : 0;
                    $child[$name][$size] = $this->_struct_to_array($values, $i);
                    break;
                case 'close':
                    return $child;
                    break;
            }
        }
        return $child;
    }

    function createArray()
    {
        $xml = $this->xml;
        $values = array();
        $index = array();
        $array = array();
        $parser = xml_parser_create();
        xml_parser_set_option($parser, XML_OPTION_SKIP_WHITE, 1);
        xml_parser_set_option($parser, XML_OPTION_CASE_FOLDING, 0);
        xml_parse_into_struct($parser, $xml, $values, $index);
        xml_parser_free($parser);
        $i = 0;
        $name = $values[$i]['tag'];
        $array[$name] = isset($values[$i]['attributes']) ? $values[$i]['attributes'] : '';
        $array[$name] = $this->_struct_to_array($values, $i);
        return $array;
    }
}

function geoip_client($ip, $opt, $sid)
{
// Делаем запрос к серверу
    if ($xml = file_get_contents('http://geoip.top/cgi-bin/getdata.pl?ip=' . $ip . '&hex=' . $opt . '&sid=' . $sid)) {
        $xmlObj = new XmlToArray($xml); // преобразуем xml в массив
        $arrayData = $xmlObj->createArray();

// если есть ошибки выбрасываем исключения
        if (isset($arrayData['GeoIP']['GeoAddr'][0]['Error'])) {
            switch ($arrayData['GeoIP']['GeoAddr'][0]['Error']) {
                case 0:
                    ;
                    break;
                case 10:
                    throw new Exception('Geo_IP: Неверная длина указанного адреса');
                    break;
                case 11:
                    throw new Exception('Geo_IP: Неверный формат адреса');
                    break;
                case 150:
                    throw new Exception('Geo_IP: Внутренняя ошибка сервера');
                    break;
                case 162:
                    throw new Exception('Geo_IP: Идентификатор сайта не указан');
                    break;
                case 163:
                    throw new Exception('Geo_IP: Идентификатор сайта содержит ошибку или не зарегистрирован');
                    break;
                case 200:
                    throw new Exception('Geo_IP: Ошибка соединения с сервером');
                    break;
                case 205:
                    throw new Exception('Geo_IP: Нет данных по запросу');
                    break;
            }
        }
// возвращаем полученные данные в виде массива
        return $arrayData['GeoIP']['GeoAddr'][0];
    } else {
// если ответа от сервера не дождались вбрасываем исключение
        throw new Exception('Geo_IP: Нет связи с сервером');
    }

}

