<?php

/**
 * Copyright 2011 Massimo Giagnoni <gimassimo@gmail.com>
 *
 * This source file is subject to the MIT license included
 * with this source code (Resources/meta/LICENSE).
 */

namespace FooApps\HelloBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use FooApps\HelloBundle\Entity\Friend;
use FooApps\HelloBundle\Form\FriendForm;

class FriendController extends Controller
{
    /**
     * Shows form to add a new friend
     */
    public function newAction()
    {
        return $this->render('FooAppsHelloBundle:Friend:new.html.twig', array(
            'form' => $this->getForm()
        ));
    }

    /**
     * Shows form to edit a friend
     *
     * @param integer $id
     */
    public function editAction($id)
    {
        return $this->render('FooAppsHelloBundle:Friend:edit.html.twig', array(
            'form' => $this->getForm($id)
        ));
    }

    /**
     * Saves a new friend
     */
    public function createAction()
    {
        $form = $this->getForm();
        if ($this->processForm($form)) {
            return new RedirectResponse($this->generateUrl('friends'));
        }

        return $this->render('FooAppsHelloBundle:Friend:new.html.twig', array(
            'form' => $form
        ));
    }

    /**
     * Updates a friend
     *
     * @param integer $id
     */
    public function updateAction($id)
    {
        $form = $this->getForm($id);

        if ($this->processForm($form)) {
            return new RedirectResponse($this->generateUrl('friends'));
        }

        return $this->render('FooAppsHelloBundle:Friend:edit.html.twig', array(
            'form' => $form
        ));
    }

    protected function getForm($id = null)
    {
        if (null === $id) {
            $friend = new Friend();
        } else {
            $em = $this->get('doctrine.orm.entity_manager');
            $friend = $em->getRepository('FooApps\HelloBundle\Entity\Friend')
                ->findOneBy(array('id' => $id));

            if (!$friend) {
                throw new NotFoundHttpException('Friend does not exist.');
            }
        }

        return FriendForm::create($this->get('form.context'), 'friend', array(
            'data' => $friend
        ));
    }

    protected function processForm($form)
    {
        $form->bind($this->get('request'));
        if ($form->isValid()) {
            $em = $this->get('doctrine.orm.entity_manager');
            $friend = $form->getData();
            $em->persist($friend);
            $em->flush();

            return true;
        }

        return false;
    }
}
