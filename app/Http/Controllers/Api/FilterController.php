<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Estate;
use App\Models\Owner;
use App\Models\Price;
use App\Models\Remont;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FilterController extends Controller
{
    public function generalFilter(Request $request)
    {
        $search = request()->search;
        
        if(request()->item == 1){
            $estate = Estate::where('status',1)->where('title', 'like', '%'.$search.'%')
            ->orwhere('body', 'like', '%'.$search.'%')
            ->orderby('updated_at','desc')->get()->take(10);
        }elseif(request()->item == 2){
            $estate = Owner::where('number', 'like', '%'.$search.'%')
            ->orderby('updated_at','desc')->get()->take(10);
        }elseif(request()->item == 3){
            $estate = Estate::where('status',1)
            ->where('url', 'like', '%'.$search.'%')
            ->orderby('updated_at','desc')->get()->take(10);
        }else{
            $estate = null;
        }
        
        return response()->json([
            'status' => true,
            'estate' =>$estate,
        ]);
    }
    public function getRemonts()
    {
        $remonts = Remont::all();
        if(count($remonts)>0){
            return response()->json([
                'status' => true,
                'remonts' =>$remonts,
            ]);
        }else{
            return response()->json([
                'status' => false,
                'remonts' =>null,
            ]);
        }
        
    }
    
}
