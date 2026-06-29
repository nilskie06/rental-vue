<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model {
    protected $fillable = [
        'payment_number', 'invoice_id', 'lease_id', 'tenant_id', 'amount',
        'payment_date', 'method', 'reference_number', 'gateway_response', 'type',
        'status', 'recorded_by_user_id', 'notes', 'bir_or_number', 'bir_or_date',
        'proof_path', 'proof_uploaded_at', 'proof_approved_by', 'proof_approved_at',
    ];
    protected $casts = ['amount' => 'decimal:2'];
    public function invoice() { return $this->belongsTo(Invoice::class); }
    public function lease() { return $this->belongsTo(Lease::class); }
    public function tenant() { return $this->belongsTo(Tenant::class); }
    public function getPaymentMethodAttribute() { return $this->method; }
}
