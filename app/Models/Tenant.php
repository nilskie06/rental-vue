<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Tenant extends Model {
    protected $fillable = [
        'user_id', 'first_name', 'last_name', 'email', 'phone', 'id_type', 'id_number',
        'emergency_contact_name', 'emergency_contact_phone', 'notes',
    ];
    public function user() { return $this->belongsTo(User::class); }
    public function leases() { return $this->hasMany(Lease::class); }
}
