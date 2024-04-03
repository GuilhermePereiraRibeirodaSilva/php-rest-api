<?php
namespace Restapi\RestApi\Http\Resources;

/**
 * Class responsible for sanitizing results from the queries for the clients.
 */
class ClientResource{
    /**
     * Converts clients array to json using sanitized names for each one.
     * 
     * @param array $user User from database.
     */
    public static function toJson(array $user){
        return [
            'name' => $user['nome'],
            'city' => $user['cidade_nome']
        ];
    }
}