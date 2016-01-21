<?php
include('library.php');

/**
 * @file   ws1.php
 * @brief  Doxygen documentation example for files.
 * @date   janeiro, 2016
 * @author Filipe Vinha e Jorge Rocha
 */
$param = $_GET;
$response = new ws1();
$response = $response->start($param);
echo $response;

class ws1
{
    public $param;

    /**
     * funcao para imprimir um json
     * @param $json
     */
    function e($json)
    {
        echo json_encode($json);
    }

    /**
     * Criar um novo veiculos com os seguintes parametros obrigatorios
     * @param token -> token fornecido pela a aplicação
     * @param method -> setVeiculo
     * @param capacidade -> A capacidade em carga ou pessoas que o veiculo
     * @param autonomia -> A autonomia que o veiculo poderá fazer
     * @param matricula -> A matricula do veiculo
     * @return string
     */
    function setVeiculo()
    {
        $veiculo = new Veiculo();
        $veiculo->setVeiculo(1, $this->param['capacidade'], $this->param['autonomia'], $this->param['matricula']);
        return json_encode($veiculo);
    }

    /**
     * Obter todos os veiculos livres
     * @param token -> token fornecido pela a aplicação
     * @param method -> getVeiculoFree
     * @return Todos Veiculos Livres
     */
    function getVeiculoFree()
    {
        $veiculo = new Veiculo();
        $veiculo->getVeiculoFree();
        return json_encode($veiculo);
    }

    /**
     * Obter todos os veiculos Registados
     * @param token -> token fornecido pela a aplicação
     * @param method -> getAllVeiculo
     * @return string
     */
    function getAllVeiculo()
    {
        $veiculo = new Veiculo();
        $veiculo->getAllVeiculo();
        return json_encode($veiculo);
    }

    /**
     * Atribui um condutor a um veiculo
     * @param token -> token fornecido pela a aplicação
     * @param method -> updateVeiculo
     * @param veiculo -> Id do veiculo
     * @param condutor -> id do Condutor
     * @return string
     */
    function updateVeiculo()
    {
        $veiculo = new Veiculo();
        $veiculo->updateVeiculo($this->param['veiculo'], 1, $this->param['condutor']);
        return json_encode($veiculo);
    }

    /**
     * Actualiza a localização do veiculo
     * @param token -> token fornecido pela a aplicação
     * @param method -> setLocalizacao
     * @param lat -> latitude
     * @param lng -> longitude
     * @param veiculo_id -> id do veiculo
     * @return string
     */
    function setLocalizacao()
    {
        $coordenadas = $this->param['lat'] . ',' . $this->param['lng'];
        $localizacao = new Localizacao();
        $localizacao->setLocalizacao($coordenadas, $this->param['veiculo_id']);
        return $localizacao;
    }

    /**
     * Obtem todos os pontos por onde o veiculo passow
     * @param token -> token fornecido pela a aplicação
     * @param method -> getLocalizacoes
     * @param veiculo -> id do veiculo
     * @return string
     */
    function getLocalizacoes()
    {
        $localizacao = new Localizacao();
        $localizacao->getLocalizacoes($this->param['veiculo']);
        return json_encode($localizacao);
    }

    /**
     * Regista um novo condutor
     * @param token -> token fornecido pela a aplicação
     * @param method -> setDriver
     * @param nome -> nome do condutor a registar
     * @param contato -> contacto do condutor a registar
     * @return string
     */
    function setDriver()
    {
        $condutor = new Condutor();
        $condutor->setDriver($this->param['nome'], $this->param['contato']);
        return json_encode($condutor);
    }

    /**
     * lista todos os condutores
     * @param token -> token fornecido pela a aplicação
     * @param method -> getAllDrivers
     * @return string
     */
    function getAllDrivers()
    {
        $condutor = new Condutor();
        $condutor->getAllDrivers();
        return json_encode($condutor);
    }

    /**
     * lista os veiculos de cada condutor
     * @param token -> token fornecido pela a aplicação
     * @param method -> getDriverVehicle
     * @return string
     */
    function getDriverVehicle()
    {
        $driverVehicle = new Veiculo();
        $driverVehicle->getDriverVehicle();
        return json_encode($driverVehicle);
    }

