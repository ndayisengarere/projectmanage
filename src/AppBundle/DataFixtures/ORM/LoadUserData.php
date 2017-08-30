<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\User;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LoadUserData implements FixtureInterface, ContainerAwareInterface
{ 
    private $container;

    
    /**
     * Load Data fixtures with the passed EntityManage
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setUsername('admin');
        $user->setPassword('admin');

        $manager->persist($user);
        $manager->flush();
    }



     /**
      * Sets the container.
      *
      * @param ContainerInterface|null $container A ContainerInterface instance or null
      */
    public function setContainer(ContainerInterface $container = null)
    {

     $this->container = $container;

    }
}