<?php

/**
 * Class veiculos
 */
class Veiculo
{
    /**
     * @var array
     */
    public $response = array();


    /**
     * @param int $estado
     * @param int $capacidade
     * @param int $autonomia
     * @return string
     */
    public function setVeiculo($estado = 1, $capacidade = 0, $autonomia = 0)
    {
        $link = mysqli_connect("localhost", "root", "", "esof");
        mysqli_set_charset($link, "utf8");
        $sql = "insert into veiculos(estado, capacidade, autonomia) values ($estado, $capacidade, $autonomia)";
        $this->response['result'] = mysqli_query($link, $sql);
        $this->response['action'] = 'new vehicle';
        mysqli_close($link);
        return json_encode($this);
    }

    /**
     * Obter todos os veiculos livres
     * @return response
     */
    public function getVeiculoFree()
    {
        $link = mysqli_connect("localhost", "root", "", "esof");
        mysqli_set_charset($link, "utf8");
        $sql = "select * from veiculos where estado = 1;";
        $result = mysqli_query($link, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $this->response['items'][] = $row;
        }
        $this->response['action'] = 'get free vehicles';
        return json_encode($this->response);
    }

    /**
     * @return string
     */
    public function getAllVeiculo()
    {
        $link = mysqli_connect("localhost", "root", "", "esof");
        mysqli_set_charset($link, "utf8");
        $sql = "select * from veiculos;";
        $result = mysqli_query($link, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $this->response['items'][] = $row;
        }
        $this->response['action'] = 'get all vehicles';
        return json_encode($this->response);
    }

    /**
     * Update veiculo, inserir condutor e estado
     * @param $id
     * @param $estado
     * @param $condutor
     */
    public function updateVeiculo($id, $estado, $condutor)
    {
        $link = mysqli_connect("localhost", "root", "", "esof");
        mysqli_set_charset($link, "utf8");

        $sql2 = "update condutor_veiculo set active = 0 where veiculo_id = $id";
        mysqli_query($link, $sql2);

        $sql = "update veiculos set estado = $estado where id_veiculo = $id";
        mysqli_query($link, $sql);

        $sql1 = "insert into condutor_veiculo (veiculo_id, condutor_id) values ($id, $condutor)";
        mysqli_query($link, $sql1);


        $sql_result = "select v.capacidade, v.autonomia, c.nome, c.contacto  from veiculos v
                      inner join condutor_veiculo cv on v.id_veiculo = cv.veiculo_id
                      inner join condutores c on c.id_condutor = cv.condutor_id
                      where cv.veiculo_id = $id and cv.condutor_id = $condutor and active =1;
                      ";
        $result = mysqli_query($link, $sql_result);

        $this->response['result'] = $result->fetch_assoc();
        $this->response['action'] = 'update vehicles';
        mysqli_close($link);
        return json_encode($this->response);
    }
}

/**
 * Class localizacoes
 */
class Localizacao
{
    /**
     * @var array
     */
    public $response = array();

    /**
     * localizacoes constructor.
     * @param array $response
     */
    public function setLocalizacao($coordenadas, $id)
    {
        $link = mysqli_connect("localhost", "root", "", "esof");
        mysqli_set_charset($link, "utf8");
        $sql = "insert into localizacoes (coordenadas, veiculo_id) value('$coordenadas', $id)";
        $this->response['result'] = mysqli_query($link, $sql);
        $this->response['action'] = 'new location';
        return json_encode($this->response);
    }

    /**
     * Obter as localizacoes do veiculo X
     * @param $id
     * @return json com todas as localizacoes do veiculo
     */
    public function getLocalizacoes($id)
    {
        $link = mysqli_connect("localhost", "root", "", "esof");
        mysqli_set_charset($link, "utf8");
        $sql = "select coordenadas from localizacoes where veiculo_id = $id;";
        $result = mysqli_query($link, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $this->response['locations'][] = $row;
        }

        $this->response['action'] = 'get locations by veiculo';
        return json_encode($this->response);
    }
}

/**
 * Class Condutor
 */
class Condutor
{
    /**
     * @var array
     */
    public $response = array();

    /**
     * Condutor constructor.
     * @param $nome
     * @param $contato
     */

    public function setCondutor($nome, $contato)
    {
        $link = mysqli_connect("localhost", "root", "", "esof");
        mysqli_set_charset($link, "utf8");
        $sql = "insert into condutores (nome, contacto) value('$nome', '$contato')";
        $this->response['result'] = mysqli_query($link, $sql);
        $this->response['action'] = 'new driver';
        return json_encode($this->response);
    }

    /**
     * @return string
     */
    public function getAllDrivers()
    {
        $link = mysqli_connect("localhost", "root", "", "esof");
        mysqli_set_charset($link, "utf8");
        $sql = "select * from condutores;";
        $result = mysqli_query($link, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $this->response['drivers'][] = $row;
        }

        $this->response['action'] = 'get drivers';
        return json_encode($this->response);
    }
}

/**
 * Class Percurso
 */
class Percurso
{
    /**
     * @var array
     */
    public $response = array();

    /**
     * @param $id
     * @param $inicio
     * @param $fim
     * @return string
     */
    public function setPercurso($id, $inicio, $fim)
    {
        $link = mysqli_connect("localhost", "root", "", "esof");
        mysqli_set_charset($link, "utf8");
        $sql = "insert into percursos (veiculo_id, inicio, fim) value($id, '$inicio', '$fim')";
        $this->response['result'] = mysqli_query($link, $sql);
        $this->response['action'] = 'new route';
        return json_encode($this->response);
    }
}

