<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of classUsuario
 *
 * @author Marcelo
 */
class classUsuario {

    //put your code here
    protected $nome;
    protected $sobrenome;
    protected $email;

    //construtor
    public function __construct() {
        $this->nome = "";
        $this->sobrenome = "";
        $this->email = "";
    }

    function getNome() {
        return $this->nome;
    }

    function getSobrenome() {
        return $this->sobrenome;
    }

    function getEmail() {
        return $this->email;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setSobrenome($sobrenome) {
        $this->sobrenome = $sobrenome;
    }

    function setEmail($email) {
        $this->email = $email;
    }

}
