<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Services\OrderApiService;
use App\Services\WhatsappService;
use Illuminate\Http\Request;

class WhatsappController extends Controller
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
