<?php

namespace App\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Psr\Log\LoggerInterface;

class InicioController extends Controller 
{
    private $logger;
    private $formatoFecha;

    public function __construct(LoggerInterface $logger, $formatoFecha)
    {
        $this->logger = $logger;
        $this->formatoFecha = $formatoFecha;
    }

    /**
     * @Route("/", name = "inicio")
     */

     public function inicio()
     {
        $fecha_hora = new \DateTime();
        $this->logger->info("Acceso el " . $fecha_hora->format("d/m/Y H:i:s"));
        return $this->render('inicio.html.twig');
     }
    
}