    /**
     * Atribui um novo percurso a um veiculo, caso esse tenha condutor associado, em uma determinada data
     * @param token -> token fornecido pela a aplicação
     * @param method -> setPercurso
     * @param destino -> Destino do percurso
     * @param origem -> Origem do percurso
     * @param veiculo -> Id do veiculo
     * @param carga -> Carga que o veiculo transportará nessa viagem
     * @param data -> Data do percurso
     * @return string
     */
    function setPercurso()
    {
        $googleDestino = json_decode(file_get_contents("https://maps.googleapis.com/maps/api/geocode/json?address=" . urlencode($this->param['destino']) . "&key=AIzaSyAcb4IphCwicIMVCal_rr12SMuUijYYveE"));
        $googleOrigem = json_decode(file_get_contents("https://maps.googleapis.com/maps/api/geocode/json?address=" . urlencode($this->param['origem']) . "&key=AIzaSyAcb4IphCwicIMVCal_rr12SMuUijYYveE"));

        if ($googleDestino->status == 'ZERO_RESULTS') {
            $response['response']['ERROR']['destino'] = 'Destino Invalido, tente Novamente';
        }
        if ($googleOrigem->status == 'ZERO_RESULTS') {
            $response['response']['ERROR']['Origem'] = 'Origem Invalido, tente Novamente';
        }

        if (isset($response)) {
            return json_encode($response);
        }
        $origem = $googleOrigem->results[0]->geometry->location->lat . ',' . $googleOrigem->results[0]->geometry->location->lng;
        $destino = $googleDestino->results[0]->geometry->location->lat . ',' . $googleDestino->results[0]->geometry->location->lng;
        $percurso = new Percurso();
        $percurso->setPercurso($this->param['veiculo'], $origem, $destino, $this->param['carga'], $this->param['data']);
        return json_encode($percurso);
    }

    /**
     * Obtem todas os percursos activos
     * @param token -> token fornecido pela a aplicação
     * @param method -> getActiveRoutes
     * @return string
     */
    function getActiveRoutes()
    {
        $percurso = new Percurso();
        $percurso->getActiveRoutes();
        return json_encode($percurso);
    }

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
        $destino = $this->param['desLat'] . ',' . $this->param['desLng'];
        $origem = $this->param['oriLat'] . ',' . $this->param['oriLng'];
        $distancia = $this->param['distancia'];
        $percurso = new Percurso();
        $percurso->searchTo($destino, $distancia, $origem);
        return json_encode($percurso);
    }

    /**
     * Cria localizações Fictícias para os veiculos
     * @param token -> token fornecido pela a aplicação
     * @param method -> generateCoordenates
     * @return string
     */
    function generateCoordenates()
    {
        for ($i = 0; $i <= 50; $i++) {
            $x = rand(37000000, 42999999) / 1000000;
            $y = rand(6000000, 9999999) / 1000000;
            $url = 'https://maps.googleapis.com/maps/api/geocode/json?latlng=' . $x . ',-' . $y . '&key=AIzaSyAcb4IphCwicIMVCal_rr12SMuUijYYveE';
            $geo = json_decode(file_get_contents($url));
            if ($geo->status == 'OK') {
                $coordenates[] = $x . ',-' . $y;
                $link = pg_connect("host=localhost dbname=esof user=postgres password=filipe") or die('Could not connect: ' . pg_last_error());
                pg_set_client_encoding($link, "utf8");
                $sql = "insert into localizacoes (coordenadas, veiculo_id) values('" . $x . ',-' . $y . "', " . rand(26, 28) . ")";
                pg_query($link, $sql);
            } else {
                $i--;
            }
        }

        return json_encode($coordenates);

    }

    /**
     * inicia o webservice
     * @param token -> token fornecido pela a aplicação
     * @return string
     */
    function start($param)
    {
        $this->param = $param;
        if ($param['token'] == "trabalhoEsof2016") {
            if (isset($param['method'])) {
                $method = $param['method'];
                switch ($method) {
                    case 'setVeiculo';
                        $response = $this->setVeiculo();
                        break;
                    case 'getVeiculoFree';
                        $response = $this->getVeiculoFree();
                        break;
                    case 'getAllVeiculo';
                        $response = $this->getAllVeiculo();
                        break;
                    case 'updateVeiculo';
                        $response = $this->updateVeiculo();
                        break;
                    case 'setLocalizacao';
                        $response = $this->setLocalizacao();
                        break;
                    case 'getLocalizacoes';
                        $response = $this->getLocalizacoes();
                        break;
                    case 'setDriver';
                        $response = $this->setDriver();
                        break;
                    case 'getAllDrivers';
                        $response = $this->getAllDrivers();
                        break;
                    case 'setPercurso';
                        $response = $this->setPercurso();
                        break;
                    case 'searchTo';
                        $response = $this->searchTo();
                        break;
                    case 'generateCoordenates':
                        $response = $this->generateCoordenates();
                        break;
                    case 'getDriverVehicle':
                        $response = $this->getDriverVehicle();
                        break;
                    case 'getActiveRoutes':
                        $response = $this->getActiveRoutes();
                        break;

                }

                return $response;
            }
            $reponse['erro'] = 'TOKEN INVALIDO';
            return json_encode($response);
        }
    }
}

