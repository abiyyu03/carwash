<?php
// function distance($lat1, $lon1, $lat2, $lon2, $unit) {
 
//   $theta = $lon1 - $lon2;
//   $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
//   $dist = acos($dist);
//   $dist = rad2deg($dist);
//   $miles = $dist * 60 * 1.1515;
//   $unit = strtoupper($unit);
 
//   if ($unit == "K") {
//       return ($miles * 1.609344);
//   } else if ($unit == "N") {
//       return ($miles * 0.8684);
//   } else {
//       return $miles;
//   }
// }

// // echo distance(-0.326636, 103.154260, -2.608350, 140.675299, "M") . " Miles\n";
// echo (distance(-6.396239791145851, 106.81789694165505, -6.423278037140334, 106.83772382994182, "K")) . " Kilo Meter";

function getDistanceBetweenPoints($lat1, $lon1, $lat2, $lon2) {
    $theta = $lon1 - $lon2;
    $miles = (sin(deg2rad($lat1)) * sin(deg2rad($lat2))) + (cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta)));
    $miles = acos($miles);
    $miles = rad2deg($miles);
    $miles = $miles * 60 * 1.1515;
    $feet  = $miles * 5280;
    $yards = $feet / 3;
    $kilometers = $miles * 1.609344;
    $meters = $kilometers * 1000;
    return compact('miles','feet','yards','kilometers','meters'); 
}


function dd($str)
{
    echo '<pre>';
    print_r($str);
    echo '</pre>';
    die();
}

$point1 = array("lat" => -6.423180200940294 , "long" => 106.83769256977561);
$point2 = array("lat" => -6.443595614825416, "long" => 106.89450871922585);
$distance = getDistanceBetweenPoints($point1['lat'], $point1['long'], $point2['lat'], $point2['long']);
dd($distance);

// function rad($x){ return $x * M_PI / 180; }
// function distHaversine($coord_a, $coord_b){
//     # jarak kilometer dimensi (mean radius) bumi
//     $R = 6371;
//     $coord_a = explode(",",$coord_a);
//     $coord_b = explode(",",$coord_b);
//     $dLat = rad(($coord_b[0]) - ($coord_a[0]));
//     $dLong = rad($coord_b[1] - $coord_a[1]);
//     $a = sin($dLat/2) * sin($dLat/2) + cos(rad($coord_a[0])) * cos(rad($coord_b[0])) * sin($dLong/2) * sin($dLong/2);
//     $c = 2 * atan2(sqrt($a), sqrt(1-$a));
//     $d = $R * $c;
//     # hasil akhir dalam satuan kilometer
//     return number_format($d, 0, '.', ',');
// }
// ## cara penggunaannya
// ## contoh ada 2 koordinat (latitude dan longitude)
// // $a = "-6.195168,106.769012";
// // $b = "-6.159617,106.839523";
// $a = "-6.423175597158065,106.83781623241055";
// $b = "-6.440233692256568,106.89532279151074";
// print distHaversine($a, $b);