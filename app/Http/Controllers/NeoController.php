<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class NeoController extends Controller
{
    public function index(Request $request) {
        
        $graph_key = "" ; $graph_value = []; $data = []; $maxspeed = 0;
            
        if(isset($request->from)) {
            $from = $request->from;
            $to = $request->to;
                
            $url = "https://api.nasa.gov/neo/rest/v1/feed?start_date=$from&end_date=$to&api_key=DEMO_KEY";
            
            $response = Http::get($url);
            $data = $response->json();
            // return $data;
            
            
            if(isset($data['near_earth_objects'])) {
                foreach($data['near_earth_objects'] as $key => $value) {
                    if($graph_key == "") { $graph_key .= "'$key'"; } else { $graph_key .= ",'$key'"; }
                    $graph_value[] = count($value);
                    
                    foreach($value as $v) {
                        $speed = $v['close_approach_data'][0]['relative_velocity']['kilometers_per_hour'];
                        if($speed > $maxspeed) {
                            $maxspeed = $speed;
                        }
                    }
                }
                
            }
        }
        
        
        return view('list', compact('data', 'graph_key', 'graph_value', 'maxspeed'));

    }
    
}
