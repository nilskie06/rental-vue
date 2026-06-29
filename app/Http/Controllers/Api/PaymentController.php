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
            'payment_method' => 'required|in:cash,bank_transfer,gcash,maya,paymongo',
            'reference_number' => 'nullable|string|max:100',
            'notes' => 'nullable|string',
        ]);
        $payment = Payment::create($validated);
        $invoice = $payment->invoice;
        $invoice->paid_amount += $payment->amount;
        if ($invoice->paid_amount >= $invoice->amount) $invoice->update(['status' => 'paid', 'paid_amount' => $invoice->paid_amount]);
        elseif ($invoice->paid_amount > 0) $invoice->update(['status' => 'partial', 'paid_amount' => $invoice->paid_amount]);
        return $payment->load('invoice.lease.tenant');
    }
    public function show(Payment $payment) { return $payment->load('invoice.lease.tenant'); }
    public function destroy(Payment $payment) { $payment->delete(); return response()->json(['message' => 'Deleted']); }
}
