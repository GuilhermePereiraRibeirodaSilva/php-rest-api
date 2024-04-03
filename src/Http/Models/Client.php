<?php
namespace Restapi\RestApi\Http\Models;
use PDO;

/**
 * Class responsible for performing database related actions.
 */
class Client extends Model{
    /**
     * Table name.
     * 
     * @param string $table
     */
    private string $table = 'users';

    /**
     * Queries all clients in the database.
     * 
     * The clients.
     */
    public function list(){
        $query = "SELECT * FROM $this->table";
        $stmt = $this->prepare($query);

        return $this->execute($stmt);
    }

    /**
     * Queries client by id.
     * 
     * @param int id The user id.
     * 
     * @return array the client.
     */
    public function get(int $id){
        $query = "SELECT * FROM $this->table WHERE id = :id";
        $stmt = $this->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        return $this->execute($stmt);
    }

    /**
     * Deletes client by id.
     * 
     * @param int id The user id.
     * 
     * @return bool result of operation.
     */
    public function delete(int $id){
        $query = "DELETE FROM $this->table WHERE id = :id";
        $stmt = $this->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        $this->execute($stmt);

        return 1 === $stmt->rowCount();
    }

    /**
     * Insert client.
     * 
     * @param string $name The user name.
     * @param string $city The user city.
     * 
     * @return bool result of operation.
     */
    public function insert(string $name, string $city){
        $query = "INSERT INTO $this->table (nome,cidade_nome) VALUES (:name, :city)";
        $stmt = $this->prepare($query);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':city', $city, PDO::PARAM_STR);

        $this->execute($stmt);

        return 1 === $stmt->rowCount();
    }

    /**
     * Update client.
     * 
     * @param int $id The user id.
     * @param string $name The user name.
     * @param string $city The user city.
     * 
     * @return bool result of operation.
     */
    public function update(int $id, string $name='', string $city=''){
        //Conditionally verifying which parameters will be updated.
        $setQuery = [];
        if(!empty($name)) $setQuery[] = ' nome = :name';
        if(!empty($city)) $setQuery[] = ' cidade_nome = :city';
        $setQuery = implode(',', $setQuery);

        $query = "UPDATE $this->table SET $setQuery  WHERE id = :id";
        $stmt = $this->prepare($query);

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        if(!empty($name)) $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        if(!empty($city)) $stmt->bindParam(':city', $city, PDO::PARAM_STR);

        $this->execute($stmt);

        return 1 === $stmt->rowCount();
    }
}