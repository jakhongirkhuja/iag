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
}
