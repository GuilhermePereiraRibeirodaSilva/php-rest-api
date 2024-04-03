<?php
namespace Restapi\RestApi\Http\Api\Services;

use Exception;
use Restapi\RestApi\Http\Traits\Logging;
use Restapi\RestApi\Http\Traits\ApiResponse;

/**
 * class responsible by controlling the external api.
 */
class ExternalApiService{
    use ApiResponse, Logging;

    /**
     * Bearer token for access.
     * 
     * @var string $token.
     */
    public $token;

    /**
     * Constructor method.
     */
    public function __construct(){
        $this->authenticate();
    }

    /**
     * Attempts to authenticate.
     */
    private function authenticate(){
        $credentials = base64_encode(login . ':' . password);
        $headers = [
            'Authorization: Basic ' . $credentials,
        ];
        $this->token =  $this->curlRequest('autenticacao/login', $headers);
    }

    /**
     * Performs a request.
     * 
     * @param string $endpoint The endpoint.
     * @param array $headers The request Headers.
     * @param string $method The request method.
     * @param array $body Request body.
     */
    public function curlRequest(string $endpoint,array $headers=[],string $method='POST',$body=[]){
        try{
            $curl = curl_init();
            $curlArray = [
                CURLOPT_URL => apiUrl . $endpoint,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_HTTPHEADER => $headers,
                CURLOPT_CUSTOMREQUEST => $method,
            ];
            if(0 !== count($body)){
                $curlArray[CURLOPT_POSTFIELDS] = json_encode($body);
            }
            curl_setopt_array($curl, $curlArray);
    
            $response = curl_exec($curl);
            $response = trim($response, '"');
            if (curl_errno($curl) || empty($response)) {
                throw new Exception('Request failed');
            } else {
                return $response;
            }

            curl_close($curl);
        }catch(Exception $e){
            $this->logError($e);
            $this->badRequest();
        }
    }
}