<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loc_province extends Model
{
    use HasFactory;
    protected $table = "loc_province";
    public $timestamps = false;

    public function alamat()
    {
        return $this->belongsTo('App\Models\Alamat','id', 'id');
    }
    public function district()
    {
        return $this->hasMany('App\Models\Loc_district','id', 'id');
    }
    public function city()
    {
        return $this->belongsTo('App\Models\Loc_city','id', 'id');
    }
    public function village()
    {
        return $this->hasMany('App\Models\Loc_village','id', 'id');
    }
}
