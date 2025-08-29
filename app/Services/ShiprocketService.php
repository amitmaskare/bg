<?php 

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class ShiprocketService
{
    protected $email = 'amitmaskareshiprocket@gmail.com'; // your registered email
    protected $password = '02CK!%ep9mLp*qwy';       // your Shiprocket password

    // Get Auth Token and Cache it
    public function getToken()
    {
        return Cache::remember('shiprocket_token', 55 * 60, function () {
            $response = Http::post('https://apiv2.shiprocket.in/v1/external/auth/login', [
                'email'    => $this->email,
                'password' => $this->password,
            ]);

            return $response['token'] ?? null;
        });
    }

    // Check Serviceability
    public function checkServiceability($data)
    {
        $token = $this->getToken();

        $response = Http::withToken($token)
            ->get('https://apiv2.shiprocket.in/v1/external/courier/serviceability/', $data);

        return $response->json();
    }
}

?>