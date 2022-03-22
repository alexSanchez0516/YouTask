<?php

public class Persona () {
	
	public String $name;
    public String $apellidos;

    public function __construct($args = []) {
    	$this->name = $args['name'];
    	$this->apellidos = $args['apellidos'];
    }


    public function caminar() {
    	echo "estoy caminando";
    }

    public function descansar() {
    	echo "estoy descansando";
    }
}