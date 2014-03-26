<?php

namespace Skrepka\CompanyBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CompanyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('description')
            ->add('categories', 'document', [
                'class'     => 'Skrepka\CategoryBundle\Document\Category',
                'multiple'  => false,
                'group_by'  => 'parentName',
                'empty_value'  => 'Select Category',
//                'group_by'  => 'name'
//                'group_by'  => 'Skrepka\CategoryBundle\Document\CategoryRepository:'
            ])
            ->add('city')
            ->add('address')
            ->add('phone')
            ->add('email')
            ->add('site')
            ->add('isActive')
            ->add('lat')
            ->add('long')
            ->add('metaData')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Skrepka\CompanyBundle\Document\Company'
        ));
    }

    public function getName()
    {
        return 'company';
    }
}
