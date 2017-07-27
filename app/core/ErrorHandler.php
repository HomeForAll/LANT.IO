<?php

class ErrorHandler
{
    const ERROR_FILENAME = '/log/errors.log';
    const ERROR_FILENAME_HTML = '/log/errors.html';

    /**
     * Register this error handler.
     */
    public function register()
    {
        // обработка ошибок
        set_error_handler([$this, 'handleError']);
        // обработка фатальных ошибок
        register_shutdown_function([$this, 'handleShutdown']);
        //обработка всех неучтеных ошибок
        set_exception_handler([$this, 'handleException']);

        return;
    }

    public function handleError(
        $errno,
        $errstr,
        $errfile,
        $errline,
        $flag = 0
    ) {
        // строка пути к файлу ошибки
        $errfile_2 = substr($errfile, strpos($errfile, ROOT_DIR) + strlen(ROOT_DIR));

        switch ($errno) {
            case E_ERROR:
                $errno = "Error";
                break;
            case E_WARNING:
                $errno = "Warning";
                break;
            case E_PARSE:
                $errno = "Parse Error";
                break;
            case E_NOTICE:
                $errno = "Notice";
                break;
            case E_CORE_ERROR:
                $errno = "Core Error";
                break;
            case E_CORE_WARNING:
                $errno = "Core Warning";
                break;
            case E_COMPILE_ERROR:
                $errno = "Compile Error";
                break;
            case E_COMPILE_WARNING:
                $errno = "Compile Warning";
                break;
            case E_USER_ERROR:
                $errno = "User Error";
                break;
            case E_USER_WARNING:
                $errno = "User Warning";
                break;
            case E_USER_NOTICE:
                $errno = "User Notice";
                break;
            case E_STRICT:
                $errno = "Strict Notice";
                break;
            case E_RECOVERABLE_ERROR:
                $errno = "Recoverable Error";
                break;
            default:
                $errno = "Unknown error ($errno)";
                break;
        }

        // добавляем описание исключения в лог-файл
        if (ERROR_HANDLER_STATUS == '1') {

            //Если фатальная ошибка
            if ($flag == 1) {
                $fatal_error = " - FATAL ERROR!";
                // выводим пользовалелю понятное сообщение
                ?>
                <div style="width: 500px; height: 150px; position: relative; margin: auto; padding: 30px; background-color: #ffff66; font-size: 30; text-align: center;">
                    <?php
                    echo "Обнаружена ошибка сервера.<br> Попробуйте " .
                        "войти позже. <br> Приносим свои извинения.";
                    ?>
                </div>
                <?php
            }
            $this->writeLOG($errno, $errstr, $errfile_2, $errline, $fatal_error);
            $this->writeHTML($errno, $errstr, $errfile_2, $errline, $fatal_error);

            //Вывод ошибки на экран
        } elseif (ERROR_HANDLER_STATUS == '2') {

            ?>
            <div style="border: 1px solid #ccc; text-align: center">
                <div style="background-color: #fff044"><b style="color: #999">
                        <?php
                        if ($flag == 1) {
                            ?> <strong style="color:red"> <?php
                                echo "Фатальная ошибка - "
                                ?> </strong> <?php
                        }
                        echo $errno;
                        ?></b> <?php
                    echo $errstr;
                    ?></div>
                <div style="background-color: #ffff66">
                    <?php echo '<b>' . $errfile_2 . "</b> [стр." . $errline . "]";
                    ?>
                </div>
            </div>
            <?php
        } else {
            return false;
        }

        return true;
    }

    public function handleShutdown()
    {
        //последняя ошибка
        if (!empty($error = error_get_last()) AND $error['type'] & (E_ERROR | E_PARSE
                | E_COMPILE_ERROR | E_CORE_ERROR)
        ) {
            //очищаем буфер вывода
            ob_get_clean();
            //своя ошибка
            $this->handleError($error['type'], $error['message'],
                $error['file'], $error['line'], 1);
        }
    }

    public function handleException($e)
    {
        $this->handleError($e->getCode(), get_class($e) . '("' . $e->getMessage() . '")', $e->getFile(),
            $e->getLine(), 1);
        return true;
    }


    private function writeLOG($errno, $errstr, $errfile, $errline, $fatal_error)
    {
        $file = fopen(ROOT_DIR . self::ERROR_FILENAME, "a+");
        //Формат записи:
        $exception = "* " . date('Y-m-d [H:i:s]') . ' - [' . $errno . "] " . $errstr . "\r\n  "
            . "(line: " . $errline . " ) -> " . $errfile . " " . $fatal_error . "\r\n\r\n";

        if ($file) {
            fwrite($file, $exception);
            fclose($file);
        }

    }

    private function writeHTML($errno, $errstr, $errfile, $errline, $fatal_error)
    {
        $file = fopen(ROOT_DIR . self::ERROR_FILENAME_HTML, "a+");

        $exception = "<div style='padding: 10px; background-color: #fff8e1; margin: 10px;'>" . "\r\n"
            . "<span style='color: blue; padding: 5px;'>" . date('Y-m-d [H:i:s]') . "</span>" . "\r\n"
            . "<span style='background-color: #ffc582; padding: 2px 5px;'>$errno</span>" . "\r\n"
            . "<span style='color: #c21535; padding: 5px;'>$errstr</span>" . "\r\n"
            . "<span style='background-color: #e3f2f8; padding: 2px 5px;'>стр. <b>$errline</b></span>" . "\r\n"
            . "<span style='background-color: #e3f2f8; padding: 2px 5px;'>$errfile</span>" . "\r\n";
        if (!empty($fatal_error)) {
            $exception .= "<span style='background-color: #c21535; padding: 2px 5px; color: #fff8e1;'><b>$fatal_error</b></span>";
        }
        $exception .= "</div>" . "\r\n\r\n";

        if ($file) {
            fwrite($file, $exception);
            fclose($file);
        }

    }
}
