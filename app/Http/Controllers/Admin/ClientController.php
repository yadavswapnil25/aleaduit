<?php

namespace App\Http\Controllers\Admin;

use Exception;
use DataTables;
use Carbon\Carbon;
use App\Models\Year;
use App\Models\Audit;
use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreYearRequest;
use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
use Illuminate\Support\Facades\File;

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
            $client = Client::find($request->client_id);

            if (!$client) {
                return redirect()->back()->withErrors(['error' => 'Client not found.']);
            }

            // Handle file upload
            $fileName = null;
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $file->storeAs('public/uploads', $fileName);
            } else {
                // Copy master.docs file from public folder to storage folder with the name of the client
                $masterFilePath = public_path('master.doc');
                $fileName = $client->name_of_society . '.doc';
                $storageFilePath = storage_path('app/public/uploads/' . $fileName);
                if (file_exists($masterFilePath)) {
                    if (!file_exists(dirname($storageFilePath))) {
                        mkdir(dirname($storageFilePath), 0777, true);
                    }
                    if (!copy($masterFilePath, $storageFilePath)) {
                        return redirect()->back()->withErrors(['error' => 'Failed to copy master file.']);
                    }
                } else {
                    return redirect()->back()->withErrors(['error' => 'Master file not found.']);
                }
            }

            $year = new Year();
            $year->audit_year = $request->audit_year;
            $year->auditor_id = $request->auditor_id;
            $year->client_id = $request->client_id;
            $year->file = $fileName;
            $year->save();

            return redirect()->route('admin.clients.show', $year->client_id)->with('success', 'Year added successfully');
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
}
