<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace JS\ImportsBundle\Controller;

use Application\Sonata\UserBundle\Entity\User;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

/**
 * Description of LumenController
 *
 * @author Jose
 */
class JSController extends Controller
{
    /**
     * Genera un response de tipo json.
     * 
     * @param array $data
     * @param integer $status
     * @param array $headers
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function renderJson($data, $status = 200, $headers = array())
    {
        // fake content-type so browser does not show the download popup when this
        // response is rendered through an iframe (used by the jquery.form.js plugin)
        //  => don't know yet if it is the best solution
        if ($this->get('request')->get('_xml_http_request')
            && strpos($this->get('request')->headers->get('Content-Type'), 'multipart/form-data') === 0) {
            $headers['Content-Type'] = 'text/plain';
        } else {
            $headers['Content-Type'] = 'application/json';
        }
        
        return new Response(json_encode($data), $status, $headers);
    }
    
    /**
     * Convierte el objeto en un string JSON
     * @param User $user
     * @return string JSON
     */
    protected function serializeUserObject($object, array $ignore = array())
    {
        $normalizer = new \Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer();
        $normalizer->setIgnoredAttributes($ignore);
        $encoder = new \Symfony\Component\Serializer\Encoder\JsonEncoder();
        $serializer = new \Symfony\Component\Serializer\Serializer(array($normalizer), array($encoder));

        return $serializer->serialize($object, 'json');
    }
    /* @return EntityManager **/
    protected function getEntityManager(){
        return $this->getDoctrine()->getManager();
    }
}
