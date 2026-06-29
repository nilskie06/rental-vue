<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Maintenance;
use Illuminate\Http\Request;

class MaintenanceController extends Controller {
    public function index(Request $request) {
        $query = Maintenance::with('unit');
        if ($request->status) $query->where('status', $request->status);
        return $query->latest()->get();
    }
    public function store(Request $request) {
        $validated = $request->validate([
            'unit_id' => 'required|exists:units,id',
            'tenant_id' => 'nullable|exists:tenants,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'priority' => 'required|in:low,medium,high,urgent',
        ]);
        return Maintenance::create($validated)->load('unit');
    }
    public function show(Maintenance $maintenance) { return $maintenance->load('unit'); }
    public function update(Request $request, Maintenance $maintenance) {
        $maintenance->update($request->only(['status','cost','assigned_to']));
        return $maintenance;
    }
    public function destroy(Maintenance $maintenance) { $maintenance->delete(); return response()->json(['message' => 'Deleted']); }
}
