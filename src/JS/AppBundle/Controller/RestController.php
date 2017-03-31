<?php 
namespace JS\AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;;

class RestController 
{
	/**
     * @Rest\Get("/get/algo", name="get_algo")
     * @Rest\View()
     */
    public function getAlgoAction(Request $request)
    {

        return array('test' => 'test');
    }

	
}