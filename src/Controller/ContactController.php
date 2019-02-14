<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use App\Service\BDPrueba;
use App\Entity\Contacto;
use App\Entity\Provincia;
use Symfony\Component\Form\Extension\Core\Type\TextType;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Symfony\Component\Form\Extension\Core\Type\EmailType;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use App\Form\ContactoType;


class ContactController extends AbstractController

{

    private $contactos;

    public function __construct(BDPrueba $datos)
    {
        $this->contactos = $datos->get();
    }

    /**
     * @Route("/contacto/insertar", name="insertar_contacto")
     */
    public function insertar()
    {
        $entityManager = $this->getDoctrine()->getManager();
        
        $provincia = new Provincia();

        $provincia->setNombre("Alicante");
        $contacto = new Contacto();
        
        $contacto->setNombre("Inserción de prueba con provincia");
        $contacto->setTelefono("900220022");
        $contacto->setEmail("insercion.de.prueba.provincia@contacto.es");
        $contacto->setProvincia($provincia);
        
        $entityManager->persist($provincia);
        $entityManager->persist($contacto);
        try
        {
            $entityManager->flush();
            return new Response("Contacto insertado con id " . $contacto->getId());
        } catch (\Exception $e) {
            return new Response($e);
        }        
    }
/**

 * @Route("/contacto/nuevo", name="nuevo_contacto")

 */

public function nuevo(Request $request)

{

    $contacto = new Contacto();

    $formulario = $this->createFormBuilder($contacto)

        ->add('nombre', TextType::class)

        ->add('telefono', TextType::class)

        ->add('email', EmailType::class)

        ->add('provincia', EntityType::class, array(

            'class' => Provincia::class,

            'choice_label' => 'nombre',))

        ->add('save', SubmitType::class, array('label' => 'Enviar'))

        ->getForm();

    $formulario->handleRequest($request);

    if ($formulario->isSubmitted() && $formulario->isValid()) {

        $contacto = $formulario->getData();

        $entityManager = $this->getDoctrine()->getManager();

        $entityManager->persist($contacto);

        $entityManager->flush();

        return $this->redirectToRoute('inicio');

    }

    return $this->render('contact/nuevo.html.twig', array(

        'formulario' => $formulario->createView()

    ));

}

/**

 * @Route("/contacto/editar/{codigo}", name="editar_contacto", requirements={"codigo"="\d+"})

 */

public function editar(Request $request, $codigo)

{

    $repositorio = $this->getDoctrine()->getRepository(Contacto::class);

    $contacto = $repositorio->find($codigo);

    $formulario = $this->createForm(ContactoType::class, $contacto);

    

    $formulario->handleRequest($request);

    if ($formulario->isSubmitted() && $formulario->isValid())

    {

        $contacto = $formulario->getData();

        $entityManager = $this->getDoctrine()->getManager();

        $entityManager->persist($contacto);

        $entityManager->flush();    

        return $this->redirectToRoute('inicio');

    }

    

    return $this->render('contact/nuevo.html.twig', array(

        'formulario' => $formulario->createView()

    ));

}



    /**
     * @Route("/contacto/actualizar", name="actualizar_contacto")
     */

    public function actualizar()
    {
        $entityManager = $this->getDoctrine()->getManager();
        $repositorio = $this->getDoctrine()->getRepository(Contacto::class);
        $contacto = $repositorio->find(1);
        if ($contacto)
        {
            $contacto->setNombre("hola");
            $entityManager->flush();
        }
            return new Response("Contacto modificado");
    }

     /**
     * @Route("/contacto/borrar", name="borrar_contacto")
     */

    public function borrar()
    {
        $entityManager = $this->getDoctrine()->getManager();
        $repositorio = $this->getDoctrine()->getRepository(Contacto::class);
        $contacto = $repositorio->find(2);
        if ($contacto)
        {
            $entityManager->remove($contacto);
            $entityManager->flush();
        }
            return new Response("Contacto borrado");
    }
    /**
     * @Route("/contacto/{id}", name="ficha_contacto", requirements={"id"="\d+"})
     */

    public function ficha(Contacto $contacto)
    {
        if ($contacto)
            return $this->render('contact/ficha_contacto.html.twig', [
                'contacto' => $contacto
            ]);
    }

    /**
     * @Route("/contacto/{texto}", name="buscar_contacto")
     */
    public function buscar($texto)
    {
        $repositorio = $this->getDoctrine()->getRepository(Contacto::class);
        $resultado = $repositorio->findByName($texto);

        return $this->render('contact/lista_contacto.html.twig', array(
            'contactos' => $resultado
        ));
    }

   
}
  