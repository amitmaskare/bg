<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\User;
use App\Models\{Product,Listingproduct};
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use DB;
class AdminMessageController extends Controller
{
    public function index()
    {
        
       $role = Session::get('role');
       $id = Session::get('id');
      
    $query = Message::with(['user', 'seller', 'product'])->latest();
    if ($role != 'admin') {
        $query->where('status', 1)->where('seller_id', $id); 
    }

    $messages = $query->paginate(10);
        return view('admin.messages.message', compact('messages'));
    }
public function updateStatus(Request $request, $id)
{
    $request->validate([
        'status' => 'required|in:1,2',
    ]);

    $message = \App\Models\Message::findOrFail($id);
    $message->status = $request->status;
    $message->save();

    return response()->json(['success' => true]);
}

 public function reply(Request $request, $id)
    {
        $request->validate([
            'reply' => 'required|string|max:2000',
        ]);

        // Make sure seller is replying only to their own message
        $message = Message::where('seller_id', Session::get('id'))->findOrFail($id);
        $message->reply = $request->reply;
        $message->save();

        return redirect()->back()->with('success', 'Reply sent successfully.');
    }

 public function thread($productId)
{
    $role = Session::get('role');
    $userId = Session::get('id');

    $product = ListingProduct::findOrFail($productId);

    $messages = Message::with(['user', 'seller'])
        ->where('product_id', $productId)
        ->when($role != 'admin', function ($query) use ($userId) {
            $query->where('seller_id', $userId);
        })
        ->when($role === 'user', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })
        ->orderBy('created_at', 'asc')
        ->get();

    return view('admin.messages.thread', compact('messages', 'product'));
}

public function send(Request $request)
{
    $request->validate([
        'message' => 'required|string|max:2000',
       
    ]);

    $role = Session::get('role'); // 'user' or 'seller'
    $senderType = $role != 'admin' ? 'seller' : 'user';
    $senderId = Session::get('id');

    // Determine seller_id and user_id based on sender role
    $userId = $senderType === 'user' ? $senderId : $request->input('user_id');
    $sellerId = $senderType === 'seller' ? $senderId : $request->input('seller_id');

    \App\Models\Message::create([
        'message' => $request->message,
        'product_id' => $request->product_id,
        'user_id' => $userId,
        'seller_id' => $sellerId,
        'sender_type' => $senderType,
        'status' => 0, // Pending approval
    ]);

    return back()->with('success', 'Message sent successfully. Awaiting admin approval.');
}

  public function contact_messages_website()
        {
            $contact_messages= DB::table('contact_messages')
                ->orderBy('contact_messages.created_at', 'DESC')
                ->paginate(15);

            return view('admin.contact_messages_website', compact('contact_messages'));
        }     

public function message_deletes($id)
{
    $message = DB::table('contact_messages')->where('id', $id)->first();
    
    if (!$message) {
        return redirect()->back()->with('error', 'Message not found.');     
    }else {
        DB::table('contact_messages')->where('id', $id)->delete();
        return redirect()->back()->with('success', 'Message deleted successfully.');
    }   
}
}
