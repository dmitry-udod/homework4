<?php

namespace Skrepka\CompanyBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CompanySettingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('bgColor', 'text',  [
                'required' => false,
                'label' => 'form.bg_color',
            ])
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Skrepka\CompanyBundle\Document\CompanySetting'
        ));
    }

    public function getName()
    {
        return 'settings';
    }
}
