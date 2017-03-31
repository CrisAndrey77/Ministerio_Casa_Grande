<?php

namespace JS\AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class AutorAdmin extends Admin
{
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('nombre')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('nombre')
            ->add('image', 'string', [
                'template' => 'JSAppBundle:Admin:Image_list.html.twig'
            ])
            ->add('createdAt')
            ->add('updatedAt')
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
        $object = $this->getSubject();
        $fileFileFieldOptionsImage             = [];
        $fileFileFieldOptionsImage['required'] = false;
        $fileFileFieldOptionsImage['label']    = 'Foto';
        if (!$object){
            $fileFileFieldOptionsImage['required'] = true;
        }

        if ($object && ($object->getImage())
        ) {
            $fullPath = $object->getImagePath();
            if ($object->getWebPath() != '') {
                $fileFileFieldOptionsImage['help'] = '<img src="' . $fullPath . '" alt="imagen" width="150" /a>';
            }
        }



        $formMapper

            ->add('nombre')
            ->add('file', 'file', $fileFileFieldOptionsImage)

        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('nombre')
            ->add('image')
            ->add('createdAt')
            ->add('updatedAt')
        ;
    }
}
