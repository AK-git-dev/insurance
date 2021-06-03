<?php

use App\Models\City;
use App\Models\FeatureImage;
use App\Models\Group;
use App\Models\PointSystem;
use App\Models\Ride;
use App\Models\RiderProfile;
use App\Models\RiderRatingSystem;
use App\Models\State;
use App\User;
use Stevebauman\Location\Facades\Location;
use Illuminate\Support\Str;

use function GuzzleHttp\json_decode;

if (!function_exists('user')) {
    /**
     * @return null|\App\Models\User
     */
    function user()
    {
        return \Auth::user();
    }
}

if (!function_exists('isAdministrator')) {
    /**
     * @param null $user
     * @return bool
     */
    function isAdministrator($user = null)
    {
        if (is_null($user)) {
            $user = user();
        }

        if (!$user) {
            return false;
        }

        return $user->hasRole('administrator');
    }
}

if (!function_exists('dateFormate')) {
    /**
     * @param $date
     * @param $format
     * @return null|string
     */
    function formatDate($date, $format = 'Y-m-d')
    {
        if (empty($date)) {
            return null;
        }

        if (!($date instanceof \Carbon\Carbon)) {
            $date = Carbon\Carbon::parse($date);
        }

        return $date->format($format);
    }
    
}


if (!function_exists('getCurrentLocation')) {
   
    function getCurrentLocation()
    {
        $ip = request()->ip();
        $result = Location::get($ip);
        if($result) {
            $city_name =  $result->cityName;
        }
        else {
            $ip = '180.149.226.195';
            $result = Location::get($ip);
            $city_name =  $result->cityName;
        }
        return $city_name;
    }
    
}

if (!function_exists('getRideImage')) {
   
    function getRideImage($explore_ride)
    {   
        $result = '';
        if(!empty($explore_ride)) {
            $filter_data = explode(',', implode(',', array_filter($explore_ride)));
            $result = $filter_data[0];
        }
        return $result;
    }
    
}

if (!function_exists('dateDifference')) {
   
    function dateDifference($start_date,$end_date)
    {   
        $start_date = \Carbon\Carbon::createFromFormat('Y-m-d',formatDate($start_date));
        $end_date = \Carbon\Carbon::createFromFormat('Y-m-d', formatDate($end_date));
        $days =  $start_date->diffInDays($end_date);
        return $days;
    }
    
}


if (!function_exists('addNumberOfDate')) {
   
    function addNumberOfDate($start_date,$days)
    {   
        $start_date = \Carbon\Carbon::parse(formatDate($start_date));
        $new_date = $start_date->addDays($days);
        return $new_date->format("Y-m-d");
    }
    
}



if (!function_exists('isOwner')) {
   
    function isOwner($rider_id)
    {   
        $user = user();
        $owner = false;
        if(isset($user->id) && ($user->id == $rider_id)) {
            $owner = true;
        }
        return $owner;
    }
    
}


if (!function_exists('currentLocation')) {
   
    function currentLocation()
    {   
        $location = config('app.default_location');
        return $location;
    }
    
}


if (!function_exists('getImageUrl')) {
   
    function getImageUrl()
    {   
        if(in_array($_SERVER['REMOTE_ADDR'], array('127.0.0.1', '::1'))) {
            $url = 'http://localhost/throttle-rides_admin-';
        }
        else{
            $url = 'https://smartevents.in/throttle-rides/admin/';
        }
        return $url;
    }
    
}


if (!function_exists('getCityList')) {
   
    function getCityList()
    {   
        $rideCity = Ride::where('is_approved', 1)->distinct('start_city')->pluck('start_city');

        $groupCity = Group::join('city', 'city.id', '=', 'groups.city')->where('groups.is_approved', 1)->distinct('groups.city')->pluck('city.name');

        $riderCity = User::join('rider_profiles as rp', 'rp.rider_id', '=', 'users.id')
                        ->join('city', 'city.id', '=', 'rp.city')
                    ->where('is_approved', 1)->distinct('rp.city')->pluck('city.name');
                    
        $cities = $rideCity->merge($groupCity);
        $cities = $cities->merge($riderCity);
        $cities = $cities->unique();
        $cities = $cities->filter();
        return $cities;
    }
    
}

if (!function_exists('getTodayfeatureImage')) {
   
    function getTodayfeatureImage()
    {   
        $todayDate = formatDate(\Carbon\Carbon::now(), 'Y-m-d');        
        $featuredImage = FeatureImage::where('created_at', 'LIKE', '%'.$todayDate.'%')->where('is_approved', 1)->first();
        $feature_image = isset($featuredImage->feature_image) ? $featuredImage->feature_image : 'banner.jpg';
        return $feature_image;
    }
}

if (!function_exists('getGroupNotifications')) {
   
    function getGroupNotifications() {
        $groups = Group::where('is_approved', 1)->orderBy('created_at', 'desc')->limit(5)->get();
        foreach($groups as $key => $group) {
            $result[$key] = [
                'name' => $group['group_name'],
                'description' => $group['group_desc']
            ];
        }
        return $result;
    }

}

