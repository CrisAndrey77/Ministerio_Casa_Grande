<?php

namespace JS\AppBundle\Admin;

use JS\AppBundle\Entity\Predica;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class PredicaAdmin extends Admin
{
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper

            ->add('nombre')
            ->add('descripcion')
            ->add('fecha')

        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper

            ->add('nombre')
            ->add('descripcion',null,['template'=>'JSAppBundle:Admin:textpredica.html.twig'])
            ->add('fecha')
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
        $formMapper
            ->add('nombre')
            ->add('descripcion', 'ckeditor')
            ->add('fecha', 'sonata_type_date_picker', array(
                'format'                => 'dd/MM/yyyy',
                'dp_use_current'        => false,
            ))
            ->add('categoriaPredica')
            ->add('autor')

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
            ->add('fecha')
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
    public function updateSlug(Predica $object)
    {
        $object->setSlug($this->urlize($object->getNombre() . '_' . $object->getCategoriaPredica()?$object->getCategoriaPredica()->getNombre():''));
    }

    /**
     * {@inheritdoc}
     */
    public function prePersist($object)
    {
        $this->updateSlug($object);
    }
}
