<?php
namespace Restapi\RestApi\Http\Services;

use Restapi\RestApi\Http\Models\Client;
use Restapi\RestApi\Http\Resources\ClientResource;

/**
 * Class responsible for performing user actions.
 */
class ClientService{
    /**
     * Client model.
     * 
     * @var Client $clientModel
     */
    private Client $clientModel;

    /**
     * Constrctor method. Loads dependencies.
     */
    public function __construct(){
        $this->clientModel = new Client();
    }

    /**
     * List users.
     * 
     * @return array Users.
     */
    public function list(){
        return array_map(function($user){
            return ClientResource::toJson($user);
        },$this->clientModel->list());
    }

    /**
     * Get user by id.
     * 
     * @param int $id The user id.
     * 
     * @return array User.
     */
    public function get(int $id){
        return array_map(function($user){
            return ClientResource::toJson($user);
        },$this->clientModel->get($id));
    }

    /**
     * Delete user by id.
     * 
     * @param int $id The user id.
     * 
     * @return array Whether if deletion was successful or not.
     */
    public function delete(int $id){
        return [$this->clientModel->delete($id)];
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
        return [$this->clientModel->insert($name,$city)];
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
        return [$this->clientModel->update($id, $name,$city)];
    }
}
