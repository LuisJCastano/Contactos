<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Service\BDPrueba;

class ContactController extends AbstractController

{

    private $contactos;

    public function __construct(BDPrueba $datos)
    {
        $this->contactos = $datos->get();
    }

/**

* @Route("/contacto/{codigo}", name="ficha_contacto", requirements={"codigo"="\d+"})

*/
    public function ficha($codigo = 1)
    {
        $resultado = array_filter($this->contactos, function($contacto) use ($codigo){
            return $contacto["codigo"] == $codigo;
        });

        if (count($resultado) > 0) {

            return $this->render('contact/ficha_contacto.html.twig', ['contacto'=>
        array_shift($resultado)]);
        } else {
            return $this->render('contact/ficha_contacto.html.twig',['contacto'=>NULL]);
        }
    }

/**
* @Route("/contacto/{texto}", name="ficha_texto")
*/
    public function buscar($texto)
    {
        $resultado = array_filter($this->contactos, function($contacto) use ($texto){
            return strpos($contacto["nombre"], $texto) !==  FALSE;
        });
        
        return $this->render('contact/lista_contacto.html.twig', ['contactos'=>$resultado]);
    } 
}
 