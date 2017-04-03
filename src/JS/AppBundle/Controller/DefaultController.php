<?php

namespace JS\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class DefaultController extends Controller
{
    /**
     * @Route("/" , name="index")
     */
    public function indexAction()
    {
        return $this->render('JSAppBundle:Default:index.html.twig', []);
    }

    /**
     * @Route("/predicas", name="predicas")
     */
    public function predicasAction()
    {

        return $this->render('JSAppBundle:Default:predicas.html.twig', []);
    }

    /**
     * @Route("/devocionales", name="devocionales")
     */
    public function devocionalesAction()
    {

        return $this->render('JSAppBundle:Default:devocionales.html.twig', []);
    }


    /**
     * @Route("/galerias", name="galerias")
     */
    public function galeriasAction()
    {
        return $this->render('JSAppBundle:Default:galerias.html.twig', []);
    }

    /**
     * @Route("/asidice", name="asidice")
     */
    public function asidiceAction()
    {
        return $this->render('JSAppBundle:Default:asidice.html.twig', []);
    }

    /**
     * @Route("/contactenos", name="contactenos")
     */
    public function contactenosAction()
    {
        return $this->render('JSAppBundle:Default:contactenos.html.twig', []);
    }

}