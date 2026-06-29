<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller {
    public function index(Request $request) {
        $query = Invoice::with('lease.tenant');
        if ($request->status) $query->where('status', $request->status);
        return $query->latest()->get();
    }
    public function store(Request $request) {
        $validated = $request->validate([
            'lease_id' => 'required|exists:leases,id',
            'amount' => 'required|numeric|min:0',
            'due_date' => 'required|date',
            'type' => 'required|in:rent,utility,fee,late',
            'notes' => 'nullable|string',
        ]);
        $validated['invoice_number'] = 'INV-' . strtoupper(uniqid());
        return Invoice::create($validated)->load('lease.tenant');
    }
    public function show(Invoice $invoice) { return $invoice->load(['lease.tenant', 'payments']); }
    public function update(Request $request, Invoice $invoice) {
        $invoice->update($request->only(['status','paid_amount','notes']));
        if ($invoice->paid_amount >= $invoice->amount) $invoice->update(['status' => 'paid']);
        elseif ($invoice->paid_amount > 0) $invoice->update(['status' => 'partial']);
        return $invoice;
    }
    public function destroy(Invoice $invoice) { $invoice->delete(); return response()->json(['message' => 'Deleted']); }
}