if (!function_exists('getRideNotifications')) {
   
    function getRideNotifications() {
        $result=[];
        $rides = Ride::where('is_approved', 1)->orderBy('created_at', 'desc')->get();
        foreach($rides as $key => $ride) {
            $result[$key] = [
                'name' => 'Ride To '.$ride['end_city'].' from '.$ride['start_city'],
                'description' => $ride['short_description'],
                'slug' => $ride['slug'],
            ];
        }
        return $result;
    }

}

if (!function_exists('getRiderNotifications')) {
   
    function getRiderNotifications() {
        $users = User::where('is_approved', 1)->where('is_admin', 0)->orderBy('created_at', 'desc')->get();
        foreach($users as $key => $user) {
            $result[$key] = [
                'name' => $user['name'],
                'description' => isset($user->profile->description) ? $user->profile->description : ''
            ];
        }
        return $result;
    }

}


if (!function_exists('getNotifications')) {
   
    function getNotifications()
    {   
        $groups = Group::where('is_approved', 1)->orderBy('created_at', 'desc')->limit(5)->get();
        $i=0;
        foreach($groups as $group) {
            $result[$i] = [
                'name' => $group['group_name'],
                'description' => $group['group_desc'],
                'added_on' => formatDate($group['created_at'], 'Y-m-d H:i:s'),
            ];
            $i++;
        }

        $rides = Ride::where('is_approved', 1)->orderBy('created_at', 'desc')->get();
        foreach($rides as $ride) {
            $result[$i] = [
                'name' => 'Ride To '.$ride['end_city'].' from '.$ride['start_city'],
                'description' => $ride['short_description'],
                'added_on' => formatDate($ride['created_at'], 'Y-m-d H:i:s'),
            ];
            $i++;
        }

        $users = User::where('is_approved', 1)->where('is_admin', 0)->orderBy('created_at', 'desc')->get();
        foreach($users as $user) {
            $result[$i] = [
                'name' => $user['name'],
                'description' => isset($user->profile->description) ? $user->profile->description : '',
                'added_on' => formatDate($user['created_at'], 'Y-m-d H:i:s'),
            ];
            $i++;
        }

        $result = collect($result)->sortByDesc('added_on')->take(10)->toArray();
        return $result;
    }
}


if (!function_exists('getCities')) {
   
    function getCities() {
        $cities = City::where('status', 'Active')->orderBy('name', 'asc')->get();        
        return $cities;
    }

}

if (!function_exists('createSlug')) {
   
    function createSlug($data) {
        $str = $data['start_location']. ' '.implode(' ', $data['via_location']). ' '.$data['end_location'];
        $slug = Str::slug($str, '-');
        return $slug;
    }

}

if (!function_exists('uploadCoverImage')) {
   
    function uploadCoverImage($image,$w,$h,$x,$y,$path) {       
        $new_name = '';            
        if(isset($image)) {                    
            $new_name = rand() . '.' . $image->getClientOriginalExtension();                
            $image->move($path, $new_name);               
            $newImage = imagecreatetruecolor($w, $h);     
            $extn = $image->getClientOriginalExtension();     
            $thumbImageLoc = $path.$new_name;     
            switch($extn) {
                case "gif":
                    $source = imagecreatefromgif($thumbImageLoc); 
                    break;
                case "pjpeg":
                case "jpeg":
                case "jpg":
                    $source = imagecreatefromjpeg($thumbImageLoc); 
                    break;
                case "png":
                case "x-png":
                    $source = imagecreatefrompng($thumbImageLoc); 
                    break;
            }
            
            imagecopyresampled($newImage, $source, 0, 0, $x, $y, $w, $h, $w, $h);                
            // Output image to file
            switch($extn) {
                case "gif":
                    imagegif($newImage, $thumbImageLoc); 
                    break;
                case "pjpeg":
                case "jpeg":
                case "jpg":
                    imagejpeg($newImage, $thumbImageLoc, 90); 
                    break;
                case "png":
                case "x-png":
                    imagepng($newImage, $thumbImageLoc);  
                    break;
            }
        }
        return $new_name;
    }
}

if (!function_exists('formatLuggage')) {
   
    function formatLuggage($luggage)
    {   
        $result = [];
        if($luggage!=null){
            $array = json_decode($luggage,true);
            $result = $array['luggage'];
        }
        return $result;
    }
    
}

if (!function_exists('get_lat_long')) {
    function get_lat_long($address) {
        $result = [];
        $key = config('app.google_api_key');
        $geo = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?key='.$key.'&address='.urlencode($address).'&sensor=false');
    
        // We convert the JSON to an array
        $geo = json_decode($geo, true);

        // If everything is cool
        if ($geo['status'] = 'OK' && !empty(!empty($geo['results']))) {
            $result[0] = $geo['results'][0]['geometry']['location']['lat'];
            $result[1] = $geo['results'][0]['geometry']['location']['lng'];
        }
        else{
           $result[0] = 28.584669; 
           $result[1] = 77.352013; 
        }
        return $result;
    }
}

