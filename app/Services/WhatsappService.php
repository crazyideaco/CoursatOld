<?php

namespace App\Services;

use App\Traits\ApiTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WhatsappService
{


    public function screenshot_session()
    {
        try {
            $apiUrl = 'http://crazyidea.online:3001/api/screenshot?session=default';

            $headers = [
                'Accept' => 'image/png',
            ];

            $response = Http::withHeaders($headers)->get($apiUrl);

            return $response->body();

        } catch (\Exception $ex) {
            return $this->returnException($ex->getMessage(), 500);
        }
    }
}


