<?php

namespace JS\AppBundle\Controller;

use JS\ImportsBundle\Controller\JSController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends JSController
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
        $predicas = $this->getEntityManager()->getRepository('JSAppBundle:CategoriaPredica')->findBy([], ['nombre' => 'DESC']);
        return $this->render('JSAppBundle:Default:predicas.html.twig', ['categorias' => $predicas]);
    }

    /**
     * @Route("/predicas/{categoria}", name="predica_categoria")
     */
    public function predicaCategoriaAction($categoria)
    {
        $categoria = $this->getEntityManager()->getRepository('JSAppBundle:CategoriaPredica')->findOneBy(['slug' => $categoria]);
        return $this->render('JSAppBundle:Default:predicaCategoria.html.twig', ['categoria' => $categoria]);
    }


    /**
     * @Route("/predicas/{categoria}/{detalle}", name="predica_detalle")
     */
    public function predicaDetalleAction($categoria, $detalle)
    {
        $predica = $this->getEntityManager()->getRepository('JSAppBundle:Predica')->findOneBy(['slug' => $detalle]);
        return $this->render('JSAppBundle:Default:predicaDetalle.html.twig', ['predica' => $predica]);
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
        $predicas = $this->getEntityManager()->getRepository('JSAppBundle:Asidice')->findBy([],[]);

        return $this->render('JSAppBundle:Default:asidice.html.twig', ['predicas' => $predicas]);
    }

    /**
     * @Route("/contactenos", name="contactenos")
     */
    public function contactenosAction()
    {
        return $this->render('JSAppBundle:Default:contactenos.html.twig', []);
    }

}