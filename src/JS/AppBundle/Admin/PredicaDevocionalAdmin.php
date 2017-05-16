<?php

namespace JS\AppBundle\Admin;

use JS\AppBundle\Entity\PredicaDevocional;
use JS\AppBundle\Entity\PredicaDevocionalRepository;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class PredicaDevocionalAdmin extends Admin
{


    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('nombre')
            ->add('descripcion')
            ->add('fechaInicio')
            ->add('fechaFinal')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('nombre')
            ->add('descripcion',null, ['label'=> 'Descripción'])
            ->add('fechaInicio')
            ->add('fechaFinal')
            ->add('createdAt',null,['label'=> 'Creado'])
            ->add('updatedAt', null, ['label'=> 'Última actualización'])
            ->add('_action', 'Acciones', array(
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
        $formMapper
            ->add('nombre')
            ->add('descripcion', 'ckeditor')
            ->add('fechaInicio', 'sonata_type_date_picker', array(
                'format'                => 'dd/MM/yyyy',
                'dp_use_current'        => false,
            ))
            ->add('fechaFinal', 'sonata_type_date_picker', array(
                'format'                => 'dd/MM/yyyy',
                'dp_use_current'        => false,
            ))
            ->add('semana', 'choice', [
                'choices' => PredicaDevocionalRepository::$semanas
            ])

        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('nombre')
            ->add('descripcion')
            ->add('fechaInicio')
            ->add('fechaFinal')
            ->add('createdAt')
            ->add('updatedAt')
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function preUpdate($object)
    {
        $this->updateSlug($object);
    }

    /**
     * {@inheritdoc}
     */
    public function updateSlug(PredicaDevocional $object)
    {
        $object->setSlug($this->urlize($object->getNombre()));
    }

    /**
     * {@inheritdoc}
     */
    public function prePersist($object)
    {
        $this->updateSlug($object);
    }
}
