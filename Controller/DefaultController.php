<?php

/**
 * Copyright 2011 Massimo Giagnoni <gimassimo@gmail.com>
 *
 * This source file is subject to the MIT license included
 * with this source code (Resources/meta/LICENSE).
 */

namespace FooApps\HelloBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    /*
     * Shows all friends
     */
    public function indexAction()
    {
        $em = $this->get('doctrine.orm.entity_manager');
        $friends = $em->getRepository('FooApps\HelloBundle\Entity\Friend')->findAll();

        return $this->render('FooAppsHelloBundle:Default:index.html.twig', array(
            'friends' => $friends,
        ));
    }

    /**
     * Says 'Hello!'
     */
    public function helloAction($name)
    {
        $em = $this->get('doctrine.orm.entity_manager');
        $friend = $em->getRepository('FooApps\HelloBundle\Entity\Friend')
            ->findOneBy(array('name' => $name));

        return $this->render('FooAppsHelloBundle:Default:hello.html.twig', array(
            'friend' => $friend,
            'name' => $name
        ));
    }
}
