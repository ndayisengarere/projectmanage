<?php

namespace AppBundle\Controller;


use AppBundle\Entity\Task;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FormType; 



class TaskController extends Controller
{
	/**
	 * @Route("/task", name="task")
	 *
	 * @return array
	 */
	public function addAction(Request $request)
	{

		$task = new Task();

		$router = $this->get('router');
	    $routes = $router->getRouteCollection();
	    $routes_array = array();
	    //echo "<pre>";
	    $routes_array['Select ...'] = '0';
	    foreach ($routes as $key => $value) {
	    	if(strpos($value->getPath(),'/_') === false) {
	    		$routes_array[$value->getPath()] = $value->getPath();
	    	}
	    }//exit;
	   // echo"<pre>";print_r($value->getPath());exit;

		$form = $this->createFormBuilder($task)
		   ->add('task_nom', TextType::class)
		   ->add('url', ChoiceType::class,  array('choices' => $routes_array
		   	)) 
		   ->add('description', TextareaType::class)
		   ->add('task_active', CheckboxType::class)
		   ->add('save', SubmitType::class)
           ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

        	$em = $this->getDoctrine()->getManager();
            $em->persist($task);
            $em->flush();

            //$request->addFlash('success', 'You are now successfully registered!');


        }
		return $this->render('task\task.html.twig', 
			array('form' => $form->createView(),

		));

	}


}