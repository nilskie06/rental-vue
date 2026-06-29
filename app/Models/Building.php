<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Building extends Model {
    protected $fillable = ['name', 'address', 'notes', 'description', 'latitude', 'longitude', 'neighborhood'];
    public function units() { return $this->hasMany(Unit::class); }
}
