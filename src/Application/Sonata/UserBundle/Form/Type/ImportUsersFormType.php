<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Application\Sonata\UserBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Description of MedicoExcelFormType
 *
 * @author leonardo
 */
class ImportUsersFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('file')
                ->add('user_type', 'choice', array('choices' => array('Buyer' => 'Buyer', 'Seller' => 'Seller'), 'mapped' => false));
    }
    
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Application\Sonata\UserBundle\Resources\Utils\FileUpload'
        ));
    }
    
    public function getName()
    {
        return 'user_excel';
    }

}
