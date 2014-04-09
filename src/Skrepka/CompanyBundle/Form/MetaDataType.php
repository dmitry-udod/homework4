<?php

namespace Skrepka\CompanyBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class MetaDataType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('metaKeywords', 'text',  [
                'required' => false,
                'label' => 'form.metaKeywords',
            ])
            ->add('metaDescription', 'textarea', [
                'required' => false,
                'label' => 'form.metaDescription',
            ])
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Skrepka\CompanyBundle\Document\MetaData'
        ));
    }

    public function getName()
    {
        return 'metadata';
    }
}
