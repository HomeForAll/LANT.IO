<?php

class ErrorHandler
{
    const error_filename = '/errors.log';

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

    public function handleError($errno, $errstr, $errfile, $errline,
                                 $flag = 0)
    {
        $errfile_2 = substr($errfile,strpos($errfile, ROOT_DIR)+strlen(ROOT_DIR));

        switch($errno){
        case E_ERROR:               $errno = "Error";                  break;
        case E_WARNING:             $errno = "Warning";                break;
        case E_PARSE:               $errno = "Parse Error";            break;
        case E_NOTICE:              $errno = "Notice";                 break;
        case E_CORE_ERROR:          $errno = "Core Error";             break;
        case E_CORE_WARNING:        $errno = "Core Warning";           break;
        case E_COMPILE_ERROR:       $errno = "Compile Error";          break;
        case E_COMPILE_WARNING:     $errno = "Compile Warning";        break;
        case E_USER_ERROR:          $errno = "User Error";             break;
        case E_USER_WARNING:        $errno = "User Warning";           break;
        case E_USER_NOTICE:         $errno = "User Notice";            break;
        case E_STRICT:              $errno = "Strict Notice";          break;
        case E_RECOVERABLE_ERROR:   $errno = "Recoverable Error";      break;
        default:                    $errno = "Unknown error ($errno)"; break;
    }

        // добавляем описание исключения в лог-файл
        if (ERROR_HANDLER_STATUS == '1') {
                        //Формат записи:
            $exception = date('Y-m-d [H:i:s]').' - ['.$errno."] ".$errstr."\r\n  "
                ."(line: ".$errline." ) -> ".$errfile_2;

            if($flag == 1){
            $exception .= " - Фатальная ошибка!";
            // выводим пользовалелю понятное сообщение
            ?>
<div style="width: 500px; height: 150px; position: relative; margin: auto; padding: 30px; background-color: #ffff66; font-size: 30; text-align: center;">
<?php
            echo "Обнаружена ошибка сервера.<br> Попробуйте ".
            "войти позже. <br> Приносим свои извинения.";
            ?>
</div>
<?php
}


            $file      = fopen(ROOT_DIR.self::error_filename, "a+");
            if (!$file) {
                echo("Ошибка открытия файла");
            } else {
                fwrite($file, $exception."\r\n\r\n");
            }
            fclose($file);

            //Вывод ошибки на экран
        } elseif(ERROR_HANDLER_STATUS == '2'){

            ?>
<div style="border: 1px solid #ccc; text-align: center"><div style="background-color: #fff044"><b style="color: #999">
                <?php
                if($flag == 1){
                    ?> <strong style="color:red"> <?php
                    echo "Фатальная ошибка - "
                    ?> </strong> <?php
                }
            echo $errno;
            ?></b> <?php
            echo $errstr;
            ?></div>
    <div  style="background-color: #ffff66">
    <?php echo '<b>'.$errfile_2."</b> [стр.".$errline."]";
    ?>
</div></div>
<?php
        } else {
          return FALSE;
        }

        return TRUE;
    }

    public function handleShutdown()
    {
        //последняя ошибка
        if (!empty($error = error_get_last()) AND $error['type'] & (E_ERROR | E_PARSE
            | E_COMPILE_ERROR | E_CORE_ERROR)) {
            //очищаем буфер вывода
            ob_get_clean();
            //своя ошибка
            $this->handleError($error['type'], $error['message'],
                $error['file'], $error['line'], 1);
        }
    }

    public function handleException(\Exception $e)
    {
        $this->handleError($e->getCode(), get_class($e).'("'.$e->getMessage().'")', $e->getFile(),
            $e->getLine(), 1);
        return TRUE;
    }
}