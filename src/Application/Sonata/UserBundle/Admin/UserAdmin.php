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
        $user = $this->getSubject();

        $formMapper
            ->tab('General')
                ->with('General', ['class' => 'col-xs-12 col-sm-6 col-md-6 col-lg-6'])
                    ->add('username')
                    ->add('email')
                    ->add('plainPassword', 'text', array(
                        'required' => ( !$this->getSubject() || is_null($this->getSubject()->getId()) )
                    ))
                    ->add('enabled', null, array( 'required' => false ))
                ->end()
                ->with('Groups', ['class' => 'col-xs-12 col-sm-6 col-md-6 col-lg-6'])
                    ->add('groups', 'sonata_type_model', array(
                        'required' => false,
                        'expanded' => true,
                        'multiple' => true,
                        'btn_add'  => false
                    ))
                ->end()
            ->end()
        ;


    }

    protected function configureListFields(\Sonata\AdminBundle\Datagrid\ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('username')
            ->add('email')
            ->add('groups')
            ->add('enabled', null, array('editable' => true))
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getNewInstance()
    {
        /** @var $object User */
        $object = $this->getModelManager()->getModelInstance($this->getClass());
        foreach ($this->getExtensions() as $extension) {
            $extension->alterNewInstance($this, $object);
        }
        $object->setEnabled(true);
        return $object;
    }
}
