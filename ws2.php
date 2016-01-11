<?php
session_start();
include('library/library.php');


function searchTo()
{
    $destino = $_GET['destino'];
    $resultCoordenades = json_decode(file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address=' . urlencode($destino) . '&key=AIzaSyAcb4IphCwicIMVCal_rr12SMuUijYYveE'));
    $result['adress'] = $resultCoordenades->results[0]->formatted_address;
    $result['lat'] = $resultCoordenades->results[0]->geometry->location->lat;
    $result['lng'] = $resultCoordenades->results[0]->geometry->location->lng;
    $distancia = $_GET['distancia'];

    $resultSearchs = file_get_contents('http://localhost:8080/esof/ws1.php?method=searchTo&lat=' . $result['lat'] . '&lng=' . $result['lng'] . '&distancia=' . $distancia);


}

if (isset($_GET['method'])) {
    $method = $_GET['method'];
    switch ($method) {
        case 'searchTo';
            $response = searchTo();
            break;
    }

    echo $response;

}