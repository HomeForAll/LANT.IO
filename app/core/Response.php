<?php

class Response
{
    /**
     * КОДЫ ОШИБоК С 0 ПО 6000 ЗАНЯТЫ
     */

    // Общие
    const BAD_REQUEST_ERROR = 0;
    const USER_NOT_AUTHORIZED_ERROR = 1;
    const DB_INSERT_ERROR = 2;
    const DB_UPDATE_ERROR = 3;
    const DB_DELETE_ERROR = 4;
    const DB_SELECT_ERROR = 5;

    // Авторизация
    const LOGIN_INCORRECT_ERROR = 1000;
    const BAD_LOGIN_AND_PASSWORD_ERROR = 1001;
    const USER_BANNED_ERROR = 1002;

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

    // Загрузка файлов

    private static $messages = [
        // Общие 1-1000:
        0    => 'Неправильный запрос к API',
        1    => 'Пользователь не авторизован',
        2    => 'Ошибка записи в базу данных',
        3    => 'Возникла ошибка при обновлении в базе данных',
        4    => 'Возникла ошибка при удалении в базе данных',
        5    => 'Возникла ошибка при выборке из базы данных',

        // Авторизация 1000-2000:
        1000 => 'Неверный формат логина',
        1001 => 'Данные для входа неверны',
        1002 => 'Аккаунт заблокирован',

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

        // Загрузка файлов 3000-4000:
    ];

    /**
     * @param int $code
     */
    public static function error($code)
    {
        $code = (int)$code;

        if (isset(static::$messages[$code])) {
            $content = [
                'error' => [
                    'code'    => $code,
                    'message' => static::$messages[$code],
                ],
            ];
        } else {
            $content = [
                'error' => [
                    'code'    => -1,
                    'message' => 'Неопознанная ошибка',
                ],
            ];
        }

        exit(json_encode($content, JSON_UNESCAPED_UNICODE));
    }

    public static function send($data)
    {
        exit(json_encode(['response' => $data], JSON_UNESCAPED_UNICODE));
    }
}