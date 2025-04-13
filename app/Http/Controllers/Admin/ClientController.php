<?php

namespace App\Http\Controllers\Admin;

use Exception;
use DataTables;
use Carbon\Carbon;
use App\Models\Year;
use App\Models\Audit;
use App\Models\Client;
use App\Models\MasterData;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Requests\StoreYearRequest;
use PhpOffice\PhpWord\TemplateProcessor;
use PhpOffice\PhpWord\IOFactory;
use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
use PhpOffice\PhpWord\Element\TextRun;
use PhpOffice\PhpWord\Element\Text;
use PhpOffice\PhpWord\Shared\Html;

class ClientController extends Controller
{


    /**
     * @OA\Get(
     *     path="/admin/client",
     *     tags={"Clients"},
     *     summary="Get list of clients",
     *     description="Get list of clients",
     *     @OA\Parameter(
     *         description="Deleted",
     *         in="query",
     *         name="deleted",
     *         required=false,
     *         example="true",
     *         @OA\Schema(
     *             type="boolean"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Client list"
     *     ),
     *     @OA\Response(
     *         response="default",
     *         description="An unexpected error occurred"
     *     )
     * )
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {
            if ($request->deleted == 'true') {
                $clients = Client::onlyTrashed()->latest();
                return Datatables::of($clients)
                    ->editColumn('created_at', function ($client) {
                        return [
                            'display'   => Carbon::parse($client->created_at)->format('d-m-Y h:i A'),
                            'timestamp' => $client->created_at,
                        ];
                    })->editColumn('client_id', function ($client) {
                        return $this->generateClientId($client->name_of_society, $client->registrationDate);
                    })
                    ->escapeColumns([])

                    ->make(true);
            } else {
                $clients = Client::latest();
                return Datatables::of($clients)
                    ->addColumn('action', function ($client) {
                        $btn = '<a href="/admin/client/edit/' . $client->id . '" class="" title="Edit"><i class="fa fa-edit"></i></a>  <a href="/admin/client/show/' . $client->id . '" class="" title="Show"><i class="fa fa-eye"></i></a>';
                        return $btn;
                    })->editColumn('created_at', function ($client) {
                        return [
                            'display'   => Carbon::parse($client->created_at)->format('d-m-Y h:i A'),
                            'timestamp' => $client->created_at,
                        ];
                    })->editColumn('client_id', function ($client) {
                        return $this->generateClientId($client->name_of_society, $client->registrationDate);
                    })
                    ->escapeColumns([])

                    ->make(true);
            }
        }
        return view('admin.clients.index');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.clients.create');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreClientRequest $request)
    {
        try {
            Client::create($request->all());
            return redirect()->route('admin.clients.index')->with('success', 'Client added successfully');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'An error occurred while adding the client: ' . $e->getMessage()]);
        }
    }

    /**
     * Generate a client ID based on the society name and registration date.
     *
     * This function takes the society name and registration date as inputs,
     * converts the society name to uppercase with spaces replaced by underscores,
     * formats the registration date to include only the year, and combines
     * these elements to create a unique client ID.
     *
     * @param string $societyName The name of the society.
     * @param string $registrationDate The registration date in a format that can be parsed by strtotime.
     * @return string The generated client ID in the format SOCIETYNAME_YYYY.
     */

    public function generateClientId($societyName, $registrationDate)
    {
        // Convert society name to uppercase and replace spaces with underscores
        $societyCode = strtoupper(str_replace(' ', '_', $societyName));

        // Format DOB as YYYYMMDD
        $dobCode = date('Y', strtotime($registrationDate));

        // Combine society code and DOB code to create client ID
        $clientId = $societyCode . '_' . $dobCode;

        return $clientId;
    }

