<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use Illuminate\Http\Request;

class ExpenseController extends Controller {
    public function index(Request $request) {
        $query = Expense::with('building');
        if ($request->category) $query->where('category', $request->category);
        return $query->latest()->get();
    }
    public function store(Request $request) {
        $validated = $request->validate([
            'building_id' => 'nullable|exists:buildings,id',
            'category' => 'required|in:utilities,maintenance,insurance,tax,other',
            'description' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'expense_date' => 'required|date',
            'vendor' => 'nullable|string|max:255',
        ]);
        return Expense::create($validated);
    }
    public function show(Expense $expense) { return $expense->load('building'); }
    public function update(Request $request, Expense $expense) {
        $expense->update($request->only(['category','description','amount','expense_date','vendor']));
        return $expense;
    }
    public function destroy(Expense $expense) { $expense->delete(); return response()->json(['message' => 'Deleted']); }
}
