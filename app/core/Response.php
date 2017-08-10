<?php

class Response
{
    /**
     * КОДЫ
     * ОШИБоК
     * С
     * [0]
     * ПО
     * [6000]
     * ЗАНЯТЫ
     */

    // Общие
    const BAD_REQUEST_ERROR = 0;
    const USER_NOT_AUTHORIZED_ERROR = 1;
    const DB_INSERT_ERROR = 2;
    const DB_UPDATE_ERROR = 3;
    const DB_DELETE_ERROR = 4;
    const DB_SELECT_ERROR = 5;
    const CURL_CONNECTION_LOST = 6;
    const NOT_ARRAY = 7;
    const CHANGE_NOT_YOUR_DATA_ERROR = 8;


    // Авторизация
    const LOGIN_INCORRECT_ERROR = 1000;
    const INCORRECT_AUTH_DATA_ERROR = 1001;
    const USER_BANNED_ERROR = 1002;
    const USER_NOT_EXIST_ERROR = 1003;

    // Регистрация
    const OGRN_INCORRECT_ERROR = 2000;
    const INN_INCORRECT_ERROR = 2001;
    const USER_TYPE_INCORRECT_ERROR = 2002;
    const DOCUMENT_TYPE_INCORRECT_ERROR = 2003;
    const BRAND_INCORRECT_ERROR = 2004;
    const COMPANY_INCORRECT_ERROR = 2005;
    const FIRST_NAME_INCORRECT_ERROR = 2006;
    const PHONE_INCORRECT_ERROR = 2007;
    const SMS_CODE_INCORRECT_ERROR = 2008;
    const EMAIL_INCORRECT_ERROR = 2009;
    const LARGE_PASSWORD_ERROR = 2010;
    const LAST_NAME_INCORRECT_ERROR = 2011;
    const MID_NAME_INCORRECT_ERROR = 2012;
    const EMAIL_IS_EXIST_ERROR = 2013;
    const PHONE_IS_EXIST_ERROR = 2014;
    const SMS_NOT_SENT_ERROR = 2015;
    const SMS_API_REQUEST_FAILED_ERROR = 2016;
    const SOCIAL_NET_DATA_ERROR = 2017;

    // Загрузка файлов
    const NO_FILE_ERROR = 3000;
    const FILE_NOT_UPLOADED_ERROR = 3001;
    const NOT_IMAGE_ERROR = 3002;
    const FILE_NOT_PROCESSED_ERROR = 3003;

    //CabinetModel Диалоги и Профиль
    const INVALID_QWERY_ERROR = 4000;
    const WRONG_PASSWORD_ERROR = 4001;
    const WRONG_NAME_NAME = 4002;
    const WRONG_NAME_SURNAME = 4003;
    const WRONG_NAME_PATRONYMIC = 4004;
    const WRONG_BIRTHDAY = 4005;
    const WRONG_PASSPORT_SERIES = 4006;
    const WRONG_PASSPORT_NUMBER = 4007;
    const WRONG_ADRESS_INDEX = 4008;
    const WRONG_ADRESS_CITY = 4009;
    const WRONG_ADRESS_STREET = 4010;
    const WRONG_ADRESS_HOME = 4011;
    const WRONG_ADRESS_FLAT = 4012;
    const WRONG_PHONE_NUMBER = 4013;
    const WRONG_EMAIL = 4014;

    //Объявления
    const DB_EXECUTE_ERROR = 5000;
    const DATE_INCORRECT_ERROR = 5001;
    const METRO_STATION_INCORRECT_CODE_ERROR = 5002;
    const CITY_INCORRECT_CODE_ERROR = 5003;
    const MISSING_VALUES_IN_AD_RECORDING_POST_FILTER = 5004;

    // Восстановлени пароля
    const EMAIL_MESSAGE_SEND_ERROR = 6000;

    // Настройки профиля
    const GA_SECRET_KEY_NOT_EXIST_ERROR = 7000;
    const GA_CODE_INCORRECT_ERROR = 7001;
    const TMP_HASH_NOT_EXIST_ERROR = 7002;
    const TMP_HASH_INCORRECT_ERROR = 7003;
    const PHONE_NOT_EXIST_ERROR = 7004;

