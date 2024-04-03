<?php
namespace Restapi\RestApi\Http\Models;
use PDO;

/**
 * Class responsible for performing database related actions.
 */
class Order extends Model{
    /**
     * Table name.
     * 
     * @param string $table
     */
    private string $table = 'Orders';

    /**
     * Queries all Orders in the database.
     * 
     * The Orders.
     */
    public function list(){
        $query = "SELECT * FROM $this->table";
        $stmt = $this->prepare($query);

        return $this->execute($stmt);
    }

    /**
     * Queries Order by id.
     * 
     * @param int id The Order id.
     * 
     * @return array the Order.
     */
    public function get(int $id){
        $query = "SELECT * FROM $this->table WHERE id = :id";
        $stmt = $this->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        return $this->execute($stmt);
    }

    /**
     * Deletes Order by id.
     * 
     * @param int id The Order id.
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
     * Insert Order.
     * 
     * @param int $clientId The Client id.
     * @param int $productId The Product id.
     * @param int $quantity Quantity sold
     * 
     * @return bool result of operation.
     */
    public function insert(int $clientId, int $productId, int $quantity){
        $query = "INSERT INTO $this->table (client_id,produto_id,quantidade) VALUES (:clientId, :productId, :quantity)";
        $stmt = $this->prepare($query);
        $stmt->bindParam(':clientId', $clientId, PDO::PARAM_INT);
        $stmt->bindParam(':productId', $productId, PDO::PARAM_INT);
        $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);

        $this->execute($stmt);

        return 1 === $stmt->rowCount();
    }

    /**
     * Update Order.
     * 
     * @param int $id The id to be updated.
     * @param int $clientId The Client id.
     * @param int $productId The Product id.
     * @param int $quantity Quantity sold
     * 
     * @return bool result of operation.
     */
    public function update(int $id, int $clientId=0, int $productId=0, int $quantity=0){
        //Conditionally verifying which parameters will be updated.
        $setQuery = [];
        if($clientId) $setQuery[] = ' client_id = :clientId';
        if($productId) $setQuery[] = ' produto_id = :productId';
        if($quantity) $setQuery[] = ' quantidade = :quantity';
        $setQuery = implode(',', $setQuery);

        $query = "UPDATE $this->table SET $setQuery  WHERE id = :id";
        $stmt = $this->prepare($query);

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        if($clientId) $stmt->bindParam(':clientId', $clientId, PDO::PARAM_INT);
        if($productId) $stmt->bindParam(':productId', $productId, PDO::PARAM_INT);
        if($quantity) $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);

        $this->execute($stmt);

        return 1 === $stmt->rowCount();
    }
}