<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Application\Sonata\UserBundle\Services;

use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Router;

/**
 * Description of LoginSuccessHandler
 *
 * @author leonardo
 */
class LoginSuccessHandler implements AuthenticationSuccessHandlerInterface
{
    protected $router;
    protected $security;
    
    public function __construct(SecurityContext $security, Router $router)
    {
        $this->router   = $router;
        $this->security = $security;
    }
    
    public function onAuthenticationSuccess(Request $request, TokenInterface $token)
    {
//        if ($this->security->isGranted('ROLE_MEDICO') || $this->security->isGranted('ROLE_ESPECIALISTA'))
//        {
//            $response = new RedirectResponse($this->router->generate('profile_search'));            
//        }
//        elseif ($this->security->isGranted('ROLE_PACIENTE'))
//        {
//            $response = new RedirectResponse($this->router->generate('my_profile'));
//        }
//        elseif ($this->security->isGranted('ROLE_USER'))
//        {
//            // redirect the user to where they were before the login process begun.
//            $referer_url = $request->headers->get('referer');
//                        
//            $response = new RedirectResponse($referer_url);
//        }
        // redirect the user to where they were before the login process begun.
        $referer_url = $request->get('_target_path', '/');
        
        if(!is_null($token->getUser()->getLocale()) || ctype_space(trim($token->getUser()->getLocale())))
        {
            $referer_url = $this->router->generate($request->get('_target_route', 'dates'), array('_locale' => $token->getUser()->getLocale()));
        }
        
        $response    = new RedirectResponse($referer_url);

        return $response;
    }

}
