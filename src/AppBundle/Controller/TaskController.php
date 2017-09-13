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
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;




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

       /* $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

        	$em = $this->getDoctrine()->getManager();
            $em->persist($task);
            $em->flush();

            $this->addFlash('success', 'Task successfully registered!');
            
            return $this->redirectToRoute('tasks');

        }*/
		return $this->render('task\task.html.twig', 
			array('form' => $form->createView(),

		));

	}
    
    /*
     * @Route("/save_task", name="save_task")
     * @Method("POST")
     */
	public function saveAction(Request $request)
	{
      

      $data = $request->get('data');
     
     echo "<pre>";print_r($data);

	}

    /**
	 * @Route("/affichTasks", name="tasks")
	 *
	 */
	public function affichTasks(Request $request)
	{
		$repository = $this->getDoctrine()->getRepository('AppBundle:Task');
		$tasks = $repository->findAll();

		return $this->render('task\affichTasks.html.twig', array(
                'tasks' => $tasks,
			));

	}

    /**
     * @Route("/tasks/active_task/{id}/{active}", name="active_task")
     * @Method("GET")
     *
     */
	public function active_task($id, $active)
	{
		
		$active_value = $active == 1 ? 0 : 1;

		//echo $active_value;exit;

		$em = $this->getDoctrine()->getManager();
		$task = $em->getRepository(Task::class)->find($id);

		$task->setTaskActive($active_value);
		$em->flush();
		//echo "<pre>";print_r($task);exit;
		return $this->redirectToRoute('tasks');
	  
	}


    /**
	 * @Route("/tasks/update/{id}", name="tasks_edit", requirements={"id": "\d+"})
	 * @ParamConverter("id", class="AppBundle:Task")
	 *
	 */
	public function editAction(Request $request, Task $task)
	{

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

		$form_edit = $this->createFormBuilder($task)
		   ->add('task_nom', TextType::class)
		   ->add('url', ChoiceType::class,  array('choices' => $routes_array
		   	)) 
		   ->add('description', TextareaType::class)
		   ->add('task_active', CheckboxType::class)
		   ->add('save', SubmitType::class, array('label' => 'edit'))
           ->getForm();

        $form_edit->handleRequest($request);

        if($form_edit->isSubmitted() && $form_edit->isValid())
        {

           $em = $this->getDoctrine()->getManager();
           $em->persist($task);
           $em->flush();


           $this->addFlash('success', 'Task successfully updated!');
           
           return $this->redirectToRoute('tasks');

        }
        
        return $this->render('task\task.html.twig', 
        	array('form' => $form_edit->createView()
        	
        ));
	} 


}