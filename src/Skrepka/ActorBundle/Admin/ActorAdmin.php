<?php

namespace Skrepka\ActorBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class ActorAdmin extends Admin
{
    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('firstName', 'text', array('label' => 'First Name'))
            ->add('lastName', 'text', array('label' => 'Last Name'))
            ->add('birthday', 'date', array('label' => 'Birthday'))
//            ->add('author', 'entity', array('class' => 'Acme\DemoBundle\Entity\User'))
        ;
    }

    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('firstName')
            ->add('lastName')
            ->add('birthday')
        ;
    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('firstName')
            ->add('lastName')
            ->add('birthday')
        ;
    }
}