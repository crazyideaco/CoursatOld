<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Services\WhatsappService;

class WhatsappController extends Controller
{
    public function screenshot_session_api()
    {
        try {
            $service = new WhatsappService();
            $imageData = $service->screenshot_session();

            // Return the image data as a response
            return response($imageData)->header('Content-Type', 'image/png');
        } catch (\Exception $ex) {
            // Handle any exceptions that might occur
            return response()->json(['error' => $ex->getMessage()], 500);
        }

        // $service = new WhatsappService();
        // return $service->screenshot_session();
    }

}
