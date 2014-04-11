<?php

namespace Skrepka\CompanyBundle\Controller;

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

        return ['documents' => $documents];
    }

    /**
     * Displays a form to create a new Company document.
     * @Template()
     * @return array
     */
    public function newAction()
    {
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
        $document = $this->get('company_manager')->findBySlug($slug);

        if (!$document) {
            throw $this->createNotFoundException('now_company_with_this_slug');
        }

        $deleteForm = $this->createDeleteForm($document->getId());

        return [
            'document' => $document,
            'delete_form' => $deleteForm->createView(),
        ];
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

        if (!$document) {
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
     * @Method("POST")
     * @Template("CompanyBundle:Company:edit.html.twig")
     * @param Request $request The request object
     * @param string $id       The document ID
     * @return array
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException If document doesn't exists
     */
    public function updateAction(Request $request, $id)
    {
        $document = $this->get('company_manager')->find($id);

        if (!$document) {
            throw $this->createNotFoundException('Unable to find Company document.');
        }
//        var_dump($document->getLogo()->getReference());

        $deleteForm = $this->createDeleteForm($id);
        $editForm   = $this->createForm(new CompanyType(), $document);
        $editForm->submit($request);

        if ($editForm->isValid()) {
            //$this->getDocumentManager()->flush();

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
}
