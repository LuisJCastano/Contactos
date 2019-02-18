<?php
namespace App\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
class LoginController extends AbstractController
{
    /**
     * @Route("/login", name="login")
     */
    public function login(AuthenticationUtils $authenticationUtils)
    {
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();
        return $this->render('contact/login.html.twig', array(
            'error' => $error,
            'lastUsername' => $lastUsername
        ));
    }
    /**
    * @Route("/admin", name="admin")
    */
        public function admin() {
            $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
            $usuario = $this->getUser();
            return new Response("Bienvenido a /admin, " . $usuario->getUserName());
        }
}