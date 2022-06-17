<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alamat extends Model
{
    use HasFactory;
    protected $table = "alamats";
    protected $primaryKey = "id";
    protected $fillable = ['province_id', 'city_id', 'id_kecamatan', 'district_id', 'alamat', 'flag_delete', 'flag_active'];

    
    public function province()
    {
        return $this->belongsTo('App\Models\Loc_province','id', 'id');
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
