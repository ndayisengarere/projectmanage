<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class SecurityController extends Controller
{
    /**
     * @Route("/login", name="login")
     */
    public function loginAction(Request $request)
    {

    	$authenticationUtils = $this->get('security.authentication_utils');

    	$error = $authenticationUtils->getLastAuthenticationError();

    	$lastUserName = $authenticationUtils->getLastUsername();
       
        return $this->render('security/login.html.twig',[
              'lastusername' => $lastUserName,
              'error' => $error,

        	]);
    }


    /**
     * @Route("/logout", name="logout")
     */
    public function logoutAction()
    {

    }
}