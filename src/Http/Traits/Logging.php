<?php
namespace Restapi\RestApi\Http\Traits;
/**
 * Trait responsilbe for logging.
 */
trait Logging{
    /**
     * Logs an error.
     * 
     * @param Exception $e The exception instance.
     */
    private function logError(\Exception $e){
        $date = date('Y/m/d H:i:s');
        $message = $e->getMessage();
        $file = $e->getFile();
        $line = $e->getLine();
        error_log("[$date] $file on line $line - $message \n", logType, errorLogPath);
    }
}