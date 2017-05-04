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
        $devocionales = $this->getEntityManager()->getRepository('JSAppBundle:PredicaDevocional')->getDevocionales();

        return $this->render('JSAppBundle:Default:devocionales.html.twig', ['devocionales' => $devocionales]);
    }


    /**
     * @Route("/galerias", name="galerias")
     */
    public function galeriasAction()
    {
        $galerias = $this->getEntityManager()->getRepository('JSAppBundle:Galeria')->getGalerias();
        return $this->render('JSAppBundle:Default:galerias.html.twig', ['galerias' => $galerias]);
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