    /**
     * Show the form for editing the specified client.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        $client = Client::find($id);
        return view('admin.clients.edit', compact('client'));
    }

    /**
     * Update the specified client in storage.
     *
     * @param \App\Http\Requests\UpdateClientRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateClientRequest $request)
    {
        try {
            $client = Client::find($request->id);
            $client->update($request->all());
            return redirect()->route('admin.clients.index')->with('success', 'Client updated successfully');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => 'An error occurred while updating the client: ' . $e->getMessage()]);
        }
    }

    /**
     * Display the specified client.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $years = Year::where('client_id', $id)->get();
        $client = Client::find($id);
        return view('admin.clients.show', compact('years', 'client'));
    }

    public function showAddYearForm($id)
    {
        $auditors = Audit::all(); // Assuming you have an Auditor model
        $clients = Client::all(); // Assuming you have a Client model
        $client = Client::find($id);
        return view('admin.clients.addYear', compact('auditors', 'clients', 'client'));
    }

    public function addYear(StoreYearRequest $request)
    {
        try {
            $client = Client::with('audit')->find($request->client_id);
            if (!$client) {
                return redirect()->back()->withErrors(['error' => 'Client not found.']);
            }

            // Handle file upload
            $fileName = null;

            // Copy master.docs file from public folder to storage folder with the name of the client
            $masterFilePath = public_path('master.docx');
            $fileName = $client->name_of_society . '.docx';
            $storageFilePath = storage_path('app/public/uploads/' . $fileName);
            $templateProcessor = new TemplateProcessor($masterFilePath);
            $templateProcessor->setValue('name_of_society', $client->name_of_society ?? '');
            $templateProcessor->setValue('chairman', $client->chairman ?? '');
            $templateProcessor->setValue('registration_no', $client->registration_no ?? '');
            $templateProcessor->setValue('society_address', $client->society_address ?? '');
            $templateProcessor->setValue('taluka', $client->taluka ?? '');
            $templateProcessor->setValue('district', $client->district ?? '');
            $templateProcessor->setValue('audit_year', $client->audit_year ?? '');
            $templateProcessor->setValue('lekha_parikshan_vargwari', $client->lekha_parikshan_vargwari ?? '');
            $templateProcessor->setValue('audit_name', $client->audit->name ?? '');
            $templateProcessor->setValue('audit_registration_no', $client->audit->registration_no ?? '');
            $templateProcessor->setValue('namtalika_vargwari', $client->audit->namtalika_vargwari ?? '');
            $templateProcessor->setValue('audit_address', $client->audit->address ?? '');
            $templateProcessor->setValue('audit_email', $client->audit->email ?? '');
            $templateProcessor->setValue('audit_phone', $client->audit->phone_number ?? '');
            $templateProcessor->setValue('audit_javak_kramank', $client->audit->javak_kramank ?? '');
            $templateProcessor->setValue('audit_date', $client->audit->date ?? '');
            $templateProcessor->saveAs($storageFilePath);
            // End of file upload handling
            $year = new Year();
            $year->audit_year = $request->audit_year;
            $year->auditor_id = $request->auditor_id;
            $year->client_id = $request->client_id;
            $year->file = $fileName;
            $year->save();

            return redirect()->route('admin.client.show', $year->client_id)->with('success', 'Year added successfully');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => 'An error occurred while adding the year: ' . $e->getMessage()]);
        }
    }

    public function destroy($id)
    {

        $year = Year::find($id);
        $year->delete();
        return redirect()->back()->with('success', 'Year deleted successfully');
    }

    public function download($id)
    {
        $year = Year::find($id);
        $filePath = storage_path('app/public/uploads/' . $year->file);
        return response()->download($filePath);
    }
    
    /**
     * Shows the master view for the given year and menu.
     *
     * @param int $id The ID of the year
     * @param string $menu The menu to show
     * @return \Illuminate\Http\Response
     */

