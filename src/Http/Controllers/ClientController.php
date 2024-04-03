<?php
namespace Restapi\RestApi\Http\Controllers;

use Exception;
use Klein\Request;
use Restapi\RestApi\Http\Services\ClientService;
use Restapi\RestApi\Http\Traits\ApiResponse;

/**
 * Class responsible for sanitizing and validating requests to user service.
 */
class ClientController{
    use ApiResponse;

    /**
     * Client service.
     * 
     * @var ClientService $ClientService
     */
    private ClientService $ClientService;

    /**
     * Constructor method. Loads dependencies.
     * 
     * @return void
     */
    public function __construct(){
        $this->ClientService = new ClientService();
    }

    /**
     * Lists users.
     */
    public function list(){
        print_r(
            $this->ok(
                $this->ClientService->list()
            )
        );
    }

    /**
     * Get User by id.
     * 
     * @param int $id The user id.
     */
    public function get(int $id){
        print_r(
            $this->ok(
                $this->ClientService->get($id)
            )
        );
    }

    /**
     * Delete User by id.
     * 
     * @param int $id The user id.
     */
    public function delete(int $id){
        print_r(
            $this->ok(
                $this->ClientService->delete($id)
            )
        );
    }

    /**
     * Insert User.
     * 
     * @param Request $request The request with params.
     */
    public function insert(Request $request){
        try{
            if(
                !isset($request->name) || !isset($request->city) 
                || empty($request->name) || empty($request->city)
                || !is_string($request->name) || !is_string($request->city)
            ){
                throw new Exception('Bad request');
            }
            print_r(
                $this->ok(
                    $this->ClientService->insert($request->name, $request->city)
                )
            );
        }catch(Exception $e){
            $this->badRequest();
        }
    }

    /**
     * Update User.
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
            $city = isset($request->city) && !empty($request->city) ? $request->city : '';

            print_r(
                $this->ok(
                    $this->ClientService->update($request->id, $name, $city)
                )
            );
        }catch(Exception $e){
            $this->badRequest();
        }
    }
}