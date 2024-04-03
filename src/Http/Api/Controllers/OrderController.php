<?php
namespace Restapi\RestApi\Http\Api\Controllers;

use Exception;
use Klein\Request;
use Restapi\RestApi\Http\Traits\Logging;
use Restapi\RestApi\Http\Api\Services\OrderService;
use Restapi\RestApi\Http\Traits\ApiResponse;

/**
 * Class responsible for sanitizing and validating requests to order service.
 */
class OrderController{
    use ApiResponse, Logging;

    /**
     * Order service.
     * 
     * @var OrderService $OrderService
     */
    private OrderService $OrderService;

    /**
     * Constructor method. Loads dependencies.
     * 
     * @return void
     */
    public function __construct(){
        $this->OrderService = new OrderService();
    }

    /**
     * Lists orders.
     */
    public function list(){
        print_r(
            $this->ok(
                $this->OrderService->list()
            )
        );
    }

    /**
     * Get order by id.
     * 
     * @param int $id The order id.
     */
    public function get(int $id){
        print_r(
            $this->ok(
                $this->OrderService->get($id)
            )
        );
    }

    /**
     * Delete order by id.
     * 
     * @param int $id The order id.
     */
    public function delete(int $id){
        print_r(
            $this->ok(
                $this->OrderService->delete($id)
            )
        );
    }

    /**
     * Insert order.
     * 
     * @param Request $request The request with params.
     */
    public function insert(Request $request){
        try{
            if(
                !isset($request->clientId) || !isset($request->items)
                || empty($request->clientId) || empty($request->items)
            ){
                throw new Exception('Bad request');
            }

            $items = $this->parseItems($request->items);
            
            print_r(
                $this->ok(
                    $this->OrderService->insert($request->clientId, $items)
                )
            );
        }catch(Exception $e){
            $this->logError($e);
            $this->badRequest();
        }
    }

    /**
     * Update order.
     * 
     * @param Request $request The request with params.
     */
    public function update(Request $request){
        try{
            if(
                !isset($request->id) || !is_numeric($request->id)
            ){
                throw new Exception('Bad request'); 
            }

            $items = isset($request->items) ? $request->items : [];
            $clientId = isset($request->clientId) && is_numeric($request->clientId) ? intval($request->clientId) : 0;

            print_r(
                $this->ok(
                    $this->OrderService->update($request->id, $clientId, $items)
                )
            );
        }catch(Exception $e){
            $this->logError($e);
            $this->badRequest();
        }
    }

    /**
     * Parse items string to array.
     * 
     * @param string $items Items in string format.
     * 
     * @return array
     */
    private function parseItems(string $items){
        $jsonString = str_replace('=>', ':', $items);

        $array = json_decode($jsonString, true);

        $objects = [];
        foreach ($array as $item) {
            $objects[] = (object) $item;
        }

        return $objects;
    }
}