<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Services\OrderApiService;
use App\Services\WhatsappService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WhatsappWebController extends Controller
{
    public function index()
    {
        return view("dashboard.scan_whatsapp.index");
    }

    /**
     * Capture a screenshot of the current session and return it as a response.
     *
     * @throws \Exception if any exceptions occur during the process.
     * @return \Illuminate\Http\Response the image data as a response with 'Content-Type' header set to 'image/png'.
     */
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
