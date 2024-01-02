<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

use App\Traits\ApiTrait;
use Illuminate\Http\Request;

class WhatsappService
{
    use ApiTrait;
    protected $apiService;


    public function screenshot_session()
    {
        try {
            $apiUrl = 'http://crazyidea.online:3001/api/screenshot?session=default';

            $headers = [
                'Accept' => 'image/png',
            ];

            $response = Http::withHeaders($headers)->get($apiUrl);

            return $response;

        } catch (\Exception $ex) {
            return $this->returnException($ex->getMessage(), 500);
        }
    }
}
