<?php
namespace Restapi\RestApi\Http\Api\Controllers;

use Exception;
use Klein\Request;
use Restapi\RestApi\Http\Api\Services\ProductService;
use Restapi\RestApi\Http\Traits\ApiResponse;

/**
 * Class responsible for sanitizing and validating requests to product service.
 */
class ProductController{
    use ApiResponse;

    /**
     * Product service.
     * 
     * @var ProductService $productService
     */
    private ProductService $productService;

    /**
     * Constructor method. Loads dependencies.
     * 
     * @return void
     */
    public function __construct(){
        $this->productService = new ProductService();
    }

    /**
     * Lists Products.
     */
    public function list(){
        print_r(
            $this->ok(
                $this->productService->list()
            )
        );
    }

    /**
     * Get Product by id.
     * 
     * @param int $id The Product id.
     */
    public function get(int $id){
        print_r(
            $this->ok(
                $this->productService->get($id)
            )
        );
    }

    /**
     * Delete Product by id.
     * 
     * @param int $id The Product id.
     */
    public function delete(int $id){
        print_r(
            $this->ok(
                $this->productService->delete($id)
            )
        );
    }

    /**
     * Insert Product.
     * 
     * @param Request $request The request with params.
     */
    public function insert(Request $request){
        try{
            if(
                !isset($request->name) || !isset($request->value) 
                || empty($request->name) || empty($request->value)
            ){
                throw new Exception('Bad request');
            }
            print_r(
                $this->ok(
                    $this->productService->insert($request->name, floatval($request->value))
                )
            );
        }catch(Exception $e){
            $this->badRequest();
        }
    }

    /**
     * Update Product.
     * 
     * @param Request $request The request with params.
     */
    public function update(Request $request){
        try{
            if(
                !isset($request->id) || !is_numeric($request->id)
                || (!isset($request->name) && !isset($request->id))
            ){
                throw new Exception('Bad request'); 
            }

            $name = isset($request->name) && !empty($request->name) ? $request->name : '';
            $value = isset($request->value) && !empty($request->value) ? floatval($request->value) : 0;

            print_r(
                $this->ok(
                    $this->productService->update($request->id, $name, $value)
                )
            );
        }catch(Exception $e){
            $this->badRequest();
        }
    }
}