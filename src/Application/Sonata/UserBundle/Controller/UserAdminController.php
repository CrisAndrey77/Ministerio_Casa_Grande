<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Application\Sonata\UserBundle\Controller;

use Sonata\AdminBundle\Controller\CRUDController as Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Application\Sonata\UserBundle\Resources\Utils\ExcelImporter;
/**
 * Description of UserAdminController
 *
 * @author leonardo
 */
class UserAdminController extends Controller
{
    public function listAction()
    {
       // $twig = $this->container->get('lumen.twig.load_javascrip')->include_javascript('../bundles/lumendate/js/src/users-import.js');
        
        return parent::listAction();
    }
    
    /**
     * @Route("/import-users", name="import_users", options={"expose"=true})
     */
    public function importUsersAction()
    {
        $form = $this->createForm(new \Application\Sonata\UserBundle\Form\Type\ImportUsersFormType(), new \Application\Sonata\UserBundle\Resources\Utils\FileUpload());
        return $this->render("ApplicationSonataUserBundle:Admin:importUsers.html.twig", array(
            'action'      => 'Items List',
            'form'  => $form->createView()
        ));
    }
    
    /**
     * @Route("/execute-user-import-excel", name="execute_user_import_excel", options={"expose"=true})
     */
    public function executeUserImportExcelAction(\Symfony\Component\HttpFoundation\Request $request)
    {
        if($this->getRequest()->isMethod('POST'))
        {
            $file = new \Application\Sonata\UserBundle\Resources\Utils\FileUpload();
            $form = $this->createForm(new \Application\Sonata\UserBundle\Form\Type\ImportUsersFormType(), $file);
            $form->submit($this->getRequest());
            if($form->isValid())
            {
                $this->data = $request->get('user_excel');
                $file->preUpload();
                $file->upload();
                $filePath       = $this->get('kernel')->getRootDir() . '/../web/' . $file->getWebPath();
                $grupoRepo      = $this->getDoctrine()->getManager()->getRepository("ApplicationSonataUserBundle:Group");
                $this->grupo    = $grupoRepo->getGrupoUsuarioPorTipoUsuario('Medico');
                $this->userRepo = $this->getDoctrine()->getRepository('ApplicationSonataUserBundle:User');
                $this->password = "";
                $excelImporter  = new ExcelImporter(
                        $this->getDoctrine(), $filePath, array(), true, 
                        'Application\Sonata\UserBundle\Entity\User', true,
                        function($obj, $sender){
                            $sender->password = \Lumen\ImportsBundle\Resources\LumenUtils\Utils::generatePassword(6);
                            //$this->password = '1234';
                            $obj->setPassword($sender->password);
                            $obj->setPlainPassword($sender->password);
                            $obj->setEnabled(true);
                            $obj->setTypeUser($sender->data['user_type']);
                            $obj->addRole(($sender->data['user_type'] == 'Buyer') ? 'ROLE_BUYER':'ROLE_SELLER');
                        }, function($obj, $sender){
                            $user = $sender->userRepo->findOneBy(array('email' => $obj->getEmail()));
                            if($user)
                                return false;                            
                            return true;
                        },function($obj, $sender){
                            $sender->userRepo->sendRegistrationNotificationForUser($sender->getContainer(), $obj, $sender->password);
                        },
                         null,
                         $this
                        );
                $result = $excelImporter->procesarExcel();
                
                if($result === true)
                    return $this->renderJson (array('msn' => 'OK', 'info' => array( 'numero_items'     => $excelImporter->getNumeroRows(), 
                                                                                    'items_procesados' => $excelImporter->getItemsProcesados())));
                return $this->renderJson(array('msn' => 'ERROR', 'info' => $excelImporter->getHumanErrorMessage($result)));
            }
            
            $partial = $this->renderView("ApplicationSonataUserBundle:Admin:_import_users_form.html.twig", array(
                        'form' => $form->createView()
            ));
            
            return $this->renderJson(array('msn' => 'FORM_ERROR', 'info' => $partial));
        }
    }
    
    public function getContainer()
    {
        return $this->container;
    }
}
