<?php

namespace App\Http\Controllers;

use App\Models\{Address,EmailTemplate};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    // Show all addresses
    public function index()
    {
        $addresses = Address::all(); // Retrieve all addresses
        return view('address.index', compact('addresses')); // You can create a view to display them
    }

    // Store a new address
    public function store(Request $request)
    {
        $userDI = Auth::user()->id;
        // Validate the request
        $request->validate([
            'address_line' => 'required|string|max:255',
            'city' => 'required|string|max:100',
            'postal_code' => 'required|string|max:20',
            'state' => 'nullable|string|max:100',
            'country' => 'required|string|max:100',
            'type' => 'nullable|in:home,work,other',
        ]);

        // Insert the address
        $address = Address::create([
            'user_id' => $userDI,
            'address_line' => $request->address_line,
            'city' => $request->city,
            'postal_code' => $request->postal_code,
            'state' => $request->state,
            'country' => $request->country,
            'type' => $request->type ?? 'home', // default to 'home' if not provided
        ]);

        // Return JSON response
        return response()->json([
            'success' => true,
            'message' => 'Address saved successfully.',
            'newAddress' => $address
        ]);
    }

    public function storecheckoute(Request $request)
    {
        $userDI = Auth::user()->id;
        // Validate the request
        $request->validate([
            'address_line' => 'required|string|max:255',
            'city' => 'required|string|max:100',
            'postal_code' => 'required|string|max:20',
            'state' => 'nullable|string|max:100',
            'country' => 'required|string|max:100',
            'type' => 'nullable|in:home,work,other',
        ]);

        // Insert the address
        $address = Address::create([
            'user_id' => $userDI,
            'address_line' => $request->address_line,
            'city' => $request->city,
            'postal_code' => $request->postal_code,
            'state' => $request->state,
            'country' => $request->country,
            'type' => $request->type ?? 'home', // default to 'home' if not provided
        ]);

        return back()->with(['success' => 'Address Added successfully!']);

    }
    // Delete an address
    public function destroy($id)
    {
        $address = Address::where('id', $id)->where('user_id', auth()->id())->first();
    
        if (!$address) {
            return response()->json(['success' => false, 'message' => 'Address not found.'], 404);
        }
    
        $address->delete();
    
        return response()->json(['success' => true, 'message' => 'Address deleted successfully.']);
    }
    public function show($id)
    {
        $address = Address::where('id', $id)->where('user_id', auth()->id())->first();
        return $address
            ? response()->json(['success' => true, 'address' => $address])
            : response()->json(['success' => false], 404);
    }
    
    public function update(Request $request, $id)
    {
        $request->validate([
            'address_line' => 'required',
            'city' => 'required',
            'postal_code' => 'required',
            'state' => 'nullable',
            'country' => 'required',
            'type' => 'required'
        ]);
    
        $address = Address::where('id', $id)->where('user_id', auth()->id())->first();
        if (!$address) {
            return response()->json(['success' => false], 404);
        }
    
        $address->update($request->all());
        return response()->json(['success' => true, 'message' => 'Address updated successfully.']);
    }
    
}
