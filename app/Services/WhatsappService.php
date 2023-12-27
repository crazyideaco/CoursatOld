<?php

namespace App\Services;

use App\Traits\ApiTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WhatsappService
{
    use ApiTrait;
    protected $apiService;
    public function __construct(ApiMethodsService $apiService)
    {
        $this->apiService = $apiService;
    }
    public function send_whatsapp($data)
    {
        try {

            $apiUrl = 'http://crazyidea.online:3001/api/sendText?phone=201212648022&text=test&session=default';

            $headers = [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ];

            $this->apiService->withHeaders($headers)->getApiData($apiUrl);

            // $this->apiService->withHeaders($headers)->postApiData($apiUrl, $data);
            // $responseData = $response->json();
            // // dd($response);

            // $message = "send_whatsapp";

            // return $this->dataResponse($message, $responseData, 200);

        } catch (\Exception $ex) {
            return $this->returnException($ex->getMessage(), 500);
        }
    }
}
