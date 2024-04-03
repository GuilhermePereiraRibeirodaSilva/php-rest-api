<?php
namespace Restapi\RestApi\Routes;

use Klein\Request;
use Restapi\RestApi\Http\Controllers\ClientController;
use Restapi\RestApi\Http\Controllers\ProductController;
use Restapi\RestApi\Http\Controllers\OrderController;
use Restapi\RestApi\Http\Api\Controllers\ClientController as ClientControllerExternal;
use Restapi\RestApi\Http\Api\Controllers\ProductController as ProductControllerExternal;
use Restapi\RestApi\Http\Api\Controllers\OrderController as OrderControllerExternal;
use Restapi\RestApi\Http\Traits\ApiResponse;

class Routes{
    use ApiResponse;

    private $klein;

    public function __construct(){
        try{
            $this->klein = new \Klein\Klein();
        
            $this->localStorageRoutes();
            $this->apiRoutes();
            
            $this->klein->dispatch();
        }catch(\Exception $e){
            $this->systemFailure();
        } 
    }

    private function localStorageRoutes(){
        $this->userRoutes();
        $this->productRoutes();
        $this->ordersRoutes();
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

    private function apiRoutes(){
        $this->userApiRoutes();
        $this->productApiRoutes();
        $this->ordersApiRoutes();
    }

    private function userApiRoutes(){
        $this->klein->respond('GET', '/php-rest-api/external/clientes', function () {
            return (new ClientControllerExternal())->list();
        });
        
        $this->klein->respond('GET', '/php-rest-api/external/clientes/[:id]', function (Request $request) {
            return (new ClientControllerExternal())->get($request->id);
        });

        $this->klein->respond('DELETE', '/php-rest-api/external/clientes/[:id]', function (Request $request) {
            return (new ClientControllerExternal())->delete($request->id);
        });

        $this->klein->respond('POST', '/php-rest-api/external/clientes', function (Request $request) {
            return (new ClientControllerExternal())->insert($request);
        });

        $this->klein->respond('POST', '/php-rest-api/external/clientes/[:id]', function (Request $request) {
            return (new ClientControllerExternal())->update($request);
        });
    }

    private function productApiRoutes(){
        $this->klein->respond('GET', '/php-rest-api/external/produtos', function () {
            return (new ProductControllerExternal())->list();
        });
        
        $this->klein->respond('GET', '/php-rest-api/external/produtos/[:id]', function (Request $request) {
            return (new ProductControllerExternal())->get($request->id);
        });

        $this->klein->respond('DELETE', '/php-rest-api/external/produtos/[:id]', function (Request $request) {
            return (new ProductControllerExternal())->delete($request->id);
        });

        $this->klein->respond('POST', '/php-rest-api/external/produtos', function (Request $request) {
            return (new ProductControllerExternal())->insert($request);
        });

        $this->klein->respond('POST', '/php-rest-api/external/produtos/[:id]', function (Request $request) {
            return (new ProductControllerExternal())->update($request);
        });
    }

    private function ordersApiRoutes(){
        $this->klein->respond('GET', '/php-rest-api/external/pedidos', function () {
            return (new OrderControllerExternal())->list();
        });
        
        $this->klein->respond('GET', '/php-rest-api/external/pedidos/[:id]', function (Request $request) {
            return (new OrderControllerExternal())->get($request->id);
        });

        $this->klein->respond('DELETE', '/php-rest-api/external/pedidos/[:id]', function (Request $request) {
            return (new OrderControllerExternal())->delete($request->id);
        });

        $this->klein->respond('POST', '/php-rest-api/external/pedidos', function (Request $request) {
            return (new OrderControllerExternal())->insert($request);
        });

        $this->klein->respond('POST', '/php-rest-api/external/pedidos/[:id]', function (Request $request) {
            return (new OrderControllerExternal())->update($request);
        });
    }
}




