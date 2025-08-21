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
        $client = Client::with('audit', 'masterData')->find($request->client_id);
        $clientInputs = ClientInput::where('client_id', $request->client_id)->pluck('value', 'key');
        $auditor = Audit::where('user_id', auth()->id())->first();

        if (!$client) {
            return redirect()->back()->withErrors(['error' => 'Client not found.']);
        }

        // File paths
        $masterFilePath = public_path('master.docx');
        $fileName = $client->name_of_society . '.docx';
        $storageFilePath = storage_path('app/public/uploads/' . $fileName);
        
        // Initialize TemplateProcessor
        $templateProcessor = new TemplateProcessor($masterFilePath);
        
        // 1. Basic Client Information
        $basicInfo = [
            'name_of_society' => $client->name_of_society ?? '',
            'chairman' => $client->chairman ?? '',
            'vice_chairman' => $client->vice_chairman ?? '',
            'manager' => $client->manager ?? '',
            'registration_no' => $client->registration_no ?? '',
            'registration_date' => $client->registration_date ? \Carbon\Carbon::parse($client->registration_date)->format('d/m/Y') : '',
            'karyashetra' => $client->karyashetra ?? '',
            'society_address' => $client->society_address ?? '',
            'taluka' => $client->taluka ?? '',
            'district' => $client->district ?? '',
            'audit_year' => $request->audit_year ?? '',
            'lekha_parikshan_vargwari' => $client->lekha_parikshan_vargwari ?? '',
        ];

        // 2. Auditor Information
        $auditorInfo = [
            'auditor_name' => $auditor->name ?? '',
            'auditor_type' => $auditor->type->value ?? '',
            'auditor_address' => $auditor->address ?? '',
        ];

        // 3. Financial Calculations
        // Profit/Loss Calculation
        $incomeMenus = ['इतर उत्त्पन्न', 'गुंतवणुकीवरील व्याज', 'कर्जावरील व्याज', 'किरकोळ उत्त्पन्न'];
        $expenseMenus = ['इतर खर्च', 'तरतूद खर्च', 'प्रशासकीय खर्च', 'आस्थापना खर्च', 'ठेवीवरील व्याज'];
        $profitLoss = $client->masterData->whereIn('menu', $incomeMenus)->sum('currentYear') 
                   - $client->masterData->whereIn('menu', $expenseMenus)->sum('currentYear');
        
        // Working Capital Calculation
        $incomeTotalMenus = ['रोख शिल्लक', 'बँक शिल्लक', 'गुंतवणूक', 'कायम मालमत्ता', 
                            'येणे कर्ज', 'इतर येणे', 'घेणे व्यज', 'संचित तोटा'];
        $workingCapital = $client->masterData->whereIn('menu', $incomeTotalMenus)->sum('currentYear');
        
        // Accumulated Profit/Loss
        $accumulatedProfit = $client->masterData->where('menu', 'संचित नफा')->first();
        $currentYearSum = $accumulatedProfit ? $accumulatedProfit->currentYear : 0;
        $lastYearSum = $accumulatedProfit ? $accumulatedProfit->lastYear : 0;
        
        // Other Financial Data
        $reserveFund = $client->masterData->where('menu', 'राखीव निधी')->first();
        $deposits = $client->masterData->where('menu', 'ठेवी')->first();
        $vasulBhagBhandval = $client->masterData->where('menu', 'वसूल भागभांडवल')->first();
        $investmentSum = $client->masterData->where('menu', 'गुंतवणूक')->sum('currentYear') ?? '';
        $cashBalance = $client->masterData->where('menu', 'रोख शिल्लक')->first();
        $bankBalance = $client->masterData->where('menu', 'बँक शिल्लक')->first();
        $deyneKarj = $client->masterData->where('menu', 'देणे कर्ज')->first();
        $yeneKarj = $client->masterData->where('menu', 'येणे कर्ज')->first();
        
        // Format all financial values
        $financialData = [
            'नफा_तोटा_sum' => $this->formatFinancialValue($profitLoss),
            'खेळते_भागभांडवल_sum' => $this->formatFinancialValue($workingCapital),
            'संचित_नफा_sum_currentYear' => $this->formatFinancialValue($currentYearSum),
            'संचित_नफा_sum_lastYear' => $this->formatFinancialValue($lastYearSum),
            'संचित_नफा_sum' => $this->formatFinancialValue($currentYearSum),
            'राखीव_निधी_sum' => $this->formatFinancialValue($reserveFund ? $reserveFund->currentYear : 0),
            'राखीव_निधी_sum_lastYear' => $this->formatFinancialValue($reserveFund ? $reserveFund->lastYear : 0),
            'राखीव_निधी_sum_currentYear' => $this->formatFinancialValue($reserveFund ? $reserveFund->currentYear : 0),
            'वसूल_भागभांडवल_sum_currentYear' => $this->formatFinancialValue($vasulBhagBhandval ? $vasulBhagBhandval->currentYear : 0),
            'वसूल_भागभांडवल_sum_lastYear' => $this->formatFinancialValue($vasulBhagBhandval ? $vasulBhagBhandval->lastYear : 0),
            'ठेवी_sum_lastYear' => $this->formatFinancialValue($deposits ? $deposits->lastYear : 0),
            'ठेवी_sum_currentYear' => $this->formatFinancialValue($deposits ? $deposits->currentYear : 0),
            'ठेवी_sum' => $this->formatFinancialValue($deposits ? $deposits->currentYear : 0),
            'गुंतवणूक_sum' => $this->formatFinancialValue($investmentSum),
            'देणे_कर्ज_sum_currentYear' => $this->formatFinancialValue($deyneKarj ? $deyneKarj->currentYear : 0),
            'येणे_कर्ज_sum_currentYear' => $this->formatFinancialValue($yeneKarj ? $yeneKarj->currentYear : 0),
            
            // Cash and Bank balances
            'रोख_शिल्लक_sum_currentYear' => $this->formatFinancialValue($cashBalance ? $cashBalance->currentYear : 0),
            'रोख_शिल्लक_sum_lastYear' => $this->formatFinancialValue($cashBalance ? $cashBalance->lastYear : 0),
            'रोख_शिल्लक_sum' => $this->formatFinancialValue($cashBalance ? $cashBalance->currentYear : 0),
            'बँक_शिल्लक_sum_currentYear' => $this->formatFinancialValue($bankBalance ? $bankBalance->currentYear : 0),
            'बँक_शिल्लक_sum_lastYear' => $this->formatFinancialValue($bankBalance ? $bankBalance->lastYear : 0),
            'बँक_शिल्लक_sum' => $this->formatFinancialValue($bankBalance ? $bankBalance->currentYear : 0),
        ];
        
        // 4. Client Inputs from form
        $clientInputValues = [
            'deposits_deductions_b' => $clientInputs['deposits_deductions_b'] ?? '',
            'transformation_regular' => $clientInputs['transformation_regular'] ?? '',
            'separate_rules_deposits' => $clientInputs['separate_rules_deposits'] ?? '',
            'compliance_properly' => $clientInputs['compliance_properly'] ?? '',
            'deposits_from_non_members' => $clientInputs['deposits_from_non_members'] ?? '',
            'personal_account_match_2' => $clientInputs['personal_account_match_2'] ?? '',
            'personal_account_match' => $clientInputs['personal_account_match'] ?? '',
            'timely_repayment_deposits' => $clientInputs['timely_repayment_deposits'] ?? '',
            'timely_repayment_deposits_2' => $clientInputs['timely_repayment_deposits_2'] ?? '',
            'loan_disbursement_compliance_2' => $clientInputs['loan_disbursement_compliance_2'] ?? '',
            'loan_disbursement_compliance' => $clientInputs['loan_disbursement_compliance'] ?? '',
            'interest_calculation' => $clientInputs['interest_calculation'] ?? '',
            'current_assets_1_2' => $clientInputs['current_assets_1_2'] ?? '',
            'current_assets_1' => $clientInputs['current_assets_1'] ?? '',
            'current_assets_2_2' => $clientInputs['current_assets_2_2'] ?? '',
            'current_assets_2' => $clientInputs['current_assets_2'] ?? '',
            'financial_info_timely' => $clientInputs['financial_info_timely'] ?? '',
            'capital_shortfall' => $clientInputs['capital_shortfall'] ?? '',
            'over_trading' => $clientInputs['over_trading'] ?? '',
            'over_trading_limit' => $clientInputs['over_trading_limit'] ?? '',
            'external_loan_1_2' => $clientInputs['external_loan_1_2'] ?? '',
            'external_loan_1' => $clientInputs['external_loan_1'] ?? '',
            'annex11_row1_col1' => $clientInputs['annex11_row1_col1'] ?? '',
            'external_loan_2_2' => $clientInputs['external_loan_2_2'] ?? '',
            'external_loan_2' => $clientInputs['external_loan_2'] ?? '',
            'repayment_timeliness' => $clientInputs['repayment_timeliness'] ?? '',
            'loan_terms_read' => $clientInputs['loan_terms_read'] ?? '',
            'management_bonus' => $clientInputs['management_bonus'] ?? '',
            'internal_audit_2_2' => $clientInputs['internal_audit_2_2'] ?? '',
            'internal_audit_1_2' => $clientInputs['internal_audit_1_2'] ?? '',
            'internal_audit_1' => $clientInputs['internal_audit_1'] ?? '',
            // Basic info from form
            'branches' => $clientInputs['branches'] ?? '',
            'board_duration_start' => $clientInputs['board_duration_start'] ?? '',
            'board_duration_end' => $clientInputs['board_duration_end'] ?? '',
            'election_date' => $clientInputs['election_date'] ?? '',
            'member_count' => $clientInputs['member_count'] ?? '',
            'member_count_2' => $clientInputs['member_count_2'] ?? '',
            'audit_classification' => $clientInputs['audit_classification'] ?? '',
            'recovery_cases' => $clientInputs['recovery_cases'] ?? '',
            'own_building' => $clientInputs['own_building'] ?? '',
            'vehicles' => $clientInputs['vehicles'] ?? '',
            'total_employees' => $clientInputs['total_employees'] ?? '',
            
            // Audit dates
            'audit_period_start' => $clientInputs['audit_period_start'] ?? '',
            'audit_period_end' => $clientInputs['audit_period_end'] ?? '',
            'audit_start_date' => $clientInputs['audit_start_date'] ?? '',
            'audit_end_date' => $clientInputs['audit_end_date'] ?? '',
            'audit_submission_date' => $clientInputs['audit_submission_date'] ?? '',
            
            // Members info
            'total_members' => $clientInputs['total_members'] ?? '',
            'individual_members' => $clientInputs['individual_members'] ?? '',
            'regular_members' => $clientInputs['regular_members'] ?? '',
            'nominal_members' => $clientInputs['nominal_members'] ?? '',
            'minority_members' => $clientInputs['minority_members'] ?? '',
            'institution_members' => $clientInputs['institution_members'] ?? '',
            'other_members' => $clientInputs['other_members'] ?? '',
            'total_members_sum' => $clientInputs['total_members_sum'] ?? '',
            'new_members_fee_paid' => $clientInputs['new_members_fee_paid'] ?? '',
            'written_applications_received' => $clientInputs['written_applications_received'] ?? '',
            'member_register_maintained' => $clientInputs['member_register_maintained'] ?? '',
            'member_register_maintained_rule_33' => $clientInputs['member_register_maintained_rule_33'] ?? '',
            'resignations_properly_accepted' => $clientInputs['resignations_properly_accepted'] ?? '',
            'nominee_appointed' => $clientInputs['nominee_appointed'] ?? '',
            'nominee_name' => $clientInputs['nominee_name'] ?? '',
            
            // Shares info
            'share_applications_correct' => $clientInputs['share_applications_correct'] ?? '',
            'share_register_updated' => $clientInputs['share_register_updated'] ?? '',
            'share_register_entries_match' => $clientInputs['share_register_entries_match'] ?? '',
            'share_register_entries_match_details' => $clientInputs['share_register_entries_match_details'] ?? '',
            'share_ledger_updated' => $clientInputs['share_ledger_updated'] ?? '',
            'share_ledger_balance_matches' => $clientInputs['share_ledger_balance_matches'] ?? '',
            'share_certificates_issued' => $clientInputs['share_certificates_issued'] ?? '',
            'share_certificates_issued_details' => $clientInputs['share_certificates_issued_details'] ?? '',
            'share_transfers_legal' => $clientInputs['share_transfers_legal'] ?? '',
            'share_transfers_legal_details' => $clientInputs['share_transfers_legal_details'] ?? '',
            
            // Loans info
            'loan_limit_followed' => $clientInputs['loan_limit_followed'] ?? '',
            'loan_limit_followed_opt1' => $clientInputs['loan_limit_followed_opt1'] ?? '',
            'loan_limit_exceeded' => $clientInputs['loan_limit_exceeded'] ?? '',
            'loan_limit_exceeded_permission' => $clientInputs['loan_limit_exceeded_permission'] ?? '',
            'loan_limit_exceeded_permission_opt1' => $clientInputs['loan_limit_exceeded_permission_opt1'] ?? '',
            
            // Meetings info
            'meeting_date' => $clientInputs['meeting_date'] ?? '',
            'annual_general_meeting' => $clientInputs['annual_general_meeting'] ?? '',
            'special_general_meeting' => $clientInputs['special_general_meeting'] ?? '',
            'board_meetings_count' => $clientInputs['board_meetings_count'] ?? '',
            'executive_meetings_count' => $clientInputs['executive_meetings_count'] ?? '',
            'executive_meetings_held' => $clientInputs['executive_meetings_held'] ?? '',
            'other_meetings_count' => $clientInputs['other_meetings_count'] ?? '',
            'other_meetings_held' => $clientInputs['other_meetings_held'] ?? '',
            
            // Audit reports
            'previous_audit_correction_report_date' => $clientInputs['previous_audit_correction_report_date'] ?? '',
            'previous_audit_correction_report' => $clientInputs['previous_audit_correction_report'] ?? '',
            'previous_audit_issues_ignored' => $clientInputs['previous_audit_issues_ignored'] ?? '',
            'previous_audit_issues_ignored_1' => $clientInputs['previous_audit_issues_ignored_1'] ?? '',
            
            // Audit fees
            'last_audit_fee_date' => $clientInputs['last_audit_fee_date'] ?? '',
            'last_audit_fee_paid' => $clientInputs['last_audit_fee_paid'] ?? '',
            'last_audit_fee_paid_details' => $clientInputs['last_audit_fee_paid_details'] ?? '',
            'audit_fee_not_paid' => $clientInputs['audit_fee_not_paid'] ?? '',
            'audit_fee_not_paid_1' => $clientInputs['audit_fee_not_paid_1'] ?? '',
            
            // Internal audit
            'internal_audit_date' => $clientInputs['internal_audit_date'] ?? '',
            'internal_audit_report' => $clientInputs['internal_audit_report'] ?? '',
            'statutory_internal_audit' => $clientInputs['statutory_internal_audit'] ?? '',
            
            // Manager info
            'monthly_honorarium' => $clientInputs['monthly_honorarium'] ?? '',
            'other_allowances' => $clientInputs['other_allowances'] ?? '',
            'other_allowances_1' => $clientInputs['other_allowances_1'] ?? '',
            'member_status' => $clientInputs['member_status'] ?? '',
            'loans_taken_by_manager' => $clientInputs['loans_taken_by_manager'] ?? '',
            'other_amounts_due_from_manager' => $clientInputs['other_amounts_due_from_manager'] ?? '',
            'other_amounts_due_from_manager_opt1' => $clientInputs['other_amounts_due_from_manager_opt1'] ?? '',
            'employee_details' => $clientInputs['employee_details'] ?? '',
            'employee_details_opt1' => $clientInputs['employee_details_opt1'] ?? '',
            
            // Violations
            'bylaws_copy_available' => $clientInputs['bylaws_copy_available'] ?? '',
            'violations_record' => $clientInputs['violations_record'] ?? '',
            'total_violations_record' => $clientInputs['total_violations_record'] ?? '',
            'total_bylaws_record' => $clientInputs['total_bylaws_record'] ?? '',
            'total_bylaws_record_2' => $clientInputs['total_bylaws_record_2'] ?? '',
            'rules_prepared_as_per_bylaws' => $clientInputs['rules_prepared_as_per_bylaws'] ?? '',
            'bylaws_copy_available_opt1' => $clientInputs['bylaws_copy_available_opt1'] ?? '',
            
            // Profit and loss
            'profit_loss_last_year' => $clientInputs['profit_loss_last_year'] ?? '',
            'profit_distribution' => $clientInputs['profit_distribution'] ?? '',
            'profit_distribution_opt1' => $clientInputs['profit_distribution_opt1'] ?? '',
            
            // Cash and bank
            'cash_balance_date' => $clientInputs['cash_balance_date'] ?? '',
            'cash_balance_date_opt1' => $clientInputs['cash_balance_date_opt1'] ?? '',
            'cash_counted_by' => $clientInputs['cash_counted_by'] ?? '',
            'cash_balance_correct' => $clientInputs['cash_balance_correct'] ?? '',
            'cash_security_arrangements' => $clientInputs['cash_security_arrangements'] ?? '',
            'bank_balance_correct' => $clientInputs['bank_balance_correct'] ?? '',
            'bank_balance_correct_option' => $clientInputs['bank_balance_correct_option'] ?? '',
            
            // Investments
            'investments_in_name_of_society' => $clientInputs['investments_in_name_of_society'] ?? '',
            'dividends_interest_collected' => $clientInputs['dividends_interest_collected'] ?? '',
            'investment_certificates_obtained' => $clientInputs['investment_certificates_obtained'] ?? '',
            'investment_certificates_obtained_opt1' => $clientInputs['investment_certificates_obtained_opt1'] ?? '',
            'investment_register_updated' => $clientInputs['investment_register_updated'] ?? '',
            
            // Property
            'property_register_updated' => $clientInputs['property_register_updated'] ?? '',
            'property_list_matches_balance_sheet' => $clientInputs['property_list_matches_balance_sheet'] ?? '',
            'property_deeds_in_name_of_society' => $clientInputs['property_deeds_in_name_of_society'] ?? '',
            'property_deeds_in_name_of_society_details' => $clientInputs['property_deeds_in_name_of_society_details'] ?? '',
            'property_insured' => $clientInputs['property_insured'] ?? '',
            'property_insured_details' => $clientInputs['property_insured_details'] ?? '',
            
            // Depreciation
            'depreciation_charged' => $clientInputs['depreciation_charged'] ?? '',
            'depreciation_rates' => $clientInputs['depreciation_rates'] ?? '',
            'depreciation_rates_opt2' => $clientInputs['depreciation_rates_opt2'] ?? '',
            
            // Discussion with board
            'depreciation_rates_opt1' => $clientInputs['depreciation_rates_opt1'] ?? '',
            'branch_count' => $clientInputs['branch_count'] ?? '',
        ];

        // Combine all values and set them in the template
        $allValues = array_merge($basicInfo, $financialData, $auditorInfo, $clientInputValues);
        
        foreach ($allValues as $key => $value) {
            $templateProcessor->setValue($key, $value);
        }
        
        // Save the processed template
        $templateProcessor->saveAs($storageFilePath);
        
        // Save year record
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

