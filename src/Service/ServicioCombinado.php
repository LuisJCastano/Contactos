<?php
namespace App\Service;

use Psr\Log\LoggerInterface;

use App\Service\BDPrueba;

class ServicioCombinado

{

    private $contactos;

    private $logger;

    public function __construct(BDPrueba $datos, LoggerInterface $logger) {

        $this->contactos = $datos->get();

        $this->logger = $logger;

    }

    // Definir getters o métodos para acceder a lo que nos interese

}