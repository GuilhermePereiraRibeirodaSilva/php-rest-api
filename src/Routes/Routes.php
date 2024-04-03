<?php
namespace Restapi\RestApi\Routes;

use Klein\Request;
use Restapi\RestApi\Http\Controllers\ClientController;
use Restapi\RestApi\Http\Controllers\ProductController;
use Restapi\RestApi\Http\Controllers\OrderController;
use Restapi\RestApi\Http\Traits\ApiResponse;

class Routes{
    use ApiResponse;

    private $klein;

    public function __construct(){
        try{
            $this->klein = new \Klein\Klein();
        
            $this->userRoutes();
            $this->productRoutes();
            $this->ordersRoutes();
            
            $this->klein->dispatch();
        }catch(\Exception $e){
            $this->systemFailure();
        } 
    }

    private function userRoutes(){
        $this->klein->respond('GET', '/php-rest-api/api/clientes', function () {
            return (new ClientController())->list();
        });
        
        $this->klein->respond('GET', '/php-rest-api/api/clientes/[:id]', function (Request $request) {
            return (new ClientController())->get($request->id);
        });

        $this->klein->respond('DELETE', '/php-rest-api/api/clientes/[:id]', function (Request $request) {
            return (new ClientController())->delete($request->id);
        });

        $this->klein->respond('POST', '/php-rest-api/api/clientes', function (Request $request) {
            return (new ClientController())->insert($request);
        });

        $this->klein->respond('POST', '/php-rest-api/api/clientes/[:id]', function (Request $request) {
            return (new ClientController())->update($request);
        });
    }

    private function productRoutes(){
        $this->klein->respond('GET', '/php-rest-api/api/produtos', function () {
            return (new ProductController())->list();
        });
        
        $this->klein->respond('GET', '/php-rest-api/api/produtos/[:id]', function (Request $request) {
            return (new ProductController())->get($request->id);
        });

        $this->klein->respond('DELETE', '/php-rest-api/api/produtos/[:id]', function (Request $request) {
            return (new ProductController())->delete($request->id);
        });

        $this->klein->respond('POST', '/php-rest-api/api/produtos', function (Request $request) {
            return (new ProductController())->insert($request);
        });

        $this->klein->respond('POST', '/php-rest-api/api/produtos/[:id]', function (Request $request) {
            return (new ProductController())->update($request);
        });
    }

    private function ordersRoutes(){
        $this->klein->respond('GET', '/php-rest-api/api/pedidos', function () {
            return (new OrderController())->list();
        });
        
        $this->klein->respond('GET', '/php-rest-api/api/pedidos/[:id]', function (Request $request) {
            return (new OrderController())->get($request->id);
        });

        $this->klein->respond('DELETE', '/php-rest-api/api/pedidos/[:id]', function (Request $request) {
            return (new OrderController())->delete($request->id);
        });

        $this->klein->respond('POST', '/php-rest-api/api/pedidos', function (Request $request) {
            return (new OrderController())->insert($request);
        });

        $this->klein->respond('POST', '/php-rest-api/api/pedidos/[:id]', function (Request $request) {
            return (new OrderController())->update($request);
        });
    }
}




