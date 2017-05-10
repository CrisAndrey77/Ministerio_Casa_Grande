<?php

namespace JS\AppBundle\Controller;

use JS\AppBundle\Entity\Contacto;
use JS\AppBundle\Form\ContactoType;
use JS\ImportsBundle\Controller\JSController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

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
        $predicas = $this->getEntityManager()->getRepository('JSAppBundle:CategoriaPredica')->findBy([], [ 'nombre' => 'DESC' ]);

        return $this->render('JSAppBundle:Default:predicas.html.twig', [ 'categorias' => $predicas ]);
    }

    /**
     * @Route("/predicas/{categoria}", name="predica_categoria")
     */
    public function predicaCategoriaAction($categoria)
    {
        $categoria = $this->getEntityManager()->getRepository('JSAppBundle:CategoriaPredica')->findOneBy([ 'slug' => $categoria ]);

        return $this->render('JSAppBundle:Default:predicaCategoria.html.twig', [ 'categoria' => $categoria ]);
    }


    /**
     * @Route("/predicas/{categoria}/{detalle}", name="predica_detalle")
     */
    public function predicaDetalleAction($categoria, $detalle)
    {
        $predica = $this->getEntityManager()->getRepository('JSAppBundle:Predica')->findOneBy([ 'slug' => $detalle ]);

        return $this->render('JSAppBundle:Default:predicaDetalle.html.twig', [ 'predica' => $predica ]);
    }


    /**
     * @Route("/devocionales", name="devocionales")
     */
    public function devocionalesAction()
    {
        $devocionales = $this->getEntityManager()->getRepository('JSAppBundle:PredicaDevocional')->getDevocionales();

        return $this->render('JSAppBundle:Default:devocionales.html.twig', [ 'devocionales' => $devocionales ]);
    }


    /**
     * @Route("/galerias", name="galerias")
     */
    public function galeriasAction()
    {
        $galerias = $this->getEntityManager()->getRepository('JSAppBundle:Galeria')->getGalerias();

        return $this->render('JSAppBundle:Default:galerias.html.twig', [ 'galerias' => $galerias ]);
    }

    /**
     * @Route("/asidice", name="asidice")
     */
    public function asidiceAction()
    {
        $predicas = $this->getEntityManager()->getRepository('JSAppBundle:Asidice')->findBy([], []);

        return $this->render('JSAppBundle:Default:asidice.html.twig', [ 'predicas' => $predicas ]);
    }

    /**
     * @Route("/asidice/{asidice}", name="asidice_Detalle")
     */
    public function asidiceDetalle($asidice)
    {
        $predica = $this->getEntityManager()->getRepository('JSAppBundle:Asidice')->findOneBy([ 'slug' => $asidice ]);

        return $this->render('JSAppBundle:Default:predicaDetalle.html.twig', [ 'predica' => $predica ]);
    }

    /**
     * @Route("/contactenos", name="contactenos")
     */
    public function contactenosAction()
    {
        $form = $this->createForm(new ContactoType(), null, [
            'method' => 'POST',
            'action' => $this->generateUrl('contactenos_save')
        ]);

        return $this->render('JSAppBundle:Default:contactenos.html.twig', []);
    }

    /**
     * @Route("/contactenos/save", name="contactenos_save")
     * @Method("POST")
     */
    public function saveContact(Request $request)
    {
        $contact = new Contacto();
        $form    = $this->createForm(new ContactoType(), $contact, [
            'method' => 'POST',
            'action' => $this->generateUrl('contactenos_save')
        ]);
        $form->handleRequest($request);
        if ($form->isValid()) {
            return $this->renderJson([]);
        }

        return $this->renderJson([]);
    }

}