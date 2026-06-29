<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller {
    public function index(Request $request) {
        $query = Unit::with('building');
        if ($request->building_id) $query->where('building_id', $request->building_id);
        if ($request->status) $query->where('status', $request->status);
        if ($request->type) $query->where('type', $request->type);
        return $query->get();
    }
    public function store(Request $request) {
        $validated = $request->validate([
            'building_id' => 'required|exists:buildings,id',
            'unit_number' => 'required|string|max:50',
            'floor' => 'nullable|string|max:20',
            'type' => 'required|in:apartment,studio,condo,house',
            'bedrooms' => 'required|integer|min:0',
            'bathrooms' => 'required|integer|min:0',
            'sqft' => 'nullable|numeric|min:0',
            'rent_amount' => 'required|numeric|min:0',
            'deposit_amount' => 'nullable|numeric|min:0',
            'features' => 'nullable|array',
        ]);
        return Unit::create($validated);
    }
    public function show(Unit $unit) { return $unit->load('building'); }
    public function update(Request $request, Unit $unit) {
        $unit->update($request->only([
            'unit_number','floor','type','bedrooms','bathrooms','sqft',
            'rent_amount','deposit_amount','status','features','images'
        ]));
        return $unit;
    }
    public function destroy(Unit $unit) { $unit->delete(); return response()->json(['message' => 'Deleted']); }
}
