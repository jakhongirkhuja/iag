<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Estate;
use App\Imports\EstateImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Str;
use App\Models\Owner;
use App\Models\Remont;
use App\Models\Region;
use App\Models\City;
class IndexController extends Controller
{
    public function getRightNumberFormat($number)
    {
        $s = Str::of($number)->replace(' ', '')
        ->replace('+', '')
        ->replace('-', '');
        $length  = Str::length($s);
        if($length == 9){
            $s = '+998'.$s;
        }
        if($length==12){
            $s = '+'.$s;
        }
        return $s;
    }
    public function index()
    {
        
        dd('hello');
        $owner = Owner::paginate(25);
        $estate= Estate::paginate(25);
       
        return view('welcome', [
            'owner'=>$owner,
            'estate'=>$estate,
            'counto' => count(Owner::all()),
            'count'=>count(Estate::all()),
        ]);
    }
    public function import(Request $request) 
    {
        if ($request->hasFile('excel')) {
            Excel::import(new EstateImport($request->site), $request->file('excel'));
            return back()->with('success', 'Uploaded Successfully!');
         } else {
           return back()->with('success', "Error");
         }
        
    }
}
