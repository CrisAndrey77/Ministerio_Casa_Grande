<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Application\Sonata\UserBundle\Twig\Extension;

use Symfony\Component\Security\Core\SecurityContext;

/**
 * Description of userAvatarExtension
 *
 * @author leonardo
 */
class UserAvatarExtension extends \Twig_Extension
{
    private $security_context;
    private $twig;
    
    public function __construct(SecurityContext $context, \Twig_Environment $twig)
    {
        $this->security_context = $context;
        $this->twig             = $twig;
    }
    
    public function getFunctions()
    {
        return array(
            'getAvatarProfile'     => new \Twig_Function_Method($this, 'getAvatarProfile', array(
                                                                                            'is_safe' => array('html')
            ))
        );
    }
    
    public function getUser()
    {
        return $this->security_context->getToken()->getUser();
    }
    
    public function renderView($template, array $params)
    {
        return $this->twig->render($template, $params);
    }
    
    public function getAvatarProfile($template = 'ApplicationSonataUserBundle:Helpers:profileAvatar.html.twig')
    {
       if (!$this->security_context->isGranted('IS_AUTHENTICATED_FULLY'))
           return '';
       
        return $this->renderView($template, array('usuario' => $this->getUser()));
    }
    
    public function getName()
    {
        return 'user_avatar';
    }
}
