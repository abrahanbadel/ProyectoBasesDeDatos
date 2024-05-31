<?php

class Seccion
{

    public $id;
    public $nombres;

    function __construct($id,$nombres) {
        $this->id = $id;
        $this->nombres = $nombres;
    }
    
}
?>