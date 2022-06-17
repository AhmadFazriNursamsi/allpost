<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loc_district extends Model
{
    use HasFactory;
    protected $table = "loc_district";
    public $timestamps = false;


    public function alamat()
    {
        return $this->belongsTo('App\Models\Alamat','id', 'id');
    }
    public function district()
    {
        return $this->hasMany('App\Models\Loc_district','id', 'id');
    }
    public function province()
    {
        return $this->hasMany('App\Models\Loc_province','id', 'id');
    }
    public function village()
    {
        return $this->hasMany('App\Models\Loc_village','id', 'id');
    }
}
