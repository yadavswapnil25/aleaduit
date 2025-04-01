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
        $years = Year::get();
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
    public function master1($id)
    {
        $year = Year::find($id);

        if (!$year) {
            return redirect()->back()->withErrors(['error' => 'Year not found.']);
        }

     
        // Get the current menu's dropdown options

        return view('admin.clients.master1', compact('year'));
    }

    public function saveMasterData(Request $request)
    {
        $yearId = $request->input('year_id');
        $data = $request->input('data');

        // Save the data to the database (example logic)
        foreach ($data as $row) {
            MasterData::create([
                'year_id' => $yearId,
                'entity' => $row['entity'],
                'last_year' => $row['last_year'],
                'current_year' => $row['current_year'],
                'difference' => $row['difference'],
                'result' => $row['result'],
            ]);
        }

        return response()->json(['success' => true]);
    }
}
