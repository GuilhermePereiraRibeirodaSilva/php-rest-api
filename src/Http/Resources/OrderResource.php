<?php
namespace Restapi\RestApi\Http\Resources;

/**
 * Class responsible for sanitizing results from the queries for the orders.
 */
class OrderResource{
    /**
     * Converts orders array to json using sanitized names for each one.
     * 
     * @param array $order order from database.
     */
    public static function toJson(array $order){
        return [
            'clientId' => $order['client_id'],
            'productId' => $order['produto_id'],
            'quantity' => $order['quantidade']
        ];
    }
}