<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Application\Sonata\UserBundle\Admin;

//use Sonata\AdminBundle\Admin\Admin;
use Sonata\UserBundle\Admin\Model\UserAdmin as SonataUserAdmin;
// use Sonata\AdminBundle\Admin\Admin;
use Sonata\UserBundle\Model\UserInterface;
use FOS\UserBundle\Model\UserManagerInterface;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Application\Sonata\UserBundle\Entity\UserRepository;
use Application\Sonata\UserBundle\Entity\User;
use Doctrine\ORM\EntityRepository;

/**
 * Description of UserAdmin
 *
 * @author
 */
class UserAdmin extends SonataUserAdmin
{   
    public function configureFormFields(FormMapper $formMapper)
    {
    	$image = $this->getSubject();
        $fileFieldOptions = array();
        $fileFieldOptions['required'] = false;
        $fileFieldOptions['label'] = 'Foto';

        if ($image && ($webPath = $image->getWebPath())) {
            // get the container so the full path to the image can be set
            $container = $this->getConfigurationPool()->getContainer();
            $fullPath = '/' . $webPath;
            if ($image->getWebPath() != '') {
                // add a 'help' option containing the preview's img tag
                $fileFieldOptions['help'] = '<img src="' . $fullPath . '" alt="imagen" width="150" /a>';
            }
        }
        parent::configureFormFields($formMapper);
        $formMapper->add('dateOfBirth','sonata_type_date_picker',[
                                        'format'        => 'dd/MM/yyyy',
                                        'dp_use_current'=> false,
        ]);
        $formMapper->add('file','file', $fileFieldOptions);        
    }
    
    protected function configureListFields(\Sonata\AdminBundle\Datagrid\ListMapper $listMapper)
    {
        parent::configureListFields($listMapper);
    }
}
