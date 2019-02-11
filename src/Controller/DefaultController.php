<?php
// src/Controller/DefaultController.php
namespace App\Controller;

use App\Entity\Task;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends Controller
{
/**
 * @Route("/form", name="form_contacto")
 */
public function new(Request $request)
{
  // just setup a fresh $task object (remove the dummy data)
  $task = new Task();
  $form = $this->createFormBuilder($task)
    ->add('task', TextType::class)
    ->add('dueDate', DateType::class)
    ->add('save', SubmitType::class, array('label' => 'Create Task'))
    ->getForm();
  $form->handleRequest($request);
  if ($form->isSubmitted() && $form->isValid()) {
    // $form->getData() holds the submitted values
    // but, the original `$task` variable has also been updated
    $task = $form->getData();
    // ... perform some action, such as saving the task to the database
    // for example, if Task is a Doctrine entity, save it!
    // $em = $this->getDoctrine()->getManager();
    // $em->persist($task);
    // $em->flush();
    return $this->redirectToRoute('task_success');
  }
  return $this->render('default/new.html.twig', array(
    'form' => $form->createView(),
  ));
}
}