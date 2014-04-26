<?php

namespace Skrepka\CompanyBundle\Controller;

use Skrepka\CompanyBundle\Document\File\Media;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Skrepka\CompanyBundle\Document\Company;
use Skrepka\CompanyBundle\Form\CompanyType;

class CompanyController extends Controller
{
    /**
     * Lists all Company documents.
     * @Template()
     * @return array
     */
    public function indexAction()
    {
        $documents = $this->get('company_manager')->all();

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $documents,
            $this->get('request')->query->get('page', 1),
            10
        );

        return compact('pagination');
    }

    /**
     * Displays a form to create a new Company document.
     * @Template()
     * @return array
     */
    public function newAction()
    {
        if (!$this->get('company_manager')->isCurrentUserCanCreateOneMoreCompany()) {
            return $this->redirect($this->generateUrl('homepage'));
        }

        $document = new Company();
        $form = $this->createForm(new CompanyType(), $document);

        return [
            'document' => $document,
            'form'     => $form->createView()
        ];
    }

    /**
     * Creates a new Company document
     *
     * @Template("CompanyBundle:Company:new.html.twig")
     * @param Request $request
     * @return array
     */
    public function createAction(Request $request)
    {
        $document = new Company();
        $form     = $this->createForm(new CompanyType(), $document);
        $form->submit($request);

        if ($form->isValid()) {
            $dm = $this->getDocumentManager();
            $this->get('company_manager')->save($document);
            $dm->flush();

            return $this->redirect($this->generateUrl('company_edit', ['slug' => $document->getSlug()]));
        }

        return [
            'document' => $document,
            'form'     => $form->createView()
        ];
    }

    /**
     * Finds and displays a Company document
     *
     * @Template()
     * @param string $slug The document ID
     * @return array
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException If document doesn't exists
     */
    public function showAction($slug)
    {
        $company = $this->get('company_manager')->findBySlug($slug);

        if (!$company) {
            throw $this->createNotFoundException('now_company_with_this_slug');
        }

        $this->get('company_manager')->incrementViews($company, $this->getRequest()->getClientIp());
        $this->getDocumentManager()->flush();

        return compact('company');
    }

    /**
     * Displays a form to edit an existing Company document.
     *
     * @Template()
     * @param string $slug The document ID
     * @return array
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException If document doesn't exists
     */
    public function editAction($slug)
    {
        $document = $this->get('company_manager')->findBySlug($slug);

        if (!$document || !$this->isOwner($document)) {
            throw $this->createNotFoundException('no_company_found');
        }

        $editForm = $this->createForm(new CompanyType(), $document);
        $deleteForm = $this->createDeleteForm($document->getId());

        return [
            'document'      => $document,
            'form'          => $editForm->createView(),
            'delete_form'   => $deleteForm->createView(),
        ];
    }

    /**
     * Edits an existing Company document
     *
     * @Template("CompanyBundle:Company:edit.html.twig")
     * @param Request $request The request object
     * @param string $id       The document ID
     * @return array
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException If document doesn't exists
     */
    public function updateAction(Request $request, $id)
    {
        $document = $this->get('company_manager')->find($id);

        if (!$document || !$this->isOwner($document)) {
            throw $this->createNotFoundException('no_company_found');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm   = $this->createForm(new CompanyType(), $document);
        $logo = $document->getLogo();

        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            if (is_null($editForm->get('logo')->getData())) {
                $document->setLogo($logo);
            }
            $this->get('company_manager')->save($document);
            $this->getDocumentManager()->flush();

            return $this->redirect($this->generateUrl('company_edit', ['slug' => $document->getSlug()]));
        }

        return [
            'document'      => $document,
            'form'          => $editForm->createView(),
            'delete_form'   => $deleteForm->createView(),
        ];
    }

    /**
     * Deletes a Company document
     *
     * @Method("POST")
     * @param Request $request The request object
     * @param string $id       The document ID
     * @return array
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException If document doesn't exists
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->submit($request);

        if ($form->isValid()) {
            $dm = $this->getDocumentManager();
            $this->get('company_manager')->delete($id);
            $dm->flush();
        }

        return $this->redirect($this->generateUrl('company'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(['id' => $id])
            ->add('id', 'hidden')
            ->getForm()
        ;
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

    /**
     * Check is current user company owner
     *
     * @param $company
     * @return bool
     */
    private function isOwner($company)
    {
        return $this->get('company_manager')->isOwner($company);
    }
}
