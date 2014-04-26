<?php

namespace Skrepka\CategoryBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class CategoryController extends Controller
{
    /**
     * Lists all Company documents.
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
     * Returns the DocumentManager
     *
     * @return DocumentManager
     */
    private function getDocumentManager()
    {
        return $this->get('doctrine.odm.mongodb.document_manager');
    }
}
