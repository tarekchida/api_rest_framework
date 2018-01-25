<?php

namespace Core;

/**
 * Description of Error
 *
 * @author Tarek.Chida
 */
class Error {

    /**
     * 
     * @param type $level
     * @param type $message
     * @param type $file
     * @param type $line
     * @throws \ErrorException
     */
    public static function errorHandler($level, $message, $file, $line) {
        if (error_reporting() !== 0) {
            throw new \ErrorException($message, 0, $level, $file, $line);
        }
    }

    /**
     * 
     * @param type $exception
     */
    public static function exceptionHandler($exception) {

        $code = $exception->getCode();
        if ($code != API_NOT_FOUND) {
            $code = API_ERROR;
        }

        //Set http response code 
        http_response_code($code);

        //Prepare log message
        $message = "Uncaught exception: '" . get_class($exception) . "'";
        $message .= " with message '" . $exception->getMessage() . "'";
        $message .= "\nStack trace: " . $exception->getTraceAsString();
        $message .= "\nThrown in '" . $exception->getFile() . "' on line " . $exception->getLine();

        //write error to log file
        self::logger($message);
    }

    /**
     * Log error 
     * @param type $message
     */
    public static function logger($message) {
        //Test if folder exists and create it
        if (!file_exists(dirname(__DIR__) . '/log/')) {
            mkdir(dirname(__DIR__) . '/log/', 0777, true);
        }

        $log = dirname(__DIR__) . '/log/' . date('Y-m-d') . '.log';
        ini_set('error_log', $log);
        error_log($message);
    }

}
