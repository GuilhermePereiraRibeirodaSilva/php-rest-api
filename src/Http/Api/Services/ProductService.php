<?php
namespace Restapi\RestApi\Http\Api\Services;

use Restapi\RestApi\Http\Api\Resources\ProductResource;

/**
 * Class responsible for performing product actions.
 */
class ProductService extends Service{
    /**
     * List products.
     * 
     * @return array products.
     */
    public function list(){
        return array_map(
            function($client) {
                return ProductResource::toJson((array) $client);
            },json_decode($this->externalApiService->curlRequest('/produtos', $this->headers, 'GET'))
        );         
    }

    /**
     * Get product by id.
     * 
     * @param int $id The product id.
     * 
     * @return array product.
     */
    public function get(int $id){
        return ProductResource::toJson(
            (array) json_decode(
                $this->externalApiService->curlRequest("/produtos/$id", $this->headers, 'GET')
            )
        );
    }

    /**
     * Delete product by id.
     * 
     * @param int $id The product id.
     * 
     * @return array Whether if deletion was successful or not.
     */
    public function delete(int $id){
        return [$this->externalApiService->curlRequest("/produtos/$id", $this->headers, 'DELETE')];
    }

    /**
     * Insert Product.
     * 
     * @param string $name The product name.
     * @param float $value The product value.
     * 
     * @return array Whether if insertion was successful or not.
     */
    public function insert(string $name, float $value){
        $body = [
            'NOME' => $name,
            'VLRUNIT' => $value
        ];
        return [$this->externalApiService->curlRequest("/produtos", $this->headers, 'POST', $body)];
    }

    /**
     * Update Product.
     * 
     * @param int $id The product id.
     * @param string $name The product name.
     * @param float $value The product value.
     * 
     * @return array Whether if update was successful or not.
     */
    public function update(int $id, string $name="", float $value=0){
        $body = [];

        if(!empty($name)) $body["NOME"] = $name;
        if(!empty($value)) $body["VLRUNIT"] = $value;

        return [$this->externalApiService->curlRequest("/produtos/$id", $this->headers, 'PUT', $body)];
    }
}
