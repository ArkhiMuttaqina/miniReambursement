<?php

namespace App\Http\Controllers;

use App\Models\Reimbursement;
use Illuminate\Http\Request;

class FinanceController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index()
    {
        $reimbursements = Reimbursement::all();
        return view('reimbursements.index', compact('reimbursements'));
    }


    public function create()
    {
        return view('reimbursements.create');
    }


    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'nullable|string',
            'creator_id' => 'nullable|string',
            'approver_id' => 'nullable|string',
            'nominal' => 'nullable|string',
            'approved_at' => 'nullable|string',
            'status' => 'nullable|string',
            'desc' => 'nullable|string',
            'files' => 'nullable|string',
        ]);

        Reimbursement::create($data);

        return redirect()->route('reimbursements.index')->with('success', 'Reimbursement telah berhasil dibuat.');
    }


    public function show(Reimbursement $reimbursement)
    {
        return view('reimbursements.show', compact('reimbursement'));
    }


    public function edit(Reimbursement $reimbursement)
    {
        return view('reimbursements.edit', compact('reimbursement'));
    }


    public function update(Request $request, Reimbursement $reimbursement)
    {
        $data = $request->validate([
            'name' => 'nullable|string',
            'creator_id' => 'nullable|string',
            'approver_id' => 'nullable|string',
            'nominal' => 'nullable|string',
            'approved_at' => 'nullable|string',
            'status' => 'nullable|string',
            'desc' => 'nullable|string',
            'files' => 'nullable|string',
        ]);

        $reimbursement->update($data);

        return redirect()->route('reimbursements.show', $reimbursement)->with('success', 'Reimbursement telah berhasil diperbarui.');
    }


    public function destroy(Reimbursement $reimbursement)
    {
        $reimbursement->delete();

        return redirect()->route('reimbursements.index')->with('success', 'Reimbursement telah berhasil dihapus.');
    }
}
