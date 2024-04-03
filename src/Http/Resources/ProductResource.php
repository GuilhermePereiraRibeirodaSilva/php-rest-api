<?php
namespace Restapi\RestApi\Http\Resources;

/**
 * Class responsible for sanitizing results from the queries for the products.
 */
class ProductResource{
    /**
     * Converts products array to json using sanitized names for each one.
     * 
     * @param array $product product from database.
     */
    public static function toJson(array $product){
        return [
            'name' => $product['nome'],
            'value' => $product['vlrunit']
        ];
    }
}