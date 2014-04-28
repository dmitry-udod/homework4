<?php

namespace Skrepka\CategoryBundle\Controller;

use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class CategoryController extends Controller
{
    /**
     * Lists all Company documents.
     *
     * @Template()
     * @return array
     */
    public function indexAction()
    {
        // ToDo: Invistigate and resolve
        $categories =  $this->get('category_repository')->all();
        $subCategories =  $this->get('category_repository')->all();

        return compact('categories', 'subCategories');
    }

    /**
     * Get companies for selected category
     *
     * @Template("CompanyBundle:Company:index.html.twig")
     * @param $slug
     * @return array
     */
    public function categoryAction($slug)
    {
        $category =  $this->get('category_repository')->findBySlug($slug);
        $pagination = [];

        if (!is_null($category)) {
            $q = $this->getDocumentManager()->getRepository('CompanyBundle:Company')->findByCategory($category);
            $companies = $q->getQuery();

            $paginator  = $this->get('knp_paginator');
            $pagination = $paginator->paginate(
                $companies,
                $this->get('request')->query->get('page', 1),
                10
            );
        }

        return compact('category', 'pagination');
    }


    /**
     * Returns the DocumentManager
     *
     * @return DocumentManager
     */
    private function getDocumentManager()
    {
        return $this->get('doctrine.odm.mongodb.document_manager');
    }
}
