<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Building;
use Illuminate\Http\Request;

class BuildingController extends Controller {
    public function index() {
        return Building::withCount('units')->get();
    }
    public function store(Request $request) {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'zip' => 'required|string|max:20',
            'description' => 'nullable|string',
        ]);
        return Building::create($validated);
    }
    public function show(Building $building) {
        return $building->load('units');
    }
    public function update(Request $request, Building $building) {
        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'address' => 'sometimes|string|max:255',
            'city' => 'sometimes|string|max:255',
            'state' => 'sometimes|string|max:255',
            'zip' => 'sometimes|string|max:20',
            'description' => 'nullable|string',
        ]);
        $building->update($validated);
        return $building;
    }
    public function destroy(Building $building) {
        $building->delete();
        return response()->json(['message' => 'Deleted']);
    }
}