    protected $messages = [
        // Общие 1-1000:
        0 => 'Неправильный запрос к API',
        1 => 'Пользователь не авторизован',
        2 => 'Ошибка записи в базу данных',
        3 => 'Возникла ошибка при обновлении в базе данных',
        4 => 'Возникла ошибка при удалении в базе данных',
        5 => 'Возникла ошибка при выборке из базы данных',
        6 => 'CURL нет соединения с сервером',
        7 => 'Тип данных не является массивом',
        8 => 'Обнаружена попытка модифицировать чужие данные',

        // Авторизация 1000-2000:
        1000 => 'Логин введен неверно',
        1001 => 'Данные для входа неверны',
        1002 => 'Аккаунт заблокирован',
        1003 => 'Пользователь не существует',

        // Регистрация 2000-3000:
        2000 => 'Неправильный формат ОГРН',
        2001 => 'Неправильный формат ИНН',
        2002 => 'Неправильный тип пользователя',
        2003 => 'Неправильный тип документа',
        2004 => 'Неправильный указано название бренда',
        2005 => 'Неправильный указано название компании',
        2006 => 'Неправильный указано имя',
        2007 => 'Допущена ошибка при вооде телефона',
        2008 => 'Неправильный код из СМС',
        2009 => 'Неправильный формат Email',
        2010 => 'Превышена длина пароля в 24 символа',
        2011 => 'Неправильно указана фамилия',
        2012 => 'Неправильно указано отчество',
        2013 => 'Такой Email уже зарегистрирован',
        2014 => 'Такой телефон уже зарегистрирован',
        2015 => 'SMS небыло отправлено',
        2016 => 'Ошибка запроса к SMS.RU',
        2017 => 'Ошибка при получении данных от соц. сетей',

        // Загрузка файлов 3000-4000:
        3000 => 'Отсутствуют файлы для загрузки',
        3001 => 'Файл небыл загружен',
        3002 => 'Файл не является картинкой',
        3003 => 'Файл не является картинкой',

        //CabinetModel Диалоги 4000-5000:
        4000 => 'Не валидный запрос',
        4001 => 'Неправильный пароль',
        4002 => 'Неверно введено имя',
        4003 => 'Неверно введена фамилия',
        4004 => 'Неверно введено отчество',
        4005 => 'Неверно введена дата рождения',
        4006 => 'Неверно введена серия паспорта',
        4007 => 'Неверно введен номер паспорта',
        4008 => 'Неверно введен индекс',
        4009 => 'Неверно введен город',
        4010 => 'Неверно введена улица',
        4011 => 'Неверно введен номер дома',
        4012 => 'Неверно введена номер квартиры',
        4013 => 'Неверно введен номер телефона',
        4014 => 'Неверно введен Email',

        // Объявления 5000-6000
        5000 => 'Ошибка при запросе в БД',
        5001 => 'Неправильная дата',
        5002 => 'Нет соответствующего индекса станции метро в БД',
        5003 => 'Нет соответствующего индекса города в БД',
        5004 => 'Нет соответствия POST данным фильтра при записи объявления',

        // Восстановление пароля 6000-7000
        6000 => 'Ошибка при отправке Email',

        // Настройки профиля 7000-8000
        7000 => 'Сначала необходимо создать Google Authenticator SECRET KEY',
        7001 => 'Неверный Google Authenticator код',
        7002 => 'Отсутствует временный хеш',
        7003 => 'Неверный временный хеш',
        7004 => 'Отсутствует телефон',
    ];

    public function __construct()
    {
    }

    /**
     * @param int $code
     * @param mixed $detail - детальная информация о ошибке
     */
    protected function error($code, $detail = null)
    {
        $code = (int)$code;
        $content = [];

        if (isset($this->messages[$code])) {
            $content['error'] = [
                'code' => $code,
                'message' => $this->messages[$code],
            ];
        } else {
            $content['error'] = [
                'code' => -666,
                'message' => 'Неопознанная ошибка',
            ];
        }

        if (DEBUG) {
            if ($detail) {
                $content['error']['detail'] = $detail;
            }

            $content['error']['trace'] = debug_backtrace();
        }


        exit(json_encode($content, JSON_UNESCAPED_UNICODE));
    }

    protected function response($data = true)
    {
        exit(json_encode(['response' => $data], JSON_UNESCAPED_UNICODE));
    }
}