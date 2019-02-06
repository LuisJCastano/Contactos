<?php

namespace App\Service;

class BDPrueba

{

    private $contactos =[

        ["codigo" => 1, "nombre" => "Juan Pérez", "telefono" => "524142432", "email" => "juanp@ieselcaminas.org"],

        ["codigo" => 2, "nombre" => "Ana López", "telefono" => "58958448", "email" => "anita@ieselcaminas.org"],

        ["codigo" => 3, "nombre" => "Mario Montero", "telefono" => "5326824", "email" => "mario.mont@ieselcaminas.org"],

        ["codigo" => 4, "nombre" => "Laura Martínez", "telefono" => "42898966", "email" => "lm2000@ieselcaminas.org"],

        ["codigo" => 5, "nombre" => "Nora Jover", "telefono" => "54565859", "email" => "norajover@ieselcaminas.org"]

    ];    

    public function get()

    {

        return $this->contactos;

    }

}

?>