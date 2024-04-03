<?php
namespace Restapi\RestApi\Http\Services;

use Restapi\RestApi\Http\Models\Product;
use Restapi\RestApi\Http\Resources\ProductResource;

/**
 * Class responsible for performing product actions.
 */
class ProductService{
    /**
     * Product model.
     * 
     * @var Product $productModel
     */
    private Product $productModel;

    /**
     * Constrctor method. Loads dependencies.
     */
    public function __construct(){
        $this->productModel = new Product();
    }

    /**
     * List products.
     * 
     * @return array products.
     */
    public function list(){
        return array_map(function($product){
            return ProductResource::toJson($product);
        },$this->productModel->list());
    }

    /**
     * Get product by id.
     * 
     * @param int $id The product id.
     * 
     * @return array product.
     */
    public function get(int $id){
        return array_map(function($product){
            return ProductResource::toJson($product);
        },$this->productModel->get($id));
    }

    /**
     * Delete product by id.
     * 
     * @param int $id The product id.
     * 
     * @return array Whether if deletion was successful or not.
     */
    public function delete(int $id){
        return [$this->productModel->delete($id)];
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
        return [$this->productModel->insert($name,$value)];
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
        return [$this->productModel->update($id, $name,$value)];
    }
}
