<?php
//Запись ошибок в лог файл
define('ERROR_FILENAME', 'errors.log');
set_error_handler('handleError');
register_shutdown_function('handleShutdown');
set_exception_handler('handleException');

function handleError(
    $errno,
    $errstr,
    $errfile,
    $errline,
    $flag = 0
)
{
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
    //Если фатальная ошибка
    if ($flag == 1) {
        $fatal_error = " - FATAL ERROR!";
    }
    $file = fopen(ERROR_FILENAME, "a+");
    $exception = "* " . date('Y-m-d [H:i:s]') . ' - [' . $errno . "] " . $errstr . "\r\n  "
        . "(line: " . $errline . " ) -> " . $errfile . " " . $fatal_error . "\r\n\r\n";

    if ($file) {
        fwrite($file, $exception);
        fclose($file);
    }

    return true;
}

function handleShutdown()
{
    if (!empty($error = error_get_last()) AND $error['type'] & (E_ERROR | E_PARSE
            | E_COMPILE_ERROR | E_CORE_ERROR)
    ) {
        ob_get_clean();
        handleError($error['type'], $error['message'],
            $error['file'], $error['line'], 1);
    }
}

function handleException($e)
{
    handleError($e->getCode(), get_class($e) . '("' . $e->getMessage() . '")', $e->getFile(),
        $e->getLine(), 1);

    return true;
}