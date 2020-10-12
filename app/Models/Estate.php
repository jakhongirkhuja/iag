<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Owner;
use Illuminate\Database\Eloquent\SoftDeletes;
class Estate extends Model
{
    protected $casts = [
        'price' => 'array',
        'ad_update_at'=>'array',
    ];
    use SoftDeletes;
    public function owner()
    {
        return $this->belongsToMany(Owner::class);
    }
    public function getHouseType()
    {
        return $this->belongsTo('App\Models\HouseType', 'house_type')->first();
    }
    public function getCity()
    {
        return $this->belongsTo('App\Models\City', 'city')->first();
    }
    public function getRegion()
    {
        return $this->belongsTo('App\Models\Region', 'region')->first();
    }
    public function getRemont()
    {
        return $this->belongsTo('App\Models\Remont', 'remont' ,'id')->first();
    }
}
