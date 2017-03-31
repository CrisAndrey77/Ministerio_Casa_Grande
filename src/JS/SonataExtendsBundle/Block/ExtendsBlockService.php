<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace JS\SonataExtendsBundle\Block;

use Sonata\BlockBundle\Block\BaseBlockService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Sonata\BlockBundle\Model\BlockInterface;
use Sonata\BlockBundle\Block\BlockContextInterface;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Validator\ErrorElement;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Description of ExtendsBlockService
 *
 * @author leonardo
 */
class ExtendsBlockService extends BaseBlockService
{
    private $container;
    
    public function __construct(ContainerInterface $container, $name, \Symfony\Bundle\FrameworkBundle\Templating\EngineInterface $templating)
    {
        parent::__construct($name, $templating);
        $this->container = $container;
    }
    
    public function get($key)
    {
        return $this->container->get($key);
    }

    public function getName()
    {
        return 'LumenSonataExtends';
    }

    public function setDefaultSettings(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'title'    => 'Lumen Extends Bundle',
            'template' => 'LumenSonataExtendsBundle:Block:admin.html.twig',
        ));
    }
    
    public function execute(BlockContextInterface $blockContext, Response $response = null) 
    {
        $options = $this->container->getParameter('lumen_sonata_extends');
        
        return $this->renderPrivateResponse($blockContext->getTemplate(), array(
                'block' => $blockContext->getBlock(),
                'context' => $blockContext,
                'groups'   => $options['config']['groups'],
            ), $response);
    }
    
    

}
