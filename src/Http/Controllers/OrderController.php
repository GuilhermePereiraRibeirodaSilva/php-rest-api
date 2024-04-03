<?php
namespace Restapi\RestApi\Http\Controllers;

use Exception;
use Klein\Request;
use Restapi\RestApi\Http\Traits\Logging;
use Restapi\RestApi\Http\Services\orderService;
use Restapi\RestApi\Http\Traits\ApiResponse;

/**
 * Class responsible for sanitizing and validating requests to order service.
 */
class OrderController{
    use ApiResponse, Logging;

    /**
     * Order service.
     * 
     * @var orderService $orderService
     */
    private orderService $orderService;

    /**
     * Constructor method. Loads dependencies.
     * 
     * @return void
     */
    public function __construct(){
        $this->orderService = new orderService();
    }

    /**
     * Lists orders.
     */
    public function list(){
        print_r(
            $this->ok(
                $this->orderService->list()
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
                $this->orderService->get($id)
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
                $this->orderService->delete($id)
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
                !isset($request->clientId) || !isset($request->productId) || !isset($request->quantity)
                || empty($request->clientId) || empty($request->productId) || empty($request->quantity)
            ){
                throw new Exception('Bad request');
            }
            print_r(
                $this->ok(
                    $this->orderService->insert($request->clientId, $request->productId, $request->quantity)
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

            $productId = isset($request->productId) && is_numeric($request->productId) ? intval($request->productId) : 0;
            $clientId = isset($request->clientId) && is_numeric($request->clientId) ? intval($request->clientId) : 0;
            $quantity = isset($request->quantity) && is_numeric($request->quantity) ? intval($request->quantity) : 0;

            print_r(
                $this->ok(
                    $this->orderService->update($request->id, $clientId, $productId, $quantity)
                )
            );
        }catch(Exception $e){
            $this->logError($e);
            $this->badRequest();
        }
    }
}