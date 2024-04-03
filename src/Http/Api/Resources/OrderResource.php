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
        //Converting sub objets to array.
        $order = json_decode(json_encode($order),true);

        return [
            'client' => [
                'name' => $order['cliente']['NOME'],
                'city' => $order['cliente']['CIDADE_NOME'],
            ],
            'items' => array_map(function($item) {
                return [
                    'quantity' => $item['QUANTIDADE'],
                    'productName' => $item["produto"]["NOME"],
                    'total' => floatval($item['QUANTIDADE']) * floatval($item["produto"]['VLRUNIT'])
                ];
            }, $order['itens']),
        ];
    }
}