    public function master($id)
    {
        
        $year = Year::where('client_id', $id)->first();

        if (!$year) {
            return redirect()->back()->withErrors(['error' => 'Client not found.']);
        }   

        // Get the current menu's dropdown options
        $menu = $year->menu; // Assuming you have a 'menu' field in the Year model
        $dropdownOptions = [];

        switch ($menu) {
            
            case 'menu1':
                $dropdownOptions = [
                    'option1' => 'Option 1',
                    'option2' => 'Option 2',
                    // Add more options as needed
                ];
                break;
            case 'menu2':
                $dropdownOptions = [
                    'option3' => 'Option 3',
                    'option4' => 'Option 4',
                    // Add more options as needed
                ];
                break;
            // Add more cases for other menus   
        }
        // Pass the dropdown options to the view
        return view('admin.clients.master', compact('year', 'dropdownOptions'));
    }
    /**
     * Shows the master view for the given year and menu.
     *
     * @param int $id The ID of the year
     * @param string $menu The menu to show
     * @return \Illuminate\Http\Response
     */
    public function master1($id)
    {
        $year = Year::where('client_id', $id)->first();
        if (!$year) {
            return redirect()->back()->withErrors(['error' => 'Client not found.']);
        }

        // Define sidebar menu items for Master 1
        $sideMenuItems = [
            ['name' => 'वसूल भागभांडवल', 'route' => 'admin.client.master1'],
            ['name' => 'राखीव निधी', 'route' => 'admin.client.master1'],
            ['name' => 'इतर सर्व निधी', 'route' => 'admin.client.master1'],
            ['name' => 'ठेवी', 'route' => 'admin.client.master1'],
            ['name' => 'संचित नफा', 'route' => 'admin.client.master1'],
            ['name' => 'तरतूद', 'route' => 'admin.client.master1'],
            ['name' => 'देणे कर्ज', 'route' => 'admin.client.master1'],
            ['name' => 'इतर देणी', 'route' => 'admin.client.master1'],
            ['name' => 'रोख शिल्लक', 'route' => 'admin.client.master1'],
            ['name' => 'बँक शिल्लक', 'route' => 'admin.client.master1'],
            ['name' => 'गुंतवणूक', 'route' => 'admin.client.master1'],
            ['name' => 'कायम मालमत्ता', 'route' => 'admin.client.master1'],
            ['name' => 'येणे कर्ज', 'route' => 'admin.client.master1'],
            ['name' => 'इतर येणे', 'route' => 'admin.client.master1'],
            ['name' => 'घेणे व्यज', 'route' => 'admin.client.master1'],
            ['name' => 'संचित तोटा', 'route' => 'admin.client.master1'],


        ];

        return view('admin.clients.master1', compact('year', 'sideMenuItems'));
    }

    public function getMasterData(Request $request,$id)
    {
        // dd($request->all());
        try {
            $masterData = MasterData::where('menu', $request->menu)->where('client_id',$id)->get();
            return response()->json(['success' => true, 'data' => $masterData]);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => 'An error occurred: ' . $e->getMessage()], 500);
        }
    }


    public function saveMasterData(Request $request, $id)
    {
  
        try {
            foreach ($request->tableData as $data) {
                MasterData::create([
                    'master' => 1, // Assuming master is always 1 for this case
                    'menu' => $data['menu'] ?? null, // Add menu if available
                    'entity' => $data['entity'],
                    'lastYear' => $data['lastYear'],
                    'currentYear' => $data['currentYear'],
                    'bankAmount' => $data['bankAmount'] ?? null,
                    'client_id' => $id,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
            return response()->json(['success' => true, 'message' => 'Data saved successfully!']);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => 'An error occurred: ' . $e->getMessage()], 500);
        }
    }
    /**
     * Delete the master data.
     *
     * @param int $id The ID of the master data to delete
     * @return \Illuminate\Http\Response
     */
    public function deleteMasterData($id){
        MasterData::where('id', $id)->delete();
        return response()->json(['success' => true, 'message' => 'Data deleted successfully!']);
    }
    public function master2($id)
    {
        $year = Year::where('client_id', $id)->first();
        if (!$year) {
            return redirect()->back()->withErrors(['error' => 'Client not found.']);
        }

        // Define sidebar menu items for Master 1
        $sideMenuItems = [
            ['name' => 'किरकोळ उत्त्पन्न', 'route' => 'admin.client.master1'],
            ['name' => 'कर्जावरील व्याज', 'route' => 'admin.client.master1'],
            ['name' => 'गुंतवणुकीवरील व्याज', 'route' => 'admin.client.master1'],
            ['name' => 'इतर उत्त्पन्न', 'route' => 'admin.client.master1'],
            ['name' => 'ठेवीवरील व्याज', 'route' => 'admin.client.master1'],
            ['name' => 'आस्थापना खर्च', 'route' => 'admin.client.master1'],
            ['name' => 'प्रशासकीय खर्च', 'route' => 'admin.client.master1'],
            ['name' => 'तरतुदी', 'route' => 'admin.client.master1'],
            ['name' => 'इतर खर्च', 'route' => 'admin.client.master1']


        ];

        return view('admin.clients.master1', compact('year', 'sideMenuItems'));
    }


    public function sheet1($id)
    {
        $client = Client::find($id);
        

        return view('admin.clients.sheet1', compact('client'));
    }
}
