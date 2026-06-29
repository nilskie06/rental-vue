<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller {
    public function index() { return Payment::with('invoice.lease.tenant')->latest()->get(); }
    public function store(Request $request) {
        $validated = $request->validate([
            'invoice_id' => 'required|exists:invoices,id',
            'tenant_id' => 'required|exists:tenants,id',
            'amount' => 'required|numeric|min:0',
            'payment_date' => 'required|date',
            'method' => 'required|string',
            'reference_number' => 'nullable|string|max:100',
            'notes' => 'nullable|string',
        ]);
        $validated['payment_number'] = 'PAY-' . strtoupper(uniqid());
        $validated['status'] = 'confirmed';
        $payment = Payment::create($validated);
        $invoice = $payment->invoice;
        $invoice->amount_paid += $payment->amount;
        if ($invoice->amount_paid >= $invoice->total_amount) $invoice->update(['status' => 'paid', 'amount_paid' => $invoice->amount_paid]);
        elseif ($invoice->amount_paid > 0) $invoice->update(['status' => 'partial', 'amount_paid' => $invoice->amount_paid]);
        return $payment->load('invoice.lease.tenant');
    }
    public function show(Payment $payment) { return $payment->load('invoice.lease.tenant'); }
    public function destroy(Payment $payment) { $payment->delete(); return response()->json(['message' => 'Deleted']); }
}
