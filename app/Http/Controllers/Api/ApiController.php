<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Owner;
use App\Models\Remont;
use App\Models\BuildingType;
use App\Models\Category;
use App\Models\HouseLayout;
use App\Models\City;
use App\Models\Region;
use App\Models\OtherLoc;
use App\Models\HouseType;
use Illuminate\Support\Str;
use App\Models\Estate;
use App\Models\OwnerType;
use App\Models\ParsingPage;
use App\Models\Price;
use Carbon\Carbon;

class ApiController extends Controller
{
    public function checkBuildingType($name)
    {
        $builtingtype = BuildingType::where('name', $name)->first();
        if($builtingtype){
            return $builtingtype->id; 
        }else{
            $names = trim(preg_replace('/\s\s+/', ' ', $name));
            $names = Str::of($names)->replace(' ', '');
            if($names == ''){
                return null;
            }
            $builtingtype = new BuildingType();
            $builtingtype->name = $name;
            if($builtingtype->save()){
                return $builtingtype->id;
            }else{
                return false;
            }
            
        }
    }
    public function checkHouseLayout($name)
    {
        $houseLayout = HouseLayout::where('name', $name)->first();
        if($houseLayout){
            return $houseLayout->id; 
        }else{
            $names = trim(preg_replace('/\s\s+/', ' ', $name));
            $names = Str::of($names)->replace(' ', '');
            if($names == ''){
                return null;
            }
            $houseLayout = new HouseLayout();
            $houseLayout->name = $name;
            if($houseLayout->save()){
                return $houseLayout->id;
            }else{
                return false;
            }
            
        }
    }
    public function checkHouseType($name)
    {
        $houseType = HouseType::where('name', $name)->first();
        if($houseType){
            return $houseType->id; 
        }else{
            $names = trim(preg_replace('/\s\s+/', ' ', $name));
            $names = Str::of($names)->replace(' ', '');
            if($names == ''){
                return null;
            }
            $houseType = new HouseType();
            $houseType->name = $name;
            if($houseType->save()){
                return $houseType->id;
            }else{
                return false;
            }
            
        }
    }
    public function checkCategory($name)
    {
        $category = Category::where('name', $name)->first();
        if($category){
            return $category->id; 
        }else{
            $names = trim(preg_replace('/\s\s+/', ' ', $name));
            $names = Str::of($names)->replace(' ', '');
            if($names == ''){
                return null;
            }
            $category = new Category();
            $category->name = $name;
            if($category->save()){
                return $category->id;
            }else{
                return false;
            }
            
        }
    }
    public function checkremont($name)
    {
        $remont = Remont::where('name',$name)->first();
        if($remont){
            return $remont->id; 
        }else{
            $names = trim(preg_replace('/\s\s+/', ' ', $name));
            $names = Str::of($names)->replace(' ', '');
            if($names == ''){
                return null;
            }
            $remont = new Remont();
            $remont->name = $name;
            if($remont->save()){
                return $remont->id;
            }else{
                return false;
            }
            
        }
    }
    public function checkcity($name)
    {
        $city = City::where('name',$name)->first();
        if($city){
            return $city->id; 
        }else{
            $names = trim(preg_replace('/\s\s+/', ' ', $name));
            $names = Str::of($names)->replace(' ', '');
            if($names == ''){
                return null;
            }
            $city = new City();
            $city->name = $name;
            if($city->save()){
                return $city->id;
            }else{
                return false;
            }
            
        }
    }
    public function checkregion($name)
    {
        $contains = Str::contains($name, 'Яшнободский район');
        if ($contains) {
            $name = 'Яшнабадский район';
        }
        $region = Region::where('name',$name)->first();
        if($region){
            return $region->id; 
        }else{
            $names = trim(preg_replace('/\s\s+/', ' ', $name));
            $names = Str::of($names)->replace(' ', '');
            if($names == ''){
                return null;
            }
            $region = new Region();
            $region->name = $name;
            if($region->save()){
                return $region->id;
            }else{
                return false;
            }
            
        }
    }
    public function checkOwnerType($name)
    {
    	$contains = Str::contains($name, 'Частного лица');
    	if ($contains) {
    		$name = 'Частное лицо';
    	}
        $ownertype = OwnerType::where('name',$name)->first();
        if($ownertype){
            return $ownertype->id; 
        }else{
            $names = trim(preg_replace('/\s\s+/', ' ', $name));
            $names = Str::of($names)->replace(' ', '');
            if($names == ''){
                return null;
            }
            $ownertype = new OwnerType();
            $ownertype->name = $name;
            if($ownertype->save()){
                return $ownertype->id;
            }else{
                return false;
            }
            
        }
    }
    public function checkOtherLoc($name)
    {
        $otherloc = OtherLoc::where('name',$name)->first();
        if($otherloc){
            return $otherloc->id; 
        }else{
            $names = trim(preg_replace('/\s\s+/', ' ', $name));
            $names = Str::of($names)->replace(' ', '');
            if($names == ''){
                return null;
            }
            $otherloc = new OtherLoc();
            $otherloc->name = $name;
            if($otherloc->save()){
                return $otherloc->id;
            }else{
                return false;
            }
            
        }
    }
    public function getPrice($price)
    {
        // if(Str::contains($price, 'сум')){
        //     $currency = 'сум';
        // }else{
        //     $currency = 'у.е';
        // }
        $price = (string)Str::of($price)->replace(' ', '');
        // $price_new = new Price();
        // $price_new->price = (int)$price;
        // $price_new->currency = $currency;
        // $price_new->updated_at = Str::of($time)->replace('"','');
        // $price_new->save();
        // $json_price = [
        //     'price' => (int)$price,
        //     'time' => $time,
        //     'currency'=>$currency
        // ];
       
        return (int)$price;
    }
    public function CheckUpdatePrice($estate_id, $price, $time)
    {
        $price_notchanged = (string)Str::of($price)->replace(' ', '');
        $check_price= Price::where('estate_id', $estate_id)->where('price', (int)$price_notchanged)->first();
        if(!$check_price){
            if(Str::contains($price, 'сум')){
                $currency = 'сум';
            }else{
                $currency = 'у.е';
            }
            $price = (string)Str::of($price)->replace(' ', '');
            $price_new = new Price();
            $price_new->estate_id = $estate_id;
            $price_new->price = (int)$price;
            $price_new->currency = $currency;
            $price_new->updated_at = Carbon::now();
            $price_new->save();
        }
        // $time_change = json_decode($oldprice, true);
        
        // if(count($time_change)==3){
        //     $ok =  end($time_change);
        // }else{
        //     $ok =end($time_change)['time'];
        // }
        
        
        // if(count($time_change)>3){
        //     $ok = last($time_change)['price'];
        // }else{
        //     $ok = $time_change['price'];
        // }
        // if($ok != $price){
            
        //     if(Str::contains($price, 'сум')){
        //         $currency = 'сум';
        //     }else{
        //         $currency = 'у.е';
        //     }
        //     $price = (string)Str::of($price)->replace(' ', '');
        //     $time_changed = [
        //         'price' => (int)$price,
        //         'time' => $time,
        //         'currency'=>$currency
        //     ];
        //     $doceded= json_decode(json_encode($time_changed), true);
            
        //     $time_change[] = $doceded;
            
        //     $overall = json_encode($time_change);
        // } 
        return (int)$price_notchanged;
    }
    public function checkTime($time)
    {
        if(Str::contains($time, 'августа')){
            $time = Str::of($time)->replace('августа', '08');
        }
        elseif(Str::contains($time, 'сентября')){
            $time = Str::of($time)->replace('сентября', '09');
        }
        elseif(Str::contains($time, 'октября')){
            $time = Str::of($time)->replace('октября', '10');
        }
        elseif(Str::contains($time, 'ноября')){
            $time = Str::of($time)->replace('ноября', '11');
        }
        elseif(Str::contains($time, 'декабря')){
            $time = Str::of($time)->replace('декабря', '12');
        }
        elseif(Str::contains($time, 'января')){
            $time = Str::of($time)->replace('января', '01');
        }
        elseif(Str::contains($time, 'февраля')){
            $time = Str::of($time)->replace('февраля', '02');
        }
        elseif(Str::contains($time, 'марта')){
            $time = Str::of($time)->replace('марта', '03');
        }
        elseif(Str::contains($time, 'апреля')){
            $time = Str::of($time)->replace('апреля', '04');
        }
        elseif(Str::contains($time, 'мая')){
            $time = Str::of($time)->replace('мая', '05');
        } elseif(Str::contains($time, 'июня')){
            $time = Str::of($time)->replace('июня', '06');
        }
        elseif(Str::contains($time, 'июля')){
            $time = Str::of($time)->replace('июля', '07');
        }
        $time = \Carbon\Carbon::createFromFormat('H:i, d m Y', $time)->format('"Y-m-d H:i:s"');
        return $time;
    }
    public function checkUpdateEstite($estite, $row)
    {
        $time = $row['created_at'];
        $changedsmth = false;
        
        if(Str::startsWith($time, 'в')){
            
            //olx time
            $time = Str::of($time)->replace('в ', '');
            $time = $this->checkTime($time);
            
            $time_change = json_decode($estite->ad_update_at, true);
            
            if(count($time_change)==1){
               $ok =  end($time_change);
            }else{
                $ok =end($time_change)['time'];
            }
            if( $ok!= $time){
                $time_changed = [
                    'time' => $time,
                ];
                $doceded= json_decode(json_encode($time_changed), true);
                $time_change[] = $doceded;

                $overall = json_encode($time_change);
                $changedsmth = true;
                $estite->ad_update_at = $overall;
            } 
            
             
        }else{
            //uybor time

            $time_change = json_decode($estite->ad_update_at, true);
            if(count($time_change)==1){
                $ok =  end($time_change);
             }else{
                 $ok =end($time_change)['time'];
             }
            if($ok != $time){
                $time_changed = [
                    'time' => $time,
                ];
                $doceded= json_decode(json_encode($time_changed), true);
                
                $time_change[] = $doceded;
                
                $overall = json_encode($time_change);
                $changedsmth = true;
                $estite->ad_update_at = $overall;
            }  
            
        }
        if($changedsmth){
            $estite->price = $this->CheckUpdatePrice($estite->id,$row['price'], $time);
            if(Str::contains($row['price'], 'сум')){
                $currency_new = 'сум';
            }else{
                $currency_new = 'у.е';
            }
            $estite->currency = $currency_new;
            $estite->num_rooms = (int)$row['num_rooms'];
            $estite->total_area = (float)$row['total_area'];
            $estite->map=$row['map'];
            if((float)$row['living_space']==0){
                $estite->living_space = null;
            }else{
                $estite->living_space = (float)$row['living_space'];
            }
            if((float)$row['kitchen_area']==0){
                $estite->kitchen_area = null;
            }else{
                $estite->kitchen_area = (float)$row['kitchen_area'];
            }
            $estite->floor = (int)$row['floor'];
            $estite->floor_house = (int)$row['floor_house'];
            if(Str::contains($row['construction_year'],'0')){
                $estite->construction_year = null;
            }else{
                $estite->construction_year = $row['construction_year'];
            }
            if((float)$row['ceiling_height']==0){
                $estite->ceiling_height = null;
            }else{
                $estite->ceiling_height = (float)$row['ceiling_height'];
            }
            $estite->url = $row['url'];
                $apartment_has = $row['apartment_has'];
                if(Str::startsWith($apartment_has, ',')){
                    $apartment_has = Str::substr($apartment_has, 2, Str::length($apartment_has));
                }else{
                    $apartment_has = trim(preg_replace('/\s\s+/', ' ', $apartment_has));
                    $apartment_has = Str::of($apartment_has)->replace(' ', ', ');
                }
            $estite->apartment_has = (string)$apartment_has; 
                $near_has = $row['near_has'];
                if(Str::startsWith($near_has, ',')){
                    $near_has = Str::substr($near_has, 2, Str::length($near_has));
                }else{
                    $near_has = trim(preg_replace('/\s\s+/', ' ', $near_has));
                    $near_has = Str::of($near_has)->replace(' ', ', ');
                }
            $estite->near_has = (string)$near_has;
            
            $checkremont = $this->checkremont($row['remont']);
            if($checkremont){
                $estite->remont = $checkremont;
            }else{
                $estite->remont = null;
            }
            if(Str::contains($row['building_type'],'0')){
                $estite->building_type = null;
            }else{
                $buildingtype = $this->checkBuildingType($row['building_type']);
                if($buildingtype){
                    $estite->building_type = $buildingtype;
                }else{
                    $estite->building_type = null;
                }
            }
            if(Str::contains($row['planirovka'],'0')){
                $estite->house_layout = null;
            }else{
                $houseLayout = $this->checkHouseLayout($row['planirovka']);
                if($houseLayout){
                    $estite->house_layout = $houseLayout;
                }else{
                    $estite->house_layout = null;
                }
            }

            
                $title = $row['title'];
                $title = trim(preg_replace('/\s\s+/', ' ', $title));
                $slug = Str::slug($title, "-");
                if(Estate::where('slug', $slug)->first()){
                    $estite->slug = $slug.'-'.(string)time();
                }else{
                    $estite->slug = $slug;
                }
            $estite->title = $title;
                $body = $row['body'];
                $body = trim(preg_replace('/\s\s+/', ' ', $body));
            $estite->body = $body;
            $estite->img = $row['img'];
            

            $city = $this->checkcity($row['city']);
            if($city){
                $estite->city = $city;
            }else{
                $estite->city = null;
            }

            $region = $this->checkregion($row['region']);
            if($region){
                $estite->region = $region;
            }else{
                $estite->region = null;
            }
            $other_location = $this->checkOtherLoc($row['other_location']);
            if($other_location){
                $estite->other_loc = $other_location;
            }else{
                $estite->other_loc = null;
            }
            $houset = $this->checkHouseType($row['housingtype']);
            if($houset){
                $estite->house_type = $houset;
            }else{
                $estite->house_type = null;
            }
            $category = $this->checkCategory($row['category']);
            if($category){
                $estite->category = $category;
            }else{
                $estite->category = null;
            }
            $estite->save();
            return $estite;
        }else{
            return null;
        }
        
       return null;
    }
    public function getRightNumberFormat($number)
    {
        $s = Str::of($number)->replace(' ', '')
        ->replace('+', '')
        ->replace('-', '')->replace('(', '')->replace(')', '');
        $length  = Str::length($s);
        if($length == 9){
            $s = '+998'.$s;
        }
        if($length==12){
            $s = '+'.$s;
        }
        return $s;
    }
    public function index(Request $row)
    {
        $inside = true;
        if($row['site_id']=='1'){
            $olx_strs = explode(' +', $row['number']);
            if(count($olx_strs)==1){
                $s = $this->getRightNumberFormat($row['number']);
                if(Str::length($s)==2 || Str::length($s)!=13){
                    return response()->json([
                        'status' => false,
                    ],200);
                }
            }else{
                foreach($olx_strs as $olx_str){
                    $arr = $this->getRightNumberFormat($olx_str);
                    if(Str::length($arr)==2 || Str::length($arr)!=13){
                        return response()->json([
                            'status' => false,
                        ],200);
                    }
                    $s[] = $arr;
                }
                $s = json_encode($s);
            }
            
        }else{
            $uybor = Str::of((string)$row['number'])->replace(' +', '');
            $uybor_strs = explode('+', $uybor);
            if(count($uybor_strs)==2){
                $s = $this->getRightNumberFormat($uybor_strs[1]);
                if(Str::length($s)==2 || Str::length($s)!=13){
                    return response()->json([
                        'status' => false,
                        'error'=>'first if',
                    ],200);
                }
                
            }else{
                
                foreach($uybor_strs as $olx_str){
                    if($olx_str=='' || $olx_str==' '){
                    }else{
                        $ar = $this->getRightNumberFormat($olx_str);
                        if(Str::length($ar)==2 || Str::length($ar)!=13){
                            return response()->json([
                                'status' => false,
                                'error'=>'first else',
                            ],200);
                        }
                        $s[] = $ar;
                    }
                }
                $s = json_encode($s);
            }
        }
        
        
        if($inside){
            
            $owner = Owner::where('number',$s)->first();
            $estite = Estate::where('ad_id', $row['id'])->first();
           
            if(!$owner){
                $just_changed = false;
                if($estite){
                    if(count($estite->owner()->get())>0){
                        $owner = $estite->owner()->first();
                        $owner->number = $s;
                        if($row['name'] != $owner->name){
                            $name_added = [
                                'name' => $row['name'],
                                'site' => $row['site_id'],
                                'time' => Carbon::now(),
                            ];
                            $name_doceded= json_decode(json_encode($name_added), true);
                            $name_change[] = $name_doceded;
                            $name_change[] = $name_added;
                            $owner->name_history = json_encode($name_change);
                        }
                        $owner->save();
                        $just_changed = true;
                    }
                }
                if(!$just_changed){
                    $owner =  new Owner();
                    $owner->name = $row['name'];
                    $name_added = [
                        'name' => $row['name'],
                        'site' => $row['site_id'],
                        'time' => Carbon::now(),
                    ];
                    $name_history = json_encode($name_added);
                    $owner->name_history = $name_history;
                    $owner->number =$s;
                    $checkownertype = $this->checkOwnerType($row['announcement']);
                    if($checkownertype){
                        $owner->announcement = $checkownertype;
                    }else{
                        $owner->announcement = null;
                    }
                    $owner->save();
                }
                
            }
            if($estite){
                if($estite->owner()->where('owners.id', $owner->id)->exists()){
                    $estite = $this->checkUpdateEstite($estite, $row);
                    return response()->json([
                        'status' => true,
                        'estite'=>$estite,
                    ],200);
                    
                }else{
                    $estite->owner()->attach($owner->id);
                    return response()->json([
                        'status' => true,
                        'estite'=>$estite,
                    ],200);
                }
            }else{
                $estite = new Estate();
                $estite->ad_id = $row['id'];
                $estite->ad_site = $row['site_id'];
                $estite->num_rooms = (int)$row['num_rooms'];
                $estite->total_area = (float)$row['total_area'];
                $estite->map=$row['map'];
                if((float)$row['living_space']==0){
                    $estite->living_space = null;
                }else{
                    $estite->living_space = (float)$row['living_space'];
                }
                if((float)$row['kitchen_area']==0){
                    $estite->kitchen_area = null;
                }else{
                    $estite->kitchen_area = (float)$row['kitchen_area'];
                }
                $estite->floor = (int)$row['floor'];
                $estite->floor_house = (int)$row['floor_house'];
                if(Str::contains($row['construction_year'],'0')){
                    $estite->construction_year = null;
                }else{
                    $estite->construction_year = $row['construction_year'];
                }
                if((float)$row['ceiling_height']==0){
                    $estite->ceiling_height = null;
                }else{
                    $estite->ceiling_height = (float)$row['ceiling_height'];
                }
                $estite->url = $row['url'];
                    $apartment_has = $row['apartment_has'];
                    if(Str::startsWith($apartment_has, ',')){
                        $apartment_has = Str::substr($apartment_has, 2, Str::length($apartment_has));
                    }else{
                        $apartment_has = trim(preg_replace('/\s\s+/', ' ', $apartment_has));
                        $apartment_has = Str::of($apartment_has)->replace(' ', ', ');
                    }
                $estite->apartment_has = (string)$apartment_has; 
                    $near_has = $row['near_has'];
                    if(Str::startsWith($near_has, ',')){
                        $near_has = Str::substr($near_has, 2, Str::length($near_has));
                    }else{
                        $near_has = trim(preg_replace('/\s\s+/', ' ', $near_has));
                        $near_has = Str::of($near_has)->replace(' ', ', ');
                    }
                $estite->near_has = (string)$near_has;
                
                $checkremont = $this->checkremont($row['remont']);
                if($checkremont){
                    $estite->remont = $checkremont;
                }else{
                    $estite->remont = null;
                }
                if(Str::contains($row['building_type'],'0')){
                    $estite->building_type = null;
                }else{
                    $buildingtype = $this->checkBuildingType($row['building_type']);
                    if($buildingtype){
                        $estite->building_type = $buildingtype;
                    }else{
                        $estite->building_type = null;
                    }
                }
                if(Str::contains($row['planirovka'],'0')){
                    $estite->house_layout = null;
                }else{
                    $houseLayout = $this->checkHouseLayout($row['planirovka']);
                    if($houseLayout){
                        $estite->house_layout = $houseLayout;
                    }else{
                        $estite->house_layout = null;
                    }
                }

                
                    $title = $row['title'];
                    $title = trim(preg_replace('/\s\s+/', ' ', $title));
                    $slug = Str::slug($title, "-");
                if(Estate::where('slug', $slug)->first()){
                    $estite->slug = $slug.'-'.(string)time();
                }else{
                    $estite->slug = $slug;
                }
                $estite->title = $title;
                    $body = $row['body'];
                    $body = trim(preg_replace('/\s\s+/', ' ', $body));
                $estite->body = $body;
                $estite->img = $row['img'];
                $time = $row['created_at'];
                if(Str::startsWith($time, 'в')){
                    $time = Str::of($time)->replace('в ', '');
                    $time = $this->checkTime($time); 
                    $time_change = [
                        'time' => $time,
                    ];
                    
                    $estite->ad_update_at = json_encode($time_change); 
                }else{
                    $time_change = [
                        'time' => $time,
                    ];
                    $estite->ad_update_at = json_encode($time_change);
                }
                if(Str::contains($row['price'], 'сум')){
                    $currency_new = 'сум';
                }else{
                    $currency_new = 'у.е';
                }
                $estite->price = $this->getPrice($row['price']);
                $estite->currency = $currency_new;

                $city = $this->checkcity($row['city']);
                if($city){
                    $estite->city = $city;
                }else{
                    $estite->city = null;
                }

                $region = $this->checkregion($row['region']);
                if($region){
                    $estite->region = $region;
                }else{
                    $estite->region = null;
                }
                $other_location = $this->checkOtherLoc($row['other_location']);
                if($other_location){
                    $estite->other_loc = $other_location;
                }else{
                    $estite->other_loc = null;
                }
                $houset = $this->checkHouseType($row['housingtype']);
                if($houset){
                    $estite->house_type = $houset;
                }else{
                    $estite->house_type = null;
                }
                $category = $this->checkCategory($row['category']);
                if($category){
                    $estite->category = $category;
                }else{
                    $estite->category = null;
                }
                
                if($estite->save()){
                    if(Str::contains($row['price'], 'сум')){
                        $currency = 'сум';
                    }else{
                        $currency = 'у.е';
                    }
                    $price_new = new Price();
                    $price_new->estate_id= $estite->id;
                    $price_new->price = $this->getPrice($row['price']);
                    $price_new->currency = $currency;
                    $price_new->updated_at = Str::of($time)->replace('"','');
                    $price_new->save();
                    if(!$estite->owner()->where('owners.id', $owner->id)->exists()){
                        $estite->owner()->attach($owner);
                    } 
                    return response()->json([
                        'status' => true,
                        'estite'=>$estite,
                    ],200);
                }else{
                    return response()->json([
                        'status' => false,
                    ],200);
                }  
            }
        }else{
            return response()->json([
                'status' => false,
            ]);
        }




        
        
        
    }

