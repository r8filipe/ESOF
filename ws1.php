<?php
session_start();
include('library/library.php');

/**
 * @param $json
 */
function e($json)
{
    echo json_encode($json);
}

/**
 * @return Veiculo
 */
function setVeiculo()
{
    $veiculo = new Veiculo();
    $veiculo->setVeiculo(1, $_GET['capacidade'], $_GET['autonomia']);
    return $veiculo;
}

/**
 * @return Veiculo
 */
function getVeiculoFree()
{
    $veiculo = new Veiculo();
    $veiculo->getVeiculoFree();
    return $veiculo;
}

/**
 * @return Veiculo
 */
function getAllVeiculo()
{
    $veiculo = new Veiculo();
    $veiculo->getAllVeiculo();
    return $veiculo;
}

/**
 * @return Veiculo
 */
function updateVeiculo()
{
    $veiculo = new Veiculo();
    $veiculo->updateVeiculo($_GET['id'], $_GET['estado'], $_GET['condutor']);
    return $veiculo;
}

/**
 * @return Localizacao
 */
function setLocalizacao()
{
    $coordenadas = $_GET['lat'] . ',' . $_GET['lng'];
    $localizacao = new Localizacao();
    $localizacao->setLocalizacao($coordenadas, $_GET['oficina_id']);
    return $localizacao;
}

/**
 * @return Localizacao
 */
function getLocalizacoes()
{
    $localizacao = new Localizacao();
    $localizacao->getLocalizacoes($_GET['oficina_id']);
    return $localizacao;
}

/**
 * @return Condutor
 */
function setCondutor()
{
    $condutor = new Condutor();
    $condutor->setCondutor($_GET['nome'], $_GET['contacto']);
    return $condutor;
}

/**
 * @return Condutor
 */
function getAllDrivers()
{
    $condutor = new Condutor();
    $condutor->getAllDrivers();
    return $condutor;
}

/**
 * @return Percurso
 */
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

    $_SESSION['response'] = $response->response;
    echo "<script>
             window.history.go(-1);
     </script>";

}