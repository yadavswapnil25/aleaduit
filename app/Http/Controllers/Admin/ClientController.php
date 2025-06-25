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
            ['name' => 'तरतूद', 'route' => 'admin.client.master1'],
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

            // Define menus to sum
            $menusToSum = [
                'वसुल भाग भागभांडवल',
                'राखीव निधी',
                'ठेवी',
                'गुंतवणूक',
                'संचित नफा',
                'रोख शिल्लक',
                'बँक शिल्लक'
            ];
            foreach ($menusToSum as $menu) {
                $data = $client->masterData->where('menu', $menu);
                $client[$menu] = $data;
                $client[$menu . '_sum'] = $data ? $data->sum('currentYear') : 0;
            }

            // Income/Expense menus
            $incomeMenus = ['इतर उत्त्पन्न', 'गुंतवणुकीवरील व्याज', 'कर्जावरील व्याज', 'किरकोळ उत्त्पन्न'];
            $expenseMenus = ['इतर खर्च', 'तरतूद', 'प्रशासकीय खर्च', 'आस्थापना खर्च', 'ठेवीवरील व्याज'];
            $client['नफा_तोटा_sum'] = $client->masterData->whereIn('menu', $incomeMenus)->sum('currentYear')
                - $client->masterData->whereIn('menu', $expenseMenus)->sum('currentYear');

            $incomeTotalMenus = ['रोख शिल्लक', 'बँक शिल्लक', 'गुंतवणूक', 'कायम मालमत्ता', 'येणे कर्ज', 'इतर येणे', 'घेणे व्यज', 'संचित तोटा'];
            $client['खेळते भागभांडवल_sum'] = $client->masterData->whereIn('menu', $incomeTotalMenus)->sum('currentYear');
            $client['वसुल भाग भागभांडवल'] = $client->masterData->where('menu', 'वसूल भागभांडवल');
            $client['वसुल भाग भागभांडवल_sum_currentYear'] = $client['वसुल भाग भागभांडवल']->sum('currentYear');
            return view('admin.clients.sheet1', compact('client', 'clientInputs', 'auditor'));
        } else if ($sheet_no == 2) {
            $client = Client::with('masterData')->find($client_id);
            $auditor = Audit::where('user_id', auth()->id())->first();
            $clientInputs = ClientInput::where('client_id', $client_id)
                ->pluck('value', 'key');
            return view('admin.clients.sheet2', compact('client', 'auditor', 'clientInputs'));
        } else if ($sheet_no == 3) {
            $client = Client::with('masterData')->find($client_id);
            $auditor = Audit::where('user_id', auth()->id())->first();
            $clientInputs = ClientInput::where('client_id', $client_id)
                ->pluck('value', 'key');
            $client['रोख शिल्लक'] = $client->masterData->where('menu', 'रोख शिल्लक');
            $client['रोख शिल्लक_sum'] = $client['रोख शिल्लक']->sum('currentYear');
            $client['बँक शिल्लक'] = $client->masterData->where('menu', 'बँक शिल्लक');
            $client['बँक शिल्लक_sum'] = $client['बँक शिल्लक']->sum('currentYear');
            $client['गुंतवणूक'] = $client->masterData->where('menu', 'गुंतवणूक');
            $client['गुंतवणूक_sum'] = $client['गुंतवणूक']->sum('currentYear');
            $client['कायम मालमत्ता'] = $client->masterData->where('menu', 'कायम मालमत्ता');
            $client['कायम मालमत्ता_sum'] = $client['कायम मालमत्ता']->sum('currentYear');
            $client['येणे कर्ज'] = $client->masterData->where('menu', 'येणे कर्ज');
            $client['येणे कर्ज_sum'] = $client['येणे कर्ज']->sum('currentYear');
            $client['ठेवी'] = $client->masterData->where('menu', 'ठेवी');
            $client['ठेवी_sum'] = $client['ठेवी']->sum('currentYear');
            $client['इतर देणी'] = $client->masterData->where('menu', 'इतर देणी');
            $client['इतर देणी_sum'] = $client['इतर देणी']->sum('currentYear');
            return view('admin.clients.sheet3', compact('client', 'auditor', 'clientInputs'));
        } else if ($sheet_no == 4) {
            $client = Client::with('masterData')->find($client_id);
            $auditor = Audit::where('user_id', auth()->id())->first();
            $clientInputs = ClientInput::where('client_id', $client_id)
                ->pluck('value', 'key');
            $client['वसुल भाग भागभांडवल'] = $client->masterData->where('menu', 'वसूल भागभांडवल');
            $client['वसुल भाग भागभांडवल_sum_lastYear'] = $client['वसुल भाग भागभांडवल']->sum('lastYear');
            $client['वसुल भाग भागभांडवल'] = $client->masterData->where('menu', 'वसूल भागभांडवल');
            $client['वसुल भाग भागभांडवल_sum_currentYear'] = $client['वसुल भाग भागभांडवल']->sum('currentYear');
            $client['राखीव निधी'] = $client->masterData->where('menu', 'राखीव निधी');
            $client['राखीव निधी_sum_lastYear'] = $client['राखीव निधी']->sum('lastYear');
            $client['राखीव निधी'] = $client->masterData->where('menu', 'राखीव निधी');
            $client['राखीव निधी_sum_currentYear'] = $client['राखीव निधी']->sum('currentYear');
            $client['ठेवी'] = $client->masterData->where('menu', 'ठेवी');
            $client['ठेवी_sum_lastYear'] = $client['ठेवी']->sum('lastYear');
            $client['ठेवी'] = $client->masterData->where('menu', 'ठेवी');
            $client['ठेवी_sum_currentYear'] = $client['ठेवी']->sum('currentYear');
            $client['येणे कर्ज'] = $client->masterData->where('menu', 'येणे कर्ज');
            $client['येणे कर्ज_sum_lastYear'] = $client['येणे कर्ज']->sum('lastYear');
            $client['येणे कर्ज'] = $client->masterData->where('menu', 'येणे कर्ज');
            $client['येणे कर्ज_sum_currentYear'] = $client['येणे कर्ज']->sum('currentYear');
            $client['गुंतवणूक'] = $client->masterData->where('menu', 'गुंतवणूक');
            $client['गुंतवणूक_sum_lastYear'] = $client['गुंतवणूक']->sum('lastYear');
            $client['गुंतवणूक'] = $client->masterData->where('menu', 'गुंतवणूक');
            $client['गुंतवणूक_sum_currentYear'] = $client['गुंतवणूक']->sum('currentYear');
            $client['कायम मालमत्ता'] = $client->masterData->where('menu', 'कायम मालमत्ता');
            $client['कायम मालमत्ता_sum_lastYear'] = $client['कायम मालमत्ता']->sum('lastYear');
            $client['कायम मालमत्ता'] = $client->masterData->where('menu', 'कायम मालमत्ता');
            $client['कायम मालमत्ता_sum_currentYear'] = $client['कायम मालमत्ता']->sum('currentYear');
            $client['राखीव निधी'] = $client->masterData->where('menu', 'राखीव निधी');
            $client['राखीव निधी_sum_lastYear'] = $client['राखीव निधी']->sum('lastYear');
            $client['राखीव निधी'] = $client->masterData->where('menu', 'राखीव निधी');
            $client['राखीव निधी_sum_currentYear'] = $client['राखीव निधी']->sum('currentYear');
            $client['संचित तोटा'] = $client->masterData->where('menu', 'संचित तोटा');
            $client['संचित तोटा_sum_lastYear'] = $client['संचित तोटा']->sum('lastYear');
            $client['संचित तोटा'] = $client->masterData->where('menu', 'संचित तोटा');
            $client['संचित तोटा_sum_currentYear'] = $client['संचित तोटा']->sum('currentYear');
            $client['तरतूद'] = $client->masterData->where('menu', 'तरतूद');
            $client['तरतूद_sum_lastYear'] = $client['तरतूद']->sum('lastYear');
            $client['तरतूद'] = $client->masterData->where('menu', 'तरतूद');
            $client['तरतूद_sum_currentYear'] = $client['तरतूद']->sum('currentYear');
            $incomeMenus = ['इतर उत्त्पन्न', 'गुंतवणुकीवरील व्याज', 'कर्जावरील व्याज', 'किरकोळ उत्त्पन्न'];
            $expenseMenus = ['इतर खर्च', 'तरतूद', 'प्रशासकीय खर्च', 'आस्थापना खर्च', 'ठेवीवरील व्याज'];

            $totalIncome = $client->masterData->whereIn('menu', $incomeMenus)->sum('currentYear');
            $totalExpense = $client->masterData->whereIn('menu', $expenseMenus)->sum('currentYear');

            $client['नफा_तोटा_sum_currentYear'] = $totalIncome - $totalExpense;
            $incomeMenus = ['इतर उत्त्पन्न', 'गुंतवणुकीवरील व्याज', 'कर्जावरील व्याज', 'किरकोळ उत्त्पन्न'];
            $expenseMenus = ['इतर खर्च', 'तरतूद', 'प्रशासकीय खर्च', 'आस्थापना खर्च', 'ठेवीवरील व्याज'];

            $totalIncome = $client->masterData->whereIn('menu', $incomeMenus)->sum('lastYear');
            $totalExpense = $client->masterData->whereIn('menu', $expenseMenus)->sum('lastYear');
            $totalIncome1 = $client->masterData->whereIn('menu', $incomeMenus)->sum('currentYear');
            $totalExpense1 = $client->masterData->whereIn('menu', $expenseMenus)->sum('currentYear');
            $client['नफा_तोटा_sum_lastYear'] = $totalIncome - $totalExpense;
            $client['नफा_तोटा_sum_currentYear'] = $totalIncome1 - $totalExpense1;

            // व्यवस्थापन खर्च
            $incomeMenus2 = ['आस्थापना खर्च', 'प्रशासकीय खर्च', 'इतर खर्च'];
            $totalIncome2 = $client->masterData->whereIn('menu', $incomeMenus2)->sum('lastYear');
            $totalExpense2 = $client->masterData->whereIn('menu', $incomeMenus2)->sum('currentYear');
            $totalIncome3 = $client->masterData->whereIn('menu', 'इतर सर्व निधी')->where('entity', 'इमारत निधी')->sum('lastYear');
            $client['इमारत निधी_sum_lastYear'] = $totalIncome3;
            $totalExpense3 = $client->masterData->whereIn('menu', 'इतर सर्व निधी')->where('entity', 'इमारत निधी')->sum('currentYear');
            $client['इमारत निधी_sum_currentYear'] = $totalExpense3;
            $totalIncome4 = $client->masterData->whereIn('menu', 'इतर सर्व निधी')->where('entity', 'गुंतवणूक चढ उतार निधी')->sum('lastYear');
            $client['गुंतवणूक चढ उतार निधी_sum_lastYear'] = $totalIncome4;
            $totalExpense4 = $client->masterData->whereIn('menu', 'इतर सर्व निधी')->where('entity', 'गुंतवणूक चढ उतार निधी')->sum('currentYear');
            $client['गुंतवणूक चढ उतार निधी_sum_currentYear'] = $totalExpense4;

            $totalIncome5 = $client->masterData->whereIn('menu', 'इतर सर्व निधी')->where('entity', 'लाभांश समीकरण')->sum('lastYear');
            $client['लाभांश समीकरण_sum_lastYear'] = $totalIncome5;
            $totalExpense5 = $client->masterData->whereIn('menu', 'इतर सर्व निधी')->where('entity', 'लाभांश समीकरण')->sum('currentYear');
            $client['लाभांश समीकरण_sum_currentYear'] = $totalExpense5;

            $incomeMenu3 = ['वसूल भागभांडवल', 'राखीव निधी', 'इतर सर्व निधी', 'ठेवी', 'संचित नफा', 'तरतूद', 'देणे कर्ज', 'इतर देणी', 'शाखा ठेवी देणे'];
            $totalIncome6 = $client->masterData->whereIn('menu', $incomeMenu3)->sum('lastYear');
            $client['totalIncome6'] = $totalIncome6;

            return view('admin.clients.sheet4', compact('client', 'auditor', 'clientInputs', 'totalIncome2', 'totalExpense2'));
        } else if ($sheet_no == 5) {
            $client = Client::with('masterData', 'year')->find($client_id);
            // dd($client);
            $incomeMenu3 = ['वसूल भागभांडवल', 'राखीव निधी', 'इतर सर्व निधी', 'ठेवी', 'संचित नफा', 'तरतूद', 'देणे कर्ज', 'इतर देणी', 'शाखा ठेवी देणे'];
            $totalIncome6 = $client->masterData->whereIn('menu', $incomeMenu3)->sum('lastYear');
            $totalIncome7 = $client->masterData->whereIn('menu', $incomeMenu3)->sum('currentYear');
            $client['totalIncome6'] = $totalIncome6;
            $client['totalIncome7'] = $totalIncome7;
            $client['वसुल भाग भागभांडवल'] = $client->masterData->where('menu', 'वसूल भागभांडवल');
            $client['वसुल भाग भागभांडवल_sum_lastYear'] = $client['वसुल भाग भागभांडवल']->sum('lastYear');
            $client['वसुल भाग भागभांडवल'] = $client->masterData->where('menu', 'वसूल भागभांडवल');
            $client['वसुल भाग भागभांडवल_sum_currentYear'] = $client['वसुल भाग भागभांडवल']->sum('currentYear');
            $client['राखीव निधी'] = $client->masterData->where('menu', 'राखीव निधी');
            $client['राखीव निधी_sum_lastYear'] = $client['राखीव निधी']->sum('lastYear');
            $client['राखीव निधी'] = $client->masterData->where('menu', 'राखीव निधी');
            $client['राखीव निधी_sum_currentYear'] = $client['राखीव निधी']->sum('currentYear');
            $client['इतर सर्व निधी'] = $client->masterData->where('menu', 'इतर सर्व निधी');
            $client['इतर सर्व निधी_sum_currentYear'] = $client['इतर सर्व निधी']->sum('currentYear');
            $client['totalIncome8'] = $client['इतर सर्व निधी_sum_currentYear'] + $client['राखीव निधी_sum_currentYear'];
            $client['बुडीत कर्ज निधी'] = $client->masterData->where('menu', 'इतर सर्व निधी')->where('entity', 'बुडीत कर्ज निधी');
            $client['बुडीत कर्ज निधी_sum_currentYear'] = $client['बुडीत कर्ज निधी']->sum('currentYear');
            $client['बुडीत कर्ज निधी_sum_lastYear'] = $client['बुडीत कर्ज निधी']->sum('lastYear');
            $client['कर्मचारी भविष्य निर्वाह निधी'] = $client->masterData->where('menu', 'इतर सर्व निधी')->where('entity', 'कर्मचारी भविष्य निर्वाह निधी');
            $client['कर्मचारी भविष्य निर्वाह निधी_sum_currentYear'] = $client['कर्मचारी भविष्य निर्वाह निधी']->sum('currentYear');
            $client['कर्मचारी भविष्य निर्वाह निधी_sum_lastYear'] = $client['कर्मचारी भविष्य निर्वाह निधी']->sum('lastYear');
            $client['कल्याण निधी'] = $client->masterData->where('menu', 'इतर सर्व निधी')->where('entity', 'कल्याण निधी');
            $client['कल्याण निधी_sum_currentYear'] = $client['कल्याण निधी']->sum('currentYear');
            $client['कल्याण निधी_sum_lastYear'] = $client['कल्याण निधी']->sum('lastYear');
            $client['सुरक्षा ठेव निधी'] = $client->masterData->where('menu', 'इतर सर्व निधी')->where('entity', 'सुरक्षा ठेव निधी');
            $client['सुरक्षा ठेव निधी_sum_currentYear'] = $client['सुरक्षा ठेव निधी']->sum('currentYear');
            $client['सुरक्षा ठेव निधी_sum_lastYear'] = $client['सुरक्षा ठेव निधी']->sum('lastYear');
            $client['इमारत निधी'] = $client->masterData->where('menu', 'इतर सर्व निधी')->where('entity', 'इमारत निधी');
            $client['इमारत निधी_sum_currentYear'] = $client['इमारत निधी']->sum('currentYear');
            $client['इमारत निधी_sum_lastYear'] = $client['इमारत निधी']->sum('lastYear');
            $client['आकस्मिक फंड'] = $client->masterData->where('menu', 'इतर सर्व निधी')->where('entity', 'आकस्मिक फंड');
            $client['आकस्मिक फंड_sum_currentYear'] = $client['आकस्मिक फंड']->sum('currentYear');
            $client['आकस्मिक फंड_sum_lastYear'] = $client['आकस्मिक फंड']->sum('lastYear');
            $client['ठेवी'] = $client->masterData->where('menu', 'ठेवी');
            $client['ठेवी_sum_currentYear'] = $client['ठेवी']->sum('currentYear');
            $client['बचत ठेव'] = $client->masterData->where('menu', 'ठेवी')->where('entity', 'बचत ठेव');
            $client['बचत ठेव_sum_currentYear'] = $client['बचत ठेव']->sum('currentYear');
            $client['बचत ठेव_sum_lastYear'] = $client['बचत ठेव']->sum('lastYear');
            $client['कुटुंबनिर्वाह मासिक व्याज योजना'] = $client->masterData->where('menu', 'ठेवी')->where('entity', 'कुटुंबनिर्वाह मासिक व्याज योजना');
            $client['कुटुंबनिर्वाह मासिक व्याज योजना_sum_currentYear'] = $client['कुटुंबनिर्वाह मासिक व्याज योजना']->sum('currentYear');
            $client['कुटुंबनिर्वाह मासिक व्याज योजना_sum_lastYear'] = $client['कुटुंबनिर्वाह मासिक व्याज योजना']->sum('lastYear');
            $client['मुदत ठेव'] = $client->masterData->where('menu', 'ठेवी')->where('entity', 'मुदत ठेव');
            $client['मुदत ठेव_sum_currentYear'] = $client['मुदत ठेव']->sum('currentYear');
            $client['मुदत ठेव_sum_lastYear'] = $client['मुदत ठेव']->sum('lastYear');
            $client['दामदुप्पट ठेव'] = $client->masterData->where('menu', 'ठेवी')->where('entity', 'दामदुप्पट ठेव');
            $client['दामदुप्पट ठेव_sum_currentYear'] = $client['दामदुप्पट ठेव']->sum('currentYear');
            $client['दामदुप्पट ठेव_sum_lastYear'] = $client['दामदुप्पट ठेव']->sum('lastYear');
            $client['दामतिप्पट ठेव'] = $client->masterData->where('menu', 'ठेवी')->where('entity', 'दामतिप्पट ठेव');
            $client['दामतिप्पट ठेव_sum_currentYear'] = $client['दामतिप्पट ठेव']->sum('currentYear');
            $client['दामतिप्पट ठेव_sum_lastYear'] = $client['दामतिप्पट ठेव']->sum('lastYear');
            $client['दामचौपट ठेव'] = $client->masterData->where('menu', 'ठेवी')->where('entity', 'दामचौपट ठेव');
            $client['दामचौपट ठेव_sum_currentYear'] = $client['दामचौपट ठेव']->sum('currentYear');
            $client['दामचौपट ठेव_sum_lastYear'] = $client['दामचौपट ठेव']->sum('lastYear');
            $client['आवर्त ठेव'] = $client->masterData->where('menu', 'ठेवी')->where('entity', 'आवर्त ठेव');
            $client['आवर्त ठेव_sum_currentYear'] = $client['आवर्त ठेव']->sum('currentYear');
            $client['आवर्त ठेव_sum_lastYear'] = $client['आवर्त ठेव']->sum('lastYear');
            $client['तरतूद'] = $client->masterData->where('menu', 'तरतूद');
            $client['तरतूद_sum_currentYear'] = $client['तरतूद']->sum('currentYear');
      
            $client['एन पी ए तरतूद'] = $client->masterData->where('menu', 'तरतुद')->where('entity', 'एन पी ए तरतूद');
            $client['एन पी ए तरतूद_sum_currentYear'] = $client['एन पी ए तरतूद'] ? $client['एन पी ए तरतूद']->sum('currentYear') : 0;
            $client['कर्मचारी बोनस'] = $client->masterData->where('menu', 'तरतुद')->where('entity', 'कर्मचारी बोनस');
            $client['कर्मचारी बोनस_sum_currentYear'] = $client['कर्मचारी बोनस'] ? $client['कर्मचारी बोनस']->sum('currentYear') : 0;
            $client['शिक्षण निधी तरतूद'] = $client->masterData->where('menu', 'तरतूद')->where('entity', 'शिक्षण निधी तरतूद');
            $client['शिक्षण निधी तरतूद_sum_currentYear'] = $client['शिक्षण निधी तरतूद'] ? $client['शिक्षण निधी तरतूद']->sum('currentYear') : 0;
            $client['निवडणूक खर्च तरतूद'] = $client->masterData->where('menu', 'तरतूद')->where('entity', 'निवडणूक खर्च तरतूद');
            $client['निवडणूक खर्च तरतूद_sum_currentYear'] = $client['निवडणूक खर्च तरतूद'] ? $client['निवडणूक खर्च तरतूद']->sum('currentYear') : 0;
            $client['शिक्षण निधी तरतूद'] = $client->masterData->where('menu', 'तरतूद')->where('entity', 'शिक्षण निधी तरतूद');
            $client['शिक्षण निधी तरतूद_sum_lastYear'] = $client['शिक्षण निधी तरतूद'] ? $client['शिक्षण निधी तरतूद']->sum('lastYear') : 0;
            $client['ऑडिट फी तरतूद'] = $client->masterData->where('menu', 'तरतूद')->where('entity', 'ऑडिट फी तरतूद');
            $client['ऑडिट फी तरतूद_sum_currentYear'] = $client['ऑडिट फी तरतूद'] ? $client['ऑडिट फी तरतूद']->sum('currentYear') : 0;


            $clinet['कर्ज अनामत'] = $client->masterData->where('menu', 'इतर देणी')->where('entity', 'कर्ज अनामत');
            $client['कर्ज अनामत_sum_currentYear'] = $client['कर्ज अनामत'] ? $client['कर्ज अनामत']->sum('currentYear') : 0;
            $client['विशेष वसुली चार्ज'] = $client->masterData->where('menu', 'इतर देणी')->where('entity', 'विशेष वसुली चार्ज');
            $client['विशेष वसुली चार्ज_sum_currentYear'] = $client['विशेष वसुली चार्ज'] ? $client['विशेष वसुली चार्ज']->sum('currentYear') : 0;
            $client['जि एस टी'] = $client->masterData->where('menu', 'इतर देणी')->where('entity', 'जि एस टी');
            $client['जि एस टी_sum_currentYear'] = $client['जि एस टी'] ? $client['जि एस टी']->sum('currentYear') : 0;
            $client['निवडणूक खर्च'] = $client->masterData->where('menu', 'इतर देणी')->where('entity', 'निवडणूक खर्च');
            $client['निवडणूक खर्च_sum_currentYear'] = $client['निवडणूक खर्च'] ? $client['निवडणूक खर्च']->sum('currentYear') : 0;
            $client['टी डी एस'] = $client->masterData->where('menu', 'इतर देणी')->where('entity', 'टी डी एस');
            $client['टी डी एस_sum_currentYear'] = $client['टी डी एस'] ? $client['टी डी एस']->sum('currentYear') : 0;
            $client['पतसंस्था रिकव्हरी चार्ज'] = $client->masterData->where('menu', 'इतर देणी')->where('entity', 'पतसंस्था रिकव्हरी चार्ज');
            $client['पतसंस्था रिकव्हरी चार्ज_sum_currentYear'] = $client['पतसंस्था रिकव्हरी चार्ज'] ? $client['पतसंस्था रिकव्हरी चार्ज']->sum('currentYear') : 0;
            $client['पतसंस्था प्रोसेस चार्ज'] = $client->masterData->where('menu', 'इतर देणी')->where('entity', 'पतसंस्था प्रोसेस चार्ज');
            $client['पतसंस्था प्रोसेस चार्ज_sum_currentYear'] = $client['पतसंस्था प्रोसेस चार्ज'] ? $client['पतसंस्था प्रोसेस चार्ज']->sum('currentYear') : 0;
            $client['totalIncome9'] = $client['इतर देणी_sum_currentYear'] + $client['कर्ज अनामत_sum_currentYear'] + $client['विशेष वसुली चार्ज_sum_currentYear'] + $client['जि एस टी_sum_currentYear'] + $client['निवडणूक खर्च_sum_currentYear'] + $client['टी डी एस_sum_currentYear'] + $client['पतसंस्था रिकव्हरी चार्ज_sum_currentYear'] + $client['पतसंस्था प्रोसेस चार्ज_sum_currentYear'];

            $client['को.ऑप. बँक मुदत ठेव तारण कर्ज'] = $client->masterData->where('menu', 'को.ऑप. बँक मुदत ठेव तारण कर्ज');
            $client['को.ऑप. बँक मुदत ठेव तारण कर्ज_sum_currentYear'] = $client['को.ऑप. बँक मुदत ठेव तारण कर्ज'] ? $client['को.ऑप. बँक मुदत ठेव तारण कर्ज']->sum('currentYear') : 0;
            $client['को.ऑप. बँक मुदत ठेव तारण कर्ज_sum_lastYear'] = $client['को.ऑप. बँक मुदत ठेव तारण कर्ज'] ? $client['को.ऑप. बँक मुदत ठेव तारण कर्ज']->sum('lastYear') : 0;
            $client['संचित नफा'] = $client->masterData->where('menu', 'संचित नफा');
            $client['संचित नफा_sum_currentYear'] = $client['संचित नफा'] ? $client['संचित नफा']->sum('currentYear') : 0;
            $client['संचित नफा_sum_lastYear'] = $client['संचित नफा'] ? $client['संचित नफा']->sum('lastYear') : 0;
            $client['शाखा ठेवी देणे'] = $client->masterData->where('menu', 'शाखा ठेवी देणे');
            $client['शाखा ठेवी देणे_sum_currentYear'] = $client['शाखा ठेवी देणे'] ? $client['शाखा ठेवी देणे']->sum('currentYear') : 0;
            $client['देणे कर्ज'] = $client->masterData->where('menu', 'देणे कर्ज');
            $client['देणे कर्ज_sum_currentYear'] = $client['देणे कर्ज'] ? $client['देणे कर्ज']->sum('currentYear') : 0;
            $client['रोख शिल्लक'] = $client->masterData->where('menu', 'रोख शिल्लक');
            $client['रोख शिल्लक_sum_currentYear'] = $client['रोख शिल्लक'] ? $client['रोख शिल्लक']->sum('currentYear') : 0;
            $incomeMenu8 = ['रोख शिल्लक', 'बँक शिल्लक', 'गुंतवणूक', 'कायम मालमत्ता', 'येणे कर्ज', 'इतर येणे', 'घेणे व्यज', 'संचित तोटा'];
            $client['मालमत्ता व येणे बाजू'] = $client->masterData->whereIn('menu', $incomeMenu8)->sum('currentYear');
            // loop
            $client['बँक शिल्लक'] = $client->masterData->where('menu', 'बँक शिल्लक');
            $client['बँक शिल्लक_sum_currentYear'] = $client['बँक शिल्लक'] ? $client['बँक शिल्लक']->sum('currentYear') : 0;
            $client['गुंतवणूक'] = $client->masterData->where('menu', 'गुंतवणूक');
            $client['गुंतवणूक_sum'] = $client['गुंतवणूक']->sum('currentYear');
            $client['कायम मालमत्ता'] = $client->masterData->where('menu', 'कायम मालमत्ता');
            $client['कायम मालमत्ता_sum_currentYear'] = $client['कायम मालमत्ता']->sum('currentYear');
            $client['इतर देणी'] = $client->masterData->where('menu', 'इतर देणी');
            $client['इतर देणी_sum_currentYear'] = $client['इतर देणी']->sum('currentYear');
            $client['घेणे व्यज'] = $client->masterData->where('menu', 'घेणे व्यज');
            $client['घेणे व्यज_sum_currentYear'] = $client['घेणे व्यज']->sum('currentYear');
            $incomeMenus = ['इतर उत्त्पन्न', 'गुंतवणुकीवरील व्याज', 'कर्जावरील व्याज', 'किरकोळ उत्त्पन्न'];
            $expenseMenus = ['इतर खर्च', 'तरतूद', 'प्रशासकीय खर्च', 'आस्थापना खर्च', 'ठेवीवरील व्याज'];

            $totalIncome = $client->masterData->whereIn('menu', $incomeMenus)->sum('currentYear');
            $totalExpense = $client->masterData->whereIn('menu', $expenseMenus)->sum('currentYear');

            $client['नफा_तोटा_sum_currentYear'] = $totalIncome - $totalExpense;
            $totalIncome1 = $client->masterData->whereIn('menu', $incomeMenus)->sum('lastYear');
            $totalExpense1 = $client->masterData->whereIn('menu', $expenseMenus)->sum('lastYear');
            $client['नफा_तोटा_sum_lastYear'] = $totalIncome1 - $totalExpense1;
            $clientInputs = ClientInput::where('client_id', $client_id)->pluck('value', 'key');
            $client['इतर येणे'] = $client->masterData->where('menu', 'इतर येणे');
            $client['संचित तोटा'] = $client->masterData->where('menu', 'संचित तोटा');
            $client['संचित तोटा_sum_currentYear'] = $client['संचित तोटा']->sum('currentYear');
            $incomeMenus = ['इतर उत्त्पन्न', 'गुंतवणुकीवरील व्याज', 'कर्जावरील व्याज', 'किरकोळ उत्त्पन्न'];
            $expenseMenus = ['इतर खर्च', 'तरतूद खर्च', 'प्रशासकीय खर्च', 'आस्थापना खर्च', 'ठेवीवरील व्याज'];

            $totalIncome = $client->masterData->whereIn('menu', $incomeMenus)->sum('lastYear');
            $totalExpense = $client->masterData->whereIn('menu', $expenseMenus)->sum('lastYear');
            $totalIncome1 = $client->masterData->whereIn('menu', $incomeMenus)->sum('currentYear');
            $totalExpense1 = $client->masterData->whereIn('menu', $expenseMenus)->sum('currentYear');
            $client['नफा_तोटा_sum_lastYear'] = $totalIncome - $totalExpense;
            $client['नफा_तोटा_sum_currentYear'] = $totalIncome1 - $totalExpense1;
            $client['येणे कर्ज'] = $client->masterData->where('menu', 'येणे कर्ज');
            $client['येणे कर्ज_sum'] = $client['येणे कर्ज']->sum('currentYear');
            if($totalExpense > $totalIncome) {
                $client['नफा/तोटा_sum_currentYear'] = $totalIncome1 - $totalExpense1;
            } else {
                $client['नफा/तोटा_sum_currentYear'] = 0;
            }
            return view('admin.clients.sheet5', compact('client', 'clientInputs'));
        } else if ($sheet_no == 6) {
            $client = Client::with('masterData', 'year')->find($client_id);
            $client['कर्जावरील व्याज'] = $client->masterData->where('menu', 'कर्जावरील व्याज');
            $client['कर्जावरील व्याज_sum_currentYear'] = $client['कर्जावरील व्याज']->sum('currentYear');
            $client['कर्जावरील व्याज_sum_lastYear'] = $client['कर्जावरील व्याज']->sum('lastYear');
            $client['गुंतवणुकीवरील व्याज'] = $client->masterData->where('menu', 'गुंतवणुकीवरील व्याज');   
            $client['गुंतवणुकीवरील व्याज_sum_currentYear'] = $client['गुंतवणुकीवरील व्याज']->sum('currentYear');
            $client['गुंतवणुकीवरील व्याज_sum_lastYear'] = $client['गुंतवणुकीवरील व्याज']->sum('lastYear');    
            $client['इतर उत्त्पन्न'] = $client->masterData->where('menu', 'इतर उत्त्पन्न');
            $client['इतर उत्त्पन्न_sum_currentYear'] = $client['इतर उत्त्पन्न']->sum('currentYear');
            $client['इतर उत्त्पन्न_sum_lastYear'] = $client['इतर उत्त्पन्न']->sum('lastYear');
            $client['ठेवीवरील व्याज'] = $client->masterData->where('menu', 'ठेवीवरील व्याज');
            $client['ठेवीवरील व्याज_sum_currentYear'] = $client['ठेवीवरील व्याज']->sum('currentYear');
            $client['ठेवीवरील व्याज_sum_lastYear'] = $client['ठेवीवरील व्याज']->sum('lastYear');
            $client['आस्थापना खर्च'] = $client->masterData->where('menu', 'आस्थापना खर्च');
            $client['आस्थापना खर्च_sum_currentYear'] = $client['आस्थापना खर्च']->sum('currentYear');
            $client['आस्थापना खर्च_sum_lastYear'] = $client['आस्थापना खर्च']->sum('lastYear');
            $client['प्रशासकीय खर्च'] = $client->masterData->where('menu', 'प्रशासकीय खर्च');
            $client['प्रशासकीय खर्च_sum_currentYear'] = $client['प्रशासकीय खर्च']->sum('currentYear');
            $client['प्रशासकीय खर्च_sum_lastYear'] = $client['प्रशासकीय खर्च']->sum('lastYear');
            $client['तरतूद'] = $client->masterData->where('menu', 'तरतूद');
            $client['तरतूद_sum_currentYear'] = $client['तरतूद']->sum('currentYear');
            $client['तरतूद_sum_lastYear'] = $client['तरतूद']->sum('lastYear');
            $client['इतर खर्च'] = $client->masterData->where('menu', 'इतर खर्च');
            $client['इतर खर्च_sum_currentYear'] = $client['इतर खर्च']->sum('currentYear');
            $client['इतर खर्च_sum_lastYear'] = $client['इतर खर्च']->sum('lastYear');   
            $incomeMenu3 = ['वसूल भागभांडवल', 'राखीव निधी', 'इतर सर्व निधी', 'ठेवी', 'संचित नफा', 'तरतूद', 'देणे कर्ज', 'इतर देणी', 'शाखा ठेवी देणे'];
            $client['खेळते भांडवल'] = $client->masterData->whereIn('menu', $incomeMenu3)->sum('currentYear');
            $client['वसुल भाग भागभांडवल'] = $client->masterData->where('menu', 'वसूल भागभांडवल');
            $client['वसुल भाग भागभांडवल_sum_currentYear'] = $client['वसुल भाग भागभांडवल']->sum('currentYear');
            $client['निधी'] = $client->masterData->where('menu', 'राखीव निधी');
            $client['निधी_sum_currentYear'] = $client['निधी']->sum('currentYear');
            $client['ठेवी'] = $client->masterData->where('menu', 'ठेवी');
            $client['ठेवी_sum'] = $client['ठेवी']->sum('currentYear');
            $client['ठेवी_sum_lastYear'] = $client['ठेवी']->sum('lastYear');
            $client['रोख शिल्लक'] = $client->masterData->where('menu', 'रोख शिल्लक');
            $client['रोख शिल्लक_sum'] = $client['रोख शिल्लक']->sum('currentYear');
            $client['बँक शिल्लक'] = $client->masterData->where('menu', 'बँक शिल्लक');
            $client['बँक शिल्लक_sum'] = $client['बँक शिल्लक']->sum('currentYear');
             $client['गुंतवणूक'] = $client->masterData->where('menu', 'गुंतवणूक');
            $client['गुंतवणूक_sum'] = $client['गुंतवणूक']->sum('currentYear');
            $client['देणे कर्ज'] = $client->masterData->where('menu', 'देणे कर्ज');
            $client['देणे कर्ज_sum_currentYear'] = $client['देणे कर्ज'] ? $client['देणे कर्ज']->sum('currentYear') : 0;
            $client['इतर येणे'] = $client->masterData->where('menu', 'इतर येणे');
            $client['इतर येणे_sum_currentYear'] = $client['इतर येणे'] ? $client['इतर येणे']->sum('currentYear') : 0;
            $client['येणे कर्ज'] = $client->masterData->where('menu', 'येणे कर्ज');
            $client['येणे कर्ज_sum'] = $client['येणे कर्ज']->sum('currentYear');
             $client['घेणे व्यज'] = $client->masterData->where('menu', 'घेणे व्यज');
            $client['घेणे व्यज_sum_currentYear'] = $client['घेणे व्यज']->sum('currentYear');
            $client['शाखा ठेवी देणे'] = $client->masterData->where('menu', 'शाखा ठेवी देणे');

            return view('admin.clients.sheet6', compact('client'));
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


    public function saveInputs(Request $request, $id)
    {
        try {
            $client = Client::find($id);
            if (!$client) {
                return redirect()->back()->withErrors(['error' => 'Client not found.']);
            }

            // Loop through the request data and save each key-value pair
            foreach ($request->except('_token') as $key => $value) {
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
