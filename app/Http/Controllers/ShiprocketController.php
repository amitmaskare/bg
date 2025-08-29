<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ShiprocketService;
class ShiprocketController extends Controller
{
    protected $shiprocket;

    public function __construct(ShiprocketService $shiprocket)
    {
        $this->shiprocket = $shiprocket;
    }

    public function checkServiceability()
    {
        $data = [
            'pickup_postcode'    => '110001',
            'delivery_postcode'  => '110033',
            'weight'             => '50',
            'cod'                => false,
            'declared_value'     => '1000',
        ];

        $response = $this->shiprocket->checkServiceability($data);
        return response()->json($response);
    }
}
