<?php
namespace Restapi\RestApi\Http\Services;

use Restapi\RestApi\Http\Models\Order;
use Restapi\RestApi\Http\Resources\OrderResource;

/**
 * Class responsible for performing Order actions.
 */
class OrderService{
    /**
     * Order model.
     * 
     * @var Order $orderModel
     */
    private Order $orderModel;

    /**
     * Constrctor method. Loads dependencies.
     */
    public function __construct(){
        $this->orderModel = new Order();
    }

    /**
     * List Orders.
     * 
     * @return array Orders.
     */
    public function list(){
        return array_map(function($Order){
            return OrderResource::toJson($Order);
        },$this->orderModel->list());
    }

    /**
     * Get Order by id.
     * 
     * @param int $id The Order id.
     * 
     * @return array Order.
     */
    public function get(int $id){
        return array_map(function($Order){
            return OrderResource::toJson($Order);
        },$this->orderModel->get($id));
    }

    /**
     * Delete Order by id.
     * 
     * @param int $id The Order id.
     * 
     * @return array Whether if deletion was successful or not.
     */
    public function delete(int $id){
        return [$this->orderModel->delete($id)];
    }

    /**
     * Insert Order.
     * 
     * @param int $clientId The Client id.
     * @param int $productId The Product id.
     * @param int $quantity Quantity sold
     * 
     * @return array result of operation.
     */
    public function insert(int $clientId, int $productId, int $quantity){
        return [$this->orderModel->insert($clientId,$productId,$quantity)];
    }

    /**
     * Update Order.
     * 
     * @param int $id The id to be updated.
     * @param int $clientId The Client id.
     * @param int $productId The Product id.
     * @param int $quantity Quantity sold
     * 
     * @return array result of operation.
     */
    public function update(int $id, int $clientId=0, int $productId=0, int $quantity=0){
        return [$this->orderModel->update($id, $clientId,$productId,$quantity)];
    }
}
