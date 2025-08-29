<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Twilio\Rest\Client;
use Exception;

class WhatsAppController extends Controller
{
    public function index()
    {
        return view('whatsapp');
    }

    public function store(Request $request)
    {
        $request->validate([
            'phone' => 'required',
            'message' => 'required'
        ]);

        $twilioSid = env('TWILIO_SID');
        $twilioToken = env('TWILIO_AUTH_TOKEN');
        $twilioWhatsAppNumber = env('TWILIO_WHATSAPP_NUMBER', 'whatsapp:+14155238886'); // Default to sandbox
       
        // Format recipient number
       // $recipientNumber = $this->formatNumber($request->phone);
        $recipientNumber = 'whatsapp:+16477724908';
            
        // Format sender number - must be your Twilio WhatsApp-enabled number
        $fromNumber = $twilioWhatsAppNumber;

        try {
            $twilio = new Client($twilioSid, $twilioToken);
             $message = $twilio->messages
      ->create("whatsapp:+919673673592", // to
        array(
          "from" => "whatsapp:+14155238886",
          "contentSid" => "HXb5b62575e6e4ff6129ad7c8efe1f983e",
          "body" => "Your Message"
        )
      );

echo $message->sid;
            // $message = $twilio->messages->create(
            //     $recipientNumber,
            //     [
            //         "from" => $fromNumber,
            //         "body" => $request->message,
            //     ]
            // );

            return back()->with(['success' => 'WhatsApp message sent successfully!']);

        } catch (Exception $e) {
            return back()->with(['error' => $e->getMessage()]);
        }
    }

    protected function formatNumber($number)
    {
        // Remove all non-numeric characters
        $number = preg_replace('/[^0-9]/', '', $number);
        
        // If number doesn't start with country code, add +91 (India) as default
        // Change this to your target country code if different
        if (!preg_match('/^\+/', $number)) {
            $number = '+91' . $number; // Changed to +91 for India, modify as needed
        }
        
        // Add 'whatsapp:' prefix required by Twilio
        return 'whatsapp:' . $number;
    }
}