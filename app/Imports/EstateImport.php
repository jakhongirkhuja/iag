<?php

namespace App\Imports;

use App\Models\Estate;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Str;
use App\Models\Owner;
use App\Models\Remont;
use App\Models\BuildingType;
use App\Models\Category;
use App\Models\HouseLayout;
use App\Models\City;
use App\Models\Region;
use App\Models\OtherLoc;
use Illuminate\Support\Arr;
use App\Models\HouseType;
use App\Models\OwnerType;
use Carbon\Carbon;

class EstateImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    protected $site_name_id;
    public function __construct($site_name_id)
    {
        $this->site_name_id = $site_name_id;
    }
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
    public function getPrice($price, $time)
    {
        if(Str::contains($price, 'сум')){
            $currency = 'сум';
        }else{
            $currency = 'у.е';
        }
        $price = (string)Str::of($price)->replace(' ', '');
        
        $json_price = [
            'price' => (int)$price,
            'time' => $time,
            'currency'=>$currency
        ];
       
        return json_encode($json_price);
    }
    public function CheckUpdatePrice($oldprice, $price, $time)
    {
        $time_change = json_decode($oldprice, true);
        
        if(count($time_change)==3){
            $ok =  end($time_change);
        }else{
            $ok =end($time_change)['time'];
        }
        
        if($ok != $time){
            
            if(Str::contains($price, 'сум')){
                $currency = 'сум';
            }else{
                $currency = 'у.е';
            }
            $price = (string)Str::of($price)->replace(' ', '');
            $time_changed = [
                'price' => (int)$price,
                'time' => $time,
                'currency'=>$currency
            ];
            $doceded= json_decode(json_encode($time_changed), true);
            
            $time_change[] = $doceded;
            
            $overall = json_encode($time_change);
        } 
        return $overall;
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
            $estite->price = $this->CheckUpdatePrice($estite->price,$row['price'], $time);
            $estite->num_rooms = (int)$row['num_rooms'];
            $estite->total_area = (float)$row['total_area'];
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
            $estite->map=$row['map'];
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
    public function model(array $row)
    {
        $inside = true;
        if($this->site_name_id==1){
            $olx_strs = explode(' +', $row['number']);
            if(count($olx_strs)==1){
                $s = $this->getRightNumberFormat($row['number']);
                if(Str::length($s)==2 || Str::length($s)!=13){
                    $inside = false;
                }
            }else{
                foreach($olx_strs as $olx_str){
                    $arr = $this->getRightNumberFormat($olx_str);
                    if(Str::length($arr)==2 || Str::length($arr)!=13){
                        $inside = false;
                    }
                    $s[] = $arr;
                }
                $s = json_encode($s);
            }
            
        }else{
            $uybor = Str::of($row['number'])->replace(' +', '');
            $uybor_strs = explode('+', $uybor);
            
            if(count($uybor_strs)==1){
                $s = $this->getRightNumberFormat($uybor);
                if(Str::length($s)==2 || Str::length($s)!=13){
                    $inside = false;
                }
                
            }else{
                foreach($uybor_strs as $olx_str){
                    $ar = $this->getRightNumberFormat($olx_str);
                    if(Str::length($ar)==2 || Str::length($ar)!=13){
                        $inside = false;
                    }
                    $s[] = $ar;
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
                    return $this->checkUpdateEstite($estite, $row);
                    return null;
                }else{
                    $estite->owner()->attach($owner->id);
                    return $estite;
                }
            }else{
                $estite = new Estate();
                $estite->ad_id = $row['id'];
                $estite->ad_site = $this->site_name_id;
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
                $estite->price = $this->getPrice($row['price'], $time);

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
                    if(!$estite->owner()->where('owners.id', $owner->id)->exists()){
                        $estite->owner()->attach($owner);
                    } 
                    return $estite;
                }else{
                    return null;
                }  
            }
        }else{
            return null;
        }




        
        
        
    }
}