private function formatFinancialValue($value)
{
    if ($value < 0) {
        return '(-) ' . number_format(abs($value), 2);
    }
    return number_format($value, 2);
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
            $expenseMenus = ['इतर खर्च', 'तरतूद खर्च', 'प्रशासकीय खर्च', 'आस्थापना खर्च', 'ठेवीवरील व्याज'];
            $client['नफा_तोटा_sum'] = $client->masterData->whereIn('menu', $incomeMenus)->sum('currentYear')
                - $client->masterData->whereIn('menu', $expenseMenus)->sum('currentYear');

            $incomeTotalMenus = ['रोख शिल्लक', 'बँक शिल्लक', 'गुंतवणूक', 'कायम मालमत्ता', 'येणे कर्ज', 'इतर येणे', 'घेणे व्यज', 'संचित तोटा'];
            $client['खेळते भागभांडवल_sum'] = $client->masterData->whereIn('menu', $incomeTotalMenus)->sum('currentYear');

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
            $client['तरतुदी'] = $client->masterData->where('menu', 'तरतुदी');
            $client['तरतुदी_sum_lastYear'] = $client['तरतुदी']->sum('lastYear');
            $client['तरतुदी'] = $client->masterData->where('menu', 'तरतुदी');
            $client['तरतुदी_sum_currentYear'] = $client['तरतुदी']->sum('currentYear');
            $incomeMenus = ['इतर उत्त्पन्न', 'गुंतवणुकीवरील व्याज', 'कर्जावरील व्याज', 'किरकोळ उत्त्पन्न'];
            $expenseMenus = ['इतर खर्च', 'तरतूद खर्च', 'प्रशासकीय खर्च', 'आस्थापना खर्च', 'ठेवीवरील व्याज'];

            $totalIncome = $client->masterData->whereIn('menu', $incomeMenus)->sum('lastYear');
            $totalExpense = $client->masterData->whereIn('menu', $expenseMenus)->sum('lastYear');
            $totalIncome1 = $client->masterData->whereIn('menu', $incomeMenus)->sum('currentYear');
            $totalExpense1 = $client->masterData->whereIn('menu', $expenseMenus)->sum('currentYear');
            $client['नफा_तोटा_sum_lastYear'] = $totalIncome - $totalExpense;
            $client['नफा_तोटा_sum_currentYear'] = $totalIncome1 - $totalExpense1;

            // व्यवस्थापन खर्च
            $incomeMenus2 = ['आस्थापना खर्च', 'प्रशासकीय खर्च'];
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

            $incomeMenu3 = ['वसूल भागभांडवल', 'राखीव निधी', 'इतर सर्व निधी', 'ठेवी', 'संचित नफा', 'तरतुदी', 'देणे कर्ज', 'इतर देणी', 'शाखा ठेवी देणे'];
            $totalIncome6 = $client->masterData->whereIn('menu', $incomeMenu3)->sum('lastYear');
            $client['totalIncome6'] = $totalIncome6;

            return view('admin.clients.sheet4', compact('client', 'auditor', 'clientInputs', 'totalIncome2', 'totalExpense2'));
        } else if ($sheet_no == 5) {
            $client = Client::with('masterData', 'year')->find($client_id);
            $incomeMenu3 = ['वसूल भागभांडवल', 'राखीव निधी', 'इतर सर्व निधी', 'ठेवी', 'संचित नफा', 'तरतुदी', 'देणे कर्ज', 'इतर देणी', 'शाखा ठेवी देणे'];
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
            $client['तरतुदी'] = $client->masterData->where('menu', 'तरतुदी');
            $client['तरतुद_sum_currentYear'] = $client['तरतुद'] ? $client['तरतुद']->sum('currentYear') : 0;
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
            $expenseMenus = ['इतर खर्च', 'तरतूद खर्च', 'प्रशासकीय खर्च', 'आस्थापना खर्च', 'ठेवीवरील व्याज'];

            $totalIncome = $client->masterData->whereIn('menu', $incomeMenus)->sum('currentYear');
            $totalExpense = $client->masterData->whereIn('menu', $expenseMenus)->sum('currentYear');

            $client['नफा_तोटा_sum_currentYear'] = $totalIncome - $totalExpense;
            $totalIncome1 = $client->masterData->whereIn('menu', $incomeMenus)->sum('lastYear');
            $totalExpense1 = $client->masterData->whereIn('menu', $expenseMenus)->sum('lastYear');
            $client['नफा_तोटा_sum_lastYear'] = $totalIncome1 - $totalExpense1;
            $clientInputs = ClientInput::where('client_id', $client_id)->pluck('value', 'key');
            $client['इतर येणे'] = $client->masterData->where('menu', 'इतर येणे');
            $client['इतर येणे_sum_currentYear'] = $client['इतर येणे']->sum('currentYear');
            $client['संचित तोटा'] = $client->masterData->where('menu', 'संचित तोटा');
            $client['संचित तोटा_sum_currentYear'] = $client['संचित तोटा']->sum('currentYear');
            $client['येणे कर्ज'] = $client->masterData->where('menu', 'येणे कर्ज');

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
            $client['तरतुदी'] = $client->masterData->where('menu', 'तरतुदी');
            $client['तरतुदी_sum_currentYear'] = $client['तरतुदी']->sum('currentYear');
            $client['तरतुदी_sum_lastYear'] = $client['तरतुदी']->sum('lastYear');
            $client['इतर खर्च'] = $client->masterData->where('menu', 'इतर खर्च');
            $client['इतर खर्च_sum_currentYear'] = $client['इतर खर्च']->sum('currentYear');
            $client['इतर खर्च_sum_lastYear'] = $client['इतर खर्च']->sum('lastYear');   
            $incomeMenu3 = ['वसूल भागभांडवल', 'राखीव निधी', 'इतर सर्व निधी', 'ठेवी', 'संचित नफा', 'तरतुदी', 'देणे कर्ज', 'इतर देणी', 'शाखा ठेवी देणे'];
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
            $client['वसुल भाग भागभांडवल'] = $client->masterData->where('menu', 'वसूल भागभांडवल');
            $client['वसुल भाग भागभांडवल_sum_lastYear'] = $client['वसुल भाग भागभांडवल']->sum('lastYear');
            $client['वसुल भाग भागभांडवल'] = $client->masterData->where('menu', 'वसूल भागभांडवल');
            $client['वसुल भाग भागभांडवल_sum_currentYear'] = $client['वसुल भाग भागभांडवल']->sum('currentYear');

            $incomeTotalMenus = ['रोख शिल्लक', 'बँक शिल्लक', 'गुंतवणूक', 'कायम मालमत्ता', 'येणे कर्ज', 'इतर येणे', 'घेणे व्यज', 'संचित तोटा'];
            $client['खेळते भागभांडवल_sum'] = $client->masterData->whereIn('menu', $incomeTotalMenus)->sum('currentYear');
            $client['इतर देणी'] = $client->masterData->where('menu', 'इतर देणी');
            $client['इतर देणी_sum_currentYear'] = $client['इतर देणी']->sum('currentYear');
               $client['राखीव निधी'] = $client->masterData->where('menu', 'राखीव निधी');
            $client['राखीव निधी_sum_currentYear'] = $client['राखीव निधी']->sum('currentYear');
               $client['इतर सर्व निधी'] = $client->masterData->where('menu', 'इतर सर्व निधी');
            $client['इतर सर्व निधी_sum_currentYear'] = $client['इतर सर्व निधी']->sum('currentYear');
            
            $incomeMenus = ['इतर उत्त्पन्न', 'गुंतवणुकीवरील व्याज', 'कर्जावरील व्याज', 'किरकोळ उत्त्पन्न'];
            $expenseMenus = ['इतर खर्च', 'तरतूद खर्च', 'प्रशासकीय खर्च', 'आस्थापना खर्च', 'ठेवीवरील व्याज'];

            $client['एकूण उत्पन्न_sum_currentYear'] = $client->masterData->whereIn('menu', $incomeMenus)->sum('currentYear');
            $totalIncome = $client->masterData->whereIn('menu', $incomeMenus)->sum('currentYear');
            $totalExpense = $client->masterData->whereIn('menu', $expenseMenus)->sum('currentYear');

            $totalProfit = $totalIncome - $totalExpense;
            $incomeMenus2 = ['आस्थापना खर्च', 'प्रशासकीय खर्च'];
            $client['व्यवस्थापन खर्च_sum_currentYear'] = $client->masterData->whereIn('menu', $incomeMenus2)->sum('currentYear');
            $client['गुंतवणूकशी प्रमाण'] =$client['गुंतवणूक_sum'] + $client['येणे कर्ज_sum'];
            $client['गतवर्षातील ठेवी']=$client['ठेवी_sum'] -$client['ठेवी_sum_lastYear'];
            
            return view('admin.clients.sheet6', compact('client','totalProfit'));
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
