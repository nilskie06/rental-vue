<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Lease;
use Illuminate\Http\Request;

class LeaseController extends Controller {
    public function index() { return Lease::with(['unit.building', 'tenant'])->get(); }
    public function store(Request $request) {
        $validated = $request->validate([
            'unit_id' => 'required|exists:units,id',
            'tenant_id' => 'required|exists:tenants,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'monthly_rent' => 'required|numeric|min:0',
            'security_deposit' => 'nullable|numeric|min:0',
            'terms' => 'nullable|string',
        ]);
        $lease = Lease::create($validated);
        $lease->unit->update(['status' => 'occupied']);
        return $lease->load(['unit', 'tenant']);
    }
    public function show(Lease $lease) { return $lease->load(['unit.building', 'tenant', 'invoices.payments']); }
    public function update(Request $request, Lease $lease) {
        $lease->update($request->only(['status','monthly_rent','end_date','terms']));
        if ($lease->status === 'terminated' || $lease->status === 'expired') {
            $lease->unit->update(['status' => 'vacant']);
        }
        return $lease;
    }
    public function destroy(Lease $lease) {
        $lease->unit->update(['status' => 'vacant']);
        $lease->delete();
        return response()->json(['message' => 'Deleted']);
    }
}
