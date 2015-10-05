<?php

namespace Hispavista\WebBundle\Controller;

use Hispavista\ContactFormBundle\Controller\ContactController as BaseContactController;

class ContactController extends BaseContactController
{
    public function indexAction()
    {
        return $this->proccessForm();
    }
    
    protected function getHtmlResponse(\Symfony\Component\Form\Form $form){
        return $this->render('HispavistaWebBundle::contact.html.twig', array(
                'form' => $form->createView()
        ));
    }
}
