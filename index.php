<?php
require_once __DIR__ . '/vendor/autoload.php';
require_once './config.php';

/**
 * Class responsible for inicializing the system.
 */
class init{
    use Restapi\RestApi\Http\Traits\ApiResponse;

    /**
     * Constructor method.
     */
    public function __construct(){
        $routesClass = "Restapi\RestApi\Routes\Routes";

        if(class_exists($routesClass)){
            new $routesClass();
        }else{
            echo 1234;
            //Critical class not found, returning 500.
            $this->systemFailure();
        }
    }
}

new init();
