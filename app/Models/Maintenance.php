<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model {
    protected $table = 'maintenance_requests';
    protected $fillable = ['unit_id', 'tenant_id', 'title', 'description', 'priority', 'status', 'cost', 'assigned_to'];
    
    public function unit() { return $this->belongsTo(Unit::class); }
    public function tenant() { return $this->belongsTo(Tenant::class); }
}
