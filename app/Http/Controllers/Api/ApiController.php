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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class ApiController extends Controller
{
    public function checkBuildingType($name)
    {
        $builtingtype = BuildingType::where('name', $name)->first();
        if ($builtingtype) {
            return $builtingtype->id;
        } else {
            $names = trim(preg_replace('/\s\s+/', ' ', $name));
            $names = Str::of($names)->replace(' ', '');
            if ($names == '') {
                return null;
            }
            $builtingtype = new BuildingType();
            $builtingtype->name = $name;
            if ($builtingtype->save()) {
                return $builtingtype->id;
            } else {
                return false;
            }
        }
    }
    public function checkHouseLayout($name)
    {
        $houseLayout = HouseLayout::where('name', $name)->first();
        if ($houseLayout) {
            return $houseLayout->id;
        } else {
            $names = trim(preg_replace('/\s\s+/', ' ', $name));
            $names = Str::of($names)->replace(' ', '');
            if ($names == '') {
                return null;
            }
            $houseLayout = new HouseLayout();
            $houseLayout->name = $name;
            if ($houseLayout->save()) {
                return $houseLayout->id;
            } else {
                return false;
            }
        }
    }
    public function checkHouseType($name)
    {
        $houseType = HouseType::where('name', $name)->first();
        if ($houseType) {
            return $houseType->id;
        } else {
            $names = trim(preg_replace('/\s\s+/', ' ', $name));
            $names = Str::of($names)->replace(' ', '');
            if ($names == '') {
                return null;
            }
            $houseType = new HouseType();
            $houseType->name = $name;
            if ($houseType->save()) {
                return $houseType->id;
            } else {
                return false;
            }
        }
    }
    public function checkCategory($name)
    {
        $category = Category::where('name', $name)->first();
        if ($category) {
            return $category->id;
        } else {
            $names = trim(preg_replace('/\s\s+/', ' ', $name));
            $names = Str::of($names)->replace(' ', '');
            if ($names == '') {
                return null;
            }
            $category = new Category();
            $category->name = $name;
            if ($category->save()) {
                return $category->id;
            } else {
                return false;
            }
        }
    }
    public function checkremont($name)
    {
        $remont = Remont::where('name', $name)->first();
        if ($remont) {
            return $remont->id;
        } else {
            $names = trim(preg_replace('/\s\s+/', ' ', $name));
            $names = Str::of($names)->replace(' ', '');
            if ($names == '') {
                return null;
            }
            $remont = new Remont();
            $remont->name = $name;
            if ($remont->save()) {
                return $remont->id;
            } else {
                return false;
            }
        }
    }
    public function checkcity($name)
    {
        $city = City::where('name', $name)->first();
        if ($city) {
            return $city->id;
        } else {
            $names = trim(preg_replace('/\s\s+/', ' ', $name));
            $names = Str::of($names)->replace(' ', '');
            if ($names == '') {
                return null;
            }
            $city = new City();
            $city->name = $name;
            if ($city->save()) {
                return $city->id;
            } else {
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
        $region = Region::where('name', $name)->first();
        if ($region) {
            return $region->id;
        } else {
            $names = trim(preg_replace('/\s\s+/', ' ', $name));
            $names = Str::of($names)->replace(' ', '');
            if ($names == '') {
                return null;
            }
            $region = new Region();
            $region->name = $name;
            if ($region->save()) {
                return $region->id;
            } else {
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
        $ownertype = OwnerType::where('name', $name)->first();
        if ($ownertype) {
            return $ownertype->id;
        } else {
            $names = trim(preg_replace('/\s\s+/', ' ', $name));
            $names = Str::of($names)->replace(' ', '');
            if ($names == '') {
                return null;
            }
            $ownertype = new OwnerType();
            $ownertype->name = $name;
            if ($ownertype->save()) {
                return $ownertype->id;
            } else {
                return false;
            }
        }
    }
    public function checkOtherLoc($name)
    {
        $otherloc = OtherLoc::where('name', $name)->first();
        if ($otherloc) {
            return $otherloc->id;
        } else {
            $names = trim(preg_replace('/\s\s+/', ' ', $name));
            $names = Str::of($names)->replace(' ', '');
            if ($names == '') {
                return null;
            }
            $otherloc = new OtherLoc();
            $otherloc->name = $name;
            if ($otherloc->save()) {
                return $otherloc->id;
            } else {
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
        $check_price = Price::where('estate_id', $estate_id)->where('price', (int)$price_notchanged)->first();
        if (!$check_price) {
            if (Str::contains($price, 'сум')) {
                $currency = 'сум';
            } else {
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
        if (Str::contains($time, 'августа')) {
            $time = Str::of($time)->replace('августа', '08');
        } elseif (Str::contains($time, 'сентября')) {
            $time = Str::of($time)->replace('сентября', '09');
        } elseif (Str::contains($time, 'октября')) {
            $time = Str::of($time)->replace('октября', '10');
        } elseif (Str::contains($time, 'ноября')) {
            $time = Str::of($time)->replace('ноября', '11');
        } elseif (Str::contains($time, 'декабря')) {
            $time = Str::of($time)->replace('декабря', '12');
        } elseif (Str::contains($time, 'января')) {
            $time = Str::of($time)->replace('января', '01');
        } elseif (Str::contains($time, 'февраля')) {
            $time = Str::of($time)->replace('февраля', '02');
        } elseif (Str::contains($time, 'марта')) {
            $time = Str::of($time)->replace('марта', '03');
        } elseif (Str::contains($time, 'апреля')) {
            $time = Str::of($time)->replace('апреля', '04');
        } elseif (Str::contains($time, 'мая')) {
            $time = Str::of($time)->replace('мая', '05');
        } elseif (Str::contains($time, 'июня')) {
            $time = Str::of($time)->replace('июня', '06');
        } elseif (Str::contains($time, 'июля')) {
            $time = Str::of($time)->replace('июля', '07');
        }
        $time = \Carbon\Carbon::createFromFormat('H:i, d m Y', $time)->format('"Y-m-d H:i:s"');
        return $time;
    }
    public function checkUpdateEstite($estite, $row)
    {
        $time = $row['created_at'];
        $changedsmth = false;

        if (Str::startsWith($time, 'в')) {

            //olx time
            $time = Str::of($time)->replace('в ', '');
            $time = $this->checkTime($time);

            $time_change = json_decode($estite->ad_update_at, true);

            if (count($time_change) == 1) {
                $ok =  end($time_change);
            } else {
                $ok = end($time_change)['time'];
            }
            if ($ok != $time) {
                $time_changed = [
                    'time' => $time,
                ];
                $doceded = json_decode(json_encode($time_changed), true);
                $time_change[] = $doceded;

                $overall = json_encode($time_change);
                $changedsmth = true;
                $estite->ad_update_at = $overall;
            }
        } else {
            //uybor time

            $time_change = json_decode($estite->ad_update_at, true);
            if (count($time_change) == 1) {
                $ok =  end($time_change);
            } else {
                $ok = end($time_change)['time'];
            }
            if ($ok != $time) {
                $time_changed = [
                    'time' => $time,
                ];
                $doceded = json_decode(json_encode($time_changed), true);

                $time_change[] = $doceded;

                $overall = json_encode($time_change);
                $changedsmth = true;
                $estite->ad_update_at = $overall;
            }
        }
        if ($changedsmth) {
            $estite->price = $this->CheckUpdatePrice($estite->id, $row['price'], $time);
            if (Str::contains($row['price'], 'сум')) {
                $currency_new = 'сум';
            } else {
                $currency_new = 'у.е';
            }
            $estite->currency = $currency_new;
            $estite->num_rooms = (int)$row['num_rooms'];
            $estite->total_area = (float)$row['total_area'];
            $estite->map = $row['map'];
            if ((float)$row['living_space'] == 0) {
                $estite->living_space = null;
            } else {
                $estite->living_space = (float)$row['living_space'];
            }
            if ((float)$row['kitchen_area'] == 0) {
                $estite->kitchen_area = null;
            } else {
                $estite->kitchen_area = (float)$row['kitchen_area'];
            }
            $estite->floor = (int)$row['floor'];
            $estite->floor_house = (int)$row['floor_house'];
            if (Str::contains($row['construction_year'], '0')) {
                $estite->construction_year = null;
            } else {
                $estite->construction_year = $row['construction_year'];
            }
            if ((float)$row['ceiling_height'] == 0) {
                $estite->ceiling_height = null;
            } else {
                $estite->ceiling_height = (float)$row['ceiling_height'];
            }
            $estite->url = $row['url'];
            $apartment_has = $row['apartment_has'];
            if (Str::startsWith($apartment_has, ',')) {
                $apartment_has = Str::substr($apartment_has, 2, Str::length($apartment_has));
            } else {
                $apartment_has = trim(preg_replace('/\s\s+/', ' ', $apartment_has));
                $apartment_has = Str::of($apartment_has)->replace(' ', ', ');
            }
            $estite->apartment_has = (string)$apartment_has;
            $near_has = $row['near_has'];
            if (Str::startsWith($near_has, ',')) {
                $near_has = Str::substr($near_has, 2, Str::length($near_has));
            } else {
                $near_has = trim(preg_replace('/\s\s+/', ' ', $near_has));
                $near_has = Str::of($near_has)->replace(' ', ', ');
            }
            $estite->near_has = (string)$near_has;

            $checkremont = $this->checkremont($row['remont']);
            if ($checkremont) {
                $estite->remont = $checkremont;
            } else {
                $estite->remont = null;
            }
            if (Str::contains($row['building_type'], '0')) {
                $estite->building_type = null;
            } else {
                $buildingtype = $this->checkBuildingType($row['building_type']);
                if ($buildingtype) {
                    $estite->building_type = $buildingtype;
                } else {
                    $estite->building_type = null;
                }
            }
            if (Str::contains($row['planirovka'], '0')) {
                $estite->house_layout = null;
            } else {
                $houseLayout = $this->checkHouseLayout($row['planirovka']);
                if ($houseLayout) {
                    $estite->house_layout = $houseLayout;
                } else {
                    $estite->house_layout = null;
                }
            }


            $title = $row['title'];
            $title = trim(preg_replace('/\s\s+/', ' ', $title));
            $slug = Str::slug($title, "-");
            if (Estate::where('slug', $slug)->first()) {
                $estite->slug = $slug . '-' . (string)time();
            } else {
                $estite->slug = $slug;
            }
            $estite->title = $title;
            $body = $row['body'];
            $body = trim(preg_replace('/\s\s+/', ' ', $body));
            $estite->body = $body;
            $estite->img = $row['img'];


            $city = $this->checkcity($row['city']);
            if ($city) {
                $estite->city = $city;
            } else {
                $estite->city = null;
            }

            $region = $this->checkregion($row['region']);
            if ($region) {
                $estite->region = $region;
            } else {
                $estite->region = null;
            }
            $other_location = $this->checkOtherLoc($row['other_location']);
            if ($other_location) {
                $estite->other_loc = $other_location;
            } else {
                $estite->other_loc = null;
            }
            $houset = $this->checkHouseType($row['housingtype']);
            if ($houset) {
                $estite->house_type = $houset;
            } else {
                $estite->house_type = null;
            }
            $category = $this->checkCategory($row['category']);
            if ($category) {
                $estite->category = $category;
            } else {
                $estite->category = null;
            }
            $estite->status = 1;
            $estite->save();
            return $estite;
        } else {
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
        if ($length == 9) {
            $s = '+998' . $s;
        }
        if ($length == 12) {
            $s = '+' . $s;
        }
        return $s;
    }
    public function index(Request $row)
    {
        $inside = true;
        if ($row['site_id'] == '1') {
            $olx_strs = explode(' +', $row['number']);
            if (count($olx_strs) == 1) {
                $s = $this->getRightNumberFormat($row['number']);
                if (Str::length($s) == 2 || Str::length($s) != 13) {
                    return response()->json([
                        'status' => false,
                    ], 200);
                }
            } else {
                foreach ($olx_strs as $olx_str) {
                    $arr = $this->getRightNumberFormat($olx_str);
                    if (Str::length($arr) == 2 || Str::length($arr) != 13) {
                        return response()->json([
                            'status' => false,
                        ], 200);
                    }
                    $s[] = $arr;
                }
                $s = json_encode($s);
            }
        } else {
            $uybor = Str::of((string)$row['number'])->replace(' +', '');
            $uybor_strs = explode('+', $uybor);
            if (count($uybor_strs) == 2) {
                $s = $this->getRightNumberFormat($uybor_strs[1]);
                if (Str::length($s) == 2 || Str::length($s) != 13) {
                    return response()->json([
                        'status' => false,
                        'error' => 'first if',
                    ], 200);
                }
            } else {

                foreach ($uybor_strs as $olx_str) {
                    if ($olx_str == '' || $olx_str == ' ') {
                    } else {
                        $ar = $this->getRightNumberFormat($olx_str);
                        if (Str::length($ar) == 2 || Str::length($ar) != 13) {
                            return response()->json([
                                'status' => false,
                                'error' => 'first else',
                            ], 200);
                        }
                        $s[] = $ar;
                    }
                }
                $s = json_encode($s);
            }
        }


        if ($inside) {

            $owner = Owner::where('number', $s)->first();
            $estite = Estate::where('ad_id', $row['id'])->first();
            $announcement = '';
            if($owner){
                $announcement  = $owner->announcement;
            }
            if (!$owner) {
                $just_changed = false;
                if ($estite) {
                    if (count($estite->owner()->get()) > 0) {
                        $owner = $estite->owner()->first();
                        $owner->number = $s;
                        if ($row['name'] != $owner->name) {
                            $name_added = [
                                'name' => $row['name'],
                                'site' => $row['site_id'],
                                'time' => Carbon::now(),
                            ];
                            $name_doceded = json_decode(json_encode($name_added), true);
                            $name_change[] = $name_doceded;
                            $name_change[] = $name_added;
                            $owner->name_history = json_encode($name_change);
                        }
                        $announcement =  $owner->announcement;
                        $owner->save();
                        $just_changed = true;
                    }
                }
                if (!$just_changed) {
                    $owner =  new Owner();
                    $owner->name = $row['name'];
                    $name_added = [
                        'name' => $row['name'],
                        'site' => $row['site_id'],
                        'time' => Carbon::now(),
                    ];
                    $name_history = json_encode($name_added);
                    $owner->name_history = $name_history;
                    $owner->number = $s;
                    $checkownertype = $this->checkOwnerType($row['announcement']);
                    if ($checkownertype) {
                        $owner->announcement = $checkownertype;
                    } else {
                        $owner->announcement = null;
                    }
                    $announcement = $checkownertype;
                    $owner->save();
                }
            }
            if ($estite) {
                if ($estite->owner()->where('owners.id', $owner->id)->exists()) {
                    $estite = $this->checkUpdateEstite($estite, $row);
                    return response()->json([
                        'status' => true,
                        'estite' => $estite,
                    ], 200);
                } else {
                    $estite->owner()->attach($owner->id);
                    return response()->json([
                        'status' => true,
                        'estite' => $estite,
                    ], 200);
                }
            } else {
                $estite = new Estate();
                $estite->ad_id = $row['id'];
                $estite->ad_site = $row['site_id'];
                $estite->num_rooms = (int)$row['num_rooms'];
                $estite->total_area = (float)$row['total_area'];
                $estite->map = $row['map'];
                if ((float)$row['living_space'] == 0) {
                    $estite->living_space = null;
                } else {
                    $estite->living_space = (float)$row['living_space'];
                }
                if ((float)$row['kitchen_area'] == 0) {
                    $estite->kitchen_area = null;
                } else {
                    $estite->kitchen_area = (float)$row['kitchen_area'];
                }
                $estite->floor = (int)$row['floor'];
                $estite->floor_house = (int)$row['floor_house'];
                if (Str::contains($row['construction_year'], '0')) {
                    $estite->construction_year = null;
                } else {
                    $estite->construction_year = $row['construction_year'];
                }
                if ((float)$row['ceiling_height'] == 0) {
                    $estite->ceiling_height = null;
                } else {
                    $estite->ceiling_height = (float)$row['ceiling_height'];
                }
                $estite->url = $row['url'];
                $apartment_has = $row['apartment_has'];
                if (Str::startsWith($apartment_has, ',')) {
                    $apartment_has = Str::substr($apartment_has, 2, Str::length($apartment_has));
                } else {
                    $apartment_has = trim(preg_replace('/\s\s+/', ' ', $apartment_has));
                    $apartment_has = Str::of($apartment_has)->replace(' ', ', ');
                }
                $estite->apartment_has = (string)$apartment_has;
                $near_has = $row['near_has'];
                if (Str::startsWith($near_has, ',')) {
                    $near_has = Str::substr($near_has, 2, Str::length($near_has));
                } else {
                    $near_has = trim(preg_replace('/\s\s+/', ' ', $near_has));
                    $near_has = Str::of($near_has)->replace(' ', ', ');
                }
                $estite->near_has = (string)$near_has;

                $checkremont = $this->checkremont($row['remont']);
                if ($checkremont) {
                    $estite->remont = $checkremont;
                } else {
                    $estite->remont = null;
                }
                if (Str::contains($row['building_type'], '0')) {
                    $estite->building_type = null;
                } else {
                    $buildingtype = $this->checkBuildingType($row['building_type']);
                    if ($buildingtype) {
                        $estite->building_type = $buildingtype;
                    } else {
                        $estite->building_type = null;
                    }
                }
                if (Str::contains($row['planirovka'], '0')) {
                    $estite->house_layout = null;
                } else {
                    $houseLayout = $this->checkHouseLayout($row['planirovka']);
                    if ($houseLayout) {
                        $estite->house_layout = $houseLayout;
                    } else {
                        $estite->house_layout = null;
                    }
                }
                

                $title = $row['title'];
                $title = trim(preg_replace('/\s\s+/', ' ', $title));
                $slug = Str::slug($title, "-");
                if (Estate::where('slug', $slug)->first()) {
                    $estite->slug = $slug . '-' . (string)time();
                } else {
                    $estite->slug = $slug;
                }
                $estite->title = $title;
                $body = $row['body'];
                $body = trim(preg_replace('/\s\s+/', ' ', $body));
                $estite->body = $body;
                $estite->img = $row['img'];
                $time = $row['created_at'];
                if (Str::startsWith($time, 'в')) {
                    $time = Str::of($time)->replace('в ', '');
                    $time = $this->checkTime($time);
                    $time_change = [
                        'time' => $time,
                    ];

                    $estite->ad_update_at = json_encode($time_change);
                } else {
                    $time_change = [
                        'time' => $time,
                    ];
                    $estite->ad_update_at = json_encode($time_change);
                }
                if (Str::contains($row['price'], 'сум')) {
                    $currency_new = 'сум';
                } else {
                    $currency_new = 'у.е';
                }
                $estite->price = $this->getPrice($row['price']);
                $estite->currency = $currency_new;

                $city = $this->checkcity($row['city']);
                if ($city) {
                    $estite->city = $city;
                } else {
                    $estite->city = null;
                }

                $region = $this->checkregion($row['region']);
                if ($region) {
                    $estite->region = $region;
                } else {
                    $estite->region = null;
                }
                $other_location = $this->checkOtherLoc($row['other_location']);
                if ($other_location) {
                    $estite->other_loc = $other_location;
                } else {
                    $estite->other_loc = null;
                }
                $houset = $this->checkHouseType($row['housingtype']);
                if ($houset) {
                    $estite->house_type = $houset;
                } else {
                    $estite->house_type = null;
                }
                $category = $this->checkCategory($row['category']);
                if ($category) {
                    $estite->category = $category;
                } else {
                    $estite->category = null;
                }
                $estite->announcement = (int)$announcement;
                if ($estite->save()) {
                    if (Str::contains($row['price'], 'сум')) {
                        $currency = 'сум';
                    } else {
                        $currency = 'у.е';
                    }
                    $price_new = new Price();
                    $price_new->estate_id = $estite->id;
                    $price_new->price = $this->getPrice($row['price']);
                    $price_new->currency = $currency;
                    $price_new->updated_at = Str::of($time)->replace('"', '');
                    $price_new->save();
                    if (!$estite->owner()->where('owners.id', $owner->id)->exists()) {
                        $estite->owner()->attach($owner);
                    }
                    return response()->json([
                        'status' => true,
                        'estite' => $estite,
                    ], 200);
                } else {
                    return response()->json([
                        'status' => false,
                    ], 200);
                }
            }
        } else {
            return response()->json([
                'status' => false,
            ]);
        }
    }

    public function getRandomParsingPage($id)
    {

        $parsingPage = ParsingPage::where('site_id', $id)->where('status', 1)->orderby('id', 'asc')->first();
        // $parsingPage = ParsingPage::where('id',21)->get();
        if ($parsingPage) {
            $city = $parsingPage->city;
            $category = $parsingPage->category;
            $housingtype = $parsingPage->housingtype;
            $url = $parsingPage->url;
            $region = $parsingPage->region;
            $status = true;

            $parsingPage->status = 2;
            $parsingPage->save();
            return response()->json([
                'status' => $status,
                'city' => $city,
                'category' => $category,
                'url' => $url,
                'region' => $region,
                'housingtype' => $housingtype,
            ], 200);
        } else {
            $parsingPage = ParsingPage::where('site_id', $id)->where('status', 2)->orderby('id', 'asc')->get();
            if (count($parsingPage) > 0) {
                $firchange = false;
                foreach ($parsingPage as $k => $parsingP) {
                    if ($k == 0) {
                        $firchange = $parsingP;
                    }
                    $parsingP->status = 1;
                    $parsingP->save();
                }
                if ($firchange) {
                    $city = $firchange->city;
                    $category = $firchange->category;
                    $housingtype = $firchange->housingtype;
                    $url = $firchange->url;
                    $region = $firchange->region;
                    $status = true;

                    $firchange->status = 2;
                    $firchange->save();
                    return response()->json([
                        'status' => $status,
                        'city' => $city,
                        'category' => $category,
                        'url' => $url,
                        'region' => $region,
                        'housingtype' => $housingtype,
                    ], 200);
                } else {
                    return response()->json([
                        'status' => false,
                    ], 200);
                }
            } else {
                return response()->json([
                    'status' => false,
                ], 200);
            }
        }
        return response()->json([
            'status' => false,
        ], 200);
    }

    public function showing()
    {


        $selected_city = request()->selected_city;
        if ($selected_city != null) {
            $selected_city_exist = true;
        } else {
            $selected_city_exist = false;
        }
        $area_from = request()->area_from;
        $area_to = request()->area_to;
        $type = request()->type;
        $house_type = request()->house_type;
        $room = request()->room;
        $floor_from = request()->floor_from;
        $floor_to = request()->floor_to;
        $floor_c_from = request()->floor_c_from;
        $floor_c_to = request()->floor_c_to;
        $remont_id = request()->remont_id;
        $currency = request()->currency;
        $latest = request()->latest;
        $itemsorder = request()->itemsorder;
        $price_from = request()->price_from;
        $price_to = request()->price_to;
        $buildingType = request()->buildingType;
        $photo_exist = request()->photo_exist;
        $owner_type = request()->owner_type;
        $owner_arr = '';
       
        if($owner_type!=null){
            if(Str::contains($owner_type, '1')){
                $owner_type.=',4';
               
            }
            $owner_arr = explode(',',$owner_type);
            // dd($owner_arr);
        }
        $room1 = request()->room1;
        $arr  = [];
        if ($room1 == 'yes') {
            $arr[] = 1;
        }
        $room2 = request()->room2;
        if ($room2 == 'yes') {
            $arr[] = 2;
        }
        $room3 = request()->room3;
        if ($room3 == 'yes') {
            $arr[] = 3;
        }
        $room4 = request()->room4;
        if ($room4 == 'yes') {
            $arr[] = 4;
        }
        $room5 = request()->room5;
        if ($room5 == 'yes') {
            $arr[] = 5;
        }
        if (empty($arr)) {
            $exist = false;
        } else {
            $exist = true;
        }

        $price_from_exist = false;
        $price_to_exist = false;
        // dd(request()->all(), $floor_to, $floor_from, $room);
        if ($buildingType == 0) {
            $buildingType = false;
        }
        if ((int)$currency == 1 && $price_from != null) {
            $price_from_exist = true;
        } elseif ((int)$currency == 1 && $price_from == null) {
            $price_from_exist = false;
        }
        if ((int)$currency == 1 && $price_to != null) {
            $price_to_exist = true;
        } elseif ((int)$currency == 1 && $price_to == null) {
            $price_to_exist = false;
        }

        if ((int)$currency == 2 && $price_from != null) {
            $price_from_exist = true;
        } elseif ((int)$currency == 2 && $price_from == null) {
            $price_from_exist = false;
        }
        if ((int)$currency == 2 && $price_to != null) {
            $price_to_exist = true;
        } elseif ((int)$currency == 2 && $price_to == null) {
            $price_to_exist = false;
        }

        // if($currency==2){
        //     $converted_from = (int)request()->price_sum_y_from / 10400;
        //     $converted_to = (int)request()->price_sum_y_to / 10400;
        // }
            // dd(explode(',',$owner_type));
        $estate = Estate::when($selected_city_exist, function ($query) use ($selected_city) {

            if ((int)$selected_city == 0) {

                return $query->where('city', 1);
            } elseif ((int)$selected_city == 1600) {
                return $query->where('city', 2);
            } else {
                return $query->where('region', (int)$selected_city);
            }
        })
            ->when($photo_exist, function ($query) use ($photo_exist) {
                if ((int)$photo_exist == 1) {
                    return $query->where('img', '!=', "['']");
                }
            })
            ->when($area_from, function ($query) use ($area_from) {
                // dd($area_from);
                return $query->where('total_area', '>', (int)$area_from);
            })
            ->when($area_to, function ($query) use ($area_to) {
                // dd($area_to);
                return $query->where('total_area', '<', (int)$area_to);
            })
            ->when($type, function ($query) use ($type) {

                return $query->where('category', (int)$type);
            })
            ->when($house_type, function ($query) use ($house_type) {

                return $query->where('house_type', (int)$house_type);
            })
            ->when($exist, function ($query) use ($arr) {

                return $query->whereIn('num_rooms', $arr)
                    ->when(request()->room5 == 'yes', function ($q) {
                        return $q->orwhere('num_rooms', '>', 5);
                    });
            })
            ->when($floor_from, function ($query) use ($floor_from) {
                return $query->where('floor', '>=', (int)$floor_from);
            })
            ->when($floor_to, function ($query) use ($floor_to) {
                return $query->where('floor', '<=', (int)$floor_to);
            })
            ->when($floor_c_from, function ($query) use ($floor_c_from) {
                return $query->where('floor_house', '>=', (int)$floor_c_from);
            })
            ->when($floor_c_to, function ($query) use ($floor_c_to) {
                return $query->where('floor_house', '<=', (int)$floor_c_to);
            })
            ->when($remont_id, function ($query) use ($remont_id) {
                if ((int)$remont_id != 0) {
                    return $query->where('remont', (int)$remont_id);
                }
            })
            ->when($buildingType, function ($query) use ($buildingType) {
                return $query->where('building_type', (int)$buildingType);
            })
            ->when((int)$currency == 1, function ($query) use ($price_from_exist, $price_from) {
                if ($price_from_exist) {
                    return $query->where('currency', '!=', 'сум')->where('price', '>', (int)$price_from);
                }
            })
            ->when((int)$currency == 1, function ($query) use ($price_to_exist, $price_to) {
                // dd($price_to_exist);
                if ($price_to_exist) {
                    return $query->where('currency', '!=', 'сум')->where('price', '<', (int)$price_to);
                }
            })
            ->when((int)$currency == 2, function ($query) use ($price_from_exist, $price_from) {
                if ($price_from_exist) {
                    return $query->where('currency', 'сум')->where('price', '>', (int)$price_from);
                }
            })
            ->when((int)$currency == 2, function ($query) use ($price_to_exist, $price_to) {
                if ($price_to_exist) {
                    return $query->where('currency', 'сум')->where('price', '<', (int)$price_to);
                }
            })
            ->when($latest, function ($query)  use ($latest) {
                if ($latest == 1) {
                    $date = \Carbon\Carbon::today()->subDays(7);
                    return $query->where('updated_at', '>=', $date);
                } elseif ($latest == 2) {
                    $date = \Carbon\Carbon::today()->subDays(14);
                    return $query->where('updated_at', '>=', $date);
                } elseif ($latest == 3) {
                    $date = \Carbon\Carbon::today()->subDays(25);
                    return $query->where('updated_at', '>=', $date);
                } elseif ($latest == 4) {
                    $date = \Carbon\Carbon::today()->subMonth();
                    return $query->where('updated_at', '>=', $date);
                }
            }, function ($query) {

                $date = \Carbon\Carbon::today()->subDays(7);
                return $query->where('updated_at', '>=', $date);
            })
            ->when($owner_type, function ($query) use ($owner_arr) {
                return $query->whereIn('announcement', $owner_arr);
            })
            ->when(!$owner_type, function ($query) {
               
                return $query->where('announcement', 2);
            })
            ->when($itemsorder, function ($query, $itemsorder) {
                if ($itemsorder == 1) {
                    return $query->orderby('updated_at', 'desc');
                } elseif ($itemsorder == 2) {
                    return $query->orderby('updated_at', 'asc');
                } elseif ($itemsorder == 3) {
                } elseif ($itemsorder == 4) {
                }
            }, function ($query) {
                return $query->orderby('updated_at', 'desc');
            })
            ->paginate(20);

        // dd($estate);
        $currence =  Http::get('https://cbu.uz/ru/services/open_data/rates/json/');
        if($currence->ok()){
            $usd = (int)$currence[0]['G4'];
           
        }else{
            $usd = 10400;
        }

        foreach ($estate as $es) {
            // dd($es->asin_type);
            $es['price_cur'] = $es->currency;
           
            $remont = $es->getRemont();
            if ($remont) {
                $es['remont'] = $remont->name;
            }
            $city = $es->getCity();
            if ($city) {

                $es['city'] = $city->name;
            }
            $region = $es->getRegion();
            if ($region) {
                $es['region'] = $region->name;
            }
            if($es->currency=='у.е'){
               
                $es['cur_alter'] = (int)$es->price*$usd;
            }else{
                $es['cur_alter'] = (int)$es->price/$usd;
            }
            if (Str::contains($es->img, 'https')) {
                $c_img = count(explode(",", Str::of($es->img)->replace('[', '')->replace(']', '')->replace("'", '')->replace(' ', '')));
                $es['img'] = $c_img;
               
                 
            }else{
                $es['img'] = 0;
            }
            $change = Price::select('price', 'created_at')->where('estate_id', $es->id)->orderby('created_at','desc')->take(2)->get();
            if(count($change)>1){
               
                if((int)$change[0]->price>(int)$change[1]->price){
                    $es['price_change'] = 1;
                }else{
                    $es['price_change'] = -1;
                   
                }
                
            }else{
                $es['price_change'] = 0;
            }
            
            $format = Carbon::parse($es->updated_at)->locale('ru_RU');
            $es['update_time'] = $format->format('d.m.y') . '<br>'. $format->format('H:i');
            $es['created_time'] = Carbon::parse($es->created_at)->locale('ru_RU')->diffForHumans();
        }

        return response()->json([
            'status' => true,
            'estate' => $estate,
        ]);
    }


    public function showingEstate($slug)
    {
        $estate = Estate::where('slug', $slug)->first();
        if ($estate) {
            $city = $estate->getCity();
            if ($city) {
                $estate['city'] = $city->name;
            }
            $region = $estate->getRegion();
            if ($region) {
                $estate['region'] = $region->name;
            }
            $all_prices = Price::select('price', 'created_at')->where('estate_id', $estate->id)->get();
            foreach ($all_prices as $key => $all_price) {

                $all_price[Carbon::parse($all_price->created_at)->format('Y-m-d H:i')] = $all_price->price;
                $all_price->makeHidden('created_at');
                $all_price->makeHidden('price');
            }
            $estate['update_at']= $estate->updated_at->format('d.m.Y H:i');
            $estate['create_at']= $estate->created_at->format('d.m.Y H:i');
            // $estate['update_time'] = Carbon::parse($estate->updated_at)->locale('ru_RU')->isoFormat('LLLL');
            $map = explode(',', Str::of($estate->map)->replace('{', '')->replace('}', '')->replace(' ', ''));
            $lat = Str::of(explode(':', $map[0])[1])->replace("'", "");
            $lon = Str::of(explode(':', $map[1])[1])->replace("'", "");

            $d = 'https://www.google.com/maps/embed/v1/place?q=' . $lat . ',' . $lon . '&key=AIzaSyC63KzZYIxs4DNt5X_Avua9a_HgSyyVXMw&language=ru';
            $estate['map'] = $d;
            if (Str::contains($estate->img, 'https')) {
                $estate['imgs'] = explode(",", Str::of($estate->img)->replace('[', '')->replace(']', '')->replace("'", '')->replace(' ', ''));
            }
            $owner = $estate->owner()->first();
            if ($owner) {
                $estate['owner'] = $owner;

                $estate['owner']['update_at'] = $owner->created_at->format('m d Y H:i');;
            } else {
                $estate['owner'] = null;
            }
            $announcement = $owner->type;
            if($announcement){
                $estate['announcement'] =$announcement->name;
            }
            
            
            $owner_estate = $owner->estates()->where('estates.id', '!=', $estate->id)->orderby('estates.updated_at','desc')->get()->take(3);
            if ($owner && count($owner_estate) > 0) {

                $estate['owner_estates'] = $owner_estate;
                foreach ($estate['owner_estates'] as $own) {
                    $own_city = $own->getCity();
                    if ($own_city) {
                        $own['city'] = $own_city->name;
                    }
                    $own_region  = $own->getRegion();
                    if ($own_region) {
                        $own['region'] = $own_region->name;
                    }
                    $own['update_at'] = Carbon::parse($own->updated_at)->format('d.m.Y H:i');
                }
            }

            
            $estate['apartment_has'] = '' . Str::of($estate->apartment_has)->replace(', ', '<br>')->replace("\n", "<br>");
            $estate['near_has'] = '' . Str::of($estate->near_has)->replace('Средняя', '<br>Средняя')->replace("\n", "<br>")->replace(",", "<br>");
            $estate['body'] = '' . Str::of($estate->body)->replace('- показать телефон -', '');


           


            return response()->json([
                'status' => true,
                'estate' => $estate,
                'all_prices' => $all_prices
            ]);
        } else {
            return response()->json([
                'status' => false,
                'estate' => [],
            ]);
        }
    }
    public function getOwners()
    {
        $owner_type = request()->type;
        $search = request()->s;
        $own = false;
        if($owner_type==1){
            $own = true;
        }
        
        if ($owner_type == null || $owner_type == 0) {

            if ($search != null) {

                $replaced = Str::of($search)->replace(' ', '');
                if (Str::length($replaced) == 0) {

                    $owners = Owner::orderby('updated_at', 'desc')->paginate(30);
                } else {

                    $owners = Owner::where('name', 'LIKE', '%' . $search . '%')->orwhere('number', 'LIKE', '%' . $search . '%')->orderby('updated_at', 'desc')->paginate(30);
                }
            } else {
                $owners = Owner::orderby('updated_at', 'desc')->paginate(30);
            }
        } else {
            if ($search != null) {
                $replaced = Str::of($search)->replace(' ', '');
                if (Str::length($replaced) == 0) {
                    $owners = Owner::where('announcement', $owner_type)->when($own, function($query){
                        return $query->orwhere('announcement',4);
                    })->orderby('updated_at', 'desc')->paginate(30);
                } else {
                    $owners = Owner::where('announcement', $owner_type)->when($own, function($query){
                        return $query->orwhere('announcement',4);
                    })->where('name', 'LIKE', '%' . $search . '%')->orwhere('number', 'LIKE', '%' . $search . '%')->orderby('updated_at', 'desc')->paginate(30);
                }
            } else {
                $owners = Owner::where('announcement', $owner_type)->when($own, function($query){
                    return $query->orwhere('announcement',4);
                })->orderby('updated_at', 'desc')->paginate(30);
            }
        }

        foreach ($owners as $key => $owner) {
            $type =$owner->type;
            if ($type) {
                $owner['types'] = $type->name;
            }
            $owner['update_at'] = $owner->created_at->format('m d Y H:i');
            $owner['number'] = [];
            $est = $owner->estates;
            $owner['count_all'] = $est->count();
            $owner['newhouse_count'] = $est->where('house_type', 2)->count();
            $owner['oldhouse_count'] = $est->where('house_type', 1)->count();
        }
        return response()->json([
            'status' => true,
            'owners' => $owners,
        ]);
    }
    public function getOwnersType()
    {

        $ownersTypes = OwnerType::all();
        $ownersType = [];
        foreach ($ownersTypes as $ownersTypez) {
            if($ownersTypez->name == 'Частное лицо'){
                $ownersTypez['selected']= true;
            }else{
                $ownersTypez['selected'] = false;
            }
            if (!Str::contains($ownersTypez->name, 'Агентство') && !Str::contains($ownersTypez->name, 'Developer')) {
                $ownersType[] = $ownersTypez;
            }
        }

        return response()->json([
            'status' => true,
            'ownersType' => $ownersType,
        ]);
    }
    public function OwnerEstate($id)
    {

        $latest = request()->latest;
        $itemsorder = request()->itemsorder;
        $owner = Owner::find($id);
        if ($owner) {


            $estate = $owner->estates()->when($latest, function ($query, $latest) {

                if ((int)$latest == 1) {
                    $date = \Carbon\Carbon::today()->subDays(7);
                    return $query->where('estates.updated_at', '>=', $date);
                } elseif ((int)$latest == 2) {
                    $date = \Carbon\Carbon::today()->subDays(14);
                    return $query->where('estates.updated_at', '>=', $date);
                } elseif ((int)$latest == 3) {
                    $date = \Carbon\Carbon::today()->subDays(25);
                    return $query->where('estates.updated_at', '>=', $date);
                } elseif ((int)$latest == 4) {
                    // $date = \Carbon\Carbon::today()->subMonth();
                    // return $query->where('estates.updated_at','>=',$date);
                }
            }, function ($query) {

                // $date = \Carbon\Carbon::today()->subDays(7);
                // return $query->where('estates.updated_at','>=',$date);

            })
                ->when($itemsorder, function ($query, $itemsorder) {
                    if ((int)$itemsorder == 1) {
                        return $query->orderby('estates.updated_at', 'desc');
                    } elseif ((int)$itemsorder == 2) {
                        return $query->orderby('estates.updated_at', 'asc');
                    } elseif ((int)$itemsorder == 3) {
                    } elseif ((int)$itemsorder == 4) {
                    }
                }, function ($query) {

                    return $query->orderby('estates.updated_at', 'desc');
                })
                ->paginate(30);


            foreach ($estate as $es) {
                $es['i'] = $es->owner()->first();

                $es['price_cur'] = $es->currency;

                
                if ((int)$es['house_type'] == 1) {
                    // dd($es);
                    $es['housingtype'] = 'вр';
                } elseif ($es['house_type'] == 2 || $es['house_type'] == null) {
                    
                    $es['housingtype'] = 'нв';
                }
                $remont = $es->getRemont();
                if ($remont) {
                    $es['remont'] = $remont->name;
                }
                $city = $es->getCity();
                if ($city) {

                    $es['city'] = $city->name;
                }
                $region = $es->getRegion();
                if ($region) {
                    $es['region'] = $region->name;
                }
                $es['update_time'] = Carbon::parse($es->updated_at)->locale('ru_RU')->diffForHumans();
                $es['created_time'] = Carbon::parse($es->created_at)->locale('ru_RU')->diffForHumans();
            }

            return response()->json([
                'status' => true,
                'estate' => $estate,
            ]);
        } else {
            return response()->json([
                'status' => false,
                'estate' => [],
            ]);
        }
    }
    public function OwnerInfo($id)
    {
        $owner = Owner::find($id);
        if ($owner) {
            $owner['update_at'] = $owner->created_at->format('m d Y H:i');
            $type = $owner->type()->first();
            if ($type) {
                $owner['type'] = $type->name;
            }
            $amount = $owner->estates()->get();
            if (count($amount) > 0) {
                $owner['amount'] = count($amount);
                $owner['newhouse'] = $owner->estates()->where('house_type', 2)->count();
                $owner['oldhouse'] = $owner->estates()->where('house_type', 1)->count();
                $owner['archive']  = $owner->estates()->where('status', 2)->count();
            }
            return response()->json([
                'status' => true,
                'owner' => $owner,
            ]);
        } else {
            return response()->json([
                'status' => false,
                'estate' => [],
            ]);
        }
    }
    public function getnumber(Request $request)
    {
        
        if ($request->isMethod('post')) {
            $owner = Owner::find($request->id);
            if ($owner) {
                $n = Carbon::now();
                $p = (int)$n->format('d') + (int)$n->format('m');
                $s = (int)$n->format('d') * (int)$n->format('m');
                $y = (int)$n->format('Y');
                
                
                $id = $request->id;
                $t = (string)Str::of($owner->created_at->format('m d Y H:i'))->replace(' ', '')->replace(':', '');
                $all = $p * $s * $y * $id;
               
                $sd = (int)$all + (int)$t;
                
                $base = base64_encode($sd);
                 dd($base);
                $base =$request->t;
                // dd($base, $request->t);
                if ($base == $request->t) {
                    $number = $owner->number;
                    $replaced = Str::of($number)->replace('"', '')->replace('[', '')->replace(']', '')->explode(',');
                    return response()->json([
                        'status' => true,
                        'number' => $replaced,
                    ]);
                } else {
                    return response()->json([
                        'status' => false,
                        'number' => [],
                        'error' => 'have no access',
                    ]);
                }
                // dd(base64_encode($owner->created_at));

            } else {
                return response()->json([
                    'status' => false,
                    'number' => [],
                    'error' => 'owner not found',
                ]);
            }
        } else {
            return response()->json([
                'status' => false,
                'number' => [],
                'error' => 'not post request',
            ]);
        }
    }
    public function getnumberbyEstate(Request $request)
    {
        
        if ($request->isMethod('post')) {
            $estate = Estate::find($request->id);
            if($estate){
                $owner = $estate->owner()->first();
                if ($owner) {
                    $n = Carbon::now();
                    $p = (int)$n->format('d') + (int)$n->format('m');
                    $s = (int)$n->format('d') * (int)$n->format('m');
                    $y = (int)$n->format('Y');
                    
                    
                    $id = $request->id;
                    $t = (string)Str::of($estate->created_at->format('m d Y H:i'))->replace(' ', '')->replace(':', '');
                    $all = $p * $s * $y * $id;
                   
                    $sd = (int)$all + (int)$t;
                    
                    $base = base64_encode($sd);
                    $base = $request->t;
                    // dd($base);
                    // dd($base, $request->t);
                    if ($base == $request->t) {
                        $number = $owner->number;
                        $replaced = Str::of($number)->replace('"', '')->replace('[', '')->replace(']', '')->explode(',');
                        return response()->json([
                            'status' => true,
                            'number' => $replaced,
                        ]);
                    } else {
                        return response()->json([
                            'status' => false,
                            'number' => [],
                            'error' => 'have no access',
                        ]);
                    }
                    // dd(base64_encode($owner->created_at));
    
                } else {
                    return response()->json([
                        'status' => false,
                        'number' => [],
                        'error' => 'owner not found',
                    ]);
                }
            }else{
                return response()->json([
                    'status' => false,
                    'number' => [],
                    'error' => 'estate not found',
                ]);
            }
            
        } else {
            return response()->json([
                'status' => false,
                'number' => [],
                'error' => 'not post request',
            ]);
        }
    }
    public function getposttocheck()
    {
        return response()->json([
            'status' => true,
            'estate' => Estate::select('id','url', 'ad_site','ad_id')->where('status', 1)->orderby('updated_at','desc')->take(50)->get(),
        ]);
    }
    public function setStatusEstate(Request $request)
    {
        if($request->isMethod('post')){
            $header =  $request->header('token');
            if($header=='2HixxqWaeJ6hJKGw3XxZcCaHSXo0XEHIZhdIPOb6zNMPpna84uRN4IRYzDid28Ck2XegJkInTsXs7dCNXE2HQlgD1ijuviUy9NCMbbC2sX9re2EIF5GeMD3VhnGcAn4fhrYrdiiTF6a0xOzko7Ef2m')
            {
               
              
              $est = DB::table('estates')->where('id', $request->id)
                ->update(['status' => 2, 'checked_at'=>Carbon::now()],  ['timestamps' => false]);
                 
                    if($est){
                        return response()->json([
                            'status' => true,
                        ]);
                    }
               
               return response()->json([
                    'status' => false,
                ]);
            }else{
                return response()->json([
                    'status' => false,
                    'error'=>'not authenticated'
                ],401);
            }
        }
        return response()->json([
            'status' => false,
            'error'=>'not post method'
        ]);
    }
    
}
