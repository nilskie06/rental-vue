<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model {
    protected $fillable = [
        'invoice_number', 'lease_id', 'billing_month', 'due_date', 'base_rent',
        'late_fee', 'other_charges', 'total_amount', 'amount_paid', 'status', 'issued_at', 'notes',
    ];
    protected $casts = ['total_amount' => 'decimal:2', 'amount_paid' => 'decimal:2', 'base_rent' => 'decimal:2', 'late_fee' => 'decimal:2', 'other_charges' => 'decimal:2'];
    public function lease() { return $this->belongsTo(Lease::class); }
    public function payments() { return $this->hasMany(Payment::class); }
    public function getAmountAttribute() { return $this->total_amount; }
    public function getPaidAmountAttribute() { return $this->amount_paid; }
}
