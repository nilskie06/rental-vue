<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Tenant;
use Illuminate\Http\Request;

class TenantController extends Controller {
    public function index() { return Tenant::withCount('leases')->get(); }
    public function store(Request $request) {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:tenants',
            'phone' => 'required|string|max:20',
            'emergency_contact_name' => 'nullable|string|max:255',
            'emergency_contact_phone' => 'nullable|string|max:20',
        ]);
        return Tenant::create($validated);
    }
    public function show(Tenant $tenant) { return $tenant->load(['leases.unit.building', 'invoices']); }
    public function update(Request $request, Tenant $tenant) {
        $tenant->update($request->only(['first_name','last_name','email','phone','emergency_contact_name','emergency_contact_phone','notes']));
        return $tenant;
    }
    public function destroy(Tenant $tenant) { $tenant->delete(); return response()->json(['message' => 'Deleted']); }
}
