<?php

namespace App\Http\Controllers\Admin;

use Exception;
use DataTables;
use Carbon\Carbon;
use App\Models\Year;
use App\Models\Audit;
use App\Models\Client;
use App\Models\MasterData;
use App\Models\ClientInput;
use Illuminate\Http\Request;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\Shared\Html;
use PhpOffice\PhpWord\Element\Text;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use PhpOffice\PhpWord\Element\TextRun;
use App\Http\Requests\StoreYearRequest;
use PhpOffice\PhpWord\TemplateProcessor;
use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;

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
            ['name' => 'तरतुदी', 'route' => 'admin.client.master1'],
            ['name' => 'देणे कर्ज', 'route' => 'admin.client.master1'],
            ['name' => 'इतर देणी', 'route' => 'admin.client.master1'],
            ['name' => 'शाखा ठेवी देणे', 'route' => 'admin.client.master1'],
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

    public function getMasterData(Request $request, $id)
    {
        try {
            $masterData = MasterData::where('menu', $request->menu)->where('client_id', $id)->get();
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
    public function deleteMasterData($id)
    {
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
            ['name' => 'तरतूद खर्च', 'route' => 'admin.client.master1'],
            ['name' => 'इतर खर्च', 'route' => 'admin.client.master1']


        ];

        return view('admin.clients.master1', compact('year', 'sideMenuItems'));
    }


    public function sheet1($client_id, $sheet_no)
    {
        if ($sheet_no == 1) {
            $client = Client::with('masterData')->find($client_id);
            $auditor = Audit::where('user_id', auth()->id())->first();
            $clientInputs = ClientInput::where('client_id', $client_id)->pluck('value', 'key');

            // Get all master data once and group by menu for efficient processing
            $masterDataByMenu = $client->masterData->groupBy('menu');
            
            // Define all menus that need processing
            $menusToProcess = [
                'वसुल भाग भागभांडवल',
                'राखीव निधी',
                'ठेवी',
                'गुंतवणूक',
                'संचित नफा',
                'रोख शिल्लक',
                'बँक शिल्लक',
                'देणे कर्ज',
                'येणे कर्ज'
            ];

            // Process all menus in a single loop
            foreach ($menusToProcess as $menu) {
                $data = $masterDataByMenu->get($menu, collect());
                $client[$menu] = $data;
                $client[$menu . '_sum'] = $data->sum('currentYear');
                
                // Add specific sum fields for certain menus
                if (in_array($menu, ['वसुल भाग भागभांडवल', 'देणे कर्ज', 'येणे कर्ज'])) {
                    $client[$menu . '_sum_currentYear'] = $data->sum('currentYear');
                }
            }

            // Process income and expense calculations efficiently
            $incomeMenus = ['इतर उत्त्पन्न', 'गुंतवणुकीवरील व्याज', 'कर्जावरील व्याज', 'किरकोळ उत्त्पन्न'];
            $expenseMenus = ['इतर खर्च', 'तरतूद खर्च', 'प्रशासकीय खर्च', 'आस्थापना खर्च', 'ठेवीवरील व्याज'];
            
            $client['नफा_तोटा_sum'] = $this->calculateNetProfitLoss($masterDataByMenu, $incomeMenus, $expenseMenus);

            // Calculate working capital efficiently
            $workingCapitalMenus = ['रोख शिल्लक', 'बँक शिल्लक', 'गुंतवणूक', 'कायम मालमत्ता', 'येणे कर्ज', 'इतर येणे', 'घेणे व्यज', 'संचित तोटा'];
            $client['खेळते भागभांडवल_sum'] = $this->sumMenuValues($masterDataByMenu, $workingCapitalMenus);

            return view('admin.clients.sheet1', compact('client', 'clientInputs', 'auditor'));
        } else if ($sheet_no == 2) {
            $client = Client::with('masterData')->find($client_id);
            $auditor = Audit::where('user_id', auth()->id())->first();
            $clientInputs = ClientInput::where('client_id', $client_id)
                ->pluck('value', 'key');
            return view('admin.clients.sheet2', compact('client', 'auditor', 'clientInputs'));
        } else if ($sheet_no == 3) {
            $client = Client::with('masterData','year')->find($client_id);
            $auditor = Audit::where('user_id', auth()->id())->first();
            $clientInputs = ClientInput::where('client_id', $client_id)
                ->pluck('value', 'key');
            
            // Get all master data once and group by menu
            $masterDataByMenu = $client->masterData->groupBy('menu');
            
            // Process all required menus efficiently
            $menusToProcess = [
                'रोख शिल्लक', 'बँक शिल्लक', 'गुंतवणूक', 'कायम मालमत्ता', 
                'येणे कर्ज', 'ठेवी', 'इतर देणी', 'वसुल भाग भागभांडवल', 
                'राखीव निधी', 'संचित तोटा'
            ];

            foreach ($menusToProcess as $menu) {
                $data = $masterDataByMenu->get($menu, collect());
                $client[$menu] = $data;
                $client[$menu . '_sum'] = $data->sum('currentYear');
                
                if (in_array($menu, ['वसुल भाग भागभांडवल', 'राखीव निधी', 'येणे कर्ज'])) {
                    $client[$menu . '_sum_currentYear'] = $data->sum('currentYear');
                }
            }

            // Process special entity-based calculations
            $specialEntities = [
                'इमारत निधी' => 'इतर सर्व निधी',
                'गुंतवणूक चढ उतार निधी' => 'इतर सर्व निधी',
                'लाभांश समीकरण' => 'इतर सर्व निधी'
            ];

            foreach ($specialEntities as $entityName => $menu) {
                $data = $masterDataByMenu->get($menu, collect())->where('entity', $entityName);
                $client[$entityName] = $data;
                $client[$entityName . '_sum_currentYear'] = $data->sum('currentYear');
            }

            // Calculate profit/loss for both years efficiently
            $incomeMenus = ['इतर उत्त्पन्न', 'गुंतवणुकीवरील व्याज', 'कर्जावरील व्याज', 'किरकोळ उत्त्पन्न'];
            $expenseMenus = ['इतर खर्च', 'तरतूद खर्च', 'प्रशासकीय खर्च', 'आस्थापना खर्च', 'ठेवीवरील व्याज'];
            
            $client['नफा_तोटा_sum_lastYear'] = $this->calculateNetProfitLoss($masterDataByMenu, $incomeMenus, $expenseMenus, 'lastYear');
            $client['नफा_तोटा_sum_currentYear'] = $this->calculateNetProfitLoss($masterDataByMenu, $incomeMenus, $expenseMenus, 'currentYear');

            return view('admin.clients.sheet3', compact('client', 'auditor', 'clientInputs'));
        } else if ($sheet_no == 4) {
            $client = Client::with('masterData')->find($client_id);
            $auditor = Audit::where('user_id', auth()->id())->first();
            $clientInputs = ClientInput::where('client_id', $client_id)
                ->pluck('value', 'key');
            
            // Get all master data once and group by menu
            $masterDataByMenu = $client->masterData->groupBy('menu');
            
            // Process all required menus efficiently
            $menusToProcess = [
                'वसुल भाग भागभांडवल', 'राखीव निधी', 'ठेवी', 'येणे कर्ज', 
                'गुंतवणूक', 'कायम मालमत्ता', 'संचित तोटा', 'तरतुदी'
            ];

            foreach ($menusToProcess as $menu) {
                $data = $masterDataByMenu->get($menu, collect());
                $client[$menu] = $data;
                $client[$menu . '_sum_lastYear'] = $data->sum('lastYear');
                $client[$menu . '_sum_currentYear'] = $data->sum('currentYear');
            }

            // Process special entity-based calculations
            $specialEntities = [
                'इमारत निधी' => 'इतर सर्व निधी',
                'गुंतवणूक चढ उतार निधी' => 'इतर सर्व निधी',
                'लाभांश समीकरण' => 'इतर सर्व निधी'
            ];

            foreach ($specialEntities as $entityName => $menu) {
                $data = $masterDataByMenu->get($menu, collect())->where('entity', $entityName);
                $client[$entityName . '_sum_lastYear'] = $data->sum('lastYear');
                $client[$entityName . '_sum_currentYear'] = $data->sum('currentYear');
            }

            // Calculate profit/loss for both years
            $incomeMenus = ['इतर उत्त्पन्न', 'गुंतवणुकीवरील व्याज', 'कर्जावरील व्याज', 'किरकोळ उत्त्पन्न'];
            $expenseMenus = ['इतर खर्च', 'तरतूद खर्च', 'प्रशासकीय खर्च', 'आस्थापना खर्च', 'ठेवीवरील व्याज'];
            
            $client['नफा_तोटा_sum_lastYear'] = $this->calculateNetProfitLoss($masterDataByMenu, $incomeMenus, $expenseMenus, 'lastYear');
            $client['नफा_तोटा_sum_currentYear'] = $this->calculateNetProfitLoss($masterDataByMenu, $incomeMenus, $expenseMenus, 'currentYear');

            // Calculate management expenses
            $managementExpenseMenus = ['आस्थापना खर्च', 'प्रशासकीय खर्च'];
            $totalIncome2 = $this->sumMenuValues($masterDataByMenu, $managementExpenseMenus, 'lastYear');
            $totalExpense2 = $this->sumMenuValues($masterDataByMenu, $managementExpenseMenus, 'currentYear');

            // Calculate other required values
            $incomeMenu3 = ['वसूल भागभांडवल', 'राखीव निधी', 'इतर सर्व निधी', 'ठेवी', 'संचित नफा', 'तरतुदी', 'देणे कर्ज', 'इतर देणी', 'शाखा ठेवी देणे'];
            $client['totalIncome6'] = $this->sumMenuValues($masterDataByMenu, $incomeMenu3, 'lastYear');
            
            $client['येणे कर्ज_sum'] = $masterDataByMenu->get('येणे कर्ज', collect())->sum('currentYear');
            
            $menus = ['बँक भाग हिस्से','दि को-ऑप बँक भाग हिस्से','पत संस्था भाग हिस्से','महा राज्य भाग हिस्से','शेअर्स'];
            $client['इतर भाग'] = $masterDataByMenu->get('गुंतवणूक', collect())->whereIn('entity', $menus)->sum('currentYear');
            
            $client['ठेवी_sum'] = $masterDataByMenu->get('ठेवी', collect())->sum('currentYear');
            
            $incomeTotalMenus = ['रोख शिल्लक', 'बँक शिल्लक', 'गुंतवणूक', 'कायम मालमत्ता', 'येणे कर्ज', 'इतर येणे', 'घेणे व्यज', 'संचित तोटा'];
            $client['खेळते भागभांडवल_sum'] = $this->sumMenuValues($masterDataByMenu, $incomeTotalMenus);
            
            $client['इतर देणी_sum_currentYear'] = $masterDataByMenu->get('इतर देणी', collect())->sum('currentYear');
            
            $client['बँक शिल्लक_sum_currentYear'] = $masterDataByMenu->get('बँक शिल्लक', collect())->sum('currentYear');
            $client['इतर येणे_sum_currentYear'] = $masterDataByMenu->get('इतर येणे', collect())->sum('currentYear');
            
            // Calculate CRAR efficiently
            $client['CRAR_sum'] = $this->calculateCRAR($client);

            return view('admin.clients.sheet4', compact('client', 'auditor', 'clientInputs', 'totalIncome2', 'totalExpense2'));
        } else if ($sheet_no == 5) {
            $client = Client::with('masterData', 'year')->find($client_id);
            
            // Get all master data once and group by menu
            $masterDataByMenu = $client->masterData->groupBy('menu');
            
            // Process income menu calculations
            $incomeMenu3 = ['वसूल भागभांडवल', 'राखीव निधी', 'इतर सर्व निधी', 'ठेवी', 'संचित नफा', 'तरतुदी', 'देणे कर्ज', 'इतर देणी', 'शाखा ठेवी देणे'];
            $client['totalIncome6'] = $this->sumMenuValues($masterDataByMenu, $incomeMenu3, 'lastYear');
            $client['totalIncome7'] = $this->sumMenuValues($masterDataByMenu, $incomeMenu3, 'currentYear');
            
            // Process all required menus efficiently
            $menusToProcess = [
                'वसुल भाग भागभांडवल', 'राखीव निधी', 'इतर सर्व निधी', 'ठेवी', 'तरतुदी'
            ];

            foreach ($menusToProcess as $menu) {
                $data = $masterDataByMenu->get($menu, collect());
                $client[$menu] = $data;
                $client[$menu . '_sum_lastYear'] = $data->sum('lastYear');
                $client[$menu . '_sum_currentYear'] = $data->sum('currentYear');
            }

            // Process special entity-based calculations
            $specialEntities = [
                'बुडीत कर्ज निधी', 'कर्मचारी भविष्य निर्वाह निधी', 'कल्याण निधी', 
                'सुरक्षा ठेव निधी', 'इमारत निधी', 'आकस्मिक फंड'
            ];

            foreach ($specialEntities as $entityName) {
                $data = $masterDataByMenu->get('इतर सर्व निधी', collect())->where('entity', $entityName);
                $client[$entityName] = $data;
                $client[$entityName . '_sum_currentYear'] = $data->sum('currentYear');
                $client[$entityName . '_sum_lastYear'] = $data->sum('lastYear');
            }

            // Process deposit types
            $depositTypes = [
                'बचत ठेव', 'कुटुंबनिर्वाह मासिक व्याज योजना', 'मुदत ठेव', 
                'दामदुप्पट ठेव', 'दामतिप्पट ठेव', 'दामचौपट ठेव', 'आवर्त ठेव'
            ];

            foreach ($depositTypes as $depositType) {
                $data = $masterDataByMenu->get('ठेवी', collect())->where('entity', $depositType);
                $client[$depositType] = $data;
                $client[$depositType . '_sum_currentYear'] = $data->sum('currentYear');
                $client[$depositType . '_sum_lastYear'] = $data->sum('lastYear');
            }

            // Process provision types
            $provisionTypes = [
                'एन पी ए तरतूद', 'कर्मचारी बोनस', 'शिक्षण निधी तरतूद', 
                'निवडणूक खर्च तरतूद', 'ऑडिट फी तरतूद'
            ];

            foreach ($provisionTypes as $provisionType) {
                $data = $masterDataByMenu->get('तरतूद', collect())->where('entity', $provisionType);
                $client[$provisionType] = $data;
                $client[$provisionType . '_sum_currentYear'] = $data->sum('currentYear');
                if (in_array($provisionType, ['शिक्षण निधी तरतूद'])) {
                    $client[$provisionType . '_sum_lastYear'] = $data->sum('lastYear');
                }
            }

            // Process other liability types
            $otherLiabilityTypes = [
                'कर्ज अनामत', 'विशेष वसुली चार्ज', 'जि एस टी', 'निवडणूक खर्च', 
                'टी डी एस', 'पतसंस्था रिकव्हरी चार्ज', 'पतसंस्था प्रोसेस चार्ज'
            ];

            foreach ($otherLiabilityTypes as $liabilityType) {
                $data = $masterDataByMenu->get('इतर देणी', collect())->where('entity', $liabilityType);
                $client[$liabilityType] = $data;
                $client[$liabilityType . '_sum_currentYear'] = $data->sum('currentYear');
            }

            // Calculate total income 9
            $totalIncome9Components = [
                'इतर देणी_sum_currentYear', 'कर्ज अनामत_sum_currentYear', 'विशेष वसुली चार्ज_sum_currentYear',
                'जि एस टी_sum_currentYear', 'निवडणूक खर्च_sum_currentYear', 'टी डी एस_sum_currentYear',
                'पतसंस्था रिकव्हरी चार्ज_sum_currentYear', 'पतसंस्था प्रोसेस चार्ज_sum_currentYear'
            ];
            
            $client['totalIncome9'] = array_sum(array_map(function($component) use ($client) {
                return $client[$component] ?? 0;
            }, $totalIncome9Components));

            // Process remaining menus
            $remainingMenus = [
                'को.ऑप. बँक मुदत ठेव तारण कर्ज', 'संचित नफा', 'शाखा ठेवी देणे', 
                'देणे कर्ज', 'रोख शिल्लक', 'येणे कर्ज'
            ];

            foreach ($remainingMenus as $menu) {
                $data = $masterDataByMenu->get($menu, collect());
                $client[$menu] = $data;
                $client[$menu . '_sum_currentYear'] = $data->sum('currentYear');
                
                if (in_array($menu, ['को.ऑप. बँक मुदत ठेव तारण कर्ज', 'संचित नफा'])) {
                    $client[$menu . '_sum_lastYear'] = $data->sum('lastYear');
                }
            }

            // Calculate working capital
            $incomeMenu8 = ['रोख शिल्लक', 'बँक शिल्लक', 'गुंतवणूक', 'कायम मालमत्ता', 'येणे कर्ज', 'इतर येणे', 'घेणे व्यज', 'संचित तोटा'];
            $client['मालमत्ता व येणे बाजू'] = $this->sumMenuValues($masterDataByMenu, $incomeMenu8);

            // Process remaining calculations
            $client['बँक शिल्लक_sum_currentYear'] = $masterDataByMenu->get('बँक शिल्लक', collect())->sum('currentYear');
            $client['गुंतवणूक_sum'] = $masterDataByMenu->get('गुंतवणूक', collect())->sum('currentYear');
            $client['कायम मालमत्ता_sum_currentYear'] = $masterDataByMenu->get('कायम मालमत्ता', collect())->sum('currentYear');
            $client['इतर देणी_sum_currentYear'] = $masterDataByMenu->get('इतर देणी', collect())->sum('currentYear');
            $client['घेणे व्यज_sum_currentYear'] = $masterDataByMenu->get('घेणे व्यज', collect())->sum('currentYear');

            // Calculate profit/loss
            $incomeMenus = ['इतर उत्त्पन्न', 'गुंतवणुकीवरील व्याज', 'कर्जावरील व्याज', 'किरकोळ उत्त्पन्न'];
            $expenseMenus = ['इतर खर्च', 'तरतूद खर्च', 'प्रशासकीय खर्च', 'आस्थापना खर्च', 'ठेवीवरील व्याज'];
            
            $client['नफा_तोटा_sum_currentYear'] = $this->calculateNetProfitLoss($masterDataByMenu, $incomeMenus, $expenseMenus, 'currentYear');
            $client['नफा_तोटा_sum_lastYear'] = $this->calculateNetProfitLoss($masterDataByMenu, $incomeMenus, $expenseMenus, 'lastYear');

            $clientInputs = ClientInput::where('client_id', $client_id)->pluck('value', 'key');
            $client['इतर येणे_sum_currentYear'] = $masterDataByMenu->get('इतर येणे', collect())->sum('currentYear');
            $client['संचित तोटा_sum_currentYear'] = $masterDataByMenu->get('संचित तोटा', collect())->sum('currentYear');
            $client['ठेवी_sum'] = $masterDataByMenu->get('ठेवी', collect())->sum('currentYear');
         
            return view('admin.clients.sheet5', compact('client', 'clientInputs'));
        } else if ($sheet_no == 6) {
            $client = Client::with('masterData', 'year')->find($client_id);
            
            // Get all master data once and group by menu
            $masterDataByMenu = $client->masterData->groupBy('menu');
            
            // Process all required menus efficiently
            $menusToProcess = [
                'कर्जावरील व्याज', 'गुंतवणुकीवरील व्याज', 'इतर उत्त्पन्न', 'ठेवीवरील व्याज',
                'आस्थापना खर्च', 'प्रशासकीय खर्च', 'तरतुदी', 'इतर खर्च'
            ];

            foreach ($menusToProcess as $menu) {
                $data = $masterDataByMenu->get($menu, collect());
                $client[$menu] = $data;
                $client[$menu . '_sum_currentYear'] = $data->sum('currentYear');
                $client[$menu . '_sum_lastYear'] = $data->sum('lastYear');
            }

            // Process working capital and other calculations
            $incomeMenu3 = ['वसूल भागभांडवल', 'राखीव निधी', 'इतर सर्व निधी', 'ठेवी', 'संचित नफा', 'तरतुदी', 'देणे कर्ज', 'इतर देणी', 'शाखा ठेवी देणे'];
            $client['खेळते भांडवल'] = $this->sumMenuValues($masterDataByMenu, $incomeMenu3);

            $client['वसुल भाग भागभांडवल_sum_currentYear'] = $masterDataByMenu->get('वसूल भागभांडवल', collect())->sum('currentYear');
            $client['निधी_sum_currentYear'] = $masterDataByMenu->get('राखीव निधी', collect())->sum('currentYear');
            $client['ठेवी_sum'] = $masterDataByMenu->get('ठेवी', collect())->sum('currentYear');
            $client['ठेवी_sum_lastYear'] = $masterDataByMenu->get('ठेवी', collect())->sum('lastYear');
            $client['रोख शिल्लक_sum'] = $masterDataByMenu->get('रोख शिल्लक', collect())->sum('currentYear');
            $client['बँक शिल्लक_sum'] = $masterDataByMenu->get('बँक शिल्लक', collect())->sum('currentYear');
            $client['गुंतवणूक_sum'] = $masterDataByMenu->get('गुंतवणूक', collect())->sum('currentYear');
            $client['देणे कर्ज_sum_currentYear'] = $masterDataByMenu->get('देणे कर्ज', collect())->sum('currentYear');
            $client['इतर येणे_sum_currentYear'] = $masterDataByMenu->get('इतर येणे', collect())->sum('currentYear');
            $client['येणे कर्ज_sum'] = $masterDataByMenu->get('येणे कर्ज', collect())->sum('currentYear');
            $client['घेणे व्यज_sum_currentYear'] = $masterDataByMenu->get('घेणे व्यज', collect())->sum('currentYear');
            $client['वसुल भाग भागभांडवल_sum_lastYear'] = $masterDataByMenu->get('वसूल भागभांडवल', collect())->sum('lastYear');

            $incomeTotalMenus = ['रोख शिल्लक', 'बँक शिल्लक', 'गुंतवणूक', 'कायम मालमत्ता', 'येणे कर्ज', 'इतर येणे', 'घेणे व्यज', 'संचित तोटा'];
            $client['खेळते भागभांडवल_sum'] = $this->sumMenuValues($masterDataByMenu, $incomeTotalMenus);
            $client['इतर देणी_sum_currentYear'] = $masterDataByMenu->get('इतर देणी', collect())->sum('currentYear');
            $client['राखीव निधी_sum_currentYear'] = $masterDataByMenu->get('राखीव निधी', collect())->sum('currentYear');
            $client['इतर सर्व निधी_sum_currentYear'] = $masterDataByMenu->get('इतर सर्व निधी', collect())->sum('currentYear');
            
            $incomeMenus = ['इतर उत्त्पन्न', 'गुंतवणुकीवरील व्याज', 'कर्जावरील व्याज', 'किरकोळ उत्त्पन्न'];
            $expenseMenus = ['इतर खर्च', 'तरतूद खर्च', 'प्रशासकीय खर्च', 'आस्थापना खर्च', 'ठेवीवरील व्याज'];

            $client['एकूण उत्पन्न_sum_currentYear'] = $this->sumMenuValues($masterDataByMenu, $incomeMenus);
            $totalIncome = $this->sumMenuValues($masterDataByMenu, $incomeMenus);
            $totalExpense = $this->sumMenuValues($masterDataByMenu, $expenseMenus);

            $totalProfit = $totalIncome - $totalExpense;
            $incomeMenus2 = ['आस्थापना खर्च', 'प्रशासकीय खर्च'];
            $client['व्यवस्थापन खर्च_sum_currentYear'] = $this->sumMenuValues($masterDataByMenu, $incomeMenus2);
            $client['गुंतवणूकशी प्रमाण'] = $client['गुंतवणूक_sum'] + $client['येणे कर्ज_sum'];
            $client['गतवर्षातील ठेवी'] = $client['ठेवी_sum'] - $client['ठेवी_sum_lastYear'];
            $client['कायम मालमत्ता_sum_currentYear'] = $masterDataByMenu->get('कायम मालमत्ता', collect())->sum('currentYear');
            $menus = ['बँक भाग हिस्से','दि को-ऑप बँक भाग हिस्से','पत संस्था भाग हिस्से','महा राज्य भाग हिस्से','शेअर्स'];
            $client['इतर भाग'] = $masterDataByMenu->get('गुंतवणूक', collect())->whereIn('entity', $menus)->sum('currentYear');
            $totalIncome4 = $masterDataByMenu->get('इतर सर्व निधी', collect())->where('entity', 'गुंतवणूक चढ उतार निधी')->sum('lastYear');
            $client['गुंतवणूक चढ उतार निधी_sum_lastYear'] = $totalIncome4;
            $totalExpense4 = $masterDataByMenu->get('इतर सर्व निधी', collect())->where('entity', 'गुंतवणूक चढ उतार निधी')->sum('currentYear');
            $client['गुंतवणूक चढ उतार निधी_sum_currentYear'] = $totalExpense4;

            $totalIncome5 = $masterDataByMenu->get('इतर सर्व निधी', collect())->where('entity', 'लाभांश समीकरण')->sum('lastYear');
            $client['लाभांश समीकरण_sum_lastYear'] = $totalIncome5;
            $totalExpense5 = $masterDataByMenu->get('इतर सर्व निधी', collect())->where('entity', 'लाभांश समीकरण')->sum('currentYear');
            $client['लाभांश समीकरण_sum_currentYear'] = $totalExpense5;
            $incomeMenus = ['इतर उत्त्पन्न', 'गुंतवणुकीवरील व्याज', 'कर्जावरील व्याज', 'किरकोळ उत्त्पन्न'];
            $expenseMenus = ['इतर खर्च', 'तरतूद खर्च', 'प्रशासकीय खर्च', 'आस्थापना खर्च', 'ठेवीवरील व्याज'];

            $totalIncome = $this->sumMenuValues($masterDataByMenu, $incomeMenus, 'lastYear');
            $totalExpense = $this->sumMenuValues($masterDataByMenu, $expenseMenus, 'lastYear');
            $totalIncome1 = $this->sumMenuValues($masterDataByMenu, $incomeMenus, 'currentYear');
            $totalExpense1 = $this->sumMenuValues($masterDataByMenu, $expenseMenus, 'currentYear');
            $client['नफा_तोटा_sum_lastYear'] = $totalIncome - $totalExpense;
            $client['नफा_तोटा_sum_currentYear'] = $totalIncome1 - $totalExpense1;
            $client['इमारत निधी_sum_currentYear'] = $masterDataByMenu->get('इतर सर्व निधी', collect())->where('entity', 'इमारत निधी')->sum('currentYear');
            $client['तरतूद खर्च_sum_currentYear'] = $masterDataByMenu->get('तरतूद खर्च', collect())->sum('currentYear');
            $client['तरतूद खर्च_sum_lastYear'] = $masterDataByMenu->get('तरतूद खर्च', collect())->sum('lastYear');
            $clientInputs = ClientInput::where('client_id', $client_id)
                ->pluck('value', 'key');
            return view('admin.clients.sheet6', compact('client','totalProfit','clientInputs'));
        } else if ($sheet_no == 7) {
            $client = Client::with('masterData')->find($client_id);
            $auditor = Audit::where('user_id', auth()->id())->first();

            return view('admin.clients.sheet7', compact('client', 'auditor'));
        } else if ($sheet_no == 8) {
            $client = Client::with('masterData', 'year')->find($client_id);
            $auditor = Audit::where('user_id', auth()->id())->first();
            $clientInputs = ClientInput::where('client_id', $client_id)
                ->pluck('value', 'key');
            return view('admin.clients.sheet8', compact('client', 'auditor', 'clientInputs'));
        } else if ($sheet_no == 9) {
            $client = Client::with('masterData', 'year')->find($client_id);
            $clientInputs = ClientInput::where('client_id', $client_id)->pluck('value', 'key');

            return view('admin.clients.sheet9', compact('client', 'clientInputs'));
        } else {
            return redirect()->back()->withErrors(['error' => 'Invalid sheet number']);
        }
    }

    /**
     * Calculate net profit/loss for given income and expense menus
     */
    private function calculateNetProfitLoss($masterDataByMenu, $incomeMenus, $expenseMenus, $year = 'currentYear')
    {
        $totalIncome = $this->sumMenuValues($masterDataByMenu, $incomeMenus, $year);
        $totalExpense = $this->sumMenuValues($masterDataByMenu, $expenseMenus, $year);
        return $totalIncome - $totalExpense;
    }

    /**
     * Sum values for given menus and year
     */
    private function sumMenuValues($masterDataByMenu, $menus, $year = 'currentYear')
    {
        return collect($menus)->sum(function($menu) use ($masterDataByMenu, $year) {
            return $masterDataByMenu->get($menu, collect())->sum($year);
        });
    }

    /**
     * Calculate CRAR (Capital to Risk-Weighted Assets Ratio)
     */
    private function calculateCRAR($client)
    {
        return ($client['बँक शिल्लक_sum_currentYear'] * 0.20) 
            + ($client['गुंतवणूक_sum_currentYear'] * 0.20) 
            + ($client['येणे कर्ज_sum'] * 1.25) 
            + ($client['कायम मालमत्ता_sum_currentYear'] * 1.00) 
            + ($client['इतर येणे_sum_currentYear'] * 1.00);
    }

    public function saveInputs(Request $request, $id)
    {
        try {
            $client = Client::find($id);
            if (!$client) {
                return redirect()->back()->withErrors(['error' => 'Client not found.']);
            }

            // If your HTML form has multiple fields with the same name attribute,
            // $request->except('_token') will contain those keys as arrays.
            // Laravel's updateOrCreate will only store the last value for each key,
            // but if you want to prevent duplicate keys, ensure all input names are unique.
            // If you expect multiple values for a key, handle them as arrays here.

            foreach ($request->except('_token') as $key => $value) {
                if (is_array($value)) {
                    // If multiple values for the same key, store only the last one
                    $value = end($value);
                }
                $data = ClientInput::updateOrCreate(
                    ['client_id' => $id, 'key' => $key],
                    ['value' => $value]
                );
            }

            return redirect()->back()->with('success', 'Inputs saved successfully!');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }
}
