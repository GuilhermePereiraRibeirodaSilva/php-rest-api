<?php
namespace Restapi\RestApi\Http\Traits;

/**
 * Trait Responsible for standarzing the responses.
 */
trait ApiResponse{
    /**
     * Retuns 500 code's message.
     * 
     * @return void
     */
    public function systemFailure():void{
        $code = 500;
        $return = [
            'code' => $code,
            'message' => 'Falha no servidor, tente novamente mais tarde.'
        ];
        echo json_encode(
            $return
        );
        http_response_code($code);  
        die();
    }

    /**
     * Retuns 400 code's message.
     * 
     * @return void
     */
    public function badRequest():void{
        $code = 400;
        $return = [
            'code' => $code,
            'message' => 'O request não foi formado corretamente. Tente novamente.'
        ];
        echo json_encode(
            $return
        );
        http_response_code($code);  
        die();
    }

    /**
     * Retuns 404 code's message.
     * 
     * @return void
     */
    public function notFound():void{
        $code = 404;
        $return = [
            'code' => $code,
            'message' => 'Instância não encontrada.'
        ];
        echo json_encode(
            $return
        );
        http_response_code($code);  
        die();
    }

    /**
     * Retuns 200 code's message.
     * 
     * @param array $data Data to be returned.
     * 
     * @return void
     */
    public function ok(array $data = []):void{
        $code = 200;
        $return = [
            'code' => $code,
            'message' => $data
        ];
        echo json_encode(
            $return
        );
        http_response_code($code);  
        die();
    }
}