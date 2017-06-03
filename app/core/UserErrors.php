<?php

/**
 * Класс UserErrors реализует процесс записи и извлечения пользовательских ошибок
 */
class UserErrors
{
    private $errors = [];

    /**
     * Возвращает сообщение об ошибке по ассоциативному ключу
     *
     * @param string $id
     * @return string|null
     */
    public function getUserError($id)
    {
        return isset($this->errors[$id]) ? $this->errors[$id] : null;
    }

    /**
     * Записывает пользовательскую ошибку в массив по ассоциативному ключу
     *
     * @param string $id
     * @param string $message
     */
    public function setUserError($id, $message)
    {
        $this->errors[$id] = $message;
    }

}