    public function getRandomParsingPage($id)
    {
    	
        $parsingPage = ParsingPage::where('site_id',$id)->where('status', 1)->orderby('id','asc')->first();
    	// $parsingPage = ParsingPage::where('id',21)->get();
        if($parsingPage){
            $city = $parsingPage->city;
            $category = $parsingPage->category;
            $housingtype = $parsingPage->housingtype;
            $url = $parsingPage->url;
            $region = $parsingPage->region;
            $status = true;

            $parsingPage->status = 2;
            $parsingPage->save();
            return response()->json([
                'status'=>$status,
                'city' => $city,
                'category'=>$category,
                'url' =>$url,
                'region'=>$region,
                'housingtype'=>$housingtype,
            ],200);
        }else{
            $parsingPage = ParsingPage::where('site_id',$id)->where('status', 2)->orderby('id','asc')->get();
            if(count($parsingPage)>0){
                $firchange = false;
                foreach($parsingPage as $k=>$parsingP){
                    if($k==0){
                        $firchange = $parsingP;
                    }
                    $parsingP->status = 1;
                    $parsingP->save();
                }
                if($firchange){
                    $city = $firchange->city;
                    $category = $firchange->category;
                    $housingtype = $firchange->housingtype;
                    $url = $firchange->url;
                    $region = $firchange->region;
                    $status = true;

                    $firchange->status = 2;
                    $firchange->save();
                    return response()->json([
                        'status'=>$status,
                        'city' => $city,
                        'category'=>$category,
                        'url' =>$url,
                        'region'=>$region,
                        'housingtype'=>$housingtype,
                    ],200);
                }else{
                    return response()->json([
                        'status'=>false,
                    ],200);
                }
                
            }else{
                return response()->json([
                    'status'=>false,
                ],200);
            }
            
           
        }
       return response()->json([
            'status'=>false,
        ],200);
    }

