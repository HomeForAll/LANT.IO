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

    // Загрузка файлов
    const NO_FILE_ERROR = 3000;
    const FILE_NOT_UPLOADED_ERROR = 3001;
    const NOT_IMAGE_ERROR = 3002;
    const FILE_NOT_PROCESSED_ERROR = 3003;

    // Восстановлени пароля
    const EMAIL_MESSAGE_SEND_ERROR = 6000;

    protected $messages = [
        // Общие 1-1000:
        0    => 'Неправильный запрос к API',
        1    => 'Пользователь не авторизован',
        2    => 'Ошибка записи в базу данных',
        3    => 'Возникла ошибка при обновлении в базе данных',
        4    => 'Возникла ошибка при удалении в базе данных',
        5    => 'Возникла ошибка при выборке из базы данных',
        6    => 'CURL нет соединения с сервером',

        // Авторизация 1000-2000:
        1000 => 'Неверный формат логина',
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

        // Загрузка файлов 3000-4000:
        3000 => 'Отсутствуют файлы для загрузки',
        3001 => 'Файл небыл загружен',
        3002 => 'Файл не является картинкой',
        3003 => 'Файл не является картинкой',

        // Восстановление пароля 6000-7000
        6000 => 'Ошибка при отправке Email',
    ];

    public function __construct()
    {
    }

    /**
     * @param int $code
     * @param mixed $detail - дополнительная информация, которая поможет идентифицировать ошибку
     */
    protected function error($code, $detail = null)
    {
        $code = (int)$code;
        $content = [];

        if (isset($this->messages[$code])) {
            $content['error'] = [
                'code'    => $code,
                'message' => $this->messages[$code],
            ];
        } else {
            $content['error'] = [
                'code'    => -666,
                'message' => 'Неопознанная ошибка',
            ];
        }

        if ($detail) {
            $content['error']['detail'] = $detail;
        }

        exit(json_encode($content, JSON_UNESCAPED_UNICODE));
    }

    protected function response($data)
    {
        exit(json_encode(['response' => $data], JSON_UNESCAPED_UNICODE));
    }
}