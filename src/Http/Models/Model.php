<?php
namespace Restapi\RestApi\Http\Models;

use Restapi\RestApi\Http\Traits\Logging;
use PDO;
use PDOStatement;
use PDOException;
use Restapi\RestApi\Http\Traits\ApiResponse;

/**
 * Class responsible for standarzing database operations.
 */
abstract class Model{
    use ApiResponse, Logging;

    /**
     * Data object.
     * 
     * @var PDO $pdo
     */
    private PDO $pdo;

    /**
     * Constructor method.
     * 
     * @return void
     */
    public function __construct(){
        $this->connect();
    }

    /**
     * Connects to database.
     * 
     * @return true|string true on success 500 code on failure.
     */
    private function connect():true|string{
        try{
            $pdo = new PDO(dsn, dbuser, dbpassword);

            if ($pdo) {
                $this->pdo = $pdo;
                return true;
            }else{
                throw new PDOException('Failed to connect');
            }
        }catch(PDOException $e){
            //Connection failed!
            $this->logError($e);
            return $this->systemFailure();
        }
    }

    /**
     * Prepares statement.
     * 
     * @param string $query The query to be prepared.
     * 
     * @return PDOStatement|string The prepared query on success or error 500 on failure.
     */
    public function prepare(string $query): PDOStatement{
        try{
            return $this->pdo->prepare($query);
        }catch(PDOException $e){
            $this->logError($e);
            return $this->systemFailure();
        }
    }

    /**
     * Executes a statement.
     * 
     * @param PDOStatement $stmt to be executed.
     * 
     * @return array|string Array with results on success or error 500 on failure.
     */
    public function execute(PDOStatement $stmt): array|null{
        try{
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }catch(PDOException $e){
            $this->logError($e);
            return $this->systemFailure();
        }
    }
}