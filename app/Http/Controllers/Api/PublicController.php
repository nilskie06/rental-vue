<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\{Unit, Building, VisitRequest, Waitlist, Testimonial};
use Illuminate\Http\Request;

class PublicController extends Controller {
    public function units() {
        return Unit::with('building')->where('status', '!=', 'maintenance')->get();
    }
    public function unit(Unit $unit) {
        return $unit->load('building');
    }
    public function buildings() {
        return Building::withCount('units')->get();
    }
    public function visitRequest(Request $request) {
        $validated = $request->validate([
            'unit_id' => 'nullable|exists:units,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:20',
            'preferred_date' => 'required|date',
            'message' => 'nullable|string',
        ]);
        return VisitRequest::create($validated);
    }
    public function waitlist(Request $request) {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:waitlists',
            'phone' => 'required|string|max:20',
            'preferred_unit_type' => 'nullable|string|max:50',
            'message' => 'nullable|string',
        ]);
        return Waitlist::create($validated);
    }
    public function testimonials() {
        return Testimonial::where('approved', true)->latest()->get();
    }
}