    public function showing()
    {
        

        $selected_city = request()->selected_city;
        $area_from = request()->area_from;
        $area_to = request()->area_to;
        $type = request()->type;
        $house_type = request()->house_type;
        $room = request()->room;
        $floor = request()->floor;
        $remont_id = request()->remont_id;
        $currency = request()->currency;
        $latest = request()->latest;
        $itemsorder = request()->itemsorder;
        
        $estate = Estate::where('status', 1)->when($selected_city, function ($query, $selected_city) {
                if((int)$selected_city==0){
                    return $query->where('city', 1);
                }elseif((int)$selected_city==1600){
                    return $query->where('city', 2);
                }else{
                    return $query->where('region', (int)$selected_city);
                }
           
        })
        ->when($area_from, function ($query, $area_from) {
            return $query->where('total_area','>', (int)$area_from);
        })
        ->when($area_to, function ($query,  $area_to) {
            return $query->where('total_area','<', (int)$area_to);
        })
        ->when($type, function ($query,  $type) {
            return $query->where('category', (int)$type);
        })
        ->when($house_type, function ($query,  $house_type) {
            return $query->where('house_type', (int)$house_type);
        })
        ->when($room, function ($query,  $room) {
            if((int)$room == 5){
                return $query->where('num_rooms', '>',4);
            }else{
                return $query->where('num_rooms', (int)$room);
            }
        })
        ->when($floor, function ($query, $floor) {
            return $query->where('floor', (int)$floor);
        })
        ->when($remont_id, function ($query, $remont_id) {
            if((int)$remont_id!=0){
                return $query->where('remont', (int)$remont_id);
            }
        })
        ->when($currency==1, function ($query) {
            
            $converted_from = (int)request()->price_sum_from * 10400;
            $converted_to = (int)request()->price_sum_to * 10400;
                return $query->where('currency','!=','сум' )->where('price', '>', (int)request()->price_sum_from)
                ->where('price', '<',(int)request()->price_sum_to)->orWhere(function($query) use ($converted_from, $converted_to) {
                    $query->where('currency','сум' )->where('price', '>', $converted_from)
                          ->where('price', '<', $converted_to);
                });
            
        })
        ->when($currency==2, function ($query) {
            $converted_from = (int)request()->price_sum_y_from / 10400;
            $converted_to = (int)request()->price_sum_y_to / 10400;
                return $query->where('currency','сум' )->where('price', '>', (int)request()->price_sum_from)
                ->where('price', '<', (int)request()->price_sum_to)->orWhere(function($query) use ($converted_from, $converted_to) {
                    $query->where('currency','!=','сум' )->where('price', '>', $converted_from)
                          ->where('price', '<', $converted_to);
                });
            
        })
        ->when($latest, function ($query, $latest) {
            
            if((int)$latest==1){
                $date = \Carbon\Carbon::today()->subDays(7);
                return $query->where('updated_at','>=',$date);
            }elseif((int)$latest==2){
                $date = \Carbon\Carbon::today()->subDays(14);
                return $query->where('updated_at','>=',$date);
            }
            elseif((int)$latest==3){
                $date = \Carbon\Carbon::today()->subDays(25);
                return $query->where('updated_at','>=',$date);
            }
            elseif((int)$latest==4){
                $date = \Carbon\Carbon::today()->subMonth();
                return $query->where('updated_at','>=',$date);
            }
        }, function ($query) {
            
                $date = \Carbon\Carbon::today()->subDays(7);
                return $query->where('updated_at','>=',$date);
           
        })
        ->when($itemsorder, function ($query, $itemsorder) {
            if((int)$itemsorder==1){
                return $query->orderby('updated_at', 'desc');
            }elseif((int)$itemsorder==2){
                return $query->orderby('updated_at', 'asc');
            }elseif((int)$itemsorder==3){
                
            }elseif((int)$itemsorder==4){
                
            }
            
        }, function ($query) {
            return $query->orderby('updated_at', 'desc');
        })
        ->paginate(30);
        
        
        foreach($estate as $es){
            $es['i'] =$es->owner()->first();
            
                $price = Price::where('estate_id',$es->id)->where('price', $es->price)->first();
                if($price){
                    $es['price'] = $price->price;
                    $es['price_cur'] = $price->currency;
                }else{
                    $es['price'] = $price->price;
                    $es['price_cur'] = 'у.е';
                }
                
            $c = count(Price::where('estate_id',$es->id)->get());
            if($c>1){
                $es['count_price'] = $c;
            }
            
            // $es['price'] = json_decode($es->price)->price;
            if($es->getHouseType()->name == 'Вторичный рынок'){
                $es['housingtype'] = 'вр';
            }elseif($es->getHouseType()->name == 'Новостройки'){
                $es['housingtype'] = 'нв';
            }
            // $es['remont'] = ' ';
            if($es->getRemont()){
                $es['remont'] = $es->getRemont()->name;
            }
           
            if($es->getCity()){
                
                $es['city'] = $es->getCity()->name;
            }
            if($es->getRegion()){
                $es['region'] = $es->getRegion()->name;
            }
            $es['update_time'] = Carbon::parse($es->updated_at)->locale('ru_RU')->diffForHumans();
            $es['created_time'] = Carbon::parse($es->created_at)->locale('ru_RU')->diffForHumans();
        }
        
        return response()->json([
            'status' => true,
            'estate' =>$estate,
        ]);
    }
    
  
    public function showingEstate($slug)
    {
       
        $estate = Estate::where('slug',$slug)->first();
        // dd($estate);
        // dd(Price::where('estate_id', $estate->id)->get());
        if($estate->getCity()){
            $estate['city'] = $estate->getCity()->name;
        }
        if($estate->getRegion()){
            $estate['region'] = $estate->getRegion()->name;
        }
       
        // dd($items);
        // dd($items['currency']);
        // dd(last($items));
        // dd(count($items));
        $estate['update_time'] = Carbon::parse($estate->updated_at)->locale('ru_RU')->isoFormat('LLLL'); 
        $price = Price::where('estate_id',$estate->id)->where('price', $estate->price)->first();
        if($price){
            $estate['price'] = $price->price;
            $estate['price_cur'] = $price->currency;
        }else{
            $estate['price'] = $price->price;
            $estate['price_cur'] = 'у.е';
        }
        $map = explode(',', Str::of($estate->map)->replace('{','')->replace('}','')->replace(' ',''));
        $lat = Str::of(explode(':', $map[0])[1])->replace("'","");
        $lon = Str::of(explode(':', $map[1])[1])->replace("'","");
       
        $d= 'https://www.google.com/maps/embed/v1/place?q='.$lat.','.$lon.'&key=AIzaSyC63KzZYIxs4DNt5X_Avua9a_HgSyyVXMw&language=ru';
        $estate['map']=$d;
        if(Str::contains($estate->img, 'https')){
            $estate['imgs']= explode(",", Str::of($estate->img)->replace('[', '')->replace(']', '')->replace("'", '')->replace(' ','')); 
        }
        $estate['owner'] = $estate->owner()->first();
        if($estate->owner()->first() && count($estate->owner()->first()->estates()->where('estates.id','!=',$estate->id )->get())>0){
            
            $estate['owner_estates'] = $estate->owner()->first()->estates()->where('estates.id','!=',$estate->id )->get();
            foreach($estate['owner_estates'] as $own){
                if($own->getCity()){
                    $own['city'] = $own->getCity()->name;
                }
                if($own->getRegion()){
                    $own['region'] = $own->getRegion()->name;
                }
                $own['update_time'] = Carbon::parse($own->updated_at)->locale('ru_RU')->isoFormat('LLLL'); 
                $price_own = Price::where('estate_id',$own->id)->where('price', $own->price)->first();
                if($price_own){
                    $own['price'] = $price_own->price;
                    $own['price_cur'] = $price_own->currency;
                }else{
                    $own['price'] = $own->price;
                    $own['price_cur'] = 'у.е';
                }

                // $items_own =json_decode($own->price, true); 
                // if(count($items_own)>3){
                //     $own['price'] = last($items_own)['price'];
                //     $own['price_cur'] = last($items_own)['currency'];
                // }else{
                //     $own['price_cur'] = $items_own['currency'];
                //     $own['price'] = $items_own['price'];
                // }
                
            }
        }
        
        $estate['announcement'] =null;
        $estate['apartment_has'] =''.Str::of($estate->apartment_has)->replace(', ','<br>')->replace("\n", "<br>");
        $estate['near_has'] =''.Str::of($estate->near_has)->replace('Средняя', '<br>Средняя')->replace("\n", "<br>")->replace(",", "<br>");
        $estate['body'] =''.Str::of($estate->body)->replace('- показать телефон -', '');

        
        if($estate->owner()->first()){
            $estate['announcement'] = $estate->owner()->first()->type()->first();
        }
        
       
        
        
       
        
        if($estate){
            return response()->json([
                'status' => true,
                'estate' =>$estate,
            ]);
        }else{
            return response()->json([
                'status' => false,
                'estate' =>$estate,
            ]);
        }
    }
}
