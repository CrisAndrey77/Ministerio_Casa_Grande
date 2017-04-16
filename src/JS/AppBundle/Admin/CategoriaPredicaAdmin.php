<?php

namespace JS\AppBundle\Admin;

use JS\AppBundle\Entity\CategoriaPredica;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class CategoriaPredicaAdmin extends Admin
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
            ->add('descripcionBreve')
            ->add('descripcion', 'ckeditor')
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
    public function updateSlug(CategoriaPredica $object)
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

