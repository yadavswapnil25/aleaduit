<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAuditRequest;
use App\Http\Requests\UpdateAuditRequest;
use App\Models\Audit;
use Illuminate\Http\Request;
use Exception;
use DataTables;

class AuditController extends Controller
{
    public function index(Request $request)
    {
       
        if ($request->ajax()) {
            $audits = Audit::where('user_id', auth()->id())->latest();
            return Datatables::of($audits)
                ->addColumn('action', function ($audit) {
                    $btn = '<a href="/admin/audit/edit/' . $audit->id . '" class="" title="Edit"><i class="fa fa-edit"></i></a>';
                    return $btn;
                })
                ->editColumn('created_at', function ($audit) {
                    return [
                        'display'   => $audit->created_at->format('d-m-Y h:i A'),
                        'timestamp' => $audit->created_at,
                    ];
                })
                ->escapeColumns([])
                ->make(true);
        }
        return view('admin.audits.index');
    }

    public function create()
    {
        return view('admin.audits.create');
    }

    public function store(StoreAuditRequest $request)
    {
        try {
            
            Audit::create(array_merge($request->all(), ['user_id' => auth()->id()]));
            return redirect()->route('admin.audits.index')->with('success', 'Audit added successfully');
        } catch (Exception $e) {
            dd($e);
            return redirect()->back()->withErrors(['error' => 'An error occurred while adding the audit: ' . $e->getMessage()]);
        }
    }

    public function edit(int $id)
    {
        $audit = Audit::find($id);
        return view('admin.audits.edit', compact('audit'));
    }

    public function update(UpdateAuditRequest $request, int $id)
    {
    
        try {
            $audit = Audit::find($id);
            $audit->update($request->all());
            return redirect()->route('admin.audits.index')->with('success', 'Audit updated successfully');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => 'An error occurred while updating the audit: ' . $e->getMessage()]);
        }
    }

    public function destroy(int $id)
    {
        try {
            $audit = Audit::find($id);
            $audit->delete();
            return redirect()->route('admin.audits.index')->with('success', 'Audit deleted successfully');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => 'An error occurred while deleting the audit: ' . $e->getMessage()]);
        }
    }
}
