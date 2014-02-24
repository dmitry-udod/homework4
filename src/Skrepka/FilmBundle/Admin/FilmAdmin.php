<?php

namespace Skrepka\FilmBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class FilmAdmin extends Admin
{
    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('title', 'text', array('label' => 'Title'))
            ->add('year', 'text', array('label' => 'Year'))
            ->add('description', 'text', array('label' => 'Description'))
            ->add('actors', 'document', array('class' => 'Skrepka\ActorBundle\Document\Actor', 'multiple' => true))
            ->add('categories', 'document', array('class' => 'Skrepka\CategoryBundle\Document\Category', 'multiple' => true))
//            ->add('translations', 'a2lix_translations', array('locales' => array('es')));
//            ->add('translations', 'a2lix_translations', array(
//                'locales' => array('de'),   // [1]
//                'required' => false,                    // [2]
//                'fields' => array(                      // [3]
//                    'title' => array(                   // [3.a]
//                        'field_type' => 'text',                 // [4]
//                        'label' => 'DESC',                     // [4]
//                        'locale_options' => array(            // [3.b]
//                            'de' => array(
//                                'label' => 'German Title'            // [4]
//                            ),
//                        )
//                    )
//                )
//            ));
        ;
    }

    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('title')
            ->add('year')
            ->add('description')
            ->add('actors')
            ->add('categories')
        ;
    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('title')
            ->add('year')
            ->add('description')
            ->add('actors')
            ->add('categories')
        ;
    }
}