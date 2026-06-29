<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Lease extends Model {
    protected $fillable = [
        'unit_id', 'tenant_id', 'start_date', 'end_date', 'monthly_rent',
        'security_deposit', 'downpayment', 'billing_day', 'status',
        'late_fee_type', 'late_fee_amount', 'late_fee_grace_days', 'notes',
    ];
    protected $casts = ['monthly_rent' => 'decimal:2', 'security_deposit' => 'decimal:2', 'downpayment' => 'decimal:2'];
    public function unit() { return $this->belongsTo(Unit::class); }
    public function tenant() { return $this->belongsTo(Tenant::class); }
    public function invoices() { return $this->hasMany(Invoice::class); }
}
