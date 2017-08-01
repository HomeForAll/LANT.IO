<?php

use Respect\Validation\Validator as v;

class SMSHandler extends Response
{
    private $number;

    /**
     * @param $number - номер телефона в международном формате
     */
    public function __construct($number = null)
    {
        $this->number = $number;
    }

    /**
     * Код будет записан в $_SESSION['sms_code'] при успешной отправке
     */
    public function sendCode()
    {
        $code = mt_rand(100000, 999999);

        $ch = curl_init("https://sms.ru/sms/send");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
            "api_id" => Registry::get('config')['sms_api_key'],
            "to" => $this->number, // До 100 штук до раз
            "msg" => "Ваш код: {$code}",
            "json" => 1 // Для получения более развернутого ответа от сервера
        ]));

        $body = curl_exec($ch);
        curl_close($ch);

        $json = json_decode($body);

        if (!$json) {
            $this->error(self::CURL_CONNECTION_LOST);
        }

        if ($json->status !== "OK") {
            $this->error(self::SMS_API_REQUEST_FAILED_ERROR, $json->status_text);
        }

        foreach ($json->sms as $phone => $data) {
            if ($data->status !== "OK") {
                $this->error(self::SMS_NOT_SENT_ERROR, $data->status_text);
            }
        }

        $_SESSION['sms_code'] = $code;
    }

    public function verifyCode($code)
    {
        if (!v::numeric()->validate($code) || $_SESSION['sms_code'] != (int)$code) {
            $this->error(self::SMS_CODE_INCORRECT_ERROR);
        }
    }
}