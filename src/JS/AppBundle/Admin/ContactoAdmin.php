<?php

namespace JS\AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Route\RouteCollection;

class ContactoAdmin extends Admin
{
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper

            ->add('nombre')
            ->add('correo')
            ->add('mensaje')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('telefono')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper

            ->add('nombre')
            ->add('correo')
            ->add('mensaje')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('telefono')
            ->add('_action', 'actions', array(
                'actions' => array(
                    'show' => array(),
                    'edit' => array(),
                    'delete' => array(),
                )
            ))
        ;
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
//        $formMapper
//            ->add('id')
//            ->add('nombre')
//            ->add('correo')
//            ->add('mensaje')
//            ->add('createdAt')
//            ->add('updatedAt')
//            ->add('telefono')
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('nombre')
            ->add('correo')
            ->add('mensaje')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('telefono')
        ;
    }
    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->remove('create');
    }
}
