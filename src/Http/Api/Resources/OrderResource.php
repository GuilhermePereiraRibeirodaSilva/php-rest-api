<?php
namespace Restapi\RestApi\Http\Api\Resources;

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
            'clientId' => $order['CLIENTE_ID'],
            'items' => $order['ITEMS'],
        ];
    }
}