if (!function_exists('getaddress')) {
    function getaddress($lat,$lng)
    {
        $city ='';
        $key = config('app.google_api_key');
        $url = 'https://maps.googleapis.com/maps/api/geocode/json?key='.$key.'&latlng='.trim($lat).','.trim($lng).'&sensor=false';
        $json = @file_get_contents($url);
        $data=json_decode($json);
        if($data->status=="OK") {
            for($i=0;$i<count($data->results);$i++){
                if($data->results[$i]->types[0]=='locality'){
                  $city = $data->results[$i]->address_components[1]->long_name;
                  break;
               }
            }
        }
        return $city;
    }
}

if (!function_exists('getViaCityList')) {
    function getViaCityList($via_locations){
        $via_locations = json_decode($via_locations,true);
        $cities = [];$i=0;
        foreach($via_locations as $key => $via_location){
            if(!empty($via_location)){
                $cities[$i] = get_lat_long($via_location['name']);
                $i++;
            }
        }
        return json_encode($cities);
    }
}

if (!function_exists('getCityNameById')) {
   
    function getCityNameById($cityId)
    {   
        $cityDetail = City::find($cityId);
        $city = $cityDetail->name;
        if(strlen($cityDetail->name) > 6) {
            $city = substr($cityDetail->name, 0, 6).'..';
        }
        return $city;
    }
    
}

if (!function_exists('getTotalRidesKm')) {
   
    function getTotalRidesKm()
    {   
        $user = user();
        $total_km = $user->rides->sum('total_km');
        return $total_km;
    }
    
}

if (!function_exists('riderProfileCompleted')) {
   
    function riderProfileCompleted()
    {   
        $total = 0;
        $user = user();
        
        if(!empty($user->profile->cover_image)) {
            $total += 5; 
        }

        if(!empty($user->profile->description)) {
            $total += 5; 
        }

        if(!empty($user->profile->image)) {
            $total += 5; 
        }

        if(!empty($user->profile->total_rides) && !empty($user->profile->total_km) && !empty($user->profile->riding_year) && !empty($user->profile->city)) {
            $total += 5;
        }
        
        $rides = $user->rides->where('is_approved', 1)->count();
        if($rides > 0) {
            $point = getPoints(1);
            $total += $point;
        }

        $events = $user->events->where('is_approved', 1)->count();
        if($events > 0) {
            $point = getPoints(2);
            $total += $point; 
        }

        $bikes = $user->bikes->where('is_approved', 1)->count();
        if($bikes > 0) {
            $point = getPoints(3);
            $total += $point; 
        }

        $groups = $user->groups->where('is_approved', 1)->count();
        if($groups > 0) {
            $point = getPoints(4);
            $total += $point; 
        }

        $suppliers = $user->suppliers->where('is_approved', 1)->count();
        if($suppliers > 0) {
            $point = getPoints(5);
            $total += $point; 
        }

        $tips = $user->tips->where('is_approved', 1)->count();
        if($tips > 0) {
            $point = getPoints(6);
            $total += $point; 
        }

        $polls = $user->polls->where('is_approved', 1)->count();
        if($polls > 0) {
            $point = getPoints(7);
            $total += $point; 
        }

        $features = $user->features->where('is_approved', 1)->count();
        if($features > 0) {
            $point = getPoints(8);
            $total += $point; 
        }
        return $total;
    }
}


if (!function_exists('getPoints')) {
   
    function getPoints($id)
    {   
        $point = PointSystem::where('id', $id)->pluck('point')->first();
        return $point;
    }
}

if (!function_exists('uploadNewCoverImage')) {
    function uploadNewCoverImage($image,$path)
    { 
        list($type, $image) = explode(';', $image);
        list(, $image)      = explode(',', $image);
        $image = base64_decode($image);
        $imageName = time().'.png';
        file_put_contents($path.$imageName, $image);
        return $imageName;
    }
}


if (!function_exists('formateViaLocation')) {
   
    function formateViaLocation($via_locations)
    {   
        $data = "";
        if(!empty($via_locations)) {
            $locations = json_decode($via_locations,true);
            $data = implode(',', $locations);
        }
        return $data;
    }
    
}

if (!function_exists('getCityNameByIdNew')) {
   
    function getCityNameByIdNew($cityId)
    {   
        $cityDetail = City::find($cityId);
        $city = $cityDetail->name;
        return $city;
    }
    
}

if (!function_exists('calculateGroupJoinedPercent')) {
   
    function calculateGroupJoinedPercent($total_available_vacancy, $joined_group_members)
    {   

        if($joined_group_members > $total_available_vacancy) {
            $joined_group_members = $total_available_vacancy;
        }

        if($joined_group_members==0) {
            $joined_group_members = 1;
        }
        $percentage = ($joined_group_members*100) / $total_available_vacancy;
        

        if(is_float($percentage)) {
            $percentage = round($percentage, 1);
        }
        return $percentage;
    }
    
}

if (!function_exists('createSlugNew')) {
   
    function createSlugNew($str)
    {   
        $slug = Str::slug($str, '-');
        return $slug.'-'.time();
    }
    
}