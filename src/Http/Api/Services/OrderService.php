<?php
namespace Restapi\RestApi\Http\Api\Services;

use Restapi\RestApi\Http\Api\Resources\OrderResource;

/**
 * Class responsible for performing Order actions.
 */
class OrderService extends Service{
    /**
     * List Orders.
     * 
     * @return array Orders.
     */
    public function list(){
        return array_map(
            function($client) {
                return OrderResource::toJson((array) $client);
            },json_decode($this->externalApiService->curlRequest('/pedidos', $this->headers, 'GET'))
        );
    }

    /**
     * Get Order by id.
     * 
     * @param int $id The Order id.
     * 
     * @return array Order.
     */
    public function get(int $id){
        return OrderResource::toJson(
            (array) json_decode(
                $this->externalApiService->curlRequest("/pedidos/$id", $this->headers, 'GET')
            )
        );
    }

    /**
     * Delete Order by id.
     * 
     * @param int $id The Order id.
     * 
     * @return array Whether if deletion was successful or not.
     */
    public function delete(int $id){
        return [$this->externalApiService->curlRequest("/pedidos/$id", $this->headers, 'DELETE')];
    }

    /**
     * Insert Order.
     * 
     * @param int $clientId The Client id.
     * @param array $items Items to be added.
     * 
     * @return array result of operation.
     */
    public function insert(int $clientId, array $items){
        $body = [
            'CLIENTE_ID' => $clientId,
            'ITEMS' => $items
        ];

        return [$this->externalApiService->curlRequest("/pedidos", $this->headers, 'POST', $body)];
    }

    /**
     * Update Order.
     * 
     * @param int $id The id to be updated.
     * @param int $clientId The Client id.
     * @param int $items Items to be added.
     * 
     * @return array result of operation.
     */
    public function update(int $id, int $clientId=0, array $items=[]){
        $body = [];

        if(!empty($name)) $body["CLIENTE_ID"] = $clientId;
        if(!empty($items)) $body["ITEMS"] = $items;

        return [$this->externalApiService->curlRequest("/pedidos/$id", $this->headers, 'PUT', $body)];
    }
}
