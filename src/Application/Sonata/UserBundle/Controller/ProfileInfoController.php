<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Application\Sonata\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use JMS\SecurityExtraBundle\Annotation\Secure;

/**
 * Description of profileInfo
 *
 * @author leonardo
 */
class profileInfoController extends Controller
{
    /**
     * @Route("/avatar-profile", name="avatar_profile")
     */
    public function getAvatarProfileAction()
    {
        $securityContext = $this->container->get('security.context');
        
        if ($securityContext->isGranted('IS_AUTHENTICATED_FULLY'))
        {
            $usuario = $this->getUser();
            return $this->render('ApplicationSonataUserBundle:Helpers:profileAvatar.html.twig', array('usuario' => $usuario));
        }
        
        return $this->render('ApplicationSonataUserBundle:Helpers:empty.html.twig');
    }
}
