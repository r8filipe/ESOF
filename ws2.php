<?php

/**
 * @file   ws2.php
 * @brief  Doxygen documentation example for files.
 * @date   janeiro, 2016
 * @author Filipe Vinha e Jorge Rocha
 */


$param = $_GET;
$response = new ws2();
$response = $response->start($param);
echo $response;

class ws2
{
    public $param;

    /**
     * Procura um percurso entre um destino e origem
     * @param token -> token fornecido pela a aplicação
     * @param method -> searchTo
     * @param desLat -> latitude do destino
     * @param desLng -> longitude do destino
     * @param oriLng -> longitude da origem
     * @param oriLat -> latitude da origem
     * @param distancia -> distancia aceitavel entre o meu ponto e os pontos de origem e destino
     * @return string
     */
    function searchTo()
    {
        $destino = $this->param['destino'];
        $destinoCoordenades = json_decode(file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address=' . urlencode($destino) . '&key=AIzaSyAcb4IphCwicIMVCal_rr12SMuUijYYveE'));
        $destinoResult['adress'] = $destinoCoordenades->results[0]->formatted_address;
        $destinoResult['lat'] = $destinoCoordenades->results[0]->geometry->location->lat;
        $destinoResult['lng'] = $destinoCoordenades->results[0]->geometry->location->lng;


        $origem = $this->param['origem'];
        $origemCoordenades = json_decode(file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address=' . urlencode($origem) . '&key=AIzaSyAcb4IphCwicIMVCal_rr12SMuUijYYveE'));
        $origemResult['adress'] = $origemCoordenades->results[0]->formatted_address;
        $origemResult['lat'] = $origemCoordenades->results[0]->geometry->location->lat;
        $origemResult['lng'] = $origemCoordenades->results[0]->geometry->location->lng;


        $distancia = $this->param['distancia'];

        $url = 'http://localhost:8080/esof/ws1.php?token=trabalhoEsof2016&method=searchTo&desLat=' . $destinoResult['lat'] . '&desLng=' . $destinoResult['lng'] . '&distancia=' . $distancia . '&oriLat=' . $origemResult['lat'] . '&oriLng=' . $origemResult['lng'];
        $resultSearchs = json_decode(file_get_contents($url));
        if (isset($resultSearchs->response->routes)) {
            foreach ($resultSearchs->response->routes as $route) {
                $origem = json_decode(file_get_contents("https://maps.googleapis.com/maps/api/geocode/json?latlng=$route->inicio&key=AIzaSyAcb4IphCwicIMVCal_rr12SMuUijYYveE"));
                foreach ($origem->results as $results) {
                    if ($results->types[0] == 'postal_code') {
                        $route->inicio = $results->formatted_address;
                        break;
                    }
                }
                $destino = json_decode(file_get_contents("https://maps.googleapis.com/maps/api/geocode/json?latlng=$route->fim&key=AIzaSyAcb4IphCwicIMVCal_rr12SMuUijYYveE"));
                foreach ($destino->results as $results) {
                    if ($results->types[0] == 'postal_code') {
                        $route->fim = $results->formatted_address;
                        break;
                    }
                }
            }
        }
        $time = json_decode(file_get_contents("http://api.openweathermap.org/data/2.5/forecast/daily?APPID=75ad4870e88a30c8066bba5c5f61587c&lat=" . $destinoResult['lat'] . "&lon=" . $destinoResult['lng'] . "&lang=pt&units=metric&cnt=7"));
        $resultSearchs->response->time = $time;
        return json_encode($resultSearchs);
    }

    function start($param)
    {
        $this->param = $param;
        if (isset($this->param['method'])) {
            $method = $this->param['method'];
            switch ($method) {
                case 'searchTo';
                    $response = searchTo();
                    break;
            }

            echo $response;

        }
    }
}
