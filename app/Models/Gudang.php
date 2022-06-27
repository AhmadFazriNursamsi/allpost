<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gudang extends Model
{
    use HasFactory;

    protected $table = "gudang";
    protected $primaryKey = "id";
    protected $guarded = ['id'];
    public $timestamps = false;

    public function alamats()
    {
        return $this->hasMany('App\Models\Alamat','id_customer', 'id');
    }
    public function divisions()
    {
        return $this->hasMany('App\Models\Division','id_division', 'id_division');
    }
    public function users()
    {
        return $this->belongsTo('App\Models\User','id', 'id');
    }
    public function roles()
    {
        return $this->belongsTo('App\Models\Role','user', 'id_role');
    }
    public function province()
    {
        return $this->hasMany('App\Models\Loc_province','id', 'province');
    }
    public function city()
    {
        return $this->belongsTo('App\Models\Loc_city','id', 'id');
    }
    public function district()
    {
        return $this->hasMany('App\Models\Loc_district','id', 'id');
    }
    public function village()
    {
        return $this->hasMany('App\Models\Loc_village','id', 'id');
    }
    
}
