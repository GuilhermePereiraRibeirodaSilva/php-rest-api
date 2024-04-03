<?php
namespace Restapi\RestApi\Http\Api\Services;

use Restapi\RestApi\Http\Api\Resources\ClientResource;

/**
 * Class responsible for performing user actions.
 */
class ClientService extends Service{
    /**
     * List users.
     * 
     * @return array Users.
     */
    public function list(){
        return array_map(
            function($client) {
                return ClientResource::toJson((array) $client);
            },json_decode($this->externalApiService->curlRequest('/clientes', $this->headers, 'GET'))
        );         
    }

    /**
     * Get user by id.
     * 
     * @param int $id The user id.
     * 
     * @return array User.
     */
    public function get(int $id){
        return ClientResource::toJson(
            (array) json_decode(
                $this->externalApiService->curlRequest("/clientes/$id", $this->headers, 'GET')
            )
        );
    }

    /**
     * Delete user by id.
     * 
     * @param int $id The user id.
     * 
     * @return array Whether if deletion was successful or not.
     */
    public function delete(int $id){
        return [$this->externalApiService->curlRequest("/clientes/$id", $this->headers, 'DELETE')];
    }

    /**
     * Insert client.
     * 
     * @param string $name The user name.
     * @param string $city The user city.
     * 
     * @return array Whether if insertion was successful or not.
     */
    public function insert(string $name, string $city){
        $body = [
            'NOME' => $name,
            'CIDADE_NOME' => $city
        ];
        return [$this->externalApiService->curlRequest("/clientes", $this->headers, 'POST', $body)];
    }

    /**
     * Update client.
     * 
     * @param int $id The user id.
     * @param string $name The user name.
     * @param string $city The user city.
     * 
     * @return array Whether if update was successful or not.
     */
    public function update(int $id, string $name="", string $city=""){
        $body = [];

        if(!empty($name)) $body["NOME"] = $name;
        if(!empty($city)) $body["CIDADE_NOME"] = $city;

        return [$this->externalApiService->curlRequest("/clientes/$id", $this->headers, 'PUT', $body)];
    }
}
