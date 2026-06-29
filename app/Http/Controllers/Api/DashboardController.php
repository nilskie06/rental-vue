<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\{Building, Unit, Tenant, Lease, Invoice, Payment, Maintenance, Expense};
use Illuminate\Http\Request;

class DashboardController extends Controller {
    public function index() {
        return response()->json([
            'stats' => [
                'total_buildings' => Building::count(),
                'total_units' => Unit::count(),
                'occupied_units' => Unit::where('status', 'occupied')->count(),
                'vacant_units' => Unit::where('status', 'vacant')->count(),
                'total_tenants' => Tenant::count(),
                'active_leases' => Lease::where('status', 'active')->count(),
                'total_revenue' => Payment::where('status', 'confirmed')->sum('amount'),
                'pending_invoices' => Invoice::where('status', 'pending')->sum('amount'),
                'overdue_invoices' => Invoice::where('status', 'overdue')->count(),
                'open_maintenance' => Maintenance::where('status', 'pending')->count(),
                'total_expenses' => Expense::sum('amount'),
            ],
            'recent_payments' => Payment::with('invoice.lease.tenant')->latest()->take(5)->get(),
            'recent_maintenance' => Maintenance::with('unit')->latest()->take(5)->get(),
        ]);
    }
}
