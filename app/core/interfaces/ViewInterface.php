<?php
interface ViewInterface {
    /**
     * Полученный JavaScript код возвращается в макете с помощью функции $this->head()
     *
     * @param string $code - код необходимо указывать без тегов <script></script>
     */
    public function addJSCode($code);

    /**
     * @param string $link - название или ссылка на добавляемый JavaScript файл, если это название файла,
     * он будет взят из директории [путь к сайту в системе]/template/js
     *
     * @param string $loadType - тип загрузки скрипта defer или async, может быть пустым.
     */
    public function addJSFile($link, $loadType = null);

    /**
     * Полученный CSS код возвращается в макете с помощью функции $this->head()
     *
     * @param string $code - код необходимо указывать без тегов <style></style>
     */
    public function addCSSCode($code);

    /**
     * @param string $link - название или ссылка на добавляемый CSS файл, если это название файла,
     * он будет взят из директории [путь к сайту в системе]/template/css
     *
     */
    public function addCSSFile($link);
}