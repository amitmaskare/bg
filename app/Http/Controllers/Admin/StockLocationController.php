<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StockLocation;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use DB;

class StockLocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['stocklocations']=DB::table('stocklocations as s')
        ->select('s.*',)
        ->get();
        return view('admin.stockLocations.list',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */


public function ajax_manage_page(Request $request)
{
    $StockLocation = new StockLocation();

    $getData = $StockLocation->getDatatables($request);
    $start = $request->input('start', 0);
    $draw = $request->input('draw', 1);
    $data = [];
    $no = $start;

    foreach ($getData as $item) {
        $btn = '';

        // === Actions: mimic @admincan checks ===
       // if (auth()->check() && auth()->user()->can('stocklocation-edit')) {
            $btn .= '<a href="' . route('stockLocations.edit', $item->id) . '" class="btn-success btn-sm me-1"><i class="fa fa-edit" style="color:white"></i></a>';
      //  }

       // if (auth()->check() && auth()->user()->can('stocklocation-delete')) {
            $btn .= '<a href="' . route('stockLocations.delete', $item->id) . '" onclick="return confirm(\'Are you sure you want to delete this item?\')" class="btn-danger btn-sm"><i class="fa fa-trash" style="color:white"></i></a>';
      //  }

        $no++;

        $status = $item->status == '0'
            ? '<span class="badge bg-success">Active</span>'
            : '<span class="badge bg-danger">Inactive</span>';

        $nestedData = [];
        $nestedData[] = $no;                       // #
        $nestedData[] = $item->name;               // name
        $nestedData[] = $item->city;               // city
        $nestedData[] = $item->postal_code;        // postal_code
        $nestedData[] = $item->country;            // country
        $nestedData[] = $item->contactInformation; // contactInformation
        $nestedData[] = $status;                   // status badge
        $nestedData[] = $btn;                      // action buttons

        $data[] = $nestedData;
    }

    $output = [
        "draw" => $draw,
        "recordsTotal" => $StockLocation->countAll(),
        "recordsFiltered" => $StockLocation->countFiltered($request),
        "data" => $data,
    ];

    return response()->json($output);
}  
    public function addstockLocations()
    {
    
        // $countries = ['India'];
        // $state = ['Delhi'];
        // $cities = ['Amsterdam', 'Berlin', 'Paris'];    
        $countries = Country::where('countryName', 'India')->get();
        $state = State::where('stateName', 'Delhi')->get(); // default state
        $cities = City::whereHas('state', function ($q) {
            $q->where('stateID', '100');
        })->get();   
        $Direction = ['South Delhi', 'North Delhi', 'West Delhi'];    
        return view('admin.stockLocations.add', compact('countries', 'cities','state','Direction'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function savestockLocations(Request $request)
    {
      //  dd($_POST['name']); exit;
        // $validated = $request->validate([
        //     'sellerID' => 'required|exists:users,id',
        //     'name' => 'required|string',
        //     'address' => 'nullable|string',
        //     'city' => 'required|string',
        //     'postal_code' => 'required|string',
        //     'country' => 'required|string',
        //     'contact_information' => 'nullable|string',
        // ]);
        $name = $_POST['name'];
        $sellerID = $_POST['sellerID'];
        $address = $_POST['address'];
        $city = $_POST['city'];
        $country = $_POST['country'];
        $state = $_POST['state'];
        $contact_information = $_POST['contact_information'];
        $direction = $_POST['direction'];
        $postal_code = $_POST['postal_code'];

       StockLocation::create([
        'sellerID' => $sellerID,
        'name' => $name,
        'address' => $address,
        'state' => $state,
        'city' => $city,
        'postal_code' =>$postal_code,
        'country' => $country,
        'direction' => $direction,
        'contactInformation' => $contact_information,

       
    ]);
        return redirect()->route('stockLocations')->with('success', 'Location added.');
    }
    public function edit($id)
    {
        $StockLocation = StockLocation::findOrFail($id);
        $countries = Country::where('countryName', 'India')->get();
        $state = State::where('stateName', 'Delhi')->get(); // default state
        $cities = City::whereHas('state', function ($q) {
            $q->where('stateID', '100');
        })->get();   
        $Direction = ['South Delhi', 'North Delhi', 'West Delhi'];    
        return view('admin.stockLocations.edit', compact('StockLocation','countries', 'cities','Direction','state'));
    }
    public function update(Request $request)
    {
        // Validate the input data
        $request->validate([
            'id' => 'required|exists:stocklocations,id',  // Ensure the ID exists in the table
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'city' => 'required|string',
            'country' => 'required|string',
            'contact_information' => 'required|string',  // Ensure correct field name (camelCase)
        ]);
    
        // Find the existing record
        $stockLocation = StockLocation::find($request->id);
    
        if ($stockLocation) {
            // Try updating the record
            $updated = $stockLocation->update([
                'name' => $request->name,
                'address' => $request->address,
                'city' => $request->city,
                'country' => $request->country,
                'contactInformation' => $request->contact_information,
                'sellerID' => $request->sellerID,  
                'postal_code' => $request->postal_code,  
                'direction' => $request->direction, 
                'state' => $request->state ?? 1, 

            ]);
    
            // Check if the update was successful
            if ($updated) {
                return redirect()->route('stockLocations')
                    ->with('success', 'Stock Location updated successfully.');
            } else {
                // If update fails (no changes made), show an error
                return back()->withErrors(['update_failed' => 'Failed to update stock location. Please try again.']);
            }
        } else {
            // If stockLocation is not found, show an error
            return back()->withErrors(['stockLocation_not_found' => 'Stock location not found.']);
        }
    }
    
    public function delete($id)
    {
        $location = StockLocation::find($id);

        if (!$location) {
            return redirect()->back()->with('error', 'Stock Location not found.');
        }

        $location->delete();

        return redirect()->route('stockLocations')->with('success', 'Stock Location deleted successfully.');
    }

    public function saveStockAjax(Request $request)
    {
        $name = StockLocation::create([
            'name' => $request->name,
            'city'=>' ',
            'postal_code'=>' ',
            'direction'=>' ',
            'country'=>' ',
            'state'=>' ',
            'address'=>' ',
            'contactInformation'=>' '
           
        ]);
        
        return response()->json([
            'success' => true,
            'name' => $name,
        ]);
    }


}