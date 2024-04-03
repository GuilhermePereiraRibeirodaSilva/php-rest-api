<?php
namespace Restapi\RestApi\Http\Models;
use PDO;

/**
 * Class responsible for performing database related actions.
 */
class Product extends Model{
    /**
     * Table name.
     * 
     * @param string $table
     */
    private string $table = 'products';

    /**
     * Queries all Products in the database.
     * 
     * The Products.
     */
    public function list(){
        $query = "SELECT * FROM $this->table";
        $stmt = $this->prepare($query);

        return $this->execute($stmt);
    }

    /**
     * Queries Product by id.
     * 
     * @param int id The product id.
     * 
     * @return array the Product.
     */
    public function get(int $id){
        $query = "SELECT * FROM $this->table WHERE id = :id";
        $stmt = $this->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        return $this->execute($stmt);
    }

    /**
     * Deletes Product by id.
     * 
     * @param int id The product id.
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
     * Insert Product.
     * 
     * @param string $name The product name.
     * @param float $value The product value.
     * 
     * @return bool result of operation.
     */
    public function insert(string $name, float $value){
        $query = "INSERT INTO $this->table (nome,vlrunit) VALUES (:name, :value)";
        $stmt = $this->prepare($query);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':value', $value, PDO::PARAM_STR);

        $this->execute($stmt);

        return 1 === $stmt->rowCount();
    }

    /**
     * Update Product.
     * 
     * @param int $id The product id.
     * @param string $name The product name.
     * @param float $value The product value.
     * 
     * @return bool result of operation.
     */
    public function update(int $id, string $name='', float $value=0){
        //Conditionally verifying which parameters will be updated.
        $setQuery = [];
        if(!empty($name)) $setQuery[] = ' nome = :name';
        if($value) $setQuery[] = ' vlrunit = :value';
        $setQuery = implode(',', $setQuery);

        $query = "UPDATE $this->table SET $setQuery  WHERE id = :id";
        $stmt = $this->prepare($query);

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        if(!empty($name)) $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        if($value) $stmt->bindParam(':value', $value, PDO::PARAM_STR);

        $this->execute($stmt);

        return 1 === $stmt->rowCount();
    }
}