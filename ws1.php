<?php
session_start();
include('library/library.php');

function e($json)
{
    echo json_encode($json);
}

function setVeiculo()
{
    $veiculo = new Veiculo();
    $veiculo->setVeiculo(1, $_GET['capacidade'], $_GET['autonomia'], $_GET['matricula']);
    return json_encode($veiculo);
}

function getVeiculoFree()
{
    $veiculo = new Veiculo();
    $veiculo->getVeiculoFree();
    return json_encode($veiculo);
}

function getAllVeiculo()
{
    $veiculo = new Veiculo();
    $veiculo->getAllVeiculo();
    return json_encode($veiculo);
}

function updateVeiculo()
{
    $veiculo = new Veiculo();
    $veiculo->updateVeiculo($_GET['veiculo'], $_GET['estado'], $_GET['condutor']);
    return json_encode($veiculo);
}

function setLocalizacao()
{
    $coordenadas = $_GET['lat'] . ',' . $_GET['lng'];
    $localizacao = new Localizacao();
    $localizacao->setLocalizacao($coordenadas, $_GET['oficina_id']);
    return $localizacao;
}

function getLocalizacoes()
{
    $localizacao = new Localizacao();
    $localizacao->getLocalizacoes($_GET['veiculo']);
    return json_encode($localizacao);
}

function setCondutor()
{
    $condutor = new Condutor();
    $condutor->setCondutor($_GET['nome'], $_GET['contacto']);
    return $condutor;
}

function getAllDrivers()
{
    $condutor = new Condutor();
    $condutor->getAllDrivers();
    return json_encode($condutor);
}

function setPercurso()
{
    $percurso = new Percurso();
    $percurso->setPercurso($_GET['oficina_id'], $_GET['inicio'], $_GET['fim']);
    return $percurso;
}

if (isset($_GET['method'])) {
    $method = $_GET['method'];
    switch ($method) {
        case 'setVeiculo';
            $response = setVeiculo();
            break;
        case 'getVeiculoFree';
            $response = getVeiculoFree();
            break;
        case 'getAllVeiculo';
            $response = getAllVeiculo();
            break;
        case 'updateVeiculo';
            $response = updateVeiculo();
            break;
        case 'setLocalizacao';
            $response = setLocalizacao();
            break;
        case 'getLocalizacoes';
            $response = getLocalizacoes();
            break;
        case 'setCondutor';
            $response = setCondutor();
            break;
        case 'getAllDrivers';
            $response = getAllDrivers();
            break;
        case 'setPercurso';
            $response = setPercurso();
            break;
    }

    echo $response;

}