<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model {
    protected $fillable = [
        'building_id', 'unit_number', 'floor', 'type', 'bedrooms', 'bathrooms',
        'monthly_rent_default', 'security_deposit_default', 'status', 'notes',
        'description', 'amenities', 'photos', 'is_listed', 'video_url',
    ];
    protected $casts = ['monthly_rent_default' => 'decimal:2', 'security_deposit_default' => 'decimal:2', 'amenities' => 'array', 'photos' => 'array', 'is_listed' => 'boolean'];
    public function building() { return $this->belongsTo(Building::class); }
    public function leases() { return $this->hasMany(Lease::class); }
    public function getRentAmountAttribute() { return $this->monthly_rent_default; }
    public function getDepositAmountAttribute() { return $this->security_deposit_default; }
    public function getSqftAttribute() { return $this->notes; }
}
