<?php

namespace Restapi\RestApi\Http\Api\Services;

abstract class Service{
    /**
     * constant part of headers.
     * 
     * @var array $headers.
     */
    protected array $headers;

    /**
     * External api service.
     * 
     * @var ExternalApiService $clientModel
     */
    protected ExternalApiService $externalApiService;

    /**
     * Constrctor method. Loads dependencies.
     */
    public function __construct(){
        $this->externalApiService = new ExternalApiService();
        $this->headers = [
            'Authorization: Bearer ' . $this->externalApiService->token,
        ];
    }
}