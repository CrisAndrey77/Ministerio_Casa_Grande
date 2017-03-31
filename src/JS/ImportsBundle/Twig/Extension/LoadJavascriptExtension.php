<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace JS\ImportsBundle\Twig\Extension;

/**
 * Description of LoadJavascript
 *
 * @author Jose
 */
class LoadJavascriptExtension extends \Twig_Extension
{
    private $session;
    
    public function __construct($session)
    {
        $this->session = $session;
    }
    
    public function getFunctions()
    {
        return array(
            'include_javascript' => new \Twig_Function_Method($this, 'include_javascript'),
            'getJavascripts'     => new \Twig_Function_Method($this, 'getJavascripts', array(
                                                                                            'is_safe' => array('html'))),
            'include_stylesheet' => new \Twig_Function_Method($this, 'include_stylesheet'),
            'getStylesheet'      => new \Twig_Function_Method($this, 'getStylesheet', array(
                                                                                            'is_safe' => array('html'))),
        );
    }
    
    public function include_javascript($source)
    {
        $javascripts          = $this->session->get('js_sources', array());
        $javascripts[$source] = $source;
        $this->session->set('js_sources', $javascripts);
    }
    
    public function getJavascripts()
    {
        $javascripts = $this->session->get('js_sources', array());
        $string      = '';
        
        foreach ($javascripts as $key => $javascript)
        {
            $string .= '<script src="/js/'. $javascript .'""></script>';
        }
        
        $this->session->remove('js_sources');
        $this->session->set('js_sources', array());
        
        return $string;
    }
    
    public function include_stylesheet($source)
    {
        $stylesheet          = $this->session->get('css_sources', array());
        $stylesheet[$source] = $source;
        $this->session->set('css_sources', $stylesheet);
    }
    
    public function getStylesheet()
    {
        $stylesheets = $this->session->get('css_sources', array());
        $string      = '';
        
        foreach ($stylesheets as $key => $stylesheet)
        {
            $string .= '<link rel="stylesheet" href="/css/'.$stylesheet.'" />';
        }
        
        $this->session->remove('css_sources');
        $this->session->set('css_sources', array());
        
        return $string;
    }
    
    public function getName()
    {
        return 'load_javascrip';
    